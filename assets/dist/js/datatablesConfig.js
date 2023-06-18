 $(document).ready(function () {
        $('#tableUSer').DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true
        });
});
 $(document).ready(function () {
        $('#tableCustomers').DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true
        });
});