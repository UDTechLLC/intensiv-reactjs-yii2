document.addEventListener("DOMContentLoaded", function() {
    $('#packet-form').submit(function (event) {
        event.stopPropagation();

        var data = $(this).serialize();

        if (data['username'] !== '') {
            $.post(
                'package-detail/submit',
                data,
                function (data) {
                    if (data === 1) {
                        //alert('Success');
                      $('#packet-form').closest('.modal').addClass('response-body');

                    } else {
                        console.error(data);
                    }
                }
            );
        }

        return false;
    });
});