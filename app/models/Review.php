  <?php

    class Review
    {
        private $db;
        private $collection;

        public function __construct()
        {
            $this->db = new Database();
            $this->collection = $this->db->getConnection()->reviews;
        }

        public function getAllReviews()
        {
            return $this->collection->find()->toArray();
        }

        // Thêm một sách mới vào database
        public function addReview($title, $author, $isbn)
        {
            $review = [
                'title'  => $title,
                'author' => $author,
                'isbn'   => $isbn,
                'created_at' => new MongoDB\BSON\UTCDateTime(),
                'updated_at' => new MongoDB\BSON\UTCDateTime()
            ];

            $result = $this->collection->insertOne($review);
            return $result->getInsertedId();
        }

        public function updateReview($id, $title, $author, $isbn)
        {
            $updateData = [
                '$set' => [
                    'title'  => $title,
                    'author' => $author,
                    'isbn'   => $isbn,
                    'updated_at' => new MongoDB\BSON\UTCDateTime(),
                ]
            ];

            $result = $this->collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($id)],
                $updateData
            );

            return $result->getModifiedCount();
        }

        public function getReviewById($id)
        {
            return $this->collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        }

        public function deleteReview($id)
        {
            $result = $this->collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
            return $result->getDeletedCount();
        }
    }
