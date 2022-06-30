<?php
session_start();
include '../functions/cleaner.php';
require '../components/dbconn.php';

if (isset($_POST['action']) == 'tambah') {
    $judul = cleaner($_POST['judul']);
    $isi = $_POST['isi'];
    $id_admin = cleaner($_SESSION['data_admin']['id']);
    if ($_SESSION['data_admin']['role_id'] == 1) {
        $id_status = 1;
    } elseif ($_SESSION['data_admin']['role_id'] == 2) {
        $id_status = 2;
    }
    $segmen = cleaner($_POST['segmen']);
    //upload gambar
    $dir = "../uploads/gambarArtikel/";
    $avatarName = md5(uniqid(mt_rand(), true));
    $tar_upl = $dir . basename(($_FILES['gambar']['name']));
    $docType = strtolower(pathinfo($tar_upl, PATHINFO_EXTENSION));
    $avatarName .= "." . $docType;
    $tar_upl = $dir . $avatarName;
    //Amankan Form 
    $segmen = strip_tags(mysqli_real_escape_string($conn, trim($segmen)));
    $judul = strip_tags(mysqli_real_escape_string($conn, trim($judul)));
    $id_status = strip_tags(mysqli_real_escape_string($conn, trim($id_status)));
    $id_admin = strip_tags(mysqli_real_escape_string($conn, trim($id_admin)));
    // Format DOB 
    date_default_timezone_set("Asia/Jakarta");
    $currDate = date('Y-m-d');

    //Validasi 
    $error = array(
        'error_status' => 0
    );
    if (empty($judul)) {
        $error['error_status'] = 1;
        $error['judul'] = 'Field model wajib diisi!';
    }
    if (!empty($judul)) {
        if (strlen($judul) < 15) {
            $error['error_status'] = 1;
            $error['judul'] = 'Panjang karakter setidaknya 15 karakter!';
        }
    }
    if (empty($isi)) {
        $error['error_status'] = 1;
        $error['isi'] = 'Field Isi Artikel wajib diisi!';
    }
    if (!empty($isi)) {
        if (strlen($isi) < 200) {
            $error['error_status'] = 1;
            $error['isi'] = 'Field isi minimal memiliki 200 karakter!';
        }
    }
    if ($error['error_status'] > 0) {
        echo json_encode($error);
        exit();
    }
    // Proses Insert 
    $query = $conn->prepare("INSERT INTO artikel (judul, gambar, isi, admin_id, status_id, segmentasi_id, tanggal_dibuat) VALUES (?, ?, ?, ?, ?, ? , ?)");
    $query->bind_param("sssiiis", $judul, $tar_upl, $isi, $id_admin, $id_status, $segmen, $currDate);
    if ($query->execute()) {
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $tar_upl)) {
        }
        $response = array(
            'status' => 1,
            'msg' => 'Berhasil Menambahkan Artikel'
        );
    } else {
        $response = array(
            'status' => 0,
            'msg' => 'Gagal Menambahkan Artikel'
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
    <title>Document</title>
    <?php
    include '../framework/jquery.php';
    include '../framework/bootstrap.php';
    include '../framework/sweetalert2.php';
    ?>
</head>

<body>
    <?php include '../components/navbarAdmin.php' ?>
    <?php if ($_SESSION['auth_admin'] == true) { ?>
        <section class="vh-100 gradint mt-5">
            <div class="container py-3 h-100">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 col-md-10 col-lg-9 col-xl-9 col-sm-12">
                        <div class="card bg-dark" style="border-radius: 1rem; max-width:100rem">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-white text-center">Form Tambah Artikel</h3>
                                    <form method="POST" enctype="multipart/form-data" class="text-start" id="tambahArtikel" action="">
                                        <div class="form-floating">
                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="segmen">
                                                <?php
                                                $getSegmen = "SELECT * FROM segmen";
                                                $resSeg = $conn->query($getSegmen);
                                                while ($data = $resSeg->fetch_assoc()) {
                                                    echo "<option value= '$data[id]'>$data[description]</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingSelect">Segmentasi</label>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Samsung S22" name="judul" value="">
                                            <label for="floatingInput">Judul Artikel</label>
                                            <small class="text-danger ml-5" id="judulError"></small>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 800px; resize:none;white-space: pre-wrap;" name="isi"></textarea>
                                            <label for="floatingInput">Isi Artikel</label>
                                            <small class="text-danger ml-5" id="isiError"></small>
                                        </div>
                                        <div class="mb-3 mt-4">
                                            <label for="formFile" class="form-label text-white">Gambar</label>
                                            <input class="form-control py-3" type="file" id="file" name="gambar">
                                            <span class="text-white"></span>
                                        </div>
                                        <div class="text-center mt-5 ">
                                            <input type="submit" name="tambah" class="btn btn-outline-dark btn-success btn-lg px-5 text-white " value="Tambah Artikel">
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
    } ?>
    <script>
        $(document).ready(function() {
            $('#tambahArtikel').on('submit', function(e) {
                e.preventDefault();
                var data = new FormData($(this)[0]);
                data.append('action', 'tambah');
                var form = $(this);
                form.find(':submit').attr('disabled', true);
                var url = "/412020004_SANTIAGO/administrator/tambahArtikel.php";
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
                            }).then(function() {
                                document.location.href = "dashboardAdmin.php";
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
                        title: 'Format File Tidak Benar',
                        text: 'Format file hanya boleh jpg, png dan jpeg',
                    })
                    $("#file").val('');
                    return false;
                }
            });
        });
    </script>
</body>

</html>