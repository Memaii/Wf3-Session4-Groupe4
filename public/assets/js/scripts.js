/* Déclaration des variables globales */ 
var geocoder = new google.maps.Geocoder();
var adresse, latitude, longitude;


$(function(){

  $(".gps").blur(function(event){
    event.preventDefault();
    var addr = $("#addr").val();
    var zip = $("#zip").val();
    var city = $("#city").val();
    var adresse = addr+', '+zip+' '+city;
    var url = $(this).attr('action');

    geocoder.geocode({ 'address': adresse}, function(results, status) {
      /* Si géolocalisation réussie */ 
      if (status == google.maps.GeocoderStatus.OK) {
        /* Récupération des coordonnées */ 
        latitude = results[0].geometry.location.lat();
        longitude = results[0].geometry.location.lng();
        /* Appel AJAX pour insertion en BDD */ 
      document.getElementById("lat").value = latitude;
      document.getElementById("lon").value = longitude;   
      };
    });
  });
});