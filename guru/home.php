<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirect ke halaman index jika belum login
    exit;
}
include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home <?= ucfirst($_SESSION['level']); ?> | Akode;</title>
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

        .name {
            background-color: green;
            /* Warna merah untuk menu logout */
            border-radius: 5px;
        }

        .row-main {
            border: solid 1px #CCC;
            border-radius: 10px;
            box-shadow: 5px 5px 5px #DDD;
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
    <link rel="stylesheet" href="../codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="../codemirror/theme/monokai.css">
    <script src="../codemirror/lib/codemirror.js"></script>
    <script src="../codemirror/addon/edit/matchbrackets.js"></script>
    <script src="../codemirror/addon/edit/closebrackets.js"></script>
    <script src="../codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script src="../codemirror/mode/xml/xml.js"></script>
    <script src="../codemirror/mode/javascript/javascript.js"></script>
    <script src="../codemirror/mode/css/css.js"></script>
    <script src="../codemirror/mode/clike/clike.js"></script>
    <script src="../codemirror/mode/php/php.js"></script>
    <style>
        .CodeMirror {
            border: solid 1px black;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/dist/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="home.php">Ak()de;<sup style="font-size: 1rem; background-color:white; color:#000; padding: 2px; border-radius:5px;"><?= ucfirst($_SESSION['level']); ?></sup></a>

            <!-- Navbar Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <?php
                if ($_SESSION['level'] == 'admin') {
                ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="home.php?page=guru">Data Guru</a>
                    </li>
                <?php
                }
                ?>
                <li class="nav-item active">
                    <a class="nav-link" href="home.php?page=kelas">Data Kelas</a>
                </li>
                <?php
                if ($_SESSION['level'] == 'guru') {
                ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="home.php?page=ujian">Data Ujian</a>
                    </li>
                <?php
                }
                ?>
                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <strong><?= $_SESSION["username"]; ?></strong> <i class="fas fa-user-circle fa-lg"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="home.php?page=ganti_password"><i class="fa-solid fa-key"></i> Ganti Password</a></li>
                            <li>
                                <hr>
                            </li>
                            <li><a class="dropdown-item logout-menu" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
   
    <div class="container mt-5 mb-5">
        <div class="row row-main">
            <div class="col-md-12 p-50">
                <?php
                if ($_SESSION['level'] == 'admin') {
                    $hal_default = "guru.php";
                    $kelas = "kelas_admin.php";
                } else {
                    $hal_default = "ujian.php";
                    $kelas = "kelas.php";
                }
                if (isset($_GET['page']) && $_GET['page'] != '') {
                    $page = addslashes($_GET['page']);
                    switch ($page) {
                        default:
                            include $hal_default;
                            break;
                        case "siswa":
                            include "siswa.php";
                            break;
                        case "kelas":
                            include $kelas;
                            break;
                        case "soal":
                            include "soal.php";
                            break;
                        case "input_jawaban":
                            include "input_jawaban.php";
                            break;
                        case "input_ujian":
                            include "input_ujian.php";
                            break;
                        case "input_soal":
                            include "input_soal.php";
                            break;
                        case "nilai":
                            include "nilai.php";
                            break;
                        case "nilai_ujian":
                            include "nilai_ujian.php";
                            break;
                            //admin only
                        case "input_guru":
                            include "input_guru.php";
                            break;
                        case "input_kelas":
                            include "input_kelas.php";
                            break;
                        case "input_siswa":
                            include "input_siswa.php";
                            break;
                    }
                } else {
                    include $hal_default;
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> <strong>Akode;</strong> - Developed by <strong>Apep Wahyudin</strong></p>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
    <script src="https://kit.fontawesome.com/6565789de8.js" crossorigin="anonymous"></script>
    <!-- Inisialisasi DataTables -->
    <script>
        new DataTable('#myTable', {
            layout: {
                topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                }
            }
        });
    </script>

    <!-- Code Mirror -->
    <script>
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
            lineNumbers: true,
            matchBrackets: true,
            mode: "application/x-httpd-php",
            indentUnit: 4,

        });
    </script>

    <script src="ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    </script>
</body>

</html>