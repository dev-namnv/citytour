"use strict";

// Class Definition
var KTLogin = function() {
    var _login;

    var _showForm = function(form) {
        var cls = 'login-' + form + '-on';
        var form = 'kt_login_' + form + '_form';

        _login.removeClass('login-forgot-on');
        _login.removeClass('login-signin-on');
        _login.removeClass('login-signup-on');

        _login.addClass(cls);

        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }

    var _handleSignInForm = function() {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_signin_form'),
			{
				fields: {
					username: {
						validators: {
							notEmpty: {
								message: 'Tên tài khoản là bắt buộc'
							},
                            regexp: {
                                regexp: '^(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$',
                                message: 'Định dạng tên đăng nhập không hợp lệ'
                            }
						}
					},
					password: {
						validators: {
							notEmpty: {
								message: 'Mật khẩu là bắt buộc'
							}
						}
					}
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        $('#kt_login_signin_submit').on('click', function () {
            validation.validate().then(function(status) {
		        if (status !== 'Valid') {
                    swal.fire({
                        text: "Xin lỗi, có vẻ như đã phát hiện thấy một số lỗi, vui lòng thử lại.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, tôi hiểu rồi!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        KTUtil.scrollTop();
                    });
				}
		    });
        });

        // Handle forgot button
        $('#kt_login_forgot').on('click', function (e) {
            e.preventDefault();
            _showForm('forgot');
        });

        // Handle signup
        $('#kt_login_signup').on('click', function (e) {
            e.preventDefault();
            _showForm('signup');
        });
    }

    var _handleSignUpForm = function(e) {
        var validation;
        var form = KTUtil.getById('kt_login_signup_form');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			form,
			{
				fields: {
					first_name: {
						validators: {
							notEmpty: {
								message: 'Tên không được để trống'
							}
						}
					},
					email: {
                        validators: {
							notEmpty: {
								message: 'Địa chỉ email không được để trống'
							},
                            emailAddress: {
								message: 'Định dạng email không hợp lệ'
							}
						}
					},
                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'Số điện thoại không được để trống'
                            },
                            regexp: {
                                regexp: '^(0[0-9]{9})$',
                                message: 'Định dạng số điện thoại không hợp lệ'
                            }
                        }
                    },
					username: {
                        validators: {
							notEmpty: {
								message: 'Tên đăng nhập không được để trống'
							},
                            stringLength: {
							    min: 8,
                                max: 12,
                                message: 'Nhập từ 8 đến 12 ký tự'
                            },
                            regexp: {
							    regexp: '^(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$',
                                message: 'Định dạng tên đăng nhập không hợp lệ'
                            }
						}
					},
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Mật khẩu không được để trống'
                            }
                        }
                    },
                    password_confirm: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng nhập lại mật khẩu'
                            },
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'Xác thực mật khẩu không trùng khớp'
                            }
                        }
                    },
                    agree: {
                        validators: {
                            notEmpty: {
                                message: 'Bạn phải chấp thuận điều khoản và điều kiện'
                            }
                        }
                    },
                    "images[]": {
                        validators: {
                            notEmpty: {
                                message: 'Bạn phải tải ảnh chứng minh thư lên'
                            }
                        }
                    }
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                    bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        $('#kt_login_signup_submit').on('click', function (e) {
            e.preventDefault();

            validation.validate().then(function(status) {
		        if (status !== 'Valid') {
                    swal.fire({
                        text: "Biểu mẫu đăng ký không chính xác, thử lại",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, tôi hiểu rồi!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        KTUtil.scrollTop();
                    });
				}
		    });
        });

        // Handle cancel button
        $('#kt_login_signup_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    var _handleForgotForm = function(e) {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_forgot_form'),
			{
				fields: {
					email: {
						validators: {
							notEmpty: {
								message: 'Địa chỉ email không được để trống'
							},
                            emailAddress: {
								message: 'Định dạng email không hợp lệ'
							}
						}
					}
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                    bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        // Handle submit button
        $('#kt_login_forgot_submit').on('click', function () {

            validation.validate().then(function(status) {
		        if (status == 'Valid') {
                    // Submit form
                    KTUtil.scrollTop();
				} else {
					swal.fire({
		                text: "Sorry, looks like there are some errors detected, please try again.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
				}
		    });
        });

        // Handle cancel button
        $('#kt_login_forgot_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            _login = $('#kt_login');

            _handleSignInForm();
            _handleSignUpForm();
            _handleForgotForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
