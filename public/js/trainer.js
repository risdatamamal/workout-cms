(function ($) {
    "use strict";

    //trainer data table
    $(document).ready(function () {
        var searchable = [];
        var selectable = [];

        var dTable = $("#trainer_table").DataTable({
            order: [0, "asc"],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"],
            ],
            processing: true,
            responsive: false,
            serverSide: true,
            processing: true,
            language: {
                processing:
                    '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;margin-bottom:50px;"></i>',
            },
            scroller: {
                loadingIndicator: false,
            },
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
            ajax: {
                url: "trainer/get-list",
                type: "get",
            },
            columns: [
                { data: "name", name: "name" },
                { data: "email", name: "email", orderable: false },
                { data: "membership", name: "membership", orderable: false },
                { data: "contract", name: "contract", orderable: false },
                { data: "experience", name: "experience", orderable: false },
                { data: "speciality", name: "speciality", orderable: false },
                {
                    data: "certification",
                    name: "certification",
                    orderable: false,
                },
                //only those have manage_trainer permission will get access
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
            buttons: [
                {
                    extend: "csv",
                    className: "btn-sm btn-success",
                    title: "Trainer",
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    },
                },
                {
                    extend: "pdf",
                    className: "btn-sm btn-danger",
                    title: "Trainer",
                    pageSize: "A2",
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    },
                },
            ],
            initComplete: function () {
                var api = this.api();
                api.columns(searchable).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    input.setAttribute(
                        "placeholder",
                        $(column.header()).text()
                    );
                    input.setAttribute(
                        "style",
                        "width: 140px; height:25px; border:1px solid whitesmoke;"
                    );

                    $(input)
                        .appendTo($(column.header()).empty())
                        .on("keyup", function () {
                            column
                                .search($(this).val(), false, false, true)
                                .draw();
                        });

                    $("input", this.column(column).header()).on(
                        "click",
                        function (e) {
                            e.stopPropagation();
                        }
                    );
                });

                api.columns(selectable).every(function (i, x) {
                    var column = this;

                    var select = $(
                        '<select style="width: 140px; height:25px; border:1px solid whitesmoke; font-size: 12px; font-weight:bold;"><option value="">' +
                            $(column.header()).text() +
                            "</option></select>"
                    )
                        .appendTo($(column.header()).empty())
                        .on("change", function (e) {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                            e.stopPropagation();
                        });

                    $.each(dropdownList[i], function (j, v) {
                        select.append(
                            '<option value="' + v + '">' + v + "</option>"
                        );
                    });
                });
            },
        });
    });
    $("select").select2();
})(jQuery);
