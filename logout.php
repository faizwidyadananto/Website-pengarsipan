<?php
	session_start();
	//hapus session
	unset($_SESSION['id_user']);
	unset($_SESSION['username']);

	session_destroy();
	echo "<script>
			alert ('Anda berhasil Logout');
			document.location= 'index.php'; 
			</script>";
?>