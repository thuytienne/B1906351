<?php
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

$oldpass = @md5($_POST["pass"]);
$newpass = @$_POST["newpass"];
$newpass2 = @$_POST["newpass2"];

if($oldpass != md5($_POST["pass"])){
    echo "Mật khẩu cũ không chính xác";
}else if($newpass == NULL){
    echo "Vui lòng nhập mật khẩu mới";
}
else if($newpass2 == NULL){
    echo "Vui lòng nhập lại mật khẩu mới";
}
 else if (($newpass != $newpass2)){
    echo "Mật khẩu không khớp.Vui lòng nhập lại!";
}
    $sql = "UPDATE customers SET password = '".md5($_POST["newpass"])."' WHERE password = '".md5($_POST["pass"])."'";
    if($conn->query($sql) == TRUE){
        echo "Đổi mật khẩu thành công";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   
    $conn->close();
?>
