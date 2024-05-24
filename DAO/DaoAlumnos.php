<?php 

require_once "Controller/libreriaPDO.php";
require_once "entities/Alumno.php";
 class DaoAlumnos extends DB
 {
    public $alumnos = array(); // Array de objetos Alumno

    public function __construct($base)// Al instanciar el dao especificamos la base de datos
    {
        $this->dbname = $base;
    }

    public function listar()
    {
        $consulta="SELECT * FROM alumnos";

        $param = array();

        $this->consultaDatos($consulta, $param);

        foreach ($this->filas as $fila) 
        {
            $alumno=new Alumno();
        //El Dni NO SE MUESTRA, pero se recoge para poder borrar o actualizar
            $alumno->__set("Dni",$fila["Dni"]);
            $alumno->__set("Nombre",$fila["Nombre"]);
            $alumno->__set("Apellido1",$fila["Apellido1"]);
            $alumno->__set("Apellido2",$fila["Apellido2"]);
            $alumno->__set("Edad",$fila["Edad"]);
            $alumno->__set("Telefono",$fila["Telefono"]);

            $this->alumnos[]=$alumno;

        }
    }


    public function obtener($dni)
{
    $consulta = "SELECT * FROM alumnos WHERE Dni = :Dni";
    $param = array(":Dni" => $dni);

    $this->consultaDatos($consulta, $param);

    $alumno = null; // inicializamos la variable $alumno

    if (count($this->filas) > 0) {
        $fila = $this->filas[0];

        $alumno = new Alumno();
        $alumno->__set("Dni", $fila["Dni"]);
        $alumno->__set("Nombre", $fila["Nombre"]);
        $alumno->__set("Apellido1", $fila["Apellido1"]);
        $alumno->__set("Apellido2", $fila["Apellido2"]);
        $alumno->__set("Edad", $fila["Edad"]);
        $alumno->__set("Telefono", $fila["Telefono"]);
    }

    return $alumno; // si no se encuentra, $alumno será null
}


    public function actualizar($alu)
    {
        $consulta="UPDATE alumnos SET Nombre=:Nombre, Apellido1=:Apellido1, Apellido2=:Apellido2, Edad=:Edad, Telefono=:Telefono WHERE Dni=:Dni";

        $param = array();

        $param[":Dni"] = $alu->__get("Dni");
        $param[":Nombre"] = $alu->__get("Nombre");
        $param[":Apellido1"] = $alu->__get("Apellido1");
        $param[":Apellido2"] = $alu->__get("Apellido2");
        $param[":Edad"] = $alu->__get("Edad");
        $param[":Telefono"] = $alu->__get("Telefono");
      

        $this->consultaSimple($consulta, $param);
    }

 }

?>