<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/profileUser.css">
    <?php
    include '../framework/jquery.php';
    include '../framework/sweetalert2.php';
    ?>
</head>
<script src="../functions/textInteger.js"></script>

<body>
    <?php if ($_SESSION['auth'] == true) {
        include '../components/navbar.php';
    ?>
        <section class="profile">
            <div class="jumbotron jumbotron-fluid jumbo-user">
            </div>
            <div class="container">
                <div class=" border-img d-flex justify-content-center">
                    <img src="" class="img-profile">
                </div>
                <h2 class="text-center text-white" id='username'></h2>
                <div class="detailUser text-white mt-1 py-5">
                    <div class="container drop mt-4 w-75m ">
                        <div class="row py-5">
                            <h1 class="text-center mt-4">User Profile</h1>
                            <div class="mt-1 mb-5 d-flex justify-content-end ">
                                <button type="button" class="btn btn-warning col-md-2 col-12" id="btn-edit">Edit Profile <i class="bi bi-pencil-square"></i></button>
                            </div>
                            <div class="col-md-7">
                                <h5 id="email" class="mb-3"></h5>
                                <h5 id="gender"></h5>
                            </div>
                            <div class="col-md-5 ">
                                <h5 id="namaLengkap" class="mb-3"></h5>
                                <h5 id="handphone" class="mb-3"></h5>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Modal -->
        <div class="modal fade" id="modalProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form" id="edit-profile-form" enctype="multipart/form-data">
                            <input type="hidden" name="id-user" value="<?php echo $_SESSION['data_user']['id'] ?>">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" readonly disabled name="email">
                                <label for="floatingInput">Alamat Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="username">
                                <label for="floatingInput">Username</label>
                                <small class="text-danger" id="usernameError"></small>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="nama">
                                <label for="floatingInput">Nama Lengkap</label>
                                <small class="text-danger" id="namaError"></small>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control textInteger1" id="textInteger" placeholder="name@example.com" name="no_hp">
                                <label>Nomor Handphone</label>
                                <small class="text-danger" id="no_hpError"></small>
                            </div>
                            <div class="form-floating mb-3">
                                <select type="text" class="form-select gender" id="gender" name="gender">
                                </select>
                                <label>Jenis Kelamin</label>
                            </div>
                            <div class="mb-3">
                                <label>Gambar Profil</label>
                                <input type="file" class="form-control" name="avatar" id="file">
                                <br>
                                <img src="" id="priv-img" class="priv-img"></img>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveEdit">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../components/footer.php' ?>
    <?php
    } else {
        header('location:../index.php');
    } ?>
</body>
<script>
    $(document).ready(function() {
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
        getUser();
        $('#btn-edit').click(function() {
            $('#modalProfile').modal("show")
            $.ajax({
                type: "POST",
                url: "/412020004_SANTIAGO/userData/profile.php",
                data: {
                    req: "editUser",
                    id: <?php echo $_SESSION['data_user']['id']; ?>
                },
                dataType: "JSON",
                success: function(response) {
                    $('input[name="email"]').val(response[0].email);
                    $('input[name="username"]').val(response[0].username);
                    $('input[name="nama"]').val(response[1].nama);
                    $('input[name="no_hp"]').val(response[1].no_handphone);
                    $('#priv-img').attr("src", response[0].avatar);
                    getGender(response[1].gender_id);
                }
            });
        });
        $('#saveEdit').click(function(e) {
            e.preventDefault();
            var form = $('#edit-profile-form')[0];
            var formData = new FormData(form);
            var frm = $('#edit-profile-form');
            formData.append('action', 'editProfile');
            Swal.fire({
                title: 'Selesai Mengedit Profil?',
                text: "Yakin Melakukan Perubahan pada Profil Anda?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "/412020004_SANTIAGO/userData/editProfile.php",
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
                                    title: 'Berhasil Edit',
                                    text: response.msg,
                                }).then(function() {
                                    document.location.href = "userProfile.php";
                                })

                            } else if (response.status == 0) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.msg,
                                })
                            }
                        }
                    });
                }
            })
        })

    });

    function getUser() {
        $.ajax({
            type: "POST",
            url: "/412020004_SANTIAGO/userData/profile.php",
            data: {
                req: "detailUser",
                id: <?php echo $_SESSION['data_user']['id']; ?>
            },
            dataType: "JSON",
            success: function(response) {
                $('.img-profile').attr("src", response[0].avatar)
                $('#username').text(response[0].username)
                $('#email').text("Email : " + response[0].email);
                $('#namaLengkap').text("Nama Lengkap : " + response[1].nama);
                $('#handphone').text("Nomor Handphone : " + response[1].no_handphone);
                $('#gender').text("Jenis Kelamin : " + response[1].description);
            }
        });
    }

    function getGender(genderId) {
        $.ajax({
            type: "POST",
            url: "/412020004_SANTIAGO/userData/profile.php",
            data: {
                req: "gender"
            },
            dataType: "JSON",
            success: function(response) {
                var select = "";
                $.each(response, function(i, item) {
                    if (genderId) {
                        if (genderId == item.id) {
                            select +=
                                "<option value='" +
                                item.id +
                                "' selected >" +
                                item.description +
                                "</option>";
                        } else {
                            select +=
                                "<option value='" +
                                item.id +
                                "'  >" +
                                item.description +
                                "</option>";
                        }
                    } else {
                        select +=
                            "<option value='" +
                            item.id +
                            "'  >" +
                            item.description +
                            "</option>";
                    }
                });
                $(".gender").html(select);
            }
        });
    }
</script>

</html>