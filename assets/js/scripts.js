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
		});