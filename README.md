# Galaxias


## REQUISITOS 
### Ferramentas e padronizações

- utilize o framework Laravel na versãon 10 (https://laravel.com/docs/10.x)
- banco de dados postgres (https://www.postgresql.org/)
- padronize a API com o padrão Restful (https://www.hostgator.com.br/blog/api-restful/) (https://laravel.com/docs/10.x/controllers#api-resource-routes)
- validações de requisições são muito importantes, utilize o form validation do laravel (https://laravel.com/docs/10.x/validation#creating-form-requests)
- a padronização das responses é de extrema importancias para a qualidade de um projeto, utilize API Resource do laravel (https://laravel.com/docs/8.x/eloquent-resources)
- utilize o software POSTMAN para testar as suas requisições e exporte a collection para dentro do projeto quando finalizar o desenvolvimento (https://www.postman.com/). Recomendo utilizar a versão de desktop do software.

### IDEIA DA API & FUNCIONALIDADES
#### A ideia dessa API é que cada usuário consiga cadastrar suas Galaxias, sistemas solares e planetas favoritos. Sua missão como desenvolvedor é garatir que ele consiga cadastrar, visualizar, filtrar, alterar, deletar e todas as informações que ele deseja. Lembre que todas as rotas dos CRUD devem ser autenticadas, lembre também de utilizar o usuário logado para salvar as informações com o ID dele ``Auth::user()->id``.

- cadastro de usuário, exemplo -- **POST** /register
```json
{
   "name":"João da silva",
   "email":"joao_da_silva@email.com",
   "password":"secret",
   "password_confirmation":"secret"
}
 ```
- login, exemplo -- **POST** /login
```json
{
   "email":"joao_da_silva@email.com",
   "password":"secret",
}
 ```
- crud de galaxias, exemplo de criação de galaxia -- **POST** /galaxies
```json
{
   "name":"milky way",
   "dimension":95431651971149,
   "number_of_solar_systems":-9984944984,
}
 ```
- crud de sistemas solares dentro de galaxias, exemplo de criação de sistema solar dentro de uma galaxia -- **POST** /galaxies/:galaxyId/solar-systems
```json
{
   "name":"AED-5609",
   "dimension":95431651971149,
   "number_of_planets":9984944984,
   "main_star": "Sum"
}
 ```
- **crud** de planetas dentro de sistemas solares, exemplo de criação de planetas dentro de sistemas solares -- **POST** /galaxies/:galaxyId/solar-systems/:solarSystemId/planets
```json
{
   "name":"AED-5609",
   "dimension":95431651971149,
   "number_of_moons":122,
   "light_years_from_the_main_star": 123123123312
}
 ```

## PULL REQUEST
- depois que finalizar a sua API Restful, crie uma pull-request para esse repositório
- lembre de criar um nome para sua branch que descreve o que será/foi desenvolvido nela
- lembre de realizar commits pertinentes, exemplo ruim "salvando código", exemplo bom "implementadas funcionalidades de criação, leitura, atualização e exclusão de galaxias"
- lembre de criar uma descrição para quem está fazendo o code-review consiga testar todas as funcionalidades implementadas
