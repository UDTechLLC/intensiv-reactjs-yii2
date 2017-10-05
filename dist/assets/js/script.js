"use strict";function setCookie(e,t){var o=new Date;o.setTime(o.getTime()+864e5),document.cookie=e+"="+t+";expires="+o.toUTCString()}function getCookie(e){var t=document.cookie.match("(^|;) ?"+e+"=([^;]*)(;|$)");return t?t[2]:null}function createConfig(e,t){return{type:"line",data:{labels:["Kundsupport","Lärarlegitimation","Pedagogik","Miljöfordon","Rekommendation"],datasets:[{label:"",steppedLine:e.steppedLine,data:t,borderColor:e.color,borderWidth:9,pointBackgroundColor:"#0eb4fc",pointRadius:8,pointHoverRadius:8,pointBorderWidth:6,pointHoverBorderWidth:6,pointBorderColor:"#274f7a",fill:!1}]},options:{responsive:!1,maintainAspectRatio:!1,title:{display:!1,text:!1},scales:{xAxes:[{display:!1}]},layout:{padding:{top:15,bottom:15,right:15}}}}}function createGraph(e){var t=document.querySelector(".graph");[{steppedLine:"",label:"",color:"#028fcc"}].forEach(function(o){var s=document.createElement("div");s.classList.add("chart-container");var a=document.createElement("canvas");s.appendChild(a),t.appendChild(s);var i=a.getContext("2d"),l=createConfig(o,e);Chart.defaults.global.legend.display=!1,new Chart(i,l)})}$(function(){$("[role='button']").click(function(e){e.preventDefault()}),$("#ads-modal").length&&1!=getCookie("showAdsModal")&&(setCookie("showAdsModal","1"),setTimeout(function(){$("#ads-modal").modal("show")},1e4)),$("select").on("select2:open",function(e){$(".select2-results__options").scrollbar().parent().addClass("scrollbar-inner")});var e=0,t=0;$(window).scroll(function(){e=$(document).scrollTop()}),$(".modal").on("show.bs.modal",function(){$("body").css({top:-1*e}),t=e}).on("hide.bs.modal",function(){$("body").scrollTop(t),setTimeout(function(){$("body").css({top:0})},800)})}),Vue.component("select2",{props:["options","value"],template:"#select2-template",mounted:function(){var e=this;$(this.$el).select2({data:this.options,minimumResultsForSearch:1/0}).val("placeholder").trigger("change").on("change",function(){e.$emit("input",this.value)})},watch:{value:function(e){$(this.$el).val(e).trigger("change")},options:function(e){$(this.$el).empty().select2({data:e})}},destroyed:function(){$(this.$el).off().select2("destroy")}});var app=new Vue({el:"#app",data:{latitudeMap:59.339783,longitudeMap:17.939713,mapLocate:null,markersList:[],pickedLicense:"",schools:null,listSchools:null,listPlaces:null,schoolViewStatus:!1,selectSchool:"",selectPlace:"",schoolView:"",closeZoomMode:!0,namePacket:"",pricePacket:""},mounted:function(){var e=this;$(window).width()<960&&$(".header .map").height($(window).height());var t=new google.maps.LatLng(this.latitudeMap,this.longitudeMap),o=new google.maps.Map(document.getElementById("map-layout"),{center:t,zoom:9,styles:[{elementType:"geometry",stylers:[{color:"#242f3e"}]},{elementType:"labels.text.stroke",stylers:[{color:"#242f3e"}]},{elementType:"labels.text.fill",stylers:[{color:"#746855"}]},{featureType:"administrative.locality",elementType:"labels.text.fill",stylers:[{color:"#b1c5cd"}]},{featureType:"poi",elementType:"labels.text.fill",stylers:[{color:"#b1c5cd"}]},{featureType:"poi.park",elementType:"geometry",stylers:[{color:"#263c3f"}]},{featureType:"poi.park",elementType:"labels.text.fill",stylers:[{color:"#6b9a76"}]},{featureType:"road",elementType:"geometry",stylers:[{color:"#18688d"}]},{featureType:"road",elementType:"geometry.stroke",stylers:[{color:"#3c87ab"}]},{featureType:"road",elementType:"labels.text.fill",stylers:[{color:"#9ca5b3"}]},{featureType:"road.highway",elementType:"geometry",stylers:[{color:"#003f61"}]},{featureType:"road.highway",elementType:"geometry.stroke",stylers:[{color:"#3c87ab"}]},{featureType:"road.highway",elementType:"labels.text.fill",stylers:[{color:"#f3d19c"}]},{featureType:"transit",elementType:"geometry",stylers:[{color:"#3c87ab"}]},{featureType:"transit.station",elementType:"labels.text.fill",stylers:[{color:"#d59563"}]},{featureType:"water",elementType:"geometry",stylers:[{color:"#003c5d"}]},{featureType:"water",elementType:"labels.text.fill",stylers:[{color:"#515c6d"}]},{featureType:"water",elementType:"labels.text.stroke",stylers:[{color:"#17263c"}]}]});new WOW({mobile:!1}).init(),this.mapLocate=o,fetch("http://projects.udtech.co/intensivkurs/schools.json").then(function(e){return e.json()}).then(function(t){e.schools=t,e.listSchools=e.schools,e.listPlaces=JSON.parse(JSON.stringify(t)),e.listPlaces.sort(function(e,t){return e.city<t.city?-1:e.city>t.city?1:0}),e.schools.forEach(function(e){var t=new google.maps.LatLng(e.latitude,e.longitude),s=new google.maps.Marker({position:t,map:o,animation:google.maps.Animation.DROP,schoolId:e.id,moto:e.moto,icon:"assets/images/map-marker.svg"});app.markersList.push(s),google.maps.event.addListener(s,"click",function(e){app.schoolViewStatus?(app.closeZoomMode=!1,app.closeSchoolView(),setTimeout(function(){app.openSchoolView(s.schoolId)},400)):app.openSchoolView(s.schoolId),s.setIcon("assets/images/marker-active.svg")})})}),google.maps.event.addListenerOnce(o,"tilesloaded",function(){$(".loader").addClass("animated"),setTimeout(function(){$("html").removeClass("loading")},300)})},methods:{openModalPacket:function(e,t){""!=e&&""!=t&&(this.namePacket=e,this.pricePacket=t)},changeLicense:function(){var e=this;"a"==this.pickedLicense||"a1"==this.pickedLicense||"a2"==this.pickedLicense||"am"==this.pickedLicense?(this.listSchools=this.schools.filter(function(e){return e.moto}),this.listPlaces=this.schools.filter(function(e){return e.moto})):(this.listSchools=this.schools,this.listPlaces=JSON.parse(JSON.stringify(this.schools)).sort(function(e,t){return e.city<t.city?-1:e.city>t.city?1:0})),$("select-contain").each(function(){$(this).select2("update")}),this.markersList.forEach(function(t){"a"==e.pickedLicense||"a1"==e.pickedLicense||"a2"==e.pickedLicense||"am"==e.pickedLicense?t.moto?t.setVisible(!0):t.setVisible(!1):t.setVisible(!0)})},openSchoolView:function(e){this.schoolViewStatus=!0;var t=this;this.schools.filter(function(o){var s="";s=Number.isInteger(e)?e:""===t.selectSchool?t.selectPlace:t.selectSchool,o.id==s&&(t.schoolView=o,$(".progress-bar.support").width(parseInt(t.schoolView.support)+"%"),$(".progress-bar.registrationTeacher").width(parseInt(t.schoolView.registrationTeacher)+"%"),$(".progress-bar.pedagogical").width(parseInt(t.schoolView.pedagogical)+"%"),$(".progress-bar.cleanVehicles").width(parseInt(t.schoolView.cleanVehicles)+"%"),$(".progress-bar.recommendation").width(parseInt(t.schoolView.recommendation)+"%"),createGraph([t.schoolView.support,t.schoolView.registrationTeacher,t.schoolView.pedagogical,t.schoolView.cleanVehicles,t.schoolView.recommendation]),setTimeout(function(){app.smoothZoomMap(app.mapLocate,15,app.mapLocate.getZoom(),!0);var e=new google.maps.LatLng(o.latitude,o.longitude);app.mapLocate.panTo(e)},400))}),this.markersList.filter(function(o){var s="";s=Number.isInteger(e)?e:""===t.selectSchool?t.selectPlace:t.selectSchool,o.schoolId==s&&o.setIcon("assets/images/marker-active.svg")})},closeSchoolView:function(){this.schoolViewStatus=!1;$(".progress-bar.support").width(0),$(".progress-bar.registrationTeacher").width(0),$(".progress-bar.pedagogical").width(0),$(".progress-bar.cleanVehicles").width(0),$(".progress-bar.recommendation").width(0),this.markersList.forEach(function(e){e.setIcon("assets/images/map-marker.svg")}),setTimeout(function(){if($(".graph .chart-container").remove(),app.closeZoomMode){app.smoothZoomMap(app.mapLocate,8,app.mapLocate.getZoom(),!1);var e=new google.maps.LatLng(app.latitudeMap,app.longitudeMap);app.mapLocate.panTo(e)}else app.closeZoomMode=!0},400)},smoothZoomMap:function(e,t,o,s){if(1==s){if(o>=t)return;a=google.maps.event.addListener(e,"zoom_changed",function(s){google.maps.event.removeListener(a),app.smoothZoomMap(e,t,o+1,!0)});setTimeout(function(){e.setZoom(o)},80)}else{if(o<=t)return;var a=google.maps.event.addListener(e,"zoom_changed",function(s){google.maps.event.removeListener(a),app.smoothZoomMap(e,t,o-1,!1)});setTimeout(function(){e.setZoom(o)},80)}}}});