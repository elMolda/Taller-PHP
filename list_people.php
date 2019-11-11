<?php
include_once dirname(__FILE__) . '/config.php'; //Import credentials
$conn = mysqli_connect(HOST_DB,USER_DB,USER_PASS,NAME_DB); //Connect to DB

if($conn){
    $html = '<table border="1" style="width:100%">';
    $html.='<tr>';
    $html.='<th>Cédula</th>';
    $html.='<th>Nombre</th>';
    $html.='<th>Apellido</th>';
    $html.='<th>Correo</th>';
    $html.='<th>Edad</th>';
    $html.='</tr>';
    if(isset($_GET['asc_ced'])) {
        $sql="SELECT * FROM Personas ORDER BY cedula ASC";
    }
    if(isset($_GET['asc_nom'])) {
        $sql="SELECT * FROM Personas ORDER BY nombre ASC";
    }
    if(isset($_GET['des_ced'])) {
        $sql="SELECT * FROM Personas ORDER BY cedula DESC";
    }
    if(isset($_GET['des_nom'])) {
        $sql="SELECT * FROM Personas ORDER BY nombre DESC";
    }
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($result)){
        $html.='<tr>';
        $html.="<td>".$row['cedula']."</td> <td>".$row['nombre']."</td>"."<td>".$row['apellido']."</td>"."<td>".$row['correo']."</td>"."<td>".$row['edad']."</td>";
        $html.="</tr>";
    }
    $html.="</table>";
    $html.='<br></br><form action="list_people.html"><input type="submit" value="Opciones Listas" /></form>';
    $html.='<form action="index.html"><input type="submit" value="Menú" /></form>';    
    echo $html;
    mysqli_close($conn);
}else{
    echo "Error de conexión";
}
?>