$(document).ready(function () {
	$("#tableUSer").DataTable({
		// rowReorder: {
		//     selector: 'td:nth-child(2)'
		// },
		responsive: true,
	});
	$("#tableKeuangan").DataTable({
		// rowReorder: {
		//     selector: 'td:nth-child(2)'
		// },
		columnDefs: [{ width: "20%", targets: 6 }],
		responsive: true,
	});
	$("#tableOnModal").DataTable({
		// rowReorder: {
		//     selector: 'td:nth-child(2)'
		// },
		responsive: true,
		// "lengthChange": false,
		// info: false,
		// paging: false
	});
	$("#tableOnModalPelanggan").DataTable({
		// rowReorder: {
		//     selector: 'td:nth-child(2)'
		// },
		responsive: true,
		// "lengthChange": false,
		// info: false,
		// paging: false
	});
});
