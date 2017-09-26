$(function(){
	_this = $(this);

	$("[role='button']").click(function(e){
		e.preventDefault();
	});

    // if($('#ads-modal').length){
    //     $('#ads-modal').modal('show')
    // }



    // if($('.section select').length){
     //    $('.section select').select2({
     //        minimumResultsForSearch: Infinity
     //    });
	// }

    $('select').on('select2:open', function(e){
        $('.select2-results__options').scrollbar().parent().addClass('scrollbar-inner');
    });




});

/*select 2 component*/
Vue.component('select2', {
    props: ['options', 'value'],
    template: '#select2-template',
    mounted: function () {
        let vm = this
        $(this.$el)
        // init select2
            .select2({
                data: this.options,
                minimumResultsForSearch: Infinity
            })
            .val(this.value != null ? this.value : 'placeholder')
            .trigger('change')
            // emit event on change.
            .on('change', function () {
                vm.$emit('input', this.value)
            })
    },
    watch: {
        value: function (value) {
            // update value
            $(this.$el).val(value).trigger('change');
        },
        options: function (options) {
            // update options
            $(this.$el).empty().select2({ data: options })
        }
    },
    destroyed: function () {
        $(this.$el).off().select2('destroy')
    }
});


let app = new Vue({
    el: '#app',
    data: {
        schools: null,
        listSchools: null,
        schoolViewStatus: false,
        selectSchool: '',
        schoolView: ''
    },
    created: function () {
        fetch("/schools.json").then(r => r.json()).then(json => {
            this.schools = json;
            this.listSchools = json;
        });
    },
    methods:{
        changeCheckboxLicenceA(){
            this.listSchools = this.schools.filter(school => school.moto);
        },
        changeCheckboxLicenceB(){
            this.listSchools = this.schools;
        },
        openSchoolView(){
            this.schoolViewStatus = true
            let self = this;

            this.schools.filter(function( school) {
                if( school.id == self.selectSchool){
                    self.schoolView = school
                    $('.progress-bar.support').width(parseInt(self.schoolView.support) +'%')
                }
            });
        }
    }
});

