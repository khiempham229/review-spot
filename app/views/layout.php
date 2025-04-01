<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-PDUiPu3vDllMfrUHnurV430Qg8chPZTNhY8RUpq89lq22R3PzypXQifBpcpE1eoB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="/public/assets/css/styles.css">
</head>

<body>
  <!-- sidebar is coming -->
  <!-- <div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
        <div class="sidebar-header border-bottom">
            <div class="sidebar-brand">
                LOGO
            </div>
            <button class="btn-close d-lg-none" type="button" data-coreui-dismiss="offcanvas" data-coreui-theme="dark"
                aria-label="Close"
                onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"></button>
        </div>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
            <li class="nav-item"><a class="nav-link" href="/">
                    <i class="fa-solid fa-house"></i>&nbsp; Trang Chủ</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#"> Thống Kê Báo Cáo</a>
            </li>
            <li class="nav-group">
                <a class="nav-link nav-group-toggle" href="#">
                    Quản Lý Đào Tạo</a>
                <ul class="nav-group-items compact">
                    <li class="nav-item"><a class="nav-link" href="/quan-ly-khoa"><span class="nav-icon"><span
                                    class="nav-icon-bullet"></span></span> Quản Lý Khoa</a></li>
                </ul>
            </li>
            <li class="nav-group">
                <a class="nav-link nav-group-toggle" href="#">
                    Quản Lý Nhân Sự</a>
                <ul class="nav-group-items compact">
                    <li class="nav-item"><a class="nav-link" href="/quan-ly-giang-vien"><span class="nav-icon"><span
                                    class="nav-icon-bullet"></span></span> Quản Lý Giảng Viên </a></li>
                    <li class="nav-item"><a class="nav-link" href="/quan-ly-sinh-vien"><span class="nav-icon"><span
                                    class="nav-icon-bullet"></span></span> Quản Lý Sinh Viên</a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="/quan-ly-de-tai">Quản Lý Đề Tài</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="/quan-ly-do-an">Quản Lý Đồ Án</a>
            </li>

            <div class="sidebar-footer border-top d-none d-md-flex">
                <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
            </div>
    </div> -->
  <div class="wrapper d-flex flex-column justify-content-between min-vh-100">
    <header class="header header-sticky p-0 bg-primary border-0">
      <div class="container">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-between flex-nowrap">
            <div class="col-auto">
              <a class="header-brand" href="/">
                <!-- <img src="/assets/brand/coreui-signet.svg" alt="" width="22" height="24" class="d-inline-block align-top" alt="CoreUI Logo"> -->
                LOGO
              </a>
              <button class="header-toggler" type="button"
                onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"
                style="margin-inline-start: -14px;">
                <i class="fa-solid fa-bars"></i>
              </button>
            </div>
            <div class="col">
              <ul class="header-nav mr-auto justify-content-center">
                <li class="nav-item">
                  <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/') ? 'active' : '' ?>" href="/">Trang Chủ</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?= (strpos(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/reviews') === 0) ? 'active' : '' ?>" href="/reviews">Reviews</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/products') ? 'active' : '' ?>" href="/products">Sản Phẩm</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/categories') ? 'active' : '' ?>" href="/categories">Danh Mục</a>
                </li> -->
                <li class="nav-item">
                  <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/contact') ? 'active' : '' ?>" href="/#contact-us">Liên Hệ</a>
                </li>
                <!-- <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="headerDropdown" role="button" data-coreui-toggle="dropdown" aria-expanded="false">
                    Dropdown
                  </a>
                  <div class="dropdown-menu" aria-labelledby="headerDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </li> -->
              </ul>

            </div>
            <div class="col-auto">
              <div class="d-flex justify-content-end gap-3">
                <div class="dropdown account">
                  <a class="nav-link py-0 pe-0 d-flex align-items-center gap-2" data-coreui-toggle="dropdown" href=""
                    role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md bg-primary border pt-2 px-1">
                      <img class="avatar-img" src="<?= empty($_SESSION["user"]) ? '/public/assets/images/user.png' : $_SESSION["user"]["avatar"] ?>" alt="user">
                    </div>
                    <span>
                      <?=
                      (!empty($_SESSION["user"]) ? $_SESSION["user"]["fullName"] : 'Tài khoản');
                      ?>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <?php if (empty($_SESSION["user"])): ?>
                      <li><a class="dropdown-item" href="/login">Đăng nhập</a></li>
                    <?php else: ?>
                      <li><a class="dropdown-item" href="#profile">Hồ sơ cá nhân</a></li>
                      <?php if ($_SESSION["user"]["role"] == "admin"): ?>
                        <li><a class="dropdown-item" href="/admin">Admin</a></li>
                      <?php endif; ?>
                      <li><a class="dropdown-item" href="/reviews/add">Viết bài Review</a></li>
                      <li>
                        <hr class="dropdown-divider">
                      </li>
                      <li><a class="dropdown-item" href="/logout">Đăng xuất</a></li>
                    <?php endif; ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <main class="d-flex flex-column flex-grow-1">
      <!-- This line includes the PHP file located at '../app/views/' followed by the value of the $viewPath variable and '.php' extension. -->
      <?php require_once __DIR__ . '/' . $viewPath . '.php'; ?>
    </main>


    <footer class="footer px-4 bg-primary border-0">
      <div class="container">
        <p class="text-center mb-0">
          &copy; Copyright by Ngo Ngo. <?php isset($_SESSION['error']) && $_SESSION['error'] ?>
        </p>
      </div>
    </footer>
  </div>

  <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
    <div class="toast-container position-fixed top-0 end-0 p-3">
      <div class="toast" id="coreuiToast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <div class="rounded me-2 <?= isset($_SESSION['error']) ? 'bg-danger' : 'bg-success' ?>" style="width: 20px; height: 20px;"></div>
          <strong class="me-auto">Thông Báo</strong>
          <button type="button" class="btn-close" data-coreui-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          <?= isset($_SESSION['error']) ? $_SESSION['error'] : $_SESSION['success']; ?>
        </div>
      </div>
    </div>
    <?php unset($_SESSION['success']);
    unset($_SESSION['error']); ?>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/js/coreui.bundle.min.js" integrity="sha384-8QmUFX1sl4cMveCP2+H1tyZlShMi1LeZCJJxTZeXDxOwQexlDdRLQ3O9L78gwBbe" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="/public/assets/js/main.js"></script>
  <script>
    $(document).ready(function() {
      const toastEl = $('#coreuiToast');

      if (toastEl.length) {
        const coreuiToast = new coreui.Toast(toastEl);
        coreuiToast.show();
      }
    })
  </script>
</body>

</html>