    var mymap = L.map('mapid').setView([45.77, 4.83], 12);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
            '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="http://mapbox.com">Mapbox</a>',
        id: 'mapbox.streets'
    }).addTo(mymap);

    // var greenIcon = L.icon({
    //     iconUrl: 'leaf-green.png',

    //     iconSize:     [38, 95], // size of the icon
    //     iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
    //     popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    // });


    dataMarkers.forEach(function(e) {
        L.marker([e[0], e[1]]).addTo(mymap);
    });


    console.log(dataMarlers)

    // L.marker([45.77, 4.83]).addTo(mymap)
    //     .bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup();

    var popup = L.popup();

    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("You clicked the map at " + e.latlng.toString())
            .openOn(mymap);
    }


    mymap.on('click', onMapClick);
