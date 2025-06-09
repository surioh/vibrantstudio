<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::landing');
$routes->get('/classes', 'Home::classes');

$routes->get('/login', 'Home::login');
$routes->post('/login_check', 'Home::login_check');
$routes->post('/register', 'Home::register');
$routes->get('/userMobile', 'Home::userMobile');
$routes->get('/scheduleMobile', 'Home::scheduleMobile');
$routes->get('/topup', 'Home::topup');
$routes->get('/logout', 'Home::logout');

// generate schedule
$routes->get('/generate_schedule', 'Admin::generate_schedule');

// Booking List
$routes->get('/booking_list', 'Home::booking_list');
$routes->post('/booking_kelas', 'Home::booking_kelas');

//cancel booking
$routes->post('/cancel_booking', 'Home::cancel_booking');

// Admin Kelas
$routes->get('/msKelas', 'Admin::msKelas');
$routes->post('/tambahKelas', 'Admin::tambahKelas');
$routes->post('/hapusKelas', 'Admin::hapusKelas');
$routes->post('/viewKelas', 'Admin::viewKelas');
$routes->post('/EditKelas', 'Admin::EditKelas');

// Admin User
$routes->get('/msUser', 'Admin::msUser');
$routes->post('/tambahUser', 'Admin::tambahUser');
$routes->post('/hapusUser', 'Admin::hapusUser');
$routes->post('/viewUser', 'Admin::viewUser');
$routes->post('/EditUser', 'Admin::EditUser');

// Admin Schedule
$routes->get('/msSchedule', 'Admin::msSchedule');
$routes->post('/tambahSchedule', 'Admin::tambahSchedule');
$routes->post('/hapusSchedule', 'Admin::hapusSchedule');
$routes->post('/viewSchedule', 'Admin::viewSchedule');
$routes->post('/EditSchedule', 'Admin::EditSchedule');

// Admin ActualSchedule
$routes->get('/actualSchedule', 'Admin::actualSchedule');
$routes->post('/hapusActualSchedule', 'Admin::hapusActualSchedule');
$routes->post('/viewActualSchedule', 'Admin::viewActualSchedule');
$routes->post('/viewActualSchedule2', 'Admin::viewActualSchedule2');
$routes->post('/EditActualSchedule', 'Admin::EditActualSchedule');
$routes->post('/CustomerBookActualSchedule', 'Admin::CustomerBookActualSchedule');

// Admin msCustomer
$routes->get('/msCustomer', 'Admin::msCustomer');
$routes->post('/EditCustomer', 'Admin::EditCustomer');
$routes->post('/viewCustomer', 'Admin::viewCustomer');

// Admin TodaySchedule
$routes->get('/todaySchedule', 'Admin::todaySchedule');

// API 
$routes->post('/create_invoice', 'Api::create_invoice');


//excel export
$routes->get('exportTodayScheduleExcel', 'Admin::exportTodayScheduleExcel');





