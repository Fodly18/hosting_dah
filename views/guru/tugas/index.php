<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="/kelas_b/team_1/assets/css/dashboardberita.css">
	<title>Dashboard Guru Page</title>
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
				<a href="/kelas_b/team_1/dashboard-guru">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="/kelas_b/team_1/tugas-pembelajaran">
					<i class='bx bxs-doughnut-chart'></i>
					<span class="text">Tugas</span>
				</a>
			</li>
			<li>
				<a href="/kelas_b/team_1/pengumpulan-tugas">
					<i class='bx bxs-shopping-bag-alt'></i>
					<span class="text">Pengumpulan Tugas</span>
				</a>
			</li>
			<li>
				<a href="/kelas_b/team_1/latihan-soal">
					<i class='bx bxs-book-content'></i>
					<span class="text">Latihan Soal</span>
				</a>
			</li>
			<li>
				<a href="/kelas_b/team_1/penilaian-latihan-soal">

					<i class='bx bx-task'></i>
					<span class="text">Penilaian Latihan Soal</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="/kelas_b/team_1/logout-guru" class="logout">
					<i class='bx bx-exit bx-flip-horizontal'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->

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
					<h1>Data Tugas</h1>
					<ul class="breadcrumb">
						<li><a href="/kelas_b/team_1/dashboard-guru">Dashboard</a></li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li><a class="active" href="#">Tabel Tugas</a></li>
					</ul>
				</div>
				<a href="/kelas_b/team_1/tugas-pembelajaran/create" class="btn btn-primary">
					<i class='bx bx-plus'></i>
					<span>Tambah Tugas</span>
				</a>
			</div>

			<div class="search-bar-container">
				<i class="bx bx-search"></i>
				<input type="text" id="search-input" placeholder="Cari judul...">
				<button type="button" id="search-button">Search</button>
			</div>

			<div class="table-container">
				<table class="data-table">
					<thead>
						<tr>
							<th>No</th>
							<th>Mata Pelajaran</th>
							<th>Kelas</th>
							<th>Judul Tugas</th>
							<th>Deskripsi</th>
							<th>Tanggal Tugas</th>
							<th>Deadline Tugas</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if (empty($data)): ?>
							<tr>
								<td colspan="8" class="empty-state">
									<i class='bx bx-folder-open'></i>
									<p>Belum Ada Tugas Yang Tersedia</p>
								</td>
							</tr>
						<?php else: ?>
							<?php foreach ($data as $row): ?>
								<tr>
									<td align="center"><?= $no++; ?></td>
									<td align="center"><?= htmlspecialchars($row['nama'] ?? 'Tidak Ditemukan'); ?></td>
									<td align="center"><?= htmlspecialchars($row['kelas'] ?? 'Tidak Ditemukan'); ?></td>
									<td align="center"><?= htmlspecialchars($row['judul_tugas']); ?></td>
									<td><?= htmlspecialchars($row['deskripsi']); ?></td>
									<td align="center"><?= htmlspecialchars($row['tanggal_tugas']); ?></td>
									<td align="center"><?= htmlspecialchars($row['deadline']); ?></td>
									<td align="center" class="action-buttons">
										<a href="/kelas_b/team_1/tugas-pembelajaran/update/<?= $row['id']; ?>" class="btn btn-success">
											<i class='bx bx-edit-alt'></i>
											<span>Edit</span>
										</a>
										<a href="/kelas_b/team_1/tugas-pembelajaran/delete/<?= urlencode($row['id']); ?>"
											class="btn btn-danger btn-delete delete-button">
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