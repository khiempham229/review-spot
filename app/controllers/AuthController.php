<?php

class AuthController extends Controller
{
    public function index()
    {
        $this->renderView('login');
    }

    public function signup()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = strtolower(trim($_POST['email'])) ?? '';
            $password = trim($_POST['password']) ?? '';
            $firstName = isset($_POST['firstName']) && trim($_POST['firstName']) ? trim($_POST['firstName']) : $email;
            $lastName = trim($_POST['lastName']) ?? '';

            if (!isNotEmptyFields([$email, $password])) {
                $_SESSION['error'] = 'Email và mật khẩu không được để trống!';
                header("Location: /login");
                exit;
            }

            $userModel = $this->loadModel('User');

            if (!$userModel) {
                die("Không thể load model User");
            }

            if ($userModel->findUser('email', $email)) {
                $_SESSION['error'] = 'Email đã được sử dụng!';
                header("Location: /login");
                exit;
            }

            if ($userModel->createUser($email, $password, $firstName, $lastName)) {
                $_SESSION['success'] = 'Đăng ký tài khoản thành công!';
                header("Location: /login");
                exit;
            } else {
                $_SESSION['error'] = 'Đăng ký thất bại, thử lại sau';
                header("Location: /login");
                exit;
            }
        } else {
            header("Location: /login");
            exit;
        }
    }

    public function signin()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (!isNotEmptyFields([$email, $password])) {
                $_SESSION['error'] = 'Email và mật khẩu không được để trống!';
                header("Location: /login");
                exit;
            }

            $userModel = $this->loadModel('User');

            $user = $userModel->findUser('email', $email);

            if ($user && password_verify($password, $user['password'])) {
                if ($user['status'] !== 'active') {
                    $_SESSION['error'] = 'Tài khoản của bạn đã bị vô hiệu hóa!';
                    header("Location: /login");
                    exit;
                }

                $_SESSION['user'] = [
                    'id' => (string)$user['_id'],
                    'email' => $user['email'],
                    'firstName' => $user['firstName'],
                    'lastName' => $user['lastName'],
                    'fullName' => $user['firstName'] . " " . $user['lastName'],
                    'role' => $user['role'],
                    'status' => $user['status'],
                    'avatar' => $user['avatar'] ?? '/public/assets/images/user.png',
                    'bio' => $user['bio'] ?? '',
                ];

                $_SESSION['success'] = 'Đăng nhập thành công!';
                header("Location: /");
                exit;
            } else {
                $_SESSION['error'] = 'Email hoặc mật khẩu không đúng!';
                header("Location: /login");
                exit;
            }
        } else {
            header("Location: /login");
            exit;
        }
    }


    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /login");
        exit;
    }
}
