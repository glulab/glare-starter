import MagicGrid from "magic-grid"

$(() => {

    if (!$('.page-offer-show').length) {
        return;
    }

    let magicGrid = new MagicGrid({
        container: ".product-list", // Required. Can be a class, id, or an HTMLElement
        static: true, // Required for static content. Default: false.
        // items: 30, // Required for dynamic content. Initial number of items in the container.
        gutter: 30, // Optional. Space between items. Default: 25(px).
        maxColumns: 4, // Optional. Maximum number of columns. Default: Infinite.
        useMin: false, // Optional. Prioritize shorter columns when positioning items? Default: false.
        useTransform: true, // Optional. Position items using CSS transform? Default: True.
        animate: true, // Optional. Animate item positioning? Default: false.
        center: true, //Optional. Center the grid items? Default: true.
    });

    magicGrid.listen();

});
