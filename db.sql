CREATE TABLE provas_feitas (
    id SERIAL PRIMARY KEY,
    assunto VARCHAR(100),
    data DATE,
    acertos INTEGER,
    questoes INTEGER,
    porcentagem NUMERIC(5, 2)
);


CREATE TABLE cronograma (
    id SERIAL PRIMARY KEY,
    materia VARCHAR(100),
    hora_inicial TIME,
    hora_final TIME,
    feito BOOLEAN
);
