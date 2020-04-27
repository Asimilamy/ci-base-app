var datatables_url = $("input[name='datatables_url']").val();

$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
	return {
		iStart: oSettings._iDisplayStart,
		iEnd: oSettings.fnDisplayEnd(),
		iLength: oSettings._iDisplayLength,
		iTotal: oSettings.fnRecordsTotal(),
		iFilteredTotal: oSettings.fnRecordsDisplay(),
		iPage: Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
		iTotalPages: Math.ceil(
			oSettings.fnRecordsDisplay() / oSettings._iDisplayLength
		),
	};
};
var table = $("#datatables").DataTable({
	processing: true,
	serverSide: true,
	ordering: true,
	ajax: {
		url: datatables_url,
		type: "GET",
	},
	language: {
		lengthMenu: "Tampilkan _MENU_ data",
		zeroRecords: "Maaf tidak ada data yang ditampilkan",
		info: "Menampilkan data _START_ sampai _END_ dari _TOTAL_ data",
		infoFiltered: "",
		infoEmpty: "Tidak ada data yang ditampilkan",
		search: "Cari :",
		loadingRecords: "Memuat Data...",
		processing: "Sedang Memproses...",
		paginate: {
			first: '<span class="glyphicon glyphicon-fast-backward"></span>',
			last: '<span class="glyphicon glyphicon-fast-forward"></span>',
			next: '<span class="glyphicon glyphicon-forward"></span>',
			previous: '<span class="glyphicon glyphicon-backward"></span>',
		},
	},
	columnDefs: [
		{
			data: null,
			searchable: false,
			orderable: false,
			className: "dt-center",
			targets: 0,
		},
		{ searchable: false, orderable: false, targets: 1 },
		{ className: "dt-center", targets: 2, visible: false, searchable: false },
	],
	order: [[2, "desc"]],
	rowCallback: function (row, data, iDisplayIndex) {
		var info = this.fnPagingInfo();
		var page = info.iPage;
		var length = info.iLength;
		var index = page * length + (iDisplayIndex + 1);
		$("td:eq(0)", row).html(index);
	},
});
