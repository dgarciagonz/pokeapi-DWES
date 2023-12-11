<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='./css/estilos.css'>
    <title>gen 1</title>
</head>
<body>
    <header> Mi blog de &nbsp;&nbsp; <img src="img/International_Pokémon_logo.svg.png"></header>

    <?php
        include('menu.php');
        $gen='https://pokeapi.co/api/v2/pokemon?limit=151';
        include('sacarPkmn.php');
        ?>
    
        <div class="abajo"></div>
    
<footer> Trabajo &nbsp;<strong> Desarrollo Web en Entorno Servidor </strong>&nbsp; 2023/2024 IES Serra Perenxisa.</footer>
</body>
</html>