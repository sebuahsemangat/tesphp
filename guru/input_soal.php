<?php
// Memeriksa apakah data dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post'])) {
    // Menginisialisasi variabel dari data yang diterima
    $judul_soal = mysqli_real_escape_string($koneksi, $_POST['judul_soal']);
    $deskripsi_soal = mysqli_real_escape_string($koneksi, $_POST['deskripsi_soal']);
    $waktu = mysqli_real_escape_string($koneksi, $_POST['waktu']); // Mengambil waktu dari input form
    $status = "aktif";
    $function_name = filter_input(INPUT_POST, 'function_name', FILTER_SANITIZE_STRING);
    $parameter = filter_input(INPUT_POST, 'parameter', FILTER_SANITIZE_STRING);
    $id_ujian = mysqli_real_escape_string($koneksi, $_POST['id_ujian']);

    // Menyiapkan query untuk memasukkan data ke dalam tabel soal
    $query = mysqli_prepare($koneksi, "INSERT INTO soal (judul, soal, waktu, status, id_ujian, parameter, function_name) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Mengikat parameter ke pernyataan SQL
    mysqli_stmt_bind_param($query, "ssisiss", $judul_soal, $deskripsi_soal, $waktu, $status, $id_ujian, $parameter, $function_name);

    // Mengeksekusi pernyataan SQL
    if (mysqli_stmt_execute($query)) {
        echo "<div class='alert alert-success' role='alert'>Soal berhasil disimpan</div>";

        // Mendapatkan ID soal yang baru saja disimpan
        $id_soal = mysqli_insert_id($koneksi);

        // Menyiapkan query untuk memasukkan data ke dalam tabel testcase
        $query_testcase = mysqli_prepare($koneksi, "INSERT INTO testcase (id_soal, input, output) VALUES (?, ?, ?)");

        // Mengambil input dan output dari form
        $inputs = $_POST['input'];
        $outputs = $_POST['output'];

        // Mengikat parameter ke pernyataan SQL
        mysqli_stmt_bind_param($query_testcase, "iss", $id_soal, $input, $output);

        // Menyimpan setiap pasangan input dan output ke tabel testcase
        for ($i = 0; $i < count($inputs); $i++) {
            $input = mysqli_real_escape_string($koneksi, $inputs[$i]);
            $output = mysqli_real_escape_string($koneksi, $outputs[$i]);
            mysqli_stmt_execute($query_testcase);
        }

        // Menutup pernyataan testcase
        mysqli_stmt_close($query_testcase);

    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

    // Menutup pernyataan dan koneksi database
    mysqli_stmt_close($query);
    mysqli_close($koneksi);
}
?>

<form action="" method="post">
    <input type="hidden" name="id_ujian" id="" value="<?= $_GET['id_ujian']; ?>">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Judul Soal</label>
        <!-- Input untuk memasukkan nama soal -->
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Judul soal" name="judul_soal"
            required>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Deskripsi Soal</label>
        <!-- Input untuk memasukkan deskripsi soal -->
        <textarea name="deskripsi_soal" id="editor" cols="30" rows="10" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nama Fungsi</label>
        <!-- Input untuk memasukkan Nama fungsi soal -->
        <input type="text" name="function_name" id="" class="form-control">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Parameter</label>
        <!-- Input untuk memasukkan parameter soal -->
        <input type="text" name="parameter" id="" class="form-control">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Waktu (dalam menit)</label>
        <!-- Input untuk memasukkan waktu pengerjaan soal -->
        <input type="number" name="waktu" id="" class="form-control">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Sample Test
            <button type="button" class="btn btn-success btn-sm" onclick="tambahSample()">+</button>
        </label>
        <div id="sample-container">
            <div class="row" style="border:0px; box-shadow: 0px 0px 0px;">
                <div class="col">
                    Input: <input type="text" name="input[]" id="" class="form-control">
                </div>
                <div class="col">
                    Output: <input type="text" name="output[]" id="" class="form-control">
                </div>
            </div>
            <div class="row" style="border:0px; box-shadow: 0px 0px 0px;">
                <div class="col">
                    Input: <input type="text" name="input[]" id="" class="form-control">
                </div>
                <div class="col">
                    Output: <input type="text" name="output[]" id="" class="form-control">
                </div>
            </div>
            <div class="row" style="border:0px; box-shadow: 0px 0px 0px;">
                <div class="col">
                    Input: <input type="text" name="input[]" id="" class="form-control">
                </div>
                <div class="col">
                    Output: <input type="text" name="output[]" id="" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <!-- Tombol submit untuk mengirimkan data form -->
        <button type="submit" class="btn btn-primary mb-3" name="post">Simpan Soal</button>
    </div>
</form>

<script>
    function tambahSample() {
        var container = document.getElementById('sample-container');
        var div = document.createElement('div');
        div.className = 'row';
        div.style = 'border:0px; box-shadow: 0px 0px 0px;';
        div.innerHTML = `
        <div class="col">
            Input: <button type="button" class="btn btn-danger btn-sm" onclick="kurangiSample(this)">X</button><input type="text" name="input[]" id="" class="form-control">
        </div>
        <div class="col">
            Output: <input type="text" name="output[]" id="" class="form-control">
        </div>
        
    `;
        container.appendChild(div);
    }

    function kurangiSample(button) {
        // Menghapus parent element dari button yang diklik
        button.parentElement.parentElement.remove();
    }
</script>