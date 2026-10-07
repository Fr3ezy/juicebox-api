# Juicebox - Laravel Developer Code Test (API Development)

RESTful API built with Laravel 11 for Post Management, User Authentication, and External Weather Integration.

---

## 🛠️ Requirements & Stack
- PHP >= 8.2
- MySQL / MariaDB
- Composer
- Laravel Sanctum
- WeatherAPI.com Integration

---

## 🚀 Setup & Installation Instructions

1. **Clone Repository**
   ```bash
   git clone https://github.com/Fr3ezy/juicebox-api
   cd juicebox-api
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Environment Setup**
   Copy file `.env.example` to `.env` and set up your environment variables:
   ```bash
   cp .env.example .env
   ```
   Ensure the following configurations are set:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=juicebox_api
   DB_USERNAME=root
   DB_PASSWORD=

   QUEUE_CONNECTION=database
   WEATHER_API_KEY=your_weather_api_key_here
   ```

4. **Generate Application Key & Run Migrations**
   ```bash
   php artisan key:generate
   php artisan migrate
   ```

5. **Run Queue Worker**
   To process background queued jobs (e.g., Welcome Emails):
   ```bash
   php artisan queue:work
   ```

6. **Run Artisan Scheduler (Weather Cron)**
   To trigger the hourly weather update background job manually or locally:
   ```bash
   php artisan schedule:run
   ```

---

## ⚙️ Testing Features & Artisan Commands

### 1. Testing Welcome Email Queue Manually
You can dispatch the welcome email job manually for any registered user using the custom Artisan command:
```bash
php artisan email:send-welcome {userId}
```

### 2. Running Automated Tests
Run PHPUnit feature & unit tests (including mock HTTP tests for Weather API):
```bash
php artisan test
```

---

## 🌤️ Weather API Setup
1. Register a free account at [WeatherAPI.com](https://www.weatherapi.com/).
2. Obtain your API Key from the dashboard.
3. Place the API Key into `.env` file: `WEATHER_API_KEY=your_key_here`.
4. Weather data for **Perth, Australia** is cached for **15 minutes** (`900` seconds) on `/api/weather` to optimize performance and prevent API limit throttling.

---

## 📚 API Endpoints Overview

### Authentication
- `POST /api/register` - Register a new user & trigger Welcome Email queue
- `POST /api/login` - Authenticate user & receive Sanctum Bearer Token
- `POST /api/logout` - Revoke current token (Protected)

### Posts (Protected)
- `GET /api/posts` - List paginated posts
- `GET /api/posts/{id}` - Get specific post
- `POST /api/posts` - Create post
- `PATCH /api/posts/{id}` - Update post
- `DELETE /api/posts/{id}` - Delete post

### Users (Protected)
- `GET /api/users/{id}` - Get specific user profile

### External API
- `GET /api/weather` - Get Perth current weather data (Cached 15m)