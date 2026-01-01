# 🥭 Fresh Mango
## A Scalable Multi-Vendor E-commerce Ecosystem

Fresh Mango is a web-based multi-vendor e-commerce platform designed to modernize the traditional mango supply chain in Bangladesh. The system connects farmers directly with customers, eliminates intermediaries, ensures fair pricing, and maintains product quality through an admin-controlled workflow.

This project was developed as part of the CSE416: Web Engineering Lab course at Daffodil International University.

## Project Overview

Bangladesh is one of the largest mango-producing countries, yet farmers often lose 40–50% of profits due to intermediaries. Existing e-commerce platforms are generalized and do not support the specific needs of perishable agro-products.

Fresh Mango introduces a platform-based marketplace where farmers act as independent sellers and customers can buy mangoes directly from the source.

## Project Objectives

- Develop a multi-vendor marketplace for farmers
- Provide admin-controlled seller and product approval
- Implement automated commission calculation
- Ensure secure financial transactions and withdrawals
- Offer a seamless AJAX-based shopping experience

## Core Features

- Multi-vendor seller system
- Admin approval workflow for sellers and products
- Automated commission and revenue splitting
- AJAX-powered cart and product filtering
- Secure checkout with transaction integrity
- Seller wallet and withdrawal management
- Order tracking with status timeline

## System Architecture

The system follows the Model–View–Controller (MVC) architectural pattern.

- Model: Users, Sellers, Products, Orders, Order Items, Withdrawals
- View: Blade templates with responsive UI using Tailwind CSS
- Controller: Handles cart operations, checkout logic, approvals, and commission calculations

The database is normalized to Third Normal Form (3NF) to ensure scalability and data consistency.

## Technology Stack

- Backend Framework: Laravel 12
- Programming Language: PHP 8.2
- Frontend: Blade Templates, JavaScript (AJAX / Fetch API)
- Styling: Tailwind CSS and Custom CSS
- Database: MySQL
- Admin Panel: FilamentPHP v3
- Version Control: Git
- Development Tools: VS Code, XAMPP

## Implementation Highlights

- Role-based authentication for Admin, Seller, and Customer
- Secure routing using middleware
- Order processing implemented using Laravel database transactions
- Automatic rollback on failure to maintain data integrity
- Stock validation before checkout
- Automated commission calculation per product
- Order confirmation emails using Laravel Mailables

## Testing & Deployment

- Unit testing performed on price and commission logic
- Black-box testing performed on registration and checkout flows
- Session security issues fixed through configuration updates
- Git-based version control used throughout development
- Ready for deployment on shared hosting or VPS

## Impact & Sustainability

- Improves farmer income by eliminating intermediaries
- Provides farmers with digital identity and direct market access
- Promotes chemical-free and organic produce
- Reduces paper usage through digital invoices and records
- Ensures ethical data handling and secure authentication
- Designed for scalability and long-term sustainability

## Limitations

- Live payment gateway integration not fully implemented
- Real-time courier API integration not available
- No native mobile application (web-only, responsive)

## Future Enhancements

- AI-based mango quality assessment using image analysis
- Courier API integration (Pathao, RedX)
- Bangla language localization for rural farmers
- Native Android and iOS mobile applications
- Advanced analytics dashboard for sellers and admin


## License

This project was developed for academic and learning purposes. You may use it for study and reference with proper attribution.


## 🚀 Future Enhancements
AI-based mango quality assessment using image analysis.
Integration with courier services such as Pathao or RedX.
Bangla language localization for rural farmers.
Native Android and iOS mobile applications.
Advanced analytics dashboard for sellers and admin.

## 📜 License
This project was developed for academic and learning purposes.
You may use it for study and reference with proper attribution.
