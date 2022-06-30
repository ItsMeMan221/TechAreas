<?php
session_start();
$role_id = $_SESSION['data_admin']['role_id'];
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
    <link rel="stylesheet" href="../css/artikel.css">
</head>

<body>
    <?php
    if ($_SESSION['auth_admin'] == true) {
        include '../components/navbarAdmin.php';
    ?>
        <h1 class="text-center text-white mt-3">Inbox Spesifikasi</h1>

        <div class="container">
            <form class="d-flex col-md-3 mt-5 ms-auto" role="search">
                <input class="form-control me-2" placeholder="Search" id="keyword">
            </form>
        </div>
        <div class="table-responsive container text-center">
            <table class="table table-dark table-striped mt-5 " id="tbl-artikel">
                <thead class="text-center">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Ditulis Oleh (username)</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Model Hp</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Status Sekarang</th>
                        <th scope="col text-center">Action</th>
                    </tr>
                </thead>
                <tbody id='isi'>
                </tbody>
            </table>
            <div class="modal fade modal-xl modal-dialog-scrollable" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Artikel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form enctype="multipart/form-data" class="text-start" id="editSpek">
                                <input type="hidden" name="id_spek">
                                <input type="hidden" name="id_status">
                                <div class="form-floating">
                                    <select class="form-select" aria-label="Floating label select example" name="segmen" id="segmen">
                                    </select>
                                    <label for="floatingSelect">Segmentasi</label>
                                </div>
                                <div class="form-floating mb-3 mt-4">
                                    <select class="form-select" aria-label="Floating label select example" name="brand" id="brand">
                                    </select>
                                    <label for="floatingSelect">Tipe Brand</label>
                                </div>
                                <div class="form-floating mb-3 mt-4">
                                    <input type="text" class="form-control" placeholder="Samsung S22" name="model">
                                    <label for="floatingInput">Nama Model</label>
                                    <small class="text-danger ml-5" id="modelError"></small>
                                </div>
                                <div class="form-floating mb-3 mt-4">
                                    <input type="text" class="form-control" placeholder="08599022xxx" name="processor">
                                    <label for="floatingInput">Processor</label>
                                    <small class="text-danger ml-5" id="processorError"></small>
                                </div>
                                <div class="form-floating mb-3 mt-4">
                                    <input type="text" class="form-control" placeholder="email@gmail.com" name="OS">
                                    <label for="floatingInput">Sistem Operasi</label>
                                    <small class="text-danger ml-5" id="OSError"></small>
                                </div>
                                <div class="form-floating mb-3 mt-4">
                                    <input type="text" class="form-control" placeholder="email@gmail.com" name="RAM">
                                    <label for="floatingInput">Ukuran RAM</label>
                                    <small class="text-danger ml-5" id="RAMError"></small>
                                </div>
                                <div class="form-floating mb-3 mt-4">
                                    <input type="text" class="form-control" placeholder="email@gmail.com" name="GPU">
                                    <label for="floatingInput">Unit Pemrosesan Grafis (GPU)</label>
                                    <small class="text-danger ml-5" id="GPUError"></small>
                                </div>
                                <div class="form-floating mb-3 mt-4">
                                    <input type="text" class="form-control" placeholder="email@gmail.com" name="layar">
                                    <label for="floatingInput">Dimensi Layar</label>
                                    <small class="text-danger ml-5" id="layarError"></small>
                                </div>
                                <div class="form-floating mb-3 mt-4">
                                    <input type="text" class="form-control" id="textInteger1" placeholder="email@gmail.com" name="berat">
                                    <label for="floatingInput">Berat (gram)</label>
                                    <small class="text-danger ml-5" id="beratError"></small>
                                </div>
                                <div class="form-floating mb-3 mt-4">
                                    <input type="text" class="form-control" placeholder="email@gmail.com" name="penyimpanan">
                                    <label for="floatingInput">Penyimpanan (GB)</label>
                                    <small class="text-danger ml-5" id="penyimpananError"></small>
                                </div>
                                <div class="form-floating mb-3 mt-4">
                                    <input type="text" class="form-control" id="textInteger currency-field" placeholder="email@gmail.com" name="harga" data-type="currency">
                                    <label for=" floatingInput">Harga (Rp.)</label>
                                    <small class="text-danger ml-5" id="hargaError"></small>
                                </div>
                                <div class="mb-3 mt-4">
                                    <label for="formFile" class="form-label">Gambar</label>
                                    <input class="form-control py-3" type="file" id="file" name="gambar" required>
                                    <span id='image-src'></span>
                                    <img src="" class="preview-image">
                                </div>
                                <div class="modal-footer">
                                    <div class="container-1"></div>
                                    <div class="container-2"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_GET['s'])) {
            ?>
                <div class="notif" data-flashdata="<?= $_GET['s'] ?>"> </div>
            <?php
            }
            ?>
        <?php
    } else {
        header('location:loginAdmin.php');
    }
        ?>
