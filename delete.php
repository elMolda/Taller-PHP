<?php
include_once dirname(__FILE__) . '/config.php'; //Import credentials
$conn = mysqli_connect(HOST_DB,USER_DB,USER_PASS,NAME_DB); //Connect to DB

if($conn){
    $cedula = $_POST["cedula"];
    $stmt = $conn->prepare("DELETE FROM Personas WHERE cedula = ?");
    $stmt->bind_param("i", $cedula);
    $stmt->execute();
    $html = "<br></br><form action=\"index.html\">
    <input type=\"submit\" value=\"Menú\"/></form>";
    echo "Se ha eliminado correctamente a " . $cedula . $html;
}else{
    echo "No se conectó a DB";
}
?>