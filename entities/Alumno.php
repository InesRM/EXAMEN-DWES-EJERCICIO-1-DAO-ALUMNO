<?php
class Alumno
{
    private $dni;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $edad;
    private $telefono;


    public function __get($propiedad)
    {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
    }
}

?>