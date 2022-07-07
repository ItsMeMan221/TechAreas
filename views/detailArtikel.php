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
    include '../framework/sweetalert2.php';
    ?>
    <link rel="stylesheet" href="../css/detailArtikel.css">
</head>

<body>
    <?php
    if ($_SESSION['auth'] == true) {
        include '../components/navbar.php';
    ?>
        <section class="Artikel container">
            <h1 class="judul text-center mt-3"></h1>
            <div class="d-flex justify-content-center  mt-5">
                <img src="" class="img-fluid mb-3">
            </div>
            <div class="row">
                <div class="col-md-1 col-0 col-sm-0"></div>
                <div class="col-md-10 col-12 col-sm-12 col-xs-12 d-flex justify-content-center ">
                    <p class="container-isi  ms-5m me-5m mt-2 bc-isi" style="white-space: pre-wrap ;"></p>
                </div>
            </div>
        </section>
        <section class="artikel-terkait container me-5">
            <div class="row container">
                <div class="col-md-4">
                    <h5 class="ma-nav mt-5 ms-4 text-white text-center">Artikel Terkait</h4>
                        <div class="col-md-9 col-sm-9 col-xs-9 col-9 ms-5">
                            <hr class="hr-berita ms-4 text-center">
                        </div>
                        <div id="Terkait">
                        </div>

                </div>
                <div class="col-md-4 me-2">
                    <h5 class="ma-nav mt-5 ms-4 text-white text-center">Baca Juga</h4>
                        <div class="col-md-9 col-sm-9 col-xs-9 col-9 ms-5">
                            <hr class="hr-berita ms-4">
                        </div>
                        <div id='bacaJuga'>

                        </div>
                </div>
            </div>
        </section>
        <?php include '../components/footer.php' ?>
    <?php } else {
        header('location:../index.php');
    } ?>
</body>
<script src="../functions/paramUrl.js"></script>
<script>
    var id = getUrlParameter('id');
    var segmen_id = getUrlParameter('segmen_id');
    $(document).ready(function() {
        getDetailArtikel();
        getTerkait();
        getBacaJuga();
    })

    function getDetailArtikel() {
        $.ajax({
            type: "POST",
            url: "../userData/detail.php",
            data: {
                req: 'dataArtikel',
                id: id
            },
            dataType: "JSON",
            success: function(response) {
                $.each(response, function(i, item) {
                    $('.judul').text(item.judul);
                    $('.img-fluid').attr("src", item.gambar);
                    $('.container-isi').text(item.isi);
                    $('.container-isi').append("<br><br><span id='author' class = 'text-m'></span>")
                    $('.container-isi').append("<br><span id='rilis' class = 'text-m'></span>")
                    $('#author').text("Author : " + item.nama)
                    $('#rilis').text("Dirilis pada : " + item.tanggal_dibuat)
                });
            }
        })
    }

    function getTerkait() {
        itemTerkait = "";
        $.ajax({
            type: "POST",
            url: "../userData/detail.php",
            data: {
                req: 'dataTerkait',
                id: id,
                id_segmen: segmen_id
            },
            dataType: "JSON",
            success: function(response) {
                $.each(response, function(i, item) {
                    itemTerkait += "<hr class = 'rekomendasi'><a class= 'un-a hvr-underline-from-left' href = 'detailArtikel.php?id=" + item.id + "&segmen_id=" + item.segmentasi_id + "'><p class = 'ms-4 text-white'>" + item.judul + "</p></a> <hr class = 'rekomendasi'>"
                });
                $('#Terkait').html(itemTerkait);
            }
        })
    }

    function getBacaJuga() {
        itemBaca = "";
        $.ajax({
            type: "POST",
            url: "../userData/detail.php",
            data: {
                req: 'dataBacaJuga',
                id: id,
                id_segmen: segmen_id
            },
            dataType: "JSON",
            success: function(response) {
                $.each(response, function(i, item) {
                    itemBaca += "<hr class = 'rekomendasi'><a class= 'un-a hvr-underline-from-left' href = 'detailArtikel.php?id=" + item.id + "&segmen_id=" + item.segmentasi_id + "'><p class = 'ms-4 text-white'>" + item.judul + "</p></a> <hr class = 'rekomendasi'>"
                });
                $('#bacaJuga').html(itemBaca);
            }
        })
    }
</script>

</html>