<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi-misi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/kelas_b/team_1/assets/css/Visi-misi.css">
    <link rel="stylesheet" href="/kelas_b/team_1/assets/css/loading.css">
    <link rel="icon" href="/kelas_b/team_1/assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <!-- Loader Container -->
<div id="loader">
    <img src="/kelas_b/team_1/assets/animation/loading.svg" alt="Loading Animation">
</div>
   <!-- navbar -->
   <nav class="navbar navbar-expand-lg bg-custom">
    <div class="container-fluid">
      <a class="navbar-brand logo" href="#">
        <img src="assets/img/logo.png" class="logo-img" alt="Logo" />
        <div class="header-text">
          <span class="main-text">SDN 1 Kalisat</span>
          <span class="sub-text">Kalisat - Jember</span>
        </div>
      </a>
      <button
      class="navbar-toggler"
      type="button"
      onclick="toggleMenu()"
    >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="/kelas_b/team_1/">Beranda</a>
          </li>
          <!-- Dropdown Profil -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Profil
              <i class="fas fa-chevron-down"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="profilDropdown">
              <li><a class="dropdown-item" href="/kelas_b/team_1/sejarah">Sejarah</a></li>
              <li><a class="dropdown-item" href="/kelas_b/team_1/Visi-misi">Visi dan Misi</a></li>
              <li><a class="dropdown-item" href="/kelas_b/team_1/strukture-organisasi">Struktur Organisasi</a></li>
            </ul>
          </li>
          <!-- Dropdown Gallery -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="galleryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Gallery
              <i class="fas fa-chevron-down"></i> 
            </a>
            <ul class="dropdown-menu" aria-labelledby="galleryDropdown">
              <li><a class="dropdown-item" href="/kelas_b/team_1/acara_sekolah">Acara Sekolah</a></li>
              <li><a class="dropdown-item" href="/kelas_b/team_1/prestasi">Prestasi</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/kelas_b/team_1/berita">Berita</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/kelas_b/team_1/ppdb">PPDB</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/kelas_b/team_1/kontak">Kontak</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- navbar mobile -->
  <div id="mobile-menu" class="offcanvas-menu">
  <h1><a href="/kelas_b/team_1/">Beranda</a></h1>
  <button class="close-btn" onclick="toggleMenu()">&#10005;</button>
  <ul class="offcanvas-nav">
    <!-- Dropdown Profil -->
    <li>
    <button class="dropdown-toggle" onclick="toggleDropdown('profil-menu', this)">
  Profil
  <i class="fas fa-chevron-down"></i>
      </button>
      <ul id="profil-menu" class="dropdown-content">
        <li><a href="/kelas_b/team_1/sejarah">Sejarah</a></li>
        <li><a href="/kelas_b/team_1/Visi-misi">Visi dan Misi</a></li>
        <li><a href="/kelas_b/team_1/strukture-organisasi">Struktur Organisasi</a></li>
      </ul>
    </li>
    <!-- Dropdown Gallery -->
    <li>
      <button class="dropdown-toggle" onclick="toggleDropdown('gallery-menu',this)">
        Gallery
        <i class="fas fa-chevron-down"></i>
      </button>
      <ul id="gallery-menu" class="dropdown-content">
        <li><a href="/kelas_b/team_1/acara_sekolah">Acara Sekolah</a></li>
        <li><a href="/kelas_b/team_1/prestasi">Prestasi</a></li>
      </ul>
    </li>
    <li><a href="/kelas_b/team_1/berita">Berita</a></li>
    <li><a href="/kelas_b/team_1/ppdb">PPDB</a></li>
    <li><a href="/kelas_b/team_1/kontak">Kontak</a></li>
  </ul>
</div>

    <!-- Banner  -->
    <div class="banner">
        <img class="banner-jpg" src="/kelas_b/team_1/assets/img/banner-visimisi.jpg" alt="Banner JPG">
    </div>

   <!-- Text Visi Misi -->
