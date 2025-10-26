<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('e_assessment/api/v1', function($routes){
	$routes->group('auth', function($routes){
		$routes->post('login', 'Auth::login');
	}); 

	$routes->group('users', function($routes){
		$routes->post('create', 'Users::registerUser');
		$routes->post('update', 'Users::updateUser');
		$routes->post('update/status', 'Users::updateUserStatus');
		$routes->post('changePassword', 'Users::ChangePassword');
		$routes->get('getUsersList', 'Users::getAllUserList');
		$routes->post('getUserById', 'Users::getUserDetails');
	});
	

	$routes->group('misc', function($routes){
		$routes->get('getUserTypes', 'Misc::getUserTypes');
		$routes->get('getBranches', 'Misc::getBranches');
		$routes->get('getAddress/(:any)', 'Misc::getAddress/$1');
		$routes->post('database/backup', 'BackupController::backupDatabase');
		$routes->post('database/restore', 'BackupController::restoreDatabase');
	});
});