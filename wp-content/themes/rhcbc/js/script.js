function init() {
    window.addEventListener('scroll', function(e){
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 100,
            header = document.getElementById("header");
        if (distanceY > shrinkOn) {
            if (!(header.className.match(/(?:^|\s)skinny(?!\S)/))) {
                header.className += "skinny";
            }
        } else {
            if (header.className.match(/(?:^|\s)skinny(?!\S)/)) {
                header.className = header.className.replace( /(?:^|\s)skinny(?!\S)/g , '' );
            }
        }
    });
}
window.onload = init();