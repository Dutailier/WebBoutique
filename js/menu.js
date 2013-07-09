$(function () {
    $('#btnFrench').click(function () {
        $.URL.setParam('lang', 'fr');
    });

    $('#btnEnglish').click(function () {
        $.URL.setParam('lang', 'en');
    });
});