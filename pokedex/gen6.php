<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='./css/estilos.css'>
    <title>gen6</title>
</head>
<body>
    <header> Mi blog de &nbsp;&nbsp; <img src="img/International_Pokémon_logo.svg.png"></header>

    <?php
        include('menu.php');
        //Pedimos que coja los 72 de esta generacion y se salte los anteriores
        $gen = 'https://pokeapi.co/api/v2/pokemon?limit=72&offset=649';
        $cont=650;
        include('sacarPkmn.php');
    ?>
        <div class="abajo"></div>

<footer> Trabajo &nbsp;<strong> Desarrollo Web en Entorno Servidor </strong>&nbsp; 2023/2024 IES Serra Perenxisa.</footer>
</body>
</html>