<?php
/* ===========================================================================
   ARA0062 — lista os pedidos guardados no banco
   Aula 09 (prática 6).

   É a página em que a equipe LÊ os pedidos que chegaram. Abra pelo servidor:
     http://localhost/<pasta-do-projeto>/backend/pedidos.php

   Ordem do arquivo:
     1. funções auxiliares
     2. buscar no banco                                        (prática 6)
     3. a página, em HTML, com uma linha da tabela por pedido

   O que esta página AINDA NÃO faz: pedir senha. Qualquer pessoa que souber
   o endereço lê os pedidos — login é assunto de uma aula própria.
   =========================================================================== */


/* ---------------------------------------------------------------------------
   1. FUNÇÕES AUXILIARES

   escapar(): tudo o que foi digitado por alguém passa por htmlspecialchars
   antes de ir para a página — inclusive o que veio do banco, porque o banco
   guarda o texto original.

   formatarData(): o banco entrega a data como 2026-10-22 19:42:10.
   strtotime() a transforma num instante, e date() a escreve do jeito
   brasileiro.
   --------------------------------------------------------------------------- */
function escapar(string $texto): string
{
    return htmlspecialchars($texto);
}

function formatarData(string $dataDoBanco): string
{
    return date("d/m/Y H:i", strtotime($dataDoBanco));
}


/* ---------------------------------------------------------------------------
   2. BUSCAR NO BANCO

   Não há nenhum valor digitado por alguém dentro do SQL: o comando é sempre
   o mesmo. Por isso basta query(), sem prepare e sem ?.

   fetchAll() traz TODAS as linhas numa lista; cada item é um pedido com
   gavetas com o nome das colunas: $p["nome"], $p["endereco"]... — como o
   $_POST tem o name dos campos.

   ORDER BY id DESC: do mais novo para o mais antigo.
   --------------------------------------------------------------------------- */
require "config/conexao.php";

$pedidos = $conexao
    ->query("SELECT * FROM pedidos ORDER BY id DESC")
    ->fetchAll();

$total = count($pedidos);


/* ---------------------------------------------------------------------------
   3. A PÁGINA

   foreach ($pedidos as $p): repete o trecho de HTML até o endforeach UMA
   VEZ PARA CADA pedido, e a cada volta $p é o pedido da vez. É o for...of
   do JavaScript.
   --------------------------------------------------------------------------- */
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos recebidos — Loja Vórtex Geek</title>
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
      <section id="pedidos">
        <h2>Pedidos recebidos</h2>

        <p class="aviso"><?= $total ?> pedido(s) no banco.</p>

        <table>
          <thead>
            <tr>
              <th>Nº</th>
              <th>Quando</th>
              <th>Nome</th>
              <th>Endereço</th>
              <th>Telefone</th>
              <th>Pagamento</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($pedidos as $p): ?>
            <tr>
              <td><?= (int) $p["id"] ?></td>
              <td><?= formatarData($p["criado_em"]) ?></td>
              <td><?= escapar($p["nome"]) ?></td>
              <td><?= escapar($p["endereco"]) ?></td>
              <td><?= escapar($p["telefone"]) ?></td>
              <td><?= escapar($p["pagamento"]) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <p><a href="../frontend/index.html#retirada">← Voltar para a página</a></p>
      </section>
    </main>

    <footer>
      <p>Equipe Vinland &middot; 2026 &middot; ARA0062 &middot; Newton Paiva</p>
    </footer>

  </body>
</html>
