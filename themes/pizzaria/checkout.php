<!--MESA PIZZA-->
<section class="container mesa_pizza">

    <div class="content-header no-padding-top">

        <h1>Fechar Pedido</h1>

        <div class="clear"></div>
    </div>

</section>


<!--CHECKOUT-->
<section class="checkout container bg-white m-top1">
    <header class="container m-bottom3 bg-yellow pd-total">
        <div class="container botoes_controle">
            <a class="btn btn-red radius fl-left" href="#" title="Continuar">Continuar</a>
            <a class="btn btn-green radius fl-right" href="#" title="Avançar">Avançar</a>
        </div>
    </header>

    <div class="content">

        

        <div class="itens_selecionados">

            <h1 class="container font-bold m-bottom1">Itens Selecionados</h1>
            
            <div class="item">
                <img src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/' ?>produtos/produto_926.jpg" title="Pizza 4 queijos" alt="[Pizza 4 queijos]">

                <div class="produto_valor">
                    <span>R$ 46,00</span>
                    <img src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/' ?>boot/icons/icon-close.png" title="Cancelar" alt="[Cancelar]" >
                </div>

                <div class="bloco_descricao">

                    <div class="descricao_produto">
                        <div class="descricao_categoria">Pizzas (Grande)</div>
                        <div class="descricao_nome">4 Queijos + 4 Queijos</div>
                        <div class="descricao_ingredientes">Ingredientes</div>
                        <div class="lista_ingredientes">
                            <p><span>1º Sabor:</span>Abacaxi, Creme de leite, Molho especial, Mussarela, Orégano, Peito de frango desfiado</p>
                            <p><span>2º Sabor:</span>Alho Poró, Molho especial, Mussarela, Orégano, Parmesão Ralado, Peito de peru defumado, Tomate Cereja</p>
                        </div>

                        <div class="descricao_editar">Editar</div>
                    </div>

                </div>
            </div>

            <div class="item">
                <img src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/' ?>produtos/produto_926.jpg" title="Pizza 4 queijos" alt="[Pizza 4 queijos]">
                <div class="produto_valor">
                    <span>R$ 46,00</span>
                    <img src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/' ?>boot/icons/icon-close.png" title="Cancelar" alt="[Cancelar]" >
                </div>

                <div class="bloco_descricao">
                    <div class="descricao_produto">
                        <div class="descricao_categoria">Pizzas (Grande)</div>
                        <div class="descricao_nome">4 Queijos + 4 Queijos</div>
                        <div class="descricao_ingredientes">Ingredientes</div>
                        <div class="lista_ingredientes">
                            <p><span>1º Sabor:</span>Abacaxi, Creme de leite, Molho especial, Mussarela, Orégano, Peito de frango desfiado</p>
                            <p><span>2º Sabor:</span>Alho Poró, Molho especial, Mussarela, Orégano, Parmesão Ralado, Peito de peru defumado, Tomate Cereja</p>
                        </div>

                        <div class="descricao_editar">Editar</div>
                    </div>

                </div>
            </div>


            <div class="subtotal">Sub-total:<span> R$ 92,00</span></div>

        </div>


        <div class="recomendados">
            <h1>Aproveite também</h1>
            <div class="produto_recomendado">
                <div class="recomendado_img">
                    <img src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/' ?>produtos/produto_926.jpg" title="Coca Cola" alt="[Coca Cola]">
                </div>
                <span class="recomendado_categoria">Bebidas</span>
                <span class="recomendado_descricao">Coca-Cola 1,5 L</span>
                <span class="recomendado_valor">R$ 6,50</span>
                <a href="#" title="" class="btn btn-green radius">Adicionar ao meu pedido</a>
            </div>
        </div>


        <footer class="container m-bottom3 m-top3">
            <div class="container botoes_controle">
                <a class="btn btn-red radius fl-left" href="#" title="Continuar">Continuar</a>
                <a class="btn btn-green radius fl-right" href="#" title="Avançar">Avançar</a>
            </div>
        </footer>
        <div class="clear"></div>

    </div>
</section>