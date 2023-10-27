<div class="banner_social al-center container boxshadow youtube m-bottom3">

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

        <div class="g-ytsubscribe" data-channelid="<?= URL_YOUTUBE; ?>" data-layout="full" data-count="hidden" data-onytevent="onYtEvent"></div>
    </div>
    <div class="clear"></div>
</div>