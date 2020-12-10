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
            TICKET_OPEN => 'bg-primary',
            TICKET_ANSWERED => 'bg-warning',
            TICKET_CUSTOMER_REPLY => 'bg-success',
            TICKET_WAITING_FOR_PROGRESS => 'bg-info',
            TICKET_PROCESSING => 'bg-danger',
            TICKET_CLOSED => 'bg-secondary text-dark',
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
            INVOICE_NEW => 'Đã tiếp nhận',
            INVOICE_CONFIRM => 'Đã xác nhận',
            INVOICE_HAS_PAID => 'Đã thanh toán',
            INVOICE_IN_PROGRESS => 'Đang diễn ra',
            INVOICE_COMPLETE => 'Đã hoàn thành',
            INVOICE_COMPLETE_CONFIRM => 'Xác nhận hoàn thành',
            INVOICE_SUCCESS => 'Hoàn tất',
        ],
        'color' => [
            INVOICE_NEW => 'text-primary',
            INVOICE_CONFIRM => 'text-primary',
            INVOICE_HAS_PAID => 'text-success',
            INVOICE_IN_PROGRESS => 'text-success',
            INVOICE_COMPLETE => 'text-success',
            INVOICE_COMPLETE_CONFIRM => 'text-success',
            INVOICE_SUCCESS => 'text-success',

        ]
    ],
    'role' => [
        USER => 'Người dùng thông thường',
        ADMIN => 'Quản trị viên',
        GUIDE => 'Hướng dẫn viên'
    ],
];
