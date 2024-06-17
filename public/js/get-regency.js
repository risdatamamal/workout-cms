(function ($) {
    "use strict";
    $(document).ready(function () {
        $("#province_id").change(function () {
            var selectedProvinceId = $(this).val();
            $("#regency_id")
                .empty()
                .append('<option value="0">Select Regency</option>');
            if (selectedProvinceId) {
                $.ajax({
                    url: "/regencies/" + selectedProvinceId,
                    type: "GET",
                    dataType: "json",
                    success: function (regencies) {
                        $.each(regencies, function (_, regency) {
                            if (regency.id) {
                                $("#regency_id").append(
                                    '<option value="' +
                                        regency.id +
                                        '">' +
                                        regency.name +
                                        "</option>"
                                );
                            }
                        });
                    },
                });
            }
        });
    });
    $("select").select2();
})(jQuery);
