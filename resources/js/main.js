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
                firstName: {required: true},
                lastName: {required: true},
                email: {required: true},
                phone: {required: true},
                title: {required: true},
                content: {required: true},
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
                title: {
                    required: getMessageValidation('required', {attribute: 'subject'}),
                },
                content: {
                    required: getMessageValidation('required', {attribute: 'message'}),
                },
            },
            invalidClass: 'is-invalid',
            validClass: 'is-valid'
        })
    }
}

// Run function
$(window).on('load', () => {
    Main.loginValidate()
    Main.forgotPasswordValidate()
    Main.formContactValidate()
})
