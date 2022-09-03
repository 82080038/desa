<?php
// koneksi.php
  $host='localhost';
  $user='root';
  $password='';
  $database='db_vaksin';
  $koneksi=mysqli_connect($host,$user,$password,$database);
  if(!$koneksi){
    echo"Tidak dapat terhubung ke server :".mysqli_error($koneksi);
    die();
  } 
 
// else{
//  echo "Database : Terhubung";
// }
?>