<?php $FaceUrl = (!empty($_SESSION['theme']) ? URL_FACEBOOK_THEME : URL_FACEBOOK); ?>

<article class="container">
    <div class="fb-page" 
        data-href="https://www.facebook.com/<?= $FaceUrl; ?>" 
        data-tabs="timeline" 
        data-small-header="false" 
        data-adapt-container-width="true" 
        data-hide-cover="false" 
        data-show-facepile="true">
        <blockquote cite="https://www.facebook.com/<?= $FaceUrl; ?>" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/<?= $FaceUrl; ?>"></a></blockquote>
    </div>
    <div class="clear"></div>
</article>