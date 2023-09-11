 $(document).ready(function () {
        $('#tableUSer').DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true
        });
        $('#tableOnModal').DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            // "lengthChange": false,
            // info: false,
            // paging: false
        });
});
//  $(document).ready(function () {
//         $('#tableCustomers').DataTable({
//             rowReorder: {
//                 selector: 'td:nth-child(2)'
//             },
//             responsive: true,
//             processing: true,
//             serverSide: true,
//             columnDefs: [{
//                 targets: [0],
//                 orderable:false
//             }]
//         });
// });