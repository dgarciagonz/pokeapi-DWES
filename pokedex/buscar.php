<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='./css/estilos.css'>
    <title>Búsqueda</title>
</head>
<body>
    <header> Mi blog de &nbsp;&nbsp; <img src="img/International_Pokémon_logo.svg.png"></header>

<?php
include('menu.php');
?>

    <form name="buscar" action="#" method="POST" class="pokeFormulario">
    <h1>Poke-Búsqueda</h1>
    <div class="pokeFormularioInt" >
        <div class="primerBox">
            <input type="text" name="nombre" placeholder="Nombre del pokémon" class="selects">
                <select id="tipo1" name="tipo1" class="selects" >
                    <option value="" disabled selected>Seleccione un tipo</option>
                    <option value="normal" class="normal">Normal</option>
                    <option value="fire" class="fire">Fuego</option>
                    <option value="water" class="water">Agua</option>
                    <option value="grass" class="grass">Planta</option>
                    <option value="electric" class="electric">Electrico</option>
                    <option value="ice" class="ice">Hielo</option>
                    <option value="fighting" class="fighting">Lucha</option>
                    <option value="poison" class="poison">Veneno</option>
                    <option value="ground" class="ground">Tierra</option>
                    <option value="flying" class="flying">Volador</option>
                    <option value="psychic" class="psychic">Psiquico</option>
                    <option value="bug" class="bug">Bicho</option>
                    <option value="rock" class="rock">Roca</option>
                    <option value="ghost" class="ghost">Fantasma</option>
                    <option value="dragon" class="dragon">Dragon</option>
                    <option value="dark" class="dark">Siniestro</option>
                    <option value="steel" class="steel">Acero</option>
                    <option value="fairy" class="fairy">Hada</option>
                </select>
        </div>

        <div class="checkboxes">
            <table>
                <tr><td>Región</td><td><input type="checkbox" name="todas" value="todas" checked> Todas</td></tr>
                <tr>
                    <td><input type="checkbox" name="gen1" value="gen1"> Kanto</td>
                    <td><input type="checkbox" name="gen2" value="gen2"> Johto</td>
                    <td><input type="checkbox" name="gen3" value="gen3"> Hoenn</td>
                </tr><tr>
                    <td><input type="checkbox" name="gen4" value="gen4"> Sinnoh</td>
                    <td><input type="checkbox" name="gen5" value="gen5"> Unova</td>
                    <td><input type="checkbox" name="gen6" value="gen6"> Kalos</td>
                </tr><tr>
                    <td><input type="checkbox" name="gen7" value="gen7"> Alola</td>
                    <td><input type="checkbox" name="gen8" value="gen8"> Galar</td>
                    <td><input type="checkbox" name="gen9" value="gen9"> Paldea</td>
                </tr>
            </table>
        </div>

        <input type="submit" id="boton" name="busqueda" value="Realizar búsqueda">
    </div>
    </form>


<?php

//Función para sacar los pokemon sihas seleccionado el tipo del pokemon
//Pasamos el nombre del pokemon (puede ser null si no lo hemos rellenado al enviar, por eso la comprobación), numero del pokemon, tipo, pokemon (Indice del json_decode), y los numeros de la pokedex
function pokemonTipo($nombre,$numeroPokemon,$tipo,$pokemon,$numMin,$numMax){
    if ($nombre!=null) {
        if ($numeroPokemon>$numMin && $numeroPokemon<$numMax) {
            //Si el nombre del pokemon contiene el nombre que introducimos, lo muestra
            if (str_contains($pokemon['pokemon']['name'],$nombre)){
            echo "<div class='pkmPokedex ".$tipo."'>";
            echo '<a href="./infoPokemon.php?numPokemon='.$numeroPokemon.'"><img src= "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/'.($numeroPokemon).'.png"></a>';
            echo '<p>'.$pokemon['pokemon']['name'].'</p>';
            echo '</div>';
            }
        }
    }else{
        if ($numeroPokemon>$numMin && $numeroPokemon<$numMax) {
            echo "<div class='pkmPokedex ".$tipo."'>";
            echo '<a href="./infoPokemon.php?numPokemon='.$numeroPokemon.'"><img src= "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/'.($numeroPokemon).'.png"></a>';
            echo '<p>'.$pokemon['pokemon']['name'].'</p>';
            echo '</div>';
        }
    }
}

