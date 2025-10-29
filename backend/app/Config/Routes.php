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
		$routes->post('database/backup', 'BackupController::backupDatabase');
		$routes->post('database/restore', 'BackupController::restoreDatabase');

		// Category Routes
		$routes->get('categories', 'CategoryController::getCategories');
		$routes->post('categories/create', 'CategoryController::createCategory');
		$routes->post('categories/update', 'CategoryController::updateCategory');
		$routes->post('categories/delete', 'CategoryController::deleteCategory');

		// Market Value Routes
		$routes->get('market-values', 'MarketValueController::getMarketValues');
		$routes->post('market-values/create', 'MarketValueController::createMarketValue');
		$routes->post('market-values/update', 'MarketValueController::updateMarketValue');
		$routes->post('market-values/delete', 'MarketValueController::deleteMarketValue');

		// Assessment Level Routes
		$routes->get('assessment-levels', 'AssessmentLevelController::getAssessmentLevels');
		$routes->post('assessment-levels/create', 'AssessmentLevelController::createAssessmentLevel');
		$routes->post('assessment-levels/update', 'AssessmentLevelController::updateAssessmentLevel');
		$routes->post('assessment-levels/delete', 'AssessmentLevelController::deleteAssessmentLevel');

		// Assessment Requests Routes
		$routes->get('assessment-requests', 'AssessmentRequestController::getRequests');
		$routes->get('assessment-requests/(:num)', 'AssessmentRequestController::getRequest/$1');
		$routes->post('assessment-requests/create', 'AssessmentRequestController::createRequest');
		$routes->post('assessment-requests/update', 'AssessmentRequestController::updateRequest');
		$routes->post('assessment-requests/update-status', 'AssessmentRequestController::updateRequestStatus');
		$routes->post('assessment-requests/track', 'AssessmentRequestController::trackRequest');
	});
});