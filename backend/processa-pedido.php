<?php
/* ===========================================================================
   ARA0062 — recebe o formulário de retirada ou entrega do frontend
   Aula 09: o arquivo da aula 08 mais a gravação no banco (prática 5),
   na seção 2B. Loja Vórtex Geek — Equipe Vinland.

   Este arquivo roda NO SERVIDOR. Quem o executa é o PHP, chamado pelo
   Apache do XAMPP, e o que vai para o navegador é só o RESULTADO: o HTML
   lá de baixo, já com os valores no lugar. Abra a página e peça "Exibir
   código-fonte" (Ctrl + U): não há uma linha de PHP lá.

   Por isso ele só funciona aberto pelo servidor:
     http://localhost/<pasta-do-projeto>/backend/processa-pedido.php
   Com dois cliques no arquivo, ou pelo Live Server, o PHP não roda.

   Quem chega aqui é o formulário "Retirada ou entrega" do frontend/index.html:
     <form action="../backend/processa-pedido.php" method="post">

   Ordem do arquivo:
     1. o relógio do Brasil                                    (aula 08)
     2. o que chegou do formulário                             (aula 08)
     2B. guardar no banco                                      (aula 09)
     3. preparar a resposta                                    (aula 08)
     4. a página de resposta, em HTML                          (aulas 08 e 09)

   O que este arquivo AINDA NÃO faz: conferir os dados de novo no
   servidor. Com o JavaScript desligado, o X Æ A-12 continua passando — e
   agora fica gravado.
   =========================================================================== */


/* ---------------------------------------------------------------------------
   1. O RELÓGIO DO BRASIL

   date() usa o fuso horário configurado no php.ini do servidor, e o do
   XAMPP vem com Europe/Berlin — quatro ou cinco horas à frente. Esta
   linha acerta o fuso só para este arquivo.

   Toda instrução termina em ponto e vírgula, como no JavaScript. Aqui,
   esquecer o ; não é perdoado: a página inteira para com "syntax error".
   --------------------------------------------------------------------------- */
date_default_timezone_set("America/Sao_Paulo");


/* ---------------------------------------------------------------------------
   2. O QUE CHEGOU DO FORMULÁRIO

   Toda variável do PHP começa com $. Não existe let nem const: a variável
   nasce na primeira vez que recebe um valor.

   $_POST é uma variável que o PHP preenche sozinho com o que o formulário
   mandou pelo method="post". Cada campo chega com o NOME que tinha no
   atributo name do HTML:  name="nome-cliente"  vira  $_POST["nome-cliente"].

   ?? "" quer dizer "se não veio, use vazio". Sem ele, abrir este arquivo
   direto pela barra de endereço (sem passar pelo formulário) mostra
   "Warning: Undefined array key". Experimente apagar o ?? "" de uma linha
   e abrir o arquivo direto — e depois devolva.

   --------------------------------------------------------------------------- */
$nome      = $_POST["nome-cliente"] ?? "";
$endereco  = $_POST["endereco-entrega"] ?? "";
$telefone  = $_POST["telefone-cliente"] ?? "";
$pagamento = $_POST["forma-pagamento"] ?? "";


/* ---------------------------------------------------------------------------
   2B. GUARDAR NO BANCO                                 (aula 09, prática 5)

   Primeiro, uma porta: se o nome veio vazio, ninguém passou pelo
   formulário — alguém abriu este arquivo direto pela barra de endereço.
   Sem esta conferência, cada visita assim gravaria uma linha em branco.
   exit() escreve a frase e PARA o arquivo ali mesmo.
   --------------------------------------------------------------------------- */
if ($nome === "") {
    exit("Nada chegou do formulário. Envie pela página: ../frontend/index.html");
}

/* require traz para cá o que está em config/conexao.php — a partir desta
   linha, a variável $conexao existe. */
require "config/conexao.php";

