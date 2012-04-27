$(function() {

		$('.yellowswitch').html('<a id="missyellow" href="#" title="Miss the yellow?">Miss the yellow?</a>');
		
		$("#missyellow").on("click", function(event) {
			event.preventDefault();
			$('div.anystretch').fadeOut('fast', function() {
        $(this).remove();
      });
			$(this).css("color", "#000");
		});
});
