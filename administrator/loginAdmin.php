<?php
session_start();
include '../functions/cleaner.php';
require '../components/dbconn.php';

if (isset($_POST['action']) == 'loggedAdmin') {
    $username = cleaner($_POST['username']);
    $pass = cleaner($_POST['pass']);

    $username = strip_tags(mysqli_real_escape_string($conn, trim($username)));
    $pass = strip_tags(mysqli_real_escape_string($conn, trim($pass)));

    //validation 
    $error = array(
        'error_status' => 0
    );
    if (empty($username)) {
        $error['error_status'] = 1;
        $error['username'] = 'Field username wajib diisi!';
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
    $query = $conn->prepare("SELECT * FROM login_admin WHERE username = ?");
    $query->bind_param("s", $username);
    if ($query->execute()) {
        $res = $query->get_result();
        $row = $res->fetch_assoc();
        $rownums = mysqli_num_rows($res);
        if ($rownums == 1) {
            $ver = password_verify($pass, $row['password']);
            if ($ver == true) {
                $response = array(
                    'status' => 1,
                    'msg' => 'Login Berhasil'
                );
                $_SESSION['auth_admin'] = true;
                $_SESSION['data_admin'] = $row;
            } else {
                $response = array(
                    'status' => 0,
                    'msg' => 'Username atau Password anda salah'
                );
            }
        } else {

            $response = array(
                'status' => 0,
                'msg' => 'Username atau Password anda salah'
            );
        }
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
    <link rel="stylesheet" href="../css/loginAdmin.css">
    <?php
    include '../framework/bootstrap.php';
    include '../framework/jquery.php';
    include '../framework/sweetalert2.php';
    ?>
</head>

<body class="text-center">
    <section class="vh-100 gradint">
        <div class=" py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="text-white" style="border-radius: 1rem;">
                        <div class="p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Admin Login Page</h2>
                                <div class="mb-5"></div>
                                <form enctype="multipart/form-data" id="loginAdmin">
                                    <div class="form-outline form-white mb-5 mt-5">
                                        <label class="form-label fw-bold" for="logid">Username</label>
                                        <input type="text" name="username" id="logid" class="form-control form-control-lg" />
                                        <small class="text-danger ml-5" id="usernameError"></small>
                                    </div>
                                    <div class="form-outline form-white mb-5 mt-5">
                                        <label class="form-label fw-bold" for="typePasswordX">Password</label>
                                        <input type="password" id="typePasswordX" name="pass" class="form-control form-control-lg" />
                                        <small class="text-danger ml-5" id="passError"></small>
                                    </div>
                                    <input type="submit" name="login" class="btn btn-outline-light btn-lg px-5 fw-bold mb-3" value="Submit">
                                    <p class="mb-0 mt-3">Are you not the admin? <a class="text-white-50 fw-bold" href="../index.php">Login as user!</a></p>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    $('#loginAdmin').on('submit', function(e) {
        e.preventDefault();
        var data = new FormData($(this)[0]);
        data.append('action', 'loggedAdmin');
        var form = $(this);
        form.find(':submit').attr('disabled', true);
        var url = "/412020004_SANTIAGO/administrator/loginAdmin.php";
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
                    // handling success response
                    document.location.href = "/412020004_SANTIAGO/administrator/dashboardAdmin.php";

                } else if (response.status == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal',
                        text: response.msg,
                    })
                }
            }
        });
    })
</script>

</html>