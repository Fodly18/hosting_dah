<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="/kelas_b/team_1/assets/css/dashboardberita.css">
	<style>
		.select {
			display: inline-block;
			width: auto;
			min-width: 600px;
			align-items: center;
			justify-content: center;
			margin-top: 10px;
			padding: 8px 12px;
			color: #333;
			background-color: #eee;
			border: 2px solid #bbb;
			cursor: pointer;
			border-radius: 5px;
			font-size: 14px;
			text-align: left;
			text-align-last: center;
			transition: border-color 0.3s ease;
		}

		.select:focus,
		.select:hover {
			outline: none;
			border: 2px solid #169dea;
		}

		.select option {
			background: #fff;
			color: #333;
			padding: 4px;
			text-align: left;
		}

		.btn-select {
			margin-left: 16px;
			padding: 8px 12px;
			color: #eee;
			background-color: #169dea;
			font-size: 14px;
			cursor: pointer;
			border: 2px solid #169dea;
			border-radius: 10px;
		}
	</style>
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
			<li>
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
			<li class="active">
				<a href="/kelas_b/team_1/penilaian-latihan-soal">
					<i class='bx bx-task'></i>
					<span class="text">Penilaian Latihan Soal</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="/kelas_b/team_1/logout-guru" class="logout">
					<i class='bx bx-exit bx-flip-horizontal' ></i>
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
					<h1>Penilaian Latihan Soal</h1>
					<ul class="breadcrumb">
						<li><a href="#">Penilaian Latihan Soal</a></li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li><a class="active" href="#">Daftar Nilai Siswa</a></li>
					</ul>
					<form action="/kelas_b/team_1/penilaian-latihan-soal/filter" method="POST">
						<select class="select" name="filter-nilai">
							<option disabled selected value="">-- Pilih Judul Soal --</option>
							<?php foreach ($data as $row) : ?>
								<option value="<?= $row['id']; ?>"><?= $row['judul_soal'] ?></option>
							<?php endforeach; ?>
						</select>
						<button class="btn-select">Pilih Judul</button>
					</form>
				</div>
			</div>
			<div class="search-bar-container">
				<i class="bx bx-search"></i>
				<input type="text" id="search-input" placeholder="Cari Nama Siswa...">
				<button type="button" id="search-button">Search</button>
			</div>
			<div class="table-container">
				<table class="data-table">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Siswa</th>
							<th>Kelas</th>     
							<th>Nilai Latihan Soal</th>
						</tr>
					</thead>
					<tbody>
						<?php if (empty($dataLatihan)): ?>
							<tr>
								<td colspan="5" class="empty-state">
									<i class='bx bx-folder-open'></i>
									<p>Belum Ada Siswa Yang Menyelesaikan Latihan Soal</p>
								</td>
							</tr>
						<?php else: ?>
							<?php foreach ($dataLatihan as $row): ?>
								<tr>
									<td align="center"><?= $no++; ?></td>
									<td align="center"><?= htmlspecialchars($row['nama'] ?? 'Tidak Ditemukan'); ?></td>
									<td align="center"><?= htmlspecialchars($row['kelas'] ?? 'Tidak Ditemukan'); ?></td>
                                    <td align="center"><?= htmlspecialchars($row['total_nilai']) ; ?></td>
                                </tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
            </div>
        </main>
    </section>
</body>
<script src="/kelas_b/team_1/assets/js/paket-tabel.js"></script>
</html>            