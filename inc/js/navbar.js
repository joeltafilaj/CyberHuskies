$(document).ready(function () {
    
    //hide scrollbar when croll down
    var prev_pos = window.pageYOffset;
    window.onscroll = function() {
        var current_pos = window.pageYOffset;
        if (prev_pos > current_pos) {
            document.getElementsByClassName("navb")[0].style.top = "0";
        } else {
            document.getElementsByClassName("navb")[0].style.top = "-80px";
        }
        prev_pos = current_pos;
    }
});