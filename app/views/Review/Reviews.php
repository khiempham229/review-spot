<section class="container">
  <form method="GET" action="/reviews" id="filterForm">
    <div class="filter-container mb-4">
      <label for="categories">Chọn Danh Mục:</label>
      <select id="categories" name="categories[]" class="form-control select2" multiple="multiple">
        <option value="" <?= in_array('', $filterCategories) || empty($filterCategories) ? 'selected' : '' ?>>Tất Cả Danh Mục</option>
        <?php foreach ($categories as $category): ?>
          <option value="<?= htmlspecialchars($category['_id']) ?>"
            <?= in_array($category['_id'], $filterCategories) ? 'selected' : '' ?>>
            <?= htmlspecialchars($category['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label for="brands" class="mt-3">Chọn Thương Hiệu:</label>
      <select id="brands" name="brands[]" class="form-control select2" multiple="multiple">
        <option value="" <?= in_array('', $filterBrands) || empty($filterBrands) ? 'selected' : '' ?>>Tất Cả Thương Hiệu</option>
        <?php foreach ($brands as $brand): ?>
          <option value="<?= htmlspecialchars($brand['_id']) ?>"
            <?= in_array($brand['_id'], $filterBrands) ? 'selected' : '' ?>>
            <?= htmlspecialchars($brand['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <button class="btn btn-primary mt-3" type="submit" id="filterBtn">Lọc</button>
    </div>
  </form>

  <h1 class="my-5">Danh Sách Bài Review</h1>
  <div class="row align-items-center justify-content-between flex-xl-nowrap">
    <div class="col flex-grow-1">
      <?php if (empty($reviews)): ?>
        <!-- Hiển thị thông báo nếu không có bài review nào -->
        <div class="alert alert-warning" role="alert">
          Không có bài review nào cho danh mục hoặc thương hiệu đã chọn.
        </div>
      <?php else: ?>
        <div class="row row-cols-4 row-gap-4">
          <?php foreach ($reviews as $review): ?>
            <div class="col">
              <div class="card review-card">
                <img src="/public/assets/images/srm-cerave.png" class="card-img-top" alt="srm-cerave">
                <div class="card-body">
                  <h5 class="card-title truncate"><?= htmlspecialchars($review['title']) ?></h5>
                  <p class="card-subtitle mb-3 text-body-secondary"><?= htmlspecialchars($review['product_name']) ?></p>
                  <p class="card-text truncate line-clamp-3"><?= htmlspecialchars($review['content']) ?></p>
                  <a href="/reviews/details/<?= $review['_id'] ?>" class="btn btn-primary">Đọc Thêm</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('.select2').select2({
        allowClear: true
      });

      const allValue = ''

      $('#categories').on('select2:select', (event) => {
          const currentSelectedValue = event.params.data.id
          let value = event.target.value

          if (currentSelectedValue == allValue) {
            value = [allValue]
          } else {
            const removeAllOption = $('#categories')
              .select2('val')
              .filter((o) => o != allValue)

            value = removeAllOption
          }

          console.log(value)

          $('#categories').val(value).trigger('change');
        })
        .on('select2:unselect', (event) => {
          const currentSelectedValue = event.params.data.id

          let value = $('#categories').select2('val')

          if (value.length == 0) {
            value = sIdOptionAll
          }
        })

      $('#brands').on('select2:select', (event) => {
          const currentSelectedValue = event.params.data.id
          let value = event.target.value

          if (currentSelectedValue == allValue) {
            value = [allValue]
          } else {
            const removeAllOption = $('#brands')
              .select2('val')
              .filter((o) => o != allValue)

            value = removeAllOption
          }

          console.log(value)

          $('#brands').val(value).trigger('change');
        })
        .on('select2:unselect', (event) => {
          const currentSelectedValue = event.params.data.id

          let value = $('#brands').select2('val')

          if (value.length == 0) {
            value = sIdOptionAll
          }
        })
    });
  </script>
</section>