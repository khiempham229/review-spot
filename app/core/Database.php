
<?php
require 'vendor/autoload.php';

class Database
{
  private $database;

  public function __construct()
  {
    try {
      $uri = 'mongodb://' . DB_HOST . ':' . DB_PORT;

      $client = new MongoDB\Client($uri);
      $this->database = $client->selectDatabase(DB_NAME);
    } catch (Exception $e) {
      die("Database Connection Failed: " . $e->getMessage());
    }
  }

  public function getConnection()
  {
    return $this->database;
  }
}
