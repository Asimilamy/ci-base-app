var view_url = $("input[name='view_url']").val();
var edit_url = $("input[name='edit_url']").val();
var delete_url = $("input[name='delete_url']").val();

toggleOverlay(false);

function viewData(id) {
	window.location.replace(view_url + "/" + id);
}

function editData(id) {
	window.location.replace(edit_url + "/" + id);
}

function deleteData(element, id) {
	var form = $(element).prev();
	form.trigger("submit");
}

$(document).on("submit", "form", function (e) {
	e.preventDefault();
	toggleOverlay(true);
	submitData(delete_url, this)
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
						window.location.reload();
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
