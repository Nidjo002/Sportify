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
      href="images/favicon.ico"
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
                src="images/Sportify_logo.png"
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
    <?php
      include 'connect.php';
      define('UPLPATH', 'images/');
    ?>
    <section class="nogomet container">
      <div class="row">
        <h2 class="col-12 pl-3">Nogomet</h2>
        <?php
        $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='nogomet' LIMIT 3";
        $result = mysqli_query($dbc,$query);
        while($row = mysqli_fetch_array($result)) {
          echo '<article class="col-sm-12 col-lg-4">';
          echo '<a id="link" href="clanak.php?id='.$row['id'].'">';
          echo '<div class="card">';
          echo '<img class="card-img-top" src="' . UPLPATH . $row['slika'] . '">';
          echo '<div class="card-body">';
          echo '<h4 class="card-title">';
          echo $row['naslov'];
          echo '</h4>';
          echo '</div>';
          echo '</div>';
          echo '</a>';
          echo '</article>';
        }
        ?>
      </div>
    </section>

    <section class="košarka container">
      <div class="row">
        <h2 class="col-12 pl-3">Košarka</h2>
        <?php
        $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='košarka' LIMIT 3";
        $result = mysqli_query($dbc,$query);
        while($row = mysqli_fetch_array($result)) {
          echo '<article class="col-sm-12 col-lg-4">';
          echo '<a id="link" href="clanak.php?id='.$row['id'].'">';
          echo '<div class="card">';
          echo '<img class="card-img-top" src="' . UPLPATH . $row['slika'] . '">';
          echo '<div class="card-body">';
          echo '<h4 class="card-title">';
          echo $row['naslov'];
          echo '</h4>';
          echo '</div>';
          echo '</div>';
          echo '</a>';
          echo '</article>';
        }
        ?>
      </div>
    </section>

    <!-- Back to top button -->
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
