<?php

class Category
{
    private $collection;

    public function __construct()
    {
        $database = new Database();
        $this->collection = $database->getConnection()->categories;

        if (!$this->collection) {
            die("Kết nối tới collection categories thất bại");
        }
    }

    public function createCategory($name, $description, $parentId = null)
    {
        try {
            $now = new MongoDB\BSON\UTCDateTime();

            $categoryData = [
                'name' => $name,
                'description' => $description,
                'parent_id' => $parentId ? new MongoDB\BSON\ObjectId($parentId) : null,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $result = $this->collection->insertOne($categoryData);

            return $result->getInsertedId();
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return false;
        }
    }

    public function getCategories()
    {
        try {
            return $this->collection->find([])->toArray();
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return [];
        }
    }

    public function getCategoryById($categoryId)
    {
        try {
            return $this->collection->findOne(['_id' => new MongoDB\BSON\ObjectId($categoryId)]);
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return null;
        }
    }

    public function getCategoriesByIds($categoryIds)
    {
        // Chuyển BSONArray thành mảng PHP thuần
        $categoryIdsArray = iterator_to_array($categoryIds);

        return $this->collection->find([
            '_id' => ['$in' => array_map(fn($id) => new MongoDB\BSON\ObjectId((string) $id), $categoryIdsArray)]
        ])->toArray();
    }



    public function updateCategory($categoryId, $data)
    {
        try {
            $data['updated_at'] = new MongoDB\BSON\UTCDateTime();

            $result = $this->collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($categoryId)],
                ['$set' => $data]
            );

            return $result->getModifiedCount() > 0;
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return false;
        }
    }

    public function deleteCategory($categoryId)
    {
        try {
            $result = $this->collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($categoryId)]);
            return $result->getDeletedCount() > 0;
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return false;
        }
    }
}
