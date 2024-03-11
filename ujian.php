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
        $qry_ujian = mysqli_query($koneksi, "SELECT * FROM ujian WHERE id_kelas='$data_siswa[id_kelas]' AND status='aktif'");
        // pecah menjadi array kemudian looping
        while ($data_ujian = mysqli_fetch_assoc($qry_ujian)) {
            $qry_soal = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_ujian = '$data_ujian[id_ujian]'");
            $jumlah_soal = mysqli_num_rows($qry_soal);
        ?>
            <tr>
                <td><?= $data_ujian['nama_ujian']; ?></td>
                <td><?= $jumlah_soal; ?></td>
                <td><?= "<a href='home.php?page=soal&id_ujian=" . $data_ujian['id_ujian'] . "'>Kerjakan</a>" ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>