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
    'service' => [
        'type' => [
            SERVICE_TOUR => 'Tour',
            SERVICE_HOTEL => 'Hotel',
            SERVICE_TRANSFER => 'Transfer',
            SERVICE_RESTAURANT => 'Restaurant',
        ]
    ],
    'invoice' => [
        'type' => [
            TYPE_SERVICE => 'Hóa đơn dịch vụ',
            TYPE_PRODUCT => 'Hóa đơn sản phẩm'
        ]
    ],
];
