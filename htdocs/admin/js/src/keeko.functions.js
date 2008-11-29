keeko.deleteEntity = function(name, callback, context) {
	
	var confirm1 = new gara.jswt.MessageBox(gara.jswt.JSWT.ICON_QUESTION | gara.jswt.JSWT.OK | gara.jswt.JSWT.CANCEL);
	confirm1.setText(keeko.i18n.get("global.confirm"));
	confirm1.setMessage(keeko.i18n.get("global.dialog.delete.question1") + ": " + name);
	confirm1.open(function(response) {
		if (response == gara.jswt.JSWT.OK) {

			var confirm2 = new gara.jswt.MessageBox(gara.jswt.JSWT.ICON_QUESTION | gara.jswt.JSWT.OK | gara.jswt.JSWT.CANCEL);
			confirm2.setText(keeko.i18n.get("global.confirm"));
			confirm2.setMessage(keeko.i18n.get("global.dialog.delete.question2") + ": " + name);
			confirm2.open(function(response) {
				if (response == gara.jswt.JSWT.OK) {
					if (typeof(context) == "undefined") {
						context = window;
					}
					callback.call(context);
				}
			}, this);
			
		}
	}, this);
}