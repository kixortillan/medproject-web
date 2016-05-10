function debounce(fn, duration) {
    var timer;
    return function () {
        clearTimeout(timer);
        timer = setTimeout(fn, duration)
    }
}

$(".alert").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert").alert('close');
});
//# sourceMappingURL=all.js.map
