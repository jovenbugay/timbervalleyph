<?php
	if(ISSET($_REQUEST['image'])){
		$exp=explode("/", $_REQUEST['image']);
		$image=$exp[5];
		$image_path = $_GET['image'];
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=".basename($image));
		header("Content-Type: application/octet-stream;");
		header("Content-Transfer-Encoding: binary");
		// readfile("image/".$image);
        readfile($image_path);
	}
?>