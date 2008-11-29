$class("Utils", {
	
	formatSize : $static(function(bytes) {
		if (bytes >= 1099511627776) {
			size = Math.round(bytes / 1024 / 1024 / 1024 / 1024, 2);
			suffix = "TB";
		} else if (bytes >= 1073741824) {
			size = Math.round(bytes / 1024 / 1024 / 1024, 2);
			suffix = "GB";
		} else if (bytes >= 1048576) {
			size = Math.round(bytes / 1024 / 1024, 2);
			suffix = "MB";
		} else if (bytes >= 1024) {
			size = Math.round(bytes / 1024, 2);
			suffix = "KB";
		} else {
			size = bytes;
			suffix = "Byte";
		}
	
		return size + " " + suffix;
	}),
	
	getStyle : $static(function(el, styleProp, ieStyleProp) {
		var y,x = el;
		if (x.currentStyle)
			var y = x.currentStyle[ieStyleProp];
		else if (window.getComputedStyle)
			var y = document.defaultView.getComputedStyle(x,null).getPropertyValue(styleProp);
		return y;
	})
});
