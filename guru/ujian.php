            
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
    $qry_ujian = mysqli_query($koneksi, "SELECT * FROM ujian WHERE status='aktif'");
    // pecah menjadi array kemudian looping
    while($data_ujian=mysqli_fetch_assoc($qry_ujian))
    {
        ?>
                        <tr>
                            <td><?= $data_ujian['nama_ujian'];?></td>
                            <td>
                                <?php
                                $qry_Soal = mysqli_query($koneksi, "SELECT soal FROM soal WHERE id_ujian='$data_ujian[id_ujian]'");
                                $jmlh_soal = mysqli_num_rows($qry_Soal);
                                echo $jmlh_soal;
                                ?>

                            </td>
                            <td>
                                <?= "<a href='home.php?page=soal&id_ujian=" . $data_ujian['id_ujian'] . "'>Edit</a>"?>
                                <?= "<a href='home.php?page=soal&id_ujian=" . $data_ujian['id_ujian'] . "'>Lihat Soal</a>"?>
                                <?= "<a href='home.php?page=soal&id_ujian=" . $data_ujian['id_ujian'] . "'>Hapus</a>"?>
                            </td>
                        </tr>
    <?php
        }    
    ?>                        
                    </tbody>
                </table>