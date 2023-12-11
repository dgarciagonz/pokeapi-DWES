<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='./css/estilos.css'>
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>gen9</title>
</head>
<body>
    <header> Mi blog de &nbsp;&nbsp; <img src="img/International_Pokémon_logo.svg.png"></header>

    <?php
        include('menu.php');
        //compobamos si se ha pasado el número del pokemon correctamente
        if (isset($_GET['numPokemon'])) {
            
            //Hacemos una peticion de los datos del pokemon
            $numPokemon=$_GET['numPokemon']; 
            $urlPkm='https://pokeapi.co/api/v2/pokemon/'.$numPokemon;
            $datos = @file_get_contents($urlPkm);
            $pokemon = json_decode($datos, true);

            //Comrpobamos si el json decode ha funcionado
            echo "<div class='pokeInfo'>";
            if ($pokemon) {
                //Sacamos la foto del pokemon y su versión shiny
                echo "<div class='pokeFotos'>";
                echo "<img src='https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/".$numPokemon.".png' alt='Imagen de " .$pokemon['name']." no disponible'>";
                echo "<img src='https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/".$numPokemon.".png' alt='Versión variocolor de " .$pokemon['name']." no disponible'>";
                echo "</div>";

                echo "<div class='pokeDatos'>";
                echo "<div class='pokeNumero'>";
                //Comprobamos la posición del pokemon para el menú de navegación del anterior/siguiente pokemon
                $anteriorPokemon = ($numPokemon<=1 || $numPokemon>1017)? $numPokemon: $numPokemon-1 ;
                $siguientePokemon = ($numPokemon<1 || $numPokemon>=1017)? $numPokemon: $numPokemon+1 ;

            //Si intenamos acceder a una posición superior a la del último pokemon, se redireccionará al último pokemon de la pokedex de Paldea (1017 actualmente)
            if($numPokemon>1017){
                $numPokemon=1017;
            }
                //Creamos el menú  de navegación de la pokedex usando las flechas del font-awesome
                echo "<p><a href='./infoPokemon.php?numPokemon=".$anteriorPokemon."'><i class='fa-solid fa-angles-left' style='color: #ffffff;'> </i></a>
                Nº Pokedex: " . $pokemon['id']."
                <a href='./infoPokemon.php?numPokemon=".$siguientePokemon."'><i class='fa-solid fa-angles-right' style='color: #ffffff;'> </i></a><br>";
                echo $pokemon['name']."</p>";
                echo "</div>";

                //Dividimos la altura y peso del pokemon entre 10 para que sea concorde a la pokedex real
                echo "<p>Altura: " . ($pokemon['height']/10)." m</p>";
                echo "<p>Peso: " . ($pokemon['weight']/10)." kg</p>";

                //Por cada tipo del pokemon, le añadimos el tipo como clase para darle los colores originales a la caja
                echo "<p>Tipos:";
                echo "<div class='contenedorTipos'>";
                foreach ($pokemon['types'] as $tipo) {
                    echo "<div class='tipos ".$tipo['type']['name']."'>";
                    echo $tipo['type']['name'];
                    echo "</div>";
                }
                echo "</div>";
                echo "</p>";

                //Por cada habilidad hacemos lo mismo, pero como hay tantas habilidades, preferí ponerle un estilo básico y ya
                echo "<p>Habilidades:";
                echo "<div class='contenedorTipos'>";
                foreach ($pokemon['abilities'] as $habilidad) {
                    echo "<div class='tipos'>";
                    echo $habilidad['ability']['name'];
                    echo "</div>";
                }
                echo "</div>";
                echo "</p>";
                echo "</div>";
            }
            echo "</div>";
            
        }else{
            echo "No has seleccionado ningún pokemon";
        }
        
        
    ?>
        <div class="abajo"></div>

<footer> Trabajo &nbsp;<strong> Desarrollo Web en Entorno Servidor </strong>&nbsp; 2023/2024 IES Serra Perenxisa.</footer>
</body>
</html>