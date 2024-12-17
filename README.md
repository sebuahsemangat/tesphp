<h1>Deskripsi Project</h1>
Project ini merupakan project aplikasi yang digunakan untuk memberikan penilaian pada kegiatan praktikum pemrograman dasar menggunakan bahasa PHP.
Aplikasi ini berjalan menggunakan prinsip blackbox testing. Black box testing adalah metode pengujian perangkat lunak yang berfokus pada fungsionalitasnya. Pengujian ini dilakukan dengan mengamati input dan output perangkat lunak tanpa mengetahui struktur kode programnya.
Pada penggunaannya, siswa akan mendapatkan soal pemrograman dan diharuskan untuk menjawabnya menggunakan bahasa pemrograman PHP. Ketika siswa menekan tombol <strong>Run Code</strong>, aplikasi akan membuat file PHP berisi kode yang diketikkan oleh siswa. Kode tersebut kemudian akan dieksekusi dan dibandingkan outputnya. Jika output tersebut sama dengan output yang diharapkan pada soal, maka jawaban dinyatakan benar.

<h1>Instalasi</h1>
<ol>
    <li>Clone repository ini</li>
    <li>Copy project ke folde htdocs jika menggunakan XAMPP atau ke folder www jika menggunakan laragon</li>
    <li>Jalankan Apache dan Mysql di XAMPP atau Klik Start All di Laragon</li>
    <li>Buat sebuah database bernama tesphp di phpmyadmin</li>
    <li>Import database tesphp.sql</li>
    <li>Edit file koneksi.php dan sesuaikan dengan pengaturan mysql di komputer anda</li>
    <li>Buka aplikasi di browser (Chrome recommended): localhost/tesphp</li>
</ol>

<h1>Login Siswa</h1>
<ol>
    <li>Buka aplikasi di browser (Chrome recommended): localhost/tesphp</li>
    <li>Login dengan akun demo: NIS-->123 Password-->123</li>
    <li>Klik nama siswa di bagian atas untuk mengganti password</li>
</ol>

<h1>Login Guru</h1>
<ol>
    <li>Buka aplikasi di browser (Chrome recommended): localhost/tesphp/guru</li>
    <li>Login dengan akun demo: Username-->apep Password-->apep</li>
</ol>

<h1>Login Admin</h1>
<ol>
    <li>Buka aplikasi di browser (Chrome recommended): localhost/tesphp</li>
    <li>Login dengan akun demo: Username-->aku Password-->123</li>
</ol>

<h1>Input Ujian</h1>
<ol>
    <li>Login menggunakan akun guru</li>
    <li>Klik tombol Input Ujian di halaman Home</li>
    <li>Isi Nama Ujian. Pilih kelas mana saja yang dapat mengikuti ujian tersebut</li>
    <li>Klik Simpan Ujian</li>
</ol>

<h1>Input Soal</h1>
<ol>
    <li>Login menggunakan akun guru</li>
    <li>Klik tombol Lihat Soal pada Ujian yang akan diinputkan soalnya</li>
    <li>Klik Tambah Soal</li>
    <li>Isi Judul Soal</li>
    <li>Isi Deskripsi Soal. Deskripsi ini adalah isi dari soal yang akan diberikan</li>
    <li>Isi nama fungsi sesuai dengan ketentuan nama fungsi dalam bahasa PHP yaitu:
        <ul>
            <li>Harus diawali huruf atau underscore</li>
            <li>Tidak mengandung spasi dan simbol</li>
        </ul>
    </li>
    <li>Isi parameter dari fungsi di atas. Format penulisan parameter adalah sebagai berikut:
        <ul>
            <li>Parameter diawali tanda dollar ($). Contoh -> $harga</li>
            <li>Jika fungsi memiliki lebih dari 1 parameter, maka parameter ditulis dengan diberi tanda koma dan spasi sebagai pemisah. Contoh -> $harga, $uang, $kembalian</li>
        </ul>
    </li>
    <li>Waktu boleh dikosongkan (Fitur belum tersedia)</li>
    <li>Isi semua input dengan format sebagai berikut:
        <ul>
            <li>Jika input berupa integer atau float maka input bisa ditulis tanpa format. Contoh --> 25 (integer) 2.5 (float)</li>
            <li>Jika input berupa string, maka input ditulis di antara tanda petik dua ("). Contoh --> "apep"</li>
            <li>Jika input berupa boolean, maka input bisa ditulis langsung tanpa format menggunakan huruf kecil. Contoh --> true, false</li>
        </ul>
    </li>
    <li>Isi semua output dengan format sebagai berikut:
        <ul>
            <li>Jika output berupa string, integer dan boolean, maka output bisa ditulis tanpa format. Contoh --> apep (string), 25 (integer), 2.5 (float) </li>
            <li>Jika input berupa boolean, maka input bisa ditulis langsung tanpa format menggunakan huruf kecil. Contoh --> true, false</li>
        </ul>
    </li>
    <li>Isi bagian Secret Sample Test seperti penginputan Input dan Output di atas. Notes: Secret Sample Test tidak akan ditampilkan kepada siswa</li>
</ol>


