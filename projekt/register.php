<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="shortcut icon" href="../projekt/images/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css" />
  <title>Sportify</title>
</head>
<body>
  <header>
    <div class="container-fluid">
      <div class="row justify-content-center align-items-center">
        <div class="col-12 text-center">
          <a class="navbar-brand" href="index.php">
            <img class="" src="../projekt/images/Sportify_logo.png" alt="Logo" />
          </a>
        </div>
        <div class="col">
          <nav class="navbar navbar-expand-md">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link p-3" href="index.php">Početna</a>
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


<main class="container-fluid mt-5 d-flex justify-content-center">
    <section >
        <form enctype="multipart/form-data" action="" method="POST" >
            <div class="form-item">
                <span id="porukaIme" class="bojaPoruke"></span>
                <label for="title">Ime: </label>
                <div class="form-field">
                    <input type="text" name="ime" id="ime" class="form-field-textual">
                </div>
            </div>
            <div class="form-item">
                <span id="porukaPrezime" class="bojaPoruke"></span>
                <label for="about">Prezime: </label>
                <div class="form-field">
                    <input type="text" name="prezime" id="prezime" class="form-field-textual">
                </div>
            </div>
            <div class="form-item">
                <span id="porukaUsername" class="bojaPoruke"></span>
                <label for="content">Korisničko ime:</label>
                <div class="form-field">
                    <input type="text" name="korisnicko_ime" id="korisnicko_ime" class="form-field-textual">
                </div>
            </div>
            <div class="form-item">
                <span id="porukaPass" class="bojaPoruke"></span>
                <label for="password">Lozinka: </label>
                <div class="form-field">
                    <input type="password" name="password" id="password" class="form-field-textual">
                </div>
            </div>
            <div class="form-item">
                <span id="porukaPassRep" class="bojaPoruke"></span>
                <label for="pphoto">Ponovite lozinku: </label>
                <div class="form-field">
                    <input type="password" name="passRep" id="passRep" class="form-field-textual">
                </div>
            </div>
            <div class="form-item">
                <input type="submit" value="Prijava" id="prijava" name="prijava" class="btn btn-primary">
            </div>
        </form>
    </section>
</main>

<?php
include "connect.php";
if (isset($_POST['prijava'])) { 
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['password'];
    $lozinkaPonov = $_POST['passRep'];
    $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
    $razina = 0;
    $registriranKorisnik = false;
    $msg = '';

    // Provjera da li korisničko ime već postoji
    $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_prepare($dbc, $sql);
    mysqli_stmt_bind_param($stmt, 's', $korisnicko_ime);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        $msg='Korisničko ime već postoji!';
    } else {
        // Registracija korisnika u bazi
        $sql = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($dbc, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssi', $ime, $prezime, $korisnicko_ime, $hashed_password, $razina);
        mysqli_stmt_execute($stmt);
        $registriranKorisnik = true;
    }  
    mysqli_close($dbc);
     //Registracija je prošla uspješno
    if($registriranKorisnik == true) {
        echo '<p>Korisnik je uspješno registriran!</p>';
    } else {
        echo '<p>Registracija nije uspjela. Pogrešna lozinka ili korisničko ime.</p>';
    }
} 

?>

  
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
  <script>
    function openEditForm(id) {
      var editForm = document.getElementById('editForm_' + id);
      editForm.style.display = 'table-row'; // Prikazuje formu za uređivanje
    }  
</script>
<script type="text/javascript">
document.getElementById("prijava").addEventListener("click", function(event) {

  var slanjeForme = true;

  // Ime korisnika mora biti uneseno
  var poljeIme = document.getElementById("ime");
  var ime = poljeIme.value.trim();
  if (ime === "") {
    slanjeForme = false;
    poljeIme.style.border="1px dashed red";
    document.getElementById("porukaIme").innerHTML="<br>Unesite ime!<br>";
  } else {
    poljeIme.style.border="1px solid green";
    document.getElementById("porukaIme").innerHTML="";
  }

  // Prezime korisnika mora biti uneseno
  var poljePrezime = document.getElementById("prezime");
  var prezime = poljePrezime.value.trim();
  if (prezime === "") {
    slanjeForme = false;
    poljePrezime.style.border="1px dashed red";
    document.getElementById("porukaPrezime").innerHTML="<br>Unesite prezime!<br>";
  } else {
    poljePrezime.style.border="1px solid green";
    document.getElementById("porukaPrezime").innerHTML="";
  }

  // Korisničko ime mora biti uneseno
  var poljeUsername = document.getElementById("korisnicko_ime");
  var username = poljeUsername.value.trim();
  if (username === "") {
    slanjeForme = false;
    poljeUsername.style.border="1px dashed red";
    document.getElementById("porukaUsername").innerHTML="<br>Unesite korisničko ime!<br>";
  } else {
    poljeUsername.style.border="1px solid green";
    document.getElementById("porukaUsername").innerHTML="";
  }

  // Provjera podudaranja lozinki
  var poljePass = document.getElementById("password");
  var pass = poljePass.value.trim();
  var poljePassRep = document.getElementById("passRep");
  var passRep = poljePassRep.value.trim();
  if (pass === "" || passRep === "" || pass !== passRep) {
    slanjeForme = false;
    poljePass.style.border="1px dashed red";
    poljePassRep.style.border="1px dashed red";
    document.getElementById("porukaPass").innerHTML="<br>Lozinke nisu iste!<br>";
    document.getElementById("porukaPassRep").innerHTML="<br>Lozinke nisu iste!<br>";
  } else {
    poljePass.style.border="1px solid green";
    poljePassRep.style.border="1px solid green";
    document.getElementById("porukaPass").innerHTML="";
    document.getElementById("porukaPassRep").innerHTML="";
  }

  if (slanjeForme !== true) {
    event.preventDefault();
  }

});

</script>

</body>
</html>