<style>
    .hasil {
        width:90%;
        border: solid 1px grey;
        padding: 10px;
        background-color: #abfcff;
    }
</style>
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
<?php
include "koneksi.php";
include "ld.php";
    if (!isset($_POST['code']) || $_POST['code'] =="")
    {
        echo "";
    }
    else {
        $code = $_POST['code'];
        $removePhpTag = str_replace(array("<?php","?>","<?="), "", $code);

        //mengeksekusi kode php
        set_time_limit(5);
        echo "<div class='alert alert-success' role='alert'><strong>Output : </strong>";
		          eval($removePhpTag);
        echo "</div>"; 
?>
    <div class="row">
        <div class="col">
            <?php
            $idSoal = $_POST['id_soal'];
            $jawabanBersih = str_replace(array(" ","\n","\r","\t"), "", $removePhpTag); //menghilangkan spasi, enter, dan tab

            //membaca semua jawaban berdasarkan id soal
            $qryJawaban = mysqli_query($koneksi, "SELECT * FROM jawaban WHERE id_soal = '$idSoal'");

            //cek kemiripan antara jawaban siswa dengan seluruh jawaban di database
            while($dataJawaban = mysqli_fetch_assoc($qryJawaban))
            {
              //cek kemiripan untuk setiap jawaban
              $similarity = round(similarity($jawabanBersih, $dataJawaban['jawaban_bersih']));

              // percabangan untuk warna latar kemiripan
              if ($similarity >= 80 && $similarity <= 100) {
                $bg = 'btn-success'; //warna hijau jika kemiripan >= 80%
              } else if ($similarity >= 70 && $similarity < 80) {
                $bg = 'btn-warning'; //warna kuning jika kemiripan >= 70%
              }
              else {
                $bg = 'btn-danger'; //warna merah jika kemiripan < 70%
              }
              
              //tampilkan kemiripan
              echo "Kemiripan dengan jawaban adalah: "."<span class='btn $bg'>".$similarity."%</span><br>";
            }
              
              
            ?> 
        </div>
    </div>
    <?php
    }
    ?>