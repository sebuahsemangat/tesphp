<?php
// Ambil id_kelas dari URL dan validasi
$id_kelas = isset($_GET['id_kelas']) ? intval($_GET['id_kelas']) : 0;

if ($id_kelas > 0) {

    // Menyiapkan query dengan prepared statements
    $query = "
        SELECT siswa.id_siswa, siswa.nis, siswa.nama AS nama_siswa, kelas.nama_kelas
        FROM siswa
        INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
        WHERE kelas.id_kelas = ?
        ORDER BY kelas.nama_kelas, siswa.nama
    ";

    // Menyiapkan statement
    if ($stmt = mysqli_prepare($koneksi, $query)) {
        // Mengikat parameter ke statement
        mysqli_stmt_bind_param($stmt, "i", $id_kelas);

        // Mengeksekusi statement
        mysqli_stmt_execute($stmt);

        // Mengikat hasil ke variabel
        mysqli_stmt_bind_result($stmt, $id_siswa, $nis, $nama_siswa, $nama_kelas);
        if (mysqli_stmt_fetch($stmt)) {
            echo "<h5>Data Siswa Kelas " . htmlspecialchars($nama_kelas) . "</h5>";
        }
        // Memulai output HTML
        echo '<table id="myTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';

        // Inisialisasi nomor urut
        $no = 0;

        // Fetching data
        while (mysqli_stmt_fetch($stmt)) {
            $no++;
            echo "<tr>";
            echo "<td>" . htmlspecialchars($no) . "</td>";
            echo "<td>" . htmlspecialchars($nis) . "</td>";
            echo "<td>" . htmlspecialchars($nama_siswa) . "</td>";
            echo "<td>" . htmlspecialchars($nama_kelas) . "</td>";
            echo "<td>Action</td>";
            echo "</tr>";
        }

        // Menutup HTML
        echo '    </tbody>
              </table>';

        // Menutup statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

    // Tutup koneksi database
    mysqli_close($koneksi);
} else {
    echo "ID Kelas tidak valid.";
}