<div class="text-visimisi">
    <div class="visi-style">
    <h3>Visi</h3>
    <ul>
        <li>Mewujudkan peserta didik yang berprestasi dan berkarakter yang dilandasi imtaq serta menguasai imtek dan peduli terhadap lingkungan</li>
    </ul>
    </div>

    <div class="misi-style">
    <h3>Misi</h3>
    <ol>
        <li>Membangun etika dengan berpedoman pada IMTAQ yang berkesinambungan</li>
        <li>Menerapkan pembelajaran yang kontekstual dan realistis</li>
        <li>Menerapkan pembelajaran yang aktif, kreatif, inovatif, dan menyenangkan</li>
        <li>Menyelenggarakan pembelajaran komputer terhadap siswa</li>
        <li>Menerapkan pembelajaran berbasis IT</li>
        <li>Melaksanakan penguatan karakter di setiap semester</li>
        <li>Melaksanakan pendidikan yang mengacu pada kepedulian terhadap lingkungan sekitar</li>
    </ol>
    </div>

    <div class="tujuan-style">
    <h3>Tujuan</h3>
    <ol>
        <li>Mewujudkan siswa yang unggul dalam lomba akademik (Olimpiade MIPA)</li>
        <li>Mewujudkan siswa unggul dalam lomba non-akademik</li>
        <li>Mewujudkan siswa yang aktif dan kreatif</li>
        <li>Mewujudkan siswa terampil baca tulis Al-Quran</li>
        <li>Mewujudkan siswa rutin sholat wajib dan sunnah</li>
        <li>Mewujudkan siswa terbiasa sholat berjamaah</li>
        <li>Mewujudkan kepedulian warga sekolah dalam pemanfaatan teknologi informasi dan komunikasi</li>
        <li>Terbentuknya peserta didik yang memiliki wawasan luas, berempati, berkarakter, bernalar kritis, dan berkebhinekaan global</li>
        <li>Mewujudkan siswa yang mencintai budaya bangsa</li>
        <li>Mewujudkan siswa yang dapat melestarikan lingkungan</li>
    </ol>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer">
  <div class="container">
    <div class="row">
      <!-- Logo -->
      <div class="col-md-3 logo-section">
        <img src="/kelas_b/team_1/assets/img/logo.png" alt="Logo SDN 1 Kalisat" class="footer-logo">
      </div>

      <!-- Tentang Kami -->
      <div class="col-md-3 about-section">
        <h5>Tentang Kami</h5>
        <p>
          SDN 1 Kalisat adalah sekolah dasar yang berkomitmen untuk memberikan
          pendidikan terbaik bagi anak-anak. Kami berfokus pada pengembangan
          karakter dan akademik siswa.
        </p>
      </div>

      <!-- Kontak -->
      <div class="col-md-3 kontak-section">
        <h5>Kontak</h5>
        <ul>
          <li><i class="fas fa-map-marker-alt"></i> Jl. Kalisat No. 1, Jember</li>
          <li><i class="fas fa-phone"></i> (0331) 123456</li>
          <li><i class="fas fa-envelope"></i> info@sdn1kalisat.sch.id</li>
        </ul>
      </div>

      <!-- Lokasi -->
      <div class="col-md-3 lokasi-section content-alamat">
        <h5>Alamat</h5>
        <a href="https://www.google.com/maps/search/?api=1&query=SDN+1+Kalisat,+Jember" target="_blank">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.8970015713357!2d111.45046627405344!3d-8.009557579918342!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79733e2dbc9155%3A0x4aaf9dd2609da5a9!2sSDN%201%20Kalisat!5e0!3m2!1sen!2sid!4v1731520584344!5m2!1sen!2sid"
            width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </a>
        <p>Jl. Kapuas No.50, Gabahan, Kalisat, Kec. Bungkal, Kabupaten Ponorogo, Jawa Timur 63462</p>
      </div>
    </div>

    <!-- Sosial Media -->
    <div class="row mt-4">
      <div class="col text-center">
        <h5>Ikuti Kami</h5>
        <ul class="social-icons">
          <li><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
          <li><a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a></li>
          <li><a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
        </ul>
      </div>
    </div>

    <!-- Copyright -->
    <div class="text-center mt-4">
      <p>&copy; 2024 SDN 1 Kalisat. All rights reserved.</p>
    </div>
  </div>
</footer>
<script src="/kelas_b/team_1/assets/js/satuuntuksemua.js"></script>
</body>
</html>