/*
Require library
 */
require('./bootstrap')
window.PerfectScrollbar = require('perfect-scrollbar/dist/perfect-scrollbar.min')

// jQuery validate with Vietnamese
require('jquery-validation/dist/localization/messages_vi.min')

/*
Code
 */

Admin = {
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
            errorElement: 'span',
            errorClass: 'is-invalid invalid-feedback',
            validClass: 'is-valid'
        })
    },

    // Logout global
    logoutGlobal: () => {
        $('.form-logout').submit()
    }
}

// Run onload
$(window).on('load', function () {
    Admin.loginValidate()
})
