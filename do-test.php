
  
      <?php
            $id_soal = addslashes($_GET['id_soal']); //id soal
            $sql = "SELECT * FROM soal where status='aktif' AND id_soal = '$id_soal' LIMIT 1";
            $result = mysqli_query($koneksi, $sql);
            $hitungsoal = mysqli_num_rows($result);
            if($hitungsoal == 1) //hanya jika jumlah soal adalah 1
            {
                    
                // Mendapatkan data dari hasil query
                $data = mysqli_fetch_assoc($result);
            
                // Menampilkan data
                echo $data["soal"];
            }
            else
            {
              echo "Data Soal tidak ditemukan";
            }
            ?>
    </p>
    
            <form method="post" action="compile.php" target="compile" class="mb-2">
                <input type="hidden" name="id_soal" id="" value="<?php echo $data['id_soal']?>">
                <textarea id="code" name="code" class="CodeMirror"></textarea>
                <button class="btn btn-primary btn-md mt-2" type="submit" name="submit">Run Code</button>
            </form>
        

            <iframe name="compile" scrolling="no" src="" frameborder="0" width="100%" onload="resizeIframe(this)"></iframe>
       