/* O SQL vai com PONTOS DE INTERROGAÇÃO no lugar dos valores, e não com as
   variáveis coladas no texto. Por quê: um nome como Joana D'Arc tem um
   apóstrofo, e o apóstrofo é o que FECHA um texto no SQL. Colado, ele
   quebraria o comando — ou, escrito de propósito, mudaria o comando
   (o "Bobby Tables").

   prepare() manda o comando com os ? para o banco, que o entende ANTES de
   ver os valores. execute() manda os valores, na ordem dos ?, dentro de
   colchetes. Assim, o que a pessoa digitou é sempre dado, nunca comando.

   Repare: grava-se o texto ORIGINAL, sem htmlspecialchars. A proteção da
   página é feita na hora de MOSTRAR (seção 3 e mensagens.php).

   O id e o criado_em não estão na lista: o banco preenche os dois. */
$sql = "INSERT INTO pedidos (nome, endereco, telefone, pagamento)
        VALUES (?, ?, ?, ?)";

$comando = $conexao->prepare($sql);
$comando->execute([$nome, $endereco, $telefone, $pagamento]);

/* lastInsertId() pergunta ao banco qual id ele acabou de dar. */
$numero = $conexao->lastInsertId();




/* ---------------------------------------------------------------------------
   3. PREPARAR A RESPOSTA

   O ponto (.) junta textos: é o + do JavaScript. No PHP, o + só faz conta.

   Repare no pagamento: o que chega é o VALUE do <option> ("pix",
   "cartao", "dinheiro"), e não o texto que a pessoa leu na tela.

   htmlspecialchars troca < > & " por códigos que o navegador MOSTRA em vez
   de interpretar. Tudo o que veio de fora e vai ser escrito na página passa
   por ele.
   --------------------------------------------------------------------------- */
$carimbo = "Recebido em " . date("d/m/Y") . " às " . date("H:i") . ".";

$nomeSeguro      = htmlspecialchars($nome);
$enderecoSeguro  = htmlspecialchars($endereco);
$telefoneSeguro  = htmlspecialchars($telefone);
$pagamentoSeguro = htmlspecialchars($pagamento);


/* ---------------------------------------------------------------------------
   4. A PÁGINA DE RESPOSTA

   O ?> fecha o PHP. Daqui para baixo é HTML comum, mandado para o navegador
   do jeito que está — com exceção dos trechos <?php echo ...; ?>, em que o
   PHP volta por um instante só para escrever um valor.

   O CSS é o mesmo da página: o caminho sobe uma pasta e entra no frontend/.
   --------------------------------------------------------------------------- */
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido recebido — Loja Vórtex Geek</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../frontend/css/estilo.css">
  </head>
  <body>

    <header>
      <h1>
        <a href="../frontend/index.html" class="logo">
          <img src="../frontend/img/logo_branca.png" alt="Vortex - A sua loja geek" class="logo-normal">
          <img src="../frontend/img/logo_preta.png" alt="Vortex - A sua loja geek" class="logo-noite">
        </a>
      </h1>
      <p>Projeto da equipe Vinland — ARA0062</p>
    </header>

    <main>
      <section id="resposta">
        <h2>Obrigado, <?php echo $nomeSeguro; ?>!</h2>

        <p class="aviso">Pedido nº <?php echo $numero; ?> guardado.
           <?php echo $carimbo; ?></p>

        <p>Endereço: <strong><?php echo $enderecoSeguro; ?></strong></p>

        <p>Telefone: <?php echo $telefoneSeguro; ?></p>

        <p>Pagamento: <?php echo $pagamentoSeguro; ?></p>

        <p><a href="../frontend/index.html#retirada">← Voltar para a página</a>
           · <a href="pedidos.php">Ver todos os pedidos</a></p>
      </section>
    </main>

    <footer>
      <p>Equipe Vinland &middot; 2026 &middot; ARA0062 &middot; Newton Paiva</p>
    </footer>

  </body>
</html>
