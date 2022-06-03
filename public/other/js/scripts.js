
    var pfp = document.getElementsByClassName('pfp');
    for (var i=0 ; i < pfp.length ; i++) {
        pfp[i].style.height = pfp[i].clientWidth;
    }
    window.addEventListener('resize', function () {
        var pfp = document.getElementsByClassName('pfp');
        for (var i=0 ; i < pfp.length ; i++) {
            pfp[i].style.height = pfp[i].clientWidth;
        }
    });