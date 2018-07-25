document.addEventListener("DOMContentLoaded", function() {
    $('#contact-form, #form-modal form').submit(function (event) {
        event.stopPropagation();

        var data = $(this).serialize();

        if (data['name'] !== '') {
            $.post(
                'contact-form/submit',
                data,
                function (data) {
                    if (data === 1) {
                        $('#form-modal').modal("hide");
                        setTimeout(showThankPopup, 500);
                        $('#contact-form, #form-modal form')[0].reset();
                    } else {
                        console.error(data);
                    }
                }
            );
        }

        return false;
    });
});