<?php

// Define an array of routes for the application
$routes = [
    // Route for the home page, maps to the 'index' method of 'BookController'
    '' => ['controller' => 'HomeController', 'method' => 'index'],

    'login' => ['controller' => 'AuthController', 'method' => 'index'],
    'auth/signup' => ['controller' => 'AuthController', 'method' => 'signup'],
    'auth/signin' => ['controller' => 'AuthController', 'method' => 'signin'],
    'logout' => ['controller' => 'AuthController', 'method' => 'logout'],

    'reviews' => ['controller' => 'ReviewController', 'method' => 'index'],
    'reviews/details' => ['controller' => 'ReviewController', 'method' => 'reviewById'],
    'reviews/add' => ['controller' => 'ReviewController', 'method' => 'addNewReview'],
    'reviews/update' => ['controller' => 'ReviewController', 'method' => 'updateReview'],
    'reviews/delete' => ['controller' => 'ReviewController', 'method' => 'deleteReview'],
    'reviews/save-new-review' => ['controller' => 'ReviewController', 'method' => 'saveNewReview'],
    'reviews/like' => ['controller' => 'ReviewController', 'method' => 'likeReview'],
    'reviews/comment' => ['controller' => 'ReviewController', 'method' => 'addComment'],

    // Admin
    'admin' => ['controller' => 'AdminController', 'method' => 'index'],
    'admin/updateStatus' => ['controller' => 'AdminController', 'method' => 'updateStatus'],
    'admin/deleteReview' => ['controller' => 'AdminController', 'method' => 'deleteReview'],

    // Categories
    'categories' => ['controller' => 'CategoryController', 'method' => 'index'],
    'categories/details' => ['controller' => 'CategoryController', 'method' => 'categoryById'],
    'categories/add' => ['controller' => 'CategoryController', 'method' => 'addNewCategory'],
    'categories/update' => ['controller' => 'CategoryController', 'method' => 'updateCategory'],
    'categories/delete' => ['controller' => 'CategoryController', 'method' => 'deleteCategory'],

    // Brands
    'brands' => ['controller' => 'BrandController', 'method' => 'index'],
    'brands/details' => ['controller' => 'BrandController', 'method' => 'brandById'],
    'brands/add' => ['controller' => 'BrandController', 'method' => 'addNewBrand'],
    'brands/update' => ['controller' => 'BrandController', 'method' => 'updateBrand'],
    'brands/delete' => ['controller' => 'BrandController', 'method' => 'deleteBrand'],


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