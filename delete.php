<?php
// include database connection
include 'Database.php';
include 'Empleados.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Empleados($db);
    $stmt = $item->delete();
 
try {

    if($stmt->execute()){
        // redirect to read records page and
        // tell the user record was deleted
        header('Location: ListaEmpleados.php?action=delete');
    }else{
        die('Unable to delete record.');
    }
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>