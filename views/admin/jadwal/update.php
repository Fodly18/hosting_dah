<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/kelas_b/team_1/assets/css/dashboardberita.css">
    <title>Edit Mata Pelajaran - Admin Dashboard</title>
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
			<li>
				<a href="/kelas_b/team_1/mapelkelas">
					<i class='bx bx-book-open' ></i>
					<span class="text">Mapel-Kelas</span>
				</a>
			</li>
			<li class="active">
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
            <h1>Update Jadwal</h1>
            <ul class="breadcrumb">
                <li><a href="/kelas_b/team_1/admin">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a href="/kelas_b/team_1/jadwal">Jadwal</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Update Jadwal</a></li>
            </ul>
        </div>
    </div>

    <div class="form-container">
        <!-- Pesan error sistem -->
        <?php if (isset($errors['system'])): ?>
            <div class="error-message" style="margin-bottom: 1rem;">
                <?= htmlspecialchars($errors['system'][0]) ?>
            </div>
        <?php endif; ?>

        <!-- Form Update Jadwal -->
        <form action="/kelas_b/team_1/jadwal/update" method="post" id="createForm">
        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">
        <!-- Mata Pelajaran -->
        <div class="form-group">
            <label for="mapel">Mata Pelajaran Kelas</label>
            <select class="form-control" id="mapel" name="mapel_kelas" required>
                <option value="" disabled selected>-- Pilih Mapel Kelas --</option>
                <?php foreach ($mapelkelas as $row): ?>
                    <option value="<?= htmlspecialchars($row['id']); ?>" 
                                        <?= $row['id'] == $data['id_mapel_kelas'] ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($row['nama'] . ' | ' . $row['kelas']); ?>
                                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['mapel'])): ?>
                <div class="error-message"><?= htmlspecialchars($errors['mapel'][0]) ?></div>
            <?php endif; ?>
        </div>

                <div class="form-group">
        <label for="hari">Hari</label>
        <select class="form-control" id="hari" name="hari" required>
            <option value="" disabled>-- Pilih Hari --</option>
            <option value="Senin" <?= $data['hari'] === 'Senin' ? 'selected' : ''; ?>>Senin</option>
            <option value="Selasa" <?= $data['hari'] === 'Selasa' ? 'selected' : ''; ?>>Selasa</option>
            <option value="Rabu" <?= $data['hari'] === 'Rabu' ? 'selected' : ''; ?>>Rabu</option>
            <option value="Kamis" <?= $data['hari'] === 'Kamis' ? 'selected' : ''; ?>>Kamis</option>
            <option value="Jumat" <?= $data['hari'] === 'Jumat' ? 'selected' : ''; ?>>Jumat</option>
            <option value="Sabtu" <?= $data['hari'] === 'Sabtu' ? 'selected' : ''; ?>>Sabtu</option>
            <option value="Minggu" <?= $data['hari'] === 'Minggu' ? 'selected' : ''; ?>>Minggu</option>
        </select>

        <?php if (isset($errors['hari'])): ?>
            <?php foreach ($errors['hari'] as $error): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>


            <div class="form-group">
                <label for="jam_mulai">Jam Mulai</label>
                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required value="<?= htmlspecialchars($data['jam_mulai']) ?>">
                <?php if (isset($errors['jam_mulai'])): ?>
                    <?php foreach ($errors['jam_mulai'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="jam_selesai">Jam Selesai</label>
                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required value="<?= htmlspecialchars($data['jam_selesai']) ?>">
                <?php if (isset($errors['jam_selesai'])): ?>
                    <?php foreach ($errors['jam_selesai'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="btn-container">
                <button type="submit" class="btn btn-primary">
                    <i class='bx bx-save'></i>
                    <span>Simpan</span>
                </button>
                <a href="/kelas_b/team_1/jadwal" class="btn btn-danger">
                    <i class='bx bx-x'></i>
                    <span>Batal</span>
                </a>
            </div>
        </form>
    </div>
</main>


    </section>

    <script src="/kelas_b/team_1/assets/js/paket-tabel.js"></script>
</body>
</html>
