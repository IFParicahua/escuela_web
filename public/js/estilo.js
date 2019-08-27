$('.menu-bar').on('click', function () {
    $('.contenido').toggleClass('abrir');
});
$('.titulos').on('click', function () {
    location.href = 'inicio';
});
$('.submenu').click(function () {
    $(this).children("ul").slideToggle();
});
