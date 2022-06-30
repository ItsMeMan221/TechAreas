<?php
include '../functions/cleaner.php';
require '../components/dbconn.php';
if (isset($_POST['action']) == 'register') {
    $name = cleaner($_POST['name']);
    $handphone = cleaner($_POST['handphone']);
    $gender = cleaner($_POST['gender']);
    $username = cleaner($_POST['username']);
    $email = cleaner($_POST['email']);
    $pass = cleaner($_POST['pass']);
    $repass = cleaner($_POST['repass']);

    // upload file 
    $dir = "../uploads/";
    $avatarName = md5(uniqid(mt_rand(), true));
    $tar_upl = $dir . basename(($_FILES['avatar']['name']));
    $docType = strtolower(pathinfo($tar_upl, PATHINFO_EXTENSION));
    $avatarName .= "." . $docType;
    $tar_upl = $dir . $avatarName;

    // Fetching email untuk validasi
    $getEmail = "SELECT email FROM login_user WHERE email = '$email'";
    $resEmail = $conn->query($getEmail);

    //Mengamankan form 
    $name = strip_tags(mysqli_real_escape_string($conn, trim($name)));
    $handphone = strip_tags(mysqli_real_escape_string($conn, trim($handphone)));
    $gender = strip_tags(mysqli_real_escape_string($conn, trim($gender)));
    $username = strip_tags(mysqli_real_escape_string($conn, trim($username)));
    $email = strip_tags(mysqli_real_escape_string($conn, trim($email)));
    $pass = strip_tags(mysqli_real_escape_string($conn, trim($pass)));
    $repass = strip_tags(mysqli_real_escape_string($conn, trim($repass)));

    $error = array(
        'error_status' => 0
    );
    //Validasi Nama Lengkap
    if (empty($name)) {
        $error['error_status'] = 1;
        $error['name'] = 'Field nama wajib diisi!';
    }
    if (!empty($name)) {
        if (strlen($name) < 5) {
            $error['error_status'] = 1;
            $error['name'] = 'Panjang nama paling tidak sebanyak 5 karakter!';
        }
    }
    //Validasi Nomor HP
    if (empty($handphone)) {
        $error['error_status'] = 1;
        $error['handphone'] = 'Field handphone wajib diisi!';
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
    // Validasi Email 
    if (empty($email)) {
        $error['error_status'] = 1;
        $error['email'] = "Field email wajib diisi!";
    }
    if (!empty($email)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['error_status'] = 1;
            $error['email'] = "Email anda tidak sesuai format!";
        }
    }
    if (!empty($email)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if ($resEmail) {
                $rowCount = mysqli_num_rows($resEmail);
                if ($rowCount > 0) {
                    $error['error_status'] = 1;
                    $error['email'] = "Email sudah terdaftar!";
                }
            }
        }
    }
    //Validasi Password 
    if (empty($pass)) {
        $error['error_status'] = 1;
        $error['pass'] = "Field password wajib diisi!";
    }
    if (!empty($pass)) {
        $pattern = '/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';
        if (!preg_match($pattern, $pass)) {
            $error['error_status'] = 1;
            $error['pass'] = "Password paling tidak memiliki 8 huruf, 1 huruf besar dan 1 digit angka";
        }
    }
    // Validasi Repeat Password
    if (empty($repass)) {
        $error['error_status'] = 1;
        $error['repass'] = "Field Konfirmasi Password Wajib diisi";
    }
    if (!empty($repass)) {
        if ($repass != $pass) {
            $error['error_status'] = 1;
            $error['repass'] = "Konfirmasi password harus sama dengan field password";
        }
    }
    if ($error['error_status'] > 0) {
        echo json_encode($error);
        exit();
    }
    $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
    $queryLoginUser = $conn->prepare("INSERT INTO login_user(username, email, password, avatar) VALUES (?,?,?,?)");
    $queryLoginUser->bind_param("ssss", $username, $email, $pass_hash, $tar_upl);
    if ($queryLoginUser->execute()) {
        $last_id = $conn->insert_id;
        $queryDetailUser = $conn->prepare("INSERT INTO detail_user(id_user,nama, no_handphone, gender_id) VALUES(?, ?, ?, ?)");
        $queryDetailUser->bind_param("sssi", $last_id, $name, $handphone, $gender);
        if ($queryDetailUser->execute()) {
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $tar_upl)) {
            } else {
                $error['error_status'] = 1;
                $error['avatar'] = "Ada kesalahan saat upload image";
            }
            $response = array(
                'status' => 1,
                'msg' => 'Register success'
            );
        } else {
            $response = array(
                'status' => 0,
                'msg' => 'Register fail'
            );
        }
        $response = array(
            'status' => 1,
            'msg' => 'Register success'
        );
    } else {
        $response = array(
            'status' => 0,
            'msg' => 'Register fail'
        );
    }
    echo json_encode($response);
    exit();
    $conn->close();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <?php
    include '../framework/jquery.php';
    include '../framework/bootstrap.php';
    include '../framework/sweetalert2.php';
    ?>
