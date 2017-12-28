$(function(){

	$("[role='button']").click(function(e){
		e.preventDefault();
	});
    if($('#ads-modal').length && (getCookie('showAdsModal') != true)){
        setCookie('showAdsModal','1');
        setTimeout(function () {
            $('#ads-modal').modal('show')
        }, 10000);
    }

    //As you scroll, record the scrolltop position in global variable
    let scrollTopPosition = 0;
    let lastKnownScrollTopPosition = 0;
    $(window).scroll(function () {
        scrollTopPosition = $(document).scrollTop();
    });

    $('.modal')
        .on('show.bs.modal', function (){
            $('body').css({
                top : scrollTopPosition * -1
            });
            //save this number for later
            lastKnownScrollTopPosition = scrollTopPosition;
        })
        .on('hide.bs.modal', function (){
            $('body').scrollTop(lastKnownScrollTopPosition);
            setTimeout(function () {
                $('body').css({top: 0});
            }, 800);
        });

    /*
     * Replace all SVG images with inline SVG
     */
    jQuery('img.svg').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');
    });

});

function setCookie(key, value) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}

function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}

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

let app = new Vue({
    el: '#app',
    data: {

        latitudeMap: 59.339783,
        longitudeMap: 17.939713,
        markersList: [],
        pickedLicense: '',
        schools: null,
        listSchools: null,
        listPlaces: null,
        schoolViewStatus: false,
        selectSchool: '',
        selectPlace: '',
        schoolView: '',
        closeZoomMode: true,
    },
    mounted: function () {

        if($(window).width() < 960){
            $('.header .map').height($(window).height());
        }
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

        new WOW({mobile: false}).init();

        createGraph( [
            81,
            100,
            90,
            80,
            95
        ]);

        google.maps.event.addListenerOnce(map, 'tilesloaded', function(){
            $('.loader').addClass('animated');
            setTimeout(function () {
                $('html').removeClass('loading');
            }, 300);
        });

    },
    methods:{
        openModalPacket(name, price){
            if(name != '' && price != ''){
                this.namePacket = name;
                this.pricePacket = price;
            }
        },

        openSchoolView(){
            createGraph( [
                self.schoolView.support,
                self.schoolView.registrationTeacher,
                self.schoolView.pedagogical,
                self.schoolView.cleanVehicles,
                self.schoolView.recommendation
            ]);
        },
    }
});

