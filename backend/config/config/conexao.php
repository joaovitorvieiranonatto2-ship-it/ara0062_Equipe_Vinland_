<?php
/* ===========================================================================
   ARA0062 — conexão com o banco de dados
   Aula 09 (prática 4) — Loja Vórtex Geek, Equipe Vinland.

   Este arquivo não mostra nada na tela: ele só abre a conexão e a guarda
   na variável $conexao. Quem precisa do banco o inclui com

       require "config/conexao.php";

   e passa a ter a $conexao pronta para usar. Assim, os dados de acesso
   ficam num lugar só: mudou a senha, muda aqui.

   Nada de HTML aqui: o backend recebe, confere e grava; quem desenha a tela
   é o frontend.
   =========================================================================== */


/* ---------------------------------------------------------------------------
   1. OS DADOS DE ACESSO

   São os do MySQL do XAMPP, iguais em todos os computadores: o usuário
   root, sem senha. Num servidor de verdade, o usuário seria outro, a
   senha seria forte — e este arquivo não iria para um repositório público.
   --------------------------------------------------------------------------- */
$servidor = "localhost";
$banco    = "vortex_geek";
$usuario  = "root";
$senha    = "";


/* ---------------------------------------------------------------------------
   2. A CONEXÃO

   PDO é o jeito do PHP conversar com bancos de dados. new PDO(...) abre
   a conexão e devolve um objeto: a $conexao, que sabe mandar SQL para o
   banco e trazer a resposta.

   O primeiro texto diz qual banco e onde: mysql (o MariaDB do XAMPP fala
   a língua do MySQL), o servidor, o nome do banco e o charset — utf8mb4,
   o mesmo do banco, para o acento não virar Ã©.

   Se algo der errado (o MySQL desligado, o nome do banco errado), a página
   para aqui com "Fatal error: Uncaught PDOException" e o motivo:
     [1049] Unknown database 'vortex_geeek'      → o nome do banco
     [2002] Nenhuma conexão pôde ser feita  → o MySQL não está verde
   --------------------------------------------------------------------------- */
$conexao = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8mb4",
                   $usuario, $senha);
