<p><a href="#">Kembali</a> | <a href="home.php?page=input_soal&id_ujian=<?= $id_ujian; ?>">Tambah Soal</a></p>
<h4>List Soal</h4>
<table id="myTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include("../koneksi.php");
        $id_soal = $_GET["id_soal"];

        // SQL query untuk mendapatkan data
        $sql = "SELECT siswa.nama AS nama_siswa, kelas.nama_kelas, hasil.nilai
                FROM hasil
                INNER JOIN siswa ON hasil.id_siswa = siswa.id_siswa
                INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
                WHERE hasil.id_soal = $id_soal
                ORDER BY kelas.nama_kelas, siswa.nama";

        $result = $koneksi->query($sql);
        if ($result->num_rows > 0) {
            $no = 0;
            while ($row = $result->fetch_assoc()) {
                $no++;
        ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row["nama_siswa"]; ?></td>
                    <td><?= $row["nama_kelas"]; ?></td>
                    <td><?= $row["nilai"]; ?></td>
                    <td>

                    </td>
                </tr>
        <?php
            }
        } else {
            echo "";
        }
        ?>
    </tbody>
</table>