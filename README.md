📦 Mini E-commerce REST API (Laravel Backend)
<p align="center"> <img src="https://laravel.com/img/logomark.min.svg" width="90"> </p>
📘 Overview

This is a Mini E-commerce REST API built using Laravel 10+ and PHP 8.2, designed for learning and small-scale backend development.

This API includes:

User registration & login using Laravel Sanctum (Personal Access Tokens)
Admin/User role-based access control
Product CRUD (Admin only)
Order creation with order items (Authenticated users)
Clean JSON responses with validation
Ready SQL database included (admin & user accounts seeded)
All endpoints are tested using Postman.

# Technologies Used

| Technology          | Version | Description                 |
| ------------------- | ------- | --------------------------- |
| **Laravel**         | 12.x    | Backend framework           |
| **PHP**             | 8.2.12  | Server-side language        |
| **MySQL / MariaDB** | 10.4+   | Relational database         |
| **Laravel Sanctum** | —       | API Token Authentication    |
| **Composer**        | Latest  | PHP dependency manager      |
| **Node.js & NPM**   | Latest  | Frontend asset build system |
| **Postman**         | Latest  | API testing tool            |


# Features

🔐 Authentication

Register new user
Login and receive API token
Logout using token
Admin/User role support

📦 Products 

Create product (Admin Only)
View product list

🛒 Orders 

Create order
Each order saves multiple items
Order total calculated automatically
User can view their own orders

⚠ Validation & Error Handling

All inputs validated
Clear JSON errors
Unauthorized access checks

# Database Structure

SQL file: mini_ecommerce.sql

users

| Column     | Type      | Description      |
| ---------- | --------- | ---------------- |
| id         | BIGINT    | Primary Key      |
| name       | VARCHAR   | User full name   |
| email      | VARCHAR   | Unique email     |
| password   | VARCHAR   | Hashed password  |
| role       | VARCHAR   | “admin” / “user” |
| created_at | TIMESTAMP | —                |
| updated_at | TIMESTAMP | —                |

products

| Column      | Type          | Description     |
| ----------- | ------------- | --------------- |
| id          | BIGINT        | Primary Key     |
| name        | VARCHAR       | Product title   |
| description | TEXT          | Product details |
| price       | DECIMAL(10,2) | Product price   |
| stock       | INT           | Available stock |
| created_at  | TIMESTAMP     | —               |
| updated_at  | TIMESTAMP     | —               |

orders

| Column     | Type          | Description        |
| ---------- | ------------- | ------------------ |
| id         | BIGINT        | Primary Key        |
| user_id    | BIGINT        | FK → users.id      |
| total      | DECIMAL(10,2) | Order total amount |
| created_at | TIMESTAMP     | —                  |
| updated_at | TIMESTAMP     | —                  |

order_items

| Column     | Type          | Description       |
| ---------- | ------------- | ----------------- |
| id         | BIGINT        | Primary Key       |
| order_id   | BIGINT        | FK → orders.id    |
| product_id | BIGINT        | FK → products.id  |
| quantity   | INT           | Number of units   |
| price      | DECIMAL(10,2) | Single item price |
| created_at | TIMESTAMP     | —                 |
| updated_at | TIMESTAMP     | —                 |


# Default Credentials

Admin
Email: admin@test.com
Password: password
Role: admin

User
Email: user@test.com
Password: password
Role: user

# API Endpoints
🔐 Auth Endpoints
Method	Endpoint	Description
POST	/api/register	Register new user
POST	/api/login	Login & get token

📦 Product Endpoints
Method	Endpoint	Access	Description
GET	/api/products	Public	List all products
GET	/api/products/{id}	Public	Show single product
POST	/api/products	Admin	Create product

🛒 Order Endpoints
Method	Endpoint	Access
POST	/api/orders	Authenticated
GET	/api/orders	Authenticated

# How to Test (Using Postman)
1️⃣ Register User

POST → http://localhost:8000/api/register

Body:

{
    "name": "User Name",
    "email": "test@example.com",
    "password": "password"
}

2️⃣ Login

POST → http://localhost:8000/api/login

{
    "email": "admin@test.com",
    "password": "password"
}


Copy the returned token.

3️⃣ Use Token

Add this header:

Authorization: Bearer <token>

4️⃣ Create Product (Admin Only)

POST → /api/products

{
    "name": "Sample Product",
    "description": "Demo description",
    "price": 199,
    "stock": 20
}

5️⃣ Create Order

POST → /api/orders

{
    "items": [
        { "product_id": 1, "quantity": 2 }
    ]
}

# Installation Instructions

1. Extract Project
unzip mini-ecommerce.zip
cd mini-ecommerce

2. Install Dependencies
composer install

3. Create .env
cp .env.example .env


Update DB settings:

DB_DATABASE=mini_ecommerce
DB_USERNAME=root
DB_PASSWORD=

4. Database Config
php artisan migrate
php artisan db:seed

5. Generate Key
php artisan key:generate

6. Start Server
php artisan serve

7. Access
http://localhost:8000