//Función para sacar los pokemon en caso de no seleccionar el tipo del pokemon
//Pasamos el nombre del pokemon, numero del pokemon, pokemon (Indice del json_decode), y los numeros de la pokedex
function pokemonNoTipo($nombre,$numeroPokemon,$pokemon,$numMin,$numMax){
    if ($nombre!=null) {
        if ($numeroPokemon>$numMin && $numeroPokemon<$numMax) {
            //Si el nombre del pokemon contiene el nombre que introducimos, lo muestra
            if (str_contains($pokemon['name'],$nombre)){
            echo "<div class='pkmPokedex'>";
            echo '<a href="./infoPokemon.php?numPokemon='.$numeroPokemon.'"><img src= "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/'.($numeroPokemon).'.png"></a>';
            echo '<p>'.$pokemon['name'].'</p>';
            echo '</div>';
            }
        }
    }else{
        if ($numeroPokemon>$numMin && $numeroPokemon<$numMax) {
            echo "<div class='pkmPokedex'>";
            echo '<a href="./infoPokemon.php?numPokemon='.$numeroPokemon.'"><img src= "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/'.($numeroPokemon).'.png"></a>';
            echo '<p>'.$pokemon['name'].'</p>';
            echo '</div>';
        }
    }
}

if (!empty($_POST['gen1']) 
|| !empty($_POST['gen2'])
|| !empty($_POST['gen3'])
|| !empty($_POST['gen4'])
|| !empty($_POST['gen5'])
|| !empty($_POST['gen6'])
|| !empty($_POST['gen7'])
|| !empty($_POST['gen8'])
|| !empty($_POST['gen9'])
|| !empty($_POST['todas']) ) {
    
//Si se ha seleccionado un tipo hace lo siguiente
if (!empty($_POST['tipo1'])) {

    //Guardamos en nombre el nombre en minúsculas, en caso de que el nombre este vacio, se guarda como null
    $nombre = (!empty($_POST['nombre'])) ? strtolower($_POST['nombre']) : null;

    //Hacemos una peticion a la pokeapi de los pokemon de ese tipo
    $tipo = $_POST['tipo1'];
    $url = 'https://pokeapi.co/api/v2/type/'.$tipo.'';
    $dats = @file_get_contents($url);
    $Pokedex = json_decode($dats, true);
    
    //Si el json_decode ha funcionado, sigue la ejecución
    if ($Pokedex) {
        echo "<div class= 'pokedexContent'>";
        $pokemons = $Pokedex['pokemon'];

        //por cada pokemon como índice...
        foreach ($pokemons as $pokemon) {
    
            //Eliminamos la ultima / de la url del pokemon y al resultado lo convertimos en un array con / como delimitador
            //Cogemos el último índice del array que es él número de la pokedex del pokemon
            $urlPokemon=rtrim($pokemon['pokemon']['url'], '/');
            $urlPokemon = explode('/',$urlPokemon);
            $numeroPokemon = $urlPokemon[count($urlPokemon)-1];
    
            //Comprobamos que checkbox se han presionado (si se ha seleccionado todas, se omiten las demás)
            //Después llamamos a la función para mostrar los pokemon con el Tipo seleccionado
            if (!empty($_POST['todas'])) {
                pokemonTipo($nombre,$numeroPokemon,$tipo,$pokemon,0,1018);
            }else{
                if (!empty($_POST['gen1'])){
                    pokemonTipo($nombre,$numeroPokemon,$tipo,$pokemon,0,152);
                }
                if (!empty($_POST['gen2'])){
                    pokemonTipo($nombre,$numeroPokemon,$tipo,$pokemon,151,252);
                }
                if (!empty($_POST['gen3'])){
                    pokemonTipo($nombre,$numeroPokemon,$tipo,$pokemon,251,387);
                }
                if (!empty($_POST['gen4'])){
                    pokemonTipo($nombre,$numeroPokemon,$tipo,$pokemon,386,494);
                }
                if (!empty($_POST['gen5'])){
                    pokemonTipo($nombre,$numeroPokemon,$tipo,$pokemon,493,650);
                }
                if (!empty($_POST['gen6'])){
                    pokemonTipo($nombre,$numeroPokemon,$tipo,$pokemon,649,722);
                }
                if (!empty($_POST['gen7'])){
                    pokemonTipo($nombre,$numeroPokemon,$tipo,$pokemon,721,810);
                }
                if (!empty($_POST['gen8'])){
                    pokemonTipo($nombre,$numeroPokemon,$tipo,$pokemon,809,899);
                }
                if (!empty($_POST['gen9'])){
                    pokemonTipo($nombre,$numeroPokemon,$tipo,$pokemon,905,1018);
                }
            }
            
        }
        echo "</div>";
    } else {
        echo 'Error al obtener la lista de Pokémon.';
    }

//Si no se ha seleccionado un tipo hace lo siguiente
    }else{

    //Guardamos en nombre el nombre en minúsculas, en caso de que el nombre este vacio, se guarda como null
    $nombre = (!empty($_POST['nombre'])) ? strtolower($_POST['nombre']) : null;

    //Hacemos una peticion a la pokeapi de todos los pokemon
    $url ='https://pokeapi.co/api/v2/pokemon?limit=1018';
    $dats = @file_get_contents($url);
    $Pokedex = json_decode($dats, true);

    //Si el json_decode ha funcionado, sigue la ejecución
    if ($Pokedex && isset($Pokedex['results'])) {
    
        echo "<div class= 'pokedexContent'>";
    
        //Por cada índice de results...
        foreach ($Pokedex['results'] as $pokemon) {
    
            //Eliminamos la ultima / de la url del pokemon y al resultado lo convertimos en un array con / como delimitador
            //Cogemos el último índice del array que es él número de la pokedex del pokemon
            $urlPokemon=rtrim($pokemon['url'], '/');
            $urlPokemon = explode('/',$urlPokemon);
            $numeroPokemon = $urlPokemon[count($urlPokemon)-1];
    
            //Comprobamos que checkbox se han presionado (si se ha seleccionado todas, se omiten las demás)
            //Después llamamos a la función para mostrar los pokemon
            if (!empty($_POST['todas'])) {
                pokemonNoTipo($nombre,$numeroPokemon,$pokemon,0,1018);
            }else{
                if (!empty($_POST['gen1'])){
                    pokemonNoTipo($nombre,$numeroPokemon,$pokemon,0,152);
                }
                if (!empty($_POST['gen2'])){
                    pokemonNoTipo($nombre,$numeroPokemon,$pokemon,151,252);
                }
                if (!empty($_POST['gen3'])){
                    pokemonNoTipo($nombre,$numeroPokemon,$pokemon,251,387);
                }
                if (!empty($_POST['gen4'])){
                    pokemonNoTipo($nombre,$numeroPokemon,$pokemon,386,494);
                }
                if (!empty($_POST['gen5'])){
                    pokemonNoTipo($nombre,$numeroPokemon,$pokemon,493,650);
                }
                if (!empty($_POST['gen6'])){
                    pokemonNoTipo($nombre,$numeroPokemon,$pokemon,649,722);
                }
                if (!empty($_POST['gen7'])){
                    pokemonNoTipo($nombre,$numeroPokemon,$pokemon,721,810);
                }
                if (!empty($_POST['gen8'])){
                    pokemonNoTipo($nombre,$numeroPokemon,$pokemon,809,899);
                }
                if (!empty($_POST['gen9'])){
                    pokemonNoTipo($nombre,$numeroPokemon,$pokemon,905,1018);
                }
            }
            
        }
        echo "</div>";
    } else {
        echo 'Error al obtener la lista de Pokémon.';
    }

}
}

?>

<div class="abajo"></div>
    
    <footer> Trabajo &nbsp;<strong> Desarrollo Web en Entorno Servidor </strong>&nbsp; 2023/2024 IES Serra Perenxisa.</footer>
    </body>
    </html>