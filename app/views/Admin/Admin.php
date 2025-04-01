<section class="container">
  <?php if (!empty($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
    <h1>Quản Lý Bài Viết</h1>
    <div class="row align-items-center justify-content-between flex-xl-nowrap mt-5">
      <div class="table-container">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tiêu Đề</th>
              <th scope="col">Tác Giả</th>
              <th scope="col">Trạng Thái</th>
              <th scope="col">Ngày Tạo</th>
              <th scope="col">Thao Tác</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($reviews as $index => $review): ?>
              <tr>
                <th scope="row"><?= $index + 1 ?></th>
                <td><?= htmlspecialchars($review['title']) ?></td>
                <td><?= htmlspecialchars($review['author_name'] ?? 'Chưa xác định') ?></td> <!-- Kiểm tra sự tồn tại của author_name -->
                <td>
                  <span class="badge 
                <?= ($review['status'] == 'approved') ? 'bg-success' : ($review['status'] == 'pending' ? 'bg-warning' : 'bg-danger') ?>">
                    <?= $review['status'] ?>
                  </span>
                </td>
                <td><?= date("d-m-Y H:i:s", strtotime($review['created_at'])) ?></td>
                <td>
                  <!-- Các nút chỉnh sửa trạng thái -->
                  <a href="/admin/updateStatus/<?= $review['_id'] ?>/approved" class="btn btn-success btn-sm">Duyệt</a>
                  <a href="/admin/updateStatus/<?= $review['_id'] ?>/canceled" class="btn btn-danger btn-sm">Từ Chối</a>
                  <a href="/admin/deleteReview/<?= $review['_id'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php else: ?>
    <h1>Bạn không có quyền truy cập!</h1>
  <?php endif; ?>
</section>