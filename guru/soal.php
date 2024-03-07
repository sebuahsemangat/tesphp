    <?php
        //ambil id_ujian
        $id_ujian = addslashes($_GET['id_ujian']);
        //ambil judul ujian
        $qry_ujian=mysqli_query($koneksi, "SELECT id_ujian, nama_ujian FROM ujian where id_ujian='$id_ujian' AND status ='aktif'");
        //pecah array
        $data_ujian=mysqli_fetch_assoc($qry_ujian);
        echo "<h4>" . $data_ujian['nama_ujian'] . "</h4>";
    ?>
    <p><a href="home.php">Kembali</a> | <a href="home.php?page=input_soal&id_ujian=<?= $id_ujian;?>">Tambah Soal</a></p>
    <h4>List Soal</h4>
    <table id="myTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Soal</th>
            <th>Jumlah Jawaban</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
    //ambil data soal berdasarkan id_ujian dan status aktif
    $qry_soal = mysqli_query($koneksi, "SELECT * FROM soal where id_ujian='$id_ujian' AND status='aktif'");
    //pecah menjadi array dan looping
    $no = 0;
    while($data_soal=mysqli_fetch_assoc($qry_soal)){
        $query_jawaban = mysqli_query($koneksi, "SELECT jawaban from jawaban WHERE id_soal='$data_soal[id_soal]'");
        $hitung_jawaban = mysqli_num_rows($query_jawaban);
        $no++;
    ?>
    
        <tr>
            <td><?= $no;?></td>
            <td><?= $data_soal['judul'];?></td>
            <td><?= $hitung_jawaban;?></td>
            <td>
                <a href="">Detail</a> |
                <a href="home.php?page=input_jawaban&id_soal=<?=$data_soal['id_soal'];?>">Tambah Jawaban</a> |
                <a href="">Edit</a> |
                <a href="">Hapus</a>
            </td>
        </tr>
    <?php
    //akhir looping soal
    }
    ?>
    </tbody>
    </table>
