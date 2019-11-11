<?php
include_once dirname(__FILE__) . '/config.php'; //Import credentials
$conn = mysqli_connect(HOST_DB,USER_DB,USER_PASS,NAME_DB); //Connect to DB

if($conn){
    $cedula = $_POST["cedula"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $edad = $_POST["edad"];
    $sql = "SELECT cedula FROM Personas";
    $result = $conn->query($sql);
    $flag = FALSE;
    while($row = mysqli_fetch_array($result) and !$flag) {
        if($cedula == $row){
            $flag = TRUE; //Registered
        }
    }

    if($flag){//Update non blank fields
    
    }else{//Create 
        $stmt = $conn->prepare("INSERT INTO `Personas` (`cedula`, `nombre`, `apellido`, `correo`, `edad`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $cedula, $nombre, $apellido, $correo, $edad);
        $stmt->execute();
        echo "Se ha insertado correctamente a " . $nombre . " " . $apellido;
    }


}else{

}

?>