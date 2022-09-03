<?php
date_default_timezone_set("Asia/Jakarta");
require_once "../../../inc/koneksi.php";
$request_method=$_SERVER["REQUEST_METHOD"];

include 'responcode.php';
include 'function.php';
$kodeRespon=http_response_code();
$data=array();
$data['kodeRespon']=$kodeRespon;
$tanggalSekarang=date("Y-m-d H:i:s");
$awal = microtime(true);

switch ($request_method) {
	case 'GET':
	
	include'get.php';
	break;
	case 'POST':
	include'post.php';
	break; 
	case 'PUT':
	include 'put.php';
	break; 
	case 'DELETE':
	include'delete.php';
	break;
	default:
		
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>