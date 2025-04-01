<section class="container review-details-container">
  <div class="card">
    <div class="card-body px-4 py-5">
      <h1 class="card-title"><?= htmlspecialchars($review['title']) ?></h1>
      <p class="text-muted">Danh mục:
        <?php foreach ($categories as $category): ?>
          <span class="badge bg-primary"><?= htmlspecialchars($category['name']) ?></span>
        <?php endforeach; ?>
      </p>
      <p class="text-muted">
        Sản phẩm:
        <a href="#sua-rua-mat-cerave" target="_blank" class="text-primary fw-bold">
          <?= htmlspecialchars($review['product_name']) ?>
        </a>
      </p>
      <p class="text-muted">Người viết: <strong><?= htmlspecialchars($author['firstName'] . ' ' . $author['lastName']) ?></strong> | Ngày đăng: <strong><?= $formattedDate ?></strong> | Trạng thái: <strong><?= $status ?></strong></p>
      <p class="text-muted">
        Đánh giá:
        <?= str_repeat('⭐', $review['rating']) ?>
        <?= str_repeat('☆', 5 - $review['rating']) ?>
        (<?= $review['rating'] ?>/5)
      </p>
      <img src="<?= htmlspecialchars($review['product_image']) ?>" class="img-fluid mb-3" alt="<?= htmlspecialchars($review['product_name']) ?>">
      <p><?= nl2br(htmlspecialchars($review['content'])) ?></p>
      <div class="d-flex align-items-center pt-4">
        <form action="/reviews/like" method="POST" class="mb-0">
          <input type="hidden" name="review_id" value="<?= $review['_id'] ?>">
          <button type="submit" class="btn btn-outline-primary me-2">❤️ <?= $review['likes_count'] ?> Thích</button>
        </form>
        <button class="btn btn-outline-secondary">💬 <?= $review['comments_count'] ?> Bình luận</button>
      </div>
    </div>
  </div>

  <div class="card mt-4">
    <div class="card-header">Bình luận</div>
    <div class="card-body px-4 pb-5">
      <form action="/reviews/comment" method="POST">
        <input type="hidden" name="review_id" value="<?= $review['_id'] ?>">
        <div class="mb-3">
          <textarea name="content" class="form-control" placeholder="Viết bình luận..." required></textarea>
          <button type="submit" class="btn btn-primary mt-2">Gửi</button>
        </div>
      </form>
      <div class="list-group">
        <?php if (!empty($review['comments'])): ?>
          <?php foreach ($review['comments'] as $comment): ?>
            <div class="list-group-item">
              <strong><?= htmlspecialchars($comment['author_name']) ?></strong>: <?= htmlspecialchars($comment['content']) ?>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="text-muted">Chưa có bình luận nào.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>