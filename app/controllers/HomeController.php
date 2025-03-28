<?php

class HomeController extends Controller {
  public function index()
    {
        // Load the Book model by calling loadModel() method which is inherited from Controller super class
        $bookModel = $this->loadModel("Book");
        // Retrieve all books from the model calling getAllBooks() method from Book class
        $books = $bookModel->getAllBooks();
        // Render the view with the list of books by calling renderView() method which is inherited from Controller super class
        $this->renderView('Home/Home', ["books" => $books]);
    }
}