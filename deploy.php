<?php
// deploy.php

// Tentukan alamat direktori kerja
$repoDir = '/home/u722970107/domains/trial-site.my.id/public_html'; // Ganti dengan path ke folder proyek Anda

// Periksa apakah request adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Jalankan git pull
    chdir($repoDir); // Pindah ke direktori repositori
    exec('git pull origin master', $output, $return_var); // Ganti master dengan branch yang relevan jika perlu

    // Periksa status
    if ($return_var !== 0) {
        // Gagal, hapus atau baiki kesalahan di sini
        echo "Error: " . implode("\n", $output);
    } else {
        // Sukses, mungkin Anda bisa memberikan pesan sukses
        echo "Deployment successful!";
    }
} else {
    echo "Invalid request!";
}
?>