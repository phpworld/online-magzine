<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//$routes->get('/', 'MagazineController::index');
$routes->get('magazine/details/(:num)', 'MagazineController::details/$1');
$routes->get('user/register', 'UserController::register');
$routes->post('user/register', 'UserController::register');
$routes->get('user/login', 'UserController::login');
$routes->get('user/logout', 'UserController::logout');
$routes->post('user/login', 'UserController::login');
$routes->get('user/dashboard', 'UserController::dashboard', ['filter' => 'auth']);
$routes->get('subscription/manage', 'SubscriptionController::manage',['filter' => 'auth']);
$routes->get('purchase/history', 'PurchaseController::history',['filter' => 'auth']);
$routes->get('payment/history', 'PaymentController::history',['filter' => 'auth']);
$routes->get('purchase/magazine/(:num)', 'PurchaseController::purchaseMagazine/$1',['filter' => 'auth']);
$routes->post('payment/process', 'PaymentController::processPayment',['filter' => 'auth']);
$routes->get('magazine/details/(:num)', 'MagazineController::details/$1',['filter' => 'auth']);
$routes->post('paymentsuccess/', 'PaymentController::paymentSuccess');
$routes->get('my_magzines/', 'PaymentController::showUserCompletedMagazines');

$routes->get('user/change-password', 'UserController::changePassword');
$routes->post('user/change-password', 'UserController::changePassword');
$routes->get('user/payment_history', 'UserController::paymentHistory',['filter' => 'auth']);


 
$routes->get('admin/login', 'AdminController::login');
$routes->post('admin/login', 'AdminController::login');
$routes->get('admin/dashboard', 'AdminController::dashboard', ['filter' => 'authfilter']);
$routes->get('admin/logout', 'AdminController::logout');
$routes->get('admin/payment-history', 'PaymentController::payment_history');

// Magazine Management
$routes->get('admin/uploadMagazine', 'AdminController::uploadMagazine', ['filter' => 'authfilter']);
$routes->post('admin/uploadMagazine', 'AdminController::uploadMagazine', ['filter' => 'authfilter']);
$routes->get('admin/magazines', 'AdminController::listMagazines', ['filter' => 'authfilter']);
$routes->get('admin/editMagazine/(:num)', 'AdminController::editMagazine/$1', ['filter' => 'authfilter']);
$routes->post('admin/editMagazine/(:num)', 'AdminController::editMagazine/$1', ['filter' => 'authfilter']);
$routes->get('admin/deleteMagazine/(:num)', 'AdminController::deleteMagazine/$1', ['filter' => 'authfilter']);

// User Management
$routes->get('admin/manageUsers', 'AdminController::manageUsers', ['filter' => 'authfilter']);
$routes->get('admin/viewUser/(:num)', 'AdminController::viewUser/$1', ['filter' => 'authfilter']);
$routes->get('admin/deleteUser/(:num)', 'AdminController::deleteUser/$1', ['filter' => 'authfilter']);
$routes->post('admin/updateUserStatus/(:num)', 'AdminController::updateUserStatus/$1');

// Subscription Management
$routes->get('admin/manageSubscriptions', 'AdminController::manageSubscriptions', ['filter' => 'authfilter']);
$routes->get('admin/editSubscription/(:num)', 'AdminController::editSubscription/$1', ['filter' => 'authfilter']);
$routes->post('admin/editSubscription/(:num)', 'AdminController::editSubscription/$1', ['filter' => 'authfilter']);
$routes->get('admin/deleteSubscription/(:num)', 'AdminController::deleteSubscription/$1', ['filter' => 'authfilter']);

///////

$routes->get('admin/categories', 'AdminController::listCategories');
$routes->post('admin/createCategory', 'AdminController::createCategory');
$routes->get('admin/editCategory/(:num)', 'AdminController::edit_category/$1');
$routes->post('admin/update_category/(:num)', 'AdminController::updateCategory/$1');
$routes->get('admin/deleteCategory/(:num)', 'AdminController::deleteCategory/$1');