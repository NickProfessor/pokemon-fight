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
  <script>
    function escolherPokemonID(pokemonID){
      document.getElementById('idPokemonJogador').value =  pokemonID;
      guardarIDPokemonSelecionado(pokemonID)
    }

    function definirPokemonAleatorio(){
      var idPokemonFoto = document.getElementById('idPokemonAleatorio').value = Math.floor(Math.random() * 1045);
      document.getElementById('imagemAleatorio').src = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/"+idPokemonFoto+".png"
      guardarIDPokemonAleatorio(idPokemonFoto);
    }


    function guardarIDPokemonAleatorio(idPokemon) {
    var valor = idPokemon;
    localStorage.setItem("idPokemonAleatorio", valor);
}

  function guardarIDPokemonSelecionado(idPokemon) {
    var valor = idPokemon;
    localStorage.setItem("idPokemonSelecionado", valor);
  }

    let selectedDiv = null


    function selecionaADiv(div){
        if (selectedDiv !== null) {
            selectedDiv.classList.remove("campo-do-pokemon-escolhido");
        }

        div.classList.add("campo-do-pokemon-escolhido");
        selectedDiv = div;

        const camposDePokemon = document.querySelectorAll(".campo-do-pokemon");
        const nomeDoPokemonEscolhido = document.getElementById('nomeDoPokemonEscolhido');
        const index = Array.from(camposDePokemon).indexOf(div);

        // Definir nomes para as posições no array, foi necessário pois
        // a página estava muito lenta!
        let nomePokemon;
        if (index === 0) {
            nomePokemon = "Blastoise";
        } else if (index === 1) {
            nomePokemon = "Beedrill";
        } else if (index === 2) {
            nomePokemon = "Pikachu";
        } else if (index === 3) {
            nomePokemon = "Ninetails";
        } else if (index === 4) {
            nomePokemon = "Alakazam";
        } else if (index === 5) {
            nomePokemon = "Machamp";
        } else if (index === 6) {
            nomePokemon = "Mr Mime";
        } else if (index === 7) {
            nomePokemon = "Gyarados";
        } else if (index === 8) {
            nomePokemon = "Mewtwo";
        } else if (index === 9) {
            nomePokemon = "Entei";
        } else if (index === 10) {
            nomePokemon = "Lugia";
        } else{
            nomePokemon = "Rayquaza";
          }

        nomeDoPokemonEscolhido.textContent = nomePokemon;
    }
  
    function enviarFormulario(){
      document.getElementById("meuFormulario").submit();
    }
  </script>

  <?php include ("inc/header.php");  ?>
<div class="completaTela">
  <div class="parteDeCima">
    <div class=" container-principal">
      <div class="col-6 parte-esquerda">
        <div class="container container-pokemons">
          <h3 class="texto-selecione">Selecione seu pokemon!</h3>
          <h3 id="nomeDoPokemonEscolhido" class="pokemonEscolhido"></h3>
<?php 
          $arrPokemonID = array(9, 15, 25, 38, 65, 68, 122, 130, 150, 244, 249, 384);
          foreach ($arrPokemonID as $pokemonID) {
            $imgPkn = Pokemon::getPokemonImageById($pokemonID); 
            echo '<div class=" campo-do-pokemon">';
            echo '<img src="' . $imgPkn . '" class="img-fluid  imagem-do-pokemon"  alt="Pokémon para escolher" onclick="escolherPokemonID('.$pokemonID.');selecionaADiv(this.parentNode)">';
            echo '</div>';     
          }
?>
        
        </div>
        
      </div>

      <div class="col-6 ">
        <div class="container-pokemon-aleatorio">
          <h3>Conheça seu adversário!</h3>
          <img src="img/ash.png" class="img-fluid mb-3" 
          alt="Pokémon" id="imagemAleatorio">
          <button class="" onclick="definirPokemonAleatorio()">Eu escolho você!</button>
        </div>
      </div>
      <button class=" iniciarBatalha" onclick="enviarFormulario()">Combater agora</button>
    </div>
    <!-- Os pokemons serão armazenados como "value" nesses inputs abaixo: -->
    <form id="meuFormulario" action="fight.php" method="post" style="display: none;">

      <input type="hidden" id="idPokemonJogador" value="" name="idPokemonJogador">
      <input type="hidden" id="idPokemonAleatorio" value="" name="idPokemonAleatorio"> 
      </form>
        </div>

  <?php include ("inc/footer.php");  ?>
  </div>
</body>
</html>
