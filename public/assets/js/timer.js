//Javascript for Timer
timer = 45;
continueTimer = true;
let x = setInterval(function() {
    if (continueTimer){
        timer -= 1;
    }
    document.getElementById("redirection").innerHTML = "Question suivante (" + timer + ")";
    if (timer <= 0 && continueTimer === true) {
        continueTimer = false;
        location.replace("/");
    }
}, 1000);

const pauseTimer = document.querySelector('#pause-timer');
pauseTimer.addEventListener('click', function(){
    continueTimer = false;
})
