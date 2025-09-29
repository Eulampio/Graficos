CREATE DATABASE IF NOT EXISTS dados;
USE dados;

CREATE TABLE salario_minimo (
    ano INT PRIMARY KEY,
    valor DECIMAL(10,2)
);

INSERT INTO salario_minimo (ano, valor) VALUES
(2018, 954.00),
(2019, 998.00),
(2020, 1045.00),
(2021, 1100.00),
(2022, 1212.00),
(2023, 1320.00);