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
    mysqli_stmt_free_result($stmt);
    if(strcmp($contra,$rContra)==0){//pass valid
        if(strcmp($rRol,"adm")==0){//validate rol
            
        }else if(strcmp($rRol,"usr")==0){
            //show profile
            $stmt = $conn->prepare("SELECT * FROM Personas WHERE cedula = (SELECT cedula FROM Usuarios WHERE nombreusuario = ? )");
            $stmt->bind_param("s", $nombreusuario);
            $stmt->execute();
            $stmt->bind_result($rCedula,$rNombre,$rApellido,$rCorreo,$rEdad);
            $stmt->fetch();
            echo "<h4>Perfil</h4><br></br>";
            echo "Cedula: " . $rCedula . "<br></br>";
            echo "Nombre: " . $rNombre . "<br></br>";
            echo "Apellido: " . $rApellido . "<br></br>";
            echo "Correo: " . $rCorreo . "<br></br>";
            echo "Edad: " . $rEdad . "<br></br>"; 
            mysqli_stmt_free_result($stmt);            
        }
    }else{
        echo "Nombre de usuario o contraseña errados." . '<br></br><form action="sing_in.html"><input type="submit" value="Volver" /></form>';
    }
    

}else{
    echo "Error de conexión";
}


?>