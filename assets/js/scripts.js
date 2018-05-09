$(document).ready(function () {
	$("#toggle").click(function () {
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$("#agschecklist").animate({
				right: '0%'
			});
		} else {
			$(this).addClass('active');
			$("#agschecklist").animate({
				right: - ($("#agschecklist").width() - 0)
			});
		}
	});			
	$j('.ags-tooltip').hover(
		function(){ $j(this).find('.ags-tooltiptext').addClass('ags-tooltiptext-show') },
		function(){ $j(this).find('.ags-tooltiptext').removeClass('ags-tooltiptext-show') }
	)
	function myAjax(){
		$.ajax({
			type: "POST",
			url: '__FILE__/includes/adminmenu.php',
		})
	}
});