    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }

    var timeleft = 5;
    var downloadTimer = setInterval(function(){
    if(timeleft <= 0){
    clearInterval(downloadTimer);
    $('#message').hide()

    } else {
    $('#message').show()
    }
    timeleft -= 1;
    }, 500);
