<?php

require '../db.php';

session_start();
if(!isset($_SESSION['admin'])){
  echo "<script>alert('Mohon login terlebih dahulu')
  location.replace('../login.php')</script>";
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $products = $conn->query("SELECT * FROM products WHERE id_product = $id")->fetch_assoc();
}


if(isset($_POST['update'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

  $simpan = mysqli_query($conn, "UPDATE products SET name ='$name',price = '$price',stock = '$stock',image =  '$image' WHERE id_product = '$id'");

  if($simpan) {
    echo '<script>alert("Datanya Berhasil Diperbarui");
    location.replace("index.php");</script>';
  }else{
    echo '<script>alert("Data Gagal Diperbarui");
    location.replace("index.php");</script>';
  }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tiket | Pemesanan Tiket</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow mb-3">
                    <div class="card-header bg-dark">
                        <h3 class="mb-0 text-white">Edit Tiket</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="form-grup mb-3">
                                    <label for="">Name</label>
                                    <input type="text" required name="name" class="form-control" value="<?= $products['name'] ?>">
                                </div>
                                <div class="form-grup mb-3">
                                    <label for="">Price</label>
                                    <input type="text" required name="price" class="form-control" value="<?= $products['price'] ?>">
                                </div>
                                <div class="form-grup mb-3">
                                    <label for="">Stock</label>
                                    <input type="text" required name="stock" class="form-control" value="<?= $products['stock'] ?>">
                                </div>
                                <div class="form-grup mb-3">
                                    <label for="">Image</label>
                                    <input type="file" required name="image" class="form-control" value="<?= $products['image'] ?>">
                                </div>
                            </div>
                            <div class="form-group text-end">
                                <button type="submit" name="update" class="btn btn-success btn-lg w-100 mt-4">Perbarui <i class="bi bi-arrow-clockwise"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>