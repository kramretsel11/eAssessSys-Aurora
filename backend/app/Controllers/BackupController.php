<?php namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\Controller; // Ensure you extend the correct base Controller for your CI version

// Note: BaseController in CI4 extends Controller, so this is usually correct.
class BackupController extends BaseController
{
    /**
     * @var \App\Models\AuthModel
     */
    protected $authModel;
    
    public function __construct(){
        // Models
        $this->authModel = new AuthModel();
    }

    public function backupDatabase(){
        // Get API Request Data from NuxtJs
        $data = $this->request->getJSON(); 
        // Always check if $data is not null before accessing properties
        if (! $data || ! property_exists($data, 'password') || ! property_exists($data, 'userId')) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Invalid or missing request data']);
        }
        
        $hasPass = sha1($data->password);

        // Select Query for finding User Information
        $user = $this->authModel->where(['id' => $data->userId, 'password' => $hasPass])->get()->getRow();
        
        // Set Api Response return to the FE
        if($user){
            // FIX 1: Add DocBlock to prevent IDE error (Undefined method 'getUtility')
            /** @var \CodeIgniter\Database\BaseConnection $db */ 
            $db = \Config\Database::connect();
            
            // FIX 2: Correctly get the utility object from the database connection
            $dbutil = \Config\Database::utils();
            $tables = $db->listTables();

            // FIX 3: Change 'format' to 'zip' to resolve the "Unsupported feature" DatabaseException
            $prefs = array(
                'tables'        => $tables,
                'ignore'        => array(),
                'format'        => 'zip', // Use 'zip' or 'gzip'
                'filename'      => 'ascotinventory_db.zip', // Update filename extension
                'add_drop'      => true,
                'add_insert'    => true,
                'newline'       => "\n",
                'foreign_key_checks' => false,
            );

            $backup = $dbutil->backup($prefs);

            // FIX 4: Use the CI4 Response::download() method to serve the file
            // This is the correct way to handle file output and prevents a blank page/Internal Error
            return $this->response->download($prefs['filename'], $backup, true);

        } else {
            $response = [
                'error' => 401,
                'title' => 'Backup Denied',
                'message' => 'Unauthoried user is trying to backup'
            ];

            return $this->response
                ->setStatusCode(401)
                ->setContentType('application/json')
                ->setBody(json_encode($response));
        }
    }
    
    public function restoreDatabase()
    {
        // ... (The file upload logic remains the same) ...
        $file = $this->request->getFile('backup_file');
        if (!$file || ! $file->isValid()) { // Check if $file is null or invalid
            return $this->response
                ->setStatusCode(400)
                ->setContentType('application/json')
                ->setBody(json_encode(['error' => 'No valid file uploaded']));
        }

        // Generate a new name for the file and move it to the writable/uploads directory
        $newName = $file->getRandomName();
        $filePath = WRITEPATH . 'uploads/' . $newName;
        if (!$file->move(WRITEPATH . 'uploads', $newName)) {
            return $this->response
                ->setStatusCode(500)
                ->setContentType('application/json')
                ->setBody(json_encode(['error' => 'Failed to move uploaded file']));
        }

        // Read the file content
        $sql = file_get_contents($filePath);
        if ($sql === false) {
            @unlink($filePath); // Cleanup
            return $this->response
                ->setStatusCode(500)
                ->setContentType('application/json')
                ->setBody(json_encode(['error' => 'Failed to read file content']));
        }
        
        // FIX 5: Split the SQL content into individual statements and execute
        $sqls = explode(';', $sql);

        /** @var \CodeIgniter\Database\BaseConnection $db */
        $db = \Config\Database::connect();
        $db->transStart();
        
        $error = false;
        try {
            foreach ($sqls as $statement) {
                // Clean up the statement and skip if empty or a comment
                $statement = trim($statement);
                if (!empty($statement) && !str_starts_with($statement, '--')) {
                    $db->query($statement);
                }
            }
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'SQL Execution Error: ' . $e->getMessage());
            $error = $e->getMessage();
        }
        $db->transComplete();

        // Check for any transaction failure
        if ($db->transStatus() === false || $error) {
            @unlink($filePath); // Cleanup
            return $this->response
                ->setStatusCode(500)
                ->setContentType('application/json')
                ->setBody(json_encode([
                    'error' => 'Failed to restore database', 
                    'details' => $error ? $error : 'Transaction failed.'
                ]));
        }

        // Final cleanup and success response
        @unlink($filePath);
        return $this->response
            ->setStatusCode(200)
            ->setContentType('application/json')
            ->setBody(json_encode(['message' => 'Database restored successfully']));
    }
}