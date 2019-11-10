<?php
include_once dirname(__FILE__) . '/config.php'; //Import credentials
$conn = mysqli_connect(HOST_DB,USER_DB,USER_PASS,NAME_DB); //Connect to DB

if ($_GET) {
if($conn){
    $sql = "SELECT cedula FROM Personas";
    $result = $conn->query($sql);
    while($row = mysqli_fetch_array($result)) {
        echo $row ['cedula'];
        echo "<br>";
    }

}else{

}
}
?>