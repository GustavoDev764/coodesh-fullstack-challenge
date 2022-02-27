# Fullstack  Challenge 🏅 2021 - Space Flight News
<p><img src="https://user-images.githubusercontent.com/59968150/155863054-6fed318c-5c78-4315-9491-6d05479a83b5.svg" /></p>

## Codigo Criado por Gustavo José

## Introdução

Este é um desafio criado pela [Coodesh](https://coodesh.com/) ver as minhas habilidades como Fullstack Developer.

Nesse desafio você deverá desenvolver uma REST API que utilizará os dados do projeto [Space Flight News](https://api.spaceflightnewsapi.net/v3/documentation), uma API pública com informações relacionadas a voos espaciais. O projeto a ser desenvolvido por você tem como objetivo criar a API permitindo assim a conexão de outras aplicações.

## Como instalar e usar o projeto (instruções)
Clone Repositório
```sh
git clone https://github.com/GustavoDev764/coodesh-fullstack-challenge.git
```
### Back-End:

entrar na pasta serve
```sh
cd serve
```

Crie o Arquivo .env
```sh
cp .env.example .env
```
Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME=FullstackChallenge
APP_URL=http://localhost:8989

MAIL_MAILER=my_mailer
MAIL_HOST=my_host
MAIL_PORT=my_port
MAIL_USERNAME=my_username
MAIL_PASSWORD=my_password
MAIL_ENCRYPTION=my_encryption
MAIL_FROM_ADDRESS=my_address
MAIL_SCHEDULING=my_scheduling_address


DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=nome_que_desejar_db
DB_USERNAME=nome_usuario
DB_PASSWORD=senha_aqui

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```
Suba os containers do projeto
```sh
docker-compose up -d
```
Acessar o container
```sh
docker-compose exec app bash
```
Instalar as dependências do projeto
```sh
composer install
```
Subi o banco dados e outras configuração
```sh
composer rt
```
Acessar o projeto
[http://localhost:8989](http://localhost:8989)

### Front-End:

entrar na pasta front
```sh
cd front
```

Crie o Arquivo .env.production.local
```sh
cp .env.example .env.production.local
```

Atualize as variáveis de ambiente do arquivo .env.production.local
```dosini
APP_URL=http://localhost:8989
```

vamos criar o build docker
```sh
docker build . -t nextjs-docker
```

vamos inicia o app
```sh
docker run -p 3000:3000 nextjs-docker
```
Acessar o projeto
[http://localhost:3000](http://localhost:3000)

**Tecnologias usadas**:
- Laravel v9
- PHP v8
- PHP Unit
- Docker
- Nodejs v16
- Nextjs v12
- Server Side Rendering (ssr)
- Reactjs v17
- TypeScript
- Scss
- Nginx
- Mysql
- Redis

### Back-End:
**Funcionalidades** - As funcionalidades implementada neste backend estão com icon :heavy_check_mark::

- :heavy_check_mark:`[GET]/api/: ` Retornar um Status: 200 e uma Mensagem "Back-end Challenge 2021 🏅 - Space Flight News"
- :heavy_check_mark:`[GET]/api/articles/:`   Listar todos os artigos da base de dados, utilizar o sistema de paginação para não sobrecarregar a REQUEST
- :heavy_check_mark:`[GET]/api/articles/{id}:` Obter a informação somente de um artigo
- :heavy_check_mark:`[POST/]api/articles/:` Adicionar um novo artigo
- :heavy_check_mark:`[PUT]/api/articles/{id}:` Atualizar um artigo baseado no `id`
- :heavy_check_mark:`[DELETE]/api/articles/{id}:` Remover um artigo baseado no `id`

:heavy_check_mark:**Obrigatório 2** - Para alimentar o seu banco de dados você deve criar um script para armazenar os dados de todos os artigos na Space Flight News API.

:heavy_check_mark:**Obrigatório 3** - Além disso você precisa desenvolver um CRON para ser executado diariamente às 9h e armazenar em seu os novos artigos ao seu banco de dados. (Para essa tarefa você poderá alterar o seu modelo de dados)

:heavy_check_mark:**Diferencial 1** Configurar Docker no Projeto para facilitar o Deploy da equipe de DevOps;

:heavy_check_mark:**Diferencial 2** Configurar um sistema de alerta se houver algum falha durante a sincronização dos artigos;

:x:**Diferencial 3** Descrever a documentação da API utilizando o conceito de Open API 3.0;

:heavy_check_mark:**Diferencial 4** Escrever Unit Tests para os endpoints da API;

### Front-End:
**Funcionalidades** - As funcionalidades implementada neste frontend estão com icon :heavy_check_mark::

:heavy_check_mark:**Obrigatório 1** - Seguir o wireframe para a página de listagem de artigos;

:heavy_check_mark:**Obrigatório 2** - Seguir a paleta de cores e as fontes definidas na imagem acima;

:heavy_check_mark:**Obrigatório 3** - Desenvolver a funcionalidade do buscador para que seja possível listar artigos que contenham as palavras no título;

:heavy_check_mark:**Obrigatório 4** - Desenvolver a funcionalidade para ordenar os artigos por data, da mais antiga para a mais nova e da mais nova para a mais antiga;

:heavy_check_mark:**Obrigatório 5** - Ao clicar no botão "Carregar mais" deve fazer uma nova requisição para carregar mais 10 artigos na página.

:x:**Diferencial 1** Desenvolver as funcionalidades para criar , atualizar e remover artigos.

:x:**Diferencial 2** Escrever Unit Tests ou E2E Test. Escolher a melhor abordagem e biblioteca;

:heavy_check_mark:**Diferencial 3** Configurar Docker no Projeto para facilitar o Deploy da equipe de DevOps;

>  This is a challenge by [Coodesh](https://coodesh.com/)
