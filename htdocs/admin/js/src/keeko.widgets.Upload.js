$class("Upload", {
	domref : null,

	$constructor : function(data) {
		this.data = data;
		this.parent = null;
		this.swfupload = null;
		
		this.add = null;
		this.start = null;
		this.cancel = null;
		this.container = null;

		this.items = {};
		this.files = [];
		this.itemCount = 0;
		this.inProgress = false;
		this.cancelUpload = false;

		this.totalSize = 0;
		this.totalCompleted = 0;

		this.build();
	},

	addItem : function(file) {
		this.items[file.id] = new keeko.widgets.UploadItem(file, this.container, this);
		this.files.push(file);
	},

	build : function() {
		this.domref = document.createElement("div");
		this.domref.widget = this;
		this.domref.className = "keekoUpload";
		
		if (this.data.hasOwnProperty("width") && this.data.width != null) {
			this.domref.style.width = this.data.width + "px";
		}
		
		if (this.data.hasOwnProperty("height") && this.data.height != null) {
			this.domref.style.height = this.data.height + "px";
		}
		
		this.toolbar = document.createElement("div");
		this.toolbar.className = "toolbar";
		this.toolbar.widget = this;
		this.domref.appendChild(this.toolbar);

		if (this.data.hasOwnProperty("addButton") && this.data.addButton != null) {
			this.add = this.data.addButton;
		} else {
			this.add = document.createElement("span");
			this.add.appendChild(document.createTextNode(keeko.i18n.get("global.upload.add")));
			this.add.className = "addButton";
			this.toolbar.appendChild(this.add);
		}
		
		if (this.data.hasOwnProperty("cancelButton") && this.data.cancelButton != null) {
			this.cancel = this.data.cancelButton;
		} else {
			this.cancel = document.createElement("span");
			this.cancel.appendChild(document.createTextNode(keeko.i18n.get("global.upload.cancel")));
			this.cancel.className = "cancelButton";
			this.toolbar.appendChild(this.cancel);
		}
		
		if (this.data.hasOwnProperty("startButton") && this.data.startButton != null) {
			this.start = this.data.startButton;
		} else {
			this.start = document.createElement("span");
			this.start.appendChild(document.createTextNode(keeko.i18n.get("global.upload.start")));
			this.start.className = "startButton";
			this.toolbar.appendChild(this.start);
		}

		this.add.widget = this;
		this.start.widget = this;
		this.cancel.widget = this;

		base2.DOM.EventTarget(this.add);
		base2.DOM.EventTarget(this.start);
		base2.DOM.EventTarget(this.cancel);

		gara.EventManager.addListener(this.add, "click", this);
		gara.EventManager.addListener(this.cancel, "click", this);
		gara.EventManager.addListener(this.start, "click", this);

		this.container = document.createElement("div");
		this.container.widget = this;
		this.container.className = "container";
		this.domref.appendChild(this.container);

		this.progressText = document.createElement("span");
		this.progressText.className = "totalProgressText";
		this.progressText.widget = this;
		
		this.progressContainer = document.createElement("div");
		this.progressContainer.className = "totalProgressContainer";
		this.progressContainer.widget = this;
		this.progressContainer.appendChild(this.progressText);
		this.domref.appendChild(this.progressContainer);

		this.progressBarContainer = document.createElement("div");
		this.progressBarContainer.className = "totalProgressBarContainer";
		this.progressBarContainer.widget = this;
		this.progressContainer.appendChild(this.progressBarContainer);

		this.progressBar = document.createElement("div");
		this.progressBar.className = "totalProgressBar";
		this.progressBar.widget = this;
		this.progressBarContainer.appendChild(this.progressBar);

		if (this.data.hasOwnProperty("parentNode") && this.data.parentNode != null) {
			this.parent = this.data.parentNode;
			this.parent.appendChild(this.domref);

			var borderTop = keeko.Utils.getStyle(this.container, "border-top-width", "borderTopWidth");
			var borderBot = keeko.Utils.getStyle(this.container, "border-bottom-width", "borderBottomWidth");
			var borderTopPrg = keeko.Utils.getStyle(this.progressContainer, "border-top-width", "borderTopWidth");
			var borderBotPrg = keeko.Utils.getStyle(this.progressContainer, "border-bottom-width", "borderBottomWidth");
			
			this.container.style.height = (this.data.height - this.toolbar.clientHeight - this.progressContainer.clientHeight - parseInt(borderTopPrg) - parseInt(borderBotPrg) - parseInt(borderTop) - parseInt(borderBot)) + "px";
		}

		var up = this;

		this.data.file_queued_handler = function(file){
			up.addItem(file)
		};
		
		this.data.file_queue_error_handler = function(file, errorCode, message) {
			var text;
			switch (errorCode) {
				case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
					text = keeko.i18n.get("global.upload.error.size");
					break;

				case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
					text = keeko.i18n.get("global.upload.error.zerobyte");
					break;

				case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
					text = keeko.i18n.get("global.upload.error.invalid");
					break;

				case SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED:
					text = keeko.i18n.get("global.upload.error.queue");
					break;
			}
			var s = gara.jswt.JSWT;
			var msg = new gara.jswt.MessageBox(s.OK | s.ICON_ERROR);
			msg.setMessage(file.name + " - " + text);
			msg.open();
		};

		this.data.upload_start_handler = function(file) {
			up.inProgress = true;
			up.items[file.id].update(file);
		};

		this.data.upload_complete_handler = function() {
			up.inProgress = false;
			if (!up.cancelUpload) {
				up.swfupload.startUpload();
			}
			up.cancelUpload = false;
		}

		this.data.upload_progress_handler = function(file, completedBytes, totalBytes) {
			if (up.items.hasOwnProperty(file.id)) {
				up.items[file.id].update(file, completedBytes, totalBytes);
				var completed = up.totalCompleted + completedBytes;
				var totalPx = Math.ceil(completed / up.totalSize * 100);
				up.progressBar.style.width = totalPx + "%";
				up.progressText.innerHTML = totalPx + "%";
			}
		}

		this.data.upload_success_handler = function(file, data) {
			up.totalCompleted += file.size;
			if (up.items.hasOwnProperty(file.id)) {
				up.items[file.id].update(file);
			}
			//console.log("Upload Succeed: " + data);
			if (up.data.response_handler && typeof(up.data.response_handler) == "function") {
				up.data.response_handler(data);
			}
		};

		this.data.upload_error_handler = function(file, errorCode, msg) {
			//console.log("Upload Error["+errorCode+"] " + msg);
			up.totalCompleted += file.size;
			if (up.items.hasOwnProperty(file.id)) {
				up.items[file.id].update(file);
			}
		}

		// cookie stuff
		trim = function(str) {
			return str.replace(/^\s+|\s+$/g,"");
		}
	
		var postParams = {'isSWFUpload' : '1'};
		var parts;
		var cookies = document.cookie.split(";");
		cookies.forEach(function(cookie, index, arr) {
			parts = cookie.split("=");
			postParams[trim(parts[0])] = trim(parts[1]);
		}, this);
		
		this.data.post_params = postParams;

		this.swfupload = new SWFUpload(this.data);
	},

	handleEvent : function(e) {
		switch (e.type) {
			case "click":
				if (e.target == this.add) {
					this.swfupload.selectFiles();
				}

				if (e.target == this.start) {
					this.totalSize = 0;
					this.totalCompleted = 0;
					this.files.forEach(function(file, index, arr) {
						if (file.filestatus != SWFUpload.FILE_STATUS.COMPLETE) {
							this.totalSize += file.size;
						}
					}, this);
					
					this.progressText.innerHTML = "";
					this.progressBar.style.width = 0;

					this.swfupload.startUpload();
				}

				if (e.target == this.cancel) {
					
					this.cancelUpload = true;
					this.swfupload.stopUpload();
				}
				break;
		}
	},

	removeItem : function(file) {
		this.swfupload.cancelUpload(file.id);

		this.items[file.id].dispose();
		delete this.items[file.id];
		this.files.remove(file);
	}
});

