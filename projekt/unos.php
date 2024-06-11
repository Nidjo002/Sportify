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
    <form class="container d-flex justify-content-center pt-3" action="insert.php" method="post" enctype="multipart/form-data" id="newsForm" onsubmit="return validateForm()">
        <div class="column">
            <div class="form-item">
                <label for="title">Naslov vijesti:</label>
                <div class="form-field">
                    <input type="text" name="title" id="title" class="form-field-textual"/>
                    <div id="titleError" class="error-message"></div>
                </div>
            </div>
            <div class="form-item">
                <label for="about">Kratki sadržaj vijesti:</label>
                <div class="form-field">
                    <textarea name="about" id="about" cols="40" rows="10" class="formfield-textual"></textarea>
                    <div id="aboutError" class="error-message"></div>
                </div>
            </div>
            <div class="form-item">
                <label for="content">Sadržaj vijesti:</label>
                <div class="form-field">
                    <textarea name="content" id="content" cols="40" rows="15" class="formfield-textual"></textarea>
                    <div id="contentError" class="error-message"></div>
                </div>
            </div>
            <div class="form-item">
                <label for="category">Kategorija vijesti:</label>
                <div class="form-field">
                    <select name="category" id="category" class="formfield-textual">
                        <option value="" disabled selected hidden>Odaberi kategoriju:</option>
                        <option value="nogomet">Nogomet</option>
                        <option value="košarka">Košarka</option>
                    </select>
                    <div id="categoryError" class="error-message"></div>
                </div>
            </div>
            <div class="form-item">
                <label for="pphoto">Slika: </label>
                <div class="form-field">
                    <input type="file" class="input-text file-btn" name="pphoto" id="pphoto"/>
                    <div id="pphotoError" class="error-message"></div>
                </div>
            </div>
            <div class="form-item">
                <label>Spremiti u arhivu: <input type="checkbox" name="archive"/></label>
            </div>
            <div class="form-item">
                <button type="reset" class="btn btn-outline-secondary" value="Poništi">Poništi</button>
                <button type="submit" class="btn btn-primary" name="submit" value="Prihvati">Prihvati</button>
            </div>
        </div>
    </form>

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
        function validateForm() {
            var isValid = true;

            // Clear previous error messages and styles
            clearErrors();

            // Naslov vijesti mora imati 5 do 30 znakova
            var title = document.getElementById('title').value.trim();
            if (title.length < 5 || title.length > 30) {
                showError('title', 'Naslov vijesti mora imati između 5 i 30 znakova.');
                isValid = false;
            }

            // Kratki sadržaj vijesti mora imati 10 do 100 znakova
            var about = document.getElementById('about').value.trim();
            if (about.length < 10 || about.length > 100) {
                showError('about', 'Kratki sadržaj vijesti mora imati između 10 i 100 znakova.');
                isValid = false;
            }

            // Tekst vijesti nesmije biti prazan
            var content = document.getElementById('content').value.trim();
            if (content === '') {
                showError('content', 'Tekst vijesti ne smije biti prazan.');
                isValid = false;
            }

            // Slika mora biti odabrana
            var pphoto = document.getElementById('pphoto').value;
            if (pphoto === '') {
                showError('pphoto', 'Molimo odaberite sliku.');
                isValid = false;
            }

            // Kategorija mora biti odabrana
            var category = document.getElementById('category').value;
            if (category === '') {
                showError('category', 'Molimo odaberite kategoriju.');
                isValid = false;
            }

            return isValid;
        }

        function showError(fieldId, message) {
            var field = document.getElementById(fieldId);
            field.classList.add('error');
            var errorElement = document.getElementById(fieldId + 'Error');
            errorElement.textContent = message;
        }

        function clearErrors() {
            var errorFields = document.querySelectorAll('.error');
            errorFields.forEach(function(field) {
                field.classList.remove('error');
            });

            var errorMessages = document.querySelectorAll('.error-message');
            errorMessages.forEach(function(error) {
                error.textContent = '';
            });
        }
    </script>
  </body>
</html>
