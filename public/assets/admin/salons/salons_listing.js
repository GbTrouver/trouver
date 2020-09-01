$(document).ready(function () {
    salonTable = $('#salons-table').DataTable({
        "sDom": '<"float-left"f>tirtp',
        "bLengthChange":false,
        "bInfo": false,
        "processing": true,
        "aaSorting": [],
        "bSortable": true,
        // "sPaginationType": "extStyle",
        "oLanguage": {
            "sSearch": "",
            "sSearchPlaceholder": "Search with Salon Name",
            // "sProcessing": "<img class='spinner' src='../assets/global/img/loading-spinner-default.gif'>",
            "sEmptyTable": 'No matching records found'
        },
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('salonTable', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse(localStorage.getItem('salonTable'));
        },
        "serverSide": true,
        'ajax': {
            url: $('#get-salons-url').val(),
            type: "GET",
            "data": function (d) {
                // d.status= $('#status').val();
                // d.property_type= $('#property-type').val();
                // d.assigned_user= $('#assigned-user').val();
            },
            complete: function (data) {
                // console.log(data);
                var recordsTotal = data.responseJSON.recordsTotal;
                if(recordsTotal<=10)
                {
                    $('.dataTables_paginate').hide();
                }
                else
                {
                    $('.dataTables_paginate').show();
                }
           },
            error: function () { //error handling
            }
        },
        "columns": [
            {data:'logo', name:'logo'},
            {data:'name', name:'name'},
            {data:'email', name:'email', searchable: false},
            {data:'open_at', name:'open_at', searchable: false},
            {data:'close_at', name:'close_at', searchable: false},
            {data:'action', name:'action', orderable: false, searchable: false},
        ],
    });
    $('#salons-table_filter label').addClass('col-md-12');
    $('#salons-table_filter input').addClass('form-control');
    $('.paginate_button').addClass('btn btn-success');
    // $("#pendingTable_processing").css("margin-left", "169px");
    //datatable

});

function viewall() {
    // $("#checkbox1").prop("checked",false);
    // $('#property-type').val(0);
    // $('#status').val(0);
    // $('#assigned-user').val(0);
    salonTable.search('').draw();
}
