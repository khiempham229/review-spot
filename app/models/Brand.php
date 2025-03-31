<?php

class Brand
{
    private $collection;

    public function __construct()
    {
        $database = new Database();
        $this->collection = $database->getConnection()->brands;

        if (!$this->collection) {
            die("Kết nối tới collection brands thất bại");
        }
    }

    // Thêm thương hiệu mới
    public function createBrand($name, $description, $country, $logo)
    {
        try {
            $now = new MongoDB\BSON\UTCDateTime();

            $result = $this->collection->insertOne([
                'name' => $name,
                'description' => $description,
                'country' => $country,
                'logo' => $logo,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            return $result->getInsertedId();
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return false;
        }
    }

    // Lấy danh sách tất cả thương hiệu
    public function getBrands()
    {
        try {
            return $this->collection->find([])->toArray();
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return [];
        }
    }

    // Lấy thương hiệu theo ID
    public function getBrandById($brandId)
    {
        try {
            return $this->collection->findOne(['_id' => new MongoDB\BSON\ObjectId($brandId)]);
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return null;
        }
    }

    // Cập nhật thông tin thương hiệu
    public function updateBrand($brandId, $data)
    {
        try {
            $data['updated_at'] = new MongoDB\BSON\UTCDateTime();

            $result = $this->collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($brandId)],
                ['$set' => $data]
            );

            return $result->getModifiedCount() > 0;
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return false;
        }
    }

    // Xóa thương hiệu
    public function deleteBrand($brandId)
    {
        try {
            $result = $this->collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($brandId)]);
            return $result->getDeletedCount() > 0;
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return false;
        }
    }
}
