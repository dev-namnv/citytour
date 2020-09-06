/* Import libraries */
require('jquery-validation/dist/localization/messages_vi.min')

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
            invalidClass: 'is-invalid',
            validClass: 'is-valid'
        })
    }
}

// Run function
$(window).on('load', () => {
    Main.loginValidate()
    Main.forgotPasswordValidate()
})
