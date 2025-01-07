var start;
var timerID;
var isChronoRunning = false;

function chrono(diffDate) {
    var now = new Date();
    var diff = now - start; 
    var diffDate = new Date(diff); 
    var min = diffDate.getUTCMinutes();
    var sec = diffDate.getUTCSeconds();
    min = min < 10 ? "0" + min : min;
    sec = sec < 10 ? "0" + sec : sec;
    document.getElementById("chronotime").innerText =   min +":" + sec;
    timerID = setTimeout(chrono, 1000);
}

function chronoStart() {
    if (!isChronoRunning) { 
        start = new Date();
        chrono();
        isChronoRunning = true;
    }
}

function chronoStop() {
    clearTimeout(timerID); 
    isChronoRunning = false; 
    var now = new Date();
    var diff = now - start;
    var diffDate = new Date(diff);
    var min = diffDate.getUTCMinutes();
    var sec = diffDate.getUTCSeconds();
    min = min < 10 ? "0" + min : min;
    sec = sec < 10 ? "0" + sec : sec;
    
    return min + ":" + sec; 
}

