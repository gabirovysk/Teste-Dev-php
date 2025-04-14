  # **Utilização da api de teste**


## **Instalação**
  Para a utilização dessa api é necessaria a instalação do [Docker](https://www.docker.com)

  as envs necessárias para um bom funcionamento são respectivamente:
  DB_CONNECTION=mysql
  DB_HOST=mysql
  DB_PORT=3306
  DB_DATABASE=testDatabase
  DB_USERNAME=root
  DB_PASSWORD=

  Após a instalacção abrir o diretorio onde se encontra o arquivo **docker-compose.yml** e rodar o comando:**docker compose up -d**

### **Endpoints e body**
  Os endpoints disponíveis na api são:
    GET /api/clientes/paginate --consultar paginacao com parametros na rota: perPage,page, cpf,cep,nome
    POST /api/clientes -- cadastrar um cliente
    PUT /api/clientes/{id} -- editar um cliente
    DELETE /api/clientes/{id} --deletar um cliente

{
    "nome":"slug",
    "email":"slug@mail.com",
    "cpf":"11233213332",
    "cep":"13455086",
    "numeroEndereco":"11"
}