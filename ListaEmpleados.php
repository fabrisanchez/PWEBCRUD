<!DOCTYPE HTML>
<html>
<head>
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>
 
</head>
<body>
 
    <!-- container -->
    <div class="container">
 
        <div class="page-header">
            <h1>Lista de Empleados</h1>
        </div>
 
        <?php
                include_once 'Database.php';
                include_once 'Empleados.php';

                $action = isset($_GET['action']) ? $_GET['action'] : "";
 
                // if it was redirected from delete.php
                if($action=='delete'){
                    echo "<div class='alert alert-success'>Record was deleted.</div>";
                }


                $database = new Database();
                $db = $database->getConnection();

                $item = new Empleados($db);
                $stmt =$item->getEmpleados(); 
                $num = $stmt->rowCount();
                 
                // link to create record form
                echo "<a href='FormularioEmple.php' class='btn btn-primary m-b-1em'>Create New Product</a>";
                 
                //check if more than 0 record found
                if($num>0){
                 
                    // data from database will be here
                    //start table
                echo "<table class='table table-hover table-responsive table-bordered'>";
                 
                    //creating our table heading
                echo "<tr>
                      <th>Identidad</th>
                      <th>nombres</th>
                      <th>apellidos</th>
                      <th>fechanac</th>
                      <th>sexo</th>
                      <th>estadocivil</th>
                      <th>pais</th>
                      </tr>";
                 
                    // table body will be here
                    // retrieve our table contents
                    // fetch() is faster than fetchAll()
                    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    // extract row
                    // this will make $row['firstname'] to
                    // just $firstname only
                    extract($row);
                 
                    // creating new table row per record
                    echo "<tr>
                          <td>{$identidad}</td>
                          <td>{$nombres}</td>
                          <td>{$apellidos}</td>
                          <td>{$fechanac}</td>
                          <td>{$sexo}</td>
                          <td>{$estadocivil}</td>
                          <td>{$pais}</td>
                          <td>";
                            // read one record
                            echo "<a href='readOneRecord.php?identidad={$identidad}' class='btn btn-info m-r-1em'>Leer Un Registro</a>";
                 
                            // we will use this links on next part of this post
                            echo "<a href='update.php?identidad={$identidad}'  class='btn btn-primary m-r-1em'>Editar Registo</a>";
                 
                            // we will use this links on next part of this post
                            echo "<a href='#' onclick='delete_user({$identidad});'  class='btn btn-danger'>Eliminar Registro</a>";
                        echo "</td>";
                    echo "</tr>";
                }
                 
                // end table
                echo "</table>";
                 
                }
                 
                // if no records found
                else{
                    echo "<div class='alert alert-danger'>No records found.</div>";
                }


            ?>
 
    </div> <!-- end .container -->
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
<script type='text/javascript'>
// confirm record deletion


function delete_user(identidad){
 
    var answer = confirm('Are you sure?');
    if (answer){
        // if user clicked ok,
        // pass the id to delete.php and execute the delete query
        window.location = 'delete.php?identidad=' + identidad;
    }
}

</script>
 
</body>
</html>