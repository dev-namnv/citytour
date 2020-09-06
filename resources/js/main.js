/*
Main Js
 */

// jQuery validate with Vietnamese
require('jquery-validation/dist/localization/messages_vi.min')

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
            // errorElement: 'span',
            invalidClass: 'is-invalid',
            validClass: 'is-valid'
        })
    },

    // Logout global
    logoutGlobal: () => {
        $('.form-logout').submit()
    }
}

$(window).on('load', function () {
    Main.loginValidate()
})
