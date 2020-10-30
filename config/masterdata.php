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
        ],
        'color' => [
            TICKET_OPEN => 'primary',
            TICKET_ANSWERED => 'warning',
            TICKET_CUSTOMER_REPLY => 'success',
            TICKET_WAITING_FOR_PROGRESS => 'info',
            TICKET_PROCESSING => 'danger',
            TICKET_CLOSED => 'dark',
        ]
    ],
    'service' => [
        'type' => [
            SERVICE_TOUR => 'Tour',
            SERVICE_HOTEL => 'Hotel',
            SERVICE_TRANSFER => 'Transfer',
            SERVICE_RESTAURANT => 'Restaurant',
        ],
        'status' => [
            ACTIVE => 'Đang mở',
            NOT_ACTIVE => 'Ẩn'
        ]
    ],
    'invoice' => [
        'type' => [
            TYPE_SERVICE => 'Hóa đơn dịch vụ',
            TYPE_PRODUCT => 'Hóa đơn sản phẩm'
        ],
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
        EDITOR => 'Biên tập viên'
    ],
];
