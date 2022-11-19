<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rentcam</title>
  <!-- menyisipkan bootstrap -->
  <?php require_once("style.php"); ?>
  
</head>

<body bg-colour="fff">
  <?php require_once("header.php"); ?>
  <header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="assets/img/dash1.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="assets/img/dash2.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="assets/img/dash3.jpg" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </header>
  <!-- categories -->
  <section class="container py-5">
    <div class="row justify-content-center px-4 my-3">
      <form class="form-inline my-2 my-lg-0 pr-4">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
    <div class="row text-center pt-3">
      <div class="col-lg-6 m-auto">
        <h1 class="h1">Categories</h1>
        <p>

        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-4 p-5 mt-3">
        <a href="Catalog.php?kategori=kamera"><img src="./assets/img/Fujifilm.jpg" class="rounded-circle img-fluid border"></a>
        <h2 class="text-center mt-3 mb-3">Camera</h2>
      </div>
      <div class="col-12 col-md-4 p-5 mt-3">
        <a href="Catalog.php?kategori=lensa"><img src="./assets/img/Lens.jpg" class="rounded-circle img-fluid border"></a>
        <h2 class="text-center mt-3 mb-3">Lens</h2>
      </div>
      <div class="col-12 col-md-4 p-5 mt-3">
        <a href="Catalog.php?kategori=aksessoris"><img src="./assets/img/accessories1.jpg" class="rounded-circle img-fluid border"></a>
        <h2 class="text-center mt-3 mb-3">Accessories</h2>
      </div>
    </div>
  </section>
  <?php require_once("footer.php"); ?>
  <?php require_once("scripts.php"); ?>

</body>

</html>