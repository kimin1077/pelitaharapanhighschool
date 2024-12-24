<?php
// Definisikan file CSV tempat data absensi disimpan
$file = 'absensi.csv';

// Inisialisasi variabel untuk menampilkan pesan
$successMessage = '';

// Jika form disubmit, proses data dan simpan ke CSV
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_siswa = $_POST['student-name'];
    $tanggal = $_POST['attendance-date'];
    $status = $_POST['attendance-status'];

    // Simpan data ke file CSV
    $data = array($nama_siswa, $tanggal, $status);
    $handle = fopen($file, 'a'); // buka file untuk menambahkan data
    fputcsv($handle, $data); // simpan data sebagai baris CSV
    fclose($handle); // tutup file

    // Pesan sukses setelah absensi disimpan
    $successMessage = "Absensi untuk $nama_siswa telah berhasil disimpan!";
}

// Baca data absensi dari file CSV
$absensi = [];
if (file_exists($file)) {
    $handle = fopen($file, 'r');
    while (($data = fgetcsv($handle)) !== FALSE) {
        $absensi[] = $data;
    }
    fclose($handle);
}
?>
<?php
// Pesan sukses atau error setelah pengiriman form
$successMessage = '';
$errorMessage = '';

// Proses pengiriman formulir kontak
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validasi data
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Mengirim email (Pastikan pengaturan mail server di server sudah benar)
        $to = 'your-email@example.com'; // Ganti dengan alamat email penerima
        $headers = "From: $email" . "\r\n" .
                   "Reply-To: $email" . "\r\n" .
                   "Content-Type: text/html; charset=UTF-8";
        $body = "Nama: $name<br>Email: $email<br>Subjek: $subject<br>Pesan: $message";

        // Kirim email
        if (mail($to, $subject, $body, $headers)) {
            $successMessage = "Pesan Anda telah berhasil dikirim!";
        } else {
            $errorMessage = "Terjadi kesalahan saat mengirim pesan. Coba lagi nanti.";
        }
    } else {
        $errorMessage = "Semua kolom harus diisi!";
    }
}
?>