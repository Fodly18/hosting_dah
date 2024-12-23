<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/kelas_b/team_1/assets/css/dashboardberita.css">
    <title>Data Mata Pelajaran - Admin Dashboard</title>
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
            <h1>Data Jadwal</h1>
            <ul class="breadcrumb">
                <li><a href="/admin">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Data Jadwal</a></li>
            </ul>
        </div>
        <a href="/kelas_b/team_1/jadwal/create" class="btn btn-primary">
            <i class='bx bx-plus'></i>
            <span>Tambah Jadwal</span>
        </a>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Nama Kelas</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="7" class="empty-state">
                            <i class='bx bx-folder-open'></i>
                            <p>Belum ada data Jadwal tersedia</p>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($data as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['mapel']); ?></td>
                            <td><?= htmlspecialchars($row['kelas']); ?></td>
                            <td><?= htmlspecialchars($row['hari']); ?></td>
                            <td><?= htmlspecialchars($row['jam_mulai']) . " - " . htmlspecialchars($row['jam_selesai']); ?></td>
                            <td class="action-buttons">
                                <a href="/kelas_b/team_1/jadwal/update/<?= $row['id']; ?>" class="btn btn-success">
                                    <i class='bx bx-edit-alt'></i>
                                    <span>Edit</span>
                                </a>
                                <a href="/kelas_b/team_1/jadwal/delete/<?= $row['id']; ?>"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data Jadwal ini?');"
                                   class="btn btn-danger">
                                    <i class='bx bx-trash'></i>
                                    <span>Hapus</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Modal Konfirmasi -->
<div id="confirmation-modal" class="modal hidden">
    <div class="modal-content">
        <h3>Konfirmasi Penghapusan</h3>
        <p>Apakah Anda yakin ingin menghapus data ini?</p>
        <div class="modal-buttons">
            <button id="cancel-button" class="btn btn-cancel">Batal</button>
            <button id="confirm-button" class="btn btn-confirm">Hapus</button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Berhasil ketika sesudah delete -->
<div id="success-modal" class="modal hidden">
    <div class="modal-content">
        <div class="success-content">
            <div class="trash-bin">
                <div class="lid"></div>
                <div class="bin"></div>
                <div class="trash"></div>
            </div>
            <p>Data sudah dihapus!</p>
        </div>
    </div>
</div>

</main>

    </section>

    <script src="/kelas_b/team_1/assets/js/paket-tabel.js"></script>

</body>
</html>
