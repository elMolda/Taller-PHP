<?php
include_once dirname(__FILE__) . '/config.php'; //Import credentials
$conn = mysqli_connect(HOST_DB,USER_DB,USER_PASS,NAME_DB); //Connect to DB

if($conn){
    $field1 = $_GET["field1"];
    $field2 = $_GET["field2"];
    $field3 = $_GET["field3"];
    
    


}else{

}


?>