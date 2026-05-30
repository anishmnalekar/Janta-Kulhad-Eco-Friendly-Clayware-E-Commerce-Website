# Janta Kulhad – Terracotta E-Commerce & Order Management System

## Project Overview

Janta Kulhad is a PHP-MySQL based web application developed for showcasing, managing, and selling eco-friendly terracotta products such as kulhads, diyas, handi pots, and catering clayware products.

The platform provides:

- Product catalog browsing
- User registration & login
- Shopping cart management
- Checkout functionality
- Online payment integration using Razorpay
- Admin panel for inventory management
- Sales reporting
- Challan generation in PDF format
- Customer inquiry management

The project promotes sustainable and environmentally friendly clay products while digitizing traditional pottery businesses.

---

## Key Features

### Customer Features

- User Registration & Login
- Product Browsing
- Product Gallery
- Add to Cart
- Checkout System
- Razorpay Payment Gateway Integration
- Contact Form
- Responsive UI

### Admin Features

- Secure Admin Login
- Product Management
- Add New Products
- View Products
- Sales Dashboard
- Sales Reports
- Challan Generation
- View Generated Challans
- Database Seeding Utility

---

## Technology Stack

| Technology | Purpose |
|------------|---------|
| PHP | Backend Development |
| MySQL | Database Management |
| HTML5 | Frontend Structure |
| CSS3 | Styling |
| JavaScript | Client-side Functionality |
| Razorpay API | Payment Processing |
| FPDF | PDF Challan Generation |
| PHPMailer | Email Services |
| XAMPP | Local Development Environment |

---

## Project Structure

```text
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
```

---

## Product Categories

- Kulhad Cups (50ml–200ml)
- Clay Handi Pots
- Earthen Bowls
- Diyas
- Catering Clayware
- Traditional Terracotta Products

---

## Workflow

### Customer Flow

1. Register/Login
2. Browse Products
3. Add Products to Cart
4. Checkout
5. Complete Razorpay Payment
6. Receive Order Confirmation

### Admin Flow

1. Login to Admin Panel
2. Add/Edit Products
3. Monitor Sales
4. Generate Challans
5. Download Reports

---

## Payment Integration

The project integrates **Razorpay Payment Gateway** for secure online transactions.

### Features

- Online Payments
- Payment Success Handling
- Payment Failure Handling
- Transaction Verification

---

## PDF Challan Generation

Using **FPDF Library**, administrators can:

- Generate Sales Challans
- Download Printable PDFs
- Maintain Transaction Records

---

## Sales Management

The Admin Dashboard provides:

- Product Sales Tracking
- Order Monitoring
- Sales Reports
- Revenue Analysis
- Challan Records

---

## Gallery Section

The gallery showcases:

- Kulhad Products
- Handmade Terracotta Items
- Clay Utensils
- Traditional Pottery Collections

---

## Installation Guide

### Step 1: Install Requirements

- XAMPP Server
- MySQL Server
- PHP 7.x or Above

### Step 2: Clone Repository

```bash
git clone https://github.com/yourusername/janta-kulhad.git
```

### Step 3: Configure Database

Create a database in MySQL and import:

```sql
terracotta.sql
```

### Step 4: Configure Database Connection

Edit:

```php
config/db.php
```

Add:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "terracotta";
```

### Step 5: Start Server

Start:

- Apache
- MySQL

using XAMPP Control Panel.

### Step 6: Run Project

```bash
http://localhost/Janta
```

Admin Panel:

```bash
http://localhost/Janta/admin
```

---

## Applications

- Terracotta Product Stores
- Pottery Businesses
- Handmade Product Marketplaces
- Sustainable Product Commerce
- Rural Artisan Digitization

---

## Future Enhancements

- Mobile Application
- AI Product Recommendation System
- Inventory Forecasting
- Customer Analytics Dashboard
- GST Invoice Automation
- Multi-Vendor Marketplace
- WhatsApp Order Notifications
- Cloud Deployment

---

## Learning Outcomes

This project demonstrates:

- Full Stack Web Development
- Database Management
- Payment Gateway Integration
- PDF Generation
- Session Management
- E-Commerce Architecture
- Admin Dashboard Development

---

## Author

**Anish Nalekar**  
*MSc Computer Science*  
Web Development Enthusiast

---

## License

This project is released under the MIT License.

---

## Support

If you found this project useful:

- ⭐ Star the repository
- 🍴 Fork the repository
- 🛠️ Contribute improvements
- 📢 Share with others
