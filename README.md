# Equipe Vinland — Desenvolvimento Web em HTML5, CSS, JavaScript e PHP

Projeto da disciplina **ARA0062 · Desenvolvimento Web em HTML5, CSS, JavaScript
e PHP** — Centro Universitário Newton Paiva, 2026/2.

## Assunto

**Assunto:** Loja Vórtex Geek — comércio eletrônico voltado a colecionáveis e cultura
geek (quadrinhos, mangás, board games, miniaturas e itens temáticos).

## Sobre

A Loja Vórtex Geek é uma vitrine digital para quem coleciona quadrinhos,
board games, mangás e itens de cultura pop. Pelo site, o cliente confere os
lançamentos da semana, monta o carrinho com o total calculado
automaticamente e escolhe entre retirar na loja ou receber em casa — tudo
em um só lugar, atendendo quem busca praticidade para manter a coleção em
dia.

## Identidade visual

O assunto é uma loja de quadrinhos, mangás, board games e colecionáveis. Cada
escolha abaixo parte desse universo.

**Cores:**

- **Roxo vibrante `#5b2a86` (`--principal`)** — cabeçalho, títulos, preços e
  botão de ação. É a cor das capas de quadrinho e das caixas de
  colecionáveis: chama atenção na prateleira sem ser o vermelho de
  promoção. Branco por cima dá 9,9:1 de contraste.
- **Roxo-noite `#241536` (`--barra`)** — menu e rodapé. É o fundo escuro das
  lojas geek e das capas de mangá; emoldura a página e faz o roxo principal
  parecer mais aceso.
- **Verde-azulado `#0f6e6e` (`--apoio`)** — `h3`, cabeçalho da tabela e o
  aviso do contador. Lembra o brilho de tela de videogame e as cartas de
  jogos, e é a cor complementar do roxo: separa informação secundária sem
  competir com a principal.
- **Âmbar `#ffb400` (`--realce`)** — contorno de foco dos links e campos.
  É o dourado dos itens raros e das edições especiais, que no assunto
  significa "olhe aqui"; por isso marca onde o teclado está.

**Tema escuro (`tema-noite.css`):** paleta própria — fundo roxo-quase-preto
(`#160f22`) e cor principal em verde-água néon (`#5ee6d0`), o visual de
arcade e de vitrine iluminada à noite. O arquivo tem uma regra só (`:root`):
só troca os valores das variáveis, inclusive qual logo aparece.

**Fonte:** Poppins, com Segoe UI, Arial e `sans-serif` de reserva. É uma
fonte geométrica, de traço redondo e moderno, parecida com a dos logos de
editoras de mangá e de marcas de board game — passa a ideia de loja jovem e
de cultura pop, e continua fácil de ler em tela pequena. Escala de
2,5 / 1,75 / 1,25 / 1rem entre `h1`, `h2`, `h3` e o corpo do texto.

Todo contraste de texto sobre fundo foi conferido pela fórmula de luminância
relativa do WCAG 2.1 e fica acima de 4,5:1 nos dois temas (ver comentários
no topo de `estilo.css` e `tema-noite.css`).

## Equipe

**Líder:** João Vítor Vieira Nonato

| Nome completo | Matrícula | GitHub | Papel |
|---|---|---|---|
| Bernardo Augusto Gontijo | 202602814544 | @bernardoaugustog-gif | integrante |
| Juliano Morais Santos Murta | 202602147068 | @Juliano31545 | integrante |
| João Vítor Vieira Nonato | 202601783629 | @joaovitorvieiranonatto2-ship-it | **líder** |
| Henrique Del Rio Toffalini | 202602188694 | @4kToffa | integrante |
| Isaías Daniel de Oliveira Lopes | 202602349116 | @IsaiasDanieldeOliveiraLopes | integrante |

Cada integrante acrescenta a **sua própria linha** nesta tabela, pelo GitHub.
Esse é o commit que registra a sua participação.

## Estrutura do projeto

Estrutura obrigatória da disciplina. Não renomeie pastas nem arquivos.

O projeto é separado em duas metades: **`frontend/`** guarda o que roda no
navegador (HTML, CSS, JavaScript e imagens) e **`backend/`** guarda o que roda
no servidor (PHP).

