jQuery(document).ready(function($)
{
	var lboolContinue = true;
	var lboolClick = false;

	var scripts = document.getElementsByTagName("script"),
	src = scripts[scripts.length-2].src;

	var lobjSplit = src.split('/');
	lobjSplit.pop();

	var lstrPathToGif = lobjSplit.join('/');
	lstrPathToGif += '/loading.gif';

	$('.slides').slides({
		preload: true,
		preloadImage: lstrPathToGif,
		play: 4000,
		pause: 1,
		hoverPause: true,
		generatePagination: false,
		slideSpeed: 1000,
		animationComplete: function(current)
		{
			if(current == 1 && lboolContinue)
			{
				lboolContinue = false;
				clearInterval($('#slides').data('interval'));
				$('div.slides_control').unbind();
				this.play = 0;
			}

			if(lboolClick)
			{
				lboolContinue = false;
				clearInterval($('#slides').data('interval'));
				$('div.slides_control').unbind();
				this.play = 0;
			}
		}
	});

	$('.pagination a').click(function(){
		lboolClick = true;
	});
});