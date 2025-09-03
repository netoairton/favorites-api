/* Criação da tabela de clientes
Utilizei o padrão GENERATED ALWAYS na coluna de id para garantir que sempre 
seja incrementado automaticamente o id a cada nova linha de cliente inserida
na tabela, além de garantir que não fosse possível inserir manualmente id's na tabela,
fazendo com que o uso da tabela seja mais controlado*/
CREATE TABLE client (
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    name VARCHAR(1000),
    email VARCHAR(300) UNIQUE
);
