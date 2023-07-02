if (!localStorage.getItem('sidebar_navbar_background_color') && !localStorage.getItem('card_background_color')) {
    var element1 = selector('.sidebar-dark-primary');
    var element2 = selector('.nav-dev');
    var element3 = selector('.bottombar');
    // var element4 = selector('.modal-body');
    element1.style.backgroundColor = 'rgb(7, 3, 51)';
    element2.style.backgroundColor = 'rgb(7, 3, 51)';
    element3.style.backgroundColor = 'rgb(7, 3, 51)';
    // element4.style.backgroundColor = 'rgb(7, 3, 51)';
    localStorage.setItem('sidebar_navbar_background_color', 'rgb(7, 3, 51)');
    localStorage.setItem('card_background_color', 'white');
    forAllSameClass('.card');
    forAllSameClass('.modal-body');
} else {
    var element1 = selector('.sidebar-dark-primary');
    var element2 = selector('.nav-dev');
    var element3 = selector('.bottombar');
    // var element4 = selector('.modal-body');
    element1.style.backgroundColor = localStorage.getItem('sidebar_navbar_background_color');
    element2.style.backgroundColor = localStorage.getItem('sidebar_navbar_background_color');
    element3.style.backgroundColor = localStorage.getItem('sidebar_navbar_background_color');
    // element4.style.backgroundColor = localStorage.getItem('sidebar_navbar_background_color');
    forAllSameClass('.card');
    forAllSameClass('.modal-body');
}
function forAllSameClass(cls) {
    var ele = document.querySelectorAll(cls);
    ele.forEach(function(el) {
        el.style.backgroundColor = localStorage.getItem('card_background_color');
        el.style.color = localStorage.getItem('card_background_color') === 'white' ? "black" : 'white';
    });
}
