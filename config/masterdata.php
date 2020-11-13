<?php
/*
 * Convert data to master data
 */

return [
    'active' => [
        ACTIVE => 'Hiện thị',
        NOT_ACTIVE => 'Ẩn'
    ],
    'contact' => [
        'status' => [
            TICKET_OPEN => 'Ticket đang mở',
            TICKET_ANSWERED => 'Đã phản hồi Ticket',
            TICKET_CUSTOMER_REPLY => 'Khách hàng đã phản hồi',
            TICKET_WAITING_FOR_PROGRESS => 'Đang chờ xử lý',
            TICKET_PROCESSING => 'Đang xử lý',
            TICKET_CLOSED => 'Ticket đã đóng'
        ]
    ],
    'tour' => [
        'active' => [
            ACTIVE => 'Đã xác thực',
            NOT_ACTIVE => 'Chưa xác thực'
        ],
        'publish' => [
            PUBLISH => 'Công khai',
            NOT_PUBLISH => 'Ẩn'
        ]
    ],
    'invoice' => [
        'status' => [
            PAYMENT_ORDERED => 'Đã đặt hàng',
            PAYMENT_CONFIRMED => 'Đã xác thực'
        ],
        'payment_status' => [
            PAYMENT_PAID => 'Đã thanh toán',
            PAYMENT_UNPAID => 'Chưa thanh toán'
        ]
    ],
    'role' => [
        USER => 'Người dùng thông thường',
        ADMIN => 'Quản trị viên',
        GUIDE => 'Hướng dẫn viên'
    ],
];
