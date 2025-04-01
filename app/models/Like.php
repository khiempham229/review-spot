<?php

class Like
{
    private $likeCollection;
    private $reviewCollection;

    public function __construct()
    {
        $database = new Database();
        $this->likeCollection = $database->getConnection()->likes;
        $this->reviewCollection = $database->getConnection()->reviews;
    }

    public function addLike($reviewId, $userId)
    {
        $existingLike = $this->likeCollection->findOne([
            'review_id' => new MongoDB\BSON\ObjectId($reviewId),
            'user_id' => new MongoDB\BSON\ObjectId($userId)
        ]);

        if (!$existingLike) {
            $likeData = [
                'review_id' => new MongoDB\BSON\ObjectId($reviewId),
                'user_id' => new MongoDB\BSON\ObjectId($userId),
                'created_at' => new MongoDB\BSON\UTCDateTime(),
                'updated_at' => new MongoDB\BSON\UTCDateTime()
            ];
            $this->likeCollection->insertOne($likeData);

            $this->updateLikeCount($reviewId);
        }
    }

    public function updateLikeCount($reviewId)
    {
        $this->reviewCollection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($reviewId)],
            ['$inc' => ['likes_count' => 1]]
        );
    }

    public function getLikesCount($reviewId)
    {
        return $this->likeCollection->countDocuments(['review_id' => new MongoDB\BSON\ObjectId($reviewId)]);
    }

    public function isLikedByUser($reviewId, $userId)
    {
        $existingLike = $this->likeCollection->findOne([
            'review_id' => new MongoDB\BSON\ObjectId($reviewId),
            'user_id' => new MongoDB\BSON\ObjectId($userId)
        ]);
        return $existingLike !== null;
    }
}
