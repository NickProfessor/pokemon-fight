<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pokémon Fight</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>



<?php 
    include ("inc/header.php");  
    $pokemonEscolhido = $_POST['idPokemonJogador'];
    $pokemonAleatorio = $_POST['idPokemonAleatorio'];
?> 

    <div class="parteDeCima">
      <div class=" container-principal">
        <div class="quemGanhou">
          <h1 class="batalhaEncerrada" id="batalhaEncerrada">Batalha encerrada!</h1>
          <h4 class="pokemonVencedor">Pokemon vencedor:</h4>
          </div>
          <div class="col-6 parte-esquerda">
          <div class="container container-pokemons container-pokemon-aliado">
            <!-- Inserir nome e imagem do pokemon selecionado pelo usuario! -->
            <div class="containerVidaPerdida" id="containerVidaPerdidaAliado">
              <p class="vidaPerdida" id="vidaPerdidaAliado">-32 HP</p>
            </div>
            <?php
              $nomePokemon = Pokemon::getPokemonNameByID($pokemonEscolhido);
              $imgPkn = Pokemon::getPokemonImageById($pokemonEscolhido); 
            echo '<h3 class="texto-selecione" id="nomeDoPokemonAlidado">'.$nomePokemon.'</h3>';
            echo '<div class="status-jogador">';
              
             echo '<img src="'.$imgPkn.'" class="img-fluid mb-3" alt="Pokémon" id="imagemAliado">';
             echo '<div class="vidaDoJogador" >';
             echo '<div class="vidaRestante" id="vidaJogador"></div>';
             echo '<h4 class="hpAliado" id="hpAliado">???/??? <i class="vidaJogadorTodos">HP</i></h4>';
             echo '</div>';
             
            echo '</div>';
            ?>
            <!-- Lista de ataques: cada ataque deverá ser armazenado dentro dessa lista como: 
            <li class="ataque-do-pokemon">Ataque - Quantidade de dano</li> para o estilo ser aplicado corretamente -->
            <ul class="lista-de-ataques" id="ataquesRealizadosAliado">
              <li class="ataque-do-pokemon">Ataque - ?? <i class="danoCausado">dano</i></li>
              <li class="ataque-do-pokemon">Ataque - ?? <i class="danoCausado">dano</i></li>
              <li class="ataque-do-pokemon">Ataque - ?? <i class="danoCausado">dano</i></li>
            </ul>
          
          </div>
          
        </div>

        <div class="col-6 ">
          <div class="container container-pokemons container-pokemon-aleatorio aleatorio-paginaFight">
            <!-- Inserir nome e imagem do pokemon escolhido aleatoriamente! -->
            <div class="containerVidaPerdida" id="containerVidaPerdidaInimigo">
              <p class="vidaPerdida" id="vidaPerdidaInimigo">-32 HP</p>
            </div>
            <?php
              $nomePokemon = Pokemon::getPokemonNameByID($pokemonAleatorio);
              $imgPkn = Pokemon::getPokemonImageById($pokemonAleatorio); 
            echo '<h3 class="nomeDoPokemonAleatorio" id="nomeDoPokemonInimigo">'.$nomePokemon.'</h3>';
            echo '<div class="status-jogador">';
              
             echo '<img src="'.$imgPkn.'" class="img-fluid mb-3" alt="Pokémon" id="imagemAleatorio">';
             echo '<div class="vidaDoJogador" >';
             echo '<div class="vidaRestante" id="vidaAleatorio"></div>';
             echo '<h4 class="hp" id="hpInimigo">???/??? <i class="vidaJogadorTodos">HP</i></h4>';
             echo '</div>';
             
            echo '</div>';
            ?>
            
            <!-- Lista de ataques: cada ataque deverá ser armazenado dentro dessa lista como: 
            <li class="ataque-do-pokemon">Ataque - Quantidade de dano</li> para o estilo ser aplicado corretamente -->
            <ul class="lista-de-ataques" id="ataquesRealizadosInimigo">
              <li class="ataque-do-pokemon">Ataque - ?? <i class="danoCausado">dano</i></li>
              <li class="ataque-do-pokemon">Ataque - ?? <i class="danoCausado">dano</i></li>
              <li class="ataque-do-pokemon">Ataque - ?? <i class="danoCausado">dano</i></li>
            </ul>
          </div>
        </div>
        <h3 class="versus">V.S.</h3>
        <button onclick="iniciarBatalha()" id="btnIniciarBatalha" class="iniciarBatalha">COMEÇAR A BATALHA!</button>
        <button onclick="executarAtaque()" id="btnExecutarAtaque" class="iniciarBatalha">ATACAR!</button>
        <a href="index.php" id="verResultados"> <button class="iniciarBatalha verResultados">JOGAR NOVAMENTE</button></a>
      </div>
        <!-- ToDo: colocar o link no botão -->
        <?php
        
        echo '<input type="hidden" id="hpSelecionado" value="'.Pokemon::getPokemonHP($pokemonEscolhido).'" name="">';
        echo '<input type="hidden" id="hpAleatorio" value="'.Pokemon::getPokemonHP($pokemonAleatorio).'" name=""> ';
        
        $attacksAliado = Pokemon::getPokemonAttacks($pokemonEscolhido);
        $attacksInimigo = Pokemon::getPokemonAttacks($pokemonAleatorio);
        foreach ($attacksAliado as $attack) {
          echo '<input type="hidden" class="ataquesDoAliado" id="ataqueAli'.$attack['id'].'" value="'.$attack['forca'].'" name="'.$attack['ataque'].'">';
        }

        foreach ($attacksInimigo as $attack) {
          echo '<input type="hidden" class="ataquesDoInimigo" id="ataqueIni'.$attack['id'].'" value="'.$attack['forca'].'" name="'.$attack['ataque'].'">';
      }
        ?>

    </div>
 
    <
      <input type="hidden" name="determinaQuemGanhou" value="venceu" id="determinaQuemGanhou">
      <!-- Outros inputs necessários -->

    </form>
        

  <?php include ("inc/footer.php");  ?>

  <script src="./luta.js">
  
  </script>
</body>
</html>