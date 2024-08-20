<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# toDO

O gestor de projetos possue as seguintes funcionalidades:

Cadastrar projetos  qualquer usuário pode fazer
    cadastrar Titulo, data encerramento e descrição
Ver projeto, o criador ou um usuário participante podem acessar

Atualizar projeto Apenas o dono do projeto tem essa funcionalidade
    atualizar Titulo, data encerramento e descrição
Excluir projeto apenas o dono do projeto pode fazer


Associar usuário ou  projeto apenas o dono do projeto pode fazer,  desde que o usuário tenha uma conta 
cadastrada

Associar a uma  task somente o dono do projeto pode fazer,  desde que o usuário tenha acesso 
ao projeto

remover usuário de uma task   apenas  o dono do projeto pode fazer,  desde que o usuário tenha acesso 
a task

Criar task apenas o dono do projeto tem acesso 
    cadastrar Titulo, data encerramento, descrição e status
Ver task, o criador ou um usuário associado a task podem acessar

Atualizar task Apenas o dono do projeto tem essa funcionalidade
    atualizar Titulo, data encerramento, descrição e status

Excluir task apenas o dono do projeto pode fazer




# toDO

# runProject

1 Instalar o docker compose

2 executar o comando: docker compose up -d

3 rodar docker ps e ver o id do projeto php

4 acessar o docker exec -it <<idPhp>> bash
    4.1 executar o php artisan migrate 
    4.2 executar e manter php artisan queue:work

5 abrir um novo terminal 
    5.1 se caso tiver o npm na sua maquina local executar os comandos npm install e npm run dev



# respostas questinario


1. Explique a diferença entre Eloquent ORM e Query Builder no Laravel. Quais são os prós
e contras de cada abordagem?

ORM que permite trabalhar com bancos de dados de uma maneira orientada a objetos
com um alto nível de abstração que pode interagir com outros recursos do laravel
como as polices e as factories.

já O query builder é uma forma de fazer consultas ao banco de dados de forma simples
e rápida via facades disponibilizado pelo laravel

O orm é mais completo em funcionalidades e mais lento que o query builder, o query builder é mais simples e permite consultas mais complexas e simples



2. Como você garantiria a segurança de uma aplicação Laravel ao lidar com entradas de
usuários e dados sensíveis? Liste pelo menos três práticas recomendadas e explique
cada uma delas.
Aplicando padrões de segurança  como:
Validação de Dados
Utilizar o sistema de validação (validation) para garantir que as entradas de
usuários estejam no formato esperado.
Autenticação
Permitir que apenas usuários autorizados tenha acesso aos dados, por meio de login e token
criptografia
Usar crypto para esconder dados sensíveis como a senha e números de documentos de um possível atacante



3. Qual é o papel dos Middlewares no Laravel e como eles se integram ao pipeline de
requisição? Dê um exemplo prático de como você criaria e aplicaria um Middleware
personalizado para verificar se o usuário está ativo antes de permitir o acesso a uma rota
específica.
os Middlewares são uma forma de filtrar e manipular requisição HTTP
os filtros são acessados antes das rotas serem carregadas
Exemplo: eu poderia chamar o middleware auth para verificar se o usuário está logado,
este middleware analisaria se o usuário fez a sessão antes de iniciar a rota


4. Descreva como o Laravel gerencia migrations e como isso é útil para o desenvolvimento
de aplicações. Quais são as melhores práticas ao criar e aplicar migrations?

migration é um sistema robusto para gerenciar migrações de banco de dados,
ela permite que as migrates sejam gerenciadas através da tempo que elas
são criadas
boas praticas
1 Manter um nome pequeno
2 criar migrations pequenas
3 Use o seeds para popular o banco
4 Teste e documente qualquer mudança
5 criar rollback para as migrations



5. Qual é a diferença entre transações e savepoints no SQL Server? Como você usaria
transações em um ambiente Laravel?

Transações são um conjunto de operações do banco de dados que são tratadas como
uma carga de trabalho única.
Se qualquer operação dentro da transação apresentar erro, todas as outras operações são revertidas dentro da transição

Savepoints, são pontos marcados dentro de uma
transação (sub transações) que podem ser revertidos para um estado anterior
sem ter que desfazer toda a transação.

Em Laravel, você pode usar transações para garantir a integridade dos dados usando o query build




