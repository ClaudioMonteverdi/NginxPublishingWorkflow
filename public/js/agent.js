$(document).ready( function(){
	parseAgent();
	function parseAgent(){
		var user = '';
		var agentInfo = new UAParser().getResult();
		_.each(agentInfo, function(obj, name, list){
			if( typeof obj === 'object' ){
				_.each(obj, function(meta, key){
					user += name + '_' +  key + ": " + meta + "\n";  
				});
			}else{
				user += name + ": " + obj + "\n";  
			}
		});

		var height = $(window).height();
		var width = $(window).width();
		var resolution_width = screen.width;
		var resolution_height = screen.height;
		user += "height: " + height + "\n";
		user += "width: " + width + "\n";
		user += "resolution_width: " + resolution_width + "\n";
		user += "resolution_height: " + resolution_height + "\n";
		$('.issue-create').append('<input type="hidden" name="browser" value="' + user + '">'); 
	}
});
