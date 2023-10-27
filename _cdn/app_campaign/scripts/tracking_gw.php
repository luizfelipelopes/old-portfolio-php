<!-- GOOGLE ANALYTICS -->
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', '<?= $TRAKING['google_analytics']; ?>', 'auto');
    ga('send', 'pageview');
</script>

<!-- GOOGLE ADWORDS -->
<script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = <?= $TRAKING['google_adwords_id']; ?>;
    var google_conversion_language = "en";
    var google_conversion_format = "3";
    var google_conversion_color = "ffffff";
    var google_conversion_label = "<?= $TRAKING['google_adwords_label']; ?>";
    var google_remarketing_only = true;
    /* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/<?= $TRAKING['google_adwords_id']; ?>/?label=<?= $TRAKING['google_adwords_label']; ?>&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<!-- ADWORDS BY PARTNER -->
<?php
if (!empty($_SESSION['activegw'])):
    ?>
    <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = <?= $_SESSION['activegw'][0]; ?>;
        var google_conversion_language = "en";
        var google_conversion_format = "3";
        var google_conversion_color = "ffffff";
        var google_conversion_label = "<?= $_SESSION['activegw'][1]; ?>";
        var google_remarketing_only = true;
        /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
    <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/<?= $_SESSION['activegw'][0]; ?>/?label=<?= $_SESSION['activegw'][1]; ?>&amp;guid=ON&amp;script=0"/>
    </div>
    </noscript>
    <?php
endif;
?>