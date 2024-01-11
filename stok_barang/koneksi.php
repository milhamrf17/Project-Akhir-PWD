<?php
session_start();
//membuat koneksi ke database
$dbhost='localhost';
$dbuser='root';
$dbpass="";
$dbname='stockbarang';
$koneksi = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//tambah barang masuk
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['$namabarang'];
    $deskripsi = $_POST['$deskripsi'];
    $stock = $_POST['$stock'];

    $addtotable = mysqli_query($koneksi, "insert into stock (namabarang, deskripsi, stock) values('$namabarang','$deskripsi','$stock')");
    if($addtotable){
        header('location: index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};

//menambah barang baru
if(isset($_POST['barangmasuk'])){
    $barang = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($koneksi,"select* from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $cekstocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $cekstocksekarang+$qty;

    $addtotable = mysqli_query($koneksi,"insert into masuk (idbarang, keterangan, qty)values ($barangnya','$penerima','$qty' ");
    $updatestockmasuk =mysqli_query($koneksi,"update stock set stock= '$tambahkanbarangsekarangdenganquantity' where idbarang='$barangnya'");
    if($addtomasuk && $updatestockmasuk){
        header('location: masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
}

//menambah barang keluar
if(isset($_POST['addbarangkeluar'])){
    $barang = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($koneksi,"select* from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $cekstocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $cekstocksekarang-$qty;

    $addtokeluar = mysqli_query($koneksi,"insert into keluar (idbarang, penerima, qty) values ($barangnya','$penerima','$qty' ");
    $updatestockmasuk =mysqli_query($koneksi,"update stock set stock= '$tambahkanbarangsekarangdenganquantity' where idbarang='$barangnya'");
    if($addtokeluar && $updatestockmasuk){
        header('location: keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php');
    }
}


?>