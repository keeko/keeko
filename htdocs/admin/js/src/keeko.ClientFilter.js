$class("ClientFilter", {
	$extends : keeko.Filter,
	
	$constructor : function(obj) {
		this.$base(obj);

		// params
		this._views = [];
		this._filter = new gara.jsface.PatternFilter();

		if (obj.hasOwnProperty("views")) {
			this.setViews(obj.views);
		}
	},
	
	addView : function(view) {
		if (!$class.instanceOf(view, gara.jsface.Viewer)) {
			throw new TypeError("view not instance of gara.jsface.Viewer");
		}

		if (!this._views.contains(view)) {
			this._views.push(view);
			view.addFilter(this._filter);
		}
	},

	handleEvent : function(e) {
		if (e.type == "keyup" && e.target == this._element) {
			this._pattern = this._element.value;

			if (this._pattern != "") {
				this._clearer.className = "active";
			} else {
				this._clearer.className = "inactive";
			}

			this._filter.setPattern(this._pattern);
			this._views.forEach(function(view, index, arr){
				view.refresh();
			}, this);
		}

		if (e.type == "click" && e.target == this._clearer && this._pattern != "") {
			this._element.value = "";
			this._clearer.className = "inactive";
			this._filter.setPattern("");
			this._views.forEach(function(view, index, arr){
				view.refresh();
			}, this);
		}
	},

	removeView : function(view) {
		if (!$class.instanceOf(view, gara.jsface.Viewer)) {
			throw new TypeError("view not instance of gara.jsface.Viewer");
		}
		
		if (this._views.contains(view)) {
			this._views.remove(view);
		}
	},

	setViews : function(views) {
		if ($class.instanceOf(views, Array)) {
			views.forEach(function(view, index, arr){
				this.addView(view);
			}, this);
		}
	},

	toString : function() {
		return "[keeko.ClientFilter]";
	}
});