```
.
├─ README.md               este arquivo
├─ frontend/               tudo o que roda no navegador
│   ├─ index.html          a página principal
│   ├─ css/
│   │   ├─ estilo.css      tema claro do site
│   │   └─ tema-noite.css  tema escuro do site
│   ├─ js/
│   │   └─ script.js       saudação, tema, contador e validação dos formulários
│   └─ img/
│       ├─ logo_branca.png logo do tema claro
│       ├─ logo_preta.png  logo do tema escuro
│       └─ produto-*.svg   ilustração de cada card dos lançamentos (6 arquivos)
└─ backend/                tudo o que roda no servidor
    ├─ config/
    │   └─ conexao.php     a conexão com o banco (PDO)
    ├─ sql/
    │   └─ banco.sql       cria o banco e as tabelas; roda no phpMyAdmin
    ├─ processa-contato.php  recebe o formulário de contato e grava em mensagens
    ├─ processa-pedido.php   recebe o formulário de entrega e grava em pedidos
    ├─ mensagens.php       lista as mensagens guardadas
    ├─ pedidos.php         lista os pedidos guardados
    └─ teste-conexao.php   confere a conexão (pode ser apagado depois)
```

A partir do ciclo 9 os arquivos `.php` deixam de ser só um comentário: o
`processa-contato.php` e o `processa-pedido.php` gravam no banco, e
`mensagens.php` e `pedidos.php` mostram o que foi gravado.

## Cards dos lançamentos

Os itens da seção *Lançamentos da semana* deixaram de ser texto corrido: cada
um é um **card** com imagem, nome, descrição e preço.

- **HTML:** `<ul id="lista-lancamentos" class="cards">`, com um
  `<li class="card">` por item (`<img>`, `<h3 class="produto">`,
  `<p class="card-descricao">` e `<p class="preco">`).
- **CSS:** seção 13 do `estilo.css`. Uma grade (`display: grid` com
  `repeat(auto-fill, minmax(220px, 1fr))`) dá três colunas em tela larga e uma
  no celular. Só usa as variáveis do `:root`, então o tema escuro funciona sem
  regra extra.
- **Imagens:** `frontend/img/produto-*.svg` são **ilustrações provisórias**
  (`miniatura`, `manga`, `board-game`, `camiseta`, `cartas` e `caneca`). Para
  usar fotos reais, basta colocar o arquivo com o mesmo nome em `frontend/img/`
  (ou trocar a extensão no `src` do `index.html`).

## Como abrir o projeto

1. Baixe ou clone o repositório.
2. Abra a pasta no VS Code (*Arquivo → Abrir Pasta* — a pasta do projeto
   inteira, com `frontend/` e `backend/` dentro).
3. Abra `frontend/index.html` e clique em **Go Live** (extensão Live Server).

Como o `index.html` está dentro de `frontend/`, os caminhos dele ficam assim:

| Para chegar em | Escreva no `index.html` |
|---|---|
| a folha de estilos | `css/estilo.css` |
| o script | `js/script.js` |
| uma imagem | `img/foto.jpg` |
| um arquivo do backend | `../backend/processa-contato.php` |

Os dois pontos (`..`) sobem uma pasta: saem do `frontend/` antes de entrar no
`backend/`.

## Banco de dados

Os dados ficam no **MariaDB do XAMPP**, no banco `vortex_geek`. O banco **não
vai para o GitHub**; o script que o cria, sim: `backend/sql/banco.sql`.

Tabela do **assunto da equipe** — `pedidos` (um pedido por linha, feito no
formulário *Retirada ou entrega*):

| Coluna | Tipo | Quem preenche |
|---|---|---|
| `id` | `INT AUTO_INCREMENT PRIMARY KEY` | o banco: 1, 2, 3… sem repetir |
| `nome` | `VARCHAR(60)` | campo `nome-cliente` |
| `endereco` | `VARCHAR(150)` | campo `endereco-entrega` |
| `telefone` | `VARCHAR(20)` | campo `telefone-cliente` |
| `pagamento` | `VARCHAR(10)` | o `value` do `<option>`: `pix`, `cartao` ou `dinheiro` |
| `criado_em` | `DATETIME DEFAULT CURRENT_TIMESTAMP` | o banco: a hora da gravação |

Tabela `mensagens` (formulário *Contato*): `id`, `nome` (`VARCHAR(60)`),
`email` (`VARCHAR(120)`), `mensagem` (`TEXT`) e `criada_em`, preenchidos do mesmo
jeito.

