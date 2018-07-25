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
                        $('#contact-form, #form-modal form')[0].reset();
                        showThankPopup();
                    } else {
                        console.error(data);
                    }
                }
            );
        }

        return false;
    });
});

document.addEventListener("DOMContentLoaded", function() {
  $('#phone-header-form').submit(function (event) {
    event.stopPropagation();

    var data = $(this).serialize();

    if (data['phone'] !== '') {
      $.post(
        'header-form/submit',
        data,
        function (data) {
          if (data === 1) {
            $('#phone-header-form')[0].reset();
            showThankPopup();
          } else {
            console.error(data);
          }
        }
      );
    }

    return false;
  });
});