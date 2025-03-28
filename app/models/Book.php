  <?php

class Book
{
    private $db;
    private $collection;

    public function __construct()
    {
        // Khởi tạo đối tượng Database và lấy kết nối
        $this->db = new Database();
        $this->collection = $this->db->getConnection()->books; // Truy cập collection "books"
    }

    // Lấy tất cả sách
    public function getAllBooks()
    {
        return $this->collection->find()->toArray(); // Chuyển đổi kết quả truy vấn thành mảng
    }

    // Thêm một sách mới vào database
    public function addBook($title, $author, $isbn)
    {
        $book = [
            'title'  => $title,
            'author' => $author,
            'isbn'   => $isbn,
            'created_at' => new MongoDB\BSON\UTCDateTime(), // Thêm thời gian tạo
            'updated_at' => new MongoDB\BSON\UTCDateTime()  // Thêm thời gian cập nhật
        ];

        // Thực hiện thêm sách vào collection
        $result = $this->collection->insertOne($book);
        return $result->getInsertedId(); // Trả về ID của sách vừa thêm
    }

    // Cập nhật thông tin sách
    public function updateBook($id, $title, $author, $isbn)
    {
        $updateData = [
            '$set' => [
                'title'  => $title,
                'author' => $author,
                'isbn'   => $isbn,
                'updated_at' => new MongoDB\BSON\UTCDateTime(), // Cập nhật thời gian
            ]
        ];

        // Thực hiện cập nhật sách theo ID
        $result = $this->collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)], // Điều kiện tìm sách theo ID
            $updateData
        );

        return $result->getModifiedCount(); // Trả về số bản ghi được cập nhật
    }

    // Lấy thông tin sách theo ID
    public function getBookById($id)
    {
        return $this->collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    }

    // Xóa sách theo ID
    public function deleteBook($id)
    {
        $result = $this->collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        return $result->getDeletedCount(); // Trả về số sách đã xóa
    }
}
