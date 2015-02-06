jQuery(document).ready(function($)
{
	var loc = window.location.pathname;
	var lobjSplit = loc.split('/');
	var dir = lobjSplit[1] == '' ? 'home' : lobjSplit[1];

	//get first and last subdirectory
	if( lobjSplit[ (lobjSplit.length - 1) ] != '' )
		dir += '_' + lobjSplit[ (lobjSplit.length - 1) ];
	else if( lobjSplit[ (lobjSplit.length - 2) ] != '' && lobjSplit[ (lobjSplit.length - 2) ] != dir )
		dir += '_' + lobjSplit[ (lobjSplit.length - 2) ];

	var lstrPrevSelect = null;


	$('*[class*="track_me_"]').on("click", function( e ){

		//array for accepted file types
		lobjFileTypes = new Array( "pdf", "doc", ".docx", "ppt", "pptx", "xls", "xlsx", "txt", "pps", "ppsx", "odt", "rtf" );

		switch( e.target.nodeName.toLowerCase() )
		{
			case 'option':
				var lstrLabel = $( e.target ).val();
				break;
			case 'a':
				var lstrLabel = e.target.href;
				break;
			case 'select':
				if( lstrPrevSelect == null )
				{
					lstrPrevSelect = $( e.target ).val();
					return;
				}

				var lstrLabel = $( e.target ).val();
				if( lstrLabel == lstrPrevSelect || lstrLabel == "")
					return;

				break;
			case 'img':
				if( e.target.parentNode.nodeName.toLowerCase() == 'a' )
					var lstrLabel = e.target.parentNode.href;
				else
					return;
				break;
			case 'span':
				if( e.target.parentNode.nodeName.toLowerCase() == 'a' )
					var lstrLabel = e.target.parentNode.href;
				else
					return;
				break;
			default:
				return;
		}

		var lobjClasses = e.delegateTarget.className.split(' ');

		var lstrCategory = "Link_" + dir;
		var lstrAction = "Click";

		for( lintKey in lobjClasses )
		{
			if( lobjClasses[ lintKey ].indexOf( "track_me_" ) != -1 )
			{
				lobjClasses[ lintKey ] = lobjClasses[ lintKey ].replace( 'track_me_', '' );
				var lobjSplit = lobjClasses[ lintKey ].split( "_" );

				lstrCategory = typeof lobjSplit[0] != 'undefined' ? lobjSplit[0] : lstrCategory;
				lstrAction = typeof lobjSplit[1] != 'undefined' ? lobjSplit[1] : lstrAction;

				//add directory to category
				lstrCategory = lstrCategory + "_" + dir;

				break;
			}
		}

		//if navigation category, only track if home directory
		if( lstrCategory.toLowerCase().indexOf( 'navigation' ) == 0 && dir != 'home' )
		{
			return;
		}

		//if destination of url is a file, change action to download and prepends download to category
		if( lstrLabel.substr( lstrLabel.length - 4 ).indexOf( '.' ) == 0 && lobjFileTypes.indexOf( lstrLabel.substr( lstrLabel.length - 3 ) ) != -1 )
		{
			lstrAction = "Download_" + lstrLabel.substr( lstrLabel.length - 3 );
			lstrCategory = "Download_" + lstrCategory;
		}

		var pageTracker = _gat._getTracker( _gat._getTrackerByName()._getAccount() );
		var lboolTracked = pageTracker._trackEvent( lstrCategory, lstrAction, lstrLabel, 1 );

		//if not download, no not delay
		if( lstrAction.toLowerCase().indexOf( 'download' ) != 0 )
		{
			return;
		}

		setTimeout(function()
		{
			window.location.href = lstrLabel;
		}, 800);

		//prevent any redirection
		window.stop;
		return false;

	});
});