<html>
<head>
<title>Upload File</title>
</head>
<body>
<form action="" enctype="multipart/form-data" method="post">
File PDF : <input id="file" name="file" type="file" /><br>
Simpan Sebagai : <input type="text" name="file">
<br>
<input id="Submit" name="submit" type="submit" value="Upload" />
</form>
<?php
// Upload and Rename File

if (isset($_POST['submit']))
{
	$filename = $_FILES["file"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["file"]["size"];
	$allowed_file_types = array('.pdf');	

	if (in_array($file_ext,$allowed_file_types) && ($filesize < 2000000))
	{	
		// Rename file
		$newfilename =($file_basename). $file_ext;
		if (file_exists("upload/" . $newfilename))
		{
			// file already exists error
			echo "Kamu sudah pernah meng-upload file ini.";
		}
		else
		{		
			move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $newfilename);
			echo "File $newfilename berhasil di upload.";		
		}
	}
	elseif (empty($file_basename))
	{	
		// file selection error
		echo "Pilih file dulu.";
	} 
	elseif ($filesize > 2000000)
	{	
		// file size error
		echo "Ukuran file terlalu besar.";
	}
	else
	{
		// file type error
		echo "Jenis fIle yang bisa di upload hanya: " . implode(', ',$allowed_file_types);
		unlink($_FILES["file"]["tmp_name"]);
	}
}

?>
</body>
</html>