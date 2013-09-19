jQuery(document).ready(function($) {
	var nowIdx = 1;
	var maxIdx = 7;
	var preS = $('#s1');
	var nextS = $('#s2');
	var refreshId;
	
	function hideAll()
	{
		$('.slider span').hide();
	}
	hideAll();
    $('#s1').fadeIn('fast', function()
	{
		//setTimeout(function(){ playMV(preS, nextS); }, 3000);
		refreshId = setInterval( function()
    	{
        var s1, s2;
			if(nowIdx == maxIdx)
			{
				nowIdx = 1;
				s1 = '#s'+maxIdx;
				s2 = '#s'+nowIdx;
			}else{
				s1 = '#s'+nowIdx;
				s2 = '#s'+(nowIdx+1);
				nowIdx ++;
			}
			preS = $(s1);
			nextS = $(s2);
			playMV(preS, nextS);
			$('#txt').text(nowIdx);
    		}, 5000);
		}
	);
	
	
	
	function playMV(pre, next)
	{
		setTimeout(function(){ pre.fadeOut('fast'); }, 3000);
		setTimeout(function(){ next.fadeIn('fast'); }, 3000);
		
		
	}
	
});
