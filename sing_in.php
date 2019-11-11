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
            $sql = "SELECT nombreusuario, id FROM Usuarios WHERE rol = 'usr'";
            $result = $conn->query($sql);
            echo "<h4>Lista Usuarios</h4>";
            $html = '<table border="1">';
            $html.='<tr>';
            $html.='<th>Nombre Usuario</th>';
            $html.='</tr>';   
            while($row = mysqli_fetch_array($result)) {                
                $html.='<tr>';
                $html.='<td><a href="edit_rol.php?id=' . $row["id"] .'">'.$row['nombreusuario']."</td>";
                $html.="</tr>";
            }         
            $html.="</table>";
            echo $html;
            mysqli_free_result($result);
        }else if(strcmp($rRol,"usr")==0){
            //show profile
            $stmt = $conn->prepare("SELECT * FROM Personas WHERE cedula = (SELECT cedula FROM Usuarios WHERE nombreusuario = ? )");
            $stmt->bind_param("s", $nombreusuario);
            $stmt->execute();
            $stmt->bind_result($rCedula,$rNombre,$rApellido,$rCorreo,$rEdad);
            $stmt->fetch();
            echo "<h4>Perfil</h4>";
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