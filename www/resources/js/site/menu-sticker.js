import xGlSticky from '@glulab/gl-sticky';

$(() => {

    if (!$('header .navbar').length) {
        return;
    }

    xGlSticky.setOptions({
        active: true,
        toggleTriggerPoint: 10,
        onStick: (s) => {
        },
        onUnstick: (u) => {
        },
    });

    xGlSticky.reInit();
});
