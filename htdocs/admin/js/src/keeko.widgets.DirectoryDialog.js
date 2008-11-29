$class("DirectoryDialog", {
	$extends : keeko.widgets.SelectDialog,
	$implements : [gara.jswt.SelectionListener],

	$constructor : function(style) {
		this.$base(style);
		
		var currentPackage = $package._currentPackage ? $package._currentPackage.getName() : "";
		$package("keeko.widgets._DirectoryDialog");

		$class("TreeController", {
			$implements : [gara.jsface.ILabelProvider, gara.jsface.ITreeContentProvider],
		
			$constructor : function() {
				this._model = null;
				this._folderImg = new Image();
				this._folderImg.src = 'modules/Files/media/images/icons/folder.png';
			},
		
			getImage : function(element) {
				return this._folderImg;
			},
		
			getText : function(element) {
				return element.getFilename();
			},
		
			getChildren : function(parentElement) {
				return parentElement.getFiles();
			},
		
			getParent : function(element) {
				return element.getParent();
			},
		
			hasChildren : function(element) {
				return element.hasFiles();
			},
		
			getElements : function(inputElement) {
				return this._model;
			},
		
			inputChanged : function(viewer, oldInput, newInput) {
				this._model = newInput;
			},
		
			isLabelProperty : function(element, property) {}
		});
		$package(currentPackage);
		
		this._model = null;
	},
	
	_create : function() {
		this.$base();

		this.domref.style.width = 400 + "px";
		this._dialogContent.style.height = 300 + "px";
		this._dialogBarText.style.width = 360 + "px";

		var bTop = keeko.Utils.getStyle(this._buttonBar, "border-top-width", "borderTopWidth");
		var bBot = keeko.Utils.getStyle(this._buttonBar, "border-bottom-width", "borderBottomWidth");

		this._selectContent.className = "keekoSelectContent";
		this._selectContent.style.height = 300 - this._buttonBar.clientHeight - parseInt(bTop) - parseInt(bBot)  + "px"; 

		if (this._model == null) {
			this._selectContent.className += " keekoSelectContentLoading";
			var self = this;
			var json = new keeko.JSONRequest({
				url: "admin.php?module=Files&action=folders",
				onComplete: function(json){
					self._selectContent.className = "keekoSelectContent";
					
					var folders = json.getData();
					var model = [];
					for (var i = 0, len = folders.length; i < len; ++i) {
						model.push(new keeko.File(folders[i]));
					}
					
					self.build(model);
				}
			});
		} else {
			this.build(this._model);
		}

		// position
		var left = this._getViewportWidth() / 2 - this.domref.clientWidth/2;
		var top = this._getViewportHeight() / 2 - this.domref.clientHeight/2;
		
		this.domref.style.left = left + "px";
		this.domref.style.top = top + "px";
	},
	
	build : function(model) {
		var view = new gara.jsface.TreeViewer(this._selectContent, gara.jswt.JSWT.SINGLE);
		var controller = new keeko.widgets._DirectoryDialog.TreeController();
		view.setContentProvider(controller);
		view.setLabelProvider(controller);
		view.setInput(model);
		
		view.getControl().addSelectionListener(this);
	},
	
	widgetSelected : function(widget) {
		if (widget.getSelectionCount()) {
			this._selection = widget.getSelection()[0].getData();
		} else {
			this._selection = null;
		}
	},

	open: function(callback, context) {
		this._create();
		this._callback = callback;
		this._context = context || window;
	},
	
	setFolders : function(folders) {
		this._model = folders;
	},
	
	toString : function() {
		return "[keeko.widgets.DirectoryDialog]";
	}
});
