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

### Requests para Insomnia ou Postman
Todos os métodos precisam ter no Header
- Content-type: application/json
- X-Locale: pt_br

## Explicação sobre a configuração de página no backend
A configuração de página tem os seguintes parâmetros
- page[limit] (Limitar registros por página. Exemplo: 10)
- page[current] (Página a ser exibida. Exemplo: 1)
- page[paginate] (Tipo de paginação. 0-Paginate, 1-SimplePaginate 2-Cursor, 3-Sem paginação. Exemplo: 1)
- page[cursor] (Link do cursor para páginas que desejam adicionar scroll infinito. Exemplo: eyJwcm9kdWN0LmlkIjoxOSwiX3BvaW50c1RvTmV4dEl0ZW1zIjp0cnVlfQ
- page[columns] (Colunas a serem exibidas no retorno. Exemplo: product.id, product.name)
- page[onlyData] (Retorna os dados da consulta sem a informação da paginação. Exemplo: 1

## Explicação sobre a filtragem dinâmica das tabelas
A query param deve seguir a lógica seguinte:
- filter[Condicao][NomeDaTabela.NomeDoCampo][Operador]

Opções de Condicao
- where
- orWhere

Opções de NomeDaTabela
- customer
- seller
- product
- opportunity

Opções de Nome do Campo
- Qualquer campo que contenha na tabela a ser filtrada. Vamos supor que queremos filtrar o campo name da tabela product. Seria o seguinte exemplo: product.name
- Se quisessemos filtrar outro campo de product, seria: product.reference_code
- Se fosse outra tabela como por exemplo seller, seria: seller.name ou seller.ein ou seller.address.

Opções de Operador
- equal (Igual "=" )
- greater (Maior ">")
- less (Menor "<")
- greaterOrEqual (Maior ou Igual ">=")
- lessOrEqual (Menor ou Igual "<=")
- different (Diferente "!=")
- likeInitial (Método Like que procura com o que começa)
- likeFinal (Método Like que procura com o que termina)
- likeAnywhere (Método Like que procura em qualquer parte)
- likeEqual (Método Like que procura com o que é idêntico)

Com base nessas explicações, vamos criar alguns exemplos

# Filtrar vendedor por um conjunto de caracteres que contenha no início do campo nome.
filter[where][seller.name][likeInitial] : "conteúdo a ser pesquisado"

# Filtrar vendedor por um cnpj que seja igual a...
filter[where][seller.ein][equal] : "conteúdo a ser pesquisado"

# Filtrar oportunidades de venda por período de cadastro
filter[where][opportunity.created_at][greaterOrEqual] : "2022-05-01T00:00:00"

filter[where][opportunity.created_at][lessOrEqual] : "2022-05-22T23:59:59"


Você pode combinar where com orWhere, incluir quantos filtros você quiser ao mesmo tempo.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
