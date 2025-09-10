<?php
$host = "db"; // nama service di docker-compose
$user = "crm_user";
$pass = "crm_pass";
$db   = "crm_app";

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // error jadi exception
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // hasil fetch berupa array asosiatif
        PDO::ATTR_EMULATE_PREPARES   => false,                  // gunakan prepared statement asli
    ];

    $pdo = new PDO($dsn, $user, $pass, $options);

    echo "Koneksi ke database berhasil 🎉 PHP 8.1 jalan dengan PDO!";
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
