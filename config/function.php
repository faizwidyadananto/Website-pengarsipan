<?php

//persiapan function untuk upload file/foto
function upload()
{
	//deklarasi variabel kebutuhan
	$namafile 	= $_FILES['file']['name'];
	$ukuranfile = $_FILES['file']['size'];
	$error 		= $_FILES['file']['error'];
	$tmpname 	= $_FILES['file']['tmp_name'];


	//cek apakah yang di upload adalah file atau gambar
	$eksfilevalid = ['jpg','jpeg','png','pdf','docx','doc'];
	$eksfile 	  = explode('.', $namafile);
	$eksfile 	  = strtolower(end($eksfile));
	if (!in_array($eksfile, $eksfilevalid)) {
		echo "<script> alert ('Yang anda upload bukan file ataupun gambar!')</script>";
		return false;
	}
	//cek jika ukuran terlalu besar
	if($ukuranfile > 100000000){
		echo "<script> alert ('Ukuran file yang anda upload terlalu besar!')</script>";
		return false;
	}
	//jika memenuhi syarat
	//generate nama file baru
	$namafilebaru = uniqid();
	$namafilebaru .= '.';
	$namafilebaru .= $eksfile;

	move_uploaded_file($tmpname, 'file/'.$namafilebaru);
	return $namafilebaru; 
}


?>