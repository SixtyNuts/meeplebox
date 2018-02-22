   
window.addEventListener("load", function() {

        var switchs = document.querySelectorAll("input");

        switchs.forEach(function(switchOn){
                switchOn.addEventListener("click", function() {
                
                var img = this.parentElement.parentElement.parentElement.firstElementChild;
                
                var imgPath = 'img/svg/' + img.id + '.svg';

                var imgPathActive = 'img/svg/' + img.id + '-active.svg';

                if (this.checked) {
                    img.src = imgPathActive;
                }

                else {
                    img.src = imgPath;
                }

            });

        });

});
