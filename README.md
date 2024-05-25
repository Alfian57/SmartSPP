# Setting Up Laravel 11 Project

This is a quick guide on how to set up a Laravel 11 project from a GitHub repository.

## Prerequisites

Before getting started, make sure you have the following prerequisites installed:

-   [PHP](https://www.php.net/) (version >= 8.2)
-   [Composer](https://getcomposer.org/)
-   [MySQL](https://www.mysql.com/)
-   [Git](https://git-scm.com/)
-   [Laravel CLI](https://laravel.com/docs/11.x/installation#installation-via-composer)

Ensure you have installed and configured the above prerequisites before proceeding.

## Setup Steps

1. **Clone the Repository**

    Clone this repository into your local directory:

    ```bash
    git clone https://github.com/Alfian57/pengaduan-masyarakat.git
    ```

2. **Install Dependencies**

    Navigate into the project directory and run the following command to install all PHP dependencies:

    ```bash
    cd repo-name
    composer install
    ```

3. **Environment Configuration**

    Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

    next, change FILESYSTEM_DISK from `local` to `public`

    ```bash
    FILESYSTEM_DISK=public
    ```

    Then, configure the `.env` file according to your environment, including the MySQL database settings.

4. **Setup Email Configuration**

    Set up mail settings in the `.env` file. Configure mail variables with your SMTP server information. Ensure accurate configuration to enable email functionality in your Laravel application. Here are the necessary variables to set:

    ```bash
    MAIL_MAILER=
    MAIL_HOST=
    MAIL_PORT=
    MAIL_USERNAME=
    MAIL_PASSWORD=
    ```

5. **Generate Application Key and Create Storage Link**

    Run the following command to generate a new application key:

    ```bash
    php artisan key:generate
    ```

    Then, create a symbolic link from the public/storage directory to the storage/app/public directory by executing the following command:

    ```bash
    php artisan storage:link
    ```

6. **Run Migrations and Seeders (Optional)**

    If you intend to use a database, run migrations and seeders:

    ```bash
    php artisan migrate --seed
    ```

7. **Setup WhatsApp Configuration**

    Set up WhatsApp settings in the `.env` file. Configure the necessary variables for WhatsApp integration. Here is the variable to set:

    ```bash
    FONNTE_TOKEN=
    ```

    for documnetation you can open this url
    [here](https://scribehow.com/shared/Mengganti_Fontee_Token_pada_aplikasi_SmartSPP__nExLP-OTSuaeWvSO50TYXw)

8. **Run Local Server, Queue Worker, and Scheduler**

    Open three separate terminals or command prompts. In the first terminal, run the following command to start the local server:

    ```bash
    php artisan serve
    ```

    In the second terminal, run the following command to start the queue worker:

    ```bash
    php artisan queue:work
    ```

    In the third terminal, run the following command to start the scheduler:

    ```bash
    php artisan schedule:work
    ```

    Keep all terminals running to serve your application and process queued jobs concurrently.

    You can access the application at `http://localhost:8000`.

## Contribution

If you wish to contribute to this project, please create a pull request to this repository. We would be happy to accept your contributions!

## Notes

Make sure to update all necessary information within this `README.md` to align with your project.

Thank you for using this project! Feel free to reach out if you have any questions or feedback.
