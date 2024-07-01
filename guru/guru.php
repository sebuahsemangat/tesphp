<?php
if($_SESSION['level']=="guru") {
    echo "You don't have access to this page!";
    exit();
}
function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Query untuk mendapatkan data guru dengan level = 'guru'
$stmt = $koneksi->prepare("SELECT username, nama, level FROM guru WHERE level = ?");
$level = 'guru';
$stmt->bind_param("s", $level);
$stmt->execute();
$result = $stmt->get_result();
?>
<h3 class="mt-2">Data Guru</h3> <a href="home.php?page=input_guru" class="btn btn-primary">Tambah Guru</a>
<table class="table table-striped table-bordered" id="myTable">
    <thead>
        <tr>
            <th>Username</th>
            <th>Nama</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Menampilkan data guru dalam tabel
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . cleanInput($row['username']) . "</td>";
            echo "<td>" . cleanInput($row['nama']) . "</td>";
            echo "<td>" . cleanInput($row['level']) . "</td>";
            echo "<td><a href='#'>Hapus</a></td>";
            echo "</tr>";
        }
        // Menutup statement
        $stmt->close();
        // Menutup koneksi database
        $koneksi->close();
        ?>
    </tbody>
</table>