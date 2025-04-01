<?php

class User
{
    private $collection;

    public function __construct()
    {
        $database = new Database();
        $this->collection = $database->getConnection()->users;

        if (!$this->collection) {
            die("Kết nối tới collection users thất bại");
        }
    }

    public function createUser($email, $password, $firstName, $lastName)
    {
        try {
            $now = new MongoDB\BSON\UTCDateTime();
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $role = 'user'; // admin | reviewer | user
            $status = 'active'; // active | deactive

            $result = $this->collection->insertOne([
                'email' => $email,
                'password' => $hashedPassword,
                'role' => $role,
                'status' => $status,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            return $result->getInsertedId();
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return false;
        }
    }

    public function findUser($key, $value)
    {
        return $this->collection->findOne([$key => $value]);
    }

    // Cập nhật thông tin người dùng
    public function updateUser($userId, $data)
    {
        try {
            $data['updated_at'] = new MongoDB\BSON\UTCDateTime();

            $result = $this->collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($userId)],
                ['$set' => $data]
            );

            return $result->getModifiedCount() > 0;
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return false;
        }
    }

    // Vô hiệu hóa tài khoản
    public function deactivateUser($userId)
    {
        return $this->updateUser($userId, ['status' => 'deactive']);
    }

    // Lấy chi tiết một người dùng
    public function getUserById($userId)
    {
        try {
            return $this->collection->findOne(['_id' => new MongoDB\BSON\ObjectId($userId)]);
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return null;
        }
    }

    // Lấy danh sách người dùng (có thể lọc)
    public function getUsers($filter = [])
    {
        try {
            return $this->collection->find($filter)->toArray();
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return [];
        }
    }

    // Hàm login: Kiểm tra email và mật khẩu
    public function login($email, $password)
    {
        try {
            $user = $this->findUser('email', $email); // Tìm người dùng theo email

            if ($user) {
                // Kiểm tra mật khẩu
                if (password_verify($password, $user['password'])) {
                    return [
                        'status' => 'success',
                        'user' => $user // Trả về thông tin người dùng
                    ];
                } else {
                    return [
                        'status' => 'error',
                        'message' => 'Mật khẩu không chính xác'
                    ];
                }
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Email không tồn tại'
                ];
            }
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return [
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi khi đăng nhập'
            ];
        }
    }
}
