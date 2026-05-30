#Janta Kulhad – Terracotta E-Commerce & Order Management System

#Project Overview

Janta Kulhad is a PHP-MySQL based web application developed for showcasing, managing, and selling eco-friendly terracotta products such as kulhads, diyas, handi pots, and catering clayware products.

The platform provides:
1. Product catalog browsing
2. User registration & login
3. Shopping cart management
4. Checkout functionality
5. Online payment integration using Razorpay
6. Admin panel for inventory management
7. Sales reporting
8. Challan generation in PDF format
9. Customer inquiry management


The project promotes sustainable and environmentally friendly clay products while digitizing traditional pottery businesses.

---

#Key Features:

A] Customer Features:
1. User Registration & Login
2. Product Browsing
3. Product Gallery
4. Add to Cart
5. Checkout System
6. Razorpay Payment Gateway Integration
7. Contact Form
8. Responsive UI

B] Admin Features:
1. Secure Admin Login
2. Product Management
3. Add New Products
4. View Products
5. Sales Dashboard
6. Sales Reports
7. Challan Generation
8. View Generated Challans
9. Database Seeding Utility

---

Technology Stack

A] Technology	Purpose:
1. PHP	Backend Development
2. MySQL	Database Management
3. HTML5	Frontend Structure
4. CSS3	Styling
5. JavaScript	Client-side Functionality
6. Razorpay API	Payment Processing
7. FPDF	PDF Challan Generation
8. PHPMailer	Email Services
9. XAMPP	Local Development Environment

---

Project Structure

Janta/
│
├── admin/
│   ├── admin_login.php
│   ├── add_product.php
│   ├── sales_reports.php
│   ├── generate_challan.php
│   └── view_product.php
│
├── user/
│   ├── login.php
│   ├── cart.php
│   ├── checkout.php
│   ├── gallery.php
│   └── logout.php
│
├── razorpay/
│   ├── payment.php
│   ├── success.php
│   └── failure.php
│
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
│
├── includes/
│   ├── navbar.php
│   ├── footer.php
│   └── admin_navbar.php
│
├── config/
│   └── db.php
│
├── vendor/
│   ├── fpdf/
│   └── phpmailer/
│
└── terracotta.sql

---

Product Categories

The platform supports multiple terracotta product categories including:

Kulhad Cups (50ml – 200ml)
Clay Handi Pots
Earthen Bowls
Diyas
Catering Clayware
Traditional Terracotta Products

---

Workflow

Customer Flow
1. Register/Login
2. Browse Products
3. Add Products to Cart
4. Checkout
5. Complete Razorpay Payment
6. Receive Order Confirmation

Admin Flow
1. Login to Admin Panel
2. Add/Edit Products
3. Monitor Sales
4. Generate Challans
5. Download Reports

---

Payment Integration

The project integrates Razorpay Payment Gateway for secure online transactions.

Features:
1. Online Payments
2. Payment Success Handling
3. Payment Failure Handling
4. Transaction Verification

---

PDF Challan Generation

Using FPDF Library, administrators can:
1. Generate Sales Challans
2. Download Printable PDFs
3. Maintain Transaction Records

---

Sales Management

The Admin Dashboard provides:
1. Product Sales Tracking
2. Order Monitoring
3. Sales Reports
4. Revenue Analysis
5. Challan Records

---

Gallery Section

The gallery showcases:
Kulhad Products
Handmade Terracotta Items
Clay Utensils
Traditional Pottery Collections

---

Installation Guide

Step 1: Install Requirements
XAMPP Server
MySQL Server
PHP 7.x or Above

---

Step 2: Clone Repository
git clone https://github.com/yourusername/janta-kulhad.git

---

Step 3: Configure Database
Create a database in MySQL.
Import:
terracotta.sql

---

Step 4: Configure Database Connection
Edit:
config/db.php

Add:
$host = "localhost";
$user = "root";
$password = "";
$database = "terracotta";

---

Step 5: Start Server
Start:
Apache
MySQL
using XAMPP Control Panel.

---

Step 6: Run Project
Open:
http://localhost/Janta

Admin Panel:
http://localhost/Janta/admin

---

Applications
1. Terracotta Product Stores
2. Pottery Businesses
3. Handmade Product Marketplaces
4. Sustainable Product Commerce
5. Rural Artisan Digitization

---

Future Enhancements
1. Mobile Application
2. AI Product Recommendation System
3. Inventory Forecasting
4. Customer Analytics Dashboard
5. GST Invoice Automation
6. Multi-Vendor Marketplace
7. WhatsApp Order Notifications
8. Cloud Deployment

---

Learning Outcomes

This project demonstrates:
1. Full Stack Web Development
2. Database Management
3. Payment Gateway Integration
4. PDF Generation
5. Session Management
6. E-Commerce Architecture
7. Admin Dashboard Development

---

Author

Anish Nalekar
MSc Computer Science
Web Development Enthusiast


---

License

This project is released under the MIT License.

---

Support

If you found this project useful:

⭐ Star the repository
🍴 Fork the repository
🛠️ Contribute improvements
📢 Share with others

