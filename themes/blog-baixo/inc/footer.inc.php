</main>

<footer class="container main_footer">

    <section class="bg-blue antirodape" itemscope itemtype="https://schema.org/Organization">

        <div class="content">

            <h1 class="fontzero">Mande-nos uma Mensagem e Nos Siga Nas Redes Sociais</h1> 

            <div class="redes_sociais">

                <!--                <div class="app_face">
                                    <div class="fb-like-box" data-href="https://www.facebook.com/gabadioficial" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
                                </div>-->


                <nav class="main_footer_social" itemprop="sameAs" itemscope itemtype="https://schema.org/URL">
                    <header>
                        <span>Redes Sociais</span>
                        <div class="form-barra"></div>
                    </header>

                    <ul class="m-bottom3">
                        <!--<li><a itemprop="url" class="shorticon shorticon-instagram" target="_blank" rel="nofollow" title="<?= SITENAME; ?> no Instagram" href="https://www.instagram.com/nilma.nayara/"></a></li>-->
                        <li><a itemprop="url" class="shorticon shorticon-facebook" target="_blank" rel="nofollow" title="<?= SITENAME; ?> no Facebook" href="https://www.facebook.com/<?=PUBLISHER_FACEBOOK;?>"></a></li>
                        <li><a itemprop="url" class="shorticon shorticon-youtube" target="_blank" rel="nofollow" title="<?= SITENAME; ?> no Youtube" href="https://www.youtube.com/channel/<?=URL_YOUTUBE;?>"></a></li>
                        <!--<li><a itemprop="url" class="shorticon shorticon-twitter" target="_blank" rel="nofollow" title="Gabadi no Twitter" href=""></a></li>-->
                    </ul>
                </nav> 
                
                <?php include 'plugin-facebook-timeline.php'; ?>
                
            </div>



            
            
            <?php include 'formulario-contato.inc.php'; ?>



            <div class="clear"></div>
        </div>

            
    </section>


    <div class="copy">
        <a title="Sacando Baixo" href="<?= HOME . '/&theme=' . THEME;?>" class="site"><?= 'sacandobaixo.com.br' ?></a>
        <p class="assinatura">Desenvolvido por <a rel="nofollow" target="_blank" title="Desenvolvido por Luiz Felipe Lopes" href="https://www.facebook.com/LuizFelipeC.Lopes">Luiz Felipe Lopes</a></p>
    </div>


</footer>

<script src="_cdn/jquery.js"></script>
<script src="_cdn/shadowbox/shadowbox.js"></script>
<script src="_cdn/scripts.js"></script>
<script src="_cdn/jquery.form.js"></script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.9&appId=1479108538830915";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php $userActiveCampaign = (!empty($_SESSION['userlogin']) && !empty($_SESSION['userlogin']['user_email']) ? $_SESSION['userlogin']['user_email'] : '');?>


<script type="text/javascript">
	var trackcmp_email = <?= $userActiveCampaign;?>;
	var trackcmp = document.createElement("script");
	trackcmp.async = true;
	trackcmp.type = 'text/javascript';
	trackcmp.src = '//trackcmp.net/visit?actid=251875139&e='+encodeURIComponent(trackcmp_email)+'&r='+encodeURIComponent(document.referrer)+'&u='+encodeURIComponent(window.location.href);
	var trackcmp_s = document.getElementsByTagName("script");
	if (trackcmp_s.length) {
		trackcmp_s[0].parentNode.appendChild(trackcmp);
	} else {
		var trackcmp_h = document.getElementsByTagName("head");
		trackcmp_h.length && trackcmp_h[0].appendChild(trackcmp);
	}
</script>

<!--<script>
    (function (d, s, id) {

        var js, fjs = d.getElementsByTagName(s)[0];

        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);

    }(document, 'script', 'facebook-jssdk'));


//    $(document).ajaxComplete(function(){
//    try {
//    FB.XFBML.parse();
//    } catch (ex) {
//
//    }
//

</script>-->



</body>
</html>
