<?php
// File: app/functions.php
// Tempat untuk menyimpan semua fungsi bantuan (helper functions).

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