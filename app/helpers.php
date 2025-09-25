<?php
// File: app/helpers.php

/**
 * Membuat link navigasi paginasi dengan Bootstrap 5.
 *
 * @param int $currentPage Halaman saat ini.
 * @param int $totalPages Total jumlah halaman.
 * @param string $baseUrl URL dasar untuk link (misal: 'jadwal_pelayanan.php').
 * @return string HTML untuk navigasi paginasi.
 */
function generate_pagination_links($currentPage, $totalPages, $baseUrl)
{
    if ($totalPages <= 1) {
        return '';
    }

    $html = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';

    // Tombol Previous
    $prevDisabled = ($currentPage <= 1) ? 'disabled' : '';
    $html .= "<li class='page-item {$prevDisabled}'><a class='page-link' href='{$baseUrl}?page=" . ($currentPage - 1) . "'>&laquo;</a></li>";

    // Link Halaman
    for ($i = 1; $i <= $totalPages; $i++) {
        $activeClass = ($i == $currentPage) ? 'active' : '';
        $html .= "<li class='page-item {$activeClass}'><a class='page-link' href='{$baseUrl}?page={$i}'>{$i}</a></li>";
    }

    // Tombol Next
    $nextDisabled = ($currentPage >= $totalPages) ? 'disabled' : '';
    $html .= "<li class='page-item {$nextDisabled}'><a class='page-link' href='{$baseUrl}?page=" . ($currentPage + 1) . "'>&raquo;</a></li>";

    $html .= '</ul></nav>';
    return $html;
}