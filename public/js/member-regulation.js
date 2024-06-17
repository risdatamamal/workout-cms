(function ($) {
    ("use strict");
    $("#tags").tagsinput("items");
    $(".select2").select2();
    $(".html-editor").summernote({
        height: 300,
        tabsize: 2,
    });
    $(".file-upload-browse").on("click", function () {
        var file = $(this)
            .parent()
            .parent()
            .parent()
            .find(".file-upload-default");
        file.trigger("click");
    });
    $(".file-upload-default").on("change", function () {
        $(this)
            .parent()
            .find(".form-control")
            .val(
                $(this)
                    .val()
                    .replace(/C:\\fakepath\\/i, "")
            );
    });
})(jQuery);
