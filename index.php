<?php
include 'koneksi.php';

// Ambil kata kunci dari form pencarian jika ada
$keyword = isset($_GET['cari']) ? mysqli_real_escape_string($koneksi, $_GET['cari']) : '';

$jml_pasien = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pasien"))['total'];
$jml_dokter = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM dokter"))['total'];
$jml_obat   = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM obat"))['total'];
$jml_rekam  = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM rekam_medis"))['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - CliniSys</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Layout Atas: Banner Selamat Datang + Kotak Jam & Kalender Mini */
        .welcome-calendar-row {
            display: grid;
            grid-template-columns: 1fr 275px;
            gap: 20px;
            margin-bottom: 24px;
            align-items: stretch;
        }
        @media (max-width: 900px) {
            .welcome-calendar-row {
                grid-template-columns: 1fr;
            }
        }

        /* Kotak Kalender & Jam Mini Estetik */
        .mini-cal-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 14px 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.06);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .mini-clock-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f0fdfa;
            border: 1px solid #ccfbf1;
            padding: 6px 10px;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .mini-clock-time {
            font-size: 13.5px;
            font-weight: 800;
            color: #0f766e;
            font-variant-numeric: tabular-nums;
            letter-spacing: 0.5px;
        }
        .mini-clock-zone {
            font-size: 10px;
            font-weight: 700;
            color: #14b8a6;
            background: #ffffff;
            padding: 2px 6px;
            border-radius: 5px;
        }
        .mini-cal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        .mini-cal-title {
            font-size: 12.5px;
            font-weight: 700;
            color: #0f766e;
            letter-spacing: 0.2px;
        }
        .mini-cal-nav {
            display: flex;
            gap: 4px;
        }
        .mini-cal-btn {
            background: #f0fdfa;
            color: #0f766e;
            border: none;
            width: 22px;
            height: 22px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
        }
        .mini-cal-btn:hover {
            background: #14b8a6;
            color: #ffffff;
        }
        .mini-cal-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            font-size: 9.5px;
            font-weight: 700;
            color: #94a3b8;
            margin-bottom: 4px;
        }
        .mini-cal-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
            text-align: center;
        }
        .mini-day {
            font-size: 11px;
            font-weight: 500;
            color: #334155;
            padding: 3.5px 0;
            border-radius: 6px;
            transition: 0.15s;
        }
        .mini-day:not(.empty):hover {
            background: #f0fdfa;
            color: #0f766e;
        }
        .mini-day.today {
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            color: #ffffff;
            font-weight: 700;
            box-shadow: 0 2px 6px rgba(20, 184, 166, 0.35);
        }
        .mini-day.sun {
            color: #f43f5e;
        }
        .mini-day.today.sun {
            color: #ffffff;
        }
    </style>
