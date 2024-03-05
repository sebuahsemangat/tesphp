<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Guru | Tes PHP</title>
    <style>
        /* CSS tambahan sesuai kebutuhan */
        .navbar {
            background-color: #007bff; /* Warna biru PHP */
        }
        .navbar-nav, .navbar-brand  {
            padding-left: 20px;
            padding-right: 20px;
        }
        .navbar-nav .nav-item {
            margin-right: 10px;
        }
        .navbar-nav .nav-link {
            color: #fff; /* Warna tulisan putih */
        }
        .logout {
            background-color: #dc3545; /* Warna merah untuk menu logout */
            border-radius: 5px;
        }
        .row {
            border : solid 1px #CCC;
            border-radius : 10px;
            box-shadow: 5px 5px 5px #DDD;
        }
        .footer {
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa; /* Warna latar belakang footer */
            text-align: center;
            padding: 10px 0;
        }
    </style>
    
    <link rel="stylesheet" href="../assets/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Data Siswa</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Data Ujian</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Apep Guru</a>
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
                <h2>Halaman Guru</h2>
                
            </div>
        </div>
    </div>
    
<!-- Footer -->
<div class="footer">
        <p>Website Ujian Pemrograman PHP | Dikembangkan oleh Apep Wahyudin</p>
</div>
</body>
</html>