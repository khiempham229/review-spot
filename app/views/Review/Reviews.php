<section class="container">
  <h1>Danh Sách Bài Review</h1>
  <div class="row align-items-center justify-content-between flex-xl-nowrap mt-5">
    <div class="col flex-grow-1">
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
    </div>
  </div>
</section>