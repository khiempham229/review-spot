<?php

class HomeController extends Controller
{
  public function index()
  {
    $reviewModel = $this->loadModel("Review");
    $reviews = $reviewModel->getAllReviews();

    $brandModel = $this->loadModel("Brand");
    $brands = $brandModel->getBrands();

    $categoryModel = $this->loadModel("Category");
    $categories = $categoryModel->getCategories();

    $this->renderView('Home/Home', [
      "reviews" => $reviews,
      "brands" => $brands,
      "categories" => $categories
    ]);
  }
}
