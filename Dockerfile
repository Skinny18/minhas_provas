# Base image para o PHP e Apache
FROM yiisoftware/yii2-php:8.3-apache AS php

# Define o diretório de trabalho dentro do contêiner
WORKDIR /app

# Copia os arquivos do aplicativo para o contêiner
COPY . /app

# Configuração dos volumes
VOLUME ["/root/.composer/cache", "/app"]

# Expondo a porta 80 do contêiner
EXPOSE 80

# Imagem para o pgAdmin
FROM dpage/pgadmin4 AS pgadmin

# Configurações do pgAdmin
ENV PGADMIN_DEFAULT_EMAIL=mands@gmail.com
ENV PGADMIN_DEFAULT_PASSWORD=amanda123

# Expondo a porta 80 do pgAdmin
EXPOSE 80

# Imagem para o PostgreSQL
FROM postgres AS postgres

# Configurações do PostgreSQL
ENV POSTGRES_PASSWORD=password
ENV POSTGRES_USER=root
ENV POSTGRES_DB=mands_db

# Expondo a porta 5432 do PostgreSQL
EXPOSE 5432

# Configuração de rede para o contêiner do PostgreSQL
# (Se necessário, substitua o endereço IP)
RUN echo "host all  all    0.0.0.0/0  md5" >> /var/lib/postgresql/data/pg_hba.conf
RUN echo "listen_addresses='*'" >> /var/lib/postgresql/data/postgresql.conf

# Definição do diretório de trabalho padrão
WORKDIR /
