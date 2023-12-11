<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='./css/estilos.css'>
    <title>gen2</title>
</head>
<body>
    <header> Mi blog de &nbsp;&nbsp; <img src="img/International_Pokémon_logo.svg.png"></header>

    <?php
        include('menu.php');
        //En gen pedimos que coja los 100 pokemon de la pokedex y desplazandolo despues de los 151 de antes
        $gen = 'https://pokeapi.co/api/v2/pokemon?limit=100&offset=151';
        $cont=152;
        include('sacarPkmn.php');
    ?>
        <div class="abajo"></div>

<footer> Trabajo &nbsp;<strong> Desarrollo Web en Entorno Servidor </strong>&nbsp; 2023/2024 IES Serra Perenxisa.</footer>
</body>
</html>