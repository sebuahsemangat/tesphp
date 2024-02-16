<?php
include ("koneksi.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Ujian Praktikum PHP</title>
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/starter-template.css" rel="stylesheet">

    <link rel="stylesheet" href="codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="codemirror/theme/monokai.css">
    <script src="codemirror/lib/codemirror.js"></script>
    <script src="codemirror/addon/edit/matchbrackets.js"></script>
    <script src="codemirror/addon/edit/closebrackets.js"></script>
    <script src="codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script src="codemirror/mode/xml/xml.js"></script>
    <script src="codemirror/mode/javascript/javascript.js"></script>
    <script src="codemirror/mode/css/css.js"></script>
    <script src="codemirror/mode/clike/clike.js"></script>
    <script src="codemirror/mode/php/php.js"></script>
    <style>.CodeMirror {border: solid 1px black;}</style>
  </head>
  <body>
    
<div class="col-lg-8 mx-auto p-4 py-md-5">
  <header class="d-flex align-items-center pb-3 mb-3 border-bottom">
    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
    <img src="assets/img/icon-01.png" alt="" width="40px" class="img mr-5">
      <span class="fs-4 ml-5">&nbsp;&nbsp;Ujian Praktikum PHP</span>
    </a>
  </header>

  <main>
    <p class="fs-4">Deskripsi Soal</p>
    <p class="fs-3 col-md-12">
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
    <div class="row">
        <div class="col">
            <form method="post" action="compile.php" target="compile">
                <input type="hidden" name="id_soal" id="" value="<?php echo $data['id_soal']?>">
                <textarea id="code" name="code" class="CodeMirror"></textarea>
                <button class="btn btn-primary btn-md mt-2" type="submit" name="submit">Run Code</button>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <iframe name="compile" scrolling="no" src="" frameborder="0" width="100%" onload="resizeIframe(this)"></iframe>
        </div>
    </div>
  </main>
  <footer class="pt-5 my-5 text-muted border-top">
    Web Tes Praktikum PHP | Dikembangkan oleh Apep Wahyudin
  </footer>
</div>
<script>
      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 4,
        
      });
</script>
<script>
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
