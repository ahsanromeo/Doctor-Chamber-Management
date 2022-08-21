// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
	$('#selectTest').on('change',function(){
		$('[name=test_type]').val($(this).val());
	});

	$('.time-frame button').click(function(){
		$('.time-frame button').removeClass('active');
		$(this).addClass('active');
		$(this).siblings('[name=time]').val($(this).text());
		return false;
	});

	var cost = 0;
	$('[type=checkbox]').change(function(){
		var isCheck = $(this).is(':checked');
		if(isCheck)
			cost += parseInt($(this).attr('data-cost'));
		else
			cost -= parseInt($(this).attr('data-cost'));
			
		$('[name=amount]').val(cost +" tk" );
		$('.cost-btn .btn').show();
		$('.hide1').hide();
	});

	$('.cost-btn .btn').click(function(){
		var status = $(this).attr('data-pay');
		$('.cost-btn .btn').hide(200);
		$('p.note').text(status).show(100);
		$('button.hide1').show();
		$('[name=status]').val(status);
		return false;
	});

	$('#dp1').datepicker({
		format: 'dd-mm-yyyy',
        todayBtn: 'linked',
        setStartDate: '10-10-2016'
	});
});