</head>

<body>
    <link rel="stylesheet" href="../css/logReg.css">
    <section class="vh-100 gradint">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-10 col-lg-9 col-xl-9 col-sm-12">
                    <div class="card bg-dark" style="border-radius: 1rem; max-width:100rem">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-white text-center">Registration Form</h3>
                                <form enctype="multipart/form-data" class="text-start" id="registerForm" action="">
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label  text-white">Nama Lengkap</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputEmail3" placeholder="Masukkan Nama Lengkap Anda" name="name">
                                            <small class="text-danger ml-5" id="nameError"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label  text-white">Nomor Handphone</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="textInteger" placeholder="Masukkan Nomor Handphone Anda" name="handphone" minlength="10" maxlength="14">
                                            <small class="text-danger ml-5" id="handphoneError"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label text-white">Gender</label>
                                        <div class="col-sm-10">
                                            <select name="gender" class="form-select">
                                                <?php
                                                $getGen = "SELECT * FROM gender";
                                                $resGen = $conn->query($getGen);
                                                while ($data = $resGen->fetch_assoc()) {
                                                    echo "<option value= '$data[id]'>$data[description]</option>";
                                                }
                                                ?>
                                            </select>
                                            <small class="text-danger ml-5" id="genderError"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label  text-white">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="username" id="inputEmail3" placeholder="Masukkan Username Anda">
                                            <small class="text-danger ml-5" id="usernameError"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label  text-white">Alamat Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="email" id="inputEmail3" placeholder="Masukkan Alamat Email Anda">
                                            <small class="text-danger ml-5" id="emailError"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label text-white">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="pass" id="inputPassword3" placeholder="Masukkan Password Anda">
                                            <small class="text-danger ml-5" id="passError"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label text-white">Repeat Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="repass" id="inputPassword3" placeholder="Samakan dengan Password yang Anda Masukkan di atas">
                                            <small class="text-danger ml-5" id="repassError"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label  text-white">Avatar</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="avatar" id="file">
                                            <small class="text-danger ml-5" id="avatarError"></small>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <input type="submit" name="register" class="btn btn-outline-light btn-lg px-5 mt-3" value="Register">
                                    </div>
                                    <div class="text-center text-white-50 mt-5">
                                        <p class="mb-0">Already have an account? <a href="../index.php" class="text-white-50 fw-bold">Sign In</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="../functions/textInteger.js"></script>
<script>
    $(document).ready(function() {
        $('#registerForm').on('submit', function(e) {
            e.preventDefault();
            var data = new FormData($(this)[0]);
            data.append('action', 'register');
            var form = $(this);
            form.find(':submit').attr('disabled', true);
            var url = "/412020004_SANTIAGO/views/register.php";
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                },
                success: function(response) {
                    form.find(':submit').attr('disabled', false);
                    if (response.error_status = 1) {
                        form.find('small').text('');
                        // If validation error exists
                        for (var key in response) {
                            var errorContainer = form.find(`#${key}Error`);
                            if (errorContainer.length !== 0) {
                                errorContainer.html(response[key]);
                            }
                        }
                    }
                    if (response.status == 1) {
                        form.trigger('reset');
                        form.find('small').text('');
                        // handling success respone
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.msg
                        }).then(function() {
                            document.location.href = "../index.php";
                        })
                    } else if (response.status == 0) {
                        // Handling failure response
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.msg,
                        }).then(function() {
                            document.location.href = "register.php";
                        });
                    }
                }
            });
        });
        $("#file").change(function() {
            var file = this.files[0];
            var fileType = file.type;
            var match = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2])) || (fileType == "application/x-zip-compressed")) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Format file hanya boleh jpg, png dan jpeg',
                })
                $("#file").val('');
                return false;
            }
        });
    });
</script>

</html>