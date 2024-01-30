<?php
include ("koneksi.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ujian Praktikum PHP</title>
	<style>
		textarea {
			height: 150px;
            border-radius: 10px;
		}
	</style>
    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- code mirror -->
    <link rel="stylesheet" href="codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="codemirror/theme/monokai.css">
    <script src="codemirror/lib/codemirror.js"></script>
    <script src="codemirror/addon/edit/matchbrackets.js"></script>
    <script src="codemirror/addon/edit/closebrackets.js"></script>
    <script src="codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script src="codemirror/mode/xml/xml.js"></script>
    <script src="codemirror/mode/javascript/javascript.js"></script>
    <!--<script src="codemirror/mode/css/css.js"></script>-->
    <script src="codemirror/mode/clike/clike.js"></script>
    <script src="codemirror/mode/php/php.js"></script>
    <style>.CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black;}</style>
</head>
<body>
<div class="container">
    <div class="row mt-4">
        <div class="col">
            <h2>Soal Praktikum Pemrograman PHP</h2>
            <?php
            $sql = "SELECT * FROM soal where status='aktif' ORDER BY RAND() LIMIT 1";
            $result = mysqli_query($konek, $sql);
            if ($result) {
                // Mendapatkan data dari hasil query
                $data = mysqli_fetch_assoc($result);
            
                // Menampilkan data
                echo $data["soal"];
            } else {
                // Menampilkan pesan error jika query gagal dijalankan
                echo "Error: " . mysqli_error($konek);
            }
            
            // Menutup koneksi
            mysqli_close($konek);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <form method="post" action="compile.php" target="compile">
                <input type="hidden" name="id_soal" id="" value="<?php echo $data['id_soal']?>">
                <textarea id="code" name="code"><?php //tulis?></textarea>
                <button class="btn btn-primary btn-md mt-2" type="submit" name="submit">Run Code</button>
            </form>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col">
            <iframe src="" frameborder="0" name="compile" width="90%" height="400px"></iframe>
        </div>
    </div>
    <p class="text-center">Web Tes Praktikum PHP | Dikembangkan oleh Apep Wahyudin</p>
</div>

<script>
      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 4,
        indentWithTabs: true,
        theme: "monokai",
        autoCloseBrackets: true
      });
    </script>
</body>
</html>
