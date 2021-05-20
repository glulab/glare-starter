$(() => {
    $('a[href^="http"]:not([href*="' + document.domain + '"])').each(function () {
        $(this).attr("target", "_blank");
    });
});
