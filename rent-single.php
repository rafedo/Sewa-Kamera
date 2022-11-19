<!DOCTYPE html>
<html lang="en">

<head>
    <title>rentcam</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include("style.php");
    require_once('core/controller.Class.php');
    $db = new Connect;
    $id = $_GET['id'];
    //bata paging 
    $query = "SELECT * FROM produk WHERE id = :id";
    $stmt = $db->prepare($query);
    $params = array(
        ":id" =>  $id,
    );
    $test = $stmt->execute($params);
    $result  = $stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['rent'])) {

        // filter data yang diinputkan
        $id_user =  $_POST['id_user'];
        $id_barang = $_POST['id_barang'];
        $awal = new DateTime($_POST['tanggal_peminjaman']);
        $akhir = new DateTime($_POST['tanggal_pengembalian']);
        $jarak = $akhir->diff($awal);
        $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
        $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
        $jumlah_hari = $jarak->d;
        $total_harga = $jumlah_hari * $result['harga_barang'];

        $status = 1;

        // menyiapkan query
        $sql = "INSERT INTO peminjaman (id_user, id_barang, tanggal_peminjaman, tanggal_pengembalian, jumlah_hari, total_harga, status) 
            VALUES (:id_user, :id_barang, :tanggal_peminjaman, :tanggal_pengembalian, :jumlah_hari, :total_harga, :status)";
        $stmt = $db->prepare($sql);

        // bind parameter ke query
        $params = array(
            ":id_user" => $id_user,
            ":id_barang" => $id_barang,
            ":tanggal_peminjaman" => $tanggal_peminjaman,
            ":tanggal_pengembalian" => $tanggal_pengembalian,
            ":jumlah_hari" => $jumlah_hari,
            ":total_harga" => $total_harga,
            ":status" => $status

        );

        // eksekusi query untuk menyimpan ke databas
        //code...
        $saved = $stmt->execute($params);
        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if ($saved) header("Location: Catalog.php");
    }

    ?>
</head>

<body>
    <!-- Start Top Nav -->
    <?php include("header.php");
    require_once('auth.php'); ?>
    <!-- Close Top Nav -->



    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>



    <!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
            <?php if (isset($_SESSION['user'])) :
                $userInfo = $_SESSION['user'];
            else :
               
                $user = $db->prepare("SELECT * FROM users WHERE id=:id AND session=:session");
                $user->execute([
                    ':id'       => intval($_COOKIE['id']),
                    ':session'  => $_COOKIE['sess']
                ]);
                $userInfo = $user->fetch(PDO::FETCH_ASSOC);
            endif; ?>
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="assets/img/<?php echo $result['foto_barang']; ?>" alt="Card image cap" id="product-detail">
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2"><?php echo $result['nama_barang']; ?></h1>
                            <p class="h3 py-2">Rp <?php echo $result['harga_barang']; ?></p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>kompatibel untuk</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong><?php echo $result['merk']; ?></strong></p>
                                </li>
                            </ul>

                            <h6>Description:</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse. Donec condimentum elementum convallis. Nunc sed orci a diam ultrices aliquet interdum quis nulla.</p>
                            <form action="" method="POST">
                                <input type="hidden" name="id_user" value="<?php echo $userInfo['id'] ?>">
                                <input type="hidden" name="id_barang" value="<?php echo $result['id']; ?>">
                                <div class="row">
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list date m-1 pb-1">
                                                Tanggal Pengambilan :
                                                <input class="form-control" type="date" name="tanggal_peminjaman">
                                            </li>
                                            <li class="list date m-1 pt-1">
                                                Tanggal Pengembalian :
                                                <input class="form-control" type="date" name="tanggal_pengembalian">
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col ">
                                        <button type="submit" class="btn btn-success btn-lg" name="rent" value="rent">Sewa sekarang </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->

    <!-- Start Article -->
    <section class="py-5">
        <div class="container">
            <div class="row text-left p-2 pb-3">
                <h4>Related Products</h4>
            </div>

            <!--Start Carousel Wrapper-->
            <div id="carousel-related-product">
                <div class="row">
                    <?php
                    $kategori = (isset($_GET['kategori'])) ? $_GET['kategori'] : "";
                    //bata paging 
                    $query = "SELECT * FROM produk WHERE kategori LIKE :kategori ";
                    $stmt = $db->prepare($query);
                    $params = array(
                        ":kategori" => "%" . $kategori . "%",
                    );
                    $test = $stmt->execute($params);
                    $no = 1;

                    //proses menampilkan data
                    while ($data  = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div class="col-md-4">
                            <div class="card mb-4 product-wap rounded-5">
                                <div class="card rounded-5">
                                    <img class="card-img rounded-0 img-fluid" src="assets/img/<?php echo $data['foto_barang']; ?>">
                                    <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                        <ul class="list-unstyled">
                                            <li><a class="btn btn-primary text-white mt-2" href="rent-single.php?id=<?php echo $data['id']; ?>"><i class="fa far fa-eye"></i></a></li>
                                            <li><a class="btn btn-primary text-white mt-2" href="rent-single.php?id=<?php echo $data['id']; ?>"><i class="fa fa-cart-plus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <a href="" class="h3 text-decoration-none"><?php echo $data['nama_barang']; ?></a>
                                    <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                        <li>For <?php echo $data['merk']; ?></li>
                                    </ul>
                                    <p class="text-center mb-0 mt-2">Rp <?php echo $data['harga_barang']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                        $no++;
                    } ?>
                </div>
            </div>

        </div>


        </div>
    </section>
    <!-- End Article -->


    <?php include("footer.php");
    include("script.php"); ?>

</body>

</html>