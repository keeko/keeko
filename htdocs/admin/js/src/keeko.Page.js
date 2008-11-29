$class("Page", {
	$constructor : function(obj) {
		this._title = "";
		this._id = "";
		this._keywords = "";
		this._description = "";
		this._pages = [];

		this._parent = null;
		this._changeListener = [];
		this._clone = {
			_title : "",
			_keywords : "",
			_description : ""
		};

		if (typeof(obj) == "object") {
			if (obj.hasOwnProperty("title")) {
				this._title = obj.title;
				this._clone._title = obj.title;
			}

			if (obj.hasOwnProperty("description")) {
				this._description = obj.description;
				this._clone._description = obj.description;
			}

			if (obj.hasOwnProperty("keywords")) {
				this._keywords = obj.keywords;
				this._clone._keywords = obj.keywords;
			}
		}

		// flags
		this._isLoaded = false;
		this._isNew = false;
	},
	
	addChangeListener : function(listener) {
		if (!$class.instanceOf(listener, ObjectChangeListener)) {
			throw new TypeError("listener not type of ObjectChangeListener");
		}

		if (!this._changeListener.contains(listener)) {
			this._changeListener.push(listener);
		}
	},
	
	addPage : function(page) {
		if (!this._pages.contains(page)) {
			this._pages.push(page);
			page.setParent(this);
		}
	},

	getTitle : function() {
		return this._title;
	},
	
	getUnmodifiedTitle : function() {
		return this._clone._title;
	},
	
	getKeywords : function() {
		return this._keywords;
	},
	
	getId : function() {
		return this._id;
	},
	
	getDescription : function() {
		return this._description;
	},
	
	getPages : function() {
		return this._pages;
	},
	
	getParent : function() {
		return this._parent;
	},
	
	hasPages : function() {
		return this._pages.length;
	},
	
	isLoaded : function() {
		return this._isLoaded;
	},
	
	isModified : function() {
		return this._title != this._clone._title
			|| this._description != this._clone._description
			|| this._keywords != this._clone._keywords;
	},
	
	isNew : function() {
		return this._isNew;
	},
	
	_notifyChangeListener : function() {
		this._changeListener.forEach(function(item, index, arr) {
			item.objectChanged(this);
		}, this);
	},
	
	removeChangeListener : function(listener) {
		if (!$class.instanceOf(listener, ObjectChangeListener)) {
			throw new TypeError("listener not type of ObjectChangeListener");
		}

		if (this._changeListener.contains(listener)) {
			this._changeListener.remove(listener);
		}
	},
	
	save : function() {
		this._clone._title = ""+this._title;
		this._clone._keywords = ""+this._keywords;
		this._clone._description = ""+this._description;
	},
	
	setLoaded : function(loaded) {
		this._isLoaded = loaded;
	},
	
	setNew : function(isNew) {
		this._isNew = isNew;
	},
	
	setTitle : function(title) {
		this._title = title;
		this._notifyChangeListener();
	},
	
	setKeywords : function(keywords) {
		this._keywords = keywords;
		this._notifyChangeListener();
	},
	
	setId : function(id) {
		this._id = id;
	},
	
	setDescription : function(desc) {
		this._description = desc;
		this._notifyChangeListener();
	},
	
	setParent : function(page) {
		this._parent = page;
	}
});