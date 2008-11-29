$class("GroupManager", {
	$constructor : function() {},

	createGroup : $static(function(callback, context) {
		var diag = new gara.jswt.InputDialog();
		diag.setText(keeko.i18n.get("global.groups.create.title"));
		diag.setMessage(keeko.i18n.get("global.groups.create.name") + ":");
		diag.open(function(name) {
			if (name != null) {
				var url = "admin.php?module=Groups&action=create&format=json&name=" + name;
				xhr = new XHR();
				xhr.open("GET", url, true);
				xhr.onreadystatechange = function(){
					if (xhr.readyState == 4) {
						var data = eval(xhr.responseText)[0];
						if (data.error) {
							var e = new gara.jswt.MessageBox(gara.jswt.JSWT.ICON_WARNING | gara.jswt.JSWT.OK);
							e.setText(keeko.i18n.get("global.error"));
							switch (data.code) {
								case 1:
									e.setMessage(keeko.i18n.get("global.errors.unknown"));
									break;
									
								case 2:
									e.setMessage(keeko.i18n.get("global.groups.errors.exist"));
									break;
							}
							e.open();
						} else {
							var group = new keeko.Group(data);
							if (typeof(callback) != "undefined") {
								if (typeof(context) == "undefined") {
									context = window;
								}
								callback.call(context, group);
							}
						}
					}
				}
				xhr.send(null);
			}
		});
	}),
	
	deleteGroup : $static(function(group, callback, context) {
		var url = "admin.php?module=Groups&action=delete&format=json&id=" + group.getId();
		xhr = new XHR();
		xhr.open("GET", url, true);
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4) {
				var data = eval(xhr.responseText);
				if (data) {
					data = data[0];
					var e = new gara.jswt.MessageBox(gara.jswt.JSWT.ICON_WARNING | gara.jswt.JSWT.OK);
					e.setText(keeko.i18n.get("global.error"));
					switch (data.code) {
						case 1:
							e.setMessage(keeko.i18n.get("global.errors.unknown"));
							break;
					}
					e.open();
				} else {
					if (typeof(callback) != "undefined") {
						if (typeof(context) == "undefined") {
							context = window;
						}
						callback.call(context, group);
					}
				}
			}
		}
		xhr.send(null);
	})
});
