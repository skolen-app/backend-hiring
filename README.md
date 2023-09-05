# Galaxias


## REQUISITOS 
### Ferramentas e padronizações

- utilize o framework Laravel na versãon 10 (https://laravel.com/docs/10.x)
- banco de dados postgres (https://www.postgresql.org/)
- padronize a API com o padrão Restful (https://www.hostgator.com.br/blog/api-restful/) (https://laravel.com/docs/10.x/controllers#api-resource-routes)
- validações de requisições são muito importantes, utilize o form validation do laravel (https://laravel.com/docs/10.x/validation#creating-form-requests)
- a padronização das responses é de extrema importancias para a qualidade de um projeto, utilize API Resource do laravel (https://laravel.com/docs/10.x/eloquent-resources)
- implemente teste para os endpoints usando phpunit (https://laravel.com/docs/10.x/http-tests#main-content)
- utilize o software POSTMAN para testar as suas requisições e exporte a collection para dentro do projeto quando finalizar o desenvolvimento (https://www.postman.com/). Recomendo utilizar a versão de desktop do software.

### IDEIA DA API & FUNCIONALIDADES
#### A ideia dessa API é que cada usuário consiga cadastrar suas Galaxias, sistemas solares e planetas favoritos. Sua missão como desenvolvedor é garatir que ele consiga cadastrar, visualizar, filtrar, alterar, deletar e todas as informações que ele deseja. Lembre que todas as rotas dos CRUD devem ser autenticadas, lembre também de utilizar o usuário logado para salvar as informações com o ID dele ``Auth::user()->id``.

### EXEMPLOS DE VALORES E REQUISIÇÕES
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
- **crud** de galaxias, exemplo de criação de galaxia -- **POST** /galaxies
```json
{
   "name":"milky way",
   "dimension":95431651971149,
   "number_of_solar_systems":-9984944984,
}
 ```
- **crud** de sistemas solares dentro de galaxias, exemplo de criação de sistema solar dentro de uma galaxia -- **POST** /galaxies/:galaxyId/solar-systems
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

## Criação de Repositório e Compartilhamento com Gabriel

Por favor, crie um repositório para este projeto e compartilhe-o imediatamente com o endereço de e-mail gabrielkrysa@gmail.com. É fundamental o acesso para que possa ser avaliado as funcionalidades e o código. Certifique-se de conceder permissões completas para que seja possivel realizar uma avaliação abrangente.

## Dicas para Commits Efetivos

Ao fazer commits em seu projeto, siga estas diretrizes para manter um histórico de commit organizado e informativo:

1. **Mensagens Descritivas**: Escreva mensagens de commit concisas e descritivas que expliquem claramente o que a alteração faz. Use verbos no imperativo, como "adicionar", "corrigir", "atualizar" ou "remover".

2. **Commits Atômicos**: Faça commits atômicos, ou seja, um commit por alteração lógica. Evite commits que incluam várias alterações não relacionadas.

3. **Use Ramificações (Branches)**: Crie uma nova branch para cada funcionalidade ou correção que você está implementando. Mantenha a branch principal sempre estável.

4. **Commits Frequentes**: Faça commits regularmente à medida que avança no desenvolvimento para manter um histórico claro e rastreável.

5. **Evite Commits Desnecessários**: Não inclua arquivos gerados automaticamente ou código inacabado em seus commits.

6. **Respeite as Convenções**: Siga as convenções de mensagens de commit preferidas pela equipe ou projeto em que você está trabalhando.

7. **Ferramentas de Verificação de Estilo**: Considere o uso de ferramentas de verificação de estilo de código para garantir a conformidade com as diretrizes definidas.

8. **Evite Commits Gigantes**: Evite fazer commits com muitas alterações em um único commit, o que pode dificultar a revisão.

Lembre-se de que um histórico de commit bem gerenciado é fundamental para a colaboração eficaz em projetos de software.

