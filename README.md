# Mini E-commerce REST API (Laravel + Sanctum)

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
  </a>
</p>

## Overview

This is a **Mini E-commerce REST API** built using **Laravel 12**.  
It demonstrates:

- User registration & login with **Laravel Sanctum**  
- Role-based access control (Admin/User)  
- Product management (Admin only)  
- Order management (Authenticated users)  
- Pagination & search for products  
- Request validation and proper JSON responses  

## Technologies Used

| Technology          | Version | Description                 |
| ------------------- | ------- | --------------------------- |
| **Laravel**         | 12.x    | Backend framework           |
| **PHP**             | 8.2.12  | Server-side language        |
| **MySQL / MariaDB** | 10.4+   | Relational database         |
| **Laravel Sanctum** | Latest  | API Token Authentication    |
| **Composer**        | Latest  | PHP dependency manager      |
| **Postman**         | Latest  | API testing tool            |


## Features

### User Authentication
- Register new users  
- Login & receive API token  
- Role-based access (admin/user)  

### Products
- Admin can create products  
- Public endpoint to list products  
- Search products by name  
- Pagination  

### Orders
- Authenticated users can place orders  
- Total price calculated automatically   

### Validation & Error Handling
- All requests validated  
- Proper HTTP status codes & structured JSON responses 
- Unauthorized access checks


## Database Structure

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


## Default Credentials

| Role  | Email              | Password |
| ----- | ------------------ | -------- |
| Admin | [admin@gmail.com]  | shimanto |
| User  | [user@gmail.com]   | shimanto |


## API Endpoints

| Method | Endpoint | Description | Access |
|--------|---------|------------|--------|
| POST | `/api/register` | Register a new user | Public |
| POST | `/api/login` | Login & receive API token | Public |
| GET | `/api/products` | List products with pagination & search | Public |
| POST | `/api/products` | Create a new product | Admin only |
| POST | `/api/orders` | Place a new order | Authenticated users |


# How to Test (Using Postman)
1️⃣ Register

Endpoint:
POST http://localhost:8000/api/register

Body (JSON):

{
  "name": "Test User",
  "email": "testuser@example.com",
  "password": "password123"
}

2️⃣ Login

Endpoint:
POST http://localhost:8000/api/login

Body (JSON):

{
  "email": "testuser@example.com",
  "password": "password123"
}


Copy the token from the response for authorized requests.

3️⃣ Get Products (Public)

Endpoints:

GET http://localhost:8000/api/products
GET http://localhost:8000/api/products?page=2
GET http://localhost:8000/api/products?search=iphone

4️⃣ Create Product (Admin Only)

Endpoint:
POST http://localhost:8000/api/products

Headers:
Authorization: Bearer <ADMIN_TOKEN>

Body (JSON):

{
  "name": "iPhone 15",
  "description": "Latest model Apple phone",
  "price": 1200,
  "stock": 10
}

5️⃣ Create Order (User Only)

Endpoint:
POST http://localhost:8000/api/orders

Headers:
Authorization: Bearer <USER_TOKEN>

Body (JSON):

{
  "product_id": 1,
  "quantity": 2
}



## Installation Instructions

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
