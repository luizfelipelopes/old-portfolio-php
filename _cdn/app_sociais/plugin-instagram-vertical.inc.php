<div class="container app_instagram">

    <div class="content">

        <?php
        $accessToken = INSTAGRAM_APP_TOKEN;
        $url = "https://api.instagram.com/v1/users/self/media/recent/?access_token={$accessToken}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        $result = curl_exec($ch);
        curl_close($ch);

//        var_dump($url);

        $result = json_decode($result);
//        var_dump($result);

        if (!empty($result)):

            $i = 0;
            foreach ($result->data as $post):
                $i++;

                if ($i > 12):
                    break;
                endif;
                ?>
                <div class="app_instagram_item box box-medium">
                    <span class="box_imagem" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                        <!--<a href="<?= $post->images->standard_resolution->url; ?>" title="<?= $post->caption->text; ?>"><img title="<?= $post->caption->text; ?>" alt="[<?= $post->caption->text; ?>]" src="<?= $post->images->thumbnail->url; ?>"></a>-->
                        <a target="_blank" href="https://instagram.com/<?= URL_INSTAGRAM; ?>" title="<?= $post->caption->text; ?>"><img title="<?= $post->caption->text; ?>" alt="[<?= $post->caption->text; ?>]" src="<?= $post->images->thumbnail->url; ?>"></a>
                        <meta itemprop="width" content="300" />
                        <meta itemprop="height" content="180" />
                    </span>
                </div>
                <?php
            endforeach;
        endif;
        ?>

    </div>
    <div class="clear"></div>
</div>
