<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<link rel="icon" href="/kelas_b/team_1/assets/img/logo.png" type="image/png">
	<link rel="stylesheet" href="/kelas_b/team_1/assets/css/dashboardberita.css">
	<title>Berita - Dashboard Admin</title>
</head>
<body>

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img src="/kelas_b/team_1/assets/img/logo.png" alt="Logo" class="icon" width="60" height="60">
			<span class="text">SDN 1 KALISAT</span>
		</a>
		<ul class="side-menu top">
			<li >
				<a href="/kelas_b/team_1/dashboard-admin">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
            <li class="active">
				<a href="/kelas_b/team_1/Acara_sekolah">
					<i class='bx bxs-photo-album' ></i>
					<span class="text">Acara sekolah</span>
				</a>
			</li>
			<li>
				<a href="/kelas_b/team_1/Prestasi">
					<i class='bx bxs-trophy' ></i>
					<span class="text">Prestasi</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="/kelas_b/team_1/logout-admin" class="logout">
					<i class='bx bx-log-out' ></i>

					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>


	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu'></i>
		<!-- mode malam -->
			<div class="dark-mode-switch">
        <p>Dark Mode</p>
        <input type="checkbox" id="switch-mode" hidden>
        <label for="switch-mode" class="switch-mode"></label>
    </div>
		</nav>
		<!-- NAVBAR -->
		<!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Tambah Acara sekolah</h1>
                    <ul class="breadcrumb">
                        <li><a href="/kelas_b/team_1/admin">Dashboard</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
						<li><a href="/kelas_b/team_1/#">Gallery</a></li>
						<li><i class='bx bx-chevron-right'></i></li>
                        <li><a href="/kelas_b/team_1/Berita">Acara sekolah</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#">Tambah Acara sekolah</li>
                    </ul>
                </div>
            </div>

            <div class="form-container">
    <?php if (isset($errors['system'])): ?>
        <div class="error-message" style="margin-bottom: 1rem;">
            <?= htmlspecialchars($errors['system'][0]) ?>
        </div>
    <?php endif; ?>

    <form action="/kelas_b/team_1/Acara_sekolah/create" method="post" id="createForm" onsubmit="return validateForm()" enctype="multipart/form-data">
        <div class="form-group">
            <label for="judul">Judul :</label>
            <input type="text" class="form-control" id="judul" name="judul" required maxlength="100" aria-describedby="judulHint">
            <div id="judulHint" class="form-hint">Judul Acara sekolah maksimal 100 karakter</div>
            <?php if (isset($errors['judul'])): ?>
                <?php foreach ($errors['judul'] as $error): ?>
                    <div class="error-message"><?= htmlspecialchars($error) ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="konten">Konten :</label>
            <textarea class="form-control" id="konten" name="konten" required rows="5" aria-describedby="kontenHint"></textarea>
            <div id="kontenHint" class="form-hint">Masukkan konten Acara sekolah</div>
            <?php if (isset($errors['konten'])): ?>
                <?php foreach ($errors['konten'] as $error): ?>
                    <div class="error-message"><?= htmlspecialchars($error) ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal :</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required aria-describedby="tanggalHint">
            <div id="tanggalHint" class="form-hint">Pilih tanggal Acara sekolah</div>
            <?php if (isset($errors['tanggal'])): ?>
                <?php foreach ($errors['tanggal'] as $error): ?>
                    <div class="error-message"><?= htmlspecialchars($error) ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

			<div class="form-group">
		<label for="img">Upload Foto :</label>
		<input type="file" class="form-control" id="img" name="img" required aria-describedby="imgHint" accept="image/*">
		<div id="imgHint" class="form-hint">Upload gambar untuk Acara sekolah</div>
		<?php if (isset($errors['img'])): ?>
			<?php foreach ($errors['img'] as $error): ?>
				<div class="error-message"><?= htmlspecialchars($error) ?></div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>

        <div class="btn-container">
        <button type="submit" class="btn btn-primary">
            <i class="bx bx-save"></i>
            <span>Simpan</span>
        </button>
        <a href="/kelas_b/team_1/Acara_sekolah" class="btn btn-danger">
            <i class="bx bx-x"></i>
            <span>Batal</span>
        </a>
</div>

    </form>
</div>
        </main>
	</section>
	<!-- CONTENT -->
<script>
	function validateForm() {
    const imgInput = document.getElementById('img');
    if (!imgInput || !imgInput.files.length) {
        alert('File gambar wajib diunggah.');
        return false;
    }
    return true;
}

</script>
	<script src="/kelas_b/team_1/assets/js/dashboardadmin.js"></script>
	<script src="/kelas_b/team_1/assets/js/line-cart.js"></script>

</body>
</html>
