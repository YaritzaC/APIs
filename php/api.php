<?php 
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
 case 'POST': // create data
      $data = json_decode(file_get_contents('php://input'), true);  // true means you can convert data to array
    //  print_r($data);
      postOperation($data);
      break;
  case 'GET': // read data
      getOperation();
      break;
  case 'PUT': // update data
      $data = json_decode(file_get_contents('php://input'), true);  // true means you can convert data to array
      putOperation($data);
      break;
  case 'DELETE': // delete data
      $data = json_decode(file_get_contents('php://input'), true);  // true means you can convert data to array
      deleteOperation($data);
      break;
  default:
      print('{"result": "Requested http method not supported here."}');
}
// functions
  function putOperation($data){
      //Funciona
    include "conexion.php";
    $id = $_REQUEST["id_usuario"];
    $nombres = $data["nombres"];
    $apellidos = $data["apellidos"];
    $dni = $data["dni"];
    $sql = "UPDATE usuario SET nombres = '$nombres', apellidos = '$apellidos', dni = $dni WHERE id_usuario = '$id'";
    if (mysqli_query($conn, $sql) or die()) {
        echo '{"result": "Success"}';
    } else {
        echo '{"result": "Sql error"}';
    }
  }
  function getOperation(){
      //Funciona
    include "conexion.php";
    $sql = "SELECT * FROM usuario";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
      $rows = array();
       while($r = mysqli_fetch_assoc($result)) {
          $rows[] = $r; // with result object
        //  $rows[] = $r; // only array
       }
      echo json_encode($rows);
    } else {
        echo '{"result": "No data found"}';
    }
  }
  function postOperation($data){
   include "conexion.php";
   $nombres = $data["nombres"];
   $apellidos = $data["apellidos"];
   $dni = $data["dni"];
   $sql = "insert into usuario(id_usuario,nombres,apellidos,dni) values(null,'$nombres','$apellidos', '$dni')";
       $datos = array();
    if (mysqli_query($conn, $sql)) {
        echo '{"result": "Success"}';
    } else {
        echo '{"result": "Sql error"}';
    }
  }
  function deleteOperation($data){
      //Funciona
    include "conexion.php";
    $id = $_REQUEST["id_usuario"];
    #$id = 
    $sql = "DELETE FROM usuario WHERE id_usuario = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo '{"result": "Success"}';
    } else {
        echo '{"result": "Sql error"}';
    }
  }
 ?>