$class("UploadItem", {
	domref : null,
	$constructor : function(file, parent, upload) {
		this.file = file;
		this.parentNode = parent;
		this.upload = upload;

		this.build();
	},

	build : function() {
		this.domref = document.createElement("div");
		this.domref.className = "uploadItem";
		this.domref.widget = this;
		
		this.remove = document.createElement("span");
		this.remove.className = "remove";
		this.remove.widget = this;
		base2.DOM.EventTarget(this.remove);
		
		this.sizeText = document.createTextNode(keeko.Utils.formatSize(this.file.size));
		this.size = document.createElement("span");
		this.size.className = "size";
		this.size.widget = this;
		this.size.appendChild(this.sizeText);
		
		this.name = document.createElement("span");
		this.name.className = "itemName";
		this.name.widget = this;
		this.name.appendChild(document.createTextNode(this.file.name));

		this.statusText = document.createTextNode(this.getStatus(this.file.filestatus));
		this.status = document.createElement("span");
		this.status.className = "status";
		this.status.widget = this;
		this.status.appendChild(this.statusText);
		
		this.progressContainer = document.createElement("div");
		this.progressContainer.className = "progressBarContainer";
		this.progressContainer.widget = this;
		
		this.progress = document.createElement("div");
		this.progress.className = "progressBar";
		this.progress.widget = this;
		this.progress.style.width = 0;
		this.progressContainer.appendChild(this.progress);

		this.domref.appendChild(this.name);
		this.domref.appendChild(this.status);
		this.domref.appendChild(this.remove);
		this.domref.appendChild(this.size);
		this.domref.appendChild(this.progressContainer);
		
		this.parentNode.appendChild(this.domref);
		
		gara.EventManager.addListener(this.remove, "click", this);
	},

	dispose : function() {
		this.domref.removeChild(this.name);
		this.domref.removeChild(this.remove);
		this.domref.removeChild(this.size);
		this.domref.removeChild(this.status);
		this.parentNode.removeChild(this.domref);

		this.file = null;
		this.parentNode = null;
		this.upload = null;

		delete this.domref;
		delete this.name;
		delete this.size;
		delete this.remove;
		delete this.status;
	},

	getStatus : function(status) {
		if (status == SWFUpload.FILE_STATUS.QUEUED) {
			return keeko.i18n.get("global.upload.status.queued");
		}

		if (status == SWFUpload.FILE_STATUS.IN_PROGRESS) {
			return keeko.i18n.get("global.upload.status.progress");
		}

		if (status == SWFUpload.FILE_STATUS.ERROR) {
			return keeko.i18n.get("global.upload.status.error");
		}

		if (status == SWFUpload.FILE_STATUS.COMPLETE) {
			return keeko.i18n.get("global.upload.status.complete");
		}

		if (status == SWFUpload.FILE_STATUS.CANCELLED) {
			return keeko.i18n.get("global.upload.status.cancelled");
		}
	},
	
	handleEvent : function(e) {
		if (e.type == "click" && e.target == this.remove) {
			this.upload.removeItem(this.file);
		}
	},

	update : function(file, completedBytes, totalBytes) {
		this.statusText.nodeValue = this.getStatus(file.filestatus);
		
		if (typeof(completedBytes) != "undefined") {
			this.sizeText.nodeValue = keeko.Utils.formatSize(completedBytes) + " / " + keeko.Utils.formatSize(totalBytes);
			var pc = Math.ceil(completedBytes/totalBytes*100);
			this.progress.style.width = pc + "%";
		} else if (file.filestatus != SWFUpload.FILE_STATUS.COMPLETE) {
			this.progress.style.width = 0;
			this.sizeText.nodeValue = keeko.Utils.formatSize(this.file.size);
		}
	}
});