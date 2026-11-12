<?php
/* ===========================================================================
   ARA0062 — testa a conexão com o banco
   Aula 09 (prática 4).

   Abra pelo servidor:
     http://localhost/<pasta-do-projeto>/backend/teste-conexao.php

   Se aparecer a frase, a conexão abriu. Se aparecer "Fatal error", leia
   o número entre colchetes: o comentário de config/conexao.php diz o que
   cada um quer dizer.

   É um arquivo de teste: depois da prática 5, ele pode ser apagado.
   =========================================================================== */

require "config/conexao.php";

echo "Conectado ao banco $banco!";
