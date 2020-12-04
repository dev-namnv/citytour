/* Import libraries */
require('./validation')
require('./toastr')

// Main js
Main = {
    // Validate form login
    loginValidate: () => {
        $('.form-login').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: getMessageValidation('required', {attribute: 'email'}),
                    email: getMessageValidation('email', {attribute: 'email'})
                },
                password: {
                    required: getMessageValidation('required', {attribute: 'password'})
                }
            },
            invalidClass: 'is-invalid',
            validClass: 'is-valid'
        })
    },

    // Logout global
    logoutGlobal: () => {
        $('.form-logout').submit()
    },

    forgotPasswordValidate: () => {
        $('.form-forgot-password').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: getMessageValidation('required', {attribute: 'email'}),
                    email: getMessageValidation('email', {attribute: 'email'})
                }
            },
            invalidClass: 'is-invalid',
            validClass: 'is-valid'
        })
    },

    formContactValidate: () => {
        $('.form-contact').validate({
            rules: {
                firstName: {
                    required: true,
                    maxlength:100,
                },
                lastName: {
                    required: true,
                    maxlength:100,
                },
                email: {
                    required: true,
                    maxlength:100,
                },
                phone: {required: true},
                subject: {
                    required: true,
                    minlength: 10,
                    maxlength: 100,
                },
                messages: {
                    required: true,
                    minlength: 20,
                },
            },
            messages: {
                firstName: {
                    required: getMessageValidation('required', {attribute: 'first_name'}),
                },
                lastName: {
                    required: getMessageValidation('required', {attribute: 'last_name'}),
                },
                email: {
                    required: getMessageValidation('required', {attribute: 'email'}),
                },
                phone: {
                    required: getMessageValidation('required', {attribute: 'phone'}),
                },
                subject: {
                    required: getMessageValidation('required', {attribute: 'subject'}),
                },
                messages: {
                    required: getMessageValidation('required', {attribute: 'message'}),
                },
            },
            invalidClass: 'is-invalid',
            validClass: 'is-valid'
        })
    },

    addToWishlist: (tour_id) => {
        $.ajax({
            type: "POST",
            url: `${window.location.origin}/wishlist/add/${tour_id}`,
            data: {
                _token: $("meta[name='csrf-token']").attr('content'),
            },
            success: (data) => {
                Toastr.show({
                    "status": data.status,
                    "content": data.content
                })
            },
            error: (error) => {
                Toastr.show({
                    "status": error.responseJSON.status,
                    "content": error.responseJSON.content
                })
            }
        })
    },

    removeTourInWishlist: (tour_id) => {
        $.ajax({
            type: "POST",
            url: `${window.location.origin}/wishlist/remove/${tour_id}`,
            data: {
                _token: $("meta[name='csrf-token']").attr('content'),
                _method: "DELETE"
            },
            success: (data) => {
                Toastr.show({
                    "content": "Xóa tour khỏi danh sách yêu thích thành công"
                });
                $(`#tour_${data.tour_id}`).hide()
            },
            error: (error) => {
                Toastr.show({
                    "status": "error",
                    "content": "Xóa tour khỏi danh sách yêu thích thất bại"
                })
            }
        })
    }
}

// Run function
$(window).on('load', () => {
    Main.loginValidate()
    Main.forgotPasswordValidate()
    Main.formContactValidate()
})
