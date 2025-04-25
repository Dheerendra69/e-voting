## Prerequisites

-   PHP >= 8.2
-   Composer
-   XAMPP/MAMP/Laragon/Herd/etc

### Without Docker

1. Create the database (ex: `e_voting`)

2. Terminal

    ```shell
    git clone https://github.com/raflizocky/e-voting.git
    ```

    ```shell
    code e-voting
    ```

3. `.env`

    - Terminal:
        ```shell
        cp .env.example .env
        ```
    - Adjust `.env`:
        ```shell
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=your_mysql_db
        DB_USERNAME=your_mysql_username
        DB_PASSWORD=your_mysql_password
        ```
    - Adjust `.env` (for send mail (gmail), optional):
        ```shell
        MAIL_MAILER=smtp
        MAIL_HOST=smtp.gmail.com
        MAIL_PORT=587
        MAIL_USERNAME=youremail@gmail.com
        MAIL_PASSWORD=your_email_app_password
        MAIL_ENCRYPTION=tls
        MAIL_FROM_ADDRESS="youremail@gmail.com"
        MAIL_FROM_NAME="${APP_NAME}"
        ```

4. Terminal
    - ```shell
      composer update ; composer i ; php artisan key:generate ; php artisan mi:f --seed ; php artisan storage:link ; php artisan ser
      ```

---

### With Docker

> If it's laggy when running, that's okay/fine.

1. Terminal

    ```shell
    git clone https://github.com/raflizocky/e-voting.git
    ```

    ```shell
    code e-voting
    ```

2. Open Docker Desktop (Windows, MacOS)

3. `.env`

    - Terminal:
        ```shell
        cp .env.example .env
        ```
    - Adjust `.env`:
        ```shell
        DB_CONNECTION=mysql
        DB_HOST=mysql_db
        DB_PORT=3306
        DB_DATABASE=e_voting
        DB_USERNAME=root
        DB_PASSWORD=secret
        ```

4. Terminal (`makefile` is optional, u can use usual docker compose command (see `makefile` file))

    - ```shell
      winget install ezwinports.make #for windows only
      ```
    - ```shell
      make build
      ```
    - ```shell
      make up
      ```
    - ```shell
      make migrate
      ```
    - ```shell
      make db-seed
      ```
    - ```shell
      make storage-link
      ```
    - ```shell
      make key-generate
      ```

5. Open project:
    - e-voting -> `8000:8000`
    - phpmyadmin -> `8080:80`

---

## Usage

-   Admin

    ```shell
    email   : admin1@gmail.com
    password: password
    ```

-   Voter
    ```shell
    email   : Voter1@gmail.com
    password: password
    ```