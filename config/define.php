<?php
/*
 * Defines
 */

// Roles
define('ADMIN', 1);
define('USER', 0);
define('PARTNER', 2);
define('EMPLOYEE', 3);

// Active
define('ACTIVE', 1);
define('NOT_ACTIVE', 0);

// Star
define('STAR_DEFAULT', 5);

// Payment
define('PAYPAL', 'Paypal');
define('STRIPE', 'Stripe');
define('CREDIT_CARD', 'Credit card');

// Type service, product
define('TYPE_SERVICE', 10);
define('TYPE_PRODUCT', 20);

// Status contact
define('TICKET_OPEN', 10);
define('TICKET_ANSWERED', 20);
define('TICKET_CUSTOMER_REPLY', 30);
define('TICKET_WAITING_FOR_PROGRESS', 40);
define('TICKET_PROCESSING', 50);
define('TICKET_CLOSED', 60);

// Service type
define('SERVICE_TOUR', 10);
define('SERVICE_HOTEL', 20);
define('SERVICE_TRANSFER', 30);
define('SERVICE_RESTAURANT', 40);

// Toastr
define('TOASTR', 'Toastr');
define('TOASTR_SUCCESS', 'success');
define('TOASTR_ERROR', 'error');
define('TOASTR_INFO', 'info');
define('TOASTR_WARNING', 'warning');

// Http status
define('HTTP_403', 'Không có quyền truy cập');

// Pagination service
define('PAGINATION_TOUR', 50);
define('PAGINATION_HOTEL', 50);
define('PAGINATION_TRANSFER', 50);
define('PAGINATION_RESTAURANT', 50);
define('PAGINATION_ARTICLE', 10);

// Limit text tour
define('TOUR_LIMIT_ADDRESS', 25);
define('TOUR_LIMIT_DESC', 50);

// Articles
define('ARTICLES_LIMIT_CONTENT', 20);
