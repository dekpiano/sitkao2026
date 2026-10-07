<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Alumni::index');
$routes->get('alumni/batch', 'Alumni::batch');
$routes->get('alumni/batch/(:any)', 'Alumni::batch/$1');
$routes->get('alumni/profile/(:num)', 'Alumni::profile/$1');

// Alumni Routes
$routes->get('alumni/edit-profile', 'Alumni::editProfile');
$routes->post('alumni/update-profile', 'Alumni::updateProfile');
$routes->get('alumni/my-profile', 'Alumni::myProfile');

// Auth Routes
$routes->get('login', 'Auth::login');
$routes->post('login/submit', 'Auth::loginSubmit');
$routes->get('register', 'Auth::register');
$routes->post('register/submit', 'Auth::registerSubmit');
$routes->get('logout', 'Auth::logout');
$routes->get('forgot-password', 'Auth::forgotPassword');
$routes->post('forgot-password/verify', 'Auth::verifyForgotPassword');
$routes->post('forgot-password/verify-info', 'Auth::verifyForgotPasswordByInfo');
$routes->post('forgot-password/reset', 'Auth::resetPasswordSubmit');
$routes->get('reset-password/(:any)', 'Auth::resetPasswordWithToken/$1');

// Job Board Routes
$routes->get('jobs', 'Jobs::index');
$routes->get('jobs/create', 'Jobs::create');
$routes->post('jobs/save', 'Jobs::save');
$routes->get('jobs/(:num)', 'Jobs::detail/$1');

// News & Events Routes
$routes->get('news', 'News::index');
$routes->get('news/(:num)', 'News::detail/$1');

// Admin Backoffice Routes
$routes->group('admin', function ($routes) {
    $routes->get('login', 'Admin::login');
    $routes->get('google-redirect', 'Admin::googleRedirect');
    $routes->get('googleCallback', 'Admin::googleCallback');
    $routes->post('google-login', 'Admin::googleLogin');
    $routes->get('/', 'Admin::dashboard');
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('managers', 'Admin::managers');
    $routes->post('managers/add', 'Admin::addManager');
    $routes->get('managers/remove/(:num)', 'Admin::removeManager/$1');
    $routes->get('alumni', 'Admin::alumniList');
    $routes->get('alumni/toggle-role/(:num)', 'Admin::toggleRole/$1');
    $routes->get('alumni/delete/(:num)', 'Admin::deleteAlumni/$1');
    $routes->get('export-survey', 'Admin::exportSurvey');
});


