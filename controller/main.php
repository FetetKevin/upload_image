<?php

$str = '01234567899876543210';
$shuffled = str_shuffle($str);

///////////////////////////// UPLOAD DE L'IMAGE //////////////////////////////////
$target_dir = "../target_folder/";
$target_file = $target_dir . basename($shuffled."".$_FILES['image']['name']);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$name = $shuffled."".$_FILES['image']['name'];
var_dump($name);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["image"]["size"] > 500000) {
   echo "Sorry, your file is too large.";
   $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
   $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";

} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])). " has been uploaded.";

    $conn = new PDO("mysql:host=localhost;dbname=upload_image", "root", "");
    $del = $conn->prepare("DELETE FROM `image` WHERE `id_user` = :id");
    $del->execute(array(':id' => 74));
    $req = $conn->prepare("INSERT INTO `image`(`name`, `id_user`) VALUES (:name, :id)");
    $req->execute(array(':name' => $name, ':id' => 74));

    header("Location: ../index.php");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
///////////////////////////// UPLOAD DE L'IMAGE //////////////////////////////////

