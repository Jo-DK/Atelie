<div align="center" id="top"> 
  <img src="./.github/app.gif" alt="Ateliê da Propaganda" />

  &#xa0;

  <!-- <a href="https://localatelie.netlify.app">Demo</a> -->
</div>

<h1 align="center">Ateliê da Propaganda</h1>

<p align="center">
  <img alt="Github top language" src="https://img.shields.io/badge/Language-PHP-blue">

  <img alt="Github issues" src="https://img.shields.io/badge/API-RESTFull-black">

  <img alt="Github languages" src="https://img.shields.io/badge/Database-MySql-red" />

  <!-- <img alt="Github forks" src="https://img.shields.io/github/forks/Jo-DK/local-atelie?color=56BEB8" /> -->

  <!-- <img alt="Github stars" src="https://img.shields.io/github/stars/Jo-DK/local-atelie?color=56BEB8" /> -->
</p>

<!-- Status -->

<!-- <h4 align="center"> 
	🚧  Local Atelie 🚀 Under construction...  🚧
</h4> 

<hr> -->

<p align="center">
  <a href="#dart-sobre">Sobre</a> &#xa0; | &#xa0; 
  <a href="#sparkles-features">Features</a> &#xa0; | &#xa0;
  <a href="#rocket-technologies">Technologies</a> &#xa0; | &#xa0;
  <a href="#white_check_mark-requirements">Requirements</a> &#xa0; | &#xa0;
  <a href="#checkered_flag-starting">Starting</a> &#xa0; | &#xa0;
  <a href="#memo-license">License</a> &#xa0; | &#xa0;
  <a href="https://github.com/Jo-DK" target="_blank">Author</a>
</p>

<br>

## :dart: Sobre ##

Este é apenas uma aplicação teste para um processo Seletivo, e contém:
:checkered_flag: APIs CRUD Para Empresas,
:checkered_flag: APIs CRUD Para Campanhas,
:checkered_flag: APIs CRUD Para Participantes,
:checkered_flag: APIs de Adesão, para vincular e desvincular Participantes

## :rocket: Technologies ##

The following tools were used in this project:

- [PHP](https://www.php.net)
- [MySQL](https://www.mysql.com/)
- [GIT](https://git-scm.com/)
- [Composer](https://getcomposer.org)
- [CoffeeCode-DataLayer](https://packagist.org/packages/coffeecode/datalayer)
- [CoffeeCode-Router](https://packagist.org/packages/coffeecode/router)


## :white_check_mark: Requirements ##

:checkered_flag: É necessário editar o arquivo [Config.php](https://github.com/Jo-DK/Atelie/blob/main/config.php), com os parâmetros do seu banco local.

:checkered_flag: Contém um arquivo de [Dump](https://github.com/Jo-DK/Atelie/blob/main/Src/Database/dump.sql) 
e um arquivo de [Seed](https://github.com/Jo-DK/Atelie/blob/main/Src/Database/seed.sql) dentro da pasta **Src/Database/**.

:checkered_flag: Também precisará rodar o **composer** para utilizar do **autoload PSR-4** e dos plugins de **Router** e **DataLayer**.

:checkered_flag: Há ainda um arquivo Json do [Postman](https://github.com/Jo-DK/Atelie/blob/main/Atelie.postman_collection.json) com alguns exemplos de uso das APIs.

## :checkered_flag: Starting ##

```bash
# Clone this project
$ git clone https://github.com/Jo-DK/local-atelie

# Access
$ cd local-atelie

# Install dependencies
$ composer install

# Na minha máquina não criei Virtual Host, usando apenas no  <http://localhost> mesmo, como podem ver no Postman
```

## :sparkles: Features ##

:heavy_check_mark: Feature 1: Para as Rotas eu utilizei um plugin da [CoffeCode](https://packagist.org/packages/coffeecode), para não reinventar a roda, 
Os cadastros das Rotas estão em [rotas.php](https://github.com/Jo-DK/Atelie/blob/main/router.phpl)

:heavy_check_mark: Feature 2: Sistema de [validação](https://github.com/Jo-DK/Atelie/tree/main/Src/Validation) dinânimo que permite o cadastro de diversas 
[regras](https://github.com/Jo-DK/Atelie/blob/main/Src/Validation/Rules.php) como CPF, CNPJ e Email.

:heavy_check_mark: Feature 3: As [ORMs](https://github.com/Jo-DK/Atelie/tree/main/Src/Models) utilizam um Datalayer também da CoffeCode, que também prove a classe Abstrata e uma Conexão PDO.




Made with :heart: by <a href="https://github.com/Jo-DK" target="_blank">Jonathan Nunes</a>

&#xa0;

<a href="#top">Back to top</a>
