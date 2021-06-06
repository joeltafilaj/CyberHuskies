
<?php

echo $_POST["name_input"]."<br>";
echo $_POST["str_price_input"]."<br>";
echo $_POST["avl_from_input"]."<br>";
echo $_POST["avl_unt_input"]."<br>";
echo $_POST["desc_input"]."<br>";
echo $_POST["cat_input"]."<br>";

$destination = getcwd()."\\"; //where do you want to save (getcwd returns current directory)
$target_file = $destination . basename($_FILES["photo_input"]["name"]); //basename($_FILES["photo_input"]["name"]) returns file name
$uploadOk = true;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["publish-product"])) {
  $check = getimagesize($_FILES["photo_input"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = true;
  } else {
    echo "File is not an image.";
    $uploadOk = false;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = false;
}

// Check file size
if ($_FILES["photo_input"]["size"] > 1000000) { // 1 Mb
  echo "Sorry, your file is too large.";
  $uploadOk = false;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = false;
}

// Check if $uploadOk is set to false
if (!$uploadOk) {
  echo "File was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["photo_input"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["photo_input"]["name"])). " has been uploaded.";
  } else {
    echo "There was an error uploading your file.";
  }
}
?>