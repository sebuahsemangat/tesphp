<?php
session_start();
include "koneksi.php";
if (!isset ($_SESSION['siswa'])) {
    header("location: index.php");
    exit();
} else {
    //variabel session
    $id_siswa = $_SESSION["siswa"];
    //ambil data siswa
    $qry_siswa = mysqli_query($koneksi, "SELECT * FROM siswa where id_siswa='$id_siswa'");
    //pecah menjadi array
    $data_siswa = mysqli_fetch_assoc($qry_siswa);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Tes PHP</title>
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
    <style>
        /* CSS tambahan sesuai kebutuhan */
        .navbar {
            background-color: #007bff;
            /* Warna biru PHP */
        }

        .navbar-nav,
        .navbar-brand {
            padding-left: 20px;
            padding-right: 20px;
        }

        .navbar-nav .nav-item {
            margin-right: 10px;
        }

        .navbar-nav .nav-link {
            color: #fff;
            /* Warna tulisan putih */
        }

        .logout {
            background-color: #dc3545;
            /* Warna merah untuk menu logout */
            border-radius: 5px;
        }

        .row {
            border: solid 1px #CCC;
            border-radius: 10px;
            box-shadow: 5px 5px 5px #DDD;
            padding-bottom: 10px;
        }

        .footer {
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            /* Warna latar belakang footer */
            text-align: center;
            padding: 10px 0;
        }
    </style>
    <?php
    if(isset ($_GET['page']) && $_GET['page'] != '' ){
        
    if ($_GET['page'] == 'kerjakan' || $_GET['page']=='lihat_jawaban') {
        ?>
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
        <style>
            .CodeMirror {
                border: solid 1px black;
            }
        </style>
        <?php
    }
}
    ?>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <?= $data_siswa["nama"]; ?>
                    </a>
                </li>
                <li class="nav-item logout">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12 p-50">
                <?php
                if (isset ($_GET['page']) && $_GET['page'] != '') {
                    $page = addslashes($_GET['page']);
                    switch ($page) {
                        default:
                            include "ujian.php";
                            break;
                        case "soal":
                            include "soal.php";
                            break;
                        case "kerjakan":
                            include "do-test.php";
                            break;
                        case "lihat_jawaban":
                            include "lihat_jawaban.php";
                            break;
                    }
                } else {
                    // Jika kunci 'page' tidak diatur atau kosong, sertakan file "ujian.php" secara default
                    include "ujian.php";
                }
                ?>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Website Ujian Pemrograman PHP | Dikembangkan oleh Apep Wahyudin</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
    <!-- Inisialisasi DataTables -->
    <script>
        let table = new DataTable('#myTable');
    </script>

    <script>
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
            lineNumbers: true,
            matchBrackets: true,
            mode: "application/x-httpd-php",
            indentUnit: 4,

        });
        editor.on("beforeChange", function (_, change) {
            if (change.origin == "paste") change.cancel()
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