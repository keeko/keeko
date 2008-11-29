$class("ServerFilter", {
	$constructor : function(obj) {
		// config
		this._delay = 1000; 
		
		// params
		this._element;
		this._target;
		this._pattern;
		this._callback = null;
		this._context = null;
		this._previousTimer = null;
		this._clearer;

		if (obj.hasOwnProperty("elem")) {
			this._element = obj.elem;
			base2.DOM.EventTarget(this._element);
			gara.EventManager.addListener(this._element, "keyup", this);
		}

		if (obj.hasOwnProperty("target")) {
			this._target = obj.target;
		}

		if (obj.hasOwnProperty("callback")) {
			this._callback = obj.callback;
		}

		if (obj.hasOwnProperty("context")) {
			this._context = obj.context;
		}
		
		if (obj.hasOwnProperty("clear")) {
			this._clearer = obj.clear;
			base2.DOM.EventTarget(this._clearer);
			gara.EventManager.addListener(this._clearer, "click", this);
		}
	},

	fireRequest : function(clear) {
		var filter = this;
		
		if (typeof(clear) == "undefined") {
			var sep = this._target.indexOf('?') == -1 ? '?' : '&';
			var url = this._target + sep + "pattern=" + this._pattern;
		} else {
			var url = this._target;
		}
		xhr = new XHR();
		xhr.open("GET", url, true);
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4) {
				filter.handleResponse(xhr);
			}
		}
		xhr.send(null);
		if (this._previousTimer != null) {
			window.clearTimeout(this._previousTimer);
			this._previousTimer = null;
		}
	},
	
	handleEvent : function(e) {
		if (e.type == "keyup" && e.target == this._element) {
			this._pattern = this._element.value;
			
			if (this._previousTimer != null) {
				window.clearTimeout(this._previousTimer);
			}
			
			if (this._pattern != "") {
				this._clearer.className = "active";
			} else {
				this._clearer.className = "inactive";
			}
			
			var filter = this;
			this._previousTimer = window.setTimeout(function() {
				filter.fireRequest();
			}, this._delay);
		}
		
		if (e.type == "click" && e.target == this._clearer && this._pattern != "") {
			this._element.value = "";
			this._clearer.className = "inactive";
			this.fireRequest(true);
		}
	},

	handleResponse : function(xhr) {
		if (typeof(this._callback) != null) {
			if (typeof(this._context) == null) {
				this._context = window;
			}
			this._callback.call(this._context, xhr);
		}
	}
});
