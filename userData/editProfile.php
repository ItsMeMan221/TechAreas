<?php
session_start();
require '../components/dbconn.php';
include '../functions/cleaner.php';
if (isset($_POST['action']) == 'editProfile') {
    $nama = cleaner($_POST['nama']);
    $username = cleaner($_POST['username']);
    $gender = cleaner($_POST['gender']);
    $no_hp = cleaner($_POST['no_hp']);
    $id = cleaner($_POST['id-user']);

    //Validasi 
    $error = array(
        'error_status' => 0
    );
    if (empty($nama)) {
        $error['error_status'] = 1;
        $error['nama'] = 'Field nama wajib diisi!';
    }
    if (!empty($nama)) {
        if (strlen($nama) < 5) {
            $error['error_status'] = 1;
            $error['nama'] = 'Panjang nama paling tidak sebanyak 5 karakter!';
        }
    }
    //Validasi Nomor HP
    if (empty($no_hp)) {
        $error['error_status'] = 1;
        $error['no_hp'] = 'Field handphone wajib diisi!';
    }
    //Validasi Username
    if (empty($username)) {
        $error['error_status'] = 1;
        $error['username'] = "Field username wajib diisi!";
    }
    if (!empty($username)) {
        if (strlen($username) < 4) {
            $error['error_status'] = 1;
            $error['username'] = "Panjang username paling tidak sebanyak 4 karakter!";
        }
    }
    if ($error['error_status'] > 0) {
        echo json_encode($error);
        exit();
    }
    //Gambar Tidak upload 
    if ($_FILES['avatar']['name'] == '') {
        $queryLog = $conn->prepare("UPDATE login_user SET username  = ? WHERE id = ?");
        $queryLog->bind_param("si", $username, $id);
        if ($queryLog->execute()) {
            $queryD = $conn->prepare("UPDATE detail_user SET nama = ?, no_handphone = ?, gender_id = ? WHERE id_user = ?");
            $queryD->bind_param("ssii", $nama, $no_hp, $gender, $id);
            if ($queryD->execute()) {
                $response = array(
                    'status' => 1,
                    'msg' => 'Berhasil Edit Profile'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'msg' => 'Gagal Edit Profile'
                );
            }
        }
    } else {
        // upload file 
        $dir = "../uploads/";
        $avatarName = md5(uniqid(mt_rand(), true));
        $tar_upl = $dir . basename(($_FILES['avatar']['name']));
        $docType = strtolower(pathinfo($tar_upl, PATHINFO_EXTENSION));
        $avatarName .= "." . $docType;
        $tar_upl = $dir . $avatarName;
        $queryLog = $conn->prepare("UPDATE login_user SET username  = ?, avatar = ? WHERE id = ?");
        $queryLog->bind_param("ssi", $username, $tar_upl, $id);
        if ($queryLog->execute()) {
            $queryD = $conn->prepare("UPDATE detail_user SET nama = ?, no_handphone = ?, gender_id = ? WHERE id_user = ?");
            $queryD->bind_param("ssii", $nama, $no_hp, $gender, $id);
            if ($queryD->execute()) {
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $tar_upl)) {
                }
                $response = array(
                    'status' => 1,
                    'msg' => 'Berhasil Mengedit Profil'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'msg' => 'Gagal Mengedit Profil'
                );
            }
        }
    }
    echo json_encode($response);
    exit();
    $conn->close();
}
