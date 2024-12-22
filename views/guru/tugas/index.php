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
	<script>
		const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
		const menuBar = document.querySelector('#content nav .bx.bx-menu');
		const sidebar = document.getElementById('sidebar');

		// Cek kondisi sidebar dari localStorage
		if (localStorage.getItem('sidebar-hide') === 'true') {
			sidebar.classList.add('hide');
		}

		// Toggle sidebar
		menuBar.addEventListener('click', function() {
			sidebar.classList.toggle('hide');

			// Simpan kondisi sidebar ke localStorage
			if (sidebar.classList.contains('hide')) {
				localStorage.setItem('sidebar-hide', 'true');
			} else {
				localStorage.setItem('sidebar-hide', 'false');
			}
		});

		// Handle klik menu item
		allSideMenu.forEach(item => {
			const li = item.parentElement;

			item.addEventListener('click', function() {
				allSideMenu.forEach(i => {
					i.parentElement.classList.remove('active');
				});
				li.classList.add('active');
			});
		});



		// Fungsi Dark Mode disimpan di localstorage agar tidak ke reset
		const switchMode = document.getElementById('switch-mode');
		document.addEventListener('DOMContentLoaded', () => {
			const darkModeEnabled = localStorage.getItem('darkMode') === 'enabled';
			if (darkModeEnabled) {
				document.body.classList.add('dark');
				switchMode.checked = true;
			}
		});

		switchMode.addEventListener('change', function() {
			if (this.checked) {
				document.body.classList.add('dark');
				localStorage.setItem('darkMode', 'enabled');
			} else {
				document.body.classList.remove('dark');
				localStorage.setItem('darkMode', 'disabled');
			}
		});

		//fungsi search bar
		const searchButton = document.getElementById('search-button');
		const searchInput = document.getElementById('search-input');
		const tableRows = document.querySelectorAll('table tbody tr');

		// Pastikan elemen-elemen ada
		if (searchButton && searchInput && tableRows.length > 0) {
			// Tambahkan event listener pada tombol search
			searchButton.addEventListener('click', function() {
				const filter = searchInput.value.toLowerCase().trim();

				tableRows.forEach(row => {
					const titleCell = row.querySelector('td:nth-child(4)');
					const titleText = titleCell ?
						titleCell.textContent.toLowerCase().replace('...', '') // Hilangkan "..."
						:
						'';

					// Filter berdasarkan teks input
					if (filter !== '' && titleText.includes(filter)) {
						row.style.display = ''; // Tampilkan baris
					} else {
						row.style.display = 'none'; // Sembunyikan baris
					}
				});

				// Tambahkan feedback jika tidak ada hasil pencarian
				if (!Array.from(tableRows).some(row => row.style.display === '')) {
					console.log('Tidak ada hasil yang cocok.');
					alert('Tidak ada hasil yang cocok dengan kata kunci Anda.');
				}
			});
		}



		//buat confimaasi delete pada tabel
		// Pilih elemen modal dan tombol
		const modal = document.getElementById('confirmation-modal');
		const confirmButton = document.getElementById('confirm-button');
		const cancelButton = document.getElementById('cancel-button');
		const successModal = document.getElementById('success-modal');
		let deleteUrl = '';

		// Pilih semua tombol hapus
		const deleteButtons = document.querySelectorAll('.delete-button');


		deleteButtons.forEach(button => {
			button.addEventListener('click', (event) => {
				event.preventDefault(); // Cegah aksi default dari <a>
				deleteUrl = button.href; // Simpan URL penghapusan
				modal.classList.remove('hidden'); // Tampilkan modal konfirmasi
			});
		});


		// Tombol batal pada modal
		cancelButton.addEventListener('click', (event) => {
			event.preventDefault(); // Pastikan tidak ada aksi default
			modal.classList.add('hidden'); // Sembunyikan modal
			deleteUrl = ''; // Reset URL
		});

		// Tombol hapus pada modal
		confirmButton.addEventListener('click', (event) => {
			event.preventDefault(); // Cegah aksi default
			modal.classList.add('hidden'); // Sembunyikan modal konfirmasi

			// Tampilkan modal sukses
			successModal.classList.remove('hidden');

			// Animasi selesai dalam 2 detik, lalu lanjutkan penghapusan
			setTimeout(() => {
				successModal.classList.add('hidden'); // Sembunyikan modal sukses
				if (deleteUrl) {
					window.location.href = deleteUrl; // Lanjutkan penghapusan
				}
			}, 2000); // 2 detik durasi animasi
		});

		// Cegah modal menutup jika klik di dalam konten modal
		modal.addEventListener('click', (event) => {
			if (event.target === modal) {
				modal.classList.add('hidden');
			}
		});
	</script>
</body>

</html>