//keeko.XHR = function() {
$class("XHR", {
	$constructor: function(){
		var xmlhttp = null;
		if (xmlhttp == null) {
			(function(){
				if (typeof XMLHttpRequest != "undefined") {
					xmlhttp = XMLHttpRequest();
				}
				else {
					try {
						xmlhttp = ActiveXObject("Msxml2.XMLHTTP");
					} 
					catch (e) {
						try {
							xmlhttp = ActiveXObject("Microsoft.XMLHTTP");
						} 
						catch (e) {
							xmlhttp = false;
						}
					}
				}
			})();
		}
		return xmlhttp;
	}
});