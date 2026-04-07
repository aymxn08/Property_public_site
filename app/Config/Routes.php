<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('projects', 'Projects::index');
$routes->get('projects/explore', 'Projects::explore');
$routes->post('projects/submitEnquiry', 'Projects::submitEnquiry');
$routes->get('project/(:segment)', 'Projects::details/$1');
$routes->get('contact', 'Contact::index');
$routes->post('contact/submit', 'Contact::submit');
