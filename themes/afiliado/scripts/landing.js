/* 
 * Created on : 12/08/2016, 09:48:58
 * Author     : www.upinside.com.br
 */

$(function () {
    //MODAL OPEN, CLOSE
    $('.j_optin').click(function () {
        $('.j_optin_modal').fadeIn(100);
    });

    $('.j_optin_close').click(function () {
        $('.j_optin_modal').fadeOut(100);
    });

    //PLAY TAKE
    $('.testimony_start').click(function () {
        var Testimony = $(this).attr('id');
        var Headding = $(this).find('h1').html();
        $('.testimony_content h1').html(Headding);
        $('.testimony_content .embed-container').html('<iframe width="640" height="360" src="https://www.youtube.com/embed/' + Testimony + '?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>');
        $('.testimony').fadeIn(200);
    });

    //REVIEWS
    $('.testimony_close').click(function () {
        $('.testimony').fadeOut(200, function () {
            $('.testimony_content .embed-container').html('');
        });
    });

    //LAUNCH NAV
    if ($('.j_launch_play').length) {
        $('.j_launch_play').click(function () {
            var ActiveClick = $(this);
            var ActiveVideo = ActiveClick.attr("id");
            var ActiveColor = $('.active_item').css("background-color");
            var OriginalColor = $('.lp_gates_videos_content_nav_item:not(.active_item)').css("background-color")

            //IF NOT ACTIVE
            if (!$(this).hasClass('active_item') && ActiveVideo) {
                //EFFECT CONTROL
                $('.j_launch_play').removeClass('active_item').css("background", "initial");
                ActiveClick.addClass('active_item').css("background", ActiveColor);

                //VIDEO CHANGE
                $('.j_play_this').attr("src", "https://www.youtube.com/embed/" + ActiveVideo + "?rel=0&amp;showinfo=0");

                //HASH
                var ActiveHash = ActiveClick.index() + 1;
                window.location.hash = "video" + ActiveHash;

                //ASSET
                if (ActiveClick.find('link').attr('title')) {
                    $('.lp_gates_video_cta').fadeIn().html(ActiveClick.find('link').attr('title')).attr('href', ActiveClick.find('link').attr('href'));
                } else {
                    $('.lp_gates_video_cta').fadeOut();
                }
            }
        });

        if (location.hash) {
            var MediaPlay = parseInt(window.location.hash.replace('#video', '')) - 1;
            $(".j_launch_play:eq(" + MediaPlay + ")").click();
            $(window).load(function () {
                $('.lp_gates_videos_content_nav').animate({scrollTop: $(".j_launch_play:eq(" + MediaPlay + ")").position().top}, 5 * $(".j_launch_play:eq(" + MediaPlay + ")").position().top);
            });
        }
    }

    //RELOAD FB COMMENTS
    $('.j_reload').click(function () {
        FB.XFBML.parse($('#comments').get(0));
    });

    //MAIL EFFECT
    $(window).load(function () {
        $('.lp_confirm_inbox').toggleClass('lp_confirm_inbox_rotate');
    });

    //MAIL EFFECT
    window.setInterval(function () {
        $('.lp_confirm_inbox').toggleClass('lp_confirm_inbox_rotate');
    }, 4000);
});