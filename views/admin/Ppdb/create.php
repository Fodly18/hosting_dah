<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="/kelas_b/team_1/assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="/kelas_b/team_1/assets/css/dashboardberita.css">
    <title>Tambah Poster PPDB - Dashboard Admin</title>
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
                    <h1>Tambah Poster PPDB</h1>
                    <ul class="breadcrumb">
                        <li><a href="/kelas_b/team_1/admin">Dashboard</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a href="/kelas_b/team_1/Ppdb">PPDB</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#">Tambah Poster PPDB</a></li>
                    </ul>
                </div>
            </div>

            <div class="form-container">
            <?php if (isset($errors['system'])): ?>
                <div class="warning-message" style="margin-bottom: 1rem;"><?= htmlspecialchars($errors['system'][0]) ?></div>
            <?php endif; ?>

            <form action="/kelas_b/team_1/Ppdb/create" method="post" id="createForm" onsubmit="return validateForm()" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai :</label>
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required aria-describedby="tanggalHint">
                    <div id="tanggalHint" class="form-hint">Pilih tanggal Mulai</div>
                    <?php if (isset($errors['tanggal_mulai'])): ?>
                        <?php foreach ($errors['tanggal_mulai'] as $error): ?>
                            <div class="warning-message"><?= htmlspecialchars($error) ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai :</label>
                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required aria-describedby="tanggalHint">
                    <div id="tanggalHint" class="form-hint">Pilih tanggal Selesai</div>
                    <?php if (isset($errors['tanggal_selesai'])): ?>
                        <?php foreach ($errors['tanggal_selesai'] as $error): ?>
                            <div class="warning-message"><?= htmlspecialchars($error) ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="img">Upload Foto :</label>
                    <input type="file" class="form-control" id="img" name="img" required aria-describedby="imgHint" accept="image/*">
                    <div id="imgHint" class="form-hint">Upload gambar</div>
                    <?php if (isset($errors['img'])): ?>
                        <?php foreach ($errors['img'] as $error): ?>
                            <div class="warning-message"><?= htmlspecialchars($error) ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn btn-primary">
                        <i class='bx bx-save'></i>
                        <span>Simpan</span>
                    </button>
                    <a href="/kelas_b/team_1/Ppdb" class="btn btn-danger">
                        <i class='bx bx-x'></i>
                        <span>Batal</span>
                    </a>
                </div>
            </form>
            </div>
        </main>
    </section>

    <!-- CONTENT
	<script>
    function validateForm() {
        const imgInput = document.getElementById('img');
        const startDate = new Date(document.getElementById('tanggal_mulai').value);
        const endDate = new Date(document.getElementById('tanggal_selesai').value);
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Set waktu ke 00:00 untuk membandingkan hanya tanggal

        // Validasi: File gambar wajib diunggah
        if (!imgInput || !imgInput.files.length) {
            alert('File gambar wajib diunggah.');
            return false;
        }

        // Validasi: Tanggal mulai tidak boleh sebelum hari ini
        if (startDate =< today) {
            alert('Tanggal mulai tidak boleh sebelum hari ini.');
            return false;
        }

        // Validasi: Tanggal mulai tidak boleh setelah tanggal selesai
        if (startDate > endDate) {
            alert('Tanggal mulai tidak boleh setelah tanggal selesai.');
            return false;
        }

        return true; // Jika semua validasi lolos
    }
</script> -->

    <script src="/kelas_b/team_1/assets/js/paket-tabel.js"></script>
</body>
</html>
