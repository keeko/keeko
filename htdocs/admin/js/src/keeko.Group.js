$class("Group", {
	$constructor : function(obj) {
		this._id;
		this._name;
		this._active;
		this._isUser = false;
		this._isDefault = false;
		this._isGuest = false;
		this._isSystem = false;
		this._userId;

		if (obj.hasOwnProperty("id")) {
			this._id = obj.id;
		}

		if (obj.hasOwnProperty("name")) {
			this._name = obj.name;
		}

		if (obj.hasOwnProperty("isActive")) {
			this._active = obj.isActive == 1;
		}

		if (obj.hasOwnProperty("isGuest")) {
			this._isGuest = obj.isGuest == 1;
		}

		if (obj.hasOwnProperty("isSystem")) {
			this._isSystem = obj.isSystem == 1;
		}

		if (obj.hasOwnProperty("userId")) {
			this._userId = obj.userId;
			this._isUser = obj.userId != "";
		}

		if (obj.hasOwnProperty("isDefault")) {
			this._isDefault = obj.isDefault == 1;
		}
	},

	getId : function() {
		return this._id;
	},

	getName : function() {
		return this._name;
	},

	getUserId : function() {
		return this._userId;
	},

	isActive : function() {
		return this._active;
	},
	
	isGuest : function() {
		return this._isGuest;
	},
	
	isDefault : function() {
		return this._isDefault;
	},

	isUser : function() {
		return this._isUser;
	},
	
	isSystem : function() {
		return this._isSystem;
	},

	isDefault : function() {
		return this._isDefault;
	},
	
	setActive : function(active) {
		this._active = active;
	},
	
	setName : function(name) {
		this._name = name;
	}
});
