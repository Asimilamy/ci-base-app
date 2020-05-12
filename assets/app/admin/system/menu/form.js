var table_url = $("input[name='table_url']").val();
var submit_url = $("input[name='submit_url']").val();
var search_menu_url = $("input[name='search_menu_url']").val();

toggleOverlay(false);

$(".menu-select2").select2({
	ajax: {
		url: search_menu_url,
		dataType: "JSON",
		delay: 250,
		data: (params) => {
			return {
				q: params.term,
				page: params.page,
			};
		},
		processResults: (data, params) => {
			params.page = params.page || 1;
			return {
				results: $.map(data.items, (item) => {
					return {
						text: item.name,
						id: item.id,
					};
				}),
				pagination: {
					more: params.page * 30 < data.total_count,
				},
			};
		},
		cache: true,
	},
	placeholder: "Search for parent menu",
	minimumInputLength: 1,
	allowClear: true,
});

$('input[type="checkbox"].flat-blue').iCheck({
	checkboxClass: "icheckbox_flat-blue",
});

$(document).on("submit", "#form", function (e) {
	e.preventDefault();
	toggleOverlay(true);
	submitData(submit_url, this)
		.done((response) => {
			$("input[name='" + response.csrf_name + "']").val(response.csrf_hash);
			$.toast({
				heading: response.status === false ? "Error" : "Success",
				text: response.message,
				showHideTransition: "slide",
				icon: response.status === false ? "error" : "success",
				loaderBg: response.status === false ? "#f2a654" : "#f96868",
				position: "top-right",
				afterHidden: function () {
					toggleOverlay(false);
					if (response.status !== false) {
						window.location.replace(response.redirect_to);
					}
				},
			});
		})
		.fail((error) => {
			console.log("Error :", error);
			$.toast({
				heading: "Error",
				text: "Sorry system encountered error!",
				showHideTransition: "slide",
				icon: "error",
				loaderBg: "#f2a654",
				position: "top-right",
				afterHidden: function () {
					toggleOverlay(false);
				},
			});
		});
});
