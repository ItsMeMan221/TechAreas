<?php
session_start();
require '../components/dbconn.php';
include '../functions/cleaner.php';

if (isset($_POST['action']) == 'addAdmin') {
    $name = cleaner($_POST['name']);
    $DOB = cleaner($_POST['DOB']);
    $handphone = cleaner($_POST['handphone']);
    $gender = cleaner($_POST['gender']);
    $username = cleaner($_POST['username']);
    $email = cleaner($_POST['email']);
    $pass = cleaner($_POST['pass']);
    $kPass = cleaner($_POST['kPass']);
    $active = 1;
    // Fetch username + email 
    $getEmail = "SELECT DA.email, LA.active FROM login_admin LA LEFT JOIN detail_admin DA ON DA.id_admin = LA.id WHERE DA.email = '$email' AND LA.active = 1";
    $resEmail = $conn->query($getEmail);
    $getUsername = "SELECT username FROM login_admin WHERE username = '$username' AND active = 1";
    $resUsername = $conn->query($getUsername);

    // Mengamankan Form 
    $name = strip_tags(mysqli_real_escape_string($conn, trim($name)));
    $DOB = strip_tags(mysqli_real_escape_string($conn, trim($DOB)));
    $handphone = strip_tags(mysqli_real_escape_string($conn, trim($handphone)));
    $gender = strip_tags(mysqli_real_escape_string($conn, trim($gender)));
    $username = strip_tags(mysqli_real_escape_string($conn, trim($username)));
    $email = strip_tags(mysqli_real_escape_string($conn, trim($email)));
    $pass = strip_tags(mysqli_real_escape_string($conn, trim($pass)));
    $kPass = strip_tags(mysqli_real_escape_string($conn, trim($kPass)));

    // Format DOB 
    date_default_timezone_set("Asia/Jakarta");
    $DOB = date_create($DOB);
    $DOB = date_format($DOB, 'Y-m-d');
    $currDate = date('Y-m-d');
    $diff = abs(strtotime($currDate) - strtotime($DOB));
    $diffYears = floor($diff / (365 * 60 * 60 * 24));


    // Validation Dimulai 
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
    // Validasi DOB
    if (empty($DOB)) {
        $error['error_status'] = 1;
        $error['DOB'] = "Field tanggal lahir wajib diisi!";
    }
    if (!empty($DOB)) {
        if ($diffYears < 16) {
            $error['error_status'] = 1;
            $error['DOB'] = 'Seorang yang berumur kurang dari 16 tahun tidak diperbolehkan menjadi admin';
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
    if (!empty($username)) {
        if (!strlen($username) < 4) {
            if ($resUsername) {
                $rc = mysqli_num_rows($resUsername);
                if ($rc > 0) {
                    $error['error_status'] = 1;
                    $error['username'] = "Username sudah terdaftar!";
                }
            }
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
            $error['email'] = "Email tidak sesuai format!";
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
    // Validasi Repeat Password
    if (empty($kPass)) {
        $error['error_status'] = 1;
        $error['kPpass'] = "Field Konfirmasi Password Wajib diisi";
    }
    if (!empty($repass)) {
        if ($repass != $pass) {
            $error['error_status'] = 1;
            $error['kPass'] = "Konfirmasi password harus sama dengan field password";
        }
    }
    if ($error['error_status'] > 0) {
        echo json_encode($error);
        exit();
    }
    $role_id = 1;
    $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
    $queryLoginAdmin = $conn->prepare("INSERT INTO login_admin(role_id, username, password, active) VALUES (?, ?, ?, ?)");
    $queryLoginAdmin->bind_param("issi", $role_id, $username, $pass_hash, $active);
    if ($queryLoginAdmin->execute()) {
        $last_id = $conn->insert_id;
        $queryDetailAdmin = $conn->prepare("INSERT INTO detail_admin(id_admin, nama, tanggal_lahir, email, no_handphone, gender_id) VALUES (?, ?, ?, ?, ?, ?)");
        $queryDetailAdmin->bind_param("issssi", $last_id, $name, $DOB, $email, $handphone, $gender);
        if ($queryDetailAdmin->execute()) {
            $response = array(
                'status' => 1,
                'msg' => 'Berhasil menambahkan admin'
            );
        } else {
            $response = array(
                'status' => 0,
                'msg' => 'Gagal menambahkan admin'
            );
        }
    } else {
        $response = array(
            'status' => 0,
            'msg' => 'Gagal menambahkan admin'
        );
    }
    echo json_encode($response);
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include '../framework/bootstrap.php';
    include '../framework/jquery.php';
    include '../framework/sweetalert2.php';
    ?>
</head>

<body>
    <?php include '../components/navbarAdmin.php';

    if ($_SESSION['auth_admin'] == true && $_SESSION['data_admin']['role_id'] == 2) {
    ?>
        <section class="vh-100 gradint">
            <div class="container py-3 h-100">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 col-md-10 col-lg-9 col-xl-9 col-sm-12">
                        <div class="card bg-dark" style="border-radius: 1rem; max-width:100rem">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-white text-center">Form Tambah Admin</h3>
                                    <form method="POST" enctype="multipart/form-data" class="text-start" id="tambahAdminForm" action="">
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Johny Stott" name="name">
                                            <label for="floatingInput">Nama Lengkap</label>
                                            <small class="text-danger ml-5" id="nameError"></small>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="date" class="form-control" id="floatingInput" placeholder="2022/3/1" name="DOB">
                                            <label for="floatingInput">Tanggal Lahir</label>
                                            <small class="text-danger ml-5" id="DOBError"></small>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="text" class="form-control" id="textInteger" placeholder="08599022xxx" name="handphone">
                                            <label for="floatingInput">Nomor Handphone</label>
                                            <small class="text-danger ml-5" id="handphoneError"></small>
                                        </div>
                                        <div class="form-floating">
                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="gender">
                                                <?php
                                                $getGen = "SELECT * FROM gender";
                                                $resGen = $conn->query($getGen);
                                                while ($data = $resGen->fetch_assoc()) {
                                                    echo "<option value= '$data[id]'>$data[description]</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingSelect">Jenis Kelamin</label>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="email@gmail.com" name="username">
                                            <label for="floatingInput">Username</label>
                                            <small class="text-danger ml-5" id="usernameError"></small>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="email@gmail.com" name="email">
                                            <label for="floatingInput">Alamat Email</label>
                                            <small class="text-danger ml-5" id="emailError"></small>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass">
                                            <label for="floatingPassword">Password</label>
                                            <small class="text-danger ml-5" id="passError"></small>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="kPass">
                                            <label for="floatingPassword">Konfirmasi Password</label>
                                            <small class="text-danger ml-5" id="kPassError"></small>
                                        </div>
                                        <div class="text-center mt-5 ">
                                            <input type="submit" name="tambah" class="btn btn-outline-dark btn-success btn-lg px-5 text-white " value="Tambah Admin">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } else {
        header('location:loginAdmin.php');
    }
    ?>
</body>
<script src="../functions/textInteger.js"></script>
<script>
    $(document).ready(function() {
        $('#tambahAdminForm').on('submit', function(e) {
            e.preventDefault();
            var data = new FormData($(this)[0]);
            data.append('action', 'addAdmin');
            var form = $(this);
            console.log(form);
            form.find(':submit').attr('disabled', true);
            var url = "../administrator/tambahAdmin.php";
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
                            document.location.href = "dashboardAdmin.php";
                        })
                    } else if (response.status == 0) {
                        // Handling failure response
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.msg,
                        })
                    }
                }
            });
        });
    });
</script>

</html>