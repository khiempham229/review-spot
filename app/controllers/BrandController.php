<?php

class BrandController extends Controller
{
    public function index()
    {
        $brandModel = $this->loadModel("Brand");
        $brands = $brandModel->getAllBrands();

        $this->renderView('Brand/Brands', ["brands" => $brands]);
    }

    public function addNewBrand()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $brandModel = $this->loadModel("Brand");
            $brandModel->addBrand($_POST["name"], $_POST["description"], $_POST['country'], $_POST['logo']);
            header("Location: /brands");
        }
        $this->renderView('Brand/AddBrand');
    }

    public function deleteBrand($id)
    {
        $brandModel = $this->loadModel("Brand");
        $brandModel->delete($id);
        header("Location: /brands");
    }

    public function brandById($id = null)
    {
        if ($id === null) {
            $_SESSION['error'] = 'Lỗi: ID rỗng!';
            header("Location: /brands");
            exit();
        }

        $brandModel = $this->loadModel("Brand");
        $brand = $brandModel->getBrandById($id);
        $this->renderView('Brand/Details', ["brand" => $brand], $brand['name']);
    }

    public function updateBrand($id)
    {
        $brandModel = $this->loadModel("Brand");
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $brandModel->update($id, $_POST['name'], $_POST['description'], $_POST['country'], $_POST['logo']);
            header("Location: /brands");
        }
        $brand = $brandModel->getBrandById($id);
        $this->renderView('Brand/UpdateBrand', ["brand" => $brand]);
    }
}
