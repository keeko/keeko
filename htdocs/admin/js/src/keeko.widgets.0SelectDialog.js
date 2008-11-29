$class("SelectDialog", {
	$extends : gara.jswt.Dialog, 

	/**
	 * @constructor
	 */
	$constructor : function(style) {
		this.$base(style);
		
		this._callback = null;
		this._context = window;
		this._style |= gara.jswt.JSWT.APPLICATION_MODAL;
		
		this._buttonBar;
		this._btnOk;
		this._btnCancel;
		this._selectContent;
		
		this._selection = null;
	},

	_create : function() {
		this.$base();
		
		this.domref.className += " keekoSelectDialog";
		this._selectContent = document.createElement("div");
		this._selectContent.widget = this;
		this._selectContent.className = "keekoSelectContent";
		
		this._dialogContent.appendChild(this._selectContent);

		this._buttonBar = document.createElement("div");
		this._buttonBar.id = "diagButtonBar";

		this._btnCancel = document.createElement("input");
		this._btnCancel.type = "button";
		this._btnCancel.value = gara.i18n.get("cancel");
		this._btnCancel.id = "btnCancel";
		base2.DOM.EventTarget(this._btnCancel);
		gara.EventManager.addListener(this._btnCancel, "click", this);
		
		this._btnOk = document.createElement("input");
		this._btnOk.type = "button";
		this._btnOk.value = gara.i18n.get("ok");
		this._btnOk.id = "btnOk";
		base2.DOM.EventTarget(this._btnOk);
		gara.EventManager.addListener(this._btnOk, "click", this);

		this._buttonBar.appendChild(this._btnCancel);
		this._buttonBar.appendChild(this._btnOk);
		this._dialogContent.appendChild(this._buttonBar);
	},
	
	handleEvent : function(e) {
		this.$base(e);
		if (this._disposed && this._callback != null) {
			this._callback.call(this._context, null);
		}
		switch(e.type) {
			case "click":
				var response;
				switch(e.target) {
					case this._btnOk:
						response = this._selection;
						break;

					default:
					case this._btnCancel:
						response = null;
						break;
				}
				this.dispose();
				if (this._callback != null) {
					this._callback.call(this._context, response);
				}
				break;
		}
	},
	
	toString : function() {
		return "[keeko.widgets.SelectDialog]";
	}
});