| Arquivo | O que faz |
|---|---|
| `backend/sql/banco.sql` | cria o banco e as tabelas (`CREATE DATABASE`, `CREATE TABLE`) |
| `backend/config/conexao.php` | abre a conexão PDO, uma vez só; quem precisa do banco usa `require` |
| `backend/processa-pedido.php` | `INSERT` com `prepare` e `execute`, e responde com o número do pedido |
| `backend/processa-contato.php` | o mesmo, para a tabela `mensagens` |
| `backend/pedidos.php` e `backend/mensagens.php` | `SELECT` + `foreach`: a lista do que está no banco |

O `INSERT` usa `?` no lugar dos valores (nunca a variável colada no SQL): o
apóstrofo de *Joana D'Arc* não quebra o comando e não abre espaço para SQL
injection. Grava-se o texto original; a proteção da página (`htmlspecialchars`)
é feita na hora de **mostrar**.

**O que o PHP ainda não faz:** conferir os dados de novo no servidor (só o
JavaScript confere, e ele pode ser desligado) e pedir senha nas páginas de
lista. Ficam para as próximas aulas.

## Como abrir (ciclo 9)

A página **precisa do servidor**: os formulários enviam para arquivos PHP, e
quem executa PHP é o Apache. Com o Live Server ou com dois cliques no
`index.html`, a página aparece, mas o envio não funciona.

1. Ponha a pasta do projeto em `C:\xampp\htdocs`.
2. No painel do XAMPP, **Start** no Apache **e** no MySQL.
3. `http://localhost/phpmyadmin` → aba **SQL** → cole o conteúdo de
   `backend/sql/banco.sql` → **Executar**. Só uma vez por computador: ele cria o
   banco e as duas tabelas.
4. Abra `http://localhost/<pasta-do-projeto>/frontend/` e envie um pedido.
5. A resposta termina em *Pedido nº … guardado*. A lista:
   `http://localhost/<pasta-do-projeto>/backend/pedidos.php`.

## Andamento por ciclo

- [x] Ciclo 3 — repositório, equipe e estrutura do projeto
- [x] Ciclo 3 — `frontend/`: página com listas, tabela e formulário de contato
- [x] Ciclos 4 e 5 — `frontend/css/`: identidade visual, layout e responsividade
- [x] Ciclos 6 e 7 — `frontend/js/`: interação e validação dos formulários
- [ ] Ciclos 6 e 7 — `frontend/js/`: dados via JSON e carrinho de compras (ainda não feito)
- [x] Ciclo 9 — `backend/`: os dois formulários gravam no banco e as listas mostram o que foi gravado
- [x] Ciclo 9 — `frontend/`: lançamentos da semana em cards, com ilustrações provisórias
- [ ] `frontend/img/`: trocar as ilustrações por fotos reais dos produtos
- [ ] Ciclo 10 — `backend/`: conferir os dados também no servidor

## Quem fez o quê

| Integrante | Parte da folha de estilo |
|---|---|
| Bernardo Augusto Gontijo Dias | Estiliza cabeçalho, rodapé e cor padrão dos links |
| Henrique Toffalini | Cabeçalho e variáveis CSS |
| Juliano Morais | Define estilos base (reset, body e títulos) |
| João Vítor Vieira Nonato | Estiliza o layout base das sections e a lista de lançamentos |
| Isaías Daniel de Oliveira Lopes | Estiliza os formulários |

## Quem fez o quê — ciclo 9

Divisão das partes do ciclo 9. Cada integrante registra a **sua** linha pelo
GitHub (é o commit que mostra a sua participação).

| Integrante | Parte |
|---|---|
| Henrique Toffalini | o `banco.sql` (o banco e as tabelas `pedidos` e `mensagens`); o `conexao.php` e o `teste-conexao.php` |
| Juliano Morais | o `INSERT` com `prepare` e `execute` nos dois `processa-*.php`; as páginas `pedidos.php` e `mensagens.php`, com o `foreach` |
| Bernardo Augusto Gontijo Dias | o número do pedido na página de resposta e o `aviso` no CSS; as ilustrações dos produtos (`frontend/img/produto-*.svg`) |
| Isaías Daniel de Oliveira Lopes | a validação dos formulários no `script.js` e os testes no phpMyAdmin |
| João Vítor Vieira Nonato | os cards da lista de lançamentos (`index.html` e seção 13 do `estilo.css`); a organização do repositório (pastas e README) |