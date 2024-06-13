<?php
include "koneksi.php";
$id_siswa = $_POST['id_siswa'];
$id_soal = $_POST['id_soal'];
$hasil = $_POST['hasil'];
$nama_file_code_siswa = "codesiswa_" . $id_siswa . "_" . $id_soal . ".php";
$hapus_code_siswa = unlink("code/" . $nama_file_code_siswa);
if($hapus_code_siswa){
    $select_testcase = mysqli_query($koneksi, "SELECT * FROM testcase WHERE id_soal = '$id_soal'");
    while($data_testcase = mysqli_fetch_assoc($select_testcase)){
        $nama_file_testcase = "testcode_" . $id_siswa . "_" . $id_soal . "_" . $data_testcase["id_testcase"] . ".php";
        $hapus_testcode = unlink("code/" . $nama_file_testcase);
        if($hapus_testcode){
            echo "testcode " . $nama_file_testcase . " berhasil dihapus<br>";
        }
        else {
            echo "testcode gagal dihapus<br>";
        }
    }

echo htmlspecialchars($hasil);
}
else {
    echo "Gagal menghapus file";
}