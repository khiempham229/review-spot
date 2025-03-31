<?php
// Giả sử bạn đã load danh sách thương hiệu và danh mục từ database
$brands = (new Brand())->getBrands();
$categories = (new Category())->getCategories();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm Đánh Giá</title>
    
    <!-- CoreUI & Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.0.0/dist/css/coreui.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- Font Awesome (cho rating stars) -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        .rating-stars input {
            display: none;
        }
        .rating-stars label {
            font-size: 24px;
            color: gray;
            cursor: pointer;
        }
        .rating-stars input:checked ~ label {
            color: gold;
        }
    </style>
</head>
<body class="c-app">
    <div class="c-wrapper">
        <div class="c-body">
            <main class="c-main">
                <div class="container">
                    <div class="card mt-4">
                        <div class="card-header">
                            <h3>Thêm Đánh Giá</h3>
                        </div>
                        <div class="card-body">
                            <form action="save_review.php" method="POST">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Tiêu đề</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>

                                <div class="mb-3">
                                    <label for="product_name" class="form-label">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="brand_id" class="form-label">Thương hiệu</label>
                                    <select class="form-select" id="brand_id" name="brand_id" required>
                                        <option value="">Chọn thương hiệu</option>
                                        <?php foreach ($brands as $brand) : ?>
                                            <option value="<?= $brand['_id'] ?>"><?= htmlspecialchars($brand['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="category_ids" class="form-label">Danh mục</label>
                                    <select class="form-select select2" id="category_ids" name="category_ids[]" multiple="multiple" required>
                                        <?php foreach ($categories as $category) : ?>
                                            <option value="<?= $category['_id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="rating" class="form-label">Đánh giá</label>
                                    <div class="rating-stars">
                                        <?php for ($i = 5; $i >= 1; $i--) : ?>
                                            <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>">
                                            <label for="star<?= $i ?>"><i class="fas fa-star"></i></label>
                                        <?php endfor; ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">Nội dung</label>
                                    <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Lưu</button>
                                <a href="/reviews" class="btn btn-secondary">Hủy</a>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.0.0/dist/js/coreui.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Chọn danh mục",
                allowClear: true
            });
        });
    </script>
</body>
</html>
