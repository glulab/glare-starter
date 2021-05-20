import xGlWindowResizeListener from '@glulab/gl-window-resize-listener';
import invertBy from 'lodash/invertBy';

$(() => {

    /**
     * $window
     */
    let $window = $(window);

    /**
     * $body
     */
    let $body = $('body');

    /**
     * currentWidth
     */
    let currentWidth;

    /**
     * desktopBreakpoint
     */
    let desktopBreakpoint = 992;

    /**
     * breakpointsByWidth
     */
    let breakpointsByWidth = {};

    /**
     * getBreakpoints()
     *
     * @return void
     */
    let getBreakpoints = () => {
        desktopBreakpoint = window.gridBreakpoints.desktop || 992;
        breakpointsByWidth = invertBy(window.gridBreakpoints);
    };

    /**
     * getWidth()
     *
     * @return void
     */
    let getWidth = () => {
        currentWidth = $window.outerWidth()
    };

    /**
     * removeResponsiveClasses()
     *
     * @return void
     */
    let removeResponsiveClasses = () => {
        $body.removeClass(function (index, className) {
            return className.match(/in-\S+/g);
        });

        $body.removeClass(function (index, className) {
            return className.match(/up-\S+/g);
        });
    };

    /**
     * addResponsiveClasses()
     *
     * @return void
     */
    let addResponsiveClasses = () => {
        let className = currentWidth < desktopBreakpoint ? 'in-mobile' : 'in-desktop';
        $body.addClass(className);

        Object.keys(breakpointsByWidth).forEach((key) => {
            if (key < currentWidth) {
                breakpointsByWidth[key].forEach((className) => {
                    $body.addClass(`up-${className}`);
                });
            }
        });
    };

    /**
     * measure()
     *
     * @return void
     */
    let measure = () => {
        getWidth();
        removeResponsiveClasses();
        addResponsiveClasses();

    };

    /**
     * init()
     *
     * @return vois
     */
    let init = () => {
        getBreakpoints();
        measure();
    };

    init();

    xGlWindowResizeListener.addEvent(() => {
        measure();
    });
});
