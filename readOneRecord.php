<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Read One Record - PHP CRUD Tutorial</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body>
 
    <!-- container -->
    <div class="container">
 
        <div class="page-header">
            <h1>Leer un Empleado</h1>
        </div>
 
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
                        $identidad = $row['identidad'];
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
 
        <!--we have our html table here where the record will be displayed-->
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>identidad</td>
                <td><?php echo htmlspecialchars($identidad, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>nombres</td>
                <td><?php echo htmlspecialchars($nombres, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>apellidos</td>
                <td><?php echo htmlspecialchars($apellidos, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>fechanac</td>
                <td><?php echo htmlspecialchars($fechanac, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>sexo</td>
                <td><?php echo htmlspecialchars($sexo, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>estadocivil</td>
                <td><?php echo htmlspecialchars($estadocivil, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>pais</td>
                <td><?php echo htmlspecialchars($pais, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='ListaEmpleados.php' class='btn btn-danger'>Regresar a la Lista de Empleados</a>
                </td>
            </tr>
        </table>
 
    </div> <!-- end .container -->
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>