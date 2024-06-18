<a href="home.php?page=input_ujian">Input Ujian</a>
<table id="myTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Nama Ujian</th>
            <th>Daftar Kelas</th>
            <th>Status</th>
            <th>Jumlah Soal</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $id_guru = $_SESSION['id_guru']; //id guru berdasarkan session
        //ambil data ujian berdasarkan kelas siswa dan statusnya aktif
        $qry_ujian = mysqli_query($koneksi, "SELECT * FROM ujian WHERE id_guru = '$id_guru'");
        // pecah menjadi array kemudian looping
        while ($data_ujian = mysqli_fetch_assoc($qry_ujian)) {
            ?>
            <tr>
                <td><?= $data_ujian['nama_ujian']; ?></td>
                <td>
                    <?php
                    $query_kelas = mysqli_query($koneksi, "SELECT ujian_kelas.id_ujian_kelas, kelas.nama_kelas, kelas.id_kelas
                                    FROM ujian_kelas
                                    INNER JOIN kelas ON ujian_kelas.id_kelas = kelas.id_kelas
                                    WHERE ujian_kelas.id_ujian = '$data_ujian[id_ujian]'
                                    ORDER BY ujian_kelas.id_kelas ASC");
                    while ($data_kelas = mysqli_fetch_assoc($query_kelas)) {
                        ?>
                        <a class="btn btn-primary mx-1" href="home.php?page=nilai&id_ujian=<?= $data_ujian["id_ujian"];?>&id_kelas=<?= $data_kelas["id_kelas"];?>"><?= $data_kelas["nama_kelas"];?></a>
                        <?php
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if ($data_ujian['status'] == 'aktif') {
                        $class = 'btn-success';
                    } else {
                        $class = 'btn-warning';
                    }
                    echo "<span class='btn {$class}'>" . ucwords($data_ujian['status']) . "</span>"; ?>
                </td>
                <td>
                    <?php
                    $qry_Soal = mysqli_query($koneksi, "SELECT soal FROM soal WHERE id_ujian='$data_ujian[id_ujian]'");
                    $jmlh_soal = mysqli_num_rows($qry_Soal);
                    echo $jmlh_soal;
                    ?>

                </td>
                <td>
                    <?= "<a href='home.php?page=soal&id_ujian=" . $data_ujian['id_ujian'] . "'>Edit</a>" ?>
                    <?= "<a href='home.php?page=soal&id_ujian=" . $data_ujian['id_ujian'] . "'>Lihat Soal</a>" ?>
                    <a href="hapus_ujian.php?id_ujian=<?= $data_ujian['id_ujian']; ?>"
                        onclick="return confirm('Data ujian akan dihapus! Lanjutkan?')">Hapus</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>