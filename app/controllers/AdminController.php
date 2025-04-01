<?php

class AdminController extends Controller
{
  public function index()
  {
    $reviewModel = $this->loadModel("Review");
    $reviews = $reviewModel->getAllReviews();

    $brandModel = $this->loadModel("Brand");
    $brands = $brandModel->getBrands();

    $categoryModel = $this->loadModel("Category");
    $categories = $categoryModel->getCategories();

    $userModel = $this->loadModel("User");

    foreach ($reviews as &$review) {
      if (isset($review['author_id'])) {
        $author = $userModel->getUserById($review['author_id']);
        $review['author_name'] = $author ? $author['firstName'] . ' ' . $author['lastName'] : 'Chưa xác định';
      } else {
        $review['author_name'] = 'Chưa xác định';
      }
    }

    $this->renderView('Admin/Admin', [
      "reviews" => $reviews,
      "brands" => $brands,
      "categories" => $categories
    ]);
  }

  public function updateStatus($reviewId, $status)
  {
    if (empty($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
      $_SESSION['error'] = 'Bạn không có quyền truy cập!';
      header('Location: /login');
      exit();
    }

    $reviewModel = $this->loadModel("Review");
    $reviewModel->updateReviewStatus($reviewId, $status);

    $_SESSION['success'] = 'Cập nhật trạng thái thành công!';
    header('Location: /admin');
    exit();
  }

  public function deleteReview($reviewId)
  {
    if (empty($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
      $_SESSION['error'] = 'Bạn không có quyền truy cập!';
      header('Location: /login');
      exit();
    }

    $reviewModel = $this->loadModel("Review");
    $reviewModel->deleteReviewById($reviewId);

    $_SESSION['success'] = 'Xóa bài thành công!';
    header('Location: /admin');
    exit();
  }
}
