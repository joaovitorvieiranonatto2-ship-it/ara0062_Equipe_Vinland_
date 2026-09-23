// ===========================================================================
// ARA0062 — comportamento da página
// Loja Vórtex Geek — Equipe Vinland — Ciclo 6
//
// Este arquivo estava vazio desde o ciclo 3, só ligado ao index.html por
// <script src="js/script.js" defer></script>. A partir de agora ele guarda
// O QUE a página FAZ — a terceira camada, depois do HTML (o que ela É, nos
// ciclos 2 e 3) e do CSS (como ela PARECE, nos ciclos 4 e 5).
//
// A regra do ciclo 6, irmã da regra do CSS: nada de onclick="" no HTML.
// Comportamento mora aqui. O <button id="botao-tema"> e o <link
// id="tema-noite"> só têm id no index.html — quem decide o que acontece a
// cada clique ou a cada tecla é este arquivo.
//
// Três peças, nesta ordem:
//   1. A saudação   — a página decide o que dizer, pela hora de quem visita.
//   2. O tema        — um clique liga e desliga o tema-noite.css.
//   3. O contador    — o campo de mensagem do contato avisa quanto ainda cabe.
// ===========================================================================


// ---------------------------------------------------------------------------
// 1. A SAUDAÇÃO
//
// new Date().getHours() pergunta a hora ao computador de QUEM ESTÁ COM A
// PÁGINA ABERTA agora — nunca ao servidor que a hospeda. Se o servidor
// estivesse em Belo Horizonte e alguém abrisse a página em Tóquio às 23h
// daqui, a saudação seria a de lá (11h da manhã), não a daqui.
//
// if / else if / else para no primeiro teste verdadeiro: se a hora já
// passou de 12, o "hora < 12" nem é testado de novo.
// ---------------------------------------------------------------------------
const saudacao = document.querySelector("#saudacao");

const hora = new Date().getHours();
let cumprimento;

if (hora < 12) {
  cumprimento = "Bom dia";
} else if (hora < 18) {
  cumprimento = "Boa tarde";
} else {
  cumprimento = "Boa noite";
}

saudacao.textContent = `${cumprimento}! Bem-vindo à Loja Vórtex Geek.`;


// ---------------------------------------------------------------------------
// 2. O TEMA
//
// O <link id="tema-noite"> já está no <head> do index.html, mas começa
// DESLIGADO (disabled): a página abre no tema claro. temaNoite.disabled =
// !temaNoite.disabled vira o valor para o contrário a cada clique — é um
// interruptor, não uma cor.
//
// botaoTema.addEventListener("click", trocarTema) entrega a FUNÇÃO ao
// navegador, sem parênteses depois do nome: com parênteses, ela rodaria
// uma vez agora mesmo, ao carregar a página, e nunca mais — o clique não
// faria nada.
// ---------------------------------------------------------------------------
const botaoTema = document.querySelector("#botao-tema");
const temaNoite = document.querySelector("#tema-noite");

function trocarTema() {
  temaNoite.disabled = !temaNoite.disabled;

  if (temaNoite.disabled) {
    botaoTema.textContent = "Tema escuro";
  } else {
    botaoTema.textContent = "Tema claro";
  }
}

botaoTema.addEventListener("click", trocarTema);


// ---------------------------------------------------------------------------
// 3. O CONTADOR DA MENSAGEM
//
// O <textarea id="mensagem-contato"> já tem maxlength="500" no HTML — é o
// próprio navegador que impede passar de 500 caracteres, sem precisar de
// nenhuma linha aqui. Este trecho só AVISA quanto ainda cabe, a cada tecla
// (evento "input").
//
// .value é o texto do campo agora; .length, o tamanho dele. Quando
// restarem menos de 50 caracteres, a classe "alerta" entra — quem decide
// a COR do aviso é o estilo.css, não este arquivo (o JavaScript decide
// QUANDO muda; o CSS decide COMO fica).
// ---------------------------------------------------------------------------
const campoMensagem = document.querySelector("#mensagem-contato");
const contadorMensagem = document.querySelector("#contador-mensagem");

function contarCaracteres() {
  const restam = campoMensagem.maxLength - campoMensagem.value.length;
  contadorMensagem.textContent = `Restam ${restam} caracteres`;

  if (restam < 50) {
    contadorMensagem.classList.add("alerta");
  } else {
    contadorMensagem.classList.remove("alerta");
  }
}

campoMensagem.addEventListener("input", contarCaracteres);
contarCaracteres(); // mostra o número certo assim que a página abre, antes de qualquer tecla