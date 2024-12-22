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
                <li><a href="/kelas_b/team_1/mapel-kelas">Mapel Kelas</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Tambah Mapel Kelas</a></li>
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

        <!-- Form Tambah Mapel Kelas -->
            <form action="/kelas_b/team_1/mapelkelas/update" method="post" id="createForm">
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
            <!-- Pilih Mata Pelajaran -->
            <div class="form-group">
                <label for="mapel_id">Mata Pelajaran</label>
                <select name="mapel" id="mapel_id" class="form-control" required>
                    <option value="" disabled selected>Pilih Mata Pelajaran</option>
                    <?php foreach ($mapel as $row): ?>
                        <option value="<?= htmlspecialchars($row['id']); ?>" 
                                        <?= $row['id'] == $data['id_mapel'] ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($row['nama']); ?>
                                    </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['mapel_id'])): ?>
                    <?php foreach ($errors['mapel_id'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Pilih Kelas -->
            <div class="form-group">
                <label for="kelas_id">Kelas</label>
                <select name="kelas" id="kelas_id" class="form-control" required>
                    <option value="" disabled selected>Pilih Kelas</option>
                    <?php foreach ($kelas as $row): ?>
                        <option value="<?= htmlspecialchars($row['id']); ?>" 
                                        <?= $row['id'] == $data['id_kelas'] ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($row['kelas']); ?>
                                    </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['kelas_id'])): ?>
                    <?php foreach ($errors['kelas_id'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Pilih Guru -->
            <div class="form-group">
                <label for="guru_id">Guru</label>
                <select name="guru" id="guru_id" class="form-control" required>
                    <option value="" disabled selected>Pilih Guru</option>
                    <?php foreach ($guru as $row): ?>
                        <option value="<?= htmlspecialchars($row['id']); ?>" 
                                        <?= $row['id'] == $data['id_guru'] ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($row['nama']); ?>
                                    </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['guru_id'])): ?>
                    <?php foreach ($errors['guru_id'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Tombol Aksi -->
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

    <script src="/kelas_b/team_1/assets/js/paket-tabel.js"></script>

</body>
</html>
