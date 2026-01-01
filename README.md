# 🥭 Fresh Mango
## A Scalable Multi-Vendor E-commerce Ecosystem

### Fresh Mango is a web-based multi-vendor e-commerce platform designed to modernize the traditional mango supply chain in Bangladesh.
### The system directly connects farmers with customers, eliminates intermediaries, ensures fair pricing, and maintains product quality through an admin-controlled workflow.
### This project was developed as part of CSE416: Web Engineering Lab at Daffodil International University.

## 📌 Project Overview
### Bangladesh is one of the largest mango-producing countries, yet farmers often lose 40–50% of profits due to intermediaries.
### Existing e-commerce platforms are generalized and lack features required for perishable agro-products.
### Fresh Mango introduces a platform-based marketplace where farmers act as sellers and customers buy directly from them.

## 🎯 Project Objectives
### Develop a multi-vendor marketplace for farmers.
### Provide admin-controlled seller and product approval.
### Implement automated commission calculation.
### Ensure secure financial transactions and withdrawals.
### Offer a seamless AJAX-based shopping experience.

## 🧩 Core Features
### Multi-vendor seller system.
### Admin approval workflow for sellers and products.
### Automated commission and revenue splitting.
### AJAX-powered cart and filtering.
### Secure checkout with transaction integrity.
### Seller wallet and withdrawal management.
### Order tracking with status timeline.

## 🏛️ System Architecture
### The system follows the Model–View–Controller (MVC) architectural pattern.

### Model
### Users (Admin, Seller, Customer).
### Sellers.
### Products.
### Orders.
### Order Items.
### Withdrawals.

### View
### Blade templates for frontend user interface.
### Responsive design using Tailwind CSS.

### Controller
### Handles business logic such as cart operations, checkout, approvals, and commission calculations.
### The database is normalized to Third Normal Form (3NF) for scalability and data consistency.

## 🧪 Technology Stack
### Backend: Laravel 12.
### Programming Language: PHP 8.2.
### Frontend: Blade Templates and JavaScript (AJAX / Fetch API).
### Styling: Tailwind CSS and Custom CSS.
### Database: MySQL.
### Admin Panel: FilamentPHP v3.
### Version Control: Git.
### Development Tools: VS Code, XAMPP.

## ⚙️ Implementation Highlights
### Role-based authentication for Admin, Seller, and Customer.
### Secure routing using middleware.
### Order processing implemented using Laravel database transactions.
### Automatic rollback on failure to maintain data integrity.
### Stock validation before checkout.
### Automated commission calculation per product.
### Order confirmation emails using Laravel Mailables.

## 🧪 Testing & Deployment
### Unit testing performed on price and commission logic.
### Black-box testing performed on registration and checkout flows.
### Session security issues fixed through configuration updates.
### Git-based version control used throughout development.
### The system is ready for deployment on shared hosting or VPS.

## 🌍 Impact & Sustainability
### The platform improves farmer income by eliminating intermediaries.
### Farmers gain digital identity and direct market access.
### The system promotes chemical-free and organic produce.
### Digital invoices and records reduce paper usage.
### Secure authentication ensures ethical data handling.
### The platform is scalable and sustainable using modern web technologies.

## ⚠️ Limitations
### Live payment gateway integration is not fully implemented.
### Real-time courier API integration is not available.
### No native mobile application is developed.
### The system is currently web-based and responsive only.

## 🚀 Future Enhancements
AI-based mango quality assessment using image analysis.
Integration with courier services such as Pathao or RedX.
Bangla language localization for rural farmers.
Native Android and iOS mobile applications.
Advanced analytics dashboard for sellers and admin.

## 📜 License
This project was developed for academic and learning purposes.
You may use it for study and reference with proper attribution.
