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
            INVOICE_NEW => 'bg-dark-o-80 text-white',
            INVOICE_CONFIRM => 'bg-info',
            INVOICE_HAS_PAID => 'bg-primary',
            INVOICE_IN_PROGRESS => 'bg-secondary text-dark',
            INVOICE_COMPLETE => 'bg-danger',
            INVOICE_COMPLETE_CONFIRM => 'bg-warning',
            INVOICE_SUCCESS => 'bg-success',

        ]
    ],
    'role' => [
        USER => 'Người dùng thông thường',
        ADMIN => 'Quản trị viên',
        GUIDE => 'Hướng dẫn viên'
    ],
];
