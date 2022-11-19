<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin - Products</title>

  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->

  <link href="../assets/css/dashboard.css" rel="stylesheet">
  <?php include("../style.php"); ?>

</head>

<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Rentcam</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav ml-auto">

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown mx-5">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">Rafedo</span>
          <img class="img-profile rounded-circle" src="../assets/img/">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profile
          </a>
          <a class="dropdown-item" href="#">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Settings
          </a>
          <a class="dropdown-item" href="#">
            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
            Activity Log
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>
        </div>
      </li>

    </ul>

  </nav>
  <!-- End nav-->
  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link " href="dashboard.php">
                <span data-feather="home"></span>
                Dashboard <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="Orders.php">
                <span data-feather="file"></span>
                Orders
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Products.php">
                <span data-feather="shopping-cart"></span>
                Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Customers.php">
                <span data-feather="users"></span>
                Customers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Reports.php">
                <span data-feather="bar-chart-2"></span>
                Reports
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="container-fluid">
          <div class="row p-5">
            <?php

            // --- koneksi ke database
            $koneksi = mysqli_connect("localhost", "root", "", "rentcam") or die(mysqli_error($koneksi));

            // --- Fngsi tambah data (Create)
            function tambah($koneksi)
            {

              if (isset($_POST['btn_simpan'])) {

                $nama_barang = $_POST['nama_barang'];
                $kategori = $_POST['kategori'];
                $merk = $_POST['merk'];
                $harga_barang = $_POST['harga_barang'];
                $stok = $_POST['stok'];

                if (!empty($nama_barang) && !empty($kategori) && !empty($merk) && !empty($harga_barang) && !empty($stok)) {
                  $sql = "INSERT INTO produk (nama_barang, kategori, merk, harga_barang,stok) VALUES('" . $nama_barang . "','" . $kategori . "','" . $merk . "'," . $harga_barang . ", " . $stok . ")";
                  $simpan = mysqli_query($koneksi, $sql);
                  if ($simpan && isset($_GET['aksi'])) {
                    if ($_GET['aksi'] == 'create') {
                      header('location: Products.php');
                    }
                  }
                } else {
                  $pesan = "Tidak dapat menyimpan, data belum lengkap!";
                }
              }
            ?>


              <div class="col-md">
                <div class="card">
                  <div class="card-body">
                    <h3>Tambah data</h3>
                    <form action="" method="POST">
                      <div class="form-group">
                        <label for="nama_barang">Nama Barang </label>
                        <input type="text" name="nama_barang" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="kategori">kategori</label>
                        <div class="input-group mb-3">
                          <input type="text" name="kategori" class="form-control">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="merk">kompatibel</label>
                        <div class="input-group mb-3">
                          <input type="text" name="merk" class="form-control">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="harga_barang">Harga Sewa</label>
                        <div class="input-group mb-3">
                          <input type="number" name="harga_barang" class="form-control">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="stok">Stok</label>
                        <div class="input-group mb-3">
                          <input type="number" name="stok" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <form action="upload.php" method="post" enctype="multipart/form-data">
                          <label for="img">Select image to upload:</label>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="submit" value="Upload Image" name="submit">
                          </form>
                        </div>
                      </div>


                      <div class="form-group">
                        <label>
                          <input type="submit" class="btn btn-success " name="btn_simpan" value="Simpan" />
                          <input type="reset" class="btn btn-warning" name="reset" value="Besihkan" />
                        </label>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          <div class="row p-5">
          <?php

            }
            // --- Tutup Fngsi tambah data


            // --- Fungsi Baca Data (Read)
            function tampil_data($koneksi)
            {
              $sql = "SELECT * FROM produk";
              $query = mysqli_query($koneksi, $sql);

          ?>
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <legend>
                    <h2>Data Stok Produk</h2>
                  </legend>
                  <table class="table table-hover" cellpadding='10'>
                    <?php
                    echo '	<thead>
									<tr>
									<th>Nama </th>
									<th>Alamat</th>
									<th>kompatibel</th>
                  <th>Harga Barang</th>
									<th>Peminjaman</th>
									<th>Tindakan</th>
									</tr>
								<thead>';

                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                      <tbody>
                        <tr>
                          <td><?php echo $data['nama_barang']; ?></td>
                          <td><?php echo $data['kategori']; ?></td>
                          <td><?php echo $data['merk']; ?></td>
                          <td><?php echo $data['harga_barang']; ?></td>
                          <td><?php echo $data['stok']; ?></td>
                          <td>null</td>
                          <td>
                            <a class="btn btn-success" href="Products.php?aksi=update&id=<?php echo $data['id']; ?>&nama_barang=<?php echo $data['nama_barang']; ?>&kategori=<?php echo $data['kategori']; ?>&merk=<?php echo $data['merk']; ?>&harga_barang=<?php echo $data['harga_barang']; ?>&stok=<?php echo $data['stok']; ?>">Ubah</a> |
                            <a class="btn btn-danger" href="Products.php?aksi=delete&id=<?php echo $data['id']; ?>">Hapus</a>
                          </td>
                        </tr>
                      </tbody>
                    <?php
                    }
                    ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row p-5">
            <?php
            }
            // --- Tutup Fungsi Baca Data (Read)


            // --- Fungsi Ubah Data (Update)
            function ubah($koneksi)
            {

              // ubah data
              if (isset($_POST['btn_ubah'])) {
                $id = $_GET['id'];
                $nama_barang = $_POST['nama_barang'];
                $kategori = $_POST['kategori'];
                $merk = $_POST['merk'];
                $harga_barang = $_POST['harga_barang'];
                $stok = $_POST['stok'];

                if (!empty($nama_barang) && !empty($Lname) && !empty($kategori) && !empty($merk) && !empty($harga_barang)) {
                  $perubahan = "nama_barang='" . $nama_barang . "', kategori=" . $kategori . ",merk=" . $merk . ", harga_barang=" . $harga_barang . ", stok=" . $stok . "";
                  $sql_update = "UPDATE produk SET nama_barang='" . $nama_barang . "', kategori='" . $kategori . "', merk='" . $merk . "', harga_barang='" . $harga_barang . "', stok='" . $stok . "' WHERE id=$id";
                  $update = mysqli_query($koneksi, $sql_update);
                  if ($update && isset($_GET['aksi'])) {
                    if ($_GET['aksi'] == 'update') {
                      header('location: Products.php');
                    }
                  }
                } else {
                  $pesan = "Data tidak lengkap!";
                }
              }

              // tampilkan form ubah
              if (isset($_GET['id'])) {
            ?>
              <div class="col">
                <div class="card">
                  <div class="card-body">
                    <a href="Products.php" class="btn btn-outline-primary">&laquo; Back</a>
                    <hr>
                    <form action="" method="POST">
                      <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input class="form-control" type="text" name="nama_barang" value="<?php echo $_GET['nama_barang'] ?>" />
                      </div>

                      <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <div class="input-group mb-3">
                          <input type="text" name="kategori" class="form-control" value="<?php echo $_GET['kategori'] ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="merk">kompatibel</label>
                        <div class="input-group mb-3">
                          <input type="text" name="merk" class="form-control" value="<?php echo $_GET['merk'] ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="harga_barang">harga_barang</label>
                        <div class="input-group mb-3">
                          <input type="number" name="harga_barang" class="form-control" value="<?php echo $_GET['harga_barang'] ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="stok">stok</label>
                        <div class="input-group mb-3">
                          <input type="number" name="stok" class="form-control" value="<?php echo $_GET['stok'] ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label>
                          <input type="submit" class="btn btn-success " name="btn_ubah" value="Simpan Perubahan" />
                          <a class="btn btn-danger" href="Products.php?aksi=delete&id=<?php echo $_GET['id']; ?>">Hapus</a>
                        </label>
                      </div>

                      <p><?php echo isset($pesan) ? $pesan : "" ?></p>

                    </form>
                  </div>
                </div>
              </div>
          <?php
              }
            }
            // --- Tutup Fungsi Update


            // --- Fungsi Delete
            function hapus($koneksi)
            {
              if (isset($_GET['id']) && isset($_GET['aksi'])) {
                $id = $_GET['id'];
                $sql_hapus = "DELETE FROM produk WHERE id=" . $id;
                $hapus = mysqli_query($koneksi, $sql_hapus);

                if ($hapus) {
                  if ($_GET['aksi'] == 'delete') {
                    header('location: Products.php');
                  }
                }
              }
            }
            // --- Tutup Fungsi Hapus


            // ===================================================================

            // --- Program Utama
            if (isset($_GET['aksi'])) {
              switch ($_GET['aksi']) {
                case "create":
                  echo '<a href="Products.php"> &laquo; Home</a>';
                  tambah($koneksi);
                  break;
                case "read":
                  tampil_data($koneksi);
                  break;
                case "update":
                  ubah($koneksi);
                  tampil_data($koneksi);
                  break;
                case "delete":
                  hapus($koneksi);
                  break;
                default:
                  echo "<h3>Aksi <i>" . $_GET['aksi'] . "</i> tidaka ada!</h3>";
                  tambah($koneksi);
                  tampil_data($koneksi);
              }
            } else {
              tampil_data($koneksi);
              tambah($koneksi);
            }

          ?>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="../../assets/js/vendor/popper.min.js"></script>
  <script src="../../dist/js/bootstrap.min.js"></script>

  <!-- Icons -->
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace()
  </script>

  <!-- Graphs -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.1/dist/Chart.min.js"></script>
  <script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        datasets: [{
          data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
          lineTension: 0,
          backgroundColor: 'transparent',
          borderColor: '#007bff',
          borderWidth: 4,
          pointBackgroundColor: '#007bff'
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: false
            }
          }]
        },
        legend: {
          display: false,
        }
      }
    });
  </script>
</body>

</html>