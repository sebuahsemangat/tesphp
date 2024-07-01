<?php
if ($_SESSION['level'] == "guru") {
    echo "You don't have access to this page!";
    exit();
}
// Fungsi untuk membersihkan input
function cleanInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = cleanInput($_POST['username']);
    $password = cleanInput($_POST['password']);
    $nama = cleanInput($_POST['nama']);
    $level = 'guru';

    // Cek apakah username sudah ada di database
    $stmt = $koneksi->prepare("SELECT username FROM guru WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<div class='alert alert-danger' role='alert'>Username sudah ada. Silakan pilih username lain.</div>";
    } else {
        // Hash password sebelum disimpan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert data ke dalam tabel guru
        $stmt = $koneksi->prepare("INSERT INTO guru (username, password, nama, level) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $hashed_password, $nama, $level);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success' role='alert'>Data berhasil disimpan.</div>";
        } else {
            echo "Terjadi kesalahan saat menyimpan data.";
        }
    }

    // Menutup statement
    $stmt->close();
    // Menutup koneksi database
    $koneksi->close();
}
?>

<form action="" method="post">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <!-- Input untuk memasukkan nama ujian -->
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <!-- Input untuk memasukkan nama ujian -->
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Guru</label>
        <!-- Input untuk memasukkan nama ujian -->
        <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="mb-3">
        <!-- Tombol submit untuk mengirimkan data form -->
        <button type="submit" class="btn btn-primary mb-3" name="submit">Simpan</button>
    </div>
</form>