# Roadies Petcare – Laravel Project

Welcome to **Roadies Petcare**! This is a Laravel-based application designed to streamline pet care management. Follow the steps below to set up and run the project locally using **Laravel Herd**.

---

## Requirements

Before you begin, ensure you have the following installed:

- **Laravel Herd** (MacOS only): [Download Laravel Herd](https://herd.laravel.com)
- **Composer** (optional, included with Herd): [Get Composer](https://getcomposer.org)
- **Node.js & npm**: [Download Node.js](https://nodejs.org)

---

## Getting Started

### 1. Clone the Repository

First, clone the repository to your local machine:

```bash
git clone https://github.com/JeffreyBenusa/roadie-petcare
cd roadies-petcare
```

### 2. Configure .env File

Copy the `.env.example` file to create your `.env` file:

```bash
cp .env.example .env
```

Then, open `.env` and check/adjust the following settings (if necessary):

- **Database configuration**:
  Set `DB_CONNECTION=sqlite` and create the SQLite database file:
  ```bash
  touch database/database.sqlite
  ```

- **Queue Connection**:
  Ensure the `QUEUE_CONNECTION=database` is set.

- Any other necessary configuration (mail, etc.).

---

### 3. Run the Setup Commands

Run the following commands to install dependencies, migrate the database, and optionally seed it:

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install

# Compile assets
npm run build

# Run database migrations
php artisan migrate --seed
```

---

### 4. Start the Project

Using Laravel Herd, start the project:

1. Open **Laravel Herd** and:
   - Add your project directory by clicking the **“+ Add Project”** button and selecting the `roadies-petcare` folder.
   - Configure your application’s domain (e.g., `roadies-petcare.test`).

2. Ensure SQLite is enabled in Laravel Herd:
   - Go to "Settings > Extensions" and enable SQLite if it's not already available.

3. Start the server, access your app in the browser at the configured domain (e.g., `http://roadies-petcare.test`).

---

## Development Workflow

### Run the Development Server

If you need to recompile assets during development, you can run the following command to enable auto-reloading:

```bash
npm run dev
```

### Running Tests

The project uses **PHPUnit** and **Pest** for testing. To run tests:

```bash
php artisan test
```

If you want to run JavaScript tests (if applicable):

```bash
npm run test
```

---

## Troubleshooting

### Common Issues with Laravel Herd

- **SQLite Not Found**: Ensure you've enabled the SQLite extension in Herd's settings.
- **Storage Permissions**: If you encounter issues with storage or logs, run:
  ```bash
  php artisan storage:link
  chmod -R 775 storage bootstrap/cache
  ```

### Rebuild Assets
If front-end assets are not loading correctly, rebuild them using:

```bash
npm run build
```

---

## Features

- **Pet Care Jobs Management**
- Full CRUD functionality for jobs, services, and users
- Vue.js-powered admin dashboard
- Inertia.js for seamless navigation

---

## Support

For any issues, feel free to open an issue on the repository or contact the developers via the provided communication channels.