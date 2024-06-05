# CodeSphere

## Visão Geral

Este projeto é um blog voltado para a área de TI, onde profissionais de tecnologia podem compartilhar conhecimento, interagir e se conectar em torno de temas relacionados à TI.

## Requisitos

-   PHP 8.2
-   Laravel 11
-   Composer
-   Docker (opcional para desenvolvimento)

## Instalação

1. Clone o repositório:

    ```bash
    git clone https://github.com/estrela2704/codesphere.git
    cd codesphere

    ```

2. Instale as dependências:

    ```bash
    composer install

    ```

3. Copie o arquivo .env.example para .env e configure suas variáveis de ambiente:

    ```bash
    cp .env.example .env

    ```

4. Gere a chave da aplicação:

    ```bash
    php artisan key:generate

    ```

5. Configure seu banco de dados no arquivo .env.

6. Execute as migrações:
    ```bash
    php artisan migrate
    ```

## Dockerização

1. Para rodar o projeto em um contêiner Docker, siga os passos abaixo:

    ```bash
    docker-compose up -d
    ```

2. Acesse o contêiner da aplicação:

    ```bash
    docker-compose exec app bash
    ```

3. Dentro do contêiner, instale as dependências do Composer:

    ```bash
    composer install
    ```

4. Gere a chave da aplicação:

    ```bash
    php artisan key:generate
    ```

5. Execute as migrações:
    ```bash
    php artisan migrate
    ```

## Contribuição

1. Crie uma branch para sua feature:

    ```bash
    git checkout -b feature-minha-feature

    ```

2. Faça suas alterações e commit:

    ```bash
    git add .
    git commit -m "Minha nova feature"

    ```

3. Faça o push da branch:
    ```bash
    git push origin feature-minha-feature
    ```

## Licença

Este projeto está licenciado sob a MIT License.
