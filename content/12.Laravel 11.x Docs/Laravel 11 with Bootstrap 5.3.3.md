---
created: 2024-09-13T23:33:40-04:00
modified: 2024-09-15T02:59:42-04:00
tags:
  - Bootstrap5
  - laravel
  - laravel11
  - laravel-ui
---

https://www.kreaweb.be/laravel-11-bootstrap-5/

## 1. LARAVEL 11 - Introduction

Since version 8 [Laravel](https://laravel.com/) uses [Tailwind CSS](https://tailwindcss.com/) as its main CSS framework. Allthough being a first class CSS framework, developing using Tailwind CSS requires a lot of work because you’ll have to develop every reusable component from scratch yourself.

In the past a lot of developers, like myself, used [Bootstrap](https://getbootstrap.com/). Laravel has dropped Bootstrap support since version 8. The easiest way to keep using Bootstrap in Laravel 11 is by creating a new Laravel project and then using the two commands :

```bash
composer require laravel/ui --dev
php artisan ui bootstrap --auth
```

This installs the latest version Bootstrap 5.3.3 and adds some scaffolding in case you use the **– – auth** option.

For those of us who want to keep using Bootstrap, this is a simple way to create a new Laravel project using the latest **Bootstrap 5** framework.

**Tip :**

If you’re looking for an excellent Local Web Development Server to develop your PHP based applications in a Microsoft Windows environment, please read my posts regarding [Laragon](https://www.kreaweb.be/laragon/).

## 2. LARAVEL 11 - Build the application manually from scratch

### a. Create a new Laravel project

Start by creating a new **Laravel project** :

```bash
composer create-project laravel/laravel your-project-name
```

Then **cd** into the newly created project folder and install the **Laravel UI** package :

```bash
composer require laravel/ui --dev
```

This legacy package is a very simple authentication scaffolding build on the Bootstrap 5 CSS framework.

Generate the **Bootstrap** scaffolding :

```powershell
php artisan ui bootstrap --auth
```

This installs Bootstap 5.3.3 and generates the files needed for authentification.

### b. Configure the .env file

Now open your project in your favorite code editor. I use [Visual Studio Code](https://code.visualstudio.com/). Check and addapt all settings, especially the **database connection** and the **mail settings**.

### c. Import Bootstrap Icons

Install the bootstrap icons library.

```bash
npm install bootstrap-icons
```

Inside your project, open the file **resources\sass\app.scss** and add :

```css
@import "bootstrap-icons/font/bootstrap-icons.css";
```

```scss
// Fonts
@import url("https://fonts.bunny.net/css?family=Nunito");

// Variables
@import "variables";

// Bootstrap
@import "bootstrap/scss/bootstrap";
@import "bootstrap-icons/font/bootstrap-icons.css";
```

### d. Finalize the application

Now create the database tables :

```bash
php artisan migrate
```

Then let’s finalize the setup :

```bash
npm install
npm run dev
```

Normally all should be OK now and you can start developing your own Laravel 11 Bootstrap 5 application.

## 2. LARAVEL 11 - Build the application by cloning the GitHub repository

An empty demo **Laravel 11** project containing **Bootstrap 5** is available on [GitHub](https://github.com/MGeurts/laravel-10-bootstrap-5).

### a. Clone the GitHub repository

Inside the root folder of your local web development environment, open a new terminal window.  
Enter the command :

```bash
git clone https://github.com/MGeurts/laravel-11-bootstrap-5.git .
```

Change directory into the newly created project folder.

### b. Install Composer Dependencies

Enter the command :

```powershell
composer install
```

### c. Install NPM Dependencies

Enter the commands :

```bash
npm install
npm run dev
```

### d. Create your copy of the .env file

Enter the command :

```bash
cp .env.example .env
```

### e. Generate an App Encryption Key

Enter the command :

```bash
php artisan key:generate
```

### f. Create an empty database for our application

Use your favorite database management tool to create an empty database.  
Configure a username and password.

### g. Configure the .env file

Open the **.env** file for editing :

```systemd
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=********
```

Adjust the **DB_HOST**, **DB_PORT**, **DB_DATABASE**, **DB_USERNAME** and **DB_PASSWORD** options to match your situation. Also adjust the mail settings:

```systemd
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```

Adjust the **MAIL_HOST**, **MAIL_PORT**, **MAIL_USERNAME**, **MAIL_PASSWORD**, **MAIL_ENCRYPTION** and **MAIL_FROM_ADDRESS** options to match your situation.

### h. Migrate the database

Enter the command : :

```cli
php artisan migrate:fresh --seed
```

### i. Open the application

You now have a working Laravel 11 application using the Bootstrap 5  framework.

Open a browser and go to the url of your application.

[![](https://www.kreaweb.be/wp-content/uploads/2024/03/laravel-11-bootstrap-5-004b-1024x731.webp)](https://www.kreaweb.be/wp-content/uploads/2024/03/laravel-11-bootstrap-5-004b.webp)

Use the **Register** button to register yourself.

[![](https://www.kreaweb.be/wp-content/uploads/2024/03/laravel-11-bootstrap-5-005b-768x306.webp)](https://www.kreaweb.be/wp-content/uploads/2024/03/laravel-11-bootstrap-5-005b.webp)
