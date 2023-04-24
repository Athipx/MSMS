$(document).ready(function () {
    $("#datatable").DataTable(),
        $("#datatable-buttons")
            .DataTable({
                lengthChange: !1,
                buttons: ["copy", "excel", "pdf", "colvis"],
            })
            .buttons()
            .container()
            .appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
});

$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $("#example tfoot th").each(function () {
        var title = $(this).text();
        $(this).html(
            '<input class="form-control" type="text" placeholder="' +
                title +
                '" />'
        );
    });

    // DataTable
    var table = $("#example").DataTable({
        bAutoWidth: false,
        aoColumns: [
            { sWidth: "5%" },
            { sWidth: "15%" },
            { sWidth: "15%" },
            { sWidth: "15%" },
            { sWidth: "15%" },
            { sWidth: "15%" },
            { sWidth: "5%" },
        ],
        initComplete: function () {
            // Apply the search
            this.api()
                .columns()
                .every(function () {
                    var that = this;

                    $("input", this.footer()).on(
                        "keyup change clear",
                        function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        }
                    );
                });
        },
    });
});
