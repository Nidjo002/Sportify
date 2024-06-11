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
  <main class="container-fluid mt-5">
  
  <!-- <div id="login-form" class="d-flex justify-content-center align-items-center mt-5 mb-5">
        <form action="administracija.php" method="POST">
          <label for="korisnicko_ime" class="form-label">Korisničko ime:</label>
          <input type="text" name="korisnicko_ime" id="korisnicko_ime" class="form-control form-control-sm mb-3">
          <label for="lozinka" class="form-label">Lozinka:</label>
          <input type="password" name="lozinka" id="lozinka" class="form-control form-control-sm mb-3">
          <input type="submit" value="Prijava" name="prijava" class="btn btn-primary">
        </form>
  </div> -->
  </div>
    <?php
    session_start(); 
    include "connect.php";
    define('UPLPATH', 'images/');
    $uspjesnaPrijava = false;
    $korisnicko_ime;
    $lozinka_korisnik;
    $level_korisnik;
    $display = 'd-none';
     // Brisanje vijesti
     if(isset($_POST['delete'])){
      $id = $_POST['id'];
      $query = "DELETE FROM vijesti WHERE id = $id";
      $result = mysqli_query($dbc, $query);
      echo "$id";
      // Redirekcija nakon brisanja
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
    }

    
      
      // Ažuriranje vijesti
      if(isset($_POST['update'])) {
        $picture = $_POST['current-photo'];
        if(isset($_FILES['pphoto']) && $_FILES['pphoto']['error'] == 0){
            $picture = $_FILES['pphoto']['name'];
            $target_dir = UPLPATH . $picture;
            if(move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir)){
            } else {
                $picture = $_POST['current-photo'];
            }
        }

        $title = $_POST['title'];
        $about = $_POST['about'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        $archive = isset($_POST['archive']) ? 1 : 0;
        $id = $_POST['id'];

        $query = "UPDATE vijesti SET naslov='$title', sazetak='$about', tekst='$content', slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id";
        $result = mysqli_query($dbc, $query);
        echo $id;
        // Redirekcija nakon ažuriranja
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
      }
    if(!isset($_SESSION['korisnicko_ime'])) {
      $display = 'd-flex';
    }

    
      
    
      // Provjera da li je korisnik došao s login forme
      if (isset($_POST['prijava'])) {
        // Provjera da li korisnik postoji u bazi uz zaštitu od SQL injectiona
        $korisnicko_ime = $_POST['korisnicko_ime'];
        $lozinka_korisnik = $_POST['lozinka'];
        $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik
        WHERE korisnicko_ime = ?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $korisnicko_ime);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }
        mysqli_stmt_bind_result($stmt, $korisnicko_ime, $lozinka_korisnik,
        $level_korisnik);
        mysqli_stmt_fetch($stmt);
        //Provjera lozinke
        if (password_verify($_POST['lozinka'], $lozinka_korisnik) && mysqli_stmt_num_rows($stmt) > 0) {
          $uspjesnaPrijava = true;
          // Provjera da li je admin
          if($level_korisnik == 1) {
            $admin = true;
          }
          else {
            $admin = false;
            
          }
        //postavljanje session varijabli
          $_SESSION['korisnicko_ime'] = $korisnicko_ime;
          $_SESSION['level_korisnik'] = $level_korisnik;
          } else {
            $uspjesnaPrijava = false;
        }
      }
    

    

   
    if (($uspjesnaPrijava == true && $admin == true) ||
    (isset($_SESSION['korisnicko_ime'])) && $_SESSION['level_korisnik'] == 1) {
      $display = 'd-none';
        
        // Prikaz tablice
        $query = "SELECT * FROM vijesti";
        $result = mysqli_query($dbc, $query);
        
        echo '<table class="table responsive-table">';
echo '<thead>
<tr>
<th scope="col">ID</th>
<th scope="col">NASLOV</th>
<th scope="col">DATUM</th>
<th scope="col">KATEGORIJA</th>
<th scope="col">ARHIVA</th>
<th >Upravljanje</th>
</tr>
</thead>';
echo '<tbody>';

while($row = mysqli_fetch_array($result)) {
    echo '<tr>';
    echo '<td data-label="ID">' . $row['id'] . '</td>';
    echo '<td data-label="NASLOV">' . $row['naslov'] . '</td>';
    echo '<td data-label="DATUM">' . $row['datum'] . '</td>';
    echo '<td data-label="KATEGORIJA">' . $row['kategorija'] . '</td>';
    echo '<td data-label="ARHIVA">' . ($row['arhiva'] == 1 ? 'Da' : 'Ne') . '</td>';
    echo '<td data-label="Upravljanje"><button class="btn btn-primary" onclick="openEditForm(' . $row['id'] . ')">Izmjeni</button></td>';
    echo '</tr>';

    // Forma za uređivanje - pojavljuje se dinamički
    echo '<tr class="edit-form" id="editForm_' . $row['id'] . '" style="display:none;">';
    echo '<td colspan="6">';
    echo '<form class="container d-flex justify-content-center mt-5 mb-5 pt-3 " action=""  method="post" enctype="multipart/form-data" onsubmit="return validateForm(' . $row['id'] . ');">';
    echo '<div class="column">';

    echo '<div class="form-item">
        <label for="title_' . $row['id'] . '">Naslov vijesti:</label>
        <div class="form-field">
            <input type="text" name="title" id="title_' . $row['id'] . '" class="form-field-textual" value="'.$row['naslov'].'"/>
            <div id="titleError" class="error-message"></div>
        </div>
    </div>';

    echo '<div class="form-item">
        <label for="about_' . $row['id'] . '">Kratki sadržaj vijesti (do 50 znakova):</label>
        <div class="form-field">
            <textarea name="about" id="about_' . $row['id'] . '" cols="40" rows="10" class="formfield-textual">'.$row['sazetak'].'</textarea>
            <div id="aboutError" class="error-message"></div>
        </div>
    </div>';

    echo '<div class="form-item">
        <label for="content_' . $row['id'] . '">Sadržaj vijesti:</label>
        <div class="form-field">
            <textarea name="content" id="content_' . $row['id'] . '" cols="40" rows="15" class="formfield-textual">'.$row['tekst'].'</textarea>
            <div id="contentError" class="error-message"></div>
        </div>
    </div>';

    echo '<div class="form-item">
        <label for="category_' . $row['id'] . '">Kategorija vijesti:</label>
        <div class="form-field">
            <select name="category" id="category_' . $row['id'] . '" class="formfield-textual">
                <option value="" disabled hidden>Odaberi kategoriju:</option>
                <option value="nogomet"'.($row['kategorija'] == 'nogomet' ? ' selected' : '').'>Nogomet</option>
                <option value="košarka"'.($row['kategorija'] == 'košarka' ? ' selected' : '').'>Košarka</option>
            </select>
            <div id="categoryError" class="error-message"></div>
        </div>
    </div>';

    echo '<div class="form-item">
        <label for="pphoto_' . $row['id'] . '">Slika: </label>
        <div class="form-field">
            <input type="file" class="input-text file-btn" id="pphoto_' . $row['id'] . '" name="pphoto"/> <br>
            <label class="pt-3" for="current-photo_' . $row['id'] . '">Trenutna slika: </label>
            <input type="text" class="input-text" id="current-photo_' . $row['id'] . '" name="current-photo" value="' . htmlspecialchars($row['slika']) . '" readonly/>
            <br><img class="pt-3" src="' . UPLPATH .$row['slika'] . '" width=300px>
            <div id="pphotoError" class="error-message"></div>
        </div>
    </div>';

    echo '<div class="form-item">
        <label>Spremiti u arhivu:';
    if($row['arhiva'] == 0) {
        echo '<input type="checkbox" name="archive" id="archive_' . $row['id'] . '"/>';
    } else {
        echo '<input type="checkbox" name="archive" id="archive_' . $row['id'] . '" checked/>';
    }
    echo '</label>
    </div>';

    echo '<div class="form-item">
        <input type="hidden" name="id" class="form-field-textual" value="'.$row['id'].'">
        <button class="btn btn-outline-secondary" type="reset" value="Poništi">Poništi</button>
        <button class="btn btn-primary" type="submit" name="update" value="Prihvati">Izmjeni</button>
        <button class="btn btn-danger" type="submit" name="delete" value="Izbriši">Izbriši</button>
    </div>';

    echo "</div>";
    echo "</form>";
    echo '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
      } else if ($uspjesnaPrijava == true && $admin == false) {

        echo '<p class="text-center">Bok ' . $korisnicko_ime . '! Uspješno ste prijavljeni, ali
       niste administrator.</p>';
       $display = 'd-none';
        } else if (isset($_SESSION['korisnicko_ime']) && $_SESSION['level_korisnik'] == 0) {
        echo '<p class="text-center">Bok ' . $_SESSION['korisnicko_ime'] . '! Uspješno ste
       prijavljeni, ali niste administrator.</p>';
       $display = 'd-none';
      }; 
        if ($uspjesnaPrijava === false && isset($_POST['prijava'])) {
          echo '<div class="d-flex flex-column align-items-center justify-content-center">';
          echo '<p class="mb-0">';
          echo 'Nemate korisnički račun! <br>';
          echo '</p>';
          echo '<a href="register.php">Registrirajte se</a>';
          echo '</div>';
          $display = 'd-none';
        }
       else {
        echo '
    <div id="login-form" class="'.$display.' justify-content-center align-items-center mb-5">
        <form action="" method="POST">
            <label for="korisnicko_ime" class="form-label">Korisničko ime:</label>
            <input type="text" name="korisnicko_ime" id="korisnicko_ime" class="form-control form-control-sm mb-3">
            <label for="lozinka" class="form-label">Lozinka:</label>
            <input type="password" name="lozinka" id="lozinka" class="form-control form-control-sm mb-3">
            <input type="submit" value="Prijava" name="prijava" class="btn btn-primary">
        </form>
    </div>';
      }
      
    ?>
    
    <a href="register.php"></a>
  </main>

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
<script>
        function validateForm(id) {
    var isValid = true;

    // Clear previous error messages and styles
    clearErrors(id);

    // Naslov vijesti mora imati 5 do 30 znakova
    var title = document.getElementById('title_' + id).value.trim();
    if (title.length < 5 || title.length > 30) {
        showError('title_' + id, 'Naslov vijesti mora imati između 5 i 30 znakova.');
        isValid = false;
    }

    // Kratki sadržaj vijesti mora imati 10 do 100 znakova
    var about = document.getElementById('about_' + id).value.trim();
    if (about.length < 10 || about.length > 100) {
        showError('about_' + id, 'Kratki sadržaj vijesti mora imati između 10 i 100 znakova.');
        isValid = false;
    }

    // Tekst vijesti nesmije biti prazan
    var content = document.getElementById('content_' + id).value.trim();
    if (content === '') {
        showError('content_' + id, 'Tekst vijesti ne smije biti prazan.');
        isValid = false;
    }

    

    // Kategorija mora biti odabrana
    var category = document.getElementById('category_' + id).value;
    if (category === '') {
        showError('category_' + id, 'Molimo odaberite kategoriju.');
        isValid = false;
    }

    return isValid;
}

function showError(fieldId, message) {
    var field = document.getElementById(fieldId);
    field.classList.add('error');
    var errorElement = field.nextElementSibling;
    errorElement.textContent = message;
}

function clearErrors(id) {
    var form = document.getElementById('editForm_' + id);
    var errorFields = form.querySelectorAll('.error');
    errorFields.forEach(function(field) {
        field.classList.remove('error');
    });

    var errorMessages = form.querySelectorAll('.error-message');
    errorMessages.forEach(function(error) {
        error.textContent = '';
    });
}

    </script>


</body>
</html>