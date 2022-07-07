<?php
session_start();
require '../components/dbconn.php';
include '../functions/cleaner.php';
if (isset($_POST['action']) == 'tambah') {
    $segmen = cleaner($_POST['segmen']);
    $brand = cleaner($_POST['brand']);
    $id_admin = cleaner($_SESSION['data_admin']['id']);
    if ($_SESSION['data_admin']['role_id'] == 1) {
        $id_status = 1;
    } elseif ($_SESSION['data_admin']['role_id'] == 2) {
        $id_status = 2;
    }
    $model = cleaner($_POST['model']);
    $processor = cleaner($_POST['processor']);
    $OS = cleaner($_POST['OS']);
    $RAM = cleaner($_POST['RAM']);
    $GPU = cleaner($_POST['GPU']);
    $layar = cleaner($_POST['layar']);
    $berat = cleaner($_POST['berat']);
    $penyimpanan = cleaner($_POST['penyimpanan']);
    $harga = cleaner($_POST['harga']);
    // Format DOB 
    date_default_timezone_set("Asia/Jakarta");
    $currDate = date('Y-m-d');

    //upload gambar
    $dir = "../uploads/gambarModel/";
    $avatarName = md5(uniqid(mt_rand(), true));
    $tar_upl = $dir . basename(($_FILES['gambar']['name']));
    $docType = strtolower(pathinfo($tar_upl, PATHINFO_EXTENSION));
    $avatarName .= "." . $docType;
    $tar_upl = $dir . $avatarName;

    //Amankan Form 
    $segmen = strip_tags(mysqli_real_escape_string($conn, trim($segmen)));
    $brand = strip_tags(mysqli_real_escape_string($conn, trim($brand)));
    $model = strip_tags(mysqli_real_escape_string($conn, trim($model)));
    $processor = strip_tags(mysqli_real_escape_string($conn, trim($processor)));
    $OS = strip_tags(mysqli_real_escape_string($conn, trim($OS)));
    $RAM = strip_tags(mysqli_real_escape_string($conn, trim($RAM)));
    $GPU = strip_tags(mysqli_real_escape_string($conn, trim($GPU)));
    $layar = strip_tags(mysqli_real_escape_string($conn, trim($layar)));
    $berat = strip_tags(mysqli_real_escape_string($conn, trim($berat)));
    $penyimpanan = strip_tags(mysqli_real_escape_string($conn, trim($penyimpanan)));
    $harga = strip_tags(mysqli_real_escape_string($conn, trim($harga)));

    //Validasi 
    $error = array(
        'error_status' => 0
    );
    if (empty($model)) {
        $error['error_status'] = 1;
        $error['model'] = 'Field model wajib diisi!';
    }
    if (!empty($model)) {
        if (strlen($model) < 5) {
            $error['error_status'] = 1;
            $error['model'] = 'Panjang karakter setidaknya 5 karakter!';
        }
    }
    if (empty($processor)) {
        $error['error_status'] = 1;
        $error['processor'] = 'Field processor wajib diisi!';
    }
    if (!empty($processor)) {
        if (strlen($processor) < 5) {
            $error['error_status'] = 1;
            $error['processor'] = 'Panjang karakter setidaknya 5 karakter!';
        }
    }
    if (empty($OS)) {
        $error['error_status'] = 1;
        $error['OS'] = 'Field OS wajib diisi!';
    }
    if (!empty($OS)) {
        if (strlen($OS) < 5) {
            $error['error_status'] = 1;
            $error['OS'] = 'Panjang karakter setidaknya 5 karakter!';
        }
    }
    if (empty($RAM)) {
        $error['error_status'] = 1;
        $error['RAM'] = 'Field RAM wajib diisi!';
    }
    if (empty($GPU)) {
        $error['error_status'] = 1;
        $error['GPU'] = 'Field GPU wajib diisi!';
    }
    if (!empty($GPU)) {
        if (strlen($GPU) < 5) {
            $error['error_status'] = 1;
            $error['GPU'] = 'Panjang karakter setidaknya 5 karakter!';
        }
    }
    if (empty($layar)) {
        $error['error_status'] = 1;
        $error['layar'] = 'Field layar wajib diisi!';
    }
    if (!empty($layar)) {
        if (strlen($layar) < 5) {
            $error['error_status'] = 1;
            $error['layar'] = 'Panjang karakter setidaknya 5 karakter!';
        }
    }
    if (empty($penyimpanan)) {
        $error['error_status'] = 1;
        $error['penyimpanan'] = 'Field penyimpanan wajib diisi!';
    }
    if (!empty($penyimpanan)) {
        if (strlen($penyimpanan) < 5) {
            $error['error_status'] = 1;
            $error['penyimpanan'] = 'Panjang karakter setidaknya 5 karakter!';
        }
    }
    if (empty($berat)) {
        $error['error_status'] = 1;
        $error['berat'] = 'Field berat wajib diisi!';
    }
    if (!empty($berat)) {
        if (strlen($berat) < 1) {
            $error['error_status'] = 1;
            $error['berat'] = 'Panjang karakter setidaknya 1 karakter!';
        }
    }
    if (empty($harga)) {
        $error['error_status'] = 1;
        $error['harga'] = 'Field harga wajib diisi!';
    }
    if ($error['error_status'] > 0) {
        echo json_encode($error);
        exit();
    }

    // Proses Insert 
    $query = $conn->prepare("INSERT INTO spesifikasi(segmentasi_id, brand_id, status_id, admin_id, nama_model, gambar, processor, OS, RAM, GPU, dimensi_layar, berat, penyimpanan, harga , dibuat_tanggal)  VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("iiiisssssssssss", $segmen, $brand, $id_status, $id_admin, $model, $tar_upl, $processor, $OS, $RAM, $GPU, $layar, $berat, $penyimpanan, $harga, $currDate);
    if ($query->execute()) {
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $tar_upl)) {
        }
        $response = array(
            'status' => 1,
            'msg' => 'Berhasil Menambahkan Spesifikasi'
        );
    } else {
        $response = array(
            'status' => 0,
            'msg' => 'Gagal Menambahkan Spesifikasi'
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
    <?php
    if ($_SESSION['auth_admin'] == true) {
    ?>
        <section class="vh-100 gradint">
            <div class="container py-3 h-100">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 col-md-10 col-lg-9 col-xl-9 col-sm-12">
                        <div class="card bg-dark" style="border-radius: 1rem; max-width:100rem">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-white text-center">Form Tambah Spesifikasi</h3>
                                    <form method="POST" enctype="multipart/form-data" class="text-start" id="tambahSpek" action="">
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
                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="brand">
                                                <?php
                                                $getBrand = "SELECT * FROM brand WHERE active = 1 ";
                                                $resBrand = $conn->query($getBrand);
                                                while ($dataBrand = $resBrand->fetch_assoc()) {
                                                    echo "<option value= '$dataBrand[id]'>$dataBrand[description]</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingSelect">Tipe Brand</label>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Samsung S22" name="model">
                                            <label for="floatingInput">Nama Model</label>
                                            <small class="text-danger ml-5" id="modelError"></small>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="text" class="form-control" placeholder="08599022xxx" name="processor">
                                            <label for="floatingInput">Processor</label>
                                            <small class="text-danger ml-5" id="processorError"></small>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="email@gmail.com" name="OS">
                                            <label for="floatingInput">Sistem Operasi</label>
                                            <small class="text-danger ml-5" id="OSError"></small>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="email@gmail.com" name="RAM">
                                            <label for="floatingInput">Ukuran RAM</label>
                                            <small class="text-danger ml-5" id="RAMError"></small>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="email@gmail.com" name="GPU">
                                            <label for="floatingInput">Unit Pemrosesan Grafis (GPU)</label>
                                            <small class="text-danger ml-5" id="GPUError"></small>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="email@gmail.com" name="layar">
                                            <label for="floatingInput">Dimensi Layar</label>
                                            <small class="text-danger ml-5" id="layarError"></small>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="text" class="form-control" id="textInteger1" placeholder="email@gmail.com" name="berat">
                                            <label for="floatingInput">Berat (gram)</label>
                                            <small class="text-danger ml-5" id="beratError"></small>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="text" class="form-control" id="" placeholder="email@gmail.com" name="penyimpanan">
                                            <label for="floatingInput">Penyimpanan (GB)</label>
                                            <small class="text-danger ml-5" id="penyimpananError"></small>
                                        </div>
                                        <div class="form-floating mb-3 mt-4">
                                            <input type="text" class="form-control" id="textInteger currency-field" placeholder="email@gmail.com" name="harga" data-type="currency">
                                            <label for=" floatingInput">Harga (Rp.)</label>
                                            <small class="text-danger ml-5" id="hargaError"></small>
                                        </div>
                                        <div class="mb-3 mt-4">
                                            <label for="formFile" class="form-label text-white">Gambar</label>
                                            <input class="form-control py-3" type="file" id="file" name="gambar" required>
                                        </div>
                                        <div class="text-center mt-5 ">
                                            <input type="submit" name="tambah" class="btn btn-outline-dark btn-success btn-lg px-5 text-white " value="Tambah Spesifikasi">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="../functions/currencyformat.js"></script>
    <?php
    } else {
        header('location:loginAdmin.php');
    }
    ?>
    <script src="../functions/textInteger.js"></script>
    <script>
        $(document).ready(function() {
            $('#tambahSpek').on('submit', function(e) {
                e.preventDefault();
                var data = new FormData($(this)[0]);
                data.append('action', 'tambah');
                var form = $(this);
                form.find(':submit').attr('disabled', true);
                var url = "../administrator/tambahSpek.php";
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
                        title: 'File Tidak Sesuai Format',
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