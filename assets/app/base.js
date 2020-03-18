if (typeof jQuery === "undefined") {
	throw new Error("POS App requires jQuery");
}

var overlay = $(".overlay");
var get_user_menu_url = $("input[name='get_user_menu_url']").val();
var path = window.location.href;
path = path.replace(/\/$/, "");
path = decodeURIComponent(path);

renderUserMenu();

function submitData(url, element) {
	return $.ajax({
		type: "post",
		url: url,
		data: new FormData(element),
		contentType: false,
		processData: false
	});
}

function toggleOverlay(is_visible) {
	if (is_visible === true) {
		return new Promise(() => {
			overlay.fadeIn();
		});
	} else {
		return new Promise(() => {
			overlay.fadeOut();
		});
	}
}

function setNavigation() {
	$(".sidebar-menu a").each(function() {
		var href = $(this).attr("href");
		if (path.substr(0, href.length) === href) {
			$(this)
				.parentsUntil(".sidebar-menu", "li")
				.addClass("active");
		}
	});
}

function getUserMenu() {
	$.ajax({
		type: "get",
		url: get_user_menu_url
	})
		.done(response => {
			console.log("response :", response);
			localStorage.setItem("menus", JSON.stringify(response.sidebar));
			$("ul.sidebar-menu")
				.html(response.sidebar)
				.promise()
				.done(() => {
					setNavigation();
				});
		})
		.fail(error => {
			console.log("error :", error);
		});
}

function renderUserMenu() {
	var menus = localStorage.getItem("menus");
	if (path.substr(-+"admin/auth".length) === "admin/auth") {
		localStorage.clear();
	} else {
		if (menus === "" || menus === "undefined" || menus === null) {
			getUserMenu();
		} else {
			$("ul.sidebar-menu").html(JSON.parse(menus));
			setNavigation();
		}
	}
}
