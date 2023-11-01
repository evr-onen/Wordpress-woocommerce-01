jQuery(document).ready(function ($) {
	const ajaxURL = $("body").attr("data-ajax-url");
	$(".comment-form-rating .stars > span a").each(function (ind) {
		$(this).html(`&#9733;`);
	});

	$(".comment-form-rating .stars > span a").hover(
		function (e) {
			$(this).addClass("hoverItem");
			changeColor(e.target.className);
		},
		function () {
			$(this).removeClass("hoverItem");
			resetColor();
		}
	);
	console.log(siteData);
	const changeColor = (className) => {
		const elements = $(".comment-form-rating .stars > span a");
		let finish = false;
		$(elements).each((_, e) => {
			!finish && $(e).addClass("yellowColor");

			if ($(e).hasClass(className)) {
				finish = true;
			}
		});
	};
	const resetColor = () => {
		const elements = $(".comment-form-rating .stars > span a");

		$(elements).each((_, e) => {
			$(e).removeClass("yellowColor");
		});
	};
});

var swiper = new Swiper(".swiperSingleProductThumbnail", {
	spaceBetween: 10,
	slidesPerView: 4,
	freeMode: true,
	watchSlidesProgress: true,
});
var swiper2 = new Swiper(".swiperSingleProductSlider", {
	spaceBetween: 10,
	zoom: true,
	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev",
	},
	thumbs: {
		swiper: swiper,
	},
});
