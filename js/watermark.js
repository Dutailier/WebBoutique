jQuery(function ($) {
	$(document).ready(function () {
		$('input').each(function () {
			if ($(this).attr('watermark')) {
				$(this).blur(function () {
					if ($(this).val().length == 0) {
						$(this).val($(this).attr('watermark') || '');
						$(this).addClass('watermark');
					}
				}).focus(function () {
						if ($(this).val() == $(this).attr('watermark')) {
							$(this).val('').removeClass('watermark');
						}
					}).val($(this).attr('watermark') || '').addClass('watermark');
			}
		});
	});
})
;