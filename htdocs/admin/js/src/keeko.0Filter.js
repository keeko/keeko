$class("Filter", {
	$constructor : function(obj) {
		// params
		this._element;
		this._pattern;
		this._clearer;

		if (obj.hasOwnProperty("elem")) {
			this._element = obj.elem;
			base2.DOM.EventTarget(this._element);
			gara.EventManager.addListener(this._element, "keyup", this);
		}

		if (obj.hasOwnProperty("clear")) {
			this._clearer = obj.clear;
			base2.DOM.EventTarget(this._clearer);
			gara.EventManager.addListener(this._clearer, "click", this);
		}
	},

	getPattern : function() {
		return this._element.value;
	},

	toString : function() {
		return "[keek.Filter]";
	}
});