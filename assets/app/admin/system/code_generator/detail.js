var form_url = $("input[name='form_url']").val();
var table_url = $("input[name='table_url']").val();

toggleOverlay(false);

$(document).on("click", ".btn-update", () => {
	window.location.replace(form_url);
});

$(document).on("click", ".btn-back", function () {
	window.location.replace(table_url);
});
