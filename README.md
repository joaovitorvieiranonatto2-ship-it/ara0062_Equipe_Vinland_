# Equipe Vinland — Desenvolvimento Web em HTML5, CSS, JavaScript e PHP

Projeto da disciplina **ARA0062 · Desenvolvimento Web em HTML5, CSS, JavaScript
e PHP** — Centro Universitário Newton Paiva, 2026/2.

## Assunto

Loja Vórtex Geek — comércio eletrônico voltado a colecionáveis e cultura
geek (quadrinhos, mangás, board games, miniaturas e itens temáticos).

## Sobre

A Loja Vórtex Geek é uma vitrine digital para quem coleciona quadrinhos,
board games, mangás e itens de cultura pop. Pelo site, o cliente confere os
lançamentos da semana, monta o carrinho com o total calculado
automaticamente e escolhe entre retirar na loja ou receber em casa — tudo
em um só lugar, atendendo quem busca praticidade para manter a coleção em
dia.

## Identidade visual

- **Cor principal:** roxo vibrante (`--principal`), usado no cabeçalho,
  nos títulos e no botão de ação principal — remete a capas de quadrinho e
  embalagens de colecionáveis.
- **Cor de apoio:** verde-azulado (`--apoio`), usado no `h3` e no
  cabeçalho da tabela.
- **Realce:** âmbar (`--realce`), reservado ao contorno de foco dos
  campos e links, para acessibilidade de teclado.
- **Tema escuro (`tema-noite.css`):** paleta própria, criada do zero para
  este projeto — fundo roxo-quase-preto, superfície mais clara que o
  fundo e cor principal em verde-água néon, com o hover clareando em vez
  de escurecer. Nenhum valor de cor é repetido entre os dois temas nem
  copiado do exemplo dado em aula.
- **Tipografia:** Poppins como fonte principal, com escala de 2,5 / 1,75 /
  1,25 / 1rem entre `h1`, `h2`, `h3` e o corpo do texto.
- Todo contraste de texto sobre fundo foi conferido pela fórmula de
  luminância relativa do WCAG 2.1 e fica acima de 4,5:1 nos dois temas
  (ver comentários no topo de `estilo.css` e `tema-noite.css`).

## Equipe

**Líder:** João Vítor Vieira Nonato

| Nome completo | Matrícula | GitHub | Papel |
|---|---|---|---|
| Bernardo Augusto Gontijo | 202602814544 | @bernardoaugustog-gif | integrante |
| Juliano Morais Santos Murta | 202602147068 | @Juliano31545 | integrante |
| João Vítor Vieira Nonato | 202601783629 | @joaovitorvieiranonatto2-ship-it | **líder** |
| Henrique Del Rio Toffalini | 202602188694 | @4kToffa | integrante |
| Isaías Daniel de Oliveira Lopes | 202602349116 | @IsaiasDanieldeOliveiraLopes
 | integrante |

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
│   │   └─ script.js       comportamento da página (a partir do ciclo 6)
│   └─ img/
│       └─ .gitkeep        arquivo vazio que segura a pasta no Git
└─ backend/                tudo o que roda no servidor
    ├─ config/
    │   └─ conexao.php     conexão com o banco (a partir do ciclo 8)
    └─ processa-contato.php  recebe o formulário (a partir do ciclo 8)
```

Os dois arquivos `.php` começam vazios, só com um comentário dentro. Eles
existem desde já para que o lugar do código de servidor esteja combinado quando
o PHP chegar.

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

## Andamento por ciclo

- [x] Ciclo 3 — repositório, equipe e estrutura do projeto
- [x] Ciclo 3 — `frontend/`: página com listas, tabela e formulário de contato
- [x] Ciclos 4 e 5 — `frontend/css/`: identidade visual, layout e responsividade
- [ ] Ciclos 6 e 7 — `frontend/js/`: interação, validação e dados via JSON
- [ ] Ciclos 8 a 10 — `backend/`: formulário que grava e lista do banco

## Quem fez o quê

| Integrante | Parte da folha de estilo |
|---|---|
| Bernardo Augusto Gontijo Dias | Estiliza cabeçalho, rodapé e cor padrão dos links |
| Henrique Toffalini | Cabeçalho e variáveis CSS |
| Juliano Morais | Define estilos base (reset, body e títulos) |
| João Vítor Vieira Nonato | Estiliza o layout base das sections e a lista de lançamentos |
| Isaías Daniel de Oliveira Lopes | Estiliza os formulários |