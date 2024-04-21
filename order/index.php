<?php

require "../db.php";

session_start();
if (!isset($_SESSION['user'])) {
  echo "<script>alert('Mohon login terlebih dahulu')
  location.replace('../login.php')</script>";
}

$orders = $conn->query("SELECT * FROM orders");
if(isset($_POST['simpan'])) {
    $kasir = $_POST['kasir'];
    $product = $_POST['product'];
    $customer_name = $_POST['customer_name'];
    $order_date = $_POST['order_date'];
    $total = $_POST['total'];
    $total_payment = $_POST['total_payment'];
    $change = $_POST['total_payment'] - $_POST['total'];

    $simpan = $conn->query("INSERT INTO orders VALUES(NULLx, '$kasir', '$product', '$customer_name','$order_date','$total','$total_payment','$change')");
    if ($simpan) {
        echo '<script>alert("Data Berhasil Ditambahkan");
        location.replace("index.php");</script>';
    } else {
        echo '<script>alert("Data Gagal Ditambah");
        location.replace("index.php");</script>';
    }
}
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete = $conn->query("DELETE FROM orders WHERE id_order = '$id'");
    if ($delete) {
      echo '<script>alert("Data Telah Dihapus");
      location.replace("index.php");</script>';
    }
  }

$view_users = $conn->query("SELECT * FROM users");
$view_products = $conn->query("SELECT * FROM products");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Transaksi | E-Travel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>


<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="../">KASIR</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin">User</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../tiket">Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Order</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow mb-3">
                    <div class="card-header bg-dark">
                        <h3 class="mb-0 text-white">Data Transaksi </h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-grup mb-3">
                                        <label for="">Kasir</label>
                                        <select class="form-select" name="kasir" id="user">
                                            <?php
                                            foreach ($view_users as $show) { ?>
                                                <option value="<?= $show['id_user'] ?>"><?= $show['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label for="">Product</label>
                                        <select class="form-select" name="product" id="user">
                                            <?php
                                            foreach ($view_products as $show) { ?>
                                                <option value="<?= $show['id_product'] ?>"><?= $show['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Nama Customer</label>
                                        <input type="text" required name="customer_name" class="form-control">
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Tanggal</label>
                                        <input type="date" required name="order_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-grup mb-3">
                                        <label class="form-label" for="">Total</label>
                                        <input type="number" required name="total" class="form-control">
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Payment</label>
                                        <input type="number" required name="total_payment" class="form-control">
                                    </div>
                            
                                </div>
                                <div class="form-group text-end">
                                    <button type="submit" name="simpan" class="btn btn-success btn-lg w-100 mt-4"><i class="bi bi-plus"></i> Tambah</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-body">
                    <table class=" table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kasir</th>
                                <th>Product</th>
                                <th>Customer</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Change</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($orders as $order) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $order['id_user'] ?></td>
                                    <td><?= $order['id_product'] ?></td>
                                    <td><?= $order['customer_name'] ?></td>
                                    <td><?= $order['tanggal'] ?></td>
                                    <td><?= $order['total'] ?></td>
                                    <td><?= $order['total_payment'] ?></td>
                                    <td><?= $order['change'] ?></td>
                                    <td class="text-center">
                                        <a href="edit.php?id=<?= $trnx['id_order'] ?>" class="btn btn-warning text-white btn-sm">Edit <i class="bi bi-pencil-fill"></i></a>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?= $trnx['id_order'] ?>">
                                            <button type="submit" name="delete" class="btn btn-danger text-white btn-sm">Delete <i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>