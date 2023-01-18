<?php
include 'db.php';

if(isset($_GET['idk'])){
$id = $_GET['idk'];
mysqli_query($conn, "delete from tb_category where category_id='$id'");

header("location:data_kategori.php");
}
if(isset($_GET['idp'])){
    $idp = $_GET['idp'];
    $produk = mysqli_query($conn, "SELECT product_image FROM tb_product WHERE product_id = '$idp'");
    $p = mysqli_fetch_object($produk);

    unlink('./produk/'. $p->product_image);
    
    mysqli_query($conn, "DELETE FROM tb_product WHERE product_id='$idp'");


    header("location:data_produk.php");
    }
?>