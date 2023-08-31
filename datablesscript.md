ar table = $('#historytbl').DataTable({
            responsive: true,
            "order": [[ 0, "desc" ]],
            "columnDefs": [
                { "orderable": true, "targets": 1 },
                { "orderable": true, "targets": 2 },
                { "orderable": true, "targets": 3 },
                { "orderable": true, "targets": 4 },
                { "orderable": true, "targets": 5 },
                { "orderable": true, "targets": 6 },
                { "orderable": true, "targets": 7 },
                { "orderable": true, "targets": 8 },
                { "orderable": true, "targets": 9 },
                { "orderable": true, "targets": 10 },
                { "orderable": true, "targets": 11 },
            ],
            "pageLength": 10,
            "lengthMenu": [ 10, 25, 50, 75, 100 ],
            "language": {
                "lengthMenu": "Display _MENU_ records per page",
                "zeroRecords": "Nothing found - sorry",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Search:",
                "paginate": {
                    "first":      "First",
                    "last":       "Last",
                    "next":       "Next",
                    "previous":   "Previous"
                },
            }
        }); 
    }); 


    <!-- Nasa receipt na ko -->