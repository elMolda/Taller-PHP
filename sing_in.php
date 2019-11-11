<?php
include_once dirname(__FILE__) . '/config.php'; //Import credentials
$conn = mysqli_connect(HOST_DB,USER_DB,USER_PASS,NAME_DB); //Connect to DB

if($conn){

    $nombreusuario = $_POST["nombreusuario"];
    $contra = md5($_POST["contra"]);
    $stmt = $conn->prepare("SELECT contra, rol FROM Usuarios WHERE nombreusuario=?");
    $stmt->bind_param("s", $nombreusuario);
    $stmt->execute();
    $stmt->bind_result($rContra,$rRol);
    $stmt->fetch();
    if(strcmp($contra,$rContra)==0){//pass valid
        if(strcmp($rRol,"adm")==0){//validate rol
            echo "Soy admin";
        }else if(strcmp($rRol,"usr")==0){
            echo "Soy user";
        }
    }
    

}else{
    echo "Error de conexión";
}

?>