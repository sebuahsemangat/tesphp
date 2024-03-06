<?php
    $id_soal = addslashes($_GET['id_soal']); //id soal
    $sql = "SELECT * FROM soal where status='aktif' AND id_soal = '$id_soal' LIMIT 1";
    $result = mysqli_query($koneksi, $sql);
    $hitungsoal = mysqli_num_rows($result);
    if($hitungsoal != 1) //Jika jumlah soal tidak sama dengan 1
        {
            echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";               
        }
    else
        {
        // Mendapatkan data dari hasil query
        $data = mysqli_fetch_assoc($result);
        }
?>
<div class="mb-3 p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3">
    <h4>Soal:</h4>
    <p><?= $data["soal"];?></p>
</div>
    <h4>Input Jawaban:</h4>

    <?php
    if(!isset($_POST['submit']))
    {
        echo "";
    }
    else {
    $id_soal_input = $_POST['id_soal'];
    $jawaban = addslashes($_POST['jawaban']);

    //hapus awalan php, spasi, dan enter
    $jawaban_bersih = str_replace(array("<?php","?>"," ","\r", "\n", "\t"),"",$jawaban);
    
        $sql = "INSERT INTO jawaban (id_soal, jawaban, jawaban_bersih) VALUES ('$id_soal_input','$jawaban', '$jawaban_bersih')";
        $query = mysqli_query($koneksi, $sql);
        if($query)
        {
            echo "<div class='alert alert-success' role='alert'>Jawaban berhasil diinput</div>";
        }
        else
        {
            echo "Soal gagal diinput";
        }
    }
    ?>
<form method="post" action="" class="mb-2">
    <input type="hidden" name="id_soal" id="" value="<?= $id_soal; ?>">
    <textarea id="code" name="jawaban" class="CodeMirror"></textarea>
    <button class="btn btn-primary btn-md mt-2" type="submit" name="submit">Simpan Jawaban</button>
</form>