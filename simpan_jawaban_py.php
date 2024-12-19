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

    // Nama file code siswa
    $nama_file_code_siswa = "codesiswa_" . $id_siswa . "_" . $id_soal . ".py";
    $hapus_code_siswa = unlink("code/" . $nama_file_code_siswa);

    //hapus secret testcase
    $s_test_file = "/s_testcode_" . $id_siswa . "_" . $id_soal . "_" . $id_s_testcase . ".py";
    unlink("code/" . $s_test_file);


    if ($hapus_code_siswa) {
        // Menyiapkan statement untuk mengambil data dari testcase
        $stmt_testcase = $koneksi->prepare("SELECT id_testcase FROM testcase WHERE id_soal = ?");
        $stmt_testcase->bind_param("i", $id_soal);
        $stmt_testcase->execute();
        $result_testcase = $stmt_testcase->get_result();

        while ($data_testcase = $result_testcase->fetch_assoc()) {
            $nama_file_testcase = "testcode_" . $id_siswa . "_" . $id_soal . "_" . $data_testcase["id_testcase"] . ".py";
            $hapus_testcode = unlink("code/" . $nama_file_testcase);
            if (!$hapus_testcode) {
                echo "Gagal menghapus file testcase: " . $nama_file_testcase;
                exit();
            }
        }

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
    } else {
        echo "Gagal menghapus file";
    }
}
