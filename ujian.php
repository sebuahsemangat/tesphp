<h2>Selamat Datang <?= $data_siswa["nama"]; ?></h2>

<table id="myTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Nama Ujian</th>
            <th>Jumlah Soal</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //ambil data ujian berdasarkan kelas siswa dan statusnya aktif
        $qry_ujian = mysqli_query($koneksi, "SELECT ujian.id_ujian, ujian.nama_ujian, COUNT(soal.id_soal) AS jumlah_soal
    FROM ujian
    LEFT JOIN ujian_kelas ON ujian.id_ujian = ujian_kelas.id_ujian
    LEFT JOIN soal ON ujian.id_ujian = soal.id_ujian
    WHERE ujian_kelas.id_kelas = '$data_siswa[id_kelas]' and ujian.status = 'aktif' GROUP BY ujian.id_ujian, ujian.nama_ujian
          ORDER BY ujian.id_ujian DESC");
        // pecah menjadi array kemudian looping
        while ($data_ujian = mysqli_fetch_assoc($qry_ujian)) {
        ?>
            <tr>
                <td><?= $data_ujian['nama_ujian']; ?></td>
                <td><?= $data_ujian['jumlah_soal'];?></td>
                <td><?= "<a href='home.php?page=soal&id_ujian=" . $data_ujian['id_ujian'] . "'>Kerjakan</a>" ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>