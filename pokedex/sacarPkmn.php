<?php

//Compruebo si existe la variable gen, si no lo está, saca todos los pokemon
    if (!isset($gen)) {
        
        $gen='https://pokeapi.co/api/v2/pokemon?limit=1017';
    }
    
    //Realizo la llamada a la pokeapo con los parametros que le pedí
    $dats = @file_get_contents($gen);
    $Pokedex = json_decode($dats, true);
            
    //Compruebo si json_decode funcionó y si el contenido es el esperado
    if ($Pokedex && isset($Pokedex['results'])) {
                
        //El contador es el primer pokemon de cada generación, en caso de no indicar cual es, empezará por el primero de la pokedex
        if (!isset($cont)) {
            $cont=1;
        }

        echo "<div class= 'pokedexContent'>";
        // Por cada campo dentro de results, cogemos el campo Name del pokemon y con el contador sacamos la imagen directamente del link posterior (era la forma más sencilla)
        // Añadimos un enlace a en la imagen para redireccionar al pokemon    
            foreach ($Pokedex['results'] as $pokemon) {
                echo "<div class='pkmPokedex'>";
                echo '<a href="./infoPokemon.php?numPokemon='.$cont.'"><img src= "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/'.($cont).'.png"></a>';
                echo '<p>'.$pokemon['name'].'</p>';
                echo '</div>';
                $cont++;   
                }

        echo "</div>";
    } else {
        echo 'Error al obtener la lista de Pokémon.';
    }
?>