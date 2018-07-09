"use strict";function setCookie(e,t){var o=new Date;o.setTime(o.getTime()+864e5),document.cookie=e+"="+t+";expires="+o.toUTCString()}function getCookie(e){var t=document.cookie.match("(^|;) ?"+e+"=([^;]*)(;|$)");return t?t[2]:null}function createConfig(e,t){return{type:"line",data:{labels:["Kundsupport","Lärarlegitimation","Pedagogik","Miljöfordon","Rekommendation"],datasets:[{label:"",steppedLine:e.steppedLine,data:t,borderColor:e.color,borderWidth:9,pointBackgroundColor:"#0eb4fc",pointRadius:8,pointHoverRadius:8,pointBorderWidth:6,pointHoverBorderWidth:6,pointBorderColor:"#274f7a",fill:!1}]},options:{responsive:!1,maintainAspectRatio:!1,title:{display:!1,text:!1},scales:{xAxes:[{display:!1}]},layout:{padding:{top:15,bottom:15,right:15}}}}}function createGraph(r){var n=document.querySelector(".graph");[{steppedLine:"",label:"",color:"#028fcc"}].forEach(function(e){var t=document.createElement("div");t.classList.add("chart-container");var o=document.createElement("canvas");t.appendChild(o),n.appendChild(t);var a=o.getContext("2d"),l=createConfig(e,r);Chart.defaults.global.legend.display=!1,new Chart(a,l)})}$(function(){$("[role='button']").click(function(e){e.preventDefault()}),setTimeout(function(){$("#ads-modal").modal("show")},1e4);var e=0,t=0;$(window).scroll(function(){e=$(document).scrollTop()}),$(".modal").on("show.bs.modal",function(){$("body").css({top:-1*e}),t=e}).on("hide.bs.modal",function(){$("body").scrollTop(t),setTimeout(function(){$("body").css({top:0})},800),$(this).hasClass("response-body")&&$(this).removeClass("response-body")}),jQuery("img.svg").each(function(){var o=jQuery(this),a=o.attr("id"),l=o.attr("class"),e=o.attr("src");jQuery.get(e,function(e){var t=jQuery(e).find("svg");void 0!==a&&(t=t.attr("id",a)),void 0!==l&&(t=t.attr("class",l+" replaced-svg")),t=t.removeAttr("xmlns:a"),o.replaceWith(t)},"xml")}),$("#packet-modal form").validator(),$("#form-modal form").validator(),$("#ads-modal form").validator(),$(".section-contact form").validator()});var app=new Vue({el:"#app",data:{latitudeMap:59.362988157308024,longitudeMap:17.865869568786593,schoolViewStatus:!1,markersList:"",selectPlace:"",schoolView:"",closeZoomMode:!0,namePacket:"",pricePacket:"",packId:0},mounted:function(){$(window).width()<960&&($(".header #map-layout").height($(window).height()),this.latitudeMap="59.36171969999999",this.longitudeMap="17.865397499999972");var e=new google.maps.LatLng(this.latitudeMap,this.longitudeMap),a=new google.maps.Map(document.getElementById("map-layout"),{center:e,zoom:15,styles:[{elementType:"geometry",stylers:[{color:"#242f3e"}]},{elementType:"labels.text.stroke",stylers:[{color:"#242f3e"}]},{elementType:"labels.text.fill",stylers:[{color:"#746855"}]},{featureType:"administrative.locality",elementType:"labels.text.fill",stylers:[{color:"#b1c5cd"}]},{featureType:"poi",elementType:"labels.text.fill",stylers:[{color:"#b1c5cd"}]},{featureType:"poi.park",elementType:"geometry",stylers:[{color:"#263c3f"}]},{featureType:"poi.park",elementType:"labels.text.fill",stylers:[{color:"#6b9a76"}]},{featureType:"road",elementType:"geometry",stylers:[{color:"#18688d"}]},{featureType:"road",elementType:"geometry.stroke",stylers:[{color:"#3c87ab"}]},{featureType:"road",elementType:"labels.text.fill",stylers:[{color:"#9ca5b3"}]},{featureType:"road.highway",elementType:"geometry",stylers:[{color:"#003f61"}]},{featureType:"road.highway",elementType:"geometry.stroke",stylers:[{color:"#3c87ab"}]},{featureType:"road.highway",elementType:"labels.text.fill",stylers:[{color:"#f3d19c"}]},{featureType:"transit",elementType:"geometry",stylers:[{color:"#3c87ab"}]},{featureType:"transit.station",elementType:"labels.text.fill",stylers:[{color:"#d59563"}]},{featureType:"water",elementType:"geometry",stylers:[{color:"#003c5d"}]},{featureType:"water",elementType:"labels.text.fill",stylers:[{color:"#515c6d"}]},{featureType:"water",elementType:"labels.text.stroke",stylers:[{color:"#17263c"}]}]});new WOW({mobile:!1}).init(),createGraph([85,100,95,90,95]);var l=new google.maps.InfoWindow;this.markersList=[{latitude:"59.36171969999999",longitude:"17.865397499999972",content:"Grimstagatan 160"}],this.markersList.forEach(function(e){var t=new google.maps.LatLng(e.latitude,e.longitude),o=new google.maps.Marker({position:t,map:a,content:e.content,animation:google.maps.Animation.DROP,icon:"http://www.vasterorttrafikskola.se/images/map-marker.png"});google.maps.event.addListener(o,"click",function(){l.setContent(this.content),l.open(a,this)})}),google.maps.event.addListenerOnce(a,"tilesloaded",function(){$(".loader").addClass("animated"),setTimeout(function(){$("html").removeClass("loading")},300)}),google.maps.event.addListener(a,"dragend",function(){console.log(this.getCenter()),console.log(this.getCenter().lat()+" "+this.getCenter().lng())})},methods:{openModalPacket:function(e,t,o){""!=e&&""!=t&&(this.namePacket=e,this.pricePacket=t,this.packId=o)},openSchoolView:function(){this.schoolViewStatus=!0},closeSchoolView:function(){this.schoolViewStatus=!1}}});