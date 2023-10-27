    $(function() {
    $('.j_loadstate').change(function() {
        var uf = $('.j_loadstate');
        var city = $('.j_loadcity');
        var patch = ($('#j_ajaxident').attr('class').length ? $('#j_ajaxident').attr('class') + '/city.php' : '../_cdn/ajax/city.php');
        console.log(patch);
        city.attr('disabled', 'true');
        uf.attr('disabled', 'true');
		
        city.html('<option value=""> Carregando cidades... </option>');

        $.post(patch, {estado: $(this).val()}, function(cityes) {
            city.html(cityes).removeAttr('disabled');
            uf.removeAttr('disabled');
        });
    });
});