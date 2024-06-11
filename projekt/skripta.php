<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
      rel="shortcut icon"
      href="../projekt/images/favicon.ico"
      type="image/x-icon"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Sportify</title>
  </head>
  <body>
  <header>
      <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
          <div class="col-12 text-center">
            <a class="navbar-brand" href="index.php">
              <img
                class=""
                src="../projekt/images/Sportify_logo.png"
                alt="Logo"
              />
            </a>
          </div>
          <div class="col">
            <nav class="navbar navbar-expand-md">
              <div class="container-fluid">
                <button
                  class="navbar-toggler"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#navbarNav"
                  aria-controls="navbarNav"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
                >
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div
                  class="collapse navbar-collapse justify-content-center"
                  id="navbarNav"
                >
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link p-3" href="index.php"
                        >Početna</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link p-3" href="kategorija.php?kategorija=nogomet">Nogomet</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link p-3" href="kategorija.php?kategorija=košarka">Košarka</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link p-3" href="unos.php">Unos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link p-3" href="administracija.php">Administracija</a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </header>
    <!-- ČLANAK -->
    <?php 
        $title = $_GET['title'] ?? '';
        $about = $_GET['about'] ?? '';
        $content = $_GET['content'] ?? '';
        $image = $_GET['image'] ?? '';
        $date = $_GET['date'] ?? '';
        define('UPLPATH', 'images/');
    ?>
    

    <article class="container-sm clanak">
      <div class="row">
        <h1 class="col-12 title pb-2">
          <?php
            echo "$title";
          ?>
        </h1>
        <span class='col-12 datum pb-4'>
        <?php
          echo "$date";
        ?>
        </span>
        
        <figure class="col-12 slika">
            <?php
            echo '<img src="' . UPLPATH . $image . '">';
            ?>
        </figure>
          <p class="col-12 about pb-3">
            <?php
              echo "$about";
            ?>
          </p>
          <p class="col-12 sadrzaj">
            <?php
              echo nl2br($content);
            ?>
          </p>
      </div>
    </article>


    <button type="button" class="btn btn-floating btn-lg" id="btn-back-to-top">
      <i class="fas fa-arrow-up"></i>
    </button>
    <footer class="container-fluid">
      <div class="row justify-content-center align-items-center">
        <p class="col-12">Nikola Rajić</p>
        <p class="col-12">nikola.rajic@tvz.hr</p>
      </div>
    </footer>
    <!-- Bootstrap -->
    <script
      src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script
      src="https://kit.fontawesome.com/e7c64061f3.js"
      crossorigin="anonymous"
    ></script>
    <script src="scrollToTop.js"></script>
  </body>
</html>
