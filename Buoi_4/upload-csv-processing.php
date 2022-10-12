<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   // $check = 
//   if($check !== false) {
//     echo "It is a file - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "It is not a file.";
//     $uploadOk = 0;
//   }
// }

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "csv" && $imageFileType != "xlsx" ) {
  echo "Sorry, only csv, xlsx files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
	  echo '<br>';
	
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qlbanhang";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // $id = $_COOKIE['id'];
    // $sql = "UPDATE customers set img_profile = '".$_FILES["fileToUpload"]["name"]."'";
      // $sql = "INSERT INTO customers (ID, fullname, email, Birthday, re_date, password, img_profile) VALUES ('".$_FILES["fileToUpload"]["name"]."')";
    
    $sql = "UPDATE customers set fullname = '".$_FILES["fileToUpload"]["name"]."' and email = '".$_FILES["fileToUpload"]["name"]. "' and Birthday = '".$_FILES["fileToUpload"]["name"]."'
                   and reg_date = '".$_FILES["fileToUpload"]["name"]."' and password = '".md5($_FILES["fileToUpload"]["name"])."' and img_profile = '".$_FILES["fileToUpload"]["name"]."' ";
    // $sql = $sql. " WHERE ID='".$id."'";
    echo $sql;
    if ($conn->query($sql) == TRUE) {
      echo 'cap nhat csdl thanh cong!<br>';
      // echo '<a href="homepage.php">Trang chu</a>';
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
      $file = fopen ($_FILES["fileToUpload"]["name"], "r");
      // while($data = fgetcsv ($file, 1000, ",") != FALSE){
      //   $import = "INSERT INTO customers (ID, fullname, email, Birthday, reg_date, password, img_profile) VALUES ('$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[6]', '$data[6]', '$data[7]', '$data[8]', '$data[9]', '$data[10]')";
      //   mysqli_query($import);
      // }
    // $file = fopen("cau_10.csv", "r");
    $csv = array();
    $name_file = 'cau_10.csv';
    $lines = file($name_file, FILE_IGNORE_NEW_LINES);

    // dua du lieu tu file csv vao mang:
    foreach ($lines as $key => $value)
    {
        $csv[$key] = str_getcsv($value);
    }

    // //in mang
    // echo '<pre>';
    // print_r($csv);
    // echo '</pre>';
  }else {
      echo "Sorry, there was an error uploading your file.";
    }
}
?>
