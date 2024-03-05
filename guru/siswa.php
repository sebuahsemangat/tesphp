<table id="myTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
    $query_siswa = mysqli_query($koneksi, "SELECT siswa.id_siswa, siswa.nis, siswa.nama AS nama_siswa, kelas.nama_kelas
    FROM siswa
    INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
    ORDER BY kelas.nama_kelas, siswa.nama");
    $no = 0;
    while($data_siswa=mysqli_fetch_assoc($query_siswa))
    
    {
        $no++;
        ?>
                        <tr>
                            <td><?= $no;?></td>
                            <td><?= $data_siswa["nis"];?></td>
                            <td><?= $data_siswa["nama_siswa"];?></td>
                            <td><?= $data_siswa["nama_kelas"];?></td>
                            <td>Action</td>
                        </tr>
    <?php
        }    
    ?>                        
                    </tbody>
                </table>