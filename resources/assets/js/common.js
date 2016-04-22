function debounce(fn, duration) {
    var timer;
    return function () {
        clearTimeout(timer);
        timer = setTimeout(fn, duration)
    }
}