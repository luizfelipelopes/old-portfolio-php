/* 
 * Script Para Ordenação de Itens
 */

$(function () {

    HOME = $('link[rel=js_home]').attr('href');
    var path = HOME + '/Assets/Ajax/ajax.php';
    var placeholderElement = $('<div class="testimonials_item" style="background-color: #eee;"></div>');

//    $('main').on('click', '.js_order', function () {

//        $('.j_drag_active').attr('draggable', true);

    $('html').on('drag', '.j_drag_active', function (event) {
        event.preventDefault();
        event.stopPropagation();
        dragContent = $(this);
        dragIndex = $(this).index();
//            console.log(dragContent, dragIndex);
    });

    $('html').on('dragover', '.j_drag_active', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).css('border', '2px dashed #ccc');
    });

    $('html').on('dragleave', '.j_drag_active', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).css('border', '1px solid #ccc');
    });

    $('html').on('drop', '.j_drag_active', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).css('border', '1px solid #ccc');

        dropElement = $(this);

        if (dragIndex > dropElement.index()) {
            dropElement.before(dragContent);
        } else {
            dropElement.after(dragContent);
        }

        reorder = new Array();
        $.each($('.j_drag_active'), function (i, element) {
            reorder.push([element.id, i + 1]);
        });

        var data = reorder;
        var item = $(this).attr('attr-item');
        var type = $(this).attr('attr-type');
        var offset = $('.j_paginator').attr('attr-offset');

        console.log(data, item, type, offset);

        $.post(path, {action: 'order_itens', data: data, item: item, type: type, offset: offset}, function (data) {

            if (data.error) {
                $('.js_confirmation_delete').fadeOut('fast');
                $('.js_trigger_absolute').fadeIn();
                $('.js_trigger_absolute').html('<div class="trigger trigger-' + data.error[1] + (data.error[1] === 'success' ? ' icon-check' : (data.error[1] === 'info' ? ' icon-info-circle' : (data.error[1] === 'alert' ? ' icon-alert-triangle' : (data.error[1] === 'error' ? ' icon-error-circle' : '')))) + ' radius">' + data.error[0] + '</div>');
                setTimeout(function () {
                    $('.js_trigger_absolute').fadeOut();
                }, '6000');

            }
        }, 'json');


    });




//    });


//


    $("#sortable1").sortable({

        placeholder: "ui-state-highlight",

        activate: function (event, ui) {
            placeholderElement.insertBefore(ui.item[0]);

            // Explicitly set the height and width to preserve
            // flex calculations
            placeholderElement.width(ui.item[0].offsetWidth);
            placeholderElement.height(ui.item[0].offsetHeight);
        },

        update: function (event, ui) {
            var data = $(this).sortable('serialize');
            var item = $(this).attr('attr-item');
            var type = $(this).attr('attr-type');
            var offset = $('.j_paginator').attr('attr-offset');
            console.log(data, item, type, offset, path);

            $.post(path, {action: 'ordenar_itens', data: data, item: item, type: type, offset: offset}, function (data) {

                if (data.error) {
                    $('.js_confirmation_delete').fadeOut('fast');
                    $('.js_trigger_absolute').fadeIn();
                    $('.js_trigger_absolute').html('<div class="trigger trigger-' + data.error[1] + (data.error[1] === 'success' ? ' icon-check' : (data.error[1] === 'info' ? ' icon-info-circle' : (data.error[1] === 'alert' ? ' icon-alert-triangle' : (data.error[1] === 'error' ? ' icon-error-circle' : '')))) + ' radius">' + data.error[0] + '</div>');
                    setTimeout(function () {
                        $('.js_trigger_absolute').fadeOut();
                    }, '6000');

                }
            }, 'json');

        },

        deactivate: function () {
            placeholderElement.remove();
        }

    });

//$("#sortable1").disableSelection();

});