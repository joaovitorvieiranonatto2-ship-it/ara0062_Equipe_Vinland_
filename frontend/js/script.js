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
//   4. Funções de apoio — temNumero, contarDigitos, tirarEspacosDuplos.
//   5. O contato     — o formulário confere antes de enviar.
//   6. A entrega     — o formulário de pedido confere antes de enviar.
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


// ---------------------------------------------------------------------------
// 4. FUNÇÕES DE APOIO (aula 07, práticas 6 e 7)
//
// Um texto é uma fila de caracteres, numerados a partir do ZERO: em "Ana",
// texto[0] é "A", texto[1] é "n" e texto[2] é "a". texto.length é 3, e o
// último índice é 2 — sempre um a menos que o tamanho.
//
// O for passa por cada posição, da 0 até a última:
//   let i = 0             começa no zero
//   i < texto.length      continua enquanto houver letra
//   i++                   depois de cada volta, soma um
//
// Cada função ENTREGA a resposta com return: quem chamou temNumero(nome)
// recebe true ou false, e pode usar isso direto num if.
// ---------------------------------------------------------------------------

// true se achar algum número no texto. O break para o laço na hora: não
// adianta olhar o resto depois que achou.
function temNumero(texto) {
  let achou = false;

  for (let i = 0; i < texto.length; i++) {
    if ("0123456789".includes(texto[i])) {
      achou = true;
      break;
    }
  }

  return achou;
}

// quantos números há no texto: "(31) 99999-0000" tem 11. Aqui o laço vai
// até o fim, porque é preciso contar todos.
function contarDigitos(texto) {
  let quantos = 0;

  for (let i = 0; i < texto.length; i++) {
    if ("0123456789".includes(texto[i])) {
      quantos++;
    }
  }

  return quantos;
}

// trim() tira os espaços das pontas; o while tira os espaços duplos do meio.
// "Ana    Maria" vira "Ana Maria". O while repete ENQUANTO a condição for
// verdadeira, e serve quando não se sabe quantas voltas serão: um espaço
// duplo, ou dez. Se a condição nunca ficasse falsa, a aba travaria.
function tirarEspacosDuplos(texto) {
  texto = texto.trim();

  while (texto.includes("  ")) {
    texto = texto.replace("  ", " ");
  }

  return texto;
}


// ---------------------------------------------------------------------------
// 5. O CONTATO CONFERE ANTES DE ENVIAR (aulas 07 e 08)
//
// O HTML já confere o que ele sabe: o required barra o campo vazio, o
// type="email" barra o e-mail sem @ e o maxlength barra o texto longo. Mas o
// HTML não sabe que "Al" é curto demais para um nome, nem que "X Æ A-12" tem
// número. Essas são regras DESTE formulário, e quem as confere é o
// JavaScript.
//
// A ordem do que acontece no clique em Enviar mensagem:
//   1. o navegador confere o HTML (required, type, maxlength). Se algo
//      falhar, ele mostra o balão dele e PARA: o evento submit nem acontece;
//   2. passou no HTML, o navegador dispara o evento "submit" no <form>;
//   3. a function conferirContato roda e decide o que dizer.
//
// O if testa de cima para baixo e para no primeiro verdadeiro. Por isso o
// aviso mostra UM problema de cada vez: o primeiro que encontrar.
//   ||  "ou": basta UM dos lados ser verdadeiro
//
// preventDefault() cancela o comportamento de fábrica, que é enviar os dados
// para o action do <form>. Ele está DENTRO de cada ramo de problema: no
// ramo do "Tudo certo", ninguém cancela nada — e o navegador envia ao PHP.
//
// E uma verdade da aula 08: a validação do navegador é CONFORTO para quem
// preenche, não segurança. Com o JavaScript desligado, o PHP recebe tudo.
// ---------------------------------------------------------------------------
const campoNomeContato = document.querySelector("#nome-contato");
const formContato = document.querySelector("#form-contato");
const avisoContato = document.querySelector("#aviso-contato");

function conferirContato(evento) {
  const nome = tirarEspacosDuplos(campoNomeContato.value);
  campoNomeContato.value = nome;   // devolve ao campo o nome já arrumado

  if (nome.length < 3 || nome.length > 60) {
    evento.preventDefault();
    avisoContato.textContent = "O nome precisa ter entre 3 e 60 letras.";
  } else if (temNumero(nome)) {
    evento.preventDefault();
    avisoContato.textContent = "O nome não pode ter números.";
  } else if (campoMensagem.value.trim().length < 10) {
    evento.preventDefault();
    avisoContato.textContent = "Conte um pouco mais na mensagem (mínimo 10).";
  } else {
    // nada de preventDefault aqui: o envio segue para o PHP
    avisoContato.textContent = "Tudo certo! Enviando…";
  }
}

// O evento é "submit", e ele é do <form> — não do botão. Assim a conferência
// roda também quando alguém aperta Enter dentro de um campo.
formContato.addEventListener("submit", conferirContato);


// ---------------------------------------------------------------------------
// 6. A ENTREGA CONFERE ANTES DE ENVIAR (aula 09)
//
// A mesma receita da seção 5, para o formulário de retirada ou entrega.
// A regra nova é a do telefone: contarDigitos conta só os números, e
// "(31) 99999-0000" vale — são 11, com o DDD. O Brasil usa 10 (fixo) ou
// 11 (celular).
// ---------------------------------------------------------------------------
const campoNomeCliente = document.querySelector("#nome-cliente");
const campoEndereco = document.querySelector("#endereco-entrega");
const campoTelefone = document.querySelector("#telefone-cliente");
const formEntrega = document.querySelector("#form-entrega");
const avisoEntrega = document.querySelector("#aviso-entrega");

function conferirEntrega(evento) {
  const nome = tirarEspacosDuplos(campoNomeCliente.value);
  campoNomeCliente.value = nome;

  const digitos = contarDigitos(campoTelefone.value);

  if (nome.length < 3 || nome.length > 60) {
    evento.preventDefault();
    avisoEntrega.textContent = "O nome precisa ter entre 3 e 60 letras.";
  } else if (temNumero(nome)) {
    evento.preventDefault();
    avisoEntrega.textContent = "O nome não pode ter números.";
  } else if (campoEndereco.value.trim().length < 5) {
    evento.preventDefault();
    avisoEntrega.textContent = "Escreva o endereço com rua e número.";
  } else if (digitos < 10 || digitos > 11) {
    evento.preventDefault();
    avisoEntrega.textContent = "O telefone precisa ter o DDD e 10 ou 11 números.";
  } else {
    avisoEntrega.textContent = "Tudo certo! Enviando…";
  }
}

formEntrega.addEventListener("submit", conferirEntrega);
