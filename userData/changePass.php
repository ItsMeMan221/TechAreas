<?php
include '../functions/cleaner.php';
require '../components/dbconn.php';

if (isset($_POST['action']) == 'changePass') {
    $lPass = cleaner($_POST['lPass']);
    $bPass = cleaner($_POST['bPass']);
    $kPass = cleaner($_POST['kPass']);
    $id_user = cleaner($_POST['id_user']);

    //Fetch data password 
    $queryPass = "SELECT password FROM login_user WHERE id = '$id_user'";
    $resPass = $conn->query($queryPass);

    //Amankan Form 
    $lPass = strip_tags(mysqli_real_escape_string($conn, trim($lPass)));
    $bPass = strip_tags(mysqli_real_escape_string($conn, trim($bPass)));
    $kPass = strip_tags(mysqli_real_escape_string($conn, trim($kPass)));

    //Validasi 
    $error = array(
        'error_status' => 0
    );
    // Check Password Lama
    if (empty($lPass)) {
        $error['error_status'] = 1;
        $error['lPass'] = 'Field Password Lama Wajib Diisi!';
    }
    if (!empty($lPass)) {
        if ($resPass) {
            $rowPass = $resPass->fetch_assoc();
            $passQ = $rowPass['password'];
            if (!password_verify($lPass, $passQ)) {
                $error['error_status'] = 1;
                $error['lPass'] = 'Password Lama Tidak Sesuai!';
            }
        }
    }
    // Password Baru 
    if (empty($bPass)) {
        $error['error_status'] = 1;
        $error['bPass'] = 'Field Password Baru Wajib Diisi!';
    }
    if (!empty($bPass)) {
        $pattern = '/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';
        if (!preg_match($pattern, $bPass)) {
            $error['error_status'] = 1;
            $error['bPass'] = 'Password paling tidak memiliki 8 huruf, 1 huruf besar dan 1 digit angka!';
        }
    }
    // Konfirmasi Password 
    if (empty($kPass)) {
        $error['error_status'] = 1;
        $error['kPass'] = 'Field Password Konfirmasi Wajib Diisi!';
    }
    if (!empty($kPass)) {
        if ($kPass != $bPass) {
            $error['error_status'] = 1;
            $error['kPass'] = 'Field Password Konfirmasi Wajib Diisi!';
        }
    }
    if ($error['error_status'] > 0) {
        echo json_encode($error);
        exit();
    }
    $pass_hash = password_hash($bPass, PASSWORD_BCRYPT);
    $queryUp = $conn->prepare("UPDATE login_user SET password = ? WHERE id = ?");
    $queryUp->bind_param("si", $pass_hash, $id_user);
    if ($queryUp->execute()) {
        $response = array(
            'status' => 1,
            'msg' => 'Password telah diganti'
        );
    } else {
        $response = array(
            'status' => 1,
            'msg' => 'Password gagal diganti'
        );
    }
    echo json_encode($response);
    exit();
    $conn->close();
}