</body>
<script src="../functions/currencyformat.js"></script>
<script src="../functions//textInteger.js"></script>
<script src="../functions/htmlEntities.js"></script>
<script>
    $(this).ready(function() {

        // Validasi File
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
        // Populasi Tabel Spek
        $.ajax({
            type: "POST",
            url: "/412020004_SANTIAGO/data/dataSpek.php",
            data: {
                req: 'rows'
            },
            dataType: "JSON",
            success: function(response) {
                var items;
                var count = 1;
                var control = 2;
                $.each(response, function(i, item) {
                    if (control != <?php echo $role_id ?>) {
                        items += "<tr><td>" +
                            count +
                            "</td><td>" +
                            item.username +
                            "</td><td>" +
                            item.brand_descr +
                            "</td><td>" +
                            item.nama_model +
                            "</td><td>" +
                            item.harga +
                            "</td><td>" +
                            item.status_descr +
                            "</td><td>" +
                            "<button class='btn btn-warning' id='btn-detail' data-bs-toggle='modal' data-segmen='" + item.segmentasi_id + "' data-id='" + item.id + "' data-brand = '" + item.brand_id + "' >Detail<i class='bi bi-pencil-fill'></i></button></td></tr>"
                    } else if (control == <?php echo $role_id ?>) {
                        items += "<tr><td>" +
                            count +
                            "</td><td>" +
                            item.username +
                            "</td><td>" +
                            item.brand_descr +
                            "</td><td>" +
                            item.nama_model +
                            "</td><td>" +
                            item.harga +
                            "</td><td>" +
                            item.status_descr +
                            "</td><td>" +
                            "<button class='btn btn-warning' id='btn-detail' data-bs-toggle='modal' data-segmen='" + item.segmentasi_id + "' data-id='" + item.id + "' data-brand = '" + item.brand_id + "' >Detail<i class='bi bi-pencil-fill'></i></button>  <button id = 'btn-delete' class = 'btn btn-danger' data-id = '" + item.id + "'>Delete  <i class='bi bi-trash-fill'></i></button></td></tr>"
                    }
                    count++
                });
                $("tbody").html(items);
            }
        });
        //Search function
        $('#keyword').on('keyup', function() {
            $.ajax({
                type: "POST",
                url: "../data/search.php",
                data: {
                    search: $(this).val(),
                    req: 'searchSpek'
                },
                dataType: "html",
                cache: false,
                success: function(response) {
                    $("#isi").html(response);
                }
            });
        });
    });

    // Button Delete 

    $(document).on('click', '#btn-delete', function(e) {
        var idSpek = $(this).data('id');
        e.preventDefault();
        Swal.fire({
            title: 'Anda yakin menghapus artikel ini?',
            text: "Anda tidak dapat memulihkan artikel yang anda hapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "/412020004_SANTIAGO/data/dataSpek.php",
                    data: {
                        req: 'delete',
                        id: idSpek
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response[0] == '1') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Dihapus',
                                text: response.msg,
                            }).then(function() {
                                document.location.href = "inboxSpek.php";
                            })
                        } else if (response[0] == '0') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Hapus',
                                text: response.msg,
                            }).then(function() {
                                document.location.href = "inboxSpek.php";
                            })
                        }
                    }
                });
            }

        });

    })

    // Button Detail diklik
    $(document).on('click', '#btn-detail', function() {
        var idArtikel = $(this).data('id');
        var idSegmen = $(this).data('segmen');
        var idBrand = $(this).data('brand');
        var control = 2;
        $("#detailModal").modal("show");
        $.ajax({
            type: "POST",
            url: "/412020004_SANTIAGO/data/dataSpek.php",
            data: {
                req: 'segmen'
            },
            dataType: "JSON",
            success: function(response) {
                var segmens;
                $.each(response, function(i, item) {
                    if (item.id == idSegmen) {
                        segmens +=
                            "<option value='" + item.id + "' selected >" + item.description + "</option>";
                    } else {
                        segmens +=
                            "<option value='" + item.id + "' >" + item.description + "</option>";
                    }
                });
                $("#segmen").html(segmens);
            }
        });
        $.ajax({
            type: "POST",
            url: "/412020004_SANTIAGO/data/dataSpek.php",
            data: {
                req: 'brand'
            },
            dataType: "JSON",
            success: function(response) {
                var brands;
                $.each(response, function(i, item) {
                    if (item.id == idBrand) {
                        brands +=
                            "<option value='" + item.id + "' selected >" + item.description + "</option>";
                    } else {
                        brands +=
                            "<option value='" + item.id + "' >" + item.description + "</option>";
                    }
                });
                $("#brand").html(brands);
            }
        });
        $.ajax({
            type: "POST",
            url: "/412020004_SANTIAGO/data/detailSpek.php",
            data: {
                req: 'allVal',
                id: idArtikel
            },
            dataType: "JSON",
            success: function(response) {
                $.each(response, function(i, item) {
                    $('input[name="id_spek"]').val(response.id);
                    $('input[name="id_status"]').val(response.status_id);
                    $('input[name="model"]').val(response.nama_model);
                    $('input[name="processor"]').val(decodeEntities(response.processor));
                    $('input[name="OS"]').val(response.OS);
                    $('input[name="RAM"]').val(response.RAM);
                    $('input[name="GPU"]').val(response.GPU);
                    $('input[name="layar"]').val(response.dimensi_layar);
                    $('input[name="berat"]').val(response.berat);
                    $('input[name="penyimpanan"]').val(response.penyimpanan);
                    $('input[name="harga"]').val(response.harga);
                    $("#image-src").html(response.gambar);
                    $(".preview-image").attr("src", response.gambar);

                });
                let status = response.status_id;
                if (control == <?php echo $role_id ?> && status == 1) {
                    $('.container-1').show();
                    $('.container-2').show();
                    $('.container-1').html("<a class ='btn btn-success btn-approve' id = 'btn-approve'>Approve</a>");
                    $('a.btn-approve').prop('href', "../functions/approve.php?id=" + response.id + "&page=spek");
                    $('.container-2').html("<a class ='btn btn-danger btn-reject' id = 'btn-reject'>Reject</a>");
                    $('a.btn-reject').prop('href', "../functions/reject.php?id=" + response.id + "&page=spek");
                    $("#editSpek input").prop("disabled", true);
                    $("#editSpek select").prop("disabled", true);
                    $("#editSpek textarea").prop("disabled", true);
                } else if (control == <?php echo $role_id ?> && (status == 2 || status == 3)) {
                    $('.container-1').hide();
                    $('.container-2').hide();
                    $("#editSpek input").prop("disabled", true);
                    $("#editSpek select").prop("disabled", true);
                    $("#editSpek textarea").prop("disabled", true);
                } else if (control != <?php echo $role_id ?> && (status == 1 || status == 3)) {
                    $('.container-1').show();
                    $('.container-1').html("<a class ='btn btn-success btn-edit'>Save Changes</a>");
                    $("#editSpek input").prop("disabled", false);
                    $("#editSpek select").prop("disabled", false);
                    $("#editSpek textarea").prop("disabled", false);
                } else if (control != <?php echo $role_id ?> && status == 2) {
                    $('.container-1').hide();
                    $("#editSpek input").prop("disabled", true);
                    $("#editSpek select").prop("disabled", true);
                    $("#editSpek textarea").prop("disabled", true);

                }
            }
        });
    });
    $(document).on('click', '.btn-edit', function(e) {
        e.preventDefault();
        var form = $('form')[1];
        var formData = new FormData(form);
        var frm = $('#editSpek');
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
                    url: "/412020004_SANTIAGO/data/editSpek.php",
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
                                document.location.href = "inboxSpek.php";
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
    $(document).on('click', '.btn-approve', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        Swal.fire({
            title: 'Approve?',
            text: "Anda tidak dapat memulihkan pilihan anda!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    })
    $(document).on('click', '.btn-reject', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        Swal.fire({
            title: 'Reject?',
            text: "Anda tidak dapat memulihkan pilihan anda!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    })
    var flashdata = $('.notif').data('flashdata')
    if (flashdata == 1) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Proses telah dieksekusi dengan baik'
        }).then(function() {
            $(document).ready(function() {

                var uri = window.location.toString();
                if (uri.indexOf("?") > 0) {
                    var clean_uri = uri.substring(0, uri.indexOf("?"));
                    window.history.replaceState({}, document.title, clean_uri);
                }
            });
        });
    } else if (flashdata == 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Proses tidak berjalan'
        }).then(function() {
            $(document).ready(function() {

                var uri = window.location.toString();
                if (uri.indexOf("?") > 0) {
                    var clean_uri = uri.substring(0, uri.indexOf("?"));
                    window.history.replaceState({}, document.title, clean_uri);
                }
            });
        });
    }
</script>

</html>