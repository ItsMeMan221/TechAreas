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
        <h1 class="text-center text-white mt-3">List of Admin in TechAreas</h1>
        <div class="table-responsive container">
            <table class="table table-dark table-striped mt-5 text-center ">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Tanggal Lahir</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <?php
        if (isset($_GET['s'])) {
        ?>
            <div class="notif" data-flashdata="<?= $_GET['s'] ?>"> </div>
        <?php
        }
        ?>
        <?php
        if (isset($_GET['m'])) {
        ?>
            <div class="notif-promote" data-flashdata="<?= $_GET['m'] ?>"> </div>
        <?php
        }
        ?>
    <?php } else {
        header('location:loginAdmin.php');
    } ?>
    <script>
        $(this).ready(function() {
            $.ajax({
                type: "POST",
                url: "/412020004_SANTIAGO/data/dataAdmin.php",
                data: {
                    req: 'dataAdmin',
                },
                dataType: "JSON",
                success: function(response) {
                    var items;
                    var count = 1;
                    $.each(response, function(i, item) {
                        items += "<tr><td>" +
                            count +
                            "</td><td>" +
                            item.nama +
                            "</td><td>" +
                            item.tanggal_lahir +
                            "</td><td>" +
                            item.descr_gender +
                            "</td><td>" +
                            item.username +
                            "</td><td>" +
                            item.email +
                            "</td><td>" +
                            item.descr_role +
                            "</td>"
                        count++
                        if (item.role_id == 1) {
                            items += "<td>" +
                                "<a href='promoteAdmin.php?id=" + item.id + "'" + "class='btn btn-success btn-prom'>Promote <i class='bi bi-arrow-up-circle-fill'></i></a> " +
                                "<a href='deleteAdmin.php?id=" + item.id + "'" + "class='btn btn-danger btn-del' id='btn-del'>Delete <i class='bi bi-trash3-fill '></i></a> " +
                                "</td></tr>";
                        } else {
                            items += "<td class ='text-center'>None</td></tr>"
                        }
                    });
                    $("tbody").html(items);
                    $('.btn-prom').on('click', function(e) {
                        e.preventDefault();
                        var href = $(this).attr('href');
                        Swal.fire({
                            title: 'Promote?',
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
                    $('.btn-del').on('click', function(e) {
                        e.preventDefault();
                        var href = $(this).attr('href');
                        Swal.fire({
                            title: 'Delete?',
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
                    var flashdata = $('.notif-promote').data('flashdata')
                    if (flashdata == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Admin telah menjadi Super Admin',
                            text: 'Admin telah berhasil menjadi Super Admin'
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
                            text: 'Ada error saat ingin mengupdate data'
                        })
                    }
                    var flashdata = $('.notif').data('flashdata')
                    if (flashdata == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Admin Dihapus',
                            text: 'Admin telah terhapus'
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
                            text: 'Ada error saat ingin menghapus admin'
                        })
                    }
                }
            });
        })
    </script>
</body>

</html>