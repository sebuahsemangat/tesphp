<h2>Ganti Password</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Ambil semua data siswa
    $stmt = $koneksi->prepare("SELECT id_siswa, nis, nama, password FROM siswa where id_siswa = ?");
    $stmt->bind_param('i', $_SESSION['siswa']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    //echo $row['password'];
    //cocokkan password
    if (!password_verify($oldPassword, $row['password'])) {
        echo "Password lama anda salah!";
    } else if ($newPassword != $confirmNewPassword) {
        echo "Konfirmasi password salah!";
    } else if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/', $newPassword)) {
        echo "<p class='alert alert-danger'>Password baru harus minimal 8 karakter, memiliki satu huruf besar, satu angka, dan satu simbol.</p>";
    } else {
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt_update = $koneksi->prepare("UPDATE siswa SET password = ? WHERE id_siswa = ?");
        $stmt_update->bind_param('si', $hashedNewPassword, $id_siswa);

        if ($stmt_update->execute()) {
            echo "Password berhasil diganti.";
        } else {
            echo "Terjadi kesalahan saat mengganti password. Coba lagi.";
        }
        $stmt_update->close();
    }
    
}

$koneksi->close();
?>
<form method="post" action="">
    <!-- Input Password Lama -->
    <div class="mb-3">
        <label for="oldPassword" class="form-label">Password Lama</label>
        <input name="oldPassword" type="password" class="form-control" id="oldPassword" placeholder="Masukkan password lama" required>
    </div>

    <!-- Input Password Baru -->
    <div class="mb-3">
        <label for="newPassword" class="form-label">Password Baru</label>
        <input name="newPassword" type="password" class="form-control" id="newPassword" placeholder="Masukkan password baru" required>
    </div>

    <!-- Input Konfirmasi Password Baru -->
    <div class="mb-3">
        <label for="confirmNewPassword" class="form-label">Konfirmasi Password Baru</label>
        <input name="confirmNewPassword" type="password" class="form-control" id="confirmNewPassword" placeholder="Konfirmasi password baru" required>
    </div>

    <!-- Tombol Submit -->
    <div class="">
        <button type="submit" class="btn btn-primary">Ganti Password</button>
    </div>
</form>