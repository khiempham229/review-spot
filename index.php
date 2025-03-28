<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Include the configuration file
require_once "./app/config/config.php";

// Include the Database class file
require_once "./app/core/Database.php";

// Include the Controller class file
require_once "./app/core/Controller.php";

// Include the App class file
require_once "./app/core/App.php";

// Include the helpers file
require_once "./app/helpers.php";

// Create a new instance of the App class
$app = new App();
