<?php
    if(("user") != NULL){
        setcookie("user", "", time()-3600, "/");
        echo "Đăng xuất thành công";
    } else {
        echo "Đăng xuất không thành công";
    }
?>