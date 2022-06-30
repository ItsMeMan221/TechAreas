<?php
session_start();
include '../functions/cleaner.php';
require '../components/dbconn.php';
if (isset($_POST['action']) == 'add') {
    $brand = cleaner($_POST['brand']);
    //Validasi 
    $error = array(
        'error_status' => 0
    );
    if (empty($brand)) {
        $error['error_status'] = 1;
        $error['brand'] = 'Field brand wajib diisi!';
    }
    if (!empty($brand)) {
        if (strlen($brand) < 2) {
            $error['error_status'] = 1;
            $error['brand'] = 'Panjang karakter setidaknya 2 karakter!';
        }
    }
    if ($error['error_status'] > 0) {
        echo json_encode($error);
        exit();
    }
    $query = $conn->prepare("INSERT INTO brand (description, active) VALUES(? , 1)");
    $query->bind_param("s", $brand);
    if ($query->execute()) {
        $response = array(
            'status' => 1,
            'msg' => 'Berhasil Menambahkan Brand'
        );
    } else {
        $response = array(
            'status' => 0,
            'msg' => 'Gagal Menambahkan Brand'
        );
    }
    echo json_encode($response);
    exit();
    $conn->close();
}
