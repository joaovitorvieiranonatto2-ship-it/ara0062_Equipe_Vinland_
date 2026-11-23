<?php
/* ===========================================================================
   ARA0062 — lista as mensagens guardadas no banco
   Aula 09 (prática 6).

   É a página em que a equipe LÊ o que chegou. Abra pelo servidor:
     http://localhost/<pasta-do-projeto>/backend/mensagens.php

   Ordem do arquivo:
     1. funções auxiliares
     2. buscar no banco                                        (prática 6)
     3. a página, em HTML, com uma linha da tabela por mensagem

   O que esta página AINDA NÃO faz: pedir senha. Qualquer pessoa que souber
   o endereço lê as mensagens — login é assunto de uma aula própria.
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

   fetchAll() traz TODAS as linhas numa lista; cada item é uma mensagem com
   gavetas com o nome das colunas: $m["nome"], $m["email"]...

   ORDER BY id DESC: da mais nova para a mais antiga.
   --------------------------------------------------------------------------- */
require "config/conexao.php";

$mensagens = $conexao
    ->query("SELECT * FROM mensagens ORDER BY id DESC")
    ->fetchAll();

$total = count($mensagens);


/* ---------------------------------------------------------------------------
   3. A PÁGINA

   foreach ($mensagens as $m): repete o trecho de HTML até o endforeach UMA
   VEZ PARA CADA mensagem, e a cada volta $m é a mensagem da vez. É o
   for...of do JavaScript.
   --------------------------------------------------------------------------- */
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagens recebidas — Loja Vórtex Geek</title>
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
      <section id="mensagens">
        <h2>Mensagens recebidas</h2>

        <p class="aviso"><?= $total ?> mensagem(ns) no banco.</p>

        <table>
          <thead>
            <tr>
              <th>Nº</th>
              <th>Quando</th>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Mensagem</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($mensagens as $m): ?>
            <tr>
              <td><?= (int) $m["id"] ?></td>
              <td><?= formatarData($m["criada_em"]) ?></td>
              <td><?= escapar($m["nome"]) ?></td>
              <td><?= escapar($m["email"]) ?></td>
              <td><?= escapar($m["mensagem"]) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <p><a href="../frontend/index.html#contato">← Voltar para a página</a></p>
      </section>
    </main>

    <footer>
      <p>Equipe Vinland &middot; 2026 &middot; ARA0062 &middot; Newton Paiva</p>
    </footer>

  </body>
</html>