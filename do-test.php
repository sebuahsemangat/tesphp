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
    <h4><?= $data["judul"];?></h4>
    
    <div class="mb-3 p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3">
      <p><?= $data["soal"];?></p>
    </div>
            <form method="post" action="compile.php" target="compile" class="mb-2">
                <input type="hidden" name="id_soal" id="" value="<?php echo $data['id_soal']?>">
                <textarea id="code" name="code" class="CodeMirror"></textarea>
                <button class="btn btn-primary btn-md mt-2" type="submit" name="submit">Run Code</button>
            </form>
        

            <iframe name="compile" scrolling="no" src="" frameborder="0" width="100%" onload="resizeIframe(this)"></iframe>
       
