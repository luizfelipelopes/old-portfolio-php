<!--RODAPÉ-->
<footer>
    <div class="antirodape flex">
        <div class="antirodape_menu flex-3">
            <h2>Links Úteis</h2>
            <nav>
                <ul>
                    <li><a class="<?= $Link->getLocal()[0] == 'index' || $Link->getLocal()[0] == 'pesquisa' ? 'color-blue' : ''; ?>" title="" href="<?= HOME . '/&theme=' . THEME; ?>">Home</a></li>
                    <li><a class="<?= $Link->getLocal()[0] == 'posts' || $Link->getLocal()[0] == 'post' ? 'color-blue' : ''; ?>" title="" href="<?= HOME . '/posts/&theme=' . THEME; ?>">Posts</a></li>
                    <li><a class="<?= $Link->getLocal()[0] == 'videos' ? 'color-blue' : ''; ?>" title="" href="<?= HOME . '/videos/&theme=' . THEME; ?>">Vídeos</a></li>
                    <li><a class="<?= $Link->getLocal()[0] == 'contato' ? 'color-blue' : ''; ?>" title="" href="<?= HOME . '/contato/&theme=' . THEME; ?>">Contato</a></li>
                </ul>
            </nav>
        </div>

        <div class="antirodape_about flex-3">
            <h2>Sobre Nós</h2>
            <p>A 1ª Igreja Batista em Diamantina já está a mais de 40 anos pregando o Evangelho em Diamantina e no Vale do Jequitinhonha. Dentro desse ministério foi criado a GABADI – Galera Batista de Diamantina – esse grupo formado pela mocidade da igreja que se organiza todos os sábados para poderem cultuar a Deus. Venha e traga seus amigos para ouvirem a Palavra de Deus, fazer novas amizades e fortalecer as antigas.</p>
        </div>

        <div class="antirodape_follow flex-3">
            <h2>Siga-nos</h2>
            <div class="antirodape_follow_icons">
                <a title="Facebook" href="https://www.facebook.com/<?= URL_FACEBOOK; ?>/" target="_blank" class="icon-facebook"></a>
                <a title="Instagram" href="https://www.instagram.com/<?= URL_INSTAGRAM; ?>/" target="_blank" class="icon-instagram"></a>
                <a title="Youtube" href="https://www.youtube.com/channel/<?= URL_YOUTUBE; ?>" target="_blank" class="icon-youtube"></a>
            </div>
        </div>
    </div>

    <div class="footer">
        <p class="footer_copy">1ª Igreja Batista em Diamantina - Todos os Direitos Reservados</p>
        <p class="footer_signature">Desenvolvido por <a title="" href="https://www.instagram.com/lfelipeclopes/" target="_blank">Luiz Felipe Lopes</a></p>
    </div>
</footer>
