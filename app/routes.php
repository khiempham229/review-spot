<?php

// Define an array of routes for the application
$routes = [
    // Route for the home page, maps to the 'index' method of 'BookController'
    '' => ['controller' => 'HomeController', 'method' => 'index'],

    'login' => ['controller' => 'AuthController', 'method' => 'index'],
    'auth/signup' => ['controller' => 'AuthController', 'method' => 'signup'],
    'auth/signin' => ['controller' => 'AuthController', 'method' => 'signin'],
    'logout' => ['controller' => 'AuthController', 'method' => 'logout'],

    'review' => ['controller' => 'ReviewController', 'method' => 'index'],


    // Route for the books list page, maps to the 'index' method of 'BookController'
    'books' => ['controller' => 'BookController', 'method' => 'index'],

    // Route for a specific book page, maps to the 'bookId' method of 'BookController'
    'book/id' => ['controller' => 'BookController', 'method' => 'bookById'],

    // Route for adding a new book, maps to the 'addBook' method of 'BookController'
    'book/add' => ['controller' => 'BookController', 'method' => 'addNewBook'],

    // Route for deleting a book, maps to the 'delete' method of 'BookController'
    'book/delete' => ['controller' => 'BookController', 'method' => 'deleteBook'],

    // Route for updating a book, maps to the 'update' method of 'BookController'
    'book/update' => ['controller' => 'BookController', 'method' => 'updateBook'],

    '404' => ['controller' => 'DefaultController', 'method' => 'notFound404'],
];

// $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// if ($uri === '404') {
//     require 'views/404.php';
//     exit;
// }

// if ($uri === 'login') {
//     require 'views/login.php';
//     exit;
// }