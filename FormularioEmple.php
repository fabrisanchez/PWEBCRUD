<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container mt-3">
     <h2>INGRESO DE EMPLEADOS</h2>
     <h2>Complete los siguientes campos:</h2>

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
         <input type="submit" name="Enviar"class="btn btn-primary">

     </form>

    </div>
 </body>
</html>