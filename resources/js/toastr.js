window.toastr = require('toastr/toastr');
require('jquery.easing');

toastr.options.hideEasing = 'easeInBack';
toastr.options.closeEasing = 'easeInBack';

Toastr = {
    show: function (value) {
        const status = value.status ?? 'success';
        toastr[status](value.content, value.title)
    }
}
