-- ===========================================================================
-- ARA0062 — o banco do projeto
-- Aula 09 (práticas 1 e 2) — Loja Vórtex Geek, Equipe Vinland.
--
-- O banco de dados NÃO vai para o GitHub: ele mora no MySQL de cada
-- computador. Este arquivo vai. Com ele, qualquer pessoa da equipe (e o
-- professor) cria o mesmo banco e a mesma tabela no próprio XAMPP:
-- phpMyAdmin → aba SQL → cole este arquivo → Executar.
--
-- Em SQL, comentário de uma linha começa com dois traços e um espaço.
-- Os comandos podem ser escritos em minúsculas; as MAIÚSCULAS são só um
-- costume, para separar o que é do SQL do que é nome dado por nós.
-- ===========================================================================


-- ---------------------------------------------------------------------------
-- 1. O BANCO                                                    (prática 1)
--
-- Um banco é uma "pasta" de tabelas. utf8mb4 guarda qualquer letra — o
-- acento, o Æ e até emoji. IF NOT EXISTS: se o banco já existe, não dá erro.
-- ---------------------------------------------------------------------------
CREATE DATABASE IF NOT EXISTS vortex_geek
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE vortex_geek;


-- ---------------------------------------------------------------------------
-- 2. A TABELA DAS MENSAGENS (formulário Contato)                (prática 2)
--
-- Uma tabela é uma planilha com regras: cada COLUNA tem um nome e um tipo,
-- e cada LINHA é uma mensagem. As colunas são os campos do formulário
-- de Contato (nome, e-mail, mensagem) — mais duas que o banco preenche
-- sozinho:
--
--   id          o número da mensagem. PRIMARY KEY: não se repete nunca.
--               AUTO_INCREMENT: o banco escolhe (1, 2, 3...); ninguém envia.
--   criada_em   a data e a hora da gravação. DEFAULT CURRENT_TIMESTAMP:
--               se ninguém enviar, o banco escreve o "agora".
--
-- Os tipos:
--   INT           número inteiro
--   VARCHAR(60)   texto curto, com no máximo 60 letras (o limite do nome
--                 no JavaScript da aula 07)
--   TEXT          texto longo (a mensagem)
--   DATETIME      data e hora
--
-- NOT NULL: a coluna não pode ficar sem valor.
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS mensagens (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nome       VARCHAR(60)  NOT NULL,
    email      VARCHAR(120) NOT NULL,
    mensagem   TEXT         NOT NULL,
    criada_em  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
);


-- ---------------------------------------------------------------------------
-- 3. A TABELA DO ASSUNTO DA EQUIPE: OS PEDIDOS
--
-- Esta é a tabela do assunto de vocês — a loja. Cada LINHA é um pedido
-- feito no formulário "Retirada ou entrega" do index.html. Mesma receita
-- da tabela de cima: id e criado_em o banco preenche; o resto vem do
-- formulário.
--
--   pagamento   o VALUE do <option>: pix, cartao ou dinheiro
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS pedidos (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nome       VARCHAR(60)  NOT NULL,
    endereco   VARCHAR(150) NOT NULL,
    telefone   VARCHAR(20)  NOT NULL,
    pagamento  VARCHAR(10)  NOT NULL,
    criado_em  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
);
