<?php

class ReviewController extends Controller
{
    public function index()
    {
        $reviewModel = $this->loadModel("Review");
        $reviews = $reviewModel->getAllReviews();

        $this->renderView('Review/Review', ["reviews" => $reviews]);
    }

    public function addNewReview()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $reviewModel = $this->loadModel("Review");
            $reviewModel->addReview($_POST["title"], $_POST["author"], $_POST['isbn']);
            header('Location: ' . BASE_URL . 'reviews');
        }
        $this->renderView('Review/AddReview');
    }

    public function deleteReview($id)
    {
        $reviewModel = $this->loadModel("Review");
        $reviewModel->delete($id);
        header('Location: ' . BASE_URL . 'reviews');
    }

    public function reviewById($id)
    {
        $reviewModel = $this->loadModel("Review");
        $review = $reviewModel->getReviewById($id);
        $this->renderView('Review/Review', ["review" => $review], $review['title']);
    }

    public function updateReview($id)
    {
        $reviewModel = $this->loadModel("Review");
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $reviewModel->update($id, $_POST['title'], $_POST['author'], $_POST['isbn']);
            header('Location: ' . BASE_URL . 'reviews');
        }
        $review = $reviewModel->getReviewById($id);
        $this->renderView('Review/UpdateReview', ["review" => $review]);
    }
}
