<?php
require 'config.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-PDUiPu3vDllMfrUHnurV430Qg8chPZTNhY8RUpq89lq22R3PzypXQifBpcpE1eoB" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/css/styles.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
  <!-- <?php
        include('./includes/sidebar.php');
        ?> -->
  <div class="wrapper d-flex flex-column justify-content-between min-vh-100">
    <?php
    include('./includes/header.php');
    ?>

    <main class="content flex-grow-1 mb-4">
      <div class="container banner">
        <div id="carouselExampleDark" class="carousel carousel-dark slide">
          <div class="carousel-indicators">
            <button type="button" data-coreui-target="#carouselExampleDark" data-coreui-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-coreui-target="#carouselExampleDark" data-coreui-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-coreui-target="#carouselExampleDark" data-coreui-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active" data-coreui-interval="10000">
              <img src="/assets/images/multiple-payment-options.png" class="bd-placeholder-img-lg d-block w-100" alt="...">

              <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
              </div>
            </div>
            <div class="carousel-item" data-coreui-interval="2000">
              <img src="/assets/images/multiple-payment-options.png" class="bd-placeholder-img-lg d-block w-100" alt="...">

              <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content for the second slide.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="/assets/images/multiple-payment-options.png" class="bd-placeholder-img-lg d-block w-100" alt="...">

              <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-coreui-target="#carouselExampleDark" data-coreui-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-coreui-target="#carouselExampleDark" data-coreui-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>

      <div class="container row-product top-trending-products mt-5">
        <h2>Top trending</h2>
        <div class="text-center">
          <div class="row row-cols-4">
            <div class="col">Column 1</div>
            <div class="col">Column 2</div>
            <div class="col">Column 3</div>
            <div class="col">Column 4</div>
          </div>
        </div>
      </div>

      <div class="container row-product newest-products mt-5">
        <h2>Newest</h2>
        <div class="text-center">
          <div class="row row-cols-4">
            <div class="col">Column 1</div>
            <div class="col">Column 2</div>
            <div class="col">Column 3</div>
            <div class="col">Column 4</div>
          </div>
        </div>
      </div>

      <div class="container row-product list-products mt-5">
        <h2>List Product</h2>
        <div class="text-center">
          <div class="row row-cols-4">
            <div class="col">Column 1</div>
            <div class="col">Column 2</div>
            <div class="col">Column 3</div>
            <div class="col">Column 4</div>
            <div class="col">Column 5</div>
            <div class="col">Column 6</div>
            <div class="col">Column 7</div>
            <div class="col">Column 8</div>
            <div class="col">Column 9</div>
            <div class="col">Column 10</div>
            <div class="col">Column 11</div>
            <div class="col">Column 12</div>
          </div>
          <button type="button" class="btn btn-link">See More</button>
        </div>
      </div>
    </main>

    <?php
    include('./includes/footer.php');
    ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/js/coreui.bundle.min.js" integrity="sha384-8QmUFX1sl4cMveCP2+H1tyZlShMi1LeZCJJxTZeXDxOwQexlDdRLQ3O9L78gwBbe" crossorigin="anonymous"></script>
</body>
<script src="https://cdn.jsdelivr.net/npm/@preline/dropdown@3.0.1/index.min.js"></script>


</html>