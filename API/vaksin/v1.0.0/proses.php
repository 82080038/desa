<?php
require_once "koneksi.php";
$request_method=$_SERVER["REQUEST_METHOD"];
$data=array();
include 'responcode.php';
include '../../penduduk/v1.0.0/function.php';
// $kodeRespon=http_response_code();

$kodeRespon=http_response_code();
$data['kodeRespon']=$kodeRespon;

switch ($request_method) {
	case 'GET':
	include'get.php';
	break;
	case 'POST':
	include'post.php';
	break; 
	case 'PUT':
	break; 
	case 'DELETE':
	include'delete.php';
	break;
	default:
		// Invalid Request Method
	header("HTTP/1.0 405 Method Not Allowed");
	break;
	
}
?>