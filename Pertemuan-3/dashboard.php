<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMK Negeri 1 Lengkong</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    .navbar-brand img {
      max-height: 40px;
    }

    .carousel-item {
      height: 100vh;
      min-height: 300px;
      background: no-repeat center center scroll;
      background-size: cover;
    }

    .section {
      height: 50vh;
    }

    .navbar {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      z-index: 9999;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .nav-second {
      position: absolute;
      left: 0;
      right: 0;
      z-index: 9999;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .search-result {
      position: absolute;
      top: 60px;
      left: 0;
      right: 0;
      background-color: #f8f9fa;
      padding: 20px;
      z-index: 999;
      display: none;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="d-flex justify-content-between align-items-center w-100">
      <a class="navbar-brand" href="#">
        <img src="https://smkn1lengkong.sch.id/wp-content/uploads/2022/04/SMK-110-NEW.png" alt="Logo">
        <span class="ml-2">SMK Negeri 1 Lengkong</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="d-flex justify-content-center align-items-center flex-grow-1">
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2 rounded-pill" type="search" id="searchInput" placeholder="Cari" aria-label="Search" style="width: 500px;">
        </form>
      </div>
      <div class="ml-auto">
        <button class="btn btn-primary">
          <i class="fas fa-sign-in-alt mr-2"></i>
          Masuk
        </button>
      </div>
    </div>
  </nav>

  <div class="search-result" id="searchResult">
    <h3>Hasil Pencarian</h3>
    <ul id="searchList" style="list-style: none;"></ul>
  </div>

  <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active" style="background-image: url('https://www.wartapolri.com/wp-content/uploads/2021/10/IMG-20211013-WA0031.jpg');"></div>
      <div class="carousel-item" style="background-image: url('https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgSkgUBJuauLFh30eXA02fqgrmWA8xzQFzfuqrXneMPm4sOeyJI9tvEgmXlaKY952b8TuAm6g_2sITFMabnwnoRC5R4SNmXoYJNtotYtbwvWB0zcg174p48mUP4X2-_lOpgps3XnhS4AApoDC0G38Ft41GED4UB-Lz-fZJfiaNwWnmb1e57fZ6fLWw_/s1600/IMG-20220331-WA0037.jpg');"></div>
      <div class="carousel-item" style="background-image: url('https://ristanmedia.co.id/wp-content/uploads/2023/01/WhatsApp-Image-2023-01-30-at-14.05.11.jpeg');"></div>
    </div>
  </div>

  <div class="content">
    <nav class="nav-second bg-light pt-2 pb-2">
      <div class="d-flex justify-content-center align-items-center w-100">
        <button class="btn btn-primary m-2" onclick="toggleSection('about')">
          <i class="fas fa-info-circle mr-2"></i>
          About
        </button>
        <button class="btn btn-primary m-2" onclick="toggleSection('contact')">
          <i class="fas fa-envelope mr-2"></i>
          Contact
        </button>
      </div>
    </nav>
    <div class="page">
      <div id="about" class="section d-flex justify-content-center align-items-center" style="display: none !important;">
        <div class="col-sm-4">
          <div class="card">
            <div class="row no-gutters">
              <div class="col-3 d-flex justify-content-center align-items-center">
                <i class="fas fa-check-circle fa-4x text-primary ml-3"></i>
              </div>
              <div class="col-9">
                <div class="card-body">
                  <h5 class="card-title">Rapi</h5>
                  <p class="card-text">"Teratur dan Bersih untuk Pembelajaran Optimal."</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card">
            <div class="row no-gutters">
              <div class="col-3 d-flex justify-content-center align-items-center">
                <i class="fas fa-thumbs-up fa-4x text-primary ml-3"></i>
              </div>
              <div class="col-9">
                <div class="card-body">
                  <h5 class="card-title">Nyaman</h5>
                  <p class="card-text">"Suasana Ideal untuk Menyenangkan Proses Belajar."</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card">
            <div class="row no-gutters">
              <div class="col-3 d-flex justify-content-center align-items-center">
                <i class="fas fa-clock fa-4x text-primary ml-3"></i>
              </div>
              <div class="col-9">
                <div class="card-body">
                  <h5 class="card-title">Tepat Waktu</h5>
                  <p class="card-text">"Menghargai Waktu demi Efisiensi Pembelajaran."</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="contact" class="section d-flex justify-content-center align-items-center" style="display: none !important;">
        <div class="col-sm-4">
            <div class="card">
            <div class="row no-gutters">
                <div class="col-3 d-flex justify-content-center align-items-center">
                <i class="fab fa-facebook fa-4x text-primary ml-3"></i>
                </div>
                <div class="col-9">
                <div class="card-body">
                    <h5 class="card-title">Facebook</h5>
                    <p class="card-text">MochNad</p>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
            <div class="row no-gutters">
                <div class="col-3 d-flex justify-content-center align-items-center">
                <i class="fab fa-whatsapp fa-4x text-primary ml-3"></i>
                </div>
                <div class="col-9">
                <div class="card-body">
                    <h5 class="card-title">WhatsApp</h5>
                    <p class="card-text">MochNad</p>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
            <div class="row no-gutters">
                <div class="col-3 d-flex justify-content-center align-items-center">
                <i class="fab fa-instagram fa-4x text-primary ml-3"></i>
                </div>
                <div class="col-9">
                <div class="card-body">
                    <h5 class="card-title">Instagram</h5>
                    <p class="card-text">MochNad</p>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.carousel').carousel({
        interval: 3000,
        pause: "false"
      });

      $('#searchInput').keyup(function() {
        var searchValue = $(this).val().toLowerCase();
        if (searchValue.length > 0) {
          $('.search-result').css('display', 'block');
          $('#searchList').empty();
          $('#searchList').append('<li><a href="#">Search Result 1</a></li>');
          $('#searchList').append('<li><a href="#">Search Result 2</a></li>');
          $('#searchList').append('<li><a href="#">Search Result 3</a></li>');
        } else {
          $('.search-result').css('display', 'none');
          $('#searchList').empty();
        }
      });
    });

    function toggleSection(sectionId) {
      $('.section').hide();
      $('#' + sectionId).show();
    }
  </script>
</body>

<footer class="bg-primary pt-3 pb-3">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <img src="https://smkn1lengkong.sch.id/wp-content/uploads/2022/04/SMK-110-NEW.png" alt="Logo" height="50">
        <h5 class="text-white mt-3">SMK Negeri 1 Lengkong</h5>
      </div>
    </div>
  </div>
</footer>

</html>
