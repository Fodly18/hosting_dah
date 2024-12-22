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
			<li>
				<a href="/kelas_b/team_1/dashboard-admin">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="/kelas_b/team_1/guru">
					<i class='bx bxs-group'></i>
					<span class="text">Guru</span>
				</a>
			</li>
			<li>
				<a href="/kelas_b/team_1/siswa">
					<i class='bx bxs-group'></i>
					<span class="text">Siswa</span>
				</a>
			</li>
			<li>
				<a href="/kelas_b/team_1/Acara_sekolah">
					<i class='bx bxs-photo-album' ></i>
					<span class="text">Gallery</span>
				</a>
			</li>
			<li>
				<a href="/kelas_b/team_1/Berita">
					<i class='bx bxs-news' ></i>
					<span class="text">Berita</span>
				</a>
			</li>
			<li class="active">
				<a href="/kelas_b/team_1/Ppdb">
					<i class='bx bxs-receipt' ></i>
					<span class="text">PPDB</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="/kelas_b/team_1/logout-admin" class="logout">
					<i class='bx bx-log-out'></i>
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
					<h1>Edit Poster PPDB</h1>
					<ul class="breadcrumb">
						<li><a href="/kelas_b/team_1/admin">Dashboard</a></li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li><a href="/kelas_b/team_1/#">Gallery</a></li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li><a href="/kelas_b/team_1/Ppdb">PPDB</a></li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li><a class="active" href="#">Edit Poster PPDB</a></li>
					</ul>
				</div>
			</div>

			<div class="form-container">
    <form action="/kelas_b/team_1/Ppdb/update" method="post" id="updateForm" onsubmit="return validateForm()" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($data->id ?? '') ?>">

        <!-- Tanggal Mulai -->
        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai:</label>
            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required 
                   value="<?= htmlspecialchars($data->tanggal_mulai ?? '') ?>">
            <?php if (isset($errors['tanggal_mulai'])): ?>
                <?php foreach ($errors['tanggal_mulai'] as $error): ?>
                    <div class="error-message"><?= htmlspecialchars($error) ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Tanggal Selesai -->
        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai:</label>
            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required 
                   value="<?= htmlspecialchars($data->tanggal_selesai ?? '') ?>">
            <?php if (isset($errors['tanggal_selesai'])): ?>
                <?php foreach ($errors['tanggal_selesai'] as $error): ?>
                    <div class="error-message"><?= htmlspecialchars($error) ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Upload Foto -->
        <div class="form-group">
            <label for="img">Upload Foto:</label>
            <input type="file" class="form-control" id="img" name="img" accept="image/*">
            <?php if (!empty($data->img)): ?>
                <p>Gambar saat ini:</p>
                <img src="<?= htmlspecialchars($data->img ?? '') ?>" alt="Gambar saat ini" style="max-width: 20%; height: auto; margin-top: 10px;">
            <?php endif; ?>
        </div>

        <!-- Submit & Cancel Buttons -->
        <div class="form-button">
            <button type="submit" class="btn btn-primary">
                <i class='bx bx-save'></i>
                <span>Simpan Perubahan</span>
            </button>
            <a href="/kelas_b/team_1/Ppdb" class="btn btn-danger">
                <i class='bx bx-x'></i>
                <span>Batal</span>
            </a>
        </div>
    </form>
</div>

	<!-- CONTENT -->
	<script src="/kelas_b/team_1/assets/js/paket-tabel.js"></script>
    <script>
        function validateForm() {
            const tanggalMulai = document.getElementById('tanggal_mulai').value;
            const tanggalSelesai = document.getElementById('tanggal_selesai').value;

            if (new Date(tanggalMulai) > new Date(tanggalSelesai)) {
                document.querySelector('.warning-message').innerText = 'Tanggal mulai tidak boleh lebih besar dari tanggal selesai!';
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
