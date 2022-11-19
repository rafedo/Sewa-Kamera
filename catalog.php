<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rentcam</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require_once('style.php');
    require_once('core/controller.Class.php');
    ?> 
</head>

<body>
    <?php require_once('header.php'); ?>
    <!-- Modal -->
    <div class="modal fade bg-white" id="search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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



    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md">
                <div class="row">
                    <?php
                    $db = new Connect; 
                    $merk = (isset($_GET['merk'])) ? $_GET['merk'] : "";
                    $kategori = (isset($_GET['kategori'])) ? $_GET['kategori'] : "";
                    //bata paging 
                    $query = "SELECT * FROM produk WHERE merk LIKE :merk AND kategori LIKE :kategori ";
                    $stmt = $db->prepare($query);
                    $params = array(
                        ":merk" => "%" . $merk . "%",
                        ":kategori" => "%" . $kategori . "%",
                    );
                    $test = $stmt->execute($params);
                    $no = 1;

                    //proses menampilkan data
                    while ($result  = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div class="col-md-4">
                            <div class="card mb-4 product-wap rounded-5">
                                <div class="card rounded-5">
                                    <img class="card-img rounded-0 img-fluid" src="assets/img/<?php echo $result['foto_barang']; ?>">
                                    <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                        <ul class="list-unstyled">
                                            <li><a class="btn btn-primary text-white mt-2" href="rent-single.php?id=<?php echo $result['id'];?>&kategori=<?php echo $result['kategori'];?>"><i class="fa far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <a href="" class="h3 text-decoration-none"><?php echo $result['nama_barang']; ?></a>
                                    <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                        <li>For <?php echo $result['merk']; ?></li>
                                    </ul>
                                    <p class="text-center mb-0 mt-2">Rp <?php echo $result['harga_barang']; ?></p>
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
    <!-- End Content -->

    



    <?php require_once("footer.php") ?>
    <?php require_once("scripts.php") ?>



</body>
</body>

</html>