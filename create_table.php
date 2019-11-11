<?php
include_once dirname(__FILE__) . '/config.php'; //Import credentials
$conn = mysqli_connect(HOST_DB,USER_DB,USER_PASS,NAME_DB); //Connect to DB

if($conn){
    $field1 = $_POST["field1"];
    $field2 = $_POST["field2"];
    $field3 = $_POST["field3"];
    $field4 = $_POST["field4"];
    $field5 = $_POST["field5"];
    $fld1Tp = $_POST["type1"];
    $fld2Tp = $_POST["type2"];
    $fld3Tp = $_POST["type3"];
    $fld4Tp = $_POST["type4"];
    $fld5Tp = $_POST["type5"];
    $name   = $_POST["table_name"];

    $sql = "CREATE TABLE " . $name . " ( "
        . $field1 . " " . $fld1Tp . " " . " PRIMARY KEY, "
        . $field2 . " " . $fld2Tp . ","
        . $field3 . " " . $fld3Tp . ","
        . $field4 . " " . $fld4Tp . ","
        . $field5 . " " . $fld5Tp . ")";
    $conn->query($sql);
    $conn->close();
    $html = "<h3>Se creó la tabla</h3>" . "<br></br><form action=\"index.html\">
    <input type=\"submit\" value=\"Menú\"/></form>";
    echo $html;

}else{
    echo "<p>No se Conectó a la Base de Datos</p>";
}


?>