<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Builders / Developers
$routes->get('builders',         'Builders::index');
$routes->get('builders/(:segment)', 'Builders::details/$1');

// Projects
$routes->get('projects',         'Projects::index');
$routes->get('projects/explore', 'Projects::explore');
$routes->post('projects/submitEnquiry', 'Projects::submitEnquiry');
$routes->get('project/(:segment)', 'Projects::details/$1');

// Contact
$routes->get('contact',        'Contact::index');
$routes->post('contact/submit', 'Contact::submit');
