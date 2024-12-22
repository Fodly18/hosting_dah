<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/kelas_b/team_1/assets/css/dataguruadmin.css">
    <link rel="stylesheet" href="/kelas_b/team_1/assets/css/dashboardadmin.css">
    <title>Tambah Mata Pelajaran - Admin Dashboard</title>
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="/kelas_b/team_1/admin" class="brand">
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
					<i class='bx bxs-group' ></i>
					<span class="text">Guru</span>
				</a>
			</li>
			<li>
				<a href="/kelas_b/team_1/kelas">
					<i class='bx bxs-news' ></i>
					<span class="text">Kelas</span>
				</a>
			</li>
			<li>
				<a href="/kelas_b/team_1/mapel">
					<i class='bx bxs-book-content' ></i>
					<span class="text">Mapel</span>
				</a>
			</li>
			<li class="active">
				<a href="/kelas_b/team_1/mapelkelas">
					<i class='bx bx-book-open' ></i>
					<span class="text">Mapel-Kelas</span>
				</a>
			</li>
			<li>
				<a href="/kelas_b/team_1/jadwal">
					<i class='bx bxs-book' ></i>
					<span class="text">Jadwal</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="/kelas_b/team_1/logout-admin" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
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
            <h1>Tambah Mapel Kelas</h1>
            <ul class="breadcrumb">
                <li><a href="/kelas_b/team_1/admin">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a href="/kelas_b/team_1/mapelkelas">Mapel Kelas</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Tambah Mapel Kelas</a></li>
            </ul>
        </div>
    </div>

    <div class="form-container">
        <?php if (isset($errors['system'])): ?>
            <div class="error-message" style="margin-bottom: 1rem;">
                <?= htmlspecialchars($errors['system'][0]) ?>
            </div>
        <?php endif; ?>

        <form action="/kelas_b/team_1/mapelkelas/create" method="post" id="createForm">
            <div class="form-group">
            <label for="nama">Mata Pelajaran</label>
            <select class="form-control" id="nama" name="nama" required>
                <option value="" disabled selected>-- Pilih Mata Pelajaran --</option>
                <?php foreach ($data as $row): ?>
                    <option value="<?= htmlspecialchars($row['id']); ?>">
                        <?= htmlspecialchars($row['nama']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            </div>

            <div class="form-group">
            <label for="guru">Guru</label>
            <select class="form-control" id="guru" name="guru" required>
                <option value="" disabled selected>-- Pilih Guru --</option>
                <?php foreach ($data as $row): ?>
                    <option value="<?= htmlspecialchars($row['id']); ?>">
                        <?= htmlspecialchars($row['guru']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            </div>

            <div class="form-group">
            <label for="kelas">Kelas</label>
            <select class="form-control" id="kelas" name="kelas" required>
                <option value="" disabled selected>-- Pilih Kelas --</option>
                <?php foreach ($data as $row): ?>
                    <option value="<?= htmlspecialchars($row['id']); ?>">
                        <?= htmlspecialchars($row['kelas']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            </div>


    <div class="btn-container">
        <button type="submit" class="btn btn-primary">
            <i class='bx bx-save'></i>
            <span>Simpan</span>
        </button>
        <a href="/kelas_b/team_1/mapelkelas" class="btn btn-danger">
            <i class='bx bx-x'></i>
            <span>Batal</span>
        </a>
    </div>
        </form>
    </div>
</main>

    </section>

    <script src="/kelas_b/team_1/assets/js/dashboardadmin.js"></script>
    <script>
        // Toggle dark mode
        const switchMode = document.getElementById('switch-mode');
        switchMode.addEventListener('change', function() {
            if (this.checked) {
                document.body.classList.add('dark');
            } else {
                document.body.classList.remove('dark');
            }
        });
    </script>
</body>
</html>
