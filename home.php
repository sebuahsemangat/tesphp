<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['siswa'])) {
    header('location: index.php');
    exit();
} else {
    //variabel session
    $id_siswa = $_SESSION['siswa'];
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
    <title>Home | Akode;</title>
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/dist/css/style.css">
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
    <script src="codemirror/mode/python/python.js"></script>
    <style>
        .CodeMirror {
            border: solid 1px black;
        }
    </style>
    <script src="https://kit.fontawesome.com/6565789de8.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="home.php">Ak()de;</a>

            <!-- Navbar Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <strong><?= $data_siswa['nama'] ?></strong> <i class="fas fa-user-circle fa-lg"></i>
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
        <div class="row">
            <div class="col-md-12 p-50">
                <?php
                if (isset($_GET['page']) && $_GET['page'] != '') {
                    $page = addslashes($_GET['page']);
                    switch ($page) {
                        default:
                            include 'ujian.php';
                            break;
                        case 'soal':
                            include 'soal.php';
                            break;
                        case 'kerjakan':
                            include 'do-test.php';
                            $textarea_mode = "application/x-httpd-php";
                            break;
                        case 'kerjakan_py':
                            include 'do-test_py.php';
                            $textarea_mode = "python";
                            break;
                        case 'kerjakan_js':
                            include 'do-test_js.php';
                            $textarea_mode = "javascript";
                            break;
                        case 'lihat_jawaban':
                            include 'lihat_jawaban.php';
                            break;
                        case 'ganti_password':
                            include 'ganti_password.php';
                            break;
                    }
                } else {
                    // Jika kunci 'page' tidak diatur atau kosong, sertakan file "ujian.php" secara default
                    include 'ujian.php';
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <!-- Inisialisasi DataTables -->
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.5/i18n/Indonesian.json" // Bahasa Indonesia
                }
            });
        });
    </script>

    <script>
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
            lineNumbers: true,
            matchBrackets: true,
            mode: "<?php echo $textarea_mode; ?>",
            indentUnit: 4,

        });
        editor.on("beforeChange", function(_, change) {
            if (change.origin == "paste") change.cancel()
        });
    </script>
    <script>
        function resizeIframe(obj) {
            obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
        }
    </script>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <?php
            if (isset($_GET['page']) && $_GET['page'] != '' && $_GET['page'] == 'kerjakan') {
            ?>
    <script>
        // Fungsi untuk melakukan redirect saat tab baru dibuka atau jendela baru dibuka, atau saat jendela diminimalkan
        function redirectToLogout() {
            window.location.href = 'logout.php';
        }

        // Mendaftarkan event listener untuk saat tab baru dibuka atau jendela baru dibuka, atau saat jendela diminimalkan
        document.addEventListener('visibilitychange', function() {
            if (document.visibilityState === 'hidden') {
                redirectToLogout();
            }
        });

        // Mendaftarkan event listener untuk saat jendela ditutup
        window.addEventListener('beforeunload', function() {
            redirectToLogout();
        });
    </script>
    <?php
            }
    ?>
            -->
</body>

</html>