<?php
// File: app/functions.php
// Tempat untuk menyimpan semua fungsi bantuan (helper functions).
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
/**
 * Memotong teks berdasarkan jumlah kata.
 *
 * @param string $text Teks yang akan dipotong.
 * @param int $limit Jumlah kata maksimal.
 * @return string Teks yang sudah dipotong.
 */
function limit_text($text, $limit)
{
    // Hapus dulu semua tag HTML untuk keamanan dan akurasi
    $cleanedText = strip_tags($text);

    if (str_word_count($cleanedText, 0) > $limit) {
        $words = str_word_count($cleanedText, 2);
        $pos   = array_keys($words);
        $text  = substr($cleanedText, 0, $pos[$limit]) . '...';
    } else {
        $text = $cleanedText;
    }

    return $text;
}
// ... (isi file functions.php yang sudah ada) ...

/**
 * Membuat link pagination HTML.
 *
 * @param int $currentPage Halaman saat ini.
 * @param int $totalPages Total jumlah halaman.
 * @param string $baseUrl URL dasar untuk link (misal: 'berita.php').
 * @return string HTML untuk navigasi pagination.
 */
function generate_pagination_links($currentPage, $totalPages, $baseUrl)
{
    if ($totalPages <= 1) {
        return ''; // Jangan tampilkan pagination jika hanya ada 1 halaman
    }

    $html = '<nav><ul class="pagination justify-content-center">';

    // Tombol "Previous"
    if ($currentPage > 1) {
        $html .= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=' . ($currentPage - 1) . '">Previous</a></li>';
    } else {
        $html .= '<li class="page-item disabled"><span class="page-link">Previous</span></li>';
    }

    // Tombol nomor halaman
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            $html .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
        } else {
            $html .= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=' . $i . '">' . $i . '</a></li>';
        }
    }

    // Tombol "Next"
    if ($currentPage < $totalPages) {
        $html .= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=' . ($currentPage + 1) . '">Next</a></li>';
    } else {
        $html .= '<li class="page-item disabled"><span class="page-link">Next</span></li>';
    }

    $html .= '</ul></nav>';
    return $html;
}
// ... (isi file functions.php yang sudah ada) ...

/**
 * Membuat versi "slug" dari sebuah string (URL-friendly).
 *
 * @param string $text Teks yang akan diubah.
 * @return string Slug yang dihasilkan.
 */
function create_slug($text)
{
    // Ganti semua yang bukan huruf/angka dengan spasi
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    // Hapus tanda hubung di awal/akhir
    $text = trim($text, '-');
    // Ubah ke huruf kecil
    $text = strtolower($text);
    // Hapus karakter duplikat yang tidak diinginkan
    $text = preg_replace('~-+~', '-', $text);

    if (empty($text)) {
        return 'n-a-' . time();
    }
    return $text;
}
if (!function_exists('send_password_reset_email')) {
    /**
     * Mengirim email reset password.
     *
     * @param string $user_email Email penerima.
     * @param string $token Token reset (plaintext, BUKAN HASH).
     * @return bool True jika berhasil, false jika gagal.
     */
    function send_password_reset_email($user_email, $token)
    {

        // SESUAIKAN LINK INI dengan URL Anda.
        // Untuk localhost:
        $reset_link = 'http://localhost/webprofilpkuwanareja/public/admin/reset-password.php?token=' . urlencode($token);
        // Untuk hosting (ganti namadomainanda.com):
        // $reset_link = 'https://namadomainanda.com/admin/reset-password.php?token=' . urlencode($token);

        $mail = new PHPMailer(true);

        try {
            // --- KONFIGURASI SMTP (WAJIB DIISI) ---
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Aktifkan untuk debugging
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';     // Ganti dengan host SMTP Anda (contoh: GMail)
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ezrampage33@gmail.com'; // GANTI DENGAN EMAIL PENGIRIM ANDA
            $mail->Password   = 'rgkofeojygyvrear';   // GANTI DENGAN "APP PASSWORD" GMAIL
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->CharSet    = 'UTF-8';
            // ----------------------------------------

            $mail->setFrom('ezrampage33@gmail.com', 'Admin PKU Wanareja');
            $mail->addAddress($user_email);

            $mail->isHTML(true);
            $mail->Subject = 'Permintaan Reset Password Akun PKU Wanareja';
            $mail->Body    = "
                <p>Kami menerima permintaan untuk mereset password akun Anda.</p>
                <p>Jika Anda merasa tidak melakukan permintaan ini, abaikan email ini.</p>
                <p>Untuk mereset password Anda, silakan klik link di bawah ini:</p>
                <p><a href='{$reset_link}' style='padding: 10px 15px; background-color: #0d6efd; color: white; text-decoration: none; border-radius: 5px;'>Reset Password Sekarang</a></p>
                <p>Link ini hanya berlaku selama 5 menit.</p>
                <br>
                <p>Link alternatif: <br> {$reset_link}</p>
            ";

            $mail->send();
            return true;
        } catch (Exception $e) {
            // error_log("Mailer Error: {$mail->ErrorInfo}"); // Untuk debugging di server
            return false;
        }
    }
}