  <?php

    class Review
    {
        private $collection;
        private $likeCollection;

        public function __construct()
        {
            $database = new Database();
            $this->collection = $database->getConnection()->reviews;
            $this->likeCollection = $database->getConnection()->likes;
        }

        public function getAllReviews()
        {
            return $this->collection->find()->toArray();
        }

        public function addReview($reviewData)
        {
            $review = [
                "title" => $reviewData["title"],
                "content" => $reviewData["content"],
                "author_id" => new MongoDB\BSON\ObjectId($reviewData["author_id"]),
                "status" => "pending",
                "approved_by" => null,
                "approved_at" => null,
                "brand_id" => new MongoDB\BSON\ObjectId($reviewData["brand_id"]),
                "category_ids" => array_map(fn($id) => new MongoDB\BSON\ObjectId($id), $reviewData["category_ids"]),
                "created_at" => new MongoDB\BSON\UTCDateTime(),
                "product_name" => $reviewData["product_name"],
                "rating" => (int) $reviewData["rating"],
                "tags" => $reviewData["tags"],
                "comments_count" => 0,
                "likes_count" => 0,
                "product_id" => null,
                "product_image" => $reviewData["product_image"],
                "updated_at" => new MongoDB\BSON\UTCDateTime()
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

        public function updateReviewStatus($reviewId, $status)
        {
            $this->collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($reviewId)],
                ['$set' => ['status' => $status]]
            );
        }

        public function deleteReviewById($id)
        {
            $result = $this->collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
            // return $result->getDeletedCount();
        }

        public function getReviewsByFilter($categories, $brands)
        {
            // Tạo điều kiện lọc
            $filter = [];

            // Lọc theo category_ids nếu có
            if (!empty($categories)) {
                // Kiểm tra nếu tất cả các category_ids là hợp lệ
                $categories = array_filter($categories, function ($id) {
                    return strlen($id) == 24 && ctype_xdigit($id); // Kiểm tra nếu id là 24 ký tự hex
                });

                // Nếu có category_ids hợp lệ, áp dụng lọc
                if (!empty($categories)) {
                    $filter['category_ids'] = ['$in' => array_map(function ($id) {
                        return new MongoDB\BSON\ObjectId($id);
                    }, $categories)];
                }
            }

            // Lọc theo brand_id nếu có
            if (!empty($brands)) {
                // Loại bỏ các giá trị rỗng
                $brands = array_filter($brands);

                // Nếu có brands hợp lệ, áp dụng lọc
                if (!empty($brands)) {
                    $filter['brand_id'] = ['$in' => array_map(function ($id) {
                        return new MongoDB\BSON\ObjectId($id);
                    }, $brands)];
                }
            }

            // Nếu không có bất kỳ filter nào, trả về tất cả các dữ liệu
            if (empty($filter)) {
                $reviews = $this->collection->find([])->toArray(); // Không lọc gì cả
            } else {
                // Truy vấn với các filter đã được áp dụng
                $reviews = $this->collection->find($filter)->toArray();
            }

            return $reviews;
        }

        public function getLatestReviews($limit = 5)
        {
            $reviews = $this->collection->find(
                [],
                [
                    'sort' => ['created_at' => -1],
                    'limit' => $limit
                ]
            )->toArray();

            return $reviews;
        }

        public function getMostLikedReviews($limit = 5)
        {
            // Truy vấn để lấy số lượng likes cho mỗi review
            $pipeline = [
                [
                    '$group' => [
                        '_id' => '$review_id',
                        'likes_count' => ['$sum' => 1]
                    ]
                ],
                [
                    '$sort' => ['likes_count' => -1]  // Sắp xếp theo số lượt thích giảm dần
                ],
                [
                    '$limit' => $limit  // Giới hạn số lượng review, ví dụ 5 bài review có số lượt thích nhiều nhất
                ]
            ];

            $result = $this->likeCollection->aggregate($pipeline)->toArray();

            // Lấy các review dựa trên review_id đã lấy từ kết quả
            $reviewIds = array_map(function ($item) {
                return new MongoDB\BSON\ObjectId($item['_id']);
            }, $result);

            // Lấy thông tin review từ bảng reviews
            $reviews = $this->collection->find([
                '_id' => ['$in' => $reviewIds]
            ])->toArray();

            return $reviews;
        }
    }
