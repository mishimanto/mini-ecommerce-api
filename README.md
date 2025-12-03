Mini Ecommerce – Laravel + Sanctum

# Tools & Versions Used
Tool	Version
Laravel	12
PHP	8.2.12
MariaDB	10.4.32
Composer	Latest
Sanctum	Token-based API Auth

# API Endpoints
POST/api/register
POST/api/login
GET/api/products
POST/api/products(Admin only)
POST/api/orders


# Setup Instructions
1️⃣ Extract the Project
unzip mini-ecommerce.zip
cd mini-ecommerce

2️⃣ Install Dependencies
composer install

3️⃣ Create .env File
cp .env.example .env

Update database credentials:

DB_CONNECTION=mysql
DB_DATABASE=mini_ecommerce
DB_USERNAME=root
DB_PASSWORD=

4️⃣ Database Configaration
php artisan migrate
php artisan db:seed

5️⃣ Generate Application Key
php artisan key:generate

6️⃣ Start Server
php artisan serve

# Credentials
Admin
Email: admin@gmail.com
Password: shimanto

User
Email: user@gmail.com
Password: shimanto


# API Documentation
🔐 Auth Routes
Method	Endpoint	Description
POST	/api/register	Create new user
POST	/api/login	Login & get token

📦 Product Routes
Method	Endpoint	Description
GET	/api/products	List all products
POST	/api/products	Create product (Admin only)

🛒 Order Routes
Method	Endpoint	Description
POST	/api/orders	Create a new order
GET	/api/orders	List logged-in user orders
