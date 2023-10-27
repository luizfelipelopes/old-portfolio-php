<!-- CONTENT_SIDEBAR -->
<aside class="content_sidebar">

    <h1 class="fontzero">Tapetes da Cooperativa Artesanal Regional de Diamantina</h1>
    
    <nav class="menu_sidebar">

        <h1>Tapetes</h1>

        <?php
        // INICIALIZANDO VARIÁVEIS
        $read = new Read();
        $Total = null;
        $arraiolo = null;
        $smyrna = null;
        $TotalSmyrna = null;
        $TotalArraiolo = null;

        // TOTAL DE TAPETES
        $read->ExeRead("cardi_produtos");
        if ($read->getResult()):
            $Total = $read->getRowCount();
        endif;

        // RECUPERA O ID DA CATEGORIA ARRAIOLO
        $read->ExeRead("cardi_categories", "WHERE category_name = :name", "name=arraiolo");
        if ($read->getResult()):
            $arraiolo = $read->getResult()[0]['category_id'];
        endif;

        // RECUPERA O ID DA CATEGORIA SMYRNA
        $read->ExeRead("cardi_categories", "WHERE category_name = :name", "name=smyrna");
        if ($read->getResult()):
            $smyrna = $read->getResult()[0]['category_id'];
        endif;

        // TOTAL DE TAPETES ARRAIOLO
        $read->ExeRead("cardi_produtos", "WHERE produto_categoria = :cat", "cat={$arraiolo}");
        if ($read->getResult()):
            $TotalArraiolo = $read->getRowCount();
        endif;

        // TOTAL DE TAPETES SMYRNA
        $read->ExeRead("cardi_produtos", "WHERE produto_categoria = :cat", "cat={$smyrna}");
        if ($read->getResult()):
            $TotalSmyrna = $read->getRowCount();
        endif;
        ?>


        <ul>
            <li class="link_categoria"><a title="Todos os tapetes" href="<?= HOME; ?>#tapetes">Todos (<?= $Total; ?>)</a></li>
            <li><img class="divisao_sidebar" alt="" title="" src="<?= INCLUDE_PATH; ?>/images/divisao_sidebar.jpg"></li>
            <li class="link_categoria"><a title="Tapetes Arraiolo da Cooperativa Artesanal Regional de Diamantina" href="<?= HOME; ?>tapetes/arraiolo#tapetes">Arraiolo (<?= $TotalArraiolo; ?>)</a></li>
            <li><img class="divisao_sidebar" alt="" title="" src="<?= INCLUDE_PATH; ?>/images/divisao_sidebar.jpg"></li>
            <li class="link_categoria"><a title="Tapetes Smyrna da Cooperativa Artesanal Regional de Diamantina" href="<?= HOME; ?>tapetes/smyrna#tapetes">Smyrna (<?= $TotalSmyrna; ?>)</a></li>
        </ul>

    </nav>


</aside><!-- CONTENT_SIDEBAR -->
