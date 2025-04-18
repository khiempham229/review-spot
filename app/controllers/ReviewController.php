<?php

class ReviewController extends Controller
{
    public function index()
    {
        $reviewModel = $this->loadModel("Review");
        $categoryModel = $this->loadModel("Category");
        $brandModel = $this->loadModel("Brand");

        $categories = $categoryModel->getCategories();
        $brands = $brandModel->getBrands();

        // Kiểm tra nếu có bộ lọc category và brand
        $filterCategories = isset($_GET['categories']) ? $_GET['categories'] : [];
        $filterBrands = isset($_GET['brands']) ? $_GET['brands'] : [];

        $reviews = $reviewModel->getReviewsByFilter($filterCategories, $filterBrands);

        $this->renderView('Review/Reviews', [
            "reviews" => $reviews,
            "categories" => $categories,
            "brands" => $brands,
            "filterCategories" => $filterCategories,
            "filterBrands" => $filterBrands,
        ]);
    }

    public function addNewReview()
    {
        $brandModel = $this->loadModel("Brand");
        $categoryModel = $this->loadModel("Category");

        $brands = $brandModel->getBrands();
        $categories = $categoryModel->getCategories();

        $this->renderView('Review/AddReview', [
            "brands" => $brands,
            "categories" => $categories
        ]);
    }

    public function saveNewReview()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $reviewModel = $this->loadModel("Review");

            $productImage = null;
            if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
                $imageTmpPath = $_FILES['product_image']['tmp_name'];
                $imageName = $_FILES['product_image']['name'];
                $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);

                // Kiểm tra định dạng ảnh (chỉ chấp nhận jpg, png, jpeg)
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                if (!in_array(strtolower($imageExtension), $allowedExtensions)) {
                    $_SESSION['error'] = 'Vui lòng chọn ảnh có định dạng jpg, jpeg hoặc png!';
                    header("Location: /reviews/add");
                    exit();
                }

                // Lưu ảnh vào thư mục uploads
                $uploadDir = 'uploads/images/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $imagePath = $uploadDir . uniqid() . '.' . $imageExtension;
                move_uploaded_file($imageTmpPath, $imagePath);

                $productImage = '/' . $imagePath;
            }

            $isValidObjectId = function ($id) {
                return (strlen($id) === 24 && ctype_xdigit($id));
            };

            $reviewData = [
                "title" => $_POST["title"] ?? "",
                "content" => $_POST["content"] ?? "",
                "author_id" => $isValidObjectId($_SESSION['user']['id']) ? new MongoDB\BSON\ObjectId($_SESSION['user']['id']) : null,
                "status" => "pending", // Mặc định là "pending" khi mới tạo
                "approved_by" => null,
                "approved_at" => null,
                "brand_id" => $isValidObjectId($_POST["brand_id"]) ? new MongoDB\BSON\ObjectId($_POST["brand_id"]) : null,
                "category_ids" => array_map(fn($id) => new MongoDB\BSON\ObjectId($id), $_POST["category_ids"] ?? []),
                "product_name" => $_POST["product_name"] ?? "",
                "rating" => (int) ($_POST["rating"] ?? 0),
                "tags" => $_POST["tags"] ?? [],
                "comments_count" => 0,
                "likes_count" => 0,
                "product_id" => $isValidObjectId($_POST["product_id"]) ? new MongoDB\BSON\ObjectId($_POST["product_id"]) : null,
                "product_image" => $productImage,
                "created_at" => new MongoDB\BSON\UTCDateTime(),
                "updated_at" => new MongoDB\BSON\UTCDateTime()
            ];

            try {
                $reviewModel->addReview($reviewData);

                $_SESSION['success'] = 'Đã đăng bài thành công, đang đợi duyệt!';
                header("Location: /reviews/add");
                exit();
            } catch (Exception $e) {
                error_log("Error occurred while saving review: " . $e->getMessage());
                $_SESSION['error'] = 'Đã có lỗi xảy ra, đăng bài thất bại!';
                header("Location: /reviews/add");
                exit();
            }
        }
    }

    public function deleteReview($id)
    {
        $reviewModel = $this->loadModel("Review");
        $reviewModel->delete($id);
        header("Location: /reviews");
    }

    public function reviewById($id = null)
    {
        if ($id === null) {
            $_SESSION['error'] = 'Lỗi: ID rỗng!';
            header("Location: /reviews");
            exit();
        }

        $reviewModel = $this->loadModel("Review");
        $userModel = $this->loadModel("User");
        $brandModel = $this->loadModel("Brand");
        $categoryModel = $this->loadModel("Category");
        $commentModel = $this->loadModel("Comment");

        $review = $reviewModel->getReviewById($id);
        $author = $userModel->getUserById($review['author_id']);
        $brand = $brandModel->getBrandById($review['brand_id']);
        $categories = $categoryModel->getCategoriesByIds($review['category_ids']);
        $comments = $commentModel->getCommentsByReviewId($id);

        $createdAt = $review['created_at'];

        if ($createdAt instanceof MongoDB\BSON\UTCDateTime) {
            $dateTime = $createdAt->toDateTime();
            $formattedDate = $dateTime->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'))
                ->format('d/m/Y H:i');
        } else {
            $formattedDate = "Không xác định";
        }

        $review['comments'] = $comments;

        $this->renderView('Review/Details', [
            "review" => $review,
            "author" => $author,
            "brand" => $brand,
            "categories" => $categories,
            "formattedDate" => $formattedDate,
            "status" => statusLabel($review['status'])
        ], $review['title']);
    }

    public function updateReview($id)
    {
        $reviewModel = $this->loadModel("Review");
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $reviewModel->update($id, $_POST['title'], $_POST['author'], $_POST['isbn']);
            header("Location: /reviews");
        }
        $review = $reviewModel->getReviewById($id);
        $this->renderView('Review/UpdateReview', ["review" => $review]);
    }

    public function likeReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['review_id'])) {
            $reviewId = $_POST['review_id'];
            $userId = $_SESSION['user']['id'] ?? null;

            if (!$userId) {
                $_SESSION['error'] = "Bạn cần đăng nhập để thích bài đánh giá.";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $likeModel = $this->loadModel("Like");

            // Kiểm tra xem người dùng đã thích bài đánh giá chưa
            if (!$likeModel->isLikedByUser($reviewId, $userId)) {
                $likeModel->addLike($reviewId, $userId);
                $_SESSION['success'] = "Đã thích bài đánh giá!";
            } else {
                $_SESSION['error'] = "Bạn đã thích bài đánh giá này rồi.";
            }
        }

        // Quay lại trang bài đánh giá sau khi thích
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function addComment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['review_id']) && !empty($_POST['content'])) {
            $reviewId = $_POST['review_id'];
            $userId = $_SESSION['user']['id'] ?? null;
            $content = $_POST['content'];

            if (!$userId) {
                $_SESSION['error'] = "Bạn cần đăng nhập để bình luận.";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $commentModel = $this->loadModel("Comment");

            $commentModel->addComment($reviewId, $userId, $content);
            // $_SESSION['success'] = "Bình luận đã được thêm!";
        } else {
            $_SESSION['error'] = "Vui lòng nhập nội dung bình luận.";
        }

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
