
/////////////////////////////////////////////////////////

function onMarkerClick(e, event) {

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

/////////////////////////////////////////////////////////

function onIconCloseClick(filter, event) {

    divPopUpEvent.className = "popupevent pop-no-active";
    divPopUpEvent.id = "popupevent";

    if (clickedMarker) {
        clickedMarker.setIcon(meepleIcon);
    }

    markers.forEach(function(element) {
      if (element.typeId == filter.id) {
        mymap.removeLayer(element.marker);
        // markers.splice(markers.indexOf(element), 1);
      }  
    });

    addButtonAddFilter(filter, event);

    let divChipFilters = document.querySelectorAll(".chip");

    if (divChipFilters.length == 1) {

        $.ajax({

            url : "http://localhost:8000/map/allevents",
            type : "get",

            success : function(response){

                response.events.forEach(function(event){

                    addMarker(event);

                });

            }

        });
    }

}

/////////////////////////////////////////////////////////

function onAddFilterClick(e, filter, event) {

    $.ajax({

        url : "http://localhost:8000/map/filtered/" + filter.id,
        type : "get",

        success : function(response){

            response.events.forEach(function(event){

                addMarker(event);

            });

        }

    });

    let divAforModif = document.querySelectorAll(".modifstyle");

    divAforModif.forEach(function(element) {
        element.style = "transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;";
    });

    addFiltersDiv.className = "fixed-action-btn vertical";

    let liRemove = document.querySelector("#li" + filter.id);

    liRemove.remove();

    addChipFilter(filter, event)

}

/////////////////////////////////////////////////////////

function addMarker(event) {

    let marker = L.marker([event.latitude, event.longitude], {icon: meepleIcon}).addTo(mymap);

    marker.on('click', function(e){
        onMarkerClick(e, event);
    });

    var markerType = {};
    markerType["typeId"] = event.type_game;
    markerType["marker"] = marker;
    markers.push(markerType);

}

/////////////////////////////////////////////////////////

function addChipFilter(filter, event) {

    let chipDiv = document.createElement("div");
    chipDiv.className = "chip";
    chipDiv.innerText = "Jeux " + filter.type;
    divFiltres.appendChild(chipDiv);
    let iconClose = document.createElement("i");
    iconClose.className = "close material-icons";
    iconClose.id = "filter-" + filter.id;
    iconClose.innerText = "close";
    chipDiv.appendChild(iconClose);

    iconClose.addEventListener('click', function(e){
        onIconCloseClick(filter, event);
    });

}

/////////////////////////////////////////////////////////


function addButtonAddFilter(filter, event) {

    let liAddFilt = document.createElement("li");
    liAddFilt.id = "li" + filter.id;
    ulAddFilters.appendChild(liAddFilt);
    let aAddFilt = document.createElement("a");
    aAddFilt.className = "btn-floating modifstyle";
    liAddFilt.appendChild(aAddFilt);
    let imgTypeGame = document.createElement("img");
    imgTypeGame.className = filter.code;
    imgTypeGame.src = "img/svg/" + filter.code +"-active.svg";
    aAddFilt.appendChild(imgTypeGame);

    aAddFilt.addEventListener('click', function(e){
        onAddFilterClick(e, filter, event);
    });

}

/////////////////////////////////////////////////////////

function onMapClick() {

    divPopUpEvent.className = "popupevent pop-no-active";
    divPopUpEvent.id = "popupevent";
    if (clickedMarker) {
        clickedMarker.setIcon(meepleIcon);
    }

}

/////////////////////////////////////////////////////////


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
let addFiltersDiv = document.createElement("div");
addFiltersDiv.className = "fixed-action-btn vertical";
divFiltres.appendChild(addFiltersDiv);
let addFiltersA = document.createElement("a");
addFiltersA.className = "btn-floating btn-large";
addFiltersA.innerText = "FILTRES";
addFiltersDiv.appendChild(addFiltersA);
let ulAddFilters = document.createElement("ul");
addFiltersDiv.appendChild(ulAddFilters);

var markers = [];

var clickedMarker;

$.ajax({

    url : "http://localhost:8000/map/filtered",
    type : "get",

    success : function(response){

        response.events.forEach(function(event){

            addMarker(event);

        });

        response.filters.forEach(function(filter){

            addChipFilter(filter, event);

        });


        response.add_filters.forEach(function(filter){

            addButtonAddFilter(filter, event);

        });

        divMap.removeChild(divLoading)

    }

});

mymap.on('click', onMapClick);

