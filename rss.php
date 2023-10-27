<?php
require '_app/Config.inc.php';
spl_autoload_register('carregarClasses');
date_default_timezone_set("America/Sao_Paulo");


$feed = filter_input(INPUT_GET, 'feed', FILTER_DEFAULT);
if ($feed):
//    var_dump($feed);
endif;

header("Content-Type: application/xml; charset=UTF-8");
?>

<rss version="2.0"
     xmlns:atom="http://www.w3.org/2005/Atom">

    <channel>
        <title><?= SITENAME; ?></title>
        <link><?= HOME; ?></link>
        <description><?= SITEDESC ?></description>
        <language>pt-br</language>
        <atom:link href="<?= HOME; ?>rss.xml" rel="self" type="application/rss+xml" />

        <?php
        $read = new Read;

        switch ($feed):

            case 'produtos':
                $read->ExeRead(PRODUTOS, "ORDER BY produto_data DESC");

                if ($read->getResult()):
                    foreach ($read->getResult() as $produto):
                        extract($produto);
                        ?>
                        <item>
                            <title><?= str_replace(array(' ', '<', '>', '&', '{', '}', '*'), array(' '), $produto_title); ?></title>
                            <link><?= HOME . 'Detalhes/' . $produto_name; ?></link>
                            <pubDate><?= date('D, d M Y H:i:s O', strtotime($produto_data)); ?></pubDate>
                            <description><?= str_replace(array(' ', '<', '>', '&', '{', '}', '*'), array(' '), strip_tags($produto_descricao)); ?></description>
                            <enclosure type="image/*" url="<?= HOME . 'uploads' . $produto_image; ?>"/>
                            <id><?= 'product_' . $produto_id; ?></id>
                            <image_link><?= HOME . 'uploads' . $produto_image; ?></image_link>
                            <condition>new</condition>
                            <price><?= (!empty($produto_desconto) && $produto_desconto > 0 ? $produto_valor_descontado : $produto_valor); ?></price>
                            <availability><?= ($produto_disponivel == '1' ? 'in stock' : 'out of stock');?></availability>
                            <brand>Cooperativa Artesanal Regional de Diamantina</brand>
                            <gtin>0</gtin>
                            <mpn>mpn</mpn>
                            
                            
                            <?php
                            $readCategoria = new Read;
                            $readCategoria->ExeRead(CATEGORIAS, "WHERE category_id = :id", "id={$produto_categoria}");
                            if ($readCategoria->getResult()):
                                ?>
                                <google_product_category><?= $readCategoria->getResult()[0]['category_title']; ?></google_product_category>

                                <?php
                            endif;
                            ?>

                        </item>
                        <?php
                    endforeach;
                endif;

                break;

            default :
                $read->ExeRead(POSTS, "ORDER BY post_date DESC");
                if ($read->getResult()):

                    foreach ($read->getResult() as $post):
                        extract($post);
                        ?>
                        <item>
                            <title><?= str_replace(array(' ', '<', '>', '&', '{', '}', '*'), array(' '), $post_title); ?></title>
                            <link><?= HOME . '/post/' . $post_name; ?></link>
                            <pubDate><?= date('D, d M Y H:i:s O', strtotime($post_date)); ?></pubDate>
                            <description><?= str_replace(array(' ', '<', '>', '&', '{', '}', '*'), array(' '), strip_tags($post_subtitle)); ?></description>
                        </item>
                        <?php
                    endforeach;
                endif;

                break;

        endswitch;
        ?>



    </channel>
</rss>