</head>
<body>

    <!-- Sidebar Hijau Tosca -->
    <div class="sidebar">
        <div class="brand">🏥 CliniSys</div>
        
        <!-- Profile Card Interaktif -->
        <a href="javascript:void(0)" onclick="alert('Profil Admin Aktif: Admin Medis (Petugas Rekam Medis)')" style="text-decoration: none; color: inherit;">
            <div class="sidebar-user" style="cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">
                <div class="avatar">A</div>
                <div class="user-info">
                    <div class="name">Admin Medis ⚙️</div>
                    <div class="role">Petugas Rekam Medis</div>
                </div>
            </div>
        </a>

        <ul class="sidebar-menu">
            <li><a href="index.php" class="active">📊 Dashboard</a></li>
            <li><a href="pasien.php">👤 Data Pasien</a></li>
            <li><a href="dokter.php">👨‍⚕️ Data Dokter</a></li>
            <li><a href="obat.php">💊 Data Obat</a></li>
            <li><a href="rekam_medis.php">📋 Rekam Medis</a></li>
        </ul>
    </div>

    <!-- Area Utama -->
    <div class="main-content">
        <div class="top-nav">
            <h1>Overview Dashboard</h1>
            
            <!-- Form Pencarian Fungsional -->
            <form action="index.php" method="GET" class="search-box">
                🔍 <input type="text" name="cari" placeholder="Cari nama / No. RM pasien..." value="<?php echo htmlspecialchars($keyword); ?>">
            </form>
        </div>

        <!-- Baris Atas: Banner Selamat Datang + Kotak Jam & Kalender Mini -->
        <?php if (empty($keyword)): ?>
        <div class="welcome-calendar-row">
            <div style="background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%); color: #ffffff; padding: 24px 28px; border-radius: 16px; box-shadow: 0 4px 14px rgba(15, 118, 110, 0.15); display: flex; flex-direction: column; justify-content: center;">
                <h2 style="font-size: 20px; font-weight: 700; margin-bottom: 8px;">👋 Selamat Datang di CliniSys</h2>
                <p style="font-size: 13.5px; color: #f0fdfa; line-height: 1.6; opacity: 0.95;">
                    Sistem Informasi Rekam Medis terpadu untuk mengelola data pasien, dokter, persediaan obat, dan riwayat pemeriksaan medis secara aman dan efisien.
                </p>
            </div>

            <!-- Kotak Jam & Kalender Mini -->
            <div class="mini-cal-card">
                <!-- Bar Jam Real-Time -->
                <div class="mini-clock-bar">
                    <span class="mini-clock-time" id="liveClock">00:00:00</span>
                    <span class="mini-clock-zone">WIB</span>
                </div>

                <!-- Header Kalender -->
                <div class="mini-cal-header">
                    <span class="mini-cal-title" id="miniMonthYear"></span>
                    <div class="mini-cal-nav">
                        <button type="button" class="mini-cal-btn" id="prevM">&#10094;</button>
                        <button type="button" class="mini-cal-btn" id="nextM">&#10095;</button>
                    </div>
                </div>
                <div class="mini-cal-weekdays">
                    <div style="color:#f43f5e;">M</div>
                    <div>S</div>
                    <div>S</div>
                    <div>R</div>
                    <div>K</div>
                    <div>J</div>
                    <div>S</div>
                </div>
                <div class="mini-cal-days" id="miniCalDays"></div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Kartu Statistik -->
        <div class="cards-grid">
            <div class="card-stat">
                <div class="card-icon" style="background: #ccfbf1; color: #0f766e;">👤</div>
                <div class="card-info">
                    <div class="title">Total Pasien</div>
                    <div class="number"><?php echo $jml_pasien; ?></div>
                </div>
            </div>

            <div class="card-stat">
                <div class="card-icon" style="background: #e0f2fe; color: #0284c7;">👨‍⚕️</div>
                <div class="card-info">
                    <div class="title">Total Dokter</div>
                    <div class="number"><?php echo $jml_dokter; ?></div>
                </div>
            </div>

            <div class="card-stat">
                <div class="card-icon" style="background: #fef3c7; color: #d97706;">💊</div>
                <div class="card-info">
                    <div class="title">Total Obat</div>
                    <div class="number"><?php echo $jml_obat; ?></div>
                </div>
            </div>

            <div class="card-stat">
                <div class="card-icon" style="background: #f3e8ff; color: #9333ea;">📋</div>
                <div class="card-info">
                    <div class="title">Total Pemeriksaan</div>
                    <div class="number"><?php echo $jml_rekam; ?></div>
                </div>
            </div>
        </div>

        <!-- Tabel Hasil Pencarian Pasien (Jika Ada Keyword) -->
        <?php if (!empty($keyword)): ?>
            <div class="table-container">
                <div class="table-header">
                    <h2>Hasil Pencarian Pasien: "<?php echo htmlspecialchars($keyword); ?>"</h2>
                    <a href="index.php" class="btn-secondary" style="font-size: 12px; padding: 6px 12px;">Reset Pencarian</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>NO RM</th>
                            <th>NAMA PASIEN</th>
                            <th>JK</th>
                            <th>TGL LAHIR</th>
                            <th>ALAMAT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_cari = mysqli_query($koneksi, "SELECT * FROM pasien WHERE nama_pasien LIKE '%$keyword%' OR no_rm LIKE '%$keyword%'");
                        if (mysqli_num_rows($query_cari) > 0) {
                            while ($d = mysqli_fetch_array($query_cari)) {
                                echo "<tr>";
                                echo "<td><span class='badge-tag'>".$d['no_rm']."</span></td>";
                                echo "<td><strong>".$d['nama_pasien']."</strong></td>";
                                echo "<td>".$d['jenis_kelamin']."</td>";
                                echo "<td>".$d['tanggal_lahir']."</td>";
                                echo "<td>".$d['alamat']."</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' style='text-align:center; color:#94a3b8; padding:20px;'>Data pasien tidak ditemukan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </div>

    <!-- Script Jam Real-Time & Kalender Mini -->
    <script>
        // Jam Digital Real-Time
        function updateClock() {
            const clockEl = document.getElementById("liveClock");
            if (!clockEl) return;
            const now = new Date();
            const jam = String(now.getHours()).padStart(2, '0');
            const menit = String(now.getMinutes()).padStart(2, '0');
            const detik = String(now.getSeconds()).padStart(2, '0');
            clockEl.innerText = `🕒 ${jam}:${menit}:${detik}`;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Kalender Mini
        const bulanIndo = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        let now = new Date();
        let m = now.getMonth();
        let y = now.getFullYear();

        function drawMiniCal(month, year) {
            const container = document.getElementById("miniCalDays");
            const label = document.getElementById("miniMonthYear");
            if (!container || !label) return;

            container.innerHTML = "";
            label.innerText = `${bulanIndo[month]} ${year}`;

            const first = new Date(year, month, 1).getDay();
            const totalDays = new Date(year, month + 1, 0).getDate();
            const today = new Date();

            for (let i = 0; i < first; i++) {
                const blank = document.createElement("div");
                blank.className = "mini-day empty";
                container.appendChild(blank);
            }

            for (let d = 1; d <= totalDays; d++) {
                const cell = document.createElement("div");
                cell.className = "mini-day";
                cell.innerText = d;

                if (new Date(year, month, d).getDay() === 0) cell.classList.add("sun");
                if (d === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                    cell.classList.add("today");
                }
                container.appendChild(cell);
            }
        }

        document.getElementById("prevM")?.addEventListener("click", () => {
            m = m === 0 ? 11 : m - 1;
            if (m === 11) y--;
            drawMiniCal(m, y);
        });

        document.getElementById("nextM")?.addEventListener("click", () => {
            m = m === 11 ? 0 : m + 1;
            if (m === 0) y++;
            drawMiniCal(m, y);
        });

        drawMiniCal(m, y);
    </script>

</body>
</html>