$class("File", {
	$constructor : function(obj, parent) {
		this._files = [];
		this._data = null;
		
		// props 
		this._fileName = "";
		this._path = "";
		this._size = 0;
		this._ext = "";
		
		this._atime;
		this._mtime;
		
		// flags
		this._isWritable;
		this._isFile;
		this._isDir;
		this._isDot;

		this._parent = parent || null;
		this._parseObj(obj);
		
		this._types = {
			"jpg" : "image",
			"jpeg" : "image",
			"gif" : "image",
			"png" : "image",
			"xls" : "excel",
			"xhtml" : "html",
			"html" : "html",
			"htm" : "html",
			"pdf" : "pdf",
			"ppt" : "powerpoint",
			"pps" : "powerpoint",
			"txt" : "text",
			"rtf" : "text",
			"mov" : "video",
			"flv" : "video",
			"wmv" : "video",
			"avi" : "video",
			"mpeg" : "video",
			"mpg" : "video",
			"doc" : "word",
			"rar" : "archive",
			"7zip" : "archive",
			"zip" : "archive",
			"tar" : "archive"
		};
	},

	addFile : function(file, index) {
		if (typeof(index) != "undefined") {
			this._files.insertAt(index, file);
		} else {
			this._files.push(file);
		}
	},
	
	getData : function() {
		return this._data;
	},

	getATime : function() {
		return this._atime;
	},
	
	getMTime : function() {
		return this._mtime;
	},

	getFilename : function() {
		return this._fileName;
	},

	getPath : function() {
		return this._path;
	},

	getPathname : function() {
		if (this._path != "") {
			return this._path + "/" + this._fileName;
		} else {
			return this._fileName; 
		}
	},
	
	getSize : function() {
		return this._size;
	},
	
	getExt : function() {
		return this._ext;
	},
	
	getType : function() {
		if (this.isDir()) {
			return "folder";
		} else if (this._types.hasOwnProperty(this._ext)) {
			return this._types[this._ext];
		}
		return this._types['unknown'];
	},
	
	getFiles : function() {
		return this._files;
	},
	
	getParent : function() {
		return this._parent;
	},
	
	hasFiles : function() {
		return this._files.length;
	},

	isWritable : function() {
		return this._isWritable;
	},
	
	isFile : function() {
		return this._isFile;
	},
	
	isDir : function() {
		return this._isDir;
	},
	
	isDot : function() {
		return this._isDot;
	},

	_parseObj : function(obj) {
		if (obj.hasOwnProperty("fileName")) {
			this._fileName = obj.fileName;
		}

		if (obj.hasOwnProperty("path")) {
			this._path = obj.path;
		}

		if (obj.hasOwnProperty("size")) {
			this._size = obj.size;
		}
		
		if (obj.hasOwnProperty("ext")) {
			this._ext = obj.ext;
		}

		if (obj.hasOwnProperty("atime")) {
			this._atime = obj.atime;
		}

		if (obj.hasOwnProperty("mtime")) {
			this._mtime = obj.mtime;
		}

		if (obj.hasOwnProperty("writable")) {
			this._isWritable = obj.writable;
		}

		if (obj.hasOwnProperty("isFile")) {
			this._isFile = obj.isFile;
		}

		if (obj.hasOwnProperty("isDir")) {
			this._isDir = obj.isDir;
		}

		if (obj.hasOwnProperty("isDot")) {
			this._isDot = obj.isDot;
		}
		
		if (obj.hasOwnProperty("files")) {
			for (var i = 0, len = obj.files.length; i < len; ++i) {
				var f = new keeko.File(obj.files[i], this);
				this._files.push(f);
			}
		}
	},
	
	setData : function(data) {
		this._data = data;
	}
});