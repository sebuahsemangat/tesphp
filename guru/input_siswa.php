<?php

// Cek level pengguna
if ($_SESSION['level'] != "admin") {
    echo "You don't have access to this page!";
    exit();
}
// Ambil id_kelas dari URL
$id_kelas = isset($_GET['id_kelas']) ? intval($_GET['id_kelas']) : 0;
$nama_kelas = '';

// Cek apakah id_kelas valid dan ada di database
if ($id_kelas > 0) {
    $stmt = $koneksi->prepare("SELECT nama_kelas FROM kelas WHERE id_kelas = ?");
    $stmt->bind_param('i', $id_kelas);
    $stmt->execute();
    $stmt->bind_result($nama_kelas);
    $stmt->fetch();
    $stmt->close();
}

if (!$nama_kelas) {
    echo "Kelas tidak ditemukan!";
    exit();
}

require '../vendor/autoload.php'; // Menggunakan PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['submit'])) {
    // Ambil id_kelas dari form
    $id_kelas = isset($_POST['id_kelas']) ? intval($_POST['id_kelas']) : 0;

    // Ambil password dari input form dan hash untuk keamanan
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah file sudah diupload
    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];

        // Cek ekstensi file
        $allowedExtensions = ['xls', 'xlsx'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        if (in_array($fileExtension, $allowedExtensions)) {
            // Membaca file Excel
            $spreadsheet = IOFactory::load($fileTmpName);
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestRow(); // Mendapatkan jumlah baris pada file Excel

            // Looping melalui setiap baris di file Excel
            for ($row = 2; $row <= $highestRow; $row++) { // Mulai dari baris 2 karena baris 1 adalah header
                $nis = $sheet->getCell('A' . $row)->getValue();
                $nama = $sheet->getCell('B' . $row)->getValue();

                // Masukkan data ke tabel siswa
                $stmt = $koneksi->prepare("INSERT INTO siswa (nis, nama, password, id_kelas) VALUES (?, ?, ?, ?)");
                $stmt->bind_param('sssi', $nis, $nama, $hashedPassword, $id_kelas);
                $stmt->execute();
            }

            echo "Data berhasil diimpor.";
        } else {
            echo "Format file tidak didukung. Harap upload file Excel dengan ekstensi .xls atau .xlsx.";
        }
    } else {
        echo "Harap pilih file untuk diupload.";
    }
} else {
    echo "";
}

$koneksi->close();
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="kelas" class="form-label">Kelas</label>
        <input type="hidden" name="id_kelas" id="" value="<?php echo htmlspecialchars($id_kelas); ?>">
        <strong><?php echo htmlspecialchars($nama_kelas); ?></strong>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">File Excel</label>
        <input type="file" class="form-control" id="file" name="file" required>
        <small id="passwordHelpBlock" class="form-text text-muted">
            <a href="#">Download Format di Sini</a>
        </small>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password Siswa</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary mb-3" name="submit">Simpan</button>
    </div>
</form>