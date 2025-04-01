<?php

class Comment
{
    private $collection;
    private $userCollection;

    public function __construct()
    {
        $database = new Database();
        $this->collection = $database->getConnection()->comments;
        $this->userCollection = $database->getConnection()->users;
    }

    public function getCommentsByReviewId($reviewId)
    {
        $comments = $this->collection->find([
            'review_id' => new MongoDB\BSON\ObjectId($reviewId)
        ])->toArray();

        // Gắn author_name từ bảng User
        foreach ($comments as &$comment) {
            $author = $this->userCollection->findOne([
                '_id' => $comment['author_id']
            ]);

            $comment['author_name'] = $author ? ($author['firstName'] . ' ' . $author['lastName']) : "Ẩn danh";
        }

        return $comments;
    }

    public function addComment($reviewId, $authorId, $content)
    {
        $commentData = [
            'review_id' => new MongoDB\BSON\ObjectId($reviewId),
            'author_id' => new MongoDB\BSON\ObjectId($authorId),
            'content' => $content,
            'created_at' => new MongoDB\BSON\UTCDateTime(),
            'updated_at' => new MongoDB\BSON\UTCDateTime()
        ];

        $this->collection->insertOne($commentData);

        $this->updateCommentCount($reviewId);
    }

    public function updateCommentCount($reviewId)
    {
        $database = new Database();
        $reviewCollection = $database->getConnection()->reviews;

        $reviewCollection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($reviewId)],
            ['$inc' => ['comments_count' => 1]]
        );
    }
}
