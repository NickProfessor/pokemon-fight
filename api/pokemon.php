<?php

$urlPokeAPI = "https://pokeapi.co/api/v2/";

class Pokemon {
    private static function getMovePower($moveAPI = null){
        try{
            $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n")); 
            $context = stream_context_create($opts);
            $jsonMove = file_get_contents($moveAPI,false,$context);
        } catch (Exception $e) {
            echo "<br>Tentando novamente em 10 segundos<br>";
            sleep(10);
            $jsonMove = file_get_contents($moveAPI);            
        }
        $arrMove = json_decode($jsonMove, true);                 
        return $arrMove["power"];
    }

    public static function d($arr, $msg = "") {        
        echo "<pre>";
        echo $msg . "<br><br>";
        print_r($arr);
        die;
    }

    private static function getRandomAttackFromArray($arrAttack = null) {        
        $qttAttack = count($arrAttack)-1;
        $idAttack = rand(0,$qttAttack);
        return $arrAttack[$idAttack];
    }

    public static function getPokemonAttacks($pokemonID) {
        $arrPokemon = Pokemon::getPokemonByID($pokemonID);
        $arrMoves = $arrPokemon["moves"];        
        $arrAttack = array();
        $count = 0;

        foreach ($arrMoves as $key => $arr) {
            if ($count >= 15) {
                break;
            }
            $moveName = $arrMoves[$key]["move"]["name"];
            $moveAPI = $arrMoves[$key]["move"]["url"];
            $movePower = Pokemon::getMovePower($moveAPI);
           if (is_null($movePower)) $movePower = 20;
            $arrAttack[$count] = array(
                                        "id" => $count,
                                        "ataque" => $moveName,
                                        "forca"  => $movePower    
                                    );
            $count++;
        }
        return $arrAttack;
    }

    public static function getPokemonHP($pokemonID = null){
        $arrPokemon = Pokemon::getPokemonByID($pokemonID);
        // Aumenta em 10x o HP para ter diversos ataques durante cada batalha;
        return $arrPokemon["stats"][0]["base_stat"] * 10;
    }


    private static $urlPokeAPI = "https://pokeapi.co/api/v2/";

    public static function getPokemonByID($idPokemon) {
        $urlPokeAPI = "https://pokeapi.co/api/v2/";                
        $urlPokeAPI .= "pokemon/" . $idPokemon;
        $jsonPokemon = file_get_contents($urlPokeAPI);
        $arrPokemon = json_decode($jsonPokemon, true);         
        return $arrPokemon;
    }

    public static function getPokemonNameByID($id){
        $url = self::$urlPokeAPI . "pokemon/" . $id;
        $jsonPokemon = file_get_contents($url);
        $arrPokemon = json_decode($jsonPokemon, true);  
        $namePokemon = $arrPokemon["forms"][0]["name"];
        return $namePokemon;
    }

    public static function getRandomPokemon() {
        $idPokemon = rand(1,1025);
        $urlPokeAPI .= "pokemon/" . $idPokemon;
        $jsonPokemon = file_get_contents($urlPokeAPI);
        $arrPokemon = json_decode($jsonPokemon, true);        
        return $arrPokemon;
    }    


    public static function getPokemonImageById($id) {
        $imagePath = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/";
        $extension = ".png";
        return $imagePath . $id . $extension;
    }
}

?>
