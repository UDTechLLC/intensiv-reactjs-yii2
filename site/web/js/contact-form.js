document.addEventListener("DOMContentLoaded", function() {
    $('#contact-form').submit(function (event) {
        event.stopPropagation();

        var data = $(this).serialize();

        if ('name' in data && data['name'] !== '') {
            $.post(
                'contact-form/submit',
                data,
                function (data) {
                    if (data === 1) {
                        alert('Success');
                    } else {
                        console.error(data);
                    }
                }
            );
        }

        return false;
    });
});