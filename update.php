<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Update a Record - PHP CRUD Tutorial</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body>
 
    <!-- container -->
    <div class="container">
 
        <div class="page-header">
            <h1>Update Product</h1>
        </div>
 
        <!-- PHP read record by ID will be here -->
        <?php
            // get passed parameter value, in this case, the record ID
            // isset() is a PHP function used to verify if a value is there or not
            $identidad=isset($_GET['identidad']) ? $_GET['identidad'] : die('ERROR: Record ID not found.');
             
            //include database connection
            include 'Database.php';
            include 'Empleados.php';

            $database = new Database();
            $db = $database->getConnection();

            $item = new Empleados($db);
            
             
            // read current record's data
            try {
                $stmt =$item->getEmpleados2($identidad); 

                // store retrieved row to a variable
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
             
                // values to fill up our form
                $identidad= $row['identidad'];
                $nombres = $row['nombres'];
                $apellidos = $row['apellidos'];
                $fechanac = $row['fechanac'];
                $sexo = $row['sexo'];
                $estadocivil = $row['estadocivil'];
                $pais = $row['pais'];
               
            }

             
            // show error
            catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
            ?>
 
        <?php

         include_once 'Database.php';
         include_once 'Empleados.php';

            $database = new Database();
            $db = $database->getConnection();

            $item = new Empleados($db);

    if($_POST){
     
    try{
        $stmt = $item->update();
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Registro Modificado correctamente.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }
 
    }
 
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
 
<!--we have our html form here where new record information can be updated-->
<form action="crearemple.php" method="GET">

            <div class= "mb-3 mt-3">
            <label>Identidad:</label>
            <input type="text" name="identidad" class="form-control " placeholder="Ingrese Id del empleado:">
            </div>


            <div class= "mb-3 mt-3">
            <label>Nombres:</label>
            <input type="text" name="nombres" class="form-control " placeholder="Ingrese nombres:">
            </div>
        
            <div class= "mb-3 mt-3">
            <label>Apellidos:</label>
            <input type="text" name="apellidos" class="form-control " placeholder="Ingrese apellidos:">
            </div>


            <div class= "mb-3 mt-3">
            <label>Fecha Nacimiento:</label>
            <input type="date" name="fechanac">
            </div>
            </br>
          
            <label for="sexo">sexo:</label>
            <select name ="sexo" >
              <option value="M">Masculino</option>
              <option value="F">Femenino</option>
              <option value="O">otro</option>
            </select>
             </br>
             </br>

            <label for="estadocivil">Estado Civil:</label>
            <select name ="estadocivil" >
              <option value="Soltero">Soltero</option>
              <option value="Casado">Casado</option>
              <option value="Unionlibre">Union Libre</option>
            </select>
         </br>
         </br>
            <div class="mb-3 mt-3">
            <label class="cont">Pais</label>
            <select name="pais" id="">
            <option value="0">Selecciona</option>
            <?php

              include_once 'Database.php';
               
              $database = new Database();
              $db = $database->getConnection();

              $sql = "SELECT pais FROM paises;";

              $stmt = $db->prepare($sql);
              $result = $stmt->execute();
              $rows = $stmt->fetchALL(\PDO::FETCH_OBJ);

              foreach($rows as $row){
              ?>
              <option value="<?php print($row->pais); ?>"><?php print($row->pais); ?></option>
              <?php 
                }
              ?>
            </select>   
            </div>

            <td>
                <input type='submit' value='Guardar Cambios' class='btn btn-primary' />
                <a href='ListaEmpleados.php' class='btn btn-danger'>Regresar a la lista de Empleados</a>
            </td>
  
</form>
        
 
    </div> <!-- end .container -->

 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>