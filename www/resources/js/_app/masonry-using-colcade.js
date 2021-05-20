import "colcade";


$(() => {

    if (!$('.page-offer-show').length) {
        return;
    }

    $('.product-list').each((index, Element) => {
        let $grid = $(Element);

        $grid.addClass('grid');
        $grid.addClass(`grid-${index}`);
        $grid.find('> *').addClass('grid-item');
        $grid.find('> *').addClass(`grid-item-${index}`);
        $grid.prepend(`<div class="grid-col grid-col-${index} grid-col--1"></div><div class="grid-col grid-col-${index} grid-col--2"></div><div class="grid-col grid-col-${index} grid-col--3"></div><div class="grid-col grid-col-${index} grid-col--4"></div>`);

        $(`.grid-${index}`).colcade({
            columns: '.grid-col',
            items: '.grid-item'
        })
    });
});
