# IT0049 TFA4 - POS Sessions and Authentication

A CodeIgniter 4 POS project with customer and user account pages. Lab 4 adds password-based login, sessions, protected routes, and logout to the TFA3 project.

**Repository:** https://github.com/CarlVincentTenorio/Tenorio_Carl-Vincent-Lab-4-Technical

**Hosted application:** Add the live URL after deployment.

## Features

- View, add, and edit customer and user accounts after logging in.
- Store password hashes in the `users.password` column and check login passwords with `password_verify()`.
- Redirect visitors who are not logged in away from protected account pages.
- End the session when the user logs out.
- Upload an optional profile picture when editing a user.

## Requirements

- PHP 8.2 or newer and Composer
- MariaDB or MySQL
- PHP extensions `intl`, `mbstring`, `mysqli`, and `gd`
- Writable `writable/` and `public/uploads/avatars/` directories

## Run locally

1. Start MySQL in XAMPP and create an **empty** database named `it0049_pos`. Do not import the old TFA3 SQL export.
2. From the project folder, install dependencies:

   ```powershell
   composer install
   ```

3. Copy `.env.example` to `.env`. Set `app.baseURL` to `http://localhost:8080/` and enter your own database connection details. Keep `.env` private.
4. Build the tables and add sample customers and users:

   ```powershell
   & 'C:\xampp\php\php.exe' spark migrate
   & 'C:\xampp\php\php.exe' spark db:seed DatabaseSeeder
   ```

5. In your private `.env`, temporarily set `TFA4_ADMIN_PASSWORD` to a password you choose with at least 12 characters. Give the existing users password hashes:

   ```powershell
   & 'C:\xampp\php\php.exe' spark db:seed ExistingUserPasswordSeeder
   ```

   The `admin01` account receives the password you chose. Other sample accounts receive random passwords; an authenticated user can set new passwords for them through the user edit form. Remove the `TFA4_ADMIN_PASSWORD` line from `.env` after seeding.

6. Start the development server:

   ```powershell
   & 'C:\xampp\php\php.exe' spark serve
   ```

7. Open http://localhost:8080/login and sign in as `admin01` with the password chosen in step 5.

These database setup steps are for a **new, empty database**. Do not run `DatabaseSeeder` again on a database that already contains the sample records.

## Database files

- `CreateCustomersAndUsers` creates the customer and user tables, including the optional avatar field.
- `AddPasswordColumnToUsers` adds the `users.password` field.
- `DatabaseSeeder` adds sample customers and users.
- `ExistingUserPasswordSeeder` hashes passwords for existing users.
- `ResetAdminPasswordSeeder` can set a new `admin01` password using a temporary private `TFA4_ADMIN_PASSWORD` value.

## Check authentication

1. While logged out, opening `/users` or `/customers/new` should redirect to `/login`.
2. Log in as `admin01`; the account pages should open.
3. Log out; opening a protected page again should redirect to `/login`.

## Hosting

Deploy to a PHP and MariaDB/MySQL host. Install dependencies, create an empty database, and run the migration and seeder steps above on that database. Configure a private `.env` with the hosted database credentials, an HTTPS `app.baseURL` ending in `/`, and `CI_ENVIRONMENT = production`.

Set the website's document root to this project's `public/` directory. Make `writable/` and `public/uploads/avatars/` writable by the web server. Add the working website URL near the top of this README after deployment.