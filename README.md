# Teste para Desenvolvedor Back-end na 123Milhas

!['Github Workflow'](https://github.com/arthurtavaresdev/123milhas-teste-backend/actions/workflows/test.yml/badge.svg)


## Documentação
[Documentação/Exemplos no POSTMAN](https://documenter.getpostman.com/view/5518072/TzXtK1Q3)


## URL Online
[Online em: https://um-dois-tres-milhas.arthurtavares.dev/](https://um-dois-tres-milhas.arthurtavares.dev/)

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
[`/api/v1/flights`](https://um-dois-tres-milhas.arthurtavares.dev/api/flights) - Retorna todos os dados, dos Voo e seus Agrupamentos.

[`/api/v1/groups`](https://um-dois-tres-milhas.arthurtavares.dev/api/groups) - Retorna apenas os dados dos agrupamentos dos voos.


