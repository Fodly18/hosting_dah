<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/kelas_b/team_1/assets/css/dashboardberita.css">
    <title>Tambah Data Siswa - Admin Dashboard</title>
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
			<li  class="active">
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
                    <h1>Tambah Data Siswa</h1>
                    <ul class="breadcrumb">
                        <li><a href="/kelas_b/team_1/admin">Dashboard</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a href="/kelas_b/team_1/siswa">Data Siswa</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#">Tambah Siswa</a></li>
                    </ul>
                </div>
            </div>

            <div class="form-container">
                <?php if (isset($errors['system'])): ?>
                    <div class="error-message" style="margin-bottom: 1rem;">
                        <?= htmlspecialchars($errors['system'][0]) ?>
                    </div>
                <?php endif; ?>

                <form action="/kelas_b/team_1/siswa/create" method="post" id="createForm" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" required 
                               pattern="[0-9]{10}" maxlength="10">
                        <div class="form-hint">NISN harus 10 digit angka</div>
                        <?php if (isset($errors['nisn'])): ?>
                            <?php foreach ($errors['nisn'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" required 
                               maxlength="100">
                        <?php if (isset($errors['nama'])): ?>
                            <?php foreach ($errors['nama'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="nomor_hp">Nomor HP</label>
                        <input type="tel" class="form-control" id="nomor_hp" name="nomor_hp" required 
                               pattern="[0-9]{10,13}" maxlength="13">
                        <div class="form-hint">Nomor HP harus 10-13 digit angka</div>
                        <?php if (isset($errors['nomor_hp'])): ?>
                            <?php foreach ($errors['nomor_hp'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required 
                               minlength="6">
                        <div class="form-hint">Password minimal 6 karakter</div>
                        <?php if (isset($errors['password'])): ?>
                            <?php foreach ($errors['password'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="nama_kelas">Kelas</label>
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
                        <a href="/kelas_b/team_1/siswa" class="btn btn-danger">
                            <i class='bx bx-x'></i>
                            <span>Batal</span>
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </section>

    <script src="/kelas_b/team_1/assets/js/paket-tabel.js"></script>

    <script>

        // Form validation
        function validateForm() {
            const nisn = document.getElementById('nisn').value;
            const nomor_hp = document.getElementById('nomor_hp').value;
            const password = document.getElementById('password').value;

            // Validate NISN
            if (!/^[0-9]{10}$/.test(nisn)) {
                alert('NISN harus 10 digit angka');
                return false;
            }

            // Validate phone number
            if (!/^[0-9]{10,13}$/.test(nomor_hp)) {
                alert('Nomor HP harus berupa 10-13 digit angka');
                return false;
            }

            // Validate password
            if (password.length < 6) {
                alert('Password minimal 6 karakter');
                return false;
            }

            return true;
        }

        // Add input event listeners for real-time validation
        document.getElementById('nomor_hp').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13);
        });

        document.getElementById('nisn').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 18);
        });
    </script>
</body>
</html>
