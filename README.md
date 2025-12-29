🛒 Laravel E-Commerce Cart System

A simple e-commerce cart system built with Laravel 12 and Livewire v3, featuring product listing, cart management, checkout flow, background jobs, and scheduled reports.

🚀 Tech Stack
Laravel 12
Livewire v3
Laravel Breeze (auth starter kit)
Tailwind CSS
MySQL
Queues & Scheduler
Mail (Log / SMTP)

📦 Features
Product listing with stock status
Add to cart with live counter
Increment / decrement cart items
Cart total calculation
Checkout process
Low stock email alert (queue job)
Daily sales report email (scheduled job)
Reusable Blade UI components

🗂️ Database Overview
Main tables:
users
products
carts
cart_items
orders
order_items
Each order stores the final total amount.

🔄 Application Flow
User logs in
Views product list
Adds product to cart
Manages cart (quantity / remove)
Checkout creates an order
Stock updates
Jobs trigger emails:
Low stock alert
Daily sales report

🧠 Architecture & Patterns
Livewire Components for UI logic
Service / Repository pattern for cart logic
Queue Jobs for emails
Scheduler for daily reports
Blade Components for buttons

🧵 Background Jobs
LowStockJob
Triggers when product stock falls below threshold

DailySalesReportJob
Sends daily order & revenue summary

⏰ Scheduler
php artisan schedule:list
Daily sales report runs at:
23:59 (server time)

Run daily report manually
php artisan tinker
dispatch(new App\Jobs\DailySalesReportJob());

📧 Mail Configuration
Emails are currently logged using:
MAIL_MAILER=log

Change to SMTP for production.

⚙️ Setup
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run dev
php artisan serve

Run queues:
php artisan queue:work

🔮 Future Improvements
Payment gateway integration
Admin dashboard
Coupon system
Inventory history
API endpoints

👤 Author
Built as a learning-focused, clean-architecture Laravel project.
