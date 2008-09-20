$class("I18n", {
	$constructor : function() {
		this._map = {};
	},
	
	get : function(key) {
		if (this._map.hasOwnProperty(key)) {
			return this._map[key];
		}
		
		return null;
	},
	
	set : function(key, value) {
		this._map[key] = value;
	}
});

keeko.i18n = new keeko.I18n();