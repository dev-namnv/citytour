/* Import libraries */
require('./validation')
require('./toastr')
window.PerfectScrollbar = require('perfect-scrollbar/dist/perfect-scrollbar')

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

    addToCart: (id) => {
        const date = $('#js-tour-batch').val()
        axios.post(`${BASE_URL}/cart/${id}/${date}/add`)
            .then(res => {
                console.log(res)
            })
            .catch(err => {
                console.log(err)
            })
    }
}

// Run function
$(window).on('load', () => {
    Main.loginValidate()
    Main.forgotPasswordValidate()
    Main.formContactValidate()
})
