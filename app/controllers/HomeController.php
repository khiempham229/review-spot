<?php

class HomeController extends Controller
{
  public function index()
  {
    $reviewModel = $this->loadModel("Review");
    $reviews = $reviewModel->getAllReviews();

    $this->renderView('Home/Home', ["reviews" => $reviews]);
  }
}
