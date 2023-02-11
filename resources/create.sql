CREATE DATABASE IF NOT EXISTS stock;

USE stock;
CREATE TABLE IF NOT EXISTS quote (
    symbol CHAR(30) NOT NULL,
    high FLOAT(4) NOT NULL,
    low FLOAT(4) NOT NULL,
    price FLOAT(4) NOT NULL,
    create_date datetime DEFAULT (DATE_FORMAT(NOW(), '%Y-%m-%d')),
    CONSTRAINT PK_Symbol PRIMARY KEY (symbol, create_date)
);

CREATE USER IF NOT EXISTS 'test'@'localhost' IDENTIFIED BY 'test1234';

GRANT ALL ON stock.* TO 'test'@'localhost';


