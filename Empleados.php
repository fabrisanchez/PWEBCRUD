<?php


class Empleados
{

    //Coneexion 

    private $conn;
    private $tablename = "empleados";

    public $identidad;
    public $nombres;
    public $apellidos;
    public $fechanac;
    public $sexo;
    public $estadocivil;
    public $pais;
    

    // Construuctor de Clase
    
    public function __construct($db)
    {
        $this->conn = $db;
    }

        public function getEmpleados(){
            $sqlQuery = "SELECT identidad, nombres, apellidos,fechanac,sexo, estadocivil, pais FROM " . $this->tablename . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getEmpleados2($identidad){
            $query = "SELECT identidad, nombres, apellidos,fechanac,sexo, estadocivil, pais FROM empleados ".$this->tablename." WHERE identidad = ? LIMIT 0,1";
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(1, $identidad);
            $stmt->execute();
            return $stmt;
        }

        public function delete(){
            $identidad=isset($_GET['identidad']) ? $_GET['identidad'] : die('ERROR: Record ID not found.');
  
            $query = "DELETE FROM ".$this->tablename." WHERE identidad = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $identidad);
            return $stmt;
        }



        public function update(){
         $identidad=isset($_GET['identidad']) ? $_GET['identidad'] : die('ERROR: Record ID not found.');
         $query = "UPDATE ".$this->tablename." SET nombres=:nombres, apellidos=:apellidos, fechanac=:fechanac, sexo=:sexo, estadocivil=:estadocivil, pais=:pais, WHERE identidad = :iddentidad";
 
        // prepare query for excecution
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $identidad=htmlspecialchars(strip_tags($_POST['identidad']));
        $nombres=htmlspecialchars(strip_tags($_POST['nombres']));
        $apellidos=htmlspecialchars(strip_tags($_POST['apellidos']));
        $fechanac=htmlspecialchars(strip_tags($_POST['fechanac']));
        $sexo=htmlspecialchars(strip_tags($_POST['sexo']));
        $estadocivil=htmlspecialchars(strip_tags($_POST['estadocivil']));
        $pais=htmlspecialchars(strip_tags($_POST['pais']));
       
 
        // bind the parameters
        $stmt->bindParam(':identidad', $identidad);
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':fechanac', $fechanac);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':estadocivil', $estadocivil);
        $stmt->bindParam(':pais', $pais);
        return $stmt;
        }


        // Crear un empleados
        public function createEmpleados(){
            $sqlQuery = "INSERT INTO
                        ". $this->tablename ."
                    SET
                    identidad = :identidad,
                    nombres = :nombres, 
                    apellidos = :apellidos, 
                    fechanac = :fechanac, 
                    sexo = :sexo, 
                    estadocivil = :estadocivil,
                    pais = :pais";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->identidad=htmlspecialchars(strip_tags($this->identidad));
            $this->nombres=htmlspecialchars(strip_tags($this->nombres));
            $this->apellidos=htmlspecialchars(strip_tags($this->apellidos));
            $this->fechanac=htmlspecialchars(strip_tags($this->fechanac));
            $this->sexo=htmlspecialchars(strip_tags($this->sexo));
            $this->estadocivil=htmlspecialchars(strip_tags($this->estadocivil));
            $this->pais=htmlspecialchars(strip_tags($this->pais));
            
            // bind data
            $stmt->bindParam(":identidad", $this->identidad);
            $stmt->bindParam(":nombres", $this->nombres);
            $stmt->bindParam(":apellidos", $this->apellidos);
            $stmt->bindParam(":fechanac", $this->fechanac);
            $stmt->bindParam(":sexo", $this->sexo);
            $stmt->bindParam(":estadocivil", $this->estadocivil);
            $stmt->bindParam(":pais", $this->pais);
  
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }



}

?>