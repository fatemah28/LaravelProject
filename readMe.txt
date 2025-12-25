User Management API - Laravel + JWT
==================================

This project is a RESTful API built with Laravel for managing users with:
- Registration
- Login with JWT Authentication
- Roles (Admin, User)
- Email Verification
- Protected Routes
- Validation & Security

----------------------------------
Requirements
----------------------------------
- PHP >= 8.2
- Composer
- MySQL / PostgreSQL / SQLite
- Node.js (optional)
- Laravel 12
- Postman (for testing)

----------------------------------
Installation
----------------------------------

1. Clone the repository:
   git clone <your-repo-url>
   cd project-folder

2. Install dependencies:
   composer install

3. Copy env file:
   cp .env.example .env

4. Generate app key:
   php artisan key:generate

5. Configure database in .env:
   DB_DATABASE=your_db
   DB_USERNAME=your_user
   DB_PASSWORD=your_pass

6. Generate JWT secret:
   php artisan jwt:secret

7. Run migrations:
   php artisan migrate

8. Run seeders (roles & users):
   php artisan db:seed

9. Start server:
   php artisan serve

Server will run at:
http://127.0.0.1:8000

----------------------------------
JWT Authentication
----------------------------------
This project uses tymon/jwt-auth.

After login/register, you will receive a token.
Use it in headers:

Authorization: Bearer YOUR_TOKEN

----------------------------------
Email Verification
----------------------------------
After registration, a verification email is sent.
User must verify email before accessing protected routes.

In .env you can use:
MAIL_MAILER=log

Emails will appear in:
storage/logs/laravel.log

----------------------------------
API Routes
----------------------------------

Base URL:
http://127.0.0.1:8000/api

----------------------------------
Auth Routes (Public)
----------------------------------

1) Register
POST /api/register

Body (JSON):
{
  "name": "Fatemah",
  "email": "fatemah@test.com",
  "password": "Password1",
  "password_confirmation": "Password1"
}

Response: 201
{
  "message": "Register successful. Please verify your email.",
  "user": {...},
  "token": "JWT_TOKEN"
}

Validation:
- All fields required
- Valid email
- Unique email
- Password min 8 chars, contains uppercase & number
- Password confirmation required

----------------------------------

2) Login
POST /api/login

Body:
{
  "email": "fatemah@test.com",
  "password": "Password1"
}

Response: 200
{
  "message": "Login successful",
  "user": {...},
  "token": "JWT_TOKEN"
}

If email not verified:
Status: 403

----------------------------------

----------------------------------
Email Verification Routes
----------------------------------

Verify email:
GET /api/email/verify/{id}/{hash}

Resend verification email:
POST /api/email/resend
Header: Authorization: Bearer TOKEN

----------------------------------
Protected Routes
----------------------------------
These routes require:
- Valid JWT Token
- Verified Email

Header:
Authorization: Bearer TOKEN

Example:
GET /api/profile

----------------------------------
Roles
----------------------------------
Roles implemented:
- Admin
- User

Users have many-to-many relation with roles using:
role_user pivot table.

Default role on registration: User.

----------------------------------
Logout
----------------------------------

POST /api/logout
Header: Authorization: Bearer TOKEN

Response:
{
  "message": "Successfully logged out"
}

----------------------------------
Testing
----------------------------------
Use Postman or similar tool.

Steps:
1. Register a user
2. Check email/log and verify
3. Login to get JWT token
4. Use token in protected routes

----------------------------------
Security
----------------------------------
- Passwords are hashed using Hash::make()
- JWT for stateless authentication
- Validation on all inputs
- Email verification required
- Role-based access ready

----------------------------------
Author
----------------------------------
Developed as a backend technical task using:
Laravel 12 + JWT Authentication.

----------------------------------
