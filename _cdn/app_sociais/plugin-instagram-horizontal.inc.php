<article class="container app_instagram">

    <div class="content al-center">

        <header class="m-bottom3">
            <h1 class="title fontsize1">Insta da Nutri</h1>
            <div class="form-barra"></div>
        </header>

        <?php
        $accessToken = INSTAGRAM_APP_TOKEN;
        $url = "https://api.instagram.com/v1/users/self/media/recent/?access_token={$accessToken}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $curl = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($curl);

        if (!empty($result)):

            $i = 0;
            foreach ($result->data as $post):
                $i++;

                if ($i > 14):
                    break;
                endif;
                ?>
                
                <a href="<?= $post->images->standard_resolution->url; ?>" title="<?= $post->caption->text; ?>"><img <?= ($i <= 7 ? 'style="margin-bottom: 10px;"' : ''); ?> title="<?= $post->caption->text; ?>" alt="[<?= $post->caption->text; ?>]" src="<?= $post->images->thumbnail->url; ?>"></a>
                
                <?php
            endforeach;
        endif;
        ?>

    </div>
    <div class="clear"></div>
</article>
