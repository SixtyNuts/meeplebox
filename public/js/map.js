    let mymap = L.map('mapid').setView([45.77, 4.846], 13);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
            '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="http://mapbox.com">Mapbox</a>',
        id: 'mapbox.streets'
    }).addTo(mymap);

    let meepleIcon = L.icon({
        iconUrl: '../img/marker-meeplebox.png',
        shadowUrl: '../img/marker-meeplebox-shadow.png',
        iconSize:     [42, 50], // size of the icon
        shadowSize:   [42, 50], // size of the shadow
        shadowAnchor: [6, 27],  // the same for the shadow
    });

    let meepleIconActive = L.icon({
        iconUrl: '../img/marker-meeplebox-active.png',
        shadowUrl: '../img/marker-meeplebox-shadow.png',
        iconSize:     [42, 50], // size of the icon
        shadowSize:   [42, 50], // size of the shadow
        shadowAnchor: [6, 27],  // the same for the shadow
    });

    let divMap = document.querySelector(".map");
    let divFiltres = document.querySelector(".filtres");
    let divLoading = document.querySelector(".loading");
    let divPopUpEvent = document.querySelector(".pict-game").parentNode;

    var markers = [];

    var clickedMarker;

    $.ajax({

        url : "http://localhost:8000/map/filtered",
        type : "get",

        success : function(response){
            response.events.forEach(function(event){

                let marker = L.marker([event.latitude, event.longitude], {icon: meepleIcon}).addTo(mymap);

                function onMarkerClick(e) {

                    mymap.setView([event.latitude, event.longitude], 13)

                    if (clickedMarker) {
                        clickedMarker.setIcon(meepleIcon);
                    }

                    clickedMarker = e.target;
                    e.target.setIcon(meepleIconActive);

                    let divPictGame = document.querySelector(".pict-game-img");
                    divPictGame.src = event.pict_game;

                    let divTitleEvent = document.querySelector(".text-event h2");
                    divTitleEvent.innerText = event.title;

                    let divDateTimeEvent = document.querySelector(".event-date-time span");
                    divDateTimeEvent.innerText = "le " + event.date + " à partir de " + event.startTime;
                    
                    let divLocalisation = document.querySelector(".event-city span");
                    divLocalisation.innerText = event.city;

                    let divMember = document.querySelector(".event-member span");
                    divMember.innerText = event.pseudo_creat;

                    if (divPopUpEvent.id != event.id) {
                        divPopUpEvent.id = event.id;
                        divPopUpEvent.className = "popupevent pop-no-active";
                        setTimeout(function(){ divPopUpEvent.className = "popupevent pop-active"; }, 10);
                    }
                }

                marker.on('click', onMarkerClick);

                var markerType = {};
                markerType["typeId"] = event.type_game;
                markerType["marker"] = marker;
                markers.push(markerType);

            });

            response.filters.forEach(function(filter){
                let chipDiv = document.createElement("div");
                chipDiv.className = "chip";
                chipDiv.innerText = "Jeux " + filter.type;
                divFiltres.appendChild(chipDiv);
                let iconClose = document.createElement("i");
                iconClose.className = "close material-icons";
                iconClose.id = "filter-" + filter.id;
                iconClose.innerText = "close";
                chipDiv.appendChild(iconClose);

                function onIconCloseClick(e) {
                    divPopUpEvent.className = "popupevent pop-no-active";
                    divPopUpEvent.id = "popupevent";
                    if (clickedMarker) {
                        clickedMarker.setIcon(meepleIcon);
                    }
                    markers.forEach(function(element) {
                      if (element.typeId == filter.id) {
                        mymap.removeLayer(element.marker);
                      }  
                    });

                    let divChipFilters = document.querySelectorAll(".chip");
                                            console.log(divChipFilters);

                    if (divChipFilters.length == 1) {
                        $.ajax({

                            url : "http://localhost:8000/map/allevents",
                            type : "get",

                            success : function(response){
                                response.events.forEach(function(event){

                                    let marker = L.marker([event.latitude, event.longitude], {icon: meepleIcon}).addTo(mymap);

                                    function onMarkerClick(e) {

                                        mymap.setView([event.latitude, event.longitude], 13)

                                        if (clickedMarker) {
                                            clickedMarker.setIcon(meepleIcon);
                                        }

                                        clickedMarker = e.target;
                                        e.target.setIcon(meepleIconActive);

                                        let divPictGame = document.querySelector(".pict-game-img");
                                        divPictGame.src = event.pict_game;

                                        let divTitleEvent = document.querySelector(".text-event h2");
                                        divTitleEvent.innerText = event.title;

                                        let divDateTimeEvent = document.querySelector(".event-date-time span");
                                        divDateTimeEvent.innerText = "le " + event.date + " à partir de " + event.startTime;
                                        
                                        let divLocalisation = document.querySelector(".event-city span");
                                        divLocalisation.innerText = event.city;

                                        let divMember = document.querySelector(".event-member span");
                                        divMember.innerText = event.pseudo_creat;

                                        if (divPopUpEvent.id != event.id) {
                                            divPopUpEvent.id = event.id;
                                            divPopUpEvent.className = "popupevent pop-no-active";
                                            setTimeout(function(){ divPopUpEvent.className = "popupevent pop-active"; }, 10);
                                        }
                                    }

                                    marker.on('click', onMarkerClick);

                                    var markerType = {};
                                    markerType["typeId"] = event.type_game;
                                    markerType["marker"] = marker;
                                    markers.push(markerType);

                                });

                            }

                        });
                    }

                }

                iconClose.addEventListener('click', onIconCloseClick);

            });

            divMap.removeChild(divLoading)

        }

    });

    function onMapClick(e) {
        divPopUpEvent.className = "popupevent pop-no-active";
        divPopUpEvent.id = "popupevent";
        if (clickedMarker) {
            clickedMarker.setIcon(meepleIcon);
        }
    }

    mymap.on('click', onMapClick);


