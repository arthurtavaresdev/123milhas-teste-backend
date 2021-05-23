# Teste para Desenvolvedor Back-end na 123Milhas

## Requisitos
- Docker
- Docker-compose

## Instruções de Uso

### Setup
- Dentro da Pasta do projeto, digite o comando:
```shell
docker-compose up -d
docker-compose exec 123milhas composer install
```

### Testes
- Execute os testes através do comando:
```shell
docker-compose exec 123milhas ./vendor/bin/phpunit

```

## Rotas disponíveis:
`/api/v1/flights` - Retorna todos os dados, dos Voo e seus Agrupamentos.
`api/v1/groups` - Retorna apenas os dados dos agrupamentos dos voos.


## Documentação 
[Documentação/Exemplos no POSTMAN](https://documenter.getpostman.com/view/5518072/TzXtK1Q3)


## URL Online
[Online em: https://123milhas.arthurtavares.dev/api](https://123milhas.arthurtavares.dev/api)
