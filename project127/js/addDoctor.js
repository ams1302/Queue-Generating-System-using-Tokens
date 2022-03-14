function fadeOut() {
    var fade = document.querySelector('.alert');
    var interval = setInterval(function() {

        if (!fade.style.opacity) {
            fade.style.opacity = 1;
        }


        if (fade.style.opacity > 0) {
            fade.style.opacity -= 0.1;
        } else {
            clearInterval(interval);
        }

    }, 300);
}