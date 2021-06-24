# ADTsys Api Test

Api desenvolvida utilizando o micro-framework Lumen, essa api consiste
em consumir 2 APIs de diferentes fontes de dados com intuito de agregar as informações e solucionar o problema de acordo com o que foi proposto
informando uma cidade de qualquer lugar do mundo e de acordo com as condições climáticas desta cidade exibe um Pokémon baseado em seu tipo (fogo, água, elétrico, etc),
segue abaixo uma explicação de como rodar o projeto e algumas informações adcionais.

### Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:

    Composer
    PHP >= 7.3
    OpenSSL PHP Extension
    PDO PHP Extension
    Mbstring PHP Extension
    Git

Além disto é bom ter um editor para trabalhar com o código como [VSCode](https://code.visualstudio.com/)

### 🛠 Tecnologias

As seguintes ferramentas foram usadas na construção do projeto:

- [Php](https://www.php.net/manual/pt_BR/intro-whatis.php)
- [Lumen](https://lumen.laravel.com/docs/8.x)
- [Git](https://git-scm.com/)
- [Insomnia](https://insomnia.rest/download)
- [PhpStorm](https://www.jetbrains.com/pt-br/phpstorm/)

### API Externas Utilizadas
-  OpenWeatherMap (https://openweathermap.org/)
-  PokéAPI (https://pokeapi.co/)

### API Routes
| HTTP Method	| Path | Action | Scope | Desciption  |
| ----- | ----- | ----- | ---- |------------- |
| GET      | /searchByCity/{city} | searchByCity | pokemon:getPokemon | Get pokemon 

### Adquirindo APPID na OpenWeatherMap
- Acesse o link da plataforma em https://openweathermap.org/;
- No topo da página procure e clique no botão de “Sign UP”;
- Entre com as suas credenciais e crie um novo acesso, para que possa gerar um `APPID`, na plataforma;
- Quando estiver logado, procure e clique no botão “API Keys”;
- Ao ser direcionado para a próxima página visualize um pequeno formulário chamado “Create Key”;
- No input “Name”, coloque o nome que achar mais conveniente, por exemplo: “Default”;
- Em seguida clique no botão “Generate”;
- Ao lado do formulário uma “Key” (chave), será gerada com o nome que você informou no passo anterior, essa chave é o que a plataforma chama de `APPID` e será utilizada ao realizarmos as requisições Rest para as API(s) da plataforma.

### 🎲 Rodando a API

```bash
# Clone este repositório
$ https://github.com/Mario-Celso/ADTsysBackTest.git

# Acesse a pasta do projeto no terminal/cmd
$ cd ADTsysBackTest

# Instale as dependências
$ composer install

# Vá ate o arquivo .env e cole a sua chave APPID adquirida na OpenWeatherMap

# Execute a aplicação em modo de desenvolvimento
$ composer start

# O servidor inciará na porta:5000 - acesse <http://localhost:5000>
