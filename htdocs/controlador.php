<?php

if (!empty($_POST["btningresar"   ])) {
    if (empty($_POST["username"]) and empty ($_POST["password"])) {
echo "Los campos estan vacios";

}else{
    $username=$_POST ["username"];
    $password=$_POST ["password"];

    $sql =$mysqli->query("select * from users where username='$username' and password='$password' ");
    if($data=$sql->fetch_object() )     {

    
    header ("location:index.php");

     }else{
        echo '<div> acceso denegado <div/>'
     ;
}
}
 }
?>