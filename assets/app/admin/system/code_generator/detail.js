var form_url = $("input[name='form_url']").val();
var detail_url = $("input[name='detail_url']").val();
var module = $("input[name='module']").val();
var code_generator_view = $(".code-generator-view");

toggleOverlay(false);

$(document).on("click", ".btn-update", () => {
	getView(form_url);
});

$(document).on("click", ".btn-back", function (e) {
	e.preventDefault();
	getView(detail_url);
});

function getView(url) {
	code_generator_view.slideUp(() => {
		const response = getPage(url, { module: module });
		response
			.done((response) => {
				code_generator_view
					.html(response.view)
					.promise()
					.done(() => {
						code_generator_view.slideDown();
					});
			})
			.fail((error) => {
				console.log("error :", error);
			});
	});
}
