# Nuvem inteview Test

### Dependências

1. Docker
2. O arquivo `/etc/hosts` deve possuir os seguintes hosts.
```
127.0.0.1   api.nuvem.local
127.0.0.1   docs.nuvem.local
127.0.0.1   tests.nuvem.local
```

## Como instalar

Na raiz do projeto rode o camando `bash install`:  

Este comando criará os containers e rodará os camandos básicos, dentro do container PHP criado, intalando a aplicação e criando os índices da base de dados mongo.  
Este comando leverá alguns minutos devido ao composer install, no entanto como os camandos estão sendo executados dentro do docker, nenhum log de acompanhemento acontecerá.  
Fique atento a pasta vendor, quando ela estiver completa e o arquivo .env for criado a sua aplicação estará pronta para acesso.  

## Depois de criado

O comando `bash install` deverá ser rodado apenas uma vez. Após isso, para executar os containers novamente, basta acionar o comando `bash run`.

## Tests

Existe um comando para executar os tests dentro do container docker `PHP`, isso porque o comando gerará os relatórios de cobertura.
Você tem duas opções:

1. Entrar no container docker e executar os testes manualmente. `docker-compose exec -it nuvem-php bash` e depois `php vendor/bin/phpunit`
ou
2. Executar o `bash test`, ele executará o comando dentro do container automaticamente. Nesta opção não é mostrado o `stdout` dos tests.

## Resources

1. `api.nuvem.local` -> Acesso aos recursos da api:  
- `[POST] /orders `  
- `[GET] /recomendations/{sku}`  

2. `docs.nuvem.local` -> Acesso as documentações da Api.  

2. `tests.nuvem.local` -> Acesso aos relatórios de cobertura dos testes.  

## Observação

1. Porque utilizar os camandos `bash install` & `bash test`?  
- A imagem PHP do docker montada possuí todas as dependências para que o código execute, apesar de alguns inconvenientes, é mais simples do que instalar as dependências manualmente em sua própria máquina, além de tornar o processo de desenvolvimento entre equipes mais eficiente.
