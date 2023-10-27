<!--DESTAQUE-->
<article class="container main_destaque">
    <div class="header_destaque al-center content">
        <h1>Cet-Rhema</h1>
        <p class="tagline">"Um seminário a Serviço do Reino"</p>
        <div class="clear"></div>
    </div>
</article>


<!--CHAMADA VISUAL-->
<section class="container main_chamada">

    <div class="content">
        <header class="main_chamada_header sectiontitle">
            <h1>Cursos Cet-Rhema:</h1>
            <p class="tagline">Os melhores Cursos de Teologia Estão Aqui!</p>
        </header>

        <div class="curso_content m-top3" id="cursos">

            <?php
            $readCursos = new Read;
            $readCursos->ExeRead(CURSOS, "WHERE curso_status = 1 ORDER BY curso_date DESC");
            if ($readCursos->getResult()):
                foreach ($readCursos->getResult() as $curso):
                    ?>

            
                    <article class="curso_item box superior">
                        <img title="<?= $curso['curso_title']; ?>" alt="[<?= $curso['curso_title']; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $curso['curso_cover']; ?>" />
                        <h1 class="curso_item_title"><?= $curso['curso_title']; ?></h1>
                        <div class="divisao_preco_parcela">
                            <span>R$ <?= number_format($curso['curso_valor'], 2, ',', '.'); ?></span>
                            <p>Em até 12x no Cartão</p>
                        </div>
                        <a class="btn btn-blue radius shorticon shorticon-botao shorticon-entrar" title="" href="<?= HOME ?>/curso/<?= $curso['curso_name'] . '/&theme=' . THEME; ?>">Conheça o Curso</a> 

                    </article>
                    <?php
                endforeach;
            endif;
            ?>  
            <div class="clear"></div>
        </div>

        <div class="clear"></div>
    </div>
</section>



<section class="container main_conteudo bg-orange">
    <div class="content">
        <header class="sectiontitle sectiontitle-nomargin">
            <h1>Quer Melhorar Seus Conhecimentos Teológicos com Conteúdo de Qualidade e Sem Precisar Sair De Casa?</h1>
            <p class="tagline">No Cet-Rhema Você encontra o Ambiente Adequado Para Seus Estudos:</p>
        </header>
        <div class="clear"></div>
    </div>



    <div class="content al-center bg-body">

        <div class="conteudo_itens">

            <article class="conteudo_item box nossa_fe" id="nossa_fe">
                <img title="Nossa Fé" alt="[Nossa Fé]" src="<?= INCLUDE_PATH ?>/img/fe.png" />
                <h1>Nossa Fé</h1>
                <p>Cremos na inspiração plena das Escrituras sendo Deus seu verdadeiro autor, tendo como objetivo salvar o homem. Seu conteúdo é a verdade sem qualquer mescla de erro.
                    Cremos eu um só Deus como também no Espírito Santo que inspirou homens na antiguidade para escrever as Escrituras.
                    Cremos, portanto:
                    No Pai, no Filho e no Espírito Santo.</p>
            </article>


            <article class="conteudo_item box corpo_docente" id="corpo_docente">
                <img title="Corpo Docente" alt="[Corpo Docente]" src="<?= INCLUDE_PATH ?>/img/corpo-docente.png" />
                <h1>Corpo Docente</h1>
                <p>O Cet-Rhema compõe-se de uma equipe de colaboradores com larga experiência no ministério, todos são pastores e missionários em suas respectivas Igrejas, e possuem cursos de graduação em Teologia e graduações em diferentes áreas, como também experiência no ensino. Todos eles com uma teologia séria e comprometida com a palavra de Deus.</p>
            </article>


            <article class="conteudo_item box estagio">
                <img title="Estágio" alt="[Estágio]" src="<?= INCLUDE_PATH ?>/img/estagio.png" />
                <h1>Estágio</h1>
                <p>Todos alunos passam por um estágio em suas respectivas Igrejas, que auxiliados pelos seus lideres, ou pela sua Igreja, apresentam um relatório à instituição, onde contará como crédito na sua grade de notas.</p>
            </article>

            <article class="conteudo_item box dinamica_curso">
                <img title="Dinâmica Do Curso" alt="[Dinâmica Do Curso]" src="<?= INCLUDE_PATH ?>/img/dinamica.png" />
                <h1>Dinâmica Do Curso</h1>
                <p>Nossos cursos, além de uma apostila que fica á disposição do aluno, caso ele queira usá-la, é orientado na sua maior parte, na forma de pesquisas, onde há uma grande possibilidade de um aprendizado de alto nível intelectual, claro, sem deixar de enfatizar o lado espiritual que é de natureza do curso de teologia destinada ao ministério. Essas pesquisas serão orientadas pelos professores da instituição, que poderão ser solicitadas no decorrer do curso. 
                    Lembrando que, para cada nível de curso, temos uma dinâmica diferente, tendo em vista o conteúdo estudado de cada disciplina. Embora havendo diferença nos cursos, todos eles são ensinados com rigor nas ministrações para que o aprendizado seja proveitoso. 
                    Aos interessados, bem-vindos!
                </p>
            </article>


            <article class="conteudo_item box publico_alvo" id="publico_alvo">
                <img title="Público Alvo" alt="[Público Alvo]" src="<?= INCLUDE_PATH ?>/img/publico-alvo.png" />
                <h1>Público Alvo</h1>
                <p>Os cursos oferecidos pelo Cet-Rhema, tem como alvo todos aqueles que querem, além de aprender teologia de alto nível, 
                    agregar conhecimento, buscar capacitação para o ministério da palavra; no pastorado como missionário, evangelista, 
                    obreiro da Igreja local, como professorar da Escola Bíblica Dominical e também aprimorar o conhecimento. 
                    Com pequeno investimento, o candidato poderá obter nossos cursos que estão á disposição, onde além do 
                    conteúdo de excelente qualidade acadêmica, prima pelo espiritual.</p>
            </article>

        </div>



        <div class="clear"></div>
    </div>



