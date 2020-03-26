<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="utf-8">

 

</head>

 

<body>

<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">

    <input type="text" size=10 maxlength=10 name="FechaNac" value="<?php echo $_POST["FechaNac"]?>"> (dd/mm/yyyy)

    <input type="submit" value="enviar">

</form>

 

<?php

if($_POST["FechaNac"])

{

    if(validateDateEs($_POST["FechaNac"]))

    {

        $values=preg_split("[\/|-]",$_POST["FechaNac"]);

        $d=$values[0];

        $m=$values[1];

        $Y=$values[2];

        echo "<p>Tienes ".( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y )." años</p>";

    }else{

        echo "<p>La Fecha es incorrecta (dd/mm/yyyy)</p>";

    }

}

 

/**

 * Funcion para validar una fecha en formato:

 *  dd/mm/yyyy, d/m/yyyy

 * Devuelve true|false

 */

function validateDateEs($date)

{

    $pattern="/^(0?[1-9]|[12][0-9]|3[01])[\/|-](0?[1-9]|[1][012])[\/|-]((19|20)?[0-9]{4})$/";

    if(preg_match($pattern,$date))

    {

        $values=preg_split("[\/|-]",$date);

        if(checkdate($values[1],$values[0],$values[2]))

            return true;

    }

    return false;

}

?>

 

</body>

</html>