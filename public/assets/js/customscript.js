//Adds csrf token to all ajax request.
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    $('#gif-loading-screen').hide();
});

function slugify(text) {
    return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');            // Trim - from end of text
}

function fancyBoxAjax(params) {
    $('.fancybox-ajax-call').each(function () {
        var options = {
            smallBtn: false,
            buttons: [],
            type: 'ajax',
            // modal: true,
            padding: 0,
            touch: false,
        }
        $(this).fancybox(options);
    })

    $(document).on('click', '.js-fancybox-ajax__cancel', function () {
        $.fancybox.close();
    });
}

fancyBoxAjax();

// Change hash for page-reload
$('.nav-tabs a').on('shown.bs.tab', function (e) {
    window.location.hash = e.target.hash;
});

// Javascript to enable link to tab
var hash = location.hash.replace(/^#/, '');  // ^ means starting, meaning only match the first hash
if (hash) {
    $('.nav-tabs a[href="#' + hash + '"]').tab('show');
}

$(document).ready(function(){
    $('a[href^="#"]').click(function(event) {

        // The id of the section we want to go to.
        var id = $(this).attr("href");

        // An offset to push the content down from the top.
        var offset = 60;

        // Our scroll target : the top position of the
        // section that has the id referenced by our href.
        var target = $(id).offset().top - offset;

        // The magic...smooth scrollin' goodness.
        $('html, body').animate({scrollTop:target}, 500);

        //prevent the page from jumping down to our section.
        event.preventDefault();
    });

    $('.custom-select').select2();

    $('.custom-datepicker').flatpickr();

    $('.custom-datetimepicker').flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
});

$.fn.select2.defaults.set("theme", "bootstrap");

$(document).on('click', '.fancy-content-dismiss', function () {
    $.fancybox.close();
});


$(document).on({
    mouseenter: function () {
        $(this).find('.hovered-display').fadeIn();
        console.log('boom');
    },
    mouseleave: function () {
        $(this).find('.hovered-display').fadeOut();
        //stuff to do on mouse leave
    }
}, ".on-hover");

//On file change, show the file name to be attached
$('input[type="file"]').change(function (e) {
    var fileName = e.target.files[0].name;
    $(e.target).siblings('.custom-file-label').html(fileName);
});
