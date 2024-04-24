    <?php
        //ambil id_ujian
        $id_ujian = addslashes($_GET['id_ujian']);
        //ambil judul ujian
        $qry_ujian=mysqli_query($koneksi, "SELECT id_ujian, nama_ujian FROM ujian where id_ujian='$id_ujian' AND status ='aktif'");
        //pecah array
        $data_ujian=mysqli_fetch_assoc($qry_ujian);
        echo "<h2>" . $data_ujian['nama_ujian'] . "</h2>";
    ?>
    <p><a href="home.php">Kembali</a></p>
    <h4>List Soal</h4>
    <table id="myTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Soal</th>
            <!--<th>Durasi Waktu</th>-->
            <th>Nilai</th>
            <th>Pengerjaan</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
    //ambil data soal berdasarkan id_ujian dan status aktif
    $qry_soal = mysqli_query($koneksi, "SELECT * FROM soal where id_ujian='$id_ujian' AND status='aktif'");
    //pecah menjadi array dan looping
    $no = 0;
    while($data_soal=mysqli_fetch_assoc($qry_soal)){
        $qry_nilai = mysqli_query($koneksi,"SELECT * FROM hasil WHERE id_soal = '$data_soal[id_soal]'
        AND id_siswa = '$_SESSION[siswa]'");
        $data_nilai = mysqli_fetch_assoc($qry_nilai);
        $jmlh_nilai = mysqli_num_rows($qry_nilai);
        $no++;
    ?>
    
        <tr>
            <td><?= $no;?></td>
            <td><?= $data_soal['judul'];?></td>
            <!--<td></td>-->
            <td>
                <?php 
                if($jmlh_nilai == 0)
                {
                    echo 'Belum Dinilai';
                }
                else {
                    echo $data_nilai['nilai'];
                }

                ?>
            </td>
            <td>
                <?php
                //cek apakah soal sudah dikerjakan
                $cek_jawaban=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM hasil
                WHERE id_siswa='$data_siswa[id_siswa]' AND id_soal='$data_soal[id_soal]'"));
                
                //cek_jawaban menghasilkan angka 1
                if($cek_jawaban==1){
                    echo "Sudah dikerjakan";
                }
                else
                //jika cek_jawaban menghasilkan angka 0
                {
                    echo "Belum dikerjakan";
                }
                ?>
            </td>
            <td>
                <?php
                if($cek_jawaban==1){
                    echo "<a href='#'>Lihat Jawaban</a>";
                }
                else
                //jika cek_jawaban menghasilkan angka 0
                {
                    echo "<a href='home.php?page=kerjakan&id_ujian=$data_ujian[id_ujian]&id_soal=$data_soal[id_soal]'>Kerjakan</a>";
                }
                
                ?>
            
            </td>
        </tr>
    <?php
    //akhir looping soal
    }
    ?>
    </tbody>
    </table>
