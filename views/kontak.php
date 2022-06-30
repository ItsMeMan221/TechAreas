<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami</title>
    <?php
    include '../framework/jquery.php';
    include '../framework/sweetalert2.php';
    ?>
    <link rel="stylesheet" href="../css/kontak.css">
</head>

<body>
    <?php
    if ($_SESSION['auth'] == true) {
        include '../components/navbar.php';
    ?>
        <section class="h-100 ">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        <div class="card card-registration my-4 bc-contain">
                            <div class="row g-0">
                                <div class="col-xl-6 d-none d-xl-block">
                                    <img src="../img/michal-biernat-h0xEUQXzU38-unsplash.jpg" alt="Sample photo" class="img-fluid" style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                                </div>
                                <div class="col-xl-6">
                                    <div class="card-body p-md-5 text-white">
                                        <h3 class="text-uppercase">Kontak Kami</h3>
                                        <div class="col-md-4 col-sm-2 col-xs-2 col-6 mb-5">
                                            <hr class="hr-kontak">
                                        </div>
                                        <form enctype="multipart/form-data" id="kontakForm">
                                            <input type="hidden" name="id-user" value="<?php echo $_SESSION['data_user']['id'] ?>">
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Judul</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" placeholder="Masukkan Judul Topik Anda disini" id="floatingTextarea2" style="height: 100px; resize:none;white-space: pre-wrap;" name="judul"></textarea>
                                                    <small class="text-danger" id="judulError"></small>
                                                </div>
                                            </div>
                                            <div class="mt-5"></div>
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Isi Topik</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" placeholder="Isi Topik" id="floatingTextarea2" style="height: 300px; resize:none;white-space: pre-wrap;" name="isi"></textarea>
                                                    <small class="text-danger" id="isiError"></small>
                                                </div>

                                            </div>
                                        </form>
                                        <div class="d-flex justify-content-end pt-3 mt-5">
                                            <button type="button" class="btn btn-success btn-lg ms-2 col-md-3" id="btn-kirim">Kirim</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include '../components/footer.php' ?>
    <?php
    } else {
        header('location:../index.php');
    }
    ?>
</body>
<script>
    $(this).ready(function() {
        $('#btn-kirim').click(function(e) {
            e.preventDefault();
            var form = $('#kontakForm')[0];
            var formData = new FormData(form);
            var frm = $('#kontakForm');
            formData.append('action', 'kirim');
            Swal.fire({
                title: 'Selesai Mengisi Kontak Form?',
                text: "Form Akan dikirim ke Admin",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "/412020004_SANTIAGO/userData/contact.php",
                        data: formData,
                        dataType: "JSON",
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.error_status == 1) {
                                frm.find('small').text('');
                                for (var key in response) {
                                    var errorContainer = frm.find(`#${key}Error`);
                                    if (errorContainer.length !== 0) {
                                        errorContainer.html(response[key]);
                                    }
                                }
                            }
                            if (response.status == 1) {
                                frm.find('small').text('');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil Dikirim',
                                    text: response.msg,
                                }).then(function() {
                                    document.location.href = "kontak.php";
                                })

                            } else if (response.status == 0) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Terkirim',
                                    text: response.msg,
                                })
                            }
                        }
                    });
                }
            })
        })
    })
</script>

</html>