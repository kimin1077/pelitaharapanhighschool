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