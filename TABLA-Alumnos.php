<?php
require_once 'DAO/DaoAlumnos.php';
$base = "mayo";

$dni = '';
if (isset($_POST['Dni'])) {
    $dni = $_POST['Dni'];
}

$daoAlumnos = new DaoAlumnos($base);

if (isset($_POST['Actualizar']) && isset($_POST['Selec'])) {
    $selec = $_POST['Selec'];

    //Recogemos el resto de los arrays de datos y los actualizo desde la tabla

    $nombres = $_POST['Nombres'];
    $apellidos1 = $_POST['Apellidos1'];
    $apellidos2 = $_POST['Apellidos2'];
    $edades = $_POST['Edad'];
    $telefonos = $_POST['Telefonos'];

    foreach ($selec as $clave => $valor) {
        $alu = new Alumno();

        $alu->__set("Dni", $clave);
        $alu->__set("Nombre", $nombres[$clave]);
        $alu->__set("Apellido1", $apellidos1[$clave]);
        $alu->__set("Apellido2", $apellidos2[$clave]);
        $alu->__set("Edad", $edades[$clave]);
        $alu->__set("Telefono", $telefonos[$clave]);

        $daoAlumnos->actualizar($alu); //actualizamos ese alumno
    }
}

if (isset($_POST['Buscar']) && isset($_POST['Selec'])) {
    $selec = $_POST['Selec'];

    //no hay que borrar nada, hay que buscar alumnos seleccionados por un checkbox y mostrarlos en una tabla, tenemos que utilizar al función obtener($dni) del DaoAlumnos.php

    foreach ($selec as $clave => $valor) {
        $alu = $daoAlumnos->obtener($clave); //obtenemos ese alumno

        if ($alu != null) {
            echo "<table border='2'>";
            echo "<th>Dni</th>
         <th>Nombre</th>
         <th>Apellido1</th>
         <th>Apellido2</th>
         <th>Edad</th>
         <th>Telefono</th>";

            echo "<tr>";
            echo "<td>" . $alu->__get("Dni") . "</td>";
            echo "<td>" . $alu->__get("Nombre") . "</td>";
            echo "<td>" . $alu->__get("Apellido1") . "</td>";
            echo "<td>" . $alu->__get("Apellido2") . "</td>";
            echo "<td>" . $alu->__get("Edad") . "</td>";
            echo "<td>" . $alu->__get("Telefono") . "</td>";
            echo "</tr>";

            echo "</table>";
        }
    }

}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Buscar Alumnos</title>
</head>

<body>
    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data'>

        <fieldset>
            <legend><b>Tabla de Alumnos</b></legend>

            <?php
            echo "<input type='submit' name='Actualizar' value='Actualizar'>";
            echo "<input type='submit' name='Buscar' value='Buscar'>";

            $daoAlumnos->listar();

            if (count($daoAlumnos->alumnos) > 0) //si hay alumnos que listar
            {
                echo "<table border='2'>";
                echo "<th>Selec</th>
         <th>Dni</th>
         <th>Nombre</th>
         <th>Apellido1</th>
         <th>Apellido2</th>
         <th>Edad</th>
         <th>Telefono</th>";



                foreach ($daoAlumnos->alumnos as $alu) {
                    echo "<tr>";

                    echo "<td><input type='checkbox' name='Selec[" . $alu->__get('Dni') . "]'></td>";
                    echo "<td>" . $alu->__get("Dni") . "</td>";
                    echo "<td><input type='text' name='Nombres[" . $alu->__get('Dni') . "]' value='" . $alu->__get('Nombre') . "' size='9'></td>";
                    echo "<td><input type='text' name='Apellidos1[" . $alu->__get('Dni') . "]' value='" . $alu->__get('Apellido1') . "' size='9'></td>";
                    echo "<td><input type='text' name='Apellidos2[" . $alu->__get('Dni') . "]' value='" . $alu->__get('Apellido2') . "' size='9'></td>";
                    echo "<td><input type='text' name='Edad[" . $alu->__get('Dni') . "]' value='" . $alu->__get('Edad') . "' size='4'></td>";
                    echo "<td><input type='text' name='Telefonos[" . $alu->__get('Dni') . "]' value='" . $alu->__get('Telefono') . "' size='9'></td>";

                    echo "</tr>";
                }

                echo "</table>";
            }
            ?>

        </fieldset>

    </form>
</body>

</html>