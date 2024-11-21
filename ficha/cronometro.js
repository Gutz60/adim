let timer;
let time = 0;

function startTimer() {
    timer = setInterval(function() {
        time++;
        document.getElementById('time').innerText = new Date(time * 1000).toISOString().substr(11, 8);
    }, 1000);
}

function stopTimer() {
    clearInterval(timer);
}

function resetTimer() {
    time = 0;
    document.getElementById('time').innerText = "00:00:00";
}