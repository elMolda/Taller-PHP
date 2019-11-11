<?php
include_once dirname(__FILE__) . '/config.php'; //Import credentials
$conn = mysqli_connect(HOST_DB,USER_DB,USER_PASS,NAME_DB); //Connect to DB

if($conn){
    $nombreusuario = $_POST["nombreusuario"];
    $cedula = $_POST["cedula"];
    $contra = md5($_POST["contra"]);
    $sql = "SELECT cedula FROM Personas";
    $result=$conn->query($sql);
    $flag = FALSE;
    while($row = mysqli_fetch_array($result) and !$flag) {
        if($cedula == $row["cedula"]){
            $flag = TRUE; //Exists
        }
    }

    if($flag){//Insert into Usuarios
        $sql = "SELECT nombreusuario FROM Usuarios";
        $result=$conn->query($sql);
        $flag = FALSE;
        while($row = mysqli_fetch_array($result) and !$flag) {
            if($nombreusuario == $row["nombreusuario"]){
                $flag = TRUE; //Exists
            }
        }
        if($flag){
            echo '<p>Ya existe nombre de usuario</p><br></br><form action="sing_up.html"><input type="submit" value="Volver a Registro" /></form>';
        }else{
            $sql = "INSERT INTO Usuarios (cedula, nombreusuario, contra) VALUES (" . $cedula ." ,'". $nombreusuario . "' ,'" . $contra ."')";
            $conn->query($sql);
            $sql = "SELECT id FROM Usuarios WHERE cedula = " . $cedula;
            $result=$conn->query($sql);
            $flag = FALSE;
            while($row = mysqli_fetch_array($result) and !$flag) {
                if($row["id"] == 1){
                    $flag = TRUE; //Is first user
                }
            }
            if($flag){//assing rol adminn
                $sql = "UPDATE Usuarios SET rol = 'adm' WHERE cedula = ". $cedula;
                $conn->query($sql);
                echo "Registro exitoso admin";
            }else{
                $sql = "UPDATE Usuarios SET rol = 'usr' WHERE cedula = ". $cedula;
                $conn->query($sql);
                echo "Registro exitoso usuario";
            }
        }
        
    }else{//Tell user about error
        echo "La cédula " . $cedula . " No está registrada en tabla personas" . '<br></br><form action="sing_up.html"><input type="submit" value="Volver a Registro" /></form>';;
    }

}else{
    echo "Error de conexión";
}
    
  

?>