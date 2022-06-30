<?php
session_start();
require '../components/dbconn.php';
include '../functions/cleaner.php';

if (isset($_POST['action']) == 'kirim') {
    $id = cleaner($_POST['id-user']);
    $judul = cleaner($_POST['judul']);
    $isi = cleaner($_POST['isi']);

    //Amankan Form 
    $judul = strip_tags(mysqli_real_escape_string($conn, trim($judul)));
    $isi = strip_tags(mysqli_real_escape_string($conn, trim($isi)));
    date_default_timezone_set("Asia/Jakarta");
    $currDate = date('Y-m-d');

    //Validasi 
    $error = array(
        'error_status' => 0
    );

    if (empty($judul)) {
        $error['error_status'] = 1;
        $error['judul'] = 'Field judul wajib diisi!';
    }
    if (!empty($judul)) {
        if (strlen($judul) < 5) {
            $error['error_status'] = 1;
            $error['judul'] = 'Panjang judul paling tidak sebanyak 5 karakter!';
        }
    }
    if (empty($isi)) {
        $error['error_status'] = 1;
        $error['isi'] = 'Field isi wajib diisi!';
    }
    if (!empty($isi)) {
        if (strlen($isi) < 15) {
            $error['error_status'] = 1;
            $error['isi'] = 'Panjang isi paling tidak sebanyak 15 karakter!';
        }
    }
    if ($error['error_status'] > 0) {
        echo json_encode($error);
        exit();
    }

    // Validasi Sukses 
    $query = $conn->prepare("INSERT INTO kontak(id_user, judul, isi, dikirim_tanggal) VALUES (?, ?,?,?) ");
    $query->bind_param("isss", $id, $judul, $isi, $currDate);
    if ($query->execute()) {
        $response = array(
            'status' => 1,
            'msg' => 'Berhasil dikirim ke admin'
        );
    } else {
        $response = array(
            'status' => 0,
            'msg' => 'Gagal dikirim ke admin'
        );
    }
    echo json_encode($response);
    exit();
    $conn->close();
}
