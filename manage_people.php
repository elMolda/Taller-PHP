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
            if($cedula == $row["cedula"]){
                $flag = TRUE; //Registered
            }
        }
        
        if($flag){//Update non blank fields
            if($nombre != ""){
                $stmt = $conn->prepare("UPDATE Personas SET nombre = ? WHERE cedula = ?");
                $stmt->bind_param("si", $nombre, $cedula);
                $stmt->execute();
                $html = "<br></br><form action=\"index.html\">
                <input type=\"submit\" value=\"Menú\"/></form>";
                echo "Se ha actualizado el nombre correctamente a " . $nombre . $html;
            }
            if($apellido != ""){
                $stmt = $conn->prepare("UPDATE Personas SET apellido = ? WHERE cedula = ?");
                $stmt->bind_param("si", $apellido, $cedula);
                $stmt->execute();
                $html = "<br></br><form action=\"index.html\">
                <input type=\"submit\" value=\"Menú\"/></form>";
                echo "Se ha actualizado el apellido correctamente a " . $apellido . $html;
            }
            if($correo != ""){
                $stmt = $conn->prepare("UPDATE Personas SET correo = ? WHERE cedula = ?");
                $stmt->bind_param("si", $correo, $cedula);
                $stmt->execute();
                $html = "<br></br><form action=\"index.html\">
                <input type=\"submit\" value=\"Menú\"/></form>";
                echo "Se ha actualizado el correo correctamente a " . $correo . $html;
            }
            if($edad != ""){
                $stmt = $conn->prepare("UPDATE Personas SET edad = ? WHERE cedula = ?");
                $stmt->bind_param("ii", $edad, $cedula);
                $stmt->execute();
                $html = "<br></br><form action=\"index.html\">
                <input type=\"submit\" value=\"Menú\"/></form>";
                echo "Se ha actualizado la edad correctamente a " . $edad . $html;
            }
            
        }else{//Create 
            $stmt = $conn->prepare("INSERT INTO `Personas` (`cedula`, `nombre`, `apellido`, `correo`, `edad`) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("isssi", $cedula, $nombre, $apellido, $correo, $edad);
            $stmt->execute();
            $html = "<br></br><form action=\"index.html\">
            <input type=\"submit\" value=\"Menú\"/></form>";
            echo "Se ha insertado correctamente a " . $nombre . " " . $apellido . $html;
        }
    
    
    }else{
        echo "No se conectó a DB";
    }


?>