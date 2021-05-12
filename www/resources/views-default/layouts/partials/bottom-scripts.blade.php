<script>
    function onJqueryLoad(functionsToExecute) {
        if (typeof $ === 'function') {
            $(function(){
                for (var f in functionsToExecute) {
                    window[functionsToExecute[f]]();
                }
            });
        } else {
            setTimeout(function() { onJqueryLoad(functionsToExecute); }, 1);
        }
    }
</script>
