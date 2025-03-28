<?php
require 'vendor/autoload.php';

require_once __DIR__ . '/../config/config.php';

class Database
{
    private $manager;
    private $dbname;

    public function __construct()
    {
        $this->dbname = DB_NAME;
        $uri = 'mongodb://' . DB_HOST . ':' . DB_PORT;

        try {
            $this->manager = new MongoDB\Driver\Manager($uri);

        } catch (MongoDB\Driver\Exception\Exception $e) {
            die("Lỗi kết nối MongoDB: " . $e->getMessage());
        }
    }

    // Phương thức thực hiện truy vấn
    public function query($collection, $filter = [], $options = [])
    {
        $query = new MongoDB\Driver\Query($filter, $options);
        return $this->manager->executeQuery("{$this->dbname}.$collection", $query)->toArray();
    }

    // Phương thức chèn dữ liệu
    public function insert($collection, $document)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert($document);
        return $this->manager->executeBulkWrite("{$this->dbname}.$collection", $bulk);
    }

    // Phương thức cập nhật dữ liệu
    public function update($collection, $filter, $newData)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update($filter, ['$set' => $newData], ['multi' => true, 'upsert' => false]);
        return $this->manager->executeBulkWrite("{$this->dbname}.$collection", $bulk);
    }

    // Phương thức xóa dữ liệu
    public function delete($collection, $filter)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->delete($filter, ['limit' => 1]);
        return $this->manager->executeBulkWrite("{$this->dbname}.$collection", $bulk);
    }
}
