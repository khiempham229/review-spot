<?php

class CategoryController extends Controller
{
    public function index()
    {
        $categoryModel = $this->loadModel("Category");
        $categories = $categoryModel->getAllCategories();

        $this->renderView('Category/Categories', ["categories" => $categories]);
    }

    public function addNewCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $categoryModel = $this->loadModel("Category");
            $categoryModel->addCategory($_POST["name"], $_POST["description"], $_POST['parent_id']);
            header("Location: /categories");
        }
        $this->renderView('Category/AddCategory');
    }

    public function deleteCategory($id)
    {
        $categoryModel = $this->loadModel("Category");
        $categoryModel->delete($id);
        header("Location: /categories");
    }

    public function categoryById($id = null)
    {
        if ($id === null) {
            $_SESSION['error'] = 'Lỗi: ID rỗng!';
            header("Location: /categories");
            exit();
        }

        $categoryModel = $this->loadModel("Category");
        $category = $categoryModel->getCategoryById($id);
        $this->renderView('Category/Details', ["category" => $category], $category['name']);
    }

    public function updateCategory($id)
    {
        $categoryModel = $this->loadModel("Category");
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $categoryModel->update($id, $_POST['name'], $_POST['description'], $_POST['parent_id']);
            header("Location: /categories");
        }
        $category = $categoryModel->getCategoryById($id);
        $this->renderView('Category/UpdateCategory', ["category" => $category]);
    }
}
