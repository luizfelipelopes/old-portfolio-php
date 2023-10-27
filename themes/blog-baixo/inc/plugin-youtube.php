<aside class="post_lateral">
    <article class="banner_social container boxshadow youtube">

        <div class="content">
            <script src="https://apis.google.com/js/platform.js"></script>

            <script>
                function onYtEvent(payload) {
                    if (payload.eventType == 'subscribe') {
                        // Add code to handle subscribe event.
                    } else if (payload.eventType == 'unsubscribe') {
                        // Add code to handle unsubscribe event.
                    }
                    if (window.console) { // for debugging only
                        window.console.log('YT event: ', payload);
                    }
                }
            </script>

            <div class="g-ytsubscribe" data-channelid="UCoKIFAIapauxje9IxD4yRHA" data-layout="full" data-count="hidden" data-onytevent="onYtEvent"></div>
        </div>
        <div class="clear"></div>
    </article>
</aside>