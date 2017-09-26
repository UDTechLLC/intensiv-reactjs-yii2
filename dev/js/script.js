$(function(){

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

/*create graph config school view*/
function createConfig(details, data) {
    return {
        type: 'line',
        data: {
            labels: ['Kundsupport', 'Lärarlegitimation', 'Pedagogik', 'Miljöfordon', 'Rekommendation'],
            datasets: [{
                label: '',
                steppedLine: details.steppedLine,
                data: data,
                borderColor: details.color,
                borderWidth: 9,
                pointBackgroundColor: '#0eb4fc',
                pointRadius: 8,
                pointHoverRadius: 8,
                pointBorderWidth: 6,
                pointHoverBorderWidth: 6,
                pointBorderColor: '#274f7a',
                fill: false,
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio:false,
            title: {
                display:false,
                text: false,
            },
            scales: {
                xAxes: [{
                    display: false
                }]
            },
            layout: {
                padding: {
                    top: 15,
                    bottom:15,
                    right:15
                }
            },
        }
    };
}
function createGraph(data) {
    var container = document.querySelector('.graph');

    var steppedLineSettings = [{
        steppedLine: "",
        label: "",
        color: '#028fcc'
    }];

    steppedLineSettings.forEach(function(details) {
        var div = document.createElement('div');
        div.classList.add('chart-container');

        var canvas = document.createElement('canvas');
        div.appendChild(canvas);
        container.appendChild(div);

        var ctx = canvas.getContext('2d');
        var config = createConfig(details, data);
        Chart.defaults.global.legend.display = false;
        new Chart(ctx, config);
    });
};

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
            .val('placeholder')
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
            $(this.$el).empty().select2({ data: options });
            $(this.$el).select2('update');
        }
    },
    destroyed: function () {
        $(this.$el).off().select2('destroy')
    }
});


let app = new Vue({
    el: '#app',
    data: {
        pickedLicense: '',
        schools: null,
        listSchools: null,
        listPlaces: null,
        schoolViewStatus: false,
        selectSchool: '',
        selectPlace: '',
        schoolView: ''
    },
    created: function () {
        fetch("/schools.json").then(r => r.json()).then(json => {
            this.schools = json;
            this.listSchools = this.schools;
            this.listPlaces = this.schools;
            // this.listPlaces.sort(function(a, b){
            //     if(a.city < b.city) return -1;
            //     if(a.city > b.city) return 1;
            //     return 0;
            // })
        });
    },
    methods:{
        changeLicense(){
            if(this.pickedLicense == 'a' || this.pickedLicense == 'a1' || this.pickedLicense == 'a2' || this.pickedLicense == 'am') {
                this.listSchools = this.schools.filter(school => school.moto);
                this.listPlaces = this.schools.filter(school => school.moto);
            }else{
                this.listSchools = this.schools;
                this.listPlaces = this.schools;
            }
        },

        openSchoolView(){
            this.schoolViewStatus = true
            let self = this;
            this.schools.filter(function( school) {
                let schoolId = '';
                if(self.selectSchool === ''){
                    schoolId = self.selectPlace;
                }else{
                    schoolId = self.selectSchool;
                }
                if( school.id == schoolId){
                    self.schoolView = school
                    $('.progress-bar.support').width(parseInt(self.schoolView.support) +'%')
                    $('.progress-bar.registrationTeacher').width(parseInt(self.schoolView.registrationTeacher) +'%')
                    $('.progress-bar.pedagogical').width(parseInt(self.schoolView.pedagogical) +'%')
                    $('.progress-bar.cleanVehicles').width(parseInt(self.schoolView.cleanVehicles) +'%')
                    $('.progress-bar.recommendation').width(parseInt(self.schoolView.recommendation) +'%')
                    createGraph( [
                        self.schoolView.support,
                        self.schoolView.registrationTeacher,
                        self.schoolView.pedagogical,
                        self.schoolView.cleanVehicles,
                        self.schoolView.recommendation
                    ])
                }
            });
        },
        closeSchoolView(){
            this.schoolViewStatus = false
            let self = this;
            $('.progress-bar.support').width(0)
            $('.progress-bar.registrationTeacher').width(0)
            $('.progress-bar.pedagogical').width(0)
            $('.progress-bar.cleanVehicles').width(0)
            $('.progress-bar.recommendation').width(0)
            setTimeout(function () {
                    $('.graph .chart-container').remove()
            },400)

        }
    }
});

