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
        }
    },
    destroyed: function () {
        $(this.$el).off().select2('destroy')
    }
});


let app = new Vue({
    el: '#app',
    data: {
        latitudeMap: 59.339783,
        longitudeMap: 17.939713,
        mapLocate: null,
        markersList: [],
        pickedLicense: '',
        schools: null,
        listSchools: null,
        listPlaces: null,
        schoolViewStatus: false,
        selectSchool: '',
        selectPlace: '',
        schoolView: ''
    },
    mounted: function () {

        let myLatlng = new google.maps.LatLng(this.latitudeMap, this.longitudeMap);
        let map = new google.maps.Map(document.getElementById('map-layout'), {
            center: myLatlng,
            zoom: 9,
            styles: [
                {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
                {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
                {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                {
                    featureType: 'administrative.locality',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#b1c5cd'}]
                },
                {
                    featureType: 'poi',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#b1c5cd'}]
                },
                {
                    featureType: 'poi.park',
                    elementType: 'geometry',
                    stylers: [{color: '#263c3f'}]
                },
                {
                    featureType: 'poi.park',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#6b9a76'}]
                },
                {
                    featureType: 'road',
                    elementType: 'geometry',
                    stylers: [{color: '#18688d'}]
                },
                {
                    featureType: 'road',
                    elementType: 'geometry.stroke',
                    stylers: [{color: '#3c87ab'}]
                },
                {
                    featureType: 'road',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#9ca5b3'}]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'geometry',
                    stylers: [{color: '#003f61'}]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'geometry.stroke',
                    stylers: [{color: '#3c87ab'}]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#f3d19c'}]
                },
                {
                    featureType: 'transit',
                    elementType: 'geometry',
                    stylers: [{color: '#3c87ab'}]
                },
                {
                    featureType: 'transit.station',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#d59563'}]
                },
                {
                    featureType: 'water',
                    elementType: 'geometry',
                    stylers: [{color: '#003c5d'}]
                },
                {
                    featureType: 'water',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#515c6d'}]
                },
                {
                    featureType: 'water',
                    elementType: 'labels.text.stroke',
                    stylers: [{color: '#17263c'}]
                }
            ]
        });
        AOS.init({
            /* easing: 'ease-in-out-sine'; */
            duration: 1000,
            disable: function () {
                var maxWidth = 1024;
                return window.innerWidth < maxWidth;
            }
        });
        this.mapLocate = map;
        fetch("/schools.json").then(r => r.json()).then(json => {
            this.schools = json;
            this.listSchools = this.schools;
            this.listPlaces = JSON.parse(JSON.stringify(json));
            this.listPlaces.sort(function(a, b){
                if(a.city < b.city) return -1;
                if(a.city > b.city) return 1;
                return 0;
            });
            this.schools.forEach((school) => {
                const position = new google.maps.LatLng(school.latitude, school.longitude);
                const marker = new google.maps.Marker({
                    position,
                    map,
                    animation: google.maps.Animation.DROP,
                    schoolId: school.id,
                    moto: school.moto,
                    icon: 'assets/images/map-marker.svg'
                });
                app.markersList.push(marker);
                google.maps.event.addListener(marker, 'click', function(event){
                    // app.schoolViewStatus = true;
                    if(app.schoolViewStatus){
                        app.closeSchoolView();
                        setTimeout(function () {
                            app.openSchoolView(marker.schoolId)
                        },400);
                    }else{
                        app.openSchoolView(marker.schoolId)
                    }
                    marker.setIcon('assets/images/marker-active.svg');

                });
            });
        });
    },
    methods:{
        changeLicense(){
            if(this.pickedLicense == 'a' || this.pickedLicense == 'a1' || this.pickedLicense == 'a2' || this.pickedLicense == 'am') {
                this.listSchools = this.schools.filter(school => school.moto);
                this.listPlaces = this.schools.filter(school => school.moto);
            }else{
                this.listSchools = this.schools;
                this.listPlaces = JSON.parse(JSON.stringify(this.schools)).sort(function(a, b){
                    if(a.city < b.city) return -1;
                    if(a.city > b.city) return 1;
                    return 0;
                });
            }
            $('select-contain').each(
                function () {
                    $(this).select2('update');
                }
            );
            this.markersList.forEach((marker) => {
                if (this.pickedLicense == 'a' || this.pickedLicense == 'a1' || this.pickedLicense == 'a2' || this.pickedLicense == 'am') {
                    if (marker.moto){
                        marker.setVisible(true);
                    }else {
                        marker.setVisible(false);
                    }
                }else {
                    marker.setVisible(true);
                }
            });
        },

        openSchoolView(markerId){
            this.schoolViewStatus = true;
            let self = this;
            this.schools.filter(function( school) {
                let schoolId = '';
                if(Number.isInteger(markerId)){
                    schoolId = markerId;
                }else if(self.selectSchool === ''){
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
                    ]);
                    setTimeout(function () {
                        app.smoothZoomMap(app.mapLocate, 15, app.mapLocate.getZoom(), true);
                        let myLatlng = new google.maps.LatLng(school.latitude, school.longitude);
                        app.mapLocate.panTo(myLatlng);
                    },400);
                }
            });
            this.markersList.filter(function(marker) {
                let schoolId = '';
                if(Number.isInteger(markerId)){
                    schoolId = markerId;
                }else if(self.selectSchool === ''){
                    schoolId = self.selectPlace;
                }else{
                    schoolId = self.selectSchool;
                }
                if(marker.schoolId == schoolId){
                    marker.setIcon('assets/images/marker-active.svg');
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

            this.markersList.forEach(function(marker) {
                marker.setIcon('assets/images/map-marker.svg');
            });

            setTimeout(function () {
                $('.graph .chart-container').remove();
                app.smoothZoomMap(app.mapLocate, 8, app.mapLocate.getZoom(), false);
                let myLatlng = new google.maps.LatLng(app.latitudeMap, app.longitudeMap);
                app.mapLocate.panTo(myLatlng);
            },400)

        },

        smoothZoomMap(map, level, cnt, mode) {
            //alert('Count: ' + cnt + 'and Max: ' + level);

            if(mode == true) {

                if (cnt >= level) {
                    return;
                }
                else {
                    var z = google.maps.event.addListener(map, 'zoom_changed', function(event){
                        google.maps.event.removeListener(z);
                        app.smoothZoomMap(map, level, cnt + 1, true);
                    });
                    setTimeout(function(){map.setZoom(cnt)}, 80);
                }
            } else {
                if (cnt <= level) {
                    return;
                }
                else {
                    var z = google.maps.event.addListener(map, 'zoom_changed', function(event) {
                        google.maps.event.removeListener(z);
                        app.smoothZoomMap(map, level, cnt - 1, false);
                    });
                    setTimeout(function(){map.setZoom(cnt)}, 80);
                }
            }
        }
    }
});

