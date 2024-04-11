var idSelecionadoArmazenado
  var idAleatorioArmazenado
  var hpPkmnSelecionado
  var hpPkmnAleatorio
  let listaDeAtaquesAliado
  let listaDeAtaquesInimigo
  let ataqueDoAliado
  let ataqueDoInimigo
  var hpInicialPkmnSelecionado
  var hpInicialPkmnAleatorio
  let numeroVidaDoJogador
  let numeroVidaDoAdversario
  let numeroDoAtaqueAliado
  let numeroDoAtaqueInimigo
  let porcVidaJogador
  let porcVidaAdversario
  let pokemonAliadoNome
  let pokemonInimigoNome

function iniciarBatalha(){
  const campoDoHpPkmnSelecionado = document.getElementById('hpSelecionado').value;
  const campoDoHpPkmnAleatorio = document.getElementById('hpAleatorio').value;
  pokemonAliadoNome = document.getElementById('nomeDoPokemonAlidado').textContent
  pokemonInimigoNome = document.getElementById('nomeDoPokemonInimigo').textContent
  hpInicialPkmnSelecionado = campoDoHpPkmnSelecionado;
  hpInicialPkmnAleatorio = campoDoHpPkmnAleatorio;
  hpPkmnSelecionado = hpInicialPkmnSelecionado
  hpPkmnAleatorio = hpInicialPkmnAleatorio
  numeroVidaDoJogador = document.getElementById('hpAliado');
  numeroVidaDoAdversario = document.getElementById('hpInimigo');
  numeroDoAtaqueAliado = 0
  numeroDoAtaqueInimigo = 0
  porcVidaJogador = 100
  porcVidaAdversario = 100

  


  numeroVidaDoJogador.innerHTML = `${hpPkmnSelecionado}/${hpInicialPkmnSelecionado} <i class="vidaJogadorTodos">HP</i>`;
  numeroVidaDoAdversario.innerHTML = `${hpPkmnAleatorio}/${hpInicialPkmnAleatorio} <i class="vidaJogadorTodos">HP</i>`;
  
  document.getElementById('ataquesRealizadosAliado').innerHTML = ''
  document.getElementById('ataquesRealizadosInimigo').innerHTML = ''
  document.getElementById('btnIniciarBatalha').style.display = 'none';
  document.getElementById('btnExecutarAtaque').style.display = 'block';
  listaDeAtaquesAliado = document.querySelectorAll('.ataquesDoAliado');
  listaDeAtaquesInimigo = document.querySelectorAll('.ataquesDoInimigo');
  ataqueDoAliado = listaDeAtaquesAliado[0];
  ataqueDoInimigo = listaDeAtaquesInimigo[0];
  console.log("Batalha iniciada!")
}

 function executarAtaque(){
  
  document.getElementById('vidaPerdidaAliado').classList.remove('levouDano')
  ataqueDoAliado = listaDeAtaquesAliado[numeroDoAtaqueAliado]
  var lista = document.getElementById('ataquesRealizadosAliado');
  lista.insertAdjacentHTML('afterbegin', `<li class="ataque-do-pokemon" id="${ataqueDoAliado.id}">${ataqueDoAliado.name} - ${parseInt(ataqueDoAliado.value) } <i class="danoCausado">dano</i></li>`);
  hpPkmnAleatorio -= parseInt(ataqueDoAliado.value)
  numeroVidaDoAdversario.innerHTML = `${hpPkmnAleatorio}/${hpInicialPkmnAleatorio} <i class="vidaJogadorTodos">HP</i>`;
  
  document.getElementById('vidaPerdidaInimigo').textContent = "-"+parseInt(ataqueDoAliado.value)+"HP";
  document.getElementById('vidaPerdidaInimigo').classList.add('levouDano')
  porcVidaAdversario -= (parseInt(ataqueDoAliado.value) / hpInicialPkmnAleatorio) * 100
  document.querySelector('#vidaAleatorio').style.width = parseInt(porcVidaAdversario)+"%";
  numeroDoAtaqueAliado ++;
  if(numeroDoAtaqueAliado == 14){
    numeroDoAtaqueAliado = 0
  }

  if(hpPkmnAleatorio <= 0){
    document.querySelector('#vidaAleatorio').style.width = "0%"


    let vencedor = document.getElementById('nomeDoPokemonAlidado').textContent;
    mostrarVencedor(vencedor)
    return
  }




  setTimeout(() => {
    ataqueDoInimigo = listaDeAtaquesInimigo[numeroDoAtaqueInimigo]
    var lista = document.getElementById('ataquesRealizadosInimigo');
    lista.insertAdjacentHTML('afterbegin', `<li class="ataque-do-pokemon" id="${ataqueDoInimigo.id}">${ataqueDoInimigo.name} - ${ataqueDoInimigo.value} <i class="danoCausado">dano</i></li>`);
    hpPkmnSelecionado -= ataqueDoInimigo.value;

    numeroVidaDoJogador.innerHTML = `${hpPkmnSelecionado}/${hpInicialPkmnSelecionado} <i class="vidaJogadorTodos">HP</i>`;
    document.getElementById('vidaPerdidaAliado').textContent = "-"+parseInt(ataqueDoInimigo.value)+"HP";
    document.getElementById('vidaPerdidaAliado').classList.add("levouDano");

    porcVidaJogador -= (ataqueDoInimigo.value / hpInicialPkmnSelecionado) * 100
    document.querySelector('#vidaJogador').style.width = parseInt(porcVidaJogador)+"%";
    numeroDoAtaqueInimigo ++;
    document.getElementById('vidaPerdidaInimigo').classList.remove('levouDano')
    if(numeroDoAtaqueInimigo == 14){
      numeroDoAtaqueInimigo = 0
    }

    if(hpPkmnSelecionado <= 0){
    document.querySelector('#vidaJogador').style.width = "0%"

    let vencedor = document.getElementById('nomeDoPokemonInimigo').textContent;
    mostrarVencedor(vencedor)
  }
  }, 1000);

  
 }

 function mostrarVencedor(vencedor){
  document.getElementById('btnExecutarAtaque').style.display = 'none';
  document.getElementById('verResultados').style.display = 'block';
  document.querySelector('.quemGanhou').style.display = 'block';
  document.querySelector('.pokemonVencedor').innerHTML = "Pokemon vencedor: <span class = 'nomeDoPokemonVencodrMD'>"+vencedor+"</span>";

   if(vencedor.toLowerCase() == pokemonAliadoNome ){
    const containerElementos = document.querySelectorAll('.aleatorio-paginaFight')
    containerElementos.forEach(filho => {
    filho.classList.add("pokemonMorreu")
    });
    document.querySelector('#determinaQuemGanhou').value = 'venceu';
    document.querySelector('#batalhaEncerrada').textContent ="VOCÊ VENCEU! :D"
   }else{
    const containerElementos = document.querySelectorAll('.container-pokemon-aliado')
    containerElementos.forEach(filho => {
    filho.classList.add("pokemonMorreu")
    });
    document.querySelector('#determinaQuemGanhou').value = 'perdeu';
    document.querySelector('#batalhaEncerrada').textContent ="VOCÊ PERDEU! :("

   }
 }

 function enviarFormulario(){
  document.getElementById("enviarQuemGanhou").submit();
 }

 function ocultaBotao(){
    document.getElementById('verResultados').style.display = 'none';
    document.getElementById('btnExecutarAtaque').style.display = 'none';
 }

 ocultaBotao();