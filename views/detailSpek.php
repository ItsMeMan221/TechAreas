<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spesifikasi</title>
    <?php
    include '../framework/jquery.php';
    include '../framework/sweetalert2.php';
    ?>
    <script src="../functions/paramUrl.js"></script>
    <link rel="stylesheet" href="../css/detailSpek.css">
    <script src="../functions/htmlEntities.js"></script>
</head>

<body>
    <?php
    if ($_SESSION['auth'] == true) {
        include '../components/navbar.php';
    ?>
        <section>
            <div class="Spek container mt-5">
                <h4 class="ma-nav ms-4">Spesifikasi Singkat Gadget</h4>
                <div class="col-md-3 col-sm-3 col-xs-3 col-9 mb-4">
                    <hr class="hr-spek ms-4">
                </div>
                <div class="row ">
                    <div class="col-12 col-md-3 d-flex justify-content-start ">
                        <img src="" class="img-fluid mb-3">
                    </div>
                    <div class="col-12 col-md-9 spek-container py-3 ">
                        <h3 class="namaModel"></h3>
                        <h5 class="tipeDevice"></h5>
                        <h4 class="brand"></h4>
                        <i class='fa-solid fa-memory mb-3 '>
                        </i>
                        <h5 class="RAM in-h"></h5>
                        <br>
                        <i class="fa-solid fa-microchip mb-3 "></i>
                        <h5 class="processor in-h"></h5>
                        <br>
                        <i class="bi bi-gpu-card mb-3"></i>
                        <h5 class="GPU in-h mb-3 "></h5>
                        <br>
                        <i class="fa-solid fa-mobile-screen mt-3 fa-change"></i>
                        <h5 class="dimensi in-h"></h5>
                        <br>
                        <i class="fa-solid fa-weight-hanging mt-3"></i>
                        <h5 class="berat in-h"></h5>
                        <br>
                        <i class="fa-solid fa-money-bill-wave mt-3"></i>
                        <h5 class="harga in-h"></h5>
                        <br>
                        <h5 class="OS mt-3 mb-3"></h5>
                        <i class="fa-solid fa-user"></i>
                        <h5 class="ditulis in-h text-m"></h5>
                        <br>
                        <i class="fa-solid fa-calendar-day mt-3"></i>
                        <h5 class="tanggal in-h text-m"></h5>
                    </div>
                </div>
                <div class="Other mt-5">
                    <h4 class="ma-nav ms-4">Gadget Lainnya</h4>
                    <div class="col-md-3 col-sm-3 col-xs-3 col-9 mb-4">
                        <hr class="hr-spek ms-4">
                    </div>
                    <div class="row row-cols-1 row-cols-md-4 g-1 others">
                    </div>
                </div>
            </div>
        </section>
        <?php include '../components/footer.php' ?>
    <?php } else {
        header('location:../index.php');
    } ?>
</body>
<script>
    var id = getUrlParameter('id');
    var segmen_id = getUrlParameter('idSegmen');
    $(document).ready(function() {
        getDetailSpek();
        getOther();
    })

    function getDetailSpek() {
        $.ajax({
            type: "POST",
            url: "/412020004_SANTIAGO/userData/detail.php",
            data: {
                req: 'dataSpek',
                id: id
            },
            dataType: "JSON",
            success: function(response) {
                $.each(response, function(i, item) {
                    $('.namaModel').text("Nama Model: " +
                        item.nama_model);
                    $('.img-fluid').attr("src", item.gambar);
                    $('.brand').text("Brand: " + item.nama_brand)
                    $('.tipeDevice').text("Tipe: " + item.tipe_gadget)
                    $('.RAM').text(item.RAM + " GB RAM")
                    $('.processor').text(decodeEntities(item.processor))
                    $('.GPU').text(item.GPU)
                    $('.OS').text("Sistem Operasi:  " + item.OS)
                    if (segmen_id == 2) {
                        $(".fa-change").attr("class", "fa-solid fa-display mt-3");
                        $(".dimensi").text(item.dimensi_layar);
                    }
                    $(".dimensi").text(item.dimensi_layar);
                    $(".berat").text(item.berat + " gram");
                    $(".harga").text(item.harga);
                    $(".ditulis").text("Ditulis Oleh : " + item.nama);
                    $(".tanggal").text("Dirilis tanggal : " + item.dibuat_tanggal);
                });
            }
        })
    }

    function getOther() {
        var other = "";
        $.ajax({
            type: "POST",
            url: "/412020004_SANTIAGO/userData/detail.php",
            data: {
                req: 'dataLainnya',
                id: id
            },
            dataType: "JSON",
            success: function(response) {
                $.each(response, function(i, item) {
                    other += "<div class='col '><a class = 'un-a' href = 'detailSpek.php?id=" + item.id + "&idSegmen=" + item.segmentasi_id + "'><div class='card  hvr-ripple-out h-100 card-bc'><img src='" + item.gambar + "' class='card-img-top h-spek'><div class='card-body'><h5 class='card-title'>" + item.nama_model + "</h5></div></div></a></div>";
                });
                $('.others').html(other);
            }
        });
    }
</script>

</html>