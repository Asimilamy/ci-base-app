var table_url = $("input[name='table_url']").val();
var submit_url = $("input[name='submit_url']").val();

toggleOverlay(false);

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
		});
});

$(document).on("click", ".btn-back", () => {
	window.location.replace(table_url);
});
