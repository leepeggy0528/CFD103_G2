$(document).ready(function(){
    $('#myselection').on('change', function(){
    	var optValue = $(this).val(); 
        $(".self-info").hide();
        $("#self-info"+optValue).show();
    });
});