</section>



<section class="container main_comentarios" id="main_comentarios">


    <header class="container bg-green-middle-dark fl-left m-bottom2">
        <div class="content">
            <h1 class="sectiontitle sectiontitle-nomargin title">Confira os depoimentos de Pessoas Que Já Fizeram O Curso:</h1>
            <div class="clear"></div>
        </div>

    </header>


    <div class="content">

        <div class="comments">
            <article class="comentario_item box">
                <img class="round" title="" alt="" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' ?>/usuarios/perfil-user.png" />
                <div class="comment">
                    <p>"Olá irmãos Sou pastor Valci da Primeira Igreja Batista em Carbonita. O cet- rhema foi muito importante pra mim e meu ministério. Com cerca de duas décadas, já formou um grande número de obreiros e pastores. Hoje eu tenho alguns irmãos de minha igreja estudando no cet-rhema. Sério e bem fundamentado. Portanto, recomendo aos que anseiam por fazer um curso de teologia de alto nível."</p>
                    <h1>Pr. Valci Goulart de Souza - Primeira Igreja Batista em Carbonita – CBN</h1>
                </div>
            </article>

            <article class="comentario_item box">
                <img class="round" title="" alt="" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' ?>/usuarios/perfil-user.png" />
                <div class="comment">
                    <p>"Olá irmãos Sou Pr. Rodrigo, da Igreja Batista em Chapada do Norte, venho recomendar o Cet-rhema a você que gostaria de fazer um curso de teologia de alto nível Com mais de duas décadas de ensino, o cet-rhema tem experiência no ensino no sistema EAD. Venho, portanto,recomendar os seus cursos a você."</p>
                    <h1>Pr. Rodrigo Gomes Silva - Igreja Batista em Chapada do Norte</h1>
                </div>
            </article>
        </div>    

        <div class="clear"></div>
    </div>


</section>



<article class="container main_chamada_reforco bg-blue al-center">

    <div class="content">
        <h1 class="sectiontitle">Não perca Tempo! Matricule-se em nossos Cursos, <mark>Gerencie seu Tempo</mark> e <mark>Adquira Conhecimento Teológico</mark> de Qualidade!</h1>
        <a class="btn btn-orange radius" title="Conheça os Cursos!" href="#cursos">Conheça os Cursos!</a>
        <div class="clear"></div>
    </div>

</article>



