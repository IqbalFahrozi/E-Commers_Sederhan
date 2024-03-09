<?php
// Tentukan direktori upload
$upload_dir = "uploads/";

// Pastikan direktori upload ada, jika tidak buat
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true); // Buat direktori dengan izin 0777 (boleh diakses oleh semua)
}

// Cek apakah file telah diunggah dengan benar
if(isset($_FILES['file'])) {
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];

    // Generate nama unik untuk file
    $unique_file_name = uniqid() . '_' . $file_name;

    // Tentukan path file baru
    $upload_path = $upload_dir . $unique_file_name;

    // Pindahkan file ke direktori upload
    if(move_uploaded_file($file_tmp, $upload_path)) {
        // File berhasil diunggah, lanjutkan dengan operasi lain seperti penyimpanan data di database
        echo "File berhasil diunggah.";
    } else {
        // Jika gagal mengunggah file
        echo "Gagal mengunggah file.";
    }
} else {
    // Jika tidak ada file yang diunggah
    echo "Tidak ada file yang diunggah.";
}
?>
