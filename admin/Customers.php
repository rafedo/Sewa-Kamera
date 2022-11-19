<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin - Customers</title>

  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->

  <link href="../assets/css/dashboard.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css" />


  <?php include("../style.php"); ?>

</head>

<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Rentcam</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav ml-auto">

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown mx-5">
        <a class="nav-link dropdown-toggle " href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="">Rafedo</span>
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
  <!-- E-->

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
                $id = time();
                $Fname = $_POST['Fname'];
                $Lname = $_POST['Lname'];
                $address = $_POST['address'];
                $telp = $_POST['telp'];
                $email = $_POST['email'];

                if (!empty($Fname) && !empty($Lname) && !empty($address) && !empty($telp) && !empty($email)) {
                  $sql = "INSERT INTO users (id, Fname, Lname, address, telp, email) VALUES(" . $id . ",'" . $Fname . "','" . $address . "','" . $telp . "','" . $email . "')";
                  $simpan = mysqli_query($koneksi, $sql);
                  if ($simpan && isset($_GET['aksi'])) {
                    if ($_GET['aksi'] == 'create') {
                      header('location: Customers.php');
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
                        <label for="Fname">Nama Depan </label>
                        <input class="form-control" type="text" name="Fname" />
                      </div>

                      <div class="form-group">
                        <label for="Lname">Nama Belakang </label>
                        <input class="form-control" type="text" name="Lname" />
                      </div>

                      <div class="form-group">
                        <label for="address">address</label>
                        <div class="input-group mb-3">
                          <input type="text" name="address" class="form-control">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="telp">telp</label>
                        <div class="input-group mb-3">
                          <input type="text" name="telp" class="form-control">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="email">email</label>
                        <div class="input-group mb-3">
                          <input type="email" name="email" class="form-control">
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
              $sql = "SELECT * FROM users";
              $query = mysqli_query($koneksi, $sql);

          ?>
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <legend>
                    <h2>Data Customer</h2>
                  </legend>
                  <table class="table table-hover" cellpadding='10'>
                    <?php
                    echo '	<thead>
									<tr>
									<th>Nama </th>
									<th>Alamat</th>
									<th>No Telp</th>
                  <th>Email</th>
									<th>Peminjaman</th>
									<th>Tindakan</th>
									</tr>
								<thead>';

                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                      <tbody>
                        <tr>
                          <td><?php echo $data['Fname']; ?> <?php echo $data['Lname']; ?></td>
                          <td><?php echo $data['address']; ?></td>
                          <td><?php echo $data['telp']; ?></td>
                          <td><?php echo $data['email']; ?></td>
                          <td>null</td>
                          <td>
                            <a class="btn btn-success" href="Customers.php?aksi=update&id=<?php echo $data['id']; ?>&Fnama=<?php echo $data['Fname']; ?>&Lnama=<?php echo $data['Lname']; ?>&address=<?php echo $data['address']; ?>&telp=<?php echo $data['telp']; ?>&email=<?php echo $data['email']; ?>">Ubah</a> |
                            <a class="btn btn-danger" href="Customers.php?aksi=delete&id=<?php echo $data['id']; ?>">Hapus</a>
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
                $id = $_POST['id'];
                $Fname = $_POST['Fname'];
                $Lname = $_POST['Lname'];
                $address = $_POST['address'];
                $telp = $_POST['telp'];
                $email = $_POST['email'];

                if (!empty($Fname) && !empty($Lname) && !empty($address) && !empty($telp) && !empty($email)) {
                  $perubahan = "Fname='" . $Fname . "', Lname='" . $Lname . "',address=" . $address . ",telp=" . $telp . ",email=" . $email . "";
                  $sql_update = "UPDATE users SET Fname='" . $Fname . "', Lname='" . $Lname . "', address='" . $address . "', telp='" . $telp . "', email='" . $email . "' WHERE id=$id";
                  $update = mysqli_query($koneksi, $sql_update);
                  if ($update && isset($_GET['aksi'])) 
                  {
                    if ($_GET['aksi'] == 'update') {
                      header('location: Customers.php');
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
                    <a href="Customers.php" class="btn btn-outline-primary">&laquo; Back</a>
                    <hr>
                    <form action="" method="POST">
                      <div class="form-group">
                        <input class="form-control" type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
                      </div>
                      <div class="form-group">
                        <label for="Fname">Nama Depan</label>
                        <input class="form-control" type="text" name="Fname" value="<?php echo $_GET['Fnama'] ?>" />
                      </div>
                      <div class="form-group">
                        <label for="Lname">Nama Belakang</label>
                        <input class="form-control" type="text" name="Lname" value="<?php echo $_GET['Lnama'] ?>" />
                      </div>

                      <div class="form-group">
                        <label for="address">Alamat</label>
                        <div class="input-group mb-3">
                          <input type="text" name="address" class="form-control" value="<?php echo $_GET['address'] ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="telp">No Telp</label>
                        <div class="input-group mb-3">
                          <input type="text" name="telp" class="form-control" value="<?php echo $_GET['telp'] ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-group mb-3">
                          <input type="email" name="email" class="form-control" value="<?php echo $_GET['email'] ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label>
                          <input type="submit" class="btn btn-success " name="btn_ubah" value="Simpan Perubahan" />
                          <a class="btn btn-danger" href="Customers.php?aksi=delete&id=<?php echo $_GET['id']; ?>">Hapus</a>
                        </label>
                      </div>

                      <p><?php echo isset($pesan) ? $pesan : "" ?></p>

                    </form>
                  </div>
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
                $sql_hapus = "DELETE FROM users WHERE id=" . $id;
                $hapus = mysqli_query($koneksi, $sql_hapus);

                if ($hapus) {
                  if ($_GET['aksi'] == 'delete') {
                    header('location: Customers.php');
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
                  echo '<a href="Customers.php"> &laquo; Home</a>';
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

  <!-- Bootstrap core JavaScript-->
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
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