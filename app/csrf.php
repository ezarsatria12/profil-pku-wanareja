<?php
// File: app/csrf.php

/**
 * Membuat token CSRF jika belum ada di session.
 */
function generate_csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}

/**
 * Memverifikasi token CSRF yang dikirim dari form.
 *
 * @return bool True jika valid, false jika tidak.
 */
function verify_csrf_token()
{
    if (isset($_POST['csrf_token']) && isset($_SESSION['csrf_token'])) {
        return hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
    }
    return false;
}