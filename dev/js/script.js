$(function(){
	_this = $(this);

	$("[role='button']").click(function(e){
		e.preventDefault();
	});

    // if($('#ads-modal').length){
    //     $('#ads-modal').modal('show')
    // }

    if($('.section select').length){
        $('.section select').select2({
            minimumResultsForSearch: Infinity
        });
	}

    $('select').on('select2:open', function(e){
        $('.select2-results__options').scrollbar().parent().addClass('scrollbar-inner');
    });

});
new Vue({
    el: '#app',
    data: {
        json: null,
    },
    created: function () {
        fetch("/schools.json").then(r => r.json()).then(json => {
            this.json=json;
        });
    }
});

