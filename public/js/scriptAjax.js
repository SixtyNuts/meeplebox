    
        var dataMarkers = [];


        $.ajax({
          url : "http://localhost:8000/map/filtered",
          type : "get",
          success : function(response){
            response.forEach(function(event){
                dataMarkers.push([event.latitude, event.longitude]);
            });
            console.log(dataMarkers);
          }
        });



