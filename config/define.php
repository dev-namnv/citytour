<?php
/*
 * Defines
 */

// Roles
define('ADMIN', 1);
define('USER', 0);
define('GUIDE', 2);

// Active
define('ACTIVE', 1);
define('NOT_ACTIVE', 0);

// Star
define('STAR_DEFAULT', 5);

// Payment
define('PAYPAL', 'Paypal');
define('STRIPE', 'Stripe');
define('CREDIT_CARD', 'Credit card');

// Status contact
define('TICKET_OPEN', 10);
define('TICKET_ANSWERED', 20);
define('TICKET_CUSTOMER_REPLY', 30);
define('TICKET_WAITING_FOR_PROGRESS', 40);
define('TICKET_PROCESSING', 50);
define('TICKET_CLOSED', 60);

// Invoice
define('PAYMENT_PAID', 1);
define('PAYMENT_UNPAID', 0);
define('PAYMENT_ORDERED', 0);
define('PAYMENT_CONFIRMED', 1);

// Toastr
define('TOASTR', 'Toastr');
define('TOASTR_SUCCESS', 'success');
define('TOASTR_ERROR', 'error');
define('TOASTR_INFO', 'info');
define('TOASTR_WARNING', 'warning');

// Http status
define('HTTP_403', 'Không có quyền truy cập');

// Pagination service
define('PAGINATION_TOUR', 10);
define('PAGINATION_HOTEL', 10);
define('PAGINATION_TRANSFER', 10);
define('PAGINATION_RESTAURANT', 10);
define('PAGINATION_ARTICLE', 10);
// Limit text tour
define('TOUR_LIMIT_ADDRESS', 45);
define('TOUR_LIMIT_DESC', 50);

// Articles
define('ARTICLES_LIMIT_CONTENT', 20);
