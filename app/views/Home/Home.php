<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<section class="container-fluid introduce-container">
  <div class="row">
    <div class="col-7 p-0 pe-4">
      <div id="carouselBanner" class="carousel slide banner-carousel" data-coreui-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="/public/assets/images/banner-1.jpg" class="d-block w-100" alt="banner-1">
          </div>
          <div class="carousel-item">
            <img src="/public/assets/images/banner-2.jpg" class="d-block w-100" alt="banner-2">
          </div>
          <div class="carousel-item">
            <img src="/public/assets/images/banner-3.webp" class="d-block w-100" alt="banner-3">
          </div>
          <div class="carousel-item">
            <img src="/public/assets/images/banner-4.jpg" class="d-block w-100" alt="banner-4">
          </div>
          <div class="carousel-item">
            <img src="/public/assets/images/banner-5.jpg" class="d-block w-100" alt="banner-5">
          </div>
        </div>
      </div>
    </div>
    <div class="col-5 p-0">
      <div class="container introduction-description">
        <h1 class="text-center">Review Spot</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus doloremque quis officiis nemo consequatur ducimus eaque, adipisci, dolores provident laudantium amet facere in modi optio, officia quisquam natus sunt inventore?</p>
      </div>
    </div>
  </div>
</section>

<section class="container">
  <h2>Bài Viết Mới Nhất</h2>
  <div class="row align-items-center justify-content-between flex-xl-nowrap mt-5">
    <div class="col flex-grow-1">
      <div class="row row-cols-4">
        <?php foreach ($latestReviews as $review): ?>
          <div class="col">
            <div class="card review-card">
              <img src="<?= htmlspecialchars($review['product_image']) ?>" class="card-img-top" alt="srm-cerave">
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
    <!-- <div class="col-auto">
      <a href="#" class="btn btn-primary">Xem Tất Cả</a>
    </div> -->
  </div>
</section>

<section class="container">
  <h2>Bài Viết Nổi Bật</h2>
  <div class="row align-items-center justify-content-between flex-xl-nowrap mt-5">
    <div class="col flex-grow-1">
      <div class="row row-cols-4">
        <?php foreach ($mostLikedReviews as $review): ?>
          <div class="col">
            <div class="card review-card">
              <img src="<?= htmlspecialchars($review['product_image']) ?>" class="card-img-top" alt="srm-cerave">
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
    <!-- <div class="col-auto">
      <a href="#" class="btn btn-primary">Xem Tất Cả</a>
    </div> -->
  </div>
</section>

<section class="container">
  <h2>Thương Hiệu Nổi Tiếng</h2>
  <div class="row align-items-center justify-content-between flex-xl-nowrap mt-5">
    <div class="swiper">
      <div class="swiper-wrapper align-items-center gap-5">
        <?php foreach ($brands as $brand): ?>
          <div class="swiper-slide">
            <a href="<?= '/reviews?brands%5B%5D=' . urlencode($brand['_id']) ?>">
              <img src="<?= htmlspecialchars($brand['logo']) ?>" alt="<?= htmlspecialchars($brand['name']) ?>" title="<?= htmlspecialchars($brand['description']) ?>">
            </a>
          </div>
        <?php endforeach; ?>
      </div>
      <!-- <div class="swiper-pagination"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div> -->
    </div>
  </div>
</section>

<section class="container">
  <h2>Một Số Danh Mục</h2>
  <div class="row align-items-center justify-content-between flex-xl-nowrap mt-5">
    <div class="swiper">
      <div class="swiper-wrapper align-items-center gap-3">
        <?php foreach ($categories as $caterogy): ?>
          <div class="swiper-slide text-center bg-primary rounded-5">
            <a href="<?= '/reviews?categories%5B%5D=' . urlencode($caterogy['_id']) ?>" class="text-uppercase text-decoration-none text-black text-center d-block py-3" style="font-size: 2rem">
              <b><?= htmlspecialchars($caterogy['name']) ?></b>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<section id="contact-us" class="container my-5 border-top">
  <h2 class="mb-3">Liên Hệ Với Chúng Tôi</h2>
  <p>Chúng tôi luôn sẵn sàng hỗ trợ bạn! Hãy để lại thông tin dưới đây, và chúng tôi sẽ trả lời bạn trong thời gian sớm nhất.</p>

  <div class="row mt-5">
    <div class="col-md-6">
      <h3 class="mb-3">Thông Tin Liên Hệ</h3>
      <p><strong>Địa chỉ:</strong> 123 Đường 30/4, Quận Ninh Kiều, Cần Thơ</p>
      <p><strong>Email:</strong> support@example.com</p>
      <p><strong>Điện thoại:</strong> 0123456789</p>
    </div>
    <div class="col-md-6">
      <form method="POST">
        <div class="mb-3">
          <label for="name" class="form-label">Họ Tên</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
          <label for="message" class="form-label">Tin Nhắn</label>
          <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Gửi</button>
      </form>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper(".swiper", {
    loop: true,
    slidesPerView: 3,
    spaceBetween: 16,
    autoplay: {
      delay: 2000,
      disableOnInteraction: false
    },
    // pagination: {
    //   el: ".swiper-pagination",
    //   clickable: true
    // },
    // navigation: {
    //   nextEl: ".swiper-button-next",
    //   prevEl: ".swiper-button-prev"
    // },
    breakpoints: {
      768: {
        slidesPerView: 3
      },
      1024: {
        slidesPerView: 4
      }
    }
  });
</script>