var submit_url = $("input[name='submit_url']").val();

toggleOverlay(false);

$('input[type="checkbox"].flat-blue').iCheck({
	checkboxClass: "icheckbox_flat-blue",
});

$(".chk-all-create").on("ifChecked", function () {
	$(".chk-create").iCheck("check");
});

$(".chk-all-create").on("ifUnchecked", function () {
	$(".chk-create").iCheck("uncheck");
});

$(".chk-all-read").on("ifChecked", function () {
	$(".chk-read").iCheck("check");
});

$(".chk-all-read").on("ifUnchecked", function () {
	$(".chk-read").iCheck("uncheck");
});

$(".chk-all-update").on("ifChecked", function () {
	$(".chk-update").iCheck("check");
});

$(".chk-all-update").on("ifUnchecked", function () {
	$(".chk-update").iCheck("uncheck");
});

$(".chk-all-delete").on("ifChecked", function () {
	$(".chk-delete").iCheck("check");
});

$(".chk-all-delete").on("ifUnchecked", function () {
	$(".chk-delete").iCheck("uncheck");
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
						localStorage.clear();
						getUserMenu();
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
