<?php

class HomeController extends Controller
{
  public function index()
  {
    $reviewModel = $this->loadModel("Review");
    $reviews = $reviewModel->getAllReviews();
    $latestReviews = $reviewModel->getLatestReviews(5);
    $mostLikedReviews = $reviewModel->getMostLikedReviews(5);

    $brandModel = $this->loadModel("Brand");
    $brands = $brandModel->getBrands();

    $categoryModel = $this->loadModel("Category");
    $categories = $categoryModel->getCategories();

    $this->renderView('Home/Home', [
      "reviews" => $reviews,
      "latestReviews" => $latestReviews,
      "mostLikedReviews" => $mostLikedReviews,
      "brands" => $brands,
      "categories" => $categories
    ]);
  }
}
