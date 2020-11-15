<?php
/*
 * Defines
 */

// Roles
define('ADMIN', 'CITY_TOUR_CODE_2XD5IW0MA');
define('USER', 'CITY_TOUR_CODE_9IU7HN5YB');
define('GUIDE', 'CITY_TOUR_CODE_0JE8HIX4A');

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
define('INVOICE_NEW', 0);
define('INVOICE_CONFIRM', 1);
define('INVOICE_HAS_PAID', 2);
define('INVOICE_IN_PROGRESS', 3);
define('INVOICE_COMPLETE', 4);
define('INVOICE_COMPLETE_CONFIRM', 5);
define('INVOICE_SUCCESS', 6);

// Toastr
define('TOASTR', 'Toastr');
define('TOASTR_SUCCESS', 'success');
define('TOASTR_ERROR', 'error');
define('TOASTR_INFO', 'info');
define('TOASTR_WARNING', 'warning');

// Http status
define('HTTP_ERROR_403', 'Không có quyền truy cập');

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

// User
define('BEHAVIOR_SCORE_DEFAULT', 1000);
define('BEHAVIOR_SCORE_DANGER', 300);
define('BEHAVIOR_SCORE_BLOCK', 0);

// Publish
define('PUBLISH', 1);
define('NOT_PUBLISH', 0);
