<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil dan menyaring input dari POST
    $id_siswa = filter_input(INPUT_POST, 'id_siswa', FILTER_SANITIZE_NUMBER_INT);
    $id_soal = filter_input(INPUT_POST, 'id_soal', FILTER_SANITIZE_NUMBER_INT);
    $id_ujian = filter_input(INPUT_POST, 'id_ujian', FILTER_SANITIZE_NUMBER_INT);
    $id_s_testcase = filter_input(INPUT_POST, 'id_s_testcase', FILTER_SANITIZE_NUMBER_INT);
    $hasil = htmlspecialchars($_POST['hasil'], ENT_QUOTES, 'UTF-8');
    $test_result = filter_input(INPUT_POST, 'test_result', FILTER_SANITIZE_STRING);


    
        // Menyiapkan statement untuk mengambil data dari testcase
        $stmt_testcase = $koneksi->prepare("SELECT id_testcase FROM testcase WHERE id_soal = ?");
        $stmt_testcase->bind_param("i", $id_soal);
        $stmt_testcase->execute();
        $result_testcase = $stmt_testcase->get_result();

        // Menyiapkan statement untuk menyimpan jawaban
        $stmt_jawaban = $koneksi->prepare("INSERT INTO hasil (id_soal, id_ujian, id_siswa, jawaban, test_result) VALUES (?, ?, ?, ?, ?)");
        $stmt_jawaban->bind_param("iiiss", $id_soal, $id_ujian, $id_siswa, $hasil, $test_result);

        if ($stmt_jawaban->execute()) {
            // Menentukan lokasi home.php
            $home_url = 'home.php?page=soal&id_ujian=' . $id_ujian;

            // Script JavaScript untuk mengubah lokasi parent frame
            echo "<script>window.parent.location.href = '$home_url';</script>";
        } else {
            echo "Gagal menyimpan jawaban";
        }
    
}
