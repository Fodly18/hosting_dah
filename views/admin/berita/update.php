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
			<li>
				<a href="/kelas_b/team_1/guru">
					<i class='bx bxs-group' ></i>
					<span class="text">Guru</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-group' ></i>
					<span class="text">Siswa</span>
				</a>
			</li>
			<li>
				<a href="/kelas_b/team_1/Acara_sekolah">
					<i class='bx bxs-photo-album' ></i>
					<span class="text">Gallery</span>
				</a>
			</li>
			<li class="active">
				<a href="/kelas_b/team_1/Berita">

					<i class='bx bxs-news' ></i>
					<span class="text">Berita</span>
				</a>
			</li>
			<li>
				<a href="/kelas_b/team_1/Ppdb">
					<i class='bx bxs-receipt' ></i>
					<span class="text">PPDB</span>
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
            <h1>Edit Berita</h1>
            <ul class="breadcrumb">
                <li><a href="/kelas_b/team_1/admin">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a href="/kelas_b/team_1/Berita">Berita</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Edit Berita</a></li>
            </ul>
        </div>
    </div>

    <div class="form-container">
        <?php if (isset($errors['system'])): ?>
            <div class="error-message" style="margin-bottom: 1rem;">
                <?= htmlspecialchars($errors['system'][0]) ?>
            </div>
        <?php endif; ?>

        <form action="/kelas_b/team_1/Berita/update" method="post" id="updateForm" onsubmit="return validateForm()" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($data->id) ?>">

            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" required 
                       maxlength="255" value="<?= htmlspecialchars($data->judul) ?>">
                <?php if (isset($errors['judul'])): ?>
                    <?php foreach ($errors['judul'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="konten">Konten</label>
                <textarea class="form-control" id="konten" name="konten" rows="8" required><?= htmlspecialchars($data->konten) ?></textarea>
                <?php if (isset($errors['konten'])): ?>
                    <?php foreach ($errors['konten'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required 
                       value="<?= htmlspecialchars($data->tanggal) ?>">
                <?php if (isset($errors['tanggal'])): ?>
                    <?php foreach ($errors['tanggal'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

				<div class="form-group">
		<label for="img">Gambar</label>
		<input type="file" class="form-control" id="img" name="img">
		<?php if (!empty($data->img)): ?>
			<br>
			<p>Gambar saat ini:</p>
			<br>
			<img src="<?= htmlspecialchars($data->img) ?>" alt="Gambar saat ini" style="max-width: 50%; height: auto; margin-top: 10px;">
		<?php endif; ?>
		<?php if (isset($errors['img'])): ?>
			<?php foreach ($errors['img'] as $error): ?>
				<div class="error-message"><?= htmlspecialchars($error) ?></div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>


            <div class="form-button">
				<button type="submit" class="btn btn-primary">
					<i class='bx bx-save'></i>
					<span>Simpan Perubahan</span>
				</button>

				<a href="/kelas_b/team_1/Berita" class="btn btn-danger">
                    <i class='bx bx-x'></i>
                    <span>Batal</span>
                </a>
            </div>
        </form>
    </div>
</main>


	</section>
	<!-- CONTENT -->
	<script src="/kelas_b/team_1/assets/js/dashboardadmin.js"></script>
	<script src="/kelas_b/team_1/assets/js/line-cart.js"></script>

</body>
</html>
