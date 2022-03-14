<?php 
$conn = new PDO("mysql:host=localhost;dbname=upload_image", "root", "");
$req = $conn->prepare("SELECT `name` FROM `image` WHERE `id_user` = 74 ORDER BY `id_image` DESC");
$req->execute();
$data = $req->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>
    
    <h1>Uploader une image</h1>
    <form action="controller/main.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" name="submit">
    </form>

    <br>
    <br>

    <div>
        <img src="target_folder/<?php echo $data['name']; ?>" alt="" height="250">
    </div>

</body>
</html>