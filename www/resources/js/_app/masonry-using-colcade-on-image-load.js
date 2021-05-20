import "colcade";
import "jquery-appear-original";

// window.go1 = function() {
//     console.log( 'go1' );
// };
// window.go2 = function () {
//     console.log( 'go2' );
// };

// onJqueryLoad(['go1', 'go2']);
// window.makeColcade = () => {}
// $(() => {

if ($('.product-list').length) {

    $(window).on('load', () => {
        setTimeout(() => {
            window.scrollTo(0, 0);
        }, 1)
    });

    // setTimeout(() => {
    //     window.scrollTo(0, 0);
    // }, 1)
    // ;setTimeout(() => {
    //     window.scrollTo(0, 0);
    // }, 10);
    // setTimeout(() => {
    //     window.scrollTo(0, 0);
    // }, 100);

    let totalProcessed = 0;

    function addToColcade($item, fromEvent = 'load') {
        if (!$item.hasClass('not-processed')) {
            return;
        }
        let $grid = $item.closest('.product-list');
        let groupKey = $grid.data('group');

        if (!$grid.hasClass('grid')) {
            console.log( fromEvent + ': Create grid ' + groupKey);
            $grid.addClass('grid');
            $grid.addClass(`grid-${groupKey}`);
            $grid.prepend(`<div class="grid-col grid-col-${groupKey} grid-col--1"></div><div class="grid-col grid-col-${groupKey} grid-col--2"></div><div class="grid-col grid-col-${groupKey} grid-col--3"></div><div class="grid-col grid-col-${groupKey} grid-col--4"></div>`);
            $grid.colcade({
                columns: '.grid-col',
                items: '.grid-item'
            })
        }

        let currentIdx = $item.data('idx');
        console.log( fromEvent + ': Check for earlier ' + groupKey + ' idx: ' + currentIdx);
        if ($grid.find(`.product-miniature.not-processed[data-idx="${currentIdx - 1}"]`).length) {
            console.log( fromEvent + ': Got earlier' );
            let $earlierItem = $grid.find(`.product-miniature.not-processed[data-idx="${currentIdx - 1}"]`);
            addToColcade($earlierItem);
        }

        console.log( fromEvent + ': Add to grid ' + groupKey + ' idx: ' + currentIdx);
        // $item.css('background-color', '#F8F8F8');
        $item.removeClass('not-processed');
        $item.addClass('grid-item');
        $item.addClass(`grid-item-${groupKey}`);
        let items = [$item[0]];
        $grid.colcade( 'append', items );

        totalProcessed = totalProcessed + 1;

        // if (totalProcessed > 0 && totalProcessed < 2) {
        //     setTimeout(() => {
        //         window.scrollTo(0, 0);
        //     }, 1)
        // }

        // if (totalProcessed % 50 == 0) {
        //     console.log( 'REBUILD' );
        //     $grid.colcade({
        //         columns: '.grid-col',
        //         items: '.grid-item'
        //     })
        // }
    }

    $('.empty-img').each((index, Element) => {
        let $item = $(Element).closest('.product-miniature');
        let $grid = $(Element).closest('.product-list');
        let groupKey = $grid.data('group');
        $item.addClass('grid-item');
        $item.addClass(`grid-item-${groupKey}`);
    });

    // add using appear
    // $('.product-miniature').appear();
    // $('.product-miniature').on('appear', function(event, $all_appeared_elements) {
    //     let $item = $(event.target);
    //     if ($item.hasClass('not-processed')) {
    //         addToColcade($item, 'appear');
    //     }
    // });

    // let c = 0;

    // add using img load
    $('img').on('load', (event) => {
        let $item = $(event.target).closest('.product-miniature');
        addToColcade($item, 'load');
        // c = c + 1;
        // if (c % 50 === 0) {
        //     console.log( 'REBUILD' );
        //     $grid.colcade({
        //         columns: '.grid-col',
        //         items: '.grid-item'
        //     })
        // }
    });
}
// });
