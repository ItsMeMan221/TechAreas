<?php
session_start();
include 'functions/cleaner.php';
require 'components/dbconn.php';
if (isset($_SESSION['auth']) == true) {
    $_SESSION['auth'] = false;
}
if (isset($_POST['action']) == 'login') {
    $email = cleaner($_POST['email']);
    $pass = cleaner($_POST['pass']);

    $email = strip_tags(mysqli_real_escape_string($conn, trim($email)));
    $pass = strip_tags(mysqli_real_escape_string($conn, trim($pass)));

    //validation 
    $error = array(
        'error_status' => 0
    );
    if (empty($email)) {
        $error['error_status'] = 1;
        $error['email'] = 'Field email wajib diisi!';
    }
    if (empty($pass)) {
        $error['error_status'] = 1;
        $error['pass'] = 'Field password wajib diisi!';
    }
    if ($error['error_status'] > 0) {
        echo json_encode($error);
        exit();
    }
    // Validation success 
    $query = $conn->prepare("SELECT * FROM login_user WHERE email=?");
    $query->bind_param("s", $email);
    $query->execute();
    if (!$query) {
        die('Query ERROR');
    }
    $res = $query->get_result();
    $row = $res->fetch_assoc();
    $rownums = $res->num_rows;
    if ($rownums == 1) {
        $ver = password_verify($pass, $row['password']);
        if ($ver == true) {
            $response = array(
                'status' => 1,
                'msg' => 'Login Success'
            );
            $_SESSION['auth'] = true;
            $_SESSION['data_user'] = $row;
        } else {
            $response = array(
                'status' => 0,
                'msg' => 'Login gagal karena kesalahan identitas'
            );
        }
    } else {

        $response = array(
            'status' => 0,
            'msg' => 'Login gagal karena kesalahan identitas'
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
    <title>Login Page</title>
    <?php
    include 'framework/jquery.php';
    include 'framework/bootstrap.php';
    include 'framework/sweetalert2.php';
    ?>
    <link rel="stylesheet" href="css/logReg.css">
</head>

<body class="">
    <section class="vh-100 gradint">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login Page</h2>
                                <p class="text-white-50 mb-5 text-a mt-3">Please enter your <span class="text-bold">Email Address</span> along with your <span class="text-bold">Password </span>!</p>
                                <form method="POST" enctype="multipart/form-data" id="loginForm">
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="logid">Email Address</label>
                                        <input type="text" name="email" id="logid" class="form-control form-control-lg" />
                                        <small class="text-danger ml-5" id="emailError"></small>

                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="typePasswordX">Password</label>
                                        <input type="password" id="typePasswordX" name="pass" class="form-control form-control-lg" />
                                        <small class="text-danger ml-5" id="passError"></small>
                                    </div>
                                    <input type="submit" name="login" class="btn btn-outline-light btn-lg px-5" value="Submit">
                                </form>
                            </div>
                            <div>
                                <p class="mb-0">Don't have an account? <a href="views/register.php" class="text-white-50 fw-bold">Sign Up</a>
                                </p>
                                <p class="mb-0">Are you the admin? <a class="text-white-50 fw-bold" href="administrator/loginAdmin.php">Login as admin!</a></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        var data = new FormData($(this)[0]);
        data.append('action', 'login');
        var form = $(this);
        form.find(':submit').attr('disabled', true);
        var url = "/412020004_SANTIAGO/index.php";
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
                if (response.error_status == 1) {
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
                    document.location.href = "views/dashboard.php";

                } else if (response.status == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.msg,
                    })
                }
            }
        });
    });
</script>

</html>