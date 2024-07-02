$(document).ready(function () {
	$("#tableDiagnosa").DataTable({
		// rowReorder: {
		//     selector: 'td:nth-child(2)'
		// },
		order: [],
		responsive: true,
	});
	$("#tableSkd").DataTable({
		// rowReorder: {
		//     selector: 'td:nth-child(2)'
		// },
		order: [],
		responsive: true,
	});
	$("#tableKk").DataTable({
		// rowReorder: {
		//     selector: 'td:nth-child(2)'
		// },
		order: [],
		responsive: true,
	});
	$("#tableMCU").DataTable({
		rowReorder: {
			selector: "td:nth-child(4)",
		},
		order: [],
		responsive: true,
	});
	$("#tableKaryawan").DataTable({
		// rowReorder: {
		//     selector: 'td:nth-child(2)'
		// },
		order: [],
		responsive: true,
	});
	$("#tableUSer").DataTable({
		// rowReorder: {
		//     selector: 'td:nth-child(2)'
		// },
		order: [],
		responsive: true,
	});
	$("#tableKeuangan").DataTable({
		columnDefs: [{ targets: [0], visible: false, searchable: false }],
		order: [[0, "desc"]],
		responsive: true,
		initComplete: function () {
			this.api()
				.columns([2])
				.every(function () {
					var column = this;
					var select = $(
						'<select class="form-control form-control-sm bg-default" ><option value="" disabled selected>Filter Karyawan</option><option value=""></option></select>'
					)
						.appendTo($("#karyawan"))
						.on("change", function () {
							var val = $.fn.dataTable.util.escapeRegex($(this).val());
							column.search(val ? "^" + val + "$" : "", true, false).draw();
						});

					column
						.data()
						.unique()
						.sort()
						.each(function (d, j) {
							select.append(
								'<option value="' + d + '">' + d.toUpperCase() + "</option>"
							);
						});
				});
			this.api()
				.columns([3])
				.every(function () {
					var column = this;
					var select = $(
						'<select class="form-control form-control-sm bg-default" ><option value="" disabled selected>Filter Kategori</option><option value=""></option></select>'
					)
						.appendTo($("#kategori"))
						.on("change", function () {
							var val = $.fn.dataTable.util.escapeRegex($(this).val());

							column.search(val ? "^" + val + "$" : "", true, false).draw();
						});

					column
						.data()
						.unique()
						.sort()
						.each(function (d, j) {
							select.append(
								'<option value="' + d + '">' + d.toUpperCase() + "</option>"
							);
						});
				});
			this.api()
				.columns([1])
				.every(function () {
					var column = this;
					var select = $(
						'<select class="form-control form-control-sm bg-default" ><option value="" disabled selected>Filter Status</option><option value=""></option></select>'
					)
						.appendTo($("#status"))
						.on("change", function () {
							var val = $.fn.dataTable.util.escapeRegex($(this).val());
							column.search(val ? "^" + val + "$" : "", true, false).draw();
						});

					column
						.data()
						.unique()
						.sort()
						.each(function (d, j) {
							select.append(
								'<option value="' + d + '">' + d.toUpperCase() + "</option>"
							);
						});
				});
		},
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
	$("#tableObat123").DataTable({
		responsive: true,
		bDestroy: true,
	});
});
