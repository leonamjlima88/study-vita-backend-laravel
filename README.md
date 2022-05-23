<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## study-vita-backend-laravel

Cadastro de oportunidades de vendas.

Domínios:

- Clientes
- Vendedores
- Produtos
- Oportunidades de Venda

## Camadas do projeto

### Controller
Responsável por orquestrar as funcionalidades do projeto.

### DTO (Data Transfer Object)
Faz o papel da model na transferência de dados entre as camadas. É um objeto totalmente desacoplado da camada de persistência. Tem responsabilidade de trafegar os dados, validar requisições (entrada), formatar dados nas respostas (saída).

### Service Layer
Tem a responsabilidade de centralizar as regras de negócio, permitir o reuso para outros services, e deve ser a ultima barreira até chegar em repositories.
Nesse padrão de projeto adotado (Service layer, que é diferente do Service adotado em DDD), qualquer requisição deve passar por service, mesmo que seja uma simples consulta de dados. Nenhuma camada deve acessar o repository a não ser que o dominio seja o proprietário.
Esse modelo faz com que você escreva códigos redundantes, alguns métodos do service acabam se tornando procedurais, porém, acredito que isso traz segurança e organização ao projeto em larga escala com programadores de todos os níveis de conhecimento.
Observação: Eu poderia ter adotado o principio de solid de responsabilidade única que é o ideal para a camada service. Porém, devido ao tamanho do projeto, acabei decidindo fazer um único arquivo para cada domínio.

### Repository
Camada responsável pela persistência e consulta do banco de dados. Nenhuma outra camada deverá ter acesso aos dados sem que passe por Service > Repository.
As models são instanciadas em repositories, utilizadas e destruidas ao termino do processo.

### Repository (BaseRepository)
Classe abstrata para auxiliar repositories.
Contém métodos para pesquisa de forma dinâmica. Qualquer repository que implemente esta classe terá por padrão pesquisa para todos os campos da tabela, e até mesmo para campos do tipo join. Poderá escolher colunas de retorno, configurações de página e outros recursos.

### Model
Entidade que reflete a tabela do banco de dados e possibilita o CRUD. Algumas model contém casts (float, boolean, enum). Contém conversão da model para DTO.

## O que não foi feito?
- Autenticação JWT
- Plano de testes
- Laravel Telescope
- Permissão de acesso a rotas

Observação: Desenvolvi outro projeto backend com esses recursos. Porém, devido ao meu tempo escasso e desconhecimento de recursos no frontend optei por fazer um downgrade do projeto backend.
Também vou disponibilizar o outro projeto backend.

## Instalação do projeto
Requer php ^8.0.2
É só baixar o projeto, rodar composer install e php artisan serve. No meu caso utilizei laradock com nginx. É necessário criar um banco de dados no MySQL e configurar o arquivo .env

- DB_CONNECTION=mysql
- DB_HOST=ip
- DB_PORT=porta
- DB_DATABASE=nomeDoBanco
- DB_USERNAME=mysqlUsuario
- DB_PASSWORD=mysqlSenha

Execute o método php artisan migrate para criar as tabelas

## Documentação da API com Postman
- Download da documentação da API no Postman
https://drive.google.com/file/d/1CGz5zCG2jgNPQY_kx2fjwnFRldmkJgt-/view?usp=sharing

- Link da documentação online
https://documenter.getpostman.com/view/21100265/UyxojQaq#8c3ce162-644f-434f-8b12-43f24e6567e3


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
