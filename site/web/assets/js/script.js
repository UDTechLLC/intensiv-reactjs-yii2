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

    // if($('.section select').length){
     //    $('.section select').select2({
     //        minimumResultsForSearch: Infinity
     //    });
	// }

    $('select').on('select2:open', function(e){
        $('.select2-results__options').scrollbar().parent().addClass('scrollbar-inner');
    });

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
    // watch: {
    //     value: function (value) {
    //         // update value
    //         $(this.$el).val(value).trigger('change');
    //     },
    //     options: function (options) {
    //         // update options
    //         $(this.$el).empty().select2({ data: options });
    //     }
    // },
    destroyed: function () {
        $(this.$el).off().select2('destroy')
    }
});

Vue.use(VueResource);
let app = new Vue({
    el: '#app',
    data: {
        latitudeMap: 59.339783,
        longitudeMap: 17.939713,
        mapLocate: null,
        markersList: [],
        schools: null,
        listSchools: null,
        schoolViewStatus: false,
        selectSchool: '',
        selectPlace: '',
        schoolView: '',
        closeZoomMode: true,
        listPlaces: [
          {'city': 'Botkyrka'},
          {'city': 'Bromma'},
          {'city': 'Danderyd'},
          {'city': 'Ekerö'},
          {'city': 'Farsta'},
          {'city': 'Haninge'},
          {'city': 'Huddinge'},
          {'city': 'Järfälla'},
          {'city': 'Kista'},
          {'city': 'Kungsholmen'},
          {'city': 'Lidingö'},
          {'city': 'Nacka'},
          {'city': 'Norrmalm'},
          {'city': 'Salem'},
          {'city': 'Sigtuna'},
          {'city': 'Sollentuna'},
          {'city': 'Solna'},
          {'city': 'Södermalm'},
          {'city': 'Sundbyberg'},
          {'city': 'Tyresö'},
          {'city': 'Täby'},
          {'city': 'Upplands-Bro'},
          {'city': 'Upplands Väsby'},
          {'city': 'Vallentuna'},
          {'city': 'Vaxholm'},
          {'city': 'Vasastan'},
          {'city': 'Vällingby'},
          {'city': 'Värmdö'},
          {'city': 'Östermalm'},
        ],
        namePacket: '',
        pricePacket: '',
        packId: 0,
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
        this.mapLocate = map;

        google.maps.event.addListenerOnce(map, 'tilesloaded', function(){
            $('.loader').addClass('animated');
            setTimeout(function () {
                $('html').removeClass('loading');
            }, 300);
        });
        let activeMarker;
        this.$http.get('/web/site/school-list').then((resp) => {
          this.schools = resp.data.output;
              const infoWindow = new google.maps.InfoWindow;
              this.schools.forEach((school) => {
                  const position = new google.maps.LatLng(school.lat, school.lng);
                  const marker = new google.maps.Marker({
                      position,
                      map,
                      animation: google.maps.Animation.DROP,
                      title: school.title,
                      icon: '/assets/images/map-marker.png'
                  });
                  app.markersList.push(marker);
                  google.maps.event.addListener(marker, 'click', function(event){

                      infoWindow.setContent(school.info);
                      infoWindow.open(map, marker);
                      // check to see if activeMarker is set
                      // if so, set the icon back to the default
                      activeMarker && activeMarker.setIcon('/assets/images/map-marker.png');

                      // set the icon for the clicked marker
                      marker.setIcon('/assets/images/marker-active.png');

                      // update the value of activeMarker
                      activeMarker = marker;
                  });
              });
        });

    },
    methods:{
        openModalPacket(name, price, pack_id){
            if(name != '' && price != ''){
              this.namePacket = name;
              this.pricePacket = price;
              this.packId = pack_id;
            }
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

