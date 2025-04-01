<div class="container">
  <div class="card mt-4">
    <div class="card-header">
      <h3>Thêm Đánh Giá</h3>
    </div>
    <div class="card-body">
      <form action="/reviews/save-new-review" method="POST">
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
          <select class="form-select select2" id="category_ids" name="category_ids[]" multiple required>
            <?php foreach ($categories as $category) : ?>
              <option value="<?= $category['_id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="rating" class="form-label">Đánh giá</label>
          <div class="rating-stars">
            <?php for ($i = 1; $i <= 5; $i++) : ?>
              <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>">
              <label for="star<?= $i ?>"><i class="fas fa-star"></i></label>
            <?php endfor; ?>
          </div>
        </div>

        <div class="mb-3">
          <label for="content" class="form-label">Nội dung</label>
          <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="/reviews" class="btn btn-secondary">Hủy</a>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.select2').select2({
      placeholder: "Chọn danh mục",
      allowClear: true
    });
  });
</script>