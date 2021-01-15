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
define('HTTP_ERROR_404', 'Đường dẫn có thể bị lỗi');
define('HTTP_ERROR_400', 'Request không hợp lệ');
define('HTTP_ERROR_500', 'Có lỗi không xác định xảy ra');

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

// Slug
define('REGEX_SLUG', '/^[^<>]*$/');

// Payment
define('PAYMENT_STATUS_FAIL', 0);
define('PAYMENT_STATUS_SUCCESS', 1);
define('PAYMENT_TYPE_VNPAY', 'VNPAY');
define('PAYMENT_CODE', 'payment_code');

// Tour filter
define('TOUR_POPULAR', 5);
define('TOUR_RATING', 3);

// Username
define('REGEX_USERNAME', '/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/');

// Payment
define('PAY_TYPE_PAYMENT_TO_GUIDE', 100);
define('PAY_TYPE_REFUND_TO_USER', 200);
define('PAY_STATUS_REQUEST', 100);
define('PAY_STATUS_CONFIRM', 200);

define('PAGINATION_INVOICE', 20);
define('CHECKOUT_INFO_INVOICE', 'checkout_info_invoice');

// Check account is register
define('IS_REGISTER', 1);
define('IS_NOT_REGISTER', 0);

// Số giờ sau khi book có thể hoàn tiền 100%
define('REFUND_HOURS', 5);
