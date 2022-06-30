<?php
session_start();
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
    <?php
    include '../components/navbarAdmin.php';
    if ($_SESSION['auth_admin'] == true && $_SESSION['data_admin']['role_id'] == 2) {
    ?>
        <h1 class="text-center text-white mt-3">List of Brands in TechAreas</h1>
        <div class="table-responsive container">
            <button type="button" class="btn btn-primary mt-5" data-bs-toggle="modal" id="btn-add">
                Add New Brand
            </button>
            <table class="table table-dark table-striped mt-5 text-center ">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Brand</th>
                        <th scope="col text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="ModalBrand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" class="text-start" id="brandForm">
                            <input type="hidden" name="id_brand">
                            <div class="form-floating mb-3 mt-4">
                                <input type="text" class="form-control" placeholder="Samsung S22" name="brand">
                                <label for="floatingInput">Nama Brand</label>
                                <small class="text-danger ml-5" id="brandError"></small>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-modal" id="btn-save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else {
        header('location:loginAdmin.php');
    }
    ?>
</body>
<script>
    $(this).ready(function() {
        $.ajax({
            type: "POST",
            url: "/412020004_SANTIAGO/data/dataBrand.php",
            data: {
                req: 'rows'
            },
            dataType: "JSON",
            success: function(response) {
                var items;
                var count = 1;
                $.each(response, function(i, item) {
                    items += "<tr><td>" +
                        count +
                        "</td><td>" +
                        item.description +
                        "</td><td>" +
                        "<button class='btn btn-warning' id='btn-edit' data-bs-toggle='modal' data-id='" + item.id + "'>Edit  <i class='bi bi-pencil-fill'></i></button> <button class='btn btn-danger' id = 'btn-delete' data-id='" + item.id + "'> Delete <i class='bi bi-trash-fill'></i> </button></td></tr>"
                    count++
                })
                $("tbody").html(items);
            }
        });
    });
    $(document).on('click', '#btn-edit', function() {
        var itemId = $(this).data('id');
        $(".btn-modal").attr("id", "btn-save");
        $("#ModalBrand").modal("show");
        $.ajax({
            type: "POST",
            url: "/412020004_SANTIAGO/data/dataBrand.php",
            data: {
                req: 'brand',
                id: itemId
            },
            dataType: "JSON",
            success: function(response) {
                $.each(response, function(i, item) {
                    $('input[name="id_brand"]').val(item.id);
                    $('input[name="brand"]').val(item.description);
                });

            }
        });
    })
    $(document).on('click', '#btn-delete', function() {
        var itemId = $(this).data('id');
        Swal.fire({
            title: 'Yakin Menghapus?',
            text: "Anda tidak dapat memulihkan brand yang anda hapus!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "/412020004_SANTIAGO/data/actionBrand.php",
                    data: {
                        req: 'delete',
                        id: itemId
                    },
                    dataType: "JSON",
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Menghapus',
                            text: response.msg,
                        }).then(function() {
                            document.location.href = "listBrand.php";
                        })
                    }
                });
            }
        })

    })
    $(document).on('click', '#btn-save', function(e) {
        e.preventDefault();
        var form = $('form')[0];
        console.log(form);
        var formData = new FormData(form);
        var frm = $('#brandForm');
        formData.append('action', 'edit');
        Swal.fire({
            title: 'Selesai Mengedit?',
            text: "Anda tidak dapat memulihkan content form yang telah anda edit!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "/412020004_SANTIAGO/data/actionBrand.php",
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
                                document.location.href = "listBrand.php";
                            })

                        } else if (response.status == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Edit',
                                text: response.msg,
                            })
                        }
                    }
                });
            }
        })
    });

    $(document).on('click', '#btn-add', function() {
        $("#ModalBrand").modal("show");
        $('input[name="brand"]').val("");
        $(".btn-modal").attr("id", "btn-adder");
    });
    $(document).on('click', '#btn-adder', function(e) {
        e.preventDefault();
        var form = $('form')[0];
        console.log(form);
        var formData = new FormData(form);
        var frm = $('#brandForm');
        formData.append('action', 'add');
        Swal.fire({
            title: 'Selesai Mengisi Form?',
            text: "Form akan disubmit!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "/412020004_SANTIAGO/data/addBrand.php",
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
                                title: 'Berhasil Menambahkan',
                                text: response.msg,
                            }).then(function() {
                                document.location.href = "listBrand.php";
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
    });
</script>

</html>