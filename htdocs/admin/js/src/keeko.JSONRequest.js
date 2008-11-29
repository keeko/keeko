$class("JSONRequest", {
	$constructor : function(config) {
		// force config base
		if (!config.method) {
			config.method = "GET";
		}
		
		if (config.url.indexOf("format=") == -1) {
			config.url += "&format=json";
		}

		this.config = config;

		var self = this;
		this.xhr = new keeko.XHR();
		this.xhr.open(config.method, config.url, true);
		this.xhr.onreadystatechange = function() {
			self.handleReadyState();
		};
		this.xhr.send(null);
		this.data = null;
	},

	handleReadyState : function() {
		if (this.xhr.readyState == 4) {
			this.data = eval(this.xhr.responseText);
			
			// handle error
			if (this.data.length && this.data[0].error) {
				var msg,e = this.data[0].error;

				if (this.config.errors && this.config.errors[e]) {
					msg = this.config.errors[e];
				} else {
					switch (e) {
						case 0:
							msg = keeko.i18n.get("global.errors.unknown");
							break;

						case 1:
							msg = keeko.i18n.get("global.errors.params");
							break;
					}
				}

				var d = new gara.jswt.MessageBox(gara.jswt.JSWT.OK | gara.jswt.JSWT.ICON_ERROR);
				d.setText(keeko.i18n.get("global.error"));
				d.setMessage(msg);
				d.open();
			}

			// run onComplete
			else {
				if (this.config.onComplete) {
					var context = this.config.context ? this.config.context : window;
					this.config.onComplete.call(context, this);
				}
			}
		}
	},

	getData : function() {
		return this.data;
	}
});
