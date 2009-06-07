base2.JavaScript.bind(window);

if (!Array.prototype.clear) {
	Array.prototype.clear = function() {
		while (this.length > 0) {
			this.pop();
		}
	}
}
/**
 * @function
 * @private
 */
(function() {
$package("gara");
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class Package
 * @author Thomas Gossmann
 * @namespace gara
 */
$class("Package", {
	exports : "",
	namespace : "",
	name : "",
	version : "",

	$constructor : function(_data) {
		this.name = _data.name || "gara";
		this.imports = _data.imports || "";
		this.exports = _data.exports || "";
		
		if (this.name != "gara") {
			gara.namespace += "var " + this.name + "=gara." + this.name;
			this.name = "gara." + this.name;
		}
		
		var exports = this.exports.split(",");
		exports.forEach(function(v, k, arr) {
			this.namespace += "var " + v + "=" + this.name + "." + v + ";";
		}, this);
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class Utils
 * @author Thomas Gossmann
 * @namespace gara
 */
$class("Utils", {
	getStyle : $static(function(element, styleProp) {
		var style = "";
		if (document.defaultView && document.defaultView.getComputedStyle){
			style = document.defaultView.getComputedStyle(element, "").getPropertyValue(styleProp);
		} else if(element.currentStyle){
			styleProp = styleProp.replace(/\-(\w)/g, function (match, p1){
				return p1.toUpperCase();
			});
			style = element.currentStyle[styleProp];
		}
		return style;
	})
});
/*	$Id: EventManager.class.js 139 2008-07-20 21:41:07Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class EventManager
 * @description
 * EventManager is used to store all event listeners throughout the document.
 * This helps to keep all listeners stored in one point and also pretend memory
 * leaks by releasing all listeners at the unload event.
 * 
 * @see http://ajaxcookbook.org/event-handling-memory-leaks/
 * @author Thomas Gossmann
 * @namespace gara
 */
$class("EventManager", {
	/**
	 * @field
	 * Stores THE instance
	 * @private
	 */
	_instance : $static(null),
	_listeners : $static({}),

	$constructor : function() {
		base2.DOM.EventTarget(window);
		window.addEventListener("unload", this, false);
	},

	getInstance : $static(function() {
		if (this._instance == null) {
			this._instance = new gara.EventManager();
		}

		return this._instance;
	}),

	/**
	 * @method
	 * Adds a listener to a specified domNode and store the added event in the
	 * event manager.
	 * 
	 * @param {HTMLElement} domNode the node where the event is added to
	 * @param {DOMString} type the event type
	 * @param {Object|Function} listener the desired action handler
	 * @return {Event} generated event-object for this listener
	 */
	addListener : $static(function(domNode, type, listener) {
		domNode.addEventListener(type, listener, false);

		var d = new Date();
		var hashAppendix = "" + d.getDay() + d.getHours() + d.getMinutes() + d.getSeconds() + d.getMilliseconds();

		if (!domNode._garaHash) {
			domNode._garaHash = domNode.toString() + hashAppendix;
		}

		if (!listener.hasOwnProperty("_garaHash")) {
			listener._garaHash = listener.toString() + hashAppendix;
		}
		
		var hash = "" + domNode._garaHash + type + listener._garaHash;
		var event = {
			domNode : domNode,
			type : type,
			listener : listener
		}
		this._listeners[hash] = event;
		
		return event;
	}),

	/**
	 * @method
	 * handleEvent is used to catch the unload-event of the window and pass
	 * it to _unregisterAllEvents() to free up memory.
	 * 
	 * @private
	 */
	handleEvent : function(e) {
//		if (e.type == "unload") {
			this._unregisterAllEvents();
//		}
	},

	/**
	 * @method
	 * Removes a specified event
	 * 
	 * @param {Event} event object which is returned by addListener()
	 * @see addListener
	 */
	removeListener : $static(function(domNode, type, listener) {
		domNode.removeEventListener(type, listener, false);

		if (domNode._garaHash && listener.hasOwnProperty("_garaHash")) {
			var hash = domNode._garaHash + type + listener._garaHash;

			if (this._listeners[hash]) {
				delete this._listeners[hash];
			}
		}
	}),

	/**
	 * @method
	 * 
	 * Removes all stored listeners on the page unload.
	 * @private
	 */
	_unregisterAllEvents : function() {
		var hash, e;
		for (hash in gara.EventManager._listeners) {
			e = gara.EventManager._listeners[hash];
			gara.EventManager.removeListener(e.domNode, e.type, e.listener);
		}
	},

	toString : function() {
		return "[gara.EventManager]";
	}
});
gara.eventManager = gara.EventManager.getInstance();

/*	$Id: OutOfBoundsException.class.js 63 2007-07-20 15:36:50Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class OutOfBoundsException
 * @description
 * i'm thrown when somethings going out of bounds
 * @author Thomas Gossmann
 * @extends Exception
 * @namespace gara
 */
$class("OutOfBoundsException", {
	$extends : Exception,
	
	$constructor: function(message) {
		this.message = String(message);
		this.name = $class.typeOf(this);
	}
});
/*	$Id: $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class I18n
 * @author Thomas Gossmann
 * @namespace gara
 */
$class("I18n", {
	$constructor : function() {
		this._map = {
			ok: "Ok",
			cancel: "Cancel",
			yes : "Yes",
			no : "No",
			retry : "Retry",
			abort : "Abort",
			ignore : "Ignore"
		};
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

gara.i18n = new gara.I18n();
var garaPkg = new gara.Package({
	exports : "Package,EventManager,OutOfBoundsException",
	name : "gara"
});

gara.namespace = garaPkg.namespace;
gara.toString = function() {
	return "[gara]";
}

$package("");
})();

/**
 * @function
 * @private
 */
(function() {
$package("gara.jswt");
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * JSWT class with design constants
 * 
 * @class JSWT
 * @author Thomas Gossmann
 * @namespace gara.jswt
 */
$class("JSWT", {
	/**
	 * @field
	 * The <tt>MessageBox</tt> style constant for an ABORT button; the only valid combination is ABORT|RETRY|IGNORE (value is 1&lt;&lt;9).
	 */
	ABORT : $static(1 << 9), 

	/**
	 * @field
	 * Style constant for application modal behavior (value is 1&lt;&lt;16).
	 */
	APPLICATION_MODAL : $static(1 << 16),
	
	/**
	 * @field
	 * Style constant for menu bar behavior (value is 1&lt;&lt;1).
	 */
	BAR : $static(1 << 1),

	/**
	 * @field
	 * Style constant for align bottom behavior (value is 1&lt;&lt;10, since align DOWN and align BOTTOM are considered the same).
	 */
	BOTTOM : $static(1 << 10),
	
	/**
	 * @field
	 * The <tt>MessageBox</tt> style constant for a CANCEL button, valid combinations are OK|CANCEL, YES|NO|CANCEL, RETRY|CANCEL (value is 1&lt;&lt;8).
	 */
	CANCEL : $static(1 << 8),
	
	/**
	 * @field
	 * Style constant for cascade behavior (value is 1&lt;&lt;6).
	 * <p><b>Used By:</b><ul>
	 * <li><code>MenuItem</code></li>
	 * </ul></p>
	 */
	CASCADE : $static(1 << 6),
	
	/**
	 * @field
	 * Style constant for check box behavior (value is 1&lt;&lt;5).
	 * <p><b>Used By:</b><ul>
	 * <li><code>MenuItem</code></li>
	 * <li><code>Table</code></li>
	 * <li><code>Tree</code></li>
	 * </ul></p>
	 */
	CHECK : $static(1 << 5),
	
	/**
	 * @field
	 * Style constant for close box trim (value is 1&lt;&lt;6, since we do not distinguish between CLOSE style and MENU style).
	 */
	CLOSE : $static(1 << 6),
	
	/**
	 * @field
	 * Indicates that a default should be used (value is 0).
	 * 
	 * NOTE: In SWT, this value is -1, but that causes problems with bitwise JavaScript operators...
	 */
	DEFAULT : $static(0),
	
	/**
	 * @field
	 * Style constant for align down behavior (value is 1&lt;&lt;10, since align DOWN and align BOTTOM are considered the same).
	 */
	DOWN : $static(1 << 10),
	
	/**
	 * @field
	 * Indicates that a user-interface component is being dragged, for example dragging the thumb of a scroll bar (value is 1).
	 */
	DRAG : $static(1),
	
	/**
	 * @field
	 * Style constant for drop down menu/list behavior (value is 1&lt;&lt;2).
	 */
	DROP_DOWN : $static(1 << 2),
	
	/** 
	 * JSWT error constant indicating that a menu which needed
	 * to have the drop down style had some other style instead
	 * (value is 21).
	 */
	ERROR_MENU_NOT_DROP_DOWN : $static(21),

	/** 
	 * JSWT error constant indicating that an attempt was made to
	 * invoke an JSWT operation using a widget which had already
	 * been disposed
	 * (value is 24). 
	 */
	ERROR_WIDGET_DISPOSED : $static(24),

	/** 
	 * JSWT error constant indicating that a menu item which needed
	 * to have the cascade style had some other style instead
	 * (value is 27).
	 */
	ERROR_MENUITEM_NOT_CASCADE : $static(27),
	
	/**
	 * @field
	 * Style constant for full row selection behavior (value is 1&lt;&lt;16).
	 */
	FULL_SELECTION : $static(1 << 16),

	/**
	 * @field
	 * The MessageBox style constant for error icon behavior (value is 1).
	 */
	ICON_ERROR : $static(1),
    
	/**
	 * @field
	 * The MessageBox style constant for information icon behavior (value is 1&lt;&lt;1).
	 */
	ICON_INFORMATION : $static(1 << 1),
	
	/**
	 * @field
	 * The MessageBox style constant for question icon behavior (value is 1&lt;&lt;2).
	 */
	ICON_QUESTION : $static(1 << 2),
	
	/**
	 * @field
	 * The MessageBox style constant for warning icon behavior (value is 1&lt;&lt;3).
	 */
	ICON_WARNING : $static(1 << 3),
	
	/**
	 * @field
	 * The MessageBox style constant for "working" icon behavior (value is 1&lt;&lt;4).
	 */
	ICON_WORKING : $static(1 << 4),      

	/**
	 * @field
	 * The MessageBox style constant for an IGNORE button, the only valid combination is ABORT|RETRY|IGNORE (value is 1&lt;&lt;11).
	 */
	IGNORE : $static(1 << 11),

	/**
	 * @field
	 * Style constant for shell menu trim (value is 1&lt;&lt;6, since we do not distinguish between CLOSE style and MENU style).
	 */
	MENU : $static(1 << 6),

	/**
	 * @field
	 * Style constant for multi-selection behavior in lists and multiple line support on text fields (value is 1&lt;&lt;1).
	 */
	MULTI : $static(1 << 1), 

	/**
	 * @field
	 * The <tt>MessageBox</tt> style constant for NO button, valid combinations are YES|NO, YES|NO|CANCEL (value is 1&lt;&lt;7).
	 */
	NO : $static(1 << 7),

	/**
	 * A constant known to be zero (0), typically used in operations
	 * which take bit flags to indicate that "no bits are set".
	 */
	NONE : $static(0),

	/**
	 * @field
	 * The <tt>MessageBox</tt> style constant for an OK button, valid combinations are OK, OK|CANCEL (value is 1&lt;&lt;5). 
	 */
	OK : $static(1 << 5),

	/**
	 * @field
	 * Style constant for pop up menu behavior (value is 1&lt;&lt;3).
	 */
	POP_UP : $static(1 << 3),

	/**
	 * @field
	 * The MessageBox style constant for a RETRY button, valid combinations are ABORT|RETRY|IGNORE, RETRY|CANCEL (value is 1&lt;&lt;10).
	 */
	RETRY : $static(1 << 10),
	
	/**
	 * @field
	 * Style constant for line separator behavior (value is 1&lt;&lt;1).
	 */
	SEPARATOR : $static(1 << 1),

	/**
	 * @field
	 * Style constant for single selection behavior in lists and single line support on text fields (value is 1&lt;&lt;2).
	 */
	SINGLE : $static(1 << 2),
	
	/**
	 * @field
	 * Style constant for system modal behavior (value is 1&lt;&lt;17).
	 */
	SYSTEM_MODAL : $static(1 << 17),
	
	/**
	 * @field
	 * Style constant for align top behavior (value is 1&lt;&lt;7, since align UP and align TOP are considered the same).
	 */
	TOP : $static(1 << 7),
	
	/**
	 * @field
	 * Style constant for align up behavior (value is 1&lt;&lt;7, since align UP and align TOP are considered the same).
	 */
	UP : $static(1 << 7),
	
	/**
	 * @field
	 * The MessageBox style constant for YES button, valid combinations are YES|NO, YES|NO|CANCEL (value is 1&lt;&lt;6).
	 */
	YES : $static(1 << 6),
	
	$constructor : function() {}
});

var JSWT = gara.jswt.JSWT;
/*	$Id: FocusListener.interface.js 91 2007-12-09 18:58:43Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @interface FocusListener
 * @author Thomas Gossmann
 * @namespace gara.jswt
 */

$interface("FocusListener", {
	
	/**
	 * @method
	 * focus gained [DOCTEST]
	 */
	focusGained : function() {
	},
	
	focusLost : function() {
	},
	
	toString : function() {
		return "[gara.jswt.FocusListener]";
	}
});

/*	$Id: SelectionListener.interface.js 91 2007-12-09 18:58:43Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @interface SelectionListener
 * @author Thomas Gossmann
 * @namespace gara.jswt
 */
$interface("SelectionListener", {
	widgetSelected : function(widget) {
		
	},
	
	toString : function() {
		return "[gara.jswt.SelectionListener]";
	}
});
/*	$Id: SelectionListener.interface.js 91 2007-12-09 18:58:43Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @interface MenuListener
 * @author Thomas Gossmann
 * @namespace gara.jswt
 */
$interface("MenuListener", {
	menuHidden : function(widget) {
		
	},
	
	menuShown : function(widget) {
		
	},
	
	toString : function() {
		return "[gara.jswt.MenuListener]";
	}
});
/*	$Id: ItemNotExistsException.class.js 91 2007-12-09 18:58:43Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class ItemNotExistsException
 * @author Thomas Gossmann
 * @namespace gara.jswt
 * @extends Exception
 */
$class("ItemNotExistsException", {
	$extends : Exception,
	
	$constructor : function(message) {
		this.message = String(message);
		this.name = $class.typeOf(this);
	}
});
/*	$Id: ItemNotExistsException.class.js 91 2007-12-09 18:58:43Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class JSWTException
 * @author Thomas Gossmann
 * @namespace gara.jswt
 * @extends Exception
 */
$class("JSWTException", {
	$extends : Exception,
	
	/**
	 * @field
	 * Contains the error code, one of JSWT.ERROR_* 
	 */
	code : null,
	
	/**
	 * @constructor
	 * Raises a JSWT Exception
	 * 
	 * @param {mixed} codeOrMessage Pass either a code or a message
	 * @param {String} message Wether code is passed place your message as second
	 */
	$constructor : function(codeOrMessage, message) {
		var code;
		if (typeof(message) == "undefined") {
			message = codeOrMessage;
		} else {
			code = codeOrMessage;
		}
		this.code = code;
		this.message = String(message);
		this.name = $class.typeOf(this);
	}
});
/*	$Id: Widget.class.js 169 2008-11-13 23:29:49Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @function
 * 
 * @private
 */
function strReplace(string, search, replace) {
	output = "" + string;
	while( output.indexOf(search) > -1 ) {
		pos = output.indexOf(search);
		output = "" + (output.substring(0, pos) + replace +
			output.substring((pos + search.length), output.length));
	}
	return output;
}


/**
 * @class Widget
 * 
 * @summary
 * short description 
 * 
 * @description
 * long description (just testing the doc...)
 * @author Thomas Gossmann
 * @namespace gara.jswt
 * @see http://gara.creative2.net
 * @see gara.jswt.List
 * @see <span style="color: #f00">doc-test... am i red?</span>
 */
$class("Widget", {
	/**
	 * @field
	 * contains the DOM reference of the widget
	 * 
	 * @type HTMLElement
	 */
	domref : null,

	/**
	 * @constructor
	 */
	$constructor : function(parent, style) {
		this.domref = null;

		this._parent = parent;
		this._parentNode = null;
		this._style = typeof(style) == "undefined" ? JSWT.DEFAULT : style;
		this._data = null;
		this._dataMap = {};
		
		this._className = "";
		this._baseClass = "";
		this._listener = {};
		
		this._disposed = false;
		this._disposeListener = [];
	},

	/**
	 * @method
	 * Adds a CSS class to the item
	 * 
	 * @author Thomas Gossmann
	 * @param {String} className new class
	 * @return {void}
	 */
	addClassName : function(className) {
		this._className += " " + className;
		this._changed = true;
	},

	/**
	 * @method
	 * Adds a dispose listener to the widget
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.DisposeListener} listener the listener which gets notified about the disposal
	 * @return {void}
	 */
	addDisposeListener : function(listener) {
		if (!$class.instanceOf(listener, gara.jswt.DisposeListener)) {
			throw new TypeError("listener not instance of gara.jswt.DisposeListener");
		}

		if (!this._disposeListener.contains(listener)) {
			this._disposeListener.push(listener);
		}
	},

	/**
	 * @method
	 * Adds an eventlistener to the widget
	 * 
	 * @author Thomas Gossmann
	 * @param {String} eventType the type of the event
	 * @param {Object} listener the listener
	 * @return {void}
	 */
	addListener : function(eventType, listener) {
		if (!this._listener.hasOwnProperty(eventType)) {
			this._listener[eventType] = new Array();
		}

		this._listener[eventType].push(listener);
		this._registerListener(eventType, listener);
	},

	/**
	 * @method
	 * Checks wether the widget is disposed or not
	 * 
	 * @author Thomas Gossmann
	 * @throws gara.jswt.JSWTException <ul>
	 * 		<li>gara.jswt.JSWT.ERROR_WIDGET_DISPOSED - If widget is disposed</li>
	 * </ul>
	 * 
	 * @return {void}
	 */
	checkWidget : function() {
		if (this.isDisposed()) {
			throw new gara.jswt.JSWTException(JSWT.ERROR_WIDGET_DISPOSED);
		}
	},

	/**
	 * @method
	 * Disposes the widget
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	dispose : function() {
		this._disposed = true;
		
		// notify dispose listeners
		this._disposeListener.forEach(function(item, index, arr) {
			item.widgetDisposed(this);
		}, this);
		
		for (var type in this._listener) {
			this._listener[type].forEach(function(item, index, arr) {
				this.removeListener(type, item);
			}, this);
		}
	},

	/**
	 * @method
	 * Returns the CSS class names
	 * 
	 * @author Thomas Gossmann
	 * @return {String} the class name(s)
	 */
	getClassName : function() {
		return this._className;
	},

	/**
	 * @method
	 * Returns application based data for this widget, or <code>null</code> if it has not been set
	 * 
	 * @author Thomas Gossmann
	 * @return {Object} application based data
	 */
	getData : function(key) {
		if (typeof(key) == "undefined") {
			return this._data;
		} else {
			if (this._dataMap.hasOwnProperty(key)) {
				return this._dataMap[key];
			}
		}
		return null;
	},

	/**
	 * @method
	 * Returns the parent for this widget
	 * 
	 * @author Thomas Gossmann
	 * @return {gara.jswt.Widget|HTMLElement} the widgets parent
	 */
	getParent : function() {
		return this._parent;
	},

	/**
	 * @method
	 * Returns the style for this widget
	 * 
	 * @author Thomas Gossmann
	 * @return {int} the style 
	 */
	getStyle : function() {
		return this._style;
	},

	/**
	 * @method
	 * Tests if there is a specified classname existent
	 * 
	 * @author Thomas Gossmann
	 * @param {String} the class name to look for
	 * @return {boolean} wether there is this class or not
	 */
	hasClassName : function(className) {
		return this._className.indexOf(className) != -1;
	},

//	handleEvent : $abstract(function(e){}),

	/**
	 * @method
	 * Tells wether this widget is disposed or not
	 * 
	 * @author Thomas Gossmann
	 * @return {boolean} true for disposed status otherwise false
	 */
	isDisposed : function() {
		return this._disposed;
	},

	/**
	 * @method
	 * Workaround for passing keyboard events to the widget with focus
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {Event} e the event
	 * @param {gara.jswt.Widget} obj the obj on which the event belongs to
	 * @param {gara.jswt.Control} control the control to witch the event belongs
	 * @return {void}
	 */
	_notifyExternalKeyboardListener : function(e, obj, control) {
		if (this._listener.hasOwnProperty(e.type)) {
			var keydownListener = this._listener[e.type];
			
			keydownListener.forEach(function(item, index, arr) {
				e.target.obj = obj;
				e.target.control = control;

				if (typeof(item) == "object" && item.handleEvent) {
					item.handleEvent(e);
				} else if (typeof(item) == "function") {
					eval(item + "()");
				}
			});
		}
	},

	_registerListener : $abstract(function(eventType, listener){}),

	/**
	 * @method
	 * Removes a CSS class name from this item.
	 * 
	 * @author Thomas Gossmann
	 * @param {String} className the class name that should be removed
	 * @return {void}
	 */
	removeClassName : function(className) {
		this._className = strReplace(this._className, className, "");
		this._changed = true;
	},

	/**
	 * @method
	 * Removes a dispose listener from the widget
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.DisposeListener} listener the listener which should be removed
	 * @return {void} 
	 */
	removeDisposeListener : function(listener) {
		if (!$class.instanceOf(listener, gara.jswt.DisposeListener)) {
			throw new TypeError("listener not instance of gara.jswt.DisposeListener");
		}

		if (this._disposeListener.contains(listener)) {
			this._disposeListener.remove(listener);
		}
	},

	/**
	 * @method
	 * Removes a listener from this item
	 * 
	 * @author Thomas Gossmann
	 * @param {String} eventType the type of the event
	 * @param {Object} listener the listener
	 * @return {void}
	 */
	removeListener : function(eventType, listener) {
		if (this._listener.hasOwnProperty(eventType) 
				&& this._listener[eventType].contains(listener)) {
			this._listener[eventType].remove(listener);
			this._unregisterListener(eventType, listener);
		}
	},
	
	/**
	 * @method
	 * Sets application based data for this widget
	 * 
	 * @author Thomas Gossmann
	 * @param {Object} data your data for this widget
	 * @return {void}
	 */
	setData : function(key, data) {
		if (typeof(data) == "undefined") {
			this._data = key;
		} else {
			this._dataMap[key] = data;
		}
	},
	
	_setParentNode : function(parentNode) {
		this._parentNode = parentNode;
	},
	
	toString : function() {
		return "[gara.jswt.Widget]";
	},

	_unregisterListener : $abstract(function(eventType, listener){})
});
/*	$Id: Control.class.js 140 2008-07-20 22:24:27Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class Control
 * @author Thomas Gossmann
 * @extends gara.jswt.Widget
 * @namespace gara.jswt
 */
$class("Control", {
	$extends : gara.jswt.Widget,

	/**
	 * @constructor
	 */
	$constructor : function(parent, style) {
		this.$base(parent, style);

		// add Control to the ControlManager and add as focus listener
		this._focusListener = [];
		this._hasFocus = false;
		this._menu = null;

		this._width = null;
		this._height = null;

		gara.jswt.ControlManager.getInstance().addControl(this);
		this.addFocusListener(gara.jswt.ControlManager.getInstance());
	},

	/**
	 * @method
	 * Adds a focus changed listener on the control
	 * 
	 * @author Thomas Gossmann
	 * @param {FocusListener} the desired listener to be added to this control
	 * @throws {TypeError} if the listener is not implementing the FocusListener interface
	 * @return {void}
	 */
	addFocusListener : function(listener) {
		if (!$class.implementationOf(listener, gara.jswt.FocusListener)) {
			throw new TypeError("listener is not a gara.jswt.FocusListener");
		}

		this._focusListener.push(listener);
	},

	/**
	 * @method
	 * Forces this control to gain focus
	 * 
	 * @return {void}
	 */
	forceFocus : function() {
		this._hasFocus = true;

		this.removeClassName(this._baseClass + "Inactive");
		this.addClassName(this._baseClass + "Active");
		this.update();

		// notify focus listeners
		for (var i = 0, len = this._focusListener.length; i < len; ++i) {
			this._focusListener[i].focusGained(this);
		}
	},
	
	getHeight : function() {
		return this._height;
	},
	
	getWidth : function() {
		return this._width;
	},

	handleContextMenu : function(e) {
		switch(e.type) {
			case "contextmenu":
				if (this._menu != null) {
					this._menu.setLocation(e.clientX, e.clientY);
					this._menu.setVisible(true);
					e.preventDefault(); // safari
				}
				break;

			/* Opera has no contextmenu event, so we go for Ctrl + mousedown 
			 * See YUI blog for more information:
			 * http://yuiblog.com/blog/2008/07/17/context-menus-and-focus-in-opera/
			 */
			case "mousedown":
				if (window.opera 
						&& (e.altKey || e.ctrlKey) 
						&& this._menu != null) {
					this._menu.setLocation(e.clientX, e.clientY);
					this._menu.setVisible(true, e);
				}
				break;
		}
	},

	/**
	 * @method
	 * @abstract
	 * @private
	 */
	handleEvent : $abstract(function(e){}),

	/**
	 * @method
	 * Tells wether the control has focus or not
	 * 
	 * @return {boolean} true for having the focus and false if not
	 */
	isFocusControl : function() {
		return this._hasFocus;
	},

	/**
	 * @method
	 * Forces this control to loose focus
	 * 
	 * @return {void}
	 */
	looseFocus : function() {
		this._hasFocus = false;
	
		this.removeClassName(this._baseClass + "Active");
		this.addClassName(this._baseClass + "Inactive");
		this.update();

		// notify focus listeners
		for (var i = 0, len = this._focusListener.length; i < len; ++i) {
			this._focusListener[i].focusLost(this);
		}
	},

	/**
	 * @method
	 * Removes a focus listener from this control
	 * 
	 * @param {FocusListener} the listener to remove from this control
	 * @throws {TypeError} wether this is not a FocusListener
	 * @return {void}
	 */
	removeFocusListener : function(listener) {
		if (!listener.$class.implementsInterface(gara.jswt.FocusListener)) {
			throw new TypeError("listener is not a gara.jswt.FocusListener");
		}

		if (this._focusListener.contains(listener)) {
			this._focusListener.remove(listener);
		}
	},
	
	setHeight : function(height) {
		this._height = height;
	},

	setMenu : function(menu) {
		if (!$class.instanceOf(menu, gara.jswt.Menu)) {
			throw new TypeError("menu is not a gara.jswt.Menu");
		}

		this._menu = menu;
		this.addListener("contextmenu", this);
		this.addListener("mousedown", this);
	},

	setWidth : function(width) {
		this._width = width;
	},

	toString : function() {
		return "[gara.jswt.Control";
	},

	update : $abstract(function() {})
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class Composite
 * @author Thomas Gossmann
 * @extends gara.jswt.Control
 * @namespace gara.jswt
 */
$class("Composite", {
	$extends : gara.jswt.Control,

	/**
	 * @constructor
	 */
	$constructor : function(parent, style) {
		this.$base(parent, style);
	}
});
/*	$Id: List.class.js 177 2008-11-23 21:27:09Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @summary
 * gara List Widget
 * 
 * @description
 * long description for the List Widget...
 * 
 * @class List
 * @author Thomas Gossmann
 * @namespace gara.jswt
 * @extends gara.jswt.Control
 */
$class("List", {
	$extends : gara.jswt.Control,

	/**
	 * @constructor
	 * Constructor
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.Composite|HTMLElement} parent parent dom node or composite
	 * @param {int} style The style for the list
	 * @return {gara.jswt.List} list widget
	 */
	$constructor : function(parent, style) {
		this.$base(parent, style);

		// List default style
		if (this._style == JSWT.DEFAULT) {
			this._style = JSWT.SINGLE;
		}

		this._event = null;
		this._items = [];
		this._selection = [];
		this._selectionListener = [];
		this._activeItem = null;
		this._shiftItem = null;
		this._className = this._baseClass = "jsWTList";
		this._className += " jsWTListInactive";
	},

	/**
	 * @method
	 * Activates an item
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {gara.jswt.ListItem} item the item that should added to the List
	 * @throws {TypeError} if the item is not a ListItem
	 * @return {void}
	 */
	_activateItem : function(item) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.ListItem)) {
			throw new TypeError("item is not type of gara.jswt.ListItem");
		}
		// set a previous active item inactive
		if (this._activeItem != null && !this._activeItem.isDisposed()) {
			this._activeItem.setActive(false);
			this._activeItem.update();
		}

		this._activeItem = item;
		this._activeItem.setActive(true);
		this.update();
	},

	/**
	 * @method
	 * Adds an item to the list (invoked by the constructor of ListItem)
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {gara.jswt.ListItem} item the item that should added to the List
	 * @throws {TypeError} if the item is not a ListItem
	 * @return {void}
	 */
	_addItem : function(item, index) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.ListItem)) {
			throw new TypeError("item is not type of gara.jswt.ListItem");
		}
		
		if (typeof(index) != "undefined") {
			this._items.insertAt(index, item);
		} else {
			this._items.push(item);
		}
	},

	/**
	 * @method
	 * Adds a selection listener on the list
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.SelectionListener} listener the desired listener to be added to this list
	 * @throws {TypeError} if the listener is not an instance SelectionListener
	 * @return {void}
	 */
	addSelectionListener : function(listener) {
		this.checkWidget();
		if (!$class.instanceOf(listener, gara.jswt.SelectionListener)) {
			throw new TypeError("listener is not instance of gara.jswt.SelectionListener");
		}

		this._selectionListener.push(listener);
	},
	
	_create : function() {
		this.domref = document.createElement("ul");
		this.domref.obj = this;
		this.domref.control = this;
		base2.DOM.EventTarget(this.domref);

		/* buffer unregistered user-defined listeners */
		var unregisteredListener = {};			
		for (var eventType in this._listener) {
			unregisteredListener[eventType] = this._listener[eventType].concat([]);
		}

		/* List event listener */
		this.addListener("mousedown", this);

		/* register user-defined listeners */
		for (var eventType in unregisteredListener) {
			unregisteredListener[eventType].forEach(function(elem, index, arr) {
				this._registerListener(eventType, elem);
			}, this);
		}

		if (!$class.instanceOf(this._parent, gara.jswt.Composite)) {
			this._parentNode = this._parent;
		}

		if (this._parentNode != null) {
			this._parentNode.appendChild(this.domref);
		}
	},

	/**
	 * @method
	 * Deselects an item
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.ListItem} item the item that should be deselected
	 * @throws {TypeError} if the item is not a ListItem
	 * @return {void}
	 */
	deselect : function(item) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.ListItem)) {
			throw new TypeError("item not instance of gara.jswt.ListItem");
		}

		if (this._selection.contains(item)) {
			item._setSelected(false);
			this._selection.remove(item);
			this._shiftItem = item;
			this._activateItem(item);
			this.notifySelectionListener();
		}
	},

	/**
	 * @method
	 * Deselects all items
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	deselectAll : function() {
		this.checkWidget();
		for (var i = 0, len = this._items.length; i < len; ++i) {
			this.deselect(this._items[i]);
		}
		this.update();
	},

	dispose : function() {
		this.deselectAll();
		this.$base();

		this._items.forEach(function(item, index, arr) {
			item.dispose();
		}, this);

		if (this._parentNode != null) {
			this._parentNode.removeChild(this.domref);
		}
		delete this.domref;
	},

	/**
	 * @method
	 * Gets a specified item with a zero-related index
	 * 
	 * @author Thomas Gossmann
	 * @param {int} index the zero-related index
	 * @throws {gara.OutOfBoundsException} if the index does not live within this list
	 * @return {gara.jswt.ListItem} the item
	 */
	getItem : function(index) {
		this.checkWidget();
		if (index >= this._items.length) {
			throw new gara.OutOfBoundsException("Your item lives outside of this list");
		}
	
		return this._items[index];
	},

	/**
	 * @method
	 * Returns the amount of the items in the list
	 * 
	 * @author Thomas Gossmann
	 * @return {int} the amount
	 */
	getItemCount : function() {
		return this._items.length;
	},

	/**
	 * @method
	 * Returns an array with all the items in the list
	 * 
	 * @author Thomas Gossmann
	 * @return {gara.jswt.ListItem[]} the array with the items
	 */
	getItems : function() {
		return this._items;
	},

	/**
	 * @method
	 * Returns an array with the items which are currently selected in the list
	 * 
	 * @author Thomas Gossmann
	 * @return {gara.jswt.ListItem[]} an array with items
	 */
	getSelection : function() {
		this.checkWidget();
		return this._selection;
	},

	/**
	 * @method
	 * Returns the amount of the selected items in the tree
	 * 
	 * @author Thomas Gossmann
	 * @return {int} the amount
	 */
	getSelectionCount : function() {
		this.checkWidget();
		return this._selection.length;
	},

	/**
	 * @method
	 * Handles events on the list. Implements DOMEvent Interface by the W3c.
	 * 
	 * @author Thomas Gossmann
	 * @param {Event} e event the users triggers
	 * @return {void}
	 */
	handleEvent : function(e) {
		this.checkWidget();
		// special events for the list
		var obj = e.target.obj || null;
		
		if (obj && $class.instanceOf(obj, gara.jswt.ListItem)) {
			e.item = obj;
		}
		e.widget = this;
		this._event = e;

		switch (e.type) {
			case "mousedown":
				if (!this._hasFocus) {
					this.forceFocus();
				}

				if ($class.instanceOf(obj, gara.jswt.ListItem)) {
					var item = obj;

					if (!e.ctrlKey && !e.shiftKey) {
						this.select(item, false);
					} else if (e.ctrlKey && e.shiftKey) {
						this.selectRange(item, true);
					} else if (e.shiftKey) {
						this.selectRange(item, false);
					} else if (e.ctrlKey) {
						if (this._selection.contains(item)) {
							this.deselect(item);
						} else {
							this.select(item, true);
						}
					} else {
						this.select(item);
					}
				}
				break;

			case "keyup":
			case "keydown":
			case "keypress":
				if (this._activeItem != null) {
					this._activeItem.handleEvent(e);
				}

				this._notifyExternalKeyboardListener(e, this, this);
				
				if (e.type == "keydown") {
					this._handleKeyEvent(e);					
				}
				break;
		}

		this.handleContextMenu(e);
		e.stopPropagation();
		
		/* in case of ie6, it is necessary to return false while the type of
		 * the event is "contextmenu" and the menu isn't hidden in ie6
		 */
		return false;
	},

	/**
	 * @method
	 * handling key events on the List
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {Event} e event the users triggers
	 * @return {void}
	 */
	_handleKeyEvent : function(e) {
	
	//	window.status = "keycode: " + e.keyCode;
		if (this._activeItem == null) {
			return;
		}

		switch (e.keyCode) {
			case 37: // left
			case 38: // up
				// determine previous item
				var prev = false;
				var activeIndex = this.indexOf(this._activeItem);
				
				if (activeIndex != 0) {
					prev = this._items[activeIndex - 1];
				}

				if (prev) {
					// update scrolling
					var h = 0;
					for (var i = 0; i < (activeIndex - 1); i++) {
						h += this._items[i].domref.offsetHeight
							+ parseInt(gara.Utils.getStyle(this._items[i].domref, "margin-top"))
							+ parseInt(gara.Utils.getStyle(this._items[i].domref, "margin-bottom"));
					}
					if (h < this.domref.scrollTop) {
						this.domref.scrollTop = h;
					}
					
					// handle select
					if (!e.ctrlKey && !e.shiftKey) {
						//this.deselect(this._activeItem);
						this.select(prev, false);
					} else if (e.ctrlKey && e.shiftKey) {
						this.selectRange(prev, true);
					} else if (e.shiftKey) {
						this.selectRange(prev, false);
					} else if (e.ctrlKey) {
						this._activateItem(prev);
					}
				}
				break;

			case 39: // right
			case 40: // down
				// determine next item
				var next = false;
				var activeIndex = this.indexOf(this._activeItem);
				
				// item is last;
				if (activeIndex != this._items.length - 1) {
					next = this._items[activeIndex + 1];
				}

				if (next) {
					// update scrolling
					var h = 0;
					for (var i = 0; i <= (activeIndex + 1); i++) {
						h += this._items[i].domref.offsetHeight
							+ parseInt(gara.Utils.getStyle(this._items[i].domref, "margin-top"))
							+ parseInt(gara.Utils.getStyle(this._items[i].domref, "margin-bottom"));
					}
					var viewport = this.domref.clientHeight + this.domref.scrollTop
						- parseInt(gara.Utils.getStyle(this.domref, "padding-top"))
						- parseInt(gara.Utils.getStyle(this.domref, "padding-bottom"));
					if (h > viewport) {
						this.domref.scrollTop = h - this.domref.clientHeight
							+ parseInt(gara.Utils.getStyle(this.domref, "padding-top"))
							+ parseInt(gara.Utils.getStyle(this.domref, "padding-bottom"));
					}

					// handle select
					if (!e.ctrlKey && !e.shiftKey) {
						//this.deselect(this.activeItem);
						this.select(next, false);
					} else if (e.ctrlKey && e.shiftKey) {
						this.selectRange(next, true);
					} else if (e.shiftKey) {
						this.selectRange(next, false);
					} else if (e.ctrlKey) {
						this._activateItem(next);
					}
				}
				break;

			case 32: // space
				if (this._selection.contains(this._activeItem) && e.ctrlKey) {
					this.deselect(this._activeItem);
				} else {
					this.select(this._activeItem, true);
				}
				break;

			case 36: // home
				this.domref.scrollTop = 0;

				if (!e.ctrlKey && !e.shiftKey) {
					this.select(this._items[0], false);
				} else if (e.shiftKey) {
					this.selectRange(this._items[0], false);
				} else if (e.ctrlKey) {
					this._activateItem(this._items[0]);
				}
				break;
				
			case 35: // end
				this.domref.scrollTop = this.domref.scrollHeight - this.domref.clientHeight;

				var lastOffset = this._items.length - 1;
				if (!e.ctrlKey && !e.shiftKey) {
					this.select(this._items[lastOffset], false);
				} else if (e.shiftKey) {
					this.selectRange(this._items[lastOffset], false);
				} else if (e.ctrlKey) {
					this._activateItem(this._items[lastOffset]);
				}
				break;
		}
	},

	/**
	 * @method
	 * Looks for the index of a specified item
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.ListItem} item the item for the index
	 * @throws {gara.jswt.ItemNotExistsException} if the item does not exist in this list
	 * @throws {TypeError} if the item is not a ListItem
	 * @return {int} the index of the specified item
	 */
	indexOf : function(item) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.ListItem)) {
			throw new TypeError("item not instance of gara.jswt.ListItem");
		}
	
		if (!this._items.contains(item)) {
			// TODO: ItemNotExistsException
			throw new gara.jswt.ItemNotExistsException("item [" + item + "] does not exists in this list");
			return;
		}

		return this._items.indexOf(item);
	},

	/**
	 * @method
	 * Notifies selection listener about the changed selection within the List
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	notifySelectionListener : function() {
		for (var i = 0, len = this._selectionListener.length; i < len; ++i) {
			this._selectionListener[i].widgetSelected(this._event);
		}
	},
	
	/**
	 * @method
	 * Register listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_registerListener : function(eventType, listener) {
		if (this.domref != null) {
			gara.EventManager.addListener(this.domref, eventType, listener);
		}
	},

	/**
	 * @method
	 * Removes an item from the list
	 * 
	 * @author Thomas Gossmann
	 * @param {int} index the index of the item
	 * @return {void}
	 */
	remove : function(index) {
		this.checkWidget();
		var item = this._items.removeAt(index)[0];
		if (this._selection.contains(item)) {
			this._selection.remove(item);
		}
		item.dispose();
		delete item;
	},

	/**
	 * @method
	 * Removes items within an indices range
	 * 
	 * @author Thomas Gossmann
	 * @param {int} start start index
	 * @param {int} end end index
	 * @return {void}
	 */
	removeRange : function(start, end) {
		this.checkWidget();
		for (var i = start; i <= end; ++i) {
			this.remove(i);
		}
	},

	/**
	 * @method
	 * Removes items which indices are passed by an array
	 * 
	 * @author Thomas Gossmann
	 * @param {Array} inidices the array with the indices
	 * @return {void}
	 */
	removeFromArray : function(indices) {
		this.checkWidget();
		indices.forEach(function(item, index, arr) {
			this.remove(index);
		}, this);
	},

	/**
	 * @method
	 * Removes all items from the list
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	removeAll : function() {
		this.checkWidget();
		while (this._items.length) {
			/*var item = this._items.pop();
			this.domref.removeChild(item.domref);
			delete item;*/
			this.remove(0);
		}
	},

	/**
	 * @method
	 * Removes a selection listener from this list
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.SelectionListener} listener the listener to remove from this list
	 * @throws {TypeError} if the listener is not an instance SelectionListener
	 * @return {void}
	 */
	removeSelectionListener : function(listener) {
		this.checkWidget();
		if (!$class.instanceOf(listener, gara.jswt.SelectionListener)) {
			throw new TypeError("listener is not instance of gara.jswt.SelectionListener");
		}

		if (this._selectionListener.contains(listener)) {
			this._selectionListener.remove(listener);
		}
	},

	/**
	 * @method
	 * Selects an item
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.ListItem} item the item that should be selected
	 * @throws {TypeError} if the item is not a ListItem
	 * @return {void}
	 */
	select : function(item, _add) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.ListItem)) {
			throw new TypeError("item not instance of gara.jswt.ListItem");
		}

		if (!_add || (this._style & JSWT.MULTI) != JSWT.MULTI) {
			while (this._selection.length) {
				var i = this._selection.pop();
				i._setSelected(false);
				i.update();
			}
		}

		if (!this._selection.contains(item)) {
			item._setSelected(true);
			this._selection.push(item);
			this._shiftItem = item;
			this._activateItem(item);
			this.notifySelectionListener();
		}
	},

	/**
	 * @method
	 * Select all items in the list
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	selectAll : function() {
		this.checkWidget();
		if ((this._style & JSWT.SINGLE) != JSWT.SINGLE) {
			for (var i = 0, len = this._items.length; i < len; ++i) {
				this.select(this._items[i], true);
			}
		}
	},

	/**
	 * @method
	 * Selects a range. From the item with shift-lock to the passed item.
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {gara.jswt.ListItem} item the item that should be selected
	 * @throws {TypeError} if the item is not a ListItem
	 * @return {void}
	 */
	selectRange : function(item, _add) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.ListItem)) {
			throw new TypeError("item not instance of gara.jswt.ListItem");
		}

		// only, when selection mode is MULTI
		if (!_add) {
			while (this._selection.length) {
				var i = this._selection.pop();
				i._setSelected(false);
				i.update();
			}
		}

		if ((this._style & JSWT.MULTI) == JSWT.MULTI) {
			var indexShift = this.indexOf(this._shiftItem);
			var indexItem = this.indexOf(item);
			var from = indexShift > indexItem ? indexItem : indexShift;
			var to = indexShift < indexItem ? indexItem : indexShift;

			for (var i = from; i <= to; ++i) {
				this._selection.push(this._items[i]);
				this._items[i]._setSelected(true);
				this._items[i].update();
			}

			this._activateItem(item);
			this.notifySelectionListener();
		} else {
			this.select(item);
		}
	},

	/**
	 * @method
	 * Sets the text of an item at a zero-related index
	 * 
	 * @author Thomas Gossmann
	 * @param {int} index the index for the item
	 * @param {String} string the new text for the item
	 * @throws {TypeError} if the text is not a string
	 * @throws {gara.OutOfBoundsException} if the index does not live within the List
	 * @return {void}
	 */	
	setItem : function(index, string) {
		this.checkWidget();
		if (typeof(string) != "string") {
			throw new TypeError("string is not type of a String");
		}

		if (index >= this._items.length) {
			throw new gara.OutOfBoundsException("item is not in List");
		}

		item[index].setText(string);
		
		this.update();
	},

	/**
	 * @method
	 * Sets the List's items to be the given Array of items
	 * 
	 * @author Thomas Gossmann
	 * @param {Array} strings the array with item texts
	 * @throws {TypeError} if the strings are not an Array
	 * @return {void}
	 */
	setItems : function(strings) {
		this.checkWidget();
		if (!$class.instanceOf(strings, Array)) {
			throw new TypeError("strings are not an Array");
		}

		for (var i = 0; i < strings.length; ++i) {
			if (this._items[i]) {
				this._items[i].setText(strings[i]);
			} else {
				var item = new gara.jswt.ListItem(this);
				item.setText(strings[i]);
			}
		}
		
		this.update();
	},
	
	/**
	 * @method
	 * Sets the selection of the list
	 * 
	 * @author Thomas Gossmann
	 * @param {Array} items the array with the <code>TreeItem</code> items
	 * @throws {TypeError} if the passed items are not an array
	 * @return {void}
	 */	
	setSelection : function(items) {
		this.checkWidget();
		if ($class.instanceOf(items, Array)) {
			items.forEach(function(item, index, arr) {
				if ($class.instanceOf(item, gara.jswt.ListItem)) {
					this.select(item, true);
				} else if ($class.instanceOf(item, Number)) {
					this.select(this._items[item], true);
				}
			}, this);
		} else if ($class.instanceOf(items, Number)) {
			this.select(this._items[items]);
		}
	},

	toString : function() {
		return "[gara.jswt.List]";
	},
	
	/**
	 * @method
	 * Unregister listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_unregisterListener : function(eventType, listener) {
		if (this.domref != null) {
			gara.EventManager.removeListener(this.domref, eventType, listener);
		}
	},

	/**
	 * @method
	 * Updates the list!
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	update : function() {
		this.checkWidget();
		// create widget if domref equals null
		if (this.domref == null) {
			this._create();
		}

		if (this._height != null) this.domref.style.width = this._width + "px"; 
		if (this._width != null) this.domref.style.height = this._height + "px";

		this.removeClassName("jsWTListFullSelection");

		if ((this._style & JSWT.FULL_SELECTION) == JSWT.FULL_SELECTION) {
			this.addClassName("jsWTListFullSelection");
		}

		this.domref.className = this._className;

		// update items
		this._items.forEach(function(item, index, arr) {
			item._setParentNode(this.domref);
			item.update();
		}, this);
	}
});
/*	$Id: Tree.class.js 177 2008-11-23 21:27:09Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * gara Tree Widget
 * 
 * @class Tree
 * @author Thomas Gossmann
 * @namespace gara.jswt
 * @extends gara.jswt.Composite
 */
$class("Tree", {
	$extends : gara.jswt.Composite,

	$constructor : function(parent, style) {
		this.$base(parent, style);
		
		// Tree default style
		if (this._style == JSWT.DEFAULT) {
			this._style = JSWT.SINGLE;
		}
		
		this._showLines = true;
		this._event = null;

		this._shiftItem = null;
		this._activeItem = null;
		this._className = this._baseClass = "jsWTTree";
		this._className += " jsWTTreeInactive";
		
		this._selection = [];
		this._selectionListeners = [];
		this._items = [];
		this._columns = [];
		this._firstLevelItems = [];
	},

	/**
	 * @method
	 * Activates an item
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TreeItem} item the new item to be activated
	 * @throws {TypeError} if the item is not a ListItem
	 * @return {void}
	 */
	_activateItem : function(item) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TreeItem)) {
			throw new TypeError("item is not type of gara.jswt.TreeItem");
		}

		// set a previous active item inactive
		if (this._activeItem != null && !this._activeItem.isDisposed()) {
			this._activeItem.setActive(false);
			this._activeItem.update();
		}

		this._activeItem = item;
		this._activeItem.setActive(true);
		this._activeItem.update();
	},

	/**
	 * @method
	 * Adds an item to the tree. This is automatically done by instantiating a new item.
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TreeItem} item the new item to be added
	 * @throws WrongObjectException
	 * @return void
	 */
	_addItem : function(item, index) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TreeItem)) {
			throw new TypeError("item is not type of gara.jswt.TreeItem");
		}

		var parentItem = item.getParentItem();
		
		// first level item
		if (parentItem == null) {
			var append = typeof(index) == "undefined";
			
			var previousItem = this._firstLevelItems[index];
			if (previousItem) {
				var nextItemIndex = getDescendents(previousItem) + 1;
				this._items.insertAt(nextItemIndex, item);
				this._firstLevelItems.insertAt(index, item);
			} else {
				append = true;
			}
			
			if (append) {
				this._items.push(item);
				this._firstLevelItems.push(item);
			}
			
		}
		// childs
		else {
			index = this._items.indexOf(parentItem)
				+ getDescendents(parentItem);

			this._items.insertAt(index, item);
		}

		function getDescendents(item) {
			var childs = 0;
			if (item.getItemCount() > 0) {
				item.getItems().forEach(function(child, index, arr) {
					if (child.getItemCount() > 0) {
						childs += getDescendents(child);
					}
					childs++;
				}, this);
			}
			return childs;
		}
	},

	/**
	 * @method
	 * Adds a selection listener on the tree
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.SelectionListener} listener the desired listener to be added to this tree
	 * @throws {TypeError} if the listener is not a SelectionListener
	 * @return {void}
	 */
	addSelectionListener : function(listener) {
		if (!$class.instanceOf(listener, gara.jswt.SelectionListener)) {
			throw new TypeError("listener is not type of gara.jswt.SelectionListener");
		}
		
		if (!this._selectionListeners.contains(listener)) {
			this._selectionListeners.push(listener);
		}
	},

	_create : function() {
		this.domref = document.createElement("ul");
		this.domref.obj = this;
		this.domref.control = this;
		base2.DOM.EventTarget(this.domref);

		/* buffer unregistered user-defined listeners */
		var unregisteredListener = {};			
		for (var eventType in this._listener) {
			unregisteredListener[eventType] = this._listener[eventType].concat([]);
		}

		/* List event listener */
		this.addListener("mousedown", this);

		/* register user-defined listeners */
		for (var eventType in unregisteredListener) {
			unregisteredListener[eventType].forEach(function(elem, index, arr) {
				this._registerListener(eventType, elem);
			}, this);
		}

		/* If parent is not a composite then it *must* be a HTMLElement
		 * but because of IE there is no cross-browser check. Or no one I know of.
		 */
		if (!$class.instanceOf(this._parent, gara.jswt.Composite)) {
			this._parentNode = this._parent;
		}

		if (this._parentNode != null) {
			this._parentNode.appendChild(this.domref);
		}
	},
	
	/**
	 * @method
	 * Deselects a specific item
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TreeItem} item the item to deselect
	 * @return {void}
	 */
	_deselect : function(item) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TreeItem)) {
			throw new TypeError("item is not type of gara.jswt.TreeItem");
		}
	
		if (this._selection.contains(item)/* && item.getParent() == this*/) {
			item._setSelected(false);
			this._selection.remove(item);
			this._shiftItem = item;
			this._activateItem(item);
			this._notifySelectionListener();
		}
	},

	/**
	 * @method
	 * Deselect all items in the tree
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	deselectAll : function() {
		this.checkWidget();
		while (this._selection.length) {
			this._deselect(this._selection[0]);
		}
		this.update();
	},

	dispose : function() {
		this.deselectAll();
		this.$base();

		this._firstLevelItems.forEach(function(item, index, arr) {
			item.dispose();
		}, this);

		if (this._parentNode != null) {
			this._parentNode.removeChild(this.domref);
		}
		delete this.domref;
	},
	
	getColumnCount : function() {
		return this._columns.length;
	},

	/**
	 * @method
	 * Returns a specifiy item with a zero-related index
	 * 
	 * @author Thomas Gossmann
	 * @param {int} index the zero-related index
	 * @throws {gara.OutOfBoundsException} if the index does not live within this tree
	 * @return {gara.jswt.TreeItem} the item
	 */
	getItem : function(index) {
		this.checkWidget();
		if (index >= this._items.length) {
			throw new gara.OutOfBoundsException("Your item lives outside of this Tree");
		}
	
		return this._firstLevelItems[index];
	},

	/**
	 * @method
	 * Returns the amount of items that are direct items of the tree
	 * 
	 * @author Thomas Gossmann
	 * @return {int} the amount
	 */
	getItemCount : function() {
		return this._firstLevelItems.length;
	},

	/**
	 * @method
	 * Returns an array with direct items of the tree
	 * 
	 * @author Thomas Gossmann
	 * @return {gara.jswt.TreeItem[]} an array with the items
	 */
	getItems : function() {
		return this._firstLevelItems;
	},

	/**
	 * @method
	 * Returns whether the lines of the tree are visible or not
	 * 
	 * @author Thomas Gossmann
	 * @return {boolean} true if the lines are visible and false if they are not
	 */
	getLinesVisible : function() {
		return this._showLines;
	},

	/**
	 * @method
	 * Returns an array with the items which are currently selected in the tree
	 * 
	 * @author Thomas Gossmann
	 * @return {gara.jswt.TreeItem[]}an array with items
	 */
	getSelection : function() {
		return this._selection;
	},

	/**
	 * @method
	 * Returns the amount of the selected items in the tree
	 * 
	 * @author Thomas Gossmann
	 * @return {int} the amount
	 */
	getSelectionCount : function() {
		return this._selection.length;
	},

	/**
	 * @method
	 * Event Handler for the tree
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {Event} W3C-event
	 * @return {void}
	 */
	handleEvent : function(e) {
		this.checkWidget();
		var obj = e.target.obj || null;
		var item = null;
		
		if (obj && $class.instanceOf(obj, gara.jswt.TreeItem)) {
			e.item = obj;
			item = obj;
		}
		e.widget = this;
		this._event = e;

		switch (e.type) {
			case "mousedown":
				if (!this._hasFocus) {
					this.forceFocus();
				}

				if (item != null) {
					
					if (e.target != item.toggleNode) {
						if (e.ctrlKey && !e.shiftKey) {
							if (this._selection.contains(item)) {
								this._deselect(item);
							} else {
								this._select(item, true);
							}
						} else if (!e.ctrlKey && e.shiftKey) {
							this._selectShift(item, false);
						} else if (e.ctrlKey && e.shiftKey) {
							this._selectShift(item, true);
						} else {
							this._select(item, false);
						}
					}
					
				}
				break;

			case "keyup":
			case "keydown":
			case "keypress":
				if (this._activeItem != null) {
					this._activeItem.handleEvent(e);
				}

				this._notifyExternalKeyboardListener(e, this, this);
				
				if (e.type == "keydown") {
					this._handleKeyEvent(e);					
				}
				break;
		}

		if (item != null) {
			item.handleEvent(e);
		}

		this.handleContextMenu(e);
		e.stopPropagation();

		/* in case of ie6, it is necessary to return false while the type of
		 * the event is "contextmenu" and the menu isn't hidden in ie6
		 */
		return false;
	},

	/**
	 * @method
	 * Key Event Handler for the Tree
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {Event} W3C-Event
	 * @return {void}
	 */
	_handleKeyEvent : function(e) {
		this.checkWidget();
		if (this._activeItem == null) {
			return;
		}
	
		switch (e.keyCode) {
			case 38 : // up
				// determine previous item
				var prev;

				if (this._activeItem == this._items[0]) {
					// item is root;
					prev = false;
				} else {
					var siblings;
					var parentWidget = this._activeItem.getParentItem();
					if (parentWidget == null) {
						siblings = this._firstLevelItems;
					} else {
						siblings = parentWidget.getItems();
					}
					var sibOffset = siblings.indexOf(this._activeItem);
		
					// prev item is parent
					if (sibOffset == 0) {
						prev = parentWidget;
					} else {
						var prevSibling = siblings[sibOffset - 1];
						prev = getLastItem(prevSibling);
					}
				}

				if (prev) {
					// update scrolling
					var h = 0, activeIndex = this._items.indexOf(this._activeItem);
					for (var i = 0; i < (activeIndex - 1); i++) {
						h += this._items[i].domref.offsetHeight
							+ parseInt(gara.Utils.getStyle(this._items[i].domref, "margin-top"))
							+ parseInt(gara.Utils.getStyle(this._items[i].domref, "margin-bottom"));
						if (this._items[i]._hasChilds()) {
							var childContainer = this._items[i]._getChildContainer();
							h -= childContainer.offsetHeight
								+ parseInt(gara.Utils.getStyle(childContainer, "margin-top"))
								+ parseInt(gara.Utils.getStyle(childContainer, "margin-bottom"));
						}
					}
					if (h < this.domref.scrollTop) {
						this.domref.scrollTop = h;
					}

					// handle select
					if (!e.ctrlKey && !e.shiftKey) {
						this._select(prev, false);
					} else if (e.ctrlKey && e.shiftKey) {
						this._selectShift(prev, true);
					} else if (e.shiftKey) {
						this._selectShift(prev, false);
					} else if (e.ctrlKey) {
						this._activateItem(prev);
					}
				}
			break;
	
			case 40 : // down
				// determine next item
				var next;
				var siblings;
				
				// item is last;
				if (this._activeItem == this._items[this._items.length - 1]) {
					next = false;
				} else {
					var parentWidget = this._activeItem.getParentItem();
					if (parentWidget == null) {
						siblings = this._firstLevelItems;
					} else {
						siblings = parentWidget.getItems();
					}
					var sibOffset = siblings.indexOf(this._activeItem);
		
					if (this._activeItem.getItemCount() > 0 && this._activeItem.getExpanded()) {
						next = this._activeItem.getItems()[0];
					} else if (this._activeItem.getItemCount() > 0 && !this._activeItem.getExpanded()) {
						next = this._items[this._items.indexOf(this._activeItem) + countItems(this._activeItem) + 1];
					} else {
						next = this._items[this._items.indexOf(this._activeItem) + 1];
					}
				}

				if (next) {
					// update scrolling
					var h = 0, activeIndex = this._items.indexOf(this._activeItem);
					for (var i = 0; i <= (activeIndex + 1); i++) {
						h += this._items[i].domref.offsetHeight
							+ parseInt(gara.Utils.getStyle(this._items[i].domref, "margin-top"))
							+ parseInt(gara.Utils.getStyle(this._items[i].domref, "margin-bottom"));
						if (this._items[i]._hasChilds()) {
							var childContainer = this._items[i]._getChildContainer();
							h -= childContainer.offsetHeight
								+ parseInt(gara.Utils.getStyle(childContainer, "margin-top"))
								+ parseInt(gara.Utils.getStyle(childContainer, "margin-bottom"));
						}
					}
					var viewport = this.domref.clientHeight + this.domref.scrollTop
						- parseInt(gara.Utils.getStyle(this.domref, "padding-top"))
						- parseInt(gara.Utils.getStyle(this.domref, "padding-bottom"));
					if (h > viewport) {
						this.domref.scrollTop = h - this.domref.clientHeight
							+ parseInt(gara.Utils.getStyle(this.domref, "padding-top"))
							+ parseInt(gara.Utils.getStyle(this.domref, "padding-bottom"));
					}

					// handle select
					if (!e.ctrlKey && !e.shiftKey) {
						this._select(next, false);
					} else if (e.ctrlKey && e.shiftKey) {
						this._selectShift(next, true);
					} else if (e.shiftKey) {
						this._selectShift(next, false);
					} else if (e.ctrlKey) {
						this._activateItem(next);
					}
				}
				break;
			
			case 37: // left
				// collapse tree
				var buffer = this._activeItem;
				this._activeItem.setExpanded(false);
				this._activateItem(buffer);
				this.update();
				break;
	
			case 39: // right
				// expand tree
				this._activeItem.setExpanded(true);
				this.update();
				break;
				
			case 32 : // space
				if (this._selection.contains(this._activeItem) && e.ctrlKey) {
					this._deselect(this._activeItem);
				} else {
					this._select(this._activeItem, true);
				}
				break;
				
			case 36 : // home
				this.domref.scrollTop = 0;
			
				if (!e.ctrlKey && !e.shiftKey) {
					this._select(this._items[0], false);
				} else if (e.shiftKey) {
					this._selectShift(this._items[0], false);
				} else if (e.ctrlKey) {
					this._activateItem(this._items[0]);
				}
				break;
				
			case 35 : // end
				this.domref.scrollTop = this.domref.scrollHeight - this.domref.clientHeight;
			
				if (!e.ctrlKey && !e.shiftKey) {
					this._select(this._items[this._items.length-1], false);
				} else if (e.shiftKey) {
					this._selectShift(this._items[this._items.length-1], false);
				} else if (e.ctrlKey) {
					this._activateItem(this._items[this._items.length-1]);
				}
				break;
		}
	
		function getLastItem(item) {
			if (item.getExpanded() && item.getItemCount() > 0) {
				return getLastItem(item.getItems()[item.getItemCount() - 1]);
			} else {
				return item;
			}
		}
		
		function countItems(item) {
			var items = 0;
			var childs = item.getItems();
			
			for (var i = 0; i < childs.length; ++i) {
				items++;
				if (childs[i].getItemCount() > 0) {
					items += countItems(childs[i]);
				}
			}
			
			return items;
		}
	},

	/**
	 * @method
	 * Looks for the index of a specified item
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TreeItem} item the item for the index
	 * @throws {gara.jswt.ItemNotExistsException} if the item does not exist in this tree
	 * @throws {TypeError} if the item is not a TreeItem
	 * @return {int} the index of the specified item
	 */
	indexOf : function(item) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TreeItem)) {
			throw new TypeError("item not instance of gara.jswt.TreeItem");
		}

		if (!this._firstLevelItems.contains(item)) {
			throw new gara.jswt.ItemNotExistsException("item [" + item + "] does not exists in this list");
		}

		return this._firstLevelItems.indexOf(item);
	},

	/**
	 * @method
	 * Notifies all selection listeners about the selection change
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_notifySelectionListener : function() {
		this._selectionListeners.forEach(function(item, index, arr) {
			item.widgetSelected(this._event);
		}, this);
	},

	/**
	 * @method
	 * Register listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_registerListener : function(eventType, listener) {
		if (this.domref != null) {
			gara.EventManager.addListener(this.domref, eventType, listener);
		}
	},
	
	/**
	 * @method
	 * Removes an item from the tree
	 * 
	 * @author Thomas Gossmann
	 * @param {int} index the index of the item
	 * @return {void}
	 */
	remove : function(index) {
		this.checkWidget();
		var item = this._firstLevelItems.removeAt(index)[0];
		this._items.remove(item);
		if (!item.isDisposed()) {
			item.dispose();
		}
		delete item;
	},
	
	_removeItem : function(item) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TreeItem)) {
			throw new TypeError("item not instance of gara.jswt.TreeItem");
		}
		
		this._items.remove(item);
	},
	
	/**
	 * @method
	 * Removes items within an indices range
	 * 
	 * @author Thomas Gossmann
	 * @param {int} start start index
	 * @param {int} end end index
	 * @return {void}
	 */
	removeRange : function(start, end) {
		for (var i = start; i <= end; ++i) {
			this.remove(i);
		}
	},
	
	/**
	 * @method
	 * Removes items which indices are passed by an array
	 * 
	 * @author Thomas Gossmann
	 * @param {Array} inidices the array with the indices
	 * @return {void}
	 */
	removeFromArray : function(indices) {
		indices.forEach(function(item, index, arr) {
			this.remove(index);
		}, this);
	},
	
	/**
	 * @method
	 * Removes all items from the tree
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	removeAll : function() {
		while (this._firstLevelItems.length) {
			var item = this._firstLevelItems.pop();
			this.domref.removeChild(item.domref);
			delete item;
		}
	},

	/**
	 * @method
	 * Removes a selection listener from this tree
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.SelectionListener} listener the listener to be removed from this tree
	 * @throws {TypeError} if the listener is not a SelectionListener
	 * @return {void}
	 */
	removeSelectionListener : function(listener) {
		if (!$class.instanceOf(listener, gara.jswt.SelectionListener)) {
			throw new TypeError("item is not type of gara.jswt.SelectionListener");
		}

		if (this._selectionListeners.contains(listener)) {
			this._selectionListeners.remove(listener);
		}
	},

	/**
	 * @method
	 * Selects a specific item
	 *
	 * @private 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TreeItem} item the item to select
	 * @param {boolean} _add true for adding to the current selection, false will select only this item
	 * @throws {TypeError} if the item is not a TreeItem
	 * @return {void}
	 */
	_select : function(item, _add) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TreeItem)) {
			throw new TypeError("item is not type of gara.jswt.TreeItem");
		}

		if (!_add || (this._style & JSWT.MULTI) != JSWT.MULTI) {
			while (this._selection.length) {
				var i = this._selection.pop();
				i._setSelected(false);
				i.update();
			}
		}

		if (!this._selection.contains(item)) {
			item._setSelected(true);
			this._selection.push(item);
			this._shiftItem = item;
			this._activateItem(item);
			this._notifySelectionListener();
		}
	},
	
	/**
	 * @method
	 * Select all items in the list
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	selectAll : function() {
		this.checkWidget();
		if ((this._style & JSWT.SINGLE) != JSWT.SINGLE) {
			this._items.forEach(function(item, index, arr){
				this._select(item, true);
			}, this);
			this.update();
		}
	},

	/**
	 * @method
	 * Selects a Range of items. From shiftItem to the passed item.
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_selectShift : function(item, _add) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TreeItem)) {
			throw new TypeError("item is not type of gara.jswt.TreeItem");
		}

		if (!_add) {
			while (this._selection.length) {
				var i = this._selection.pop();
				i._setSelected(false);
				i.update();
			}
		}

		if ((this._style & JSWT.MULTI) == JSWT.MULTI) {
			var indexShift = this._items.indexOf(this._shiftItem);
			var indexItem = this._items.indexOf(item);
			var from = indexShift > indexItem ? indexItem : indexShift;
			var to = indexShift < indexItem ? indexItem : indexShift;

			for (var i = from; i <= to; ++i) {
				this._selection.push(this._items[i]);
				this._items[i]._setSelected(true);
				this._items[i].update();
			}

			this._activateItem(item);			
			this._notifySelectionListener();
		} else {
			this._select(item);
		}
	},
	
	/**
	 * @method
	 * Sets lines visible or invisible.
	 * 
	 * @author Thomas Gossmann
	 * @param {boolean} show true if the lines should be visible or false for invisibility
	 * @return {void}
	 */
	setLinesVisible : function(show) {
		this._showLines = show;
	},

	/**
	 * @method
	 * Sets the selection of the tree
	 * 
	 * @author Thomas Gossmann
	 * @param {Array} items the array with the <code>TreeItem</code> items
	 * @throws {TypeError} if the passed items are not an array
	 * @return {void}
	 */	
	setSelection : function(items) {
		this.checkWidget();
		if (!$class.instanceOf(items, Array)) {
			throw new TypeError("items are not instance of an Array");
		}

		this._selection = items;
		this._selection.forEach(function(item, index, arr) {
			item._setSelected(true);
		}, this);
		this._notifySelectionListener();
	},

	toString : function() {
		return "[gara.jswt.Tree]";
	},
	
	/**
	 * @method
	 * Unregister listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_unregisterListener : function(eventType, listener) {
		if (this.domref != null) {
			gara.EventManager.removeListener(this.domref, eventType, listener);
		}
	},
	
	/**
	 * @method
	 * Updates the widget
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	update : function() {
		this.checkWidget();
		if (this.domref == null) {
			this._create();
		}

		if (this._height != null) this.domref.style.width = this._width + "px"; 
		if (this._width != null) this.domref.style.height = this._height + "px";

		this.removeClassName("jsWTTreeNoLines");
		this.removeClassName("jsWTTreeLines");
		this.removeClassName("jsWTTreeFullSelection");	

		if (this._showLines) {
			this.addClassName("jsWTTreeLines");
		} else {
			this.addClassName("jsWTTreeNoLines");
		}
		
		if ((this._style & JSWT.FULL_SELECTION) == JSWT.FULL_SELECTION) {
			this.addClassName("jsWTTreeFullSelection");
		}

		this.domref.className = this._className;

		// update items		
		this._firstLevelItems.forEach(function(item, index, arr) {
			if (item.isDisposed()) {
				this.remove(index);
			} else {
				item.update();
			}
		}, this);
	}
});
/*	$Id: TabFolder.class.js 176 2008-11-22 01:27:51Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * gara TabFolder Widget
 * 
 * @class TabFolder
 * @author Thomas Gossmann
 * @namespace gara.jswt
 * @extends gara.jswt.Composite
 */
$class("TabFolder", {
	$extends : gara.jswt.Composite,

	/**
	 * @constructor
	 * @param {gara.jswt.Composite|HTMLElement} parent parent dom node or composite
	 * @param {int} style The style for the list
	 */
	$constructor : function(parent, style) {
		this.$base(parent, style);

		// TabFolder default style
		if (this._style == JSWT.DEFAULT) {
			this._style = JSWT.TOP;
		}

		this._items = [];
		this._activeItem = null;
		this._selectionListener = [];
		this._selection = [];
		this._event = null;

		this._tabbar = null;
		this._clientArea = null;
		this._className = this._baseClass = "jsWTTabFolder";
		this._className += " jsWTTabFolderInactive";
	},

	/**
	 * @method
	 * Adds an item to this tabfolder
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TabItem} item the item to be added
	 * @throws {TypeError} if the item is not type of gara.jswt.TabItem
	 * @return {void}
	 */
	_addItem : function(item) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TabItem)) {
			throw new TypeError("item is not type of gara.jswt.TabItem");
		}

		item._setClientArea(this._clientArea);
		this._items.push(item);
	},

	/**
	 * @method
	 * Adds a selection listener on the tabfolder
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.SelectionListener} listener the desired listener to be added to this tabfolder
	 * @throws {TypeError} if the listener is not an instance SelectionListener
	 * @return {void}
	 */
	addSelectionListener : function(listener) {
		this.checkWidget();
		if (!$class.instanceOf(listener, gara.jswt.SelectionListener)) {
			throw new TypeError("listener is not instance of gara.jswt.SelectionListener");
		}

		this._selectionListener.push(listener);
	},

	/**
	 * @method
	 * Activates an item and notifies the selection listener
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TabItem} item the item to be activated
	 * @throws {TypeError} if the item is not type of gara.jswt.TabItem
	 * @return {void}
	 */
	_activateItem : function(item) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TabItem)) {
			throw new TypeError("item is not type of gara.jswt.TabItem");
		}
		
		if (this._activeItem != null) {
			this._activeItem._setActive(false);
		}
		
		this._activeItem = item;
		this._activeItem._setActive(true);

		// clean up client area
		/*for (var i = 0, len = this._clientArea.childNodes.length; i < len; ++i) {
			this._clientArea.removeChild(this._clientArea.childNodes[i]);
		}

		// show new content
		if(item.getControl() != null) {
			item.getControl().update();
			this._clientArea.appendChild(item.getControl().domref);
		} else {
			if (typeof(item.getContent()) == "string") {
				this._clientArea.appendChild(document.createTextNode(item.getContent()));
			} else {
				this._clientArea.appendChild(item.getContent());
			}
		}*/

		this.update();

		this._selection = [];
		this._selection.push(item);
		this._notifySelectionListener();
	},
	
	_create : function() {
		this.domref = document.createElement("div");
		this.domref.obj = this;
		this.domref.control = this;
		base2.DOM.EventTarget(this.domref);

		this._tabbar = document.createElement("ul");
		this._tabbar.obj = this;
		this._tabbar.control = this;
		this._tabbar.className = "jsWTTabbar";
		base2.DOM.EventTarget(this._tabbar);

		this._clientArea = document.createElement("div");
		this._clientArea.className = "jsWTTabClientArea"
		base2.DOM.EventTarget(this._clientArea);

		if (this._style == JSWT.TOP) {
			this.domref.appendChild(this._tabbar);
			this.domref.appendChild(this._clientArea);
			this.addClassName("jsWTTabFolderTopbar");
		} else {
			this.domref.appendChild(this._clientArea);
			this.domref.appendChild(this._tabbar);
			this.addClassName("jsWTTabFolderBottombar");
		}

		/* buffer unregistered user-defined listeners */
		var unregisteredListener = {};			
		for (var eventType in this._listener) {
			unregisteredListener[eventType] = this._listener[eventType].concat([]);
		}

		/* List event listener */
		this.addListener("mousedown", this);

		/* register user-defined listeners */
		for (var eventType in unregisteredListener) {
			unregisteredListener[eventType].forEach(function(elem, index, arr) {
				this.registerListener(eventType, elem);
			}, this);
		}

		/* If parent is not a composite then it *must* be a HTMLElement
		 * but because of IE there is no cross-browser check. Or no one I know of.
		 */
		if (!$class.instanceOf(this._parent, gara.jswt.Composite)) {
			this._parentNode = this._parent;
		}

		if (this._parentNode != null) {
			this._parentNode.appendChild(this.domref);
		}
	},
	
	dispose : function() {
		this.$base();

		this._items.forEach(function(item, index, arr) {
			item.dispose();
		}, this);

		this.domref.removeChild(this._tabbar);
		this.domref.removeChild(this._clientArea);

		if (this._parentNode != null) {
			this._parentNode.removeChild(this.domref);
		}
		
		delete this._tabbar;
		delete this._clientArea;
		delete this.domref;
	},

	/**
	 * @method
	 * Returns the client area off that tabfolder
	 * 
	 * @author Thomas Gossmann
	 * @return {HTMLElement} the client area node
	 */
	getClientArea : function() {
		return this._clientArea;
	},
	
	/**
	 * @method
	 * Gets a specified item with a zero-related index
	 * 
	 * @author Thomas Gossmann
	 * @param {int} index the zero-related index
	 * @throws {gara.OutOfBoundsException} if the index does not live within this tabfolder
	 * @return {gara.jswt.TabItem} the item
	 */
	getItem : function(index) {
		this.checkWidget();
		if (index >= this._items.length) {
			throw new gara.OutOfBoundsException("Your item lives outside of this tabfolder");
		}
	
		return this._items[index];
	},

	/**
	 * @method
	 * Returns the amount of the items in the tabfolder
	 * 
	 * @author Thomas Gossmann
	 * @return {int} the amount
	 */
	getItemCount : function() {
		return this._items.length;
	},

	/**
	 * @method
	 * Returns an array with all the items in the tabfolder
	 * 
	 * @author Thomas Gossmann
	 * @return {gara.jswt.TabItem[]} the array with the items
	 */
	getItems : function() {
		return this._items;
	},

	/**
	 * @method
	 * Returns an array with the items which are currently selected in the tabfolder
	 * 
	 * @author Thomas Gossmann
	 * @return {gara.jswt.TabItem[]} an array with items
	 */
	getSelection : function() {
		this.checkWidget();
		return this._selection;
	},
	
	/**
	 * @method
	 * Returns the zero-related index of the selected item or -1 if there is no item selected
	 * 
	 * @author Thomas Gossmann
	 * @return {int} the index of the selected item
	 */
	getSelectionIndex : function() {
		this.checkWidget();
		if (this._selection.length) {
			return this._items.indexOf(this._selection[0]);
		} else {
			return -1;
		}
	},

	/**
	 * @method
	 * Handles events for this tabfolder
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	handleEvent : function(e) {
		this.checkWidget();
		var obj = e.target.obj || null;
		
		if (obj && $class.instanceOf(obj, gara.jswt.TabItem)) {
			e.item = obj;
		}
		e.widget = this;
		this._event = e;

		switch (e.type) {
			case "mousedown":
				if (!this._hasFocus) {
					this.forceFocus();
				}

				if ($class.instanceOf(obj, gara.jswt.TabItem)) {
					var item = obj;

					this._activateItem(item);
				}
				break;
			
						
			case "keyup":
			case "keydown":
			case "keypress":
			
				if (this._activeItem != null) {
					this._activeItem.handleEvent(e);
				}

				this._notifyExternalKeyboardListener(e, this, this);
				
				break;
		}
		
		this.handleContextMenu(e);

		if (e.target != this.domref) {
			e.stopPropagation();
		}
		
		/* in case of ie6, it is necessary to return false while the type of
		 * the event is "contextmenu" and the menu isn't hidden in ie6
		 */
		return false;
	},
	
	/**
	 * @method
	 * Looks for the index of a specified item
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TabItem} item the item for the index
	 * @throws {gara.jswt.ItemNotExistsException} if the item does not exist in this tabfolder
	 * @throws {TypeError} if the item is not a TabItem
	 * @return {int} the index of the specified item
	 */
	indexOf : function(item) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TabItem)) {
			throw new TypeError("item not instance of gara.jswt.TabItem");
		}
	
		if (!this._items.contains(item)) {
			throw new gara.jswt.ItemNotExistsException("item [" + item + "] does not exists in this list");
		}

		return this._items.indexOf(item);
	},

	/**
	 * @method
	 * Notifies selection listener about the changed selection within the List
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_notifySelectionListener : function() {
		for (var i = 0, len = this._selectionListener.length; i < len; ++i) {
			this._selectionListener[i].widgetSelected(this._event);
		}
	},

	/**
	 * @method
	 * Register listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_registerListener : function(eventType, listener) {
		if (this.domref != null) {
			gara.EventManager.addListener(this.domref, eventType, listener);
		}
	},

	/**
	 * @method
	 * Removes a selection listener from this tabfolder
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.SelectionListener} listener the listener to remove from this tabfolder
	 * @throws {TypeError} if the listener is not an instance SelectionListener
	 * @return {void}
	 */
	removeSelectionListener : function(listener) {
		this.checkWidget();
		if (!$class.instanceOf(listener, gara.jswt.SelectionListener)) {
			throw new TypeError("listener is not instance of gara.jswt.SelectionListener");
		}

		if (this._selectionListener.contains(listener)) {
			this._selectionListener.remove(listener);
		}
	},
	
	/**
	 * @method
	 * Selects the item at the given zero-related index in the tabfolder.
	 * Sets the tabfolders selection the the given array.
	 * Depends on the parameter
	 * 
	 * @author Thomas Gossmann
	 * @param {mixed} arg the given zero-related index or the given array
	 * @throws {gara.OutOfBoundsException} when there is no item for the given index
	 * @return {void}
	 */
	setSelection : function(arg) {
		this.checkWidget();
		if (typeof(arg) == 'number') {
			if (arg >= this._items.length) {
				throw new gara.OutOfBoundsException("Your item lives outside of this tabfolder");
			}
			this._activateItem(this._items[arg]);
		} else if ($class.instanceOf(arg, Array)) {
			if (arg.length) {
				this._activateItem(arg[0]);
			}
		}
	},
	
	/**
	 * @method
	 * Shows off the content for the client area from the passed item
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TabItem} item the item with the content
	 * @return {void}
	 */
	_showContent : function(item) {
		
	},
	
	toString : function() {
		return "[gara.jswt.TabFolder]";
	},
	
	/**
	 * @method
	 * Unregister listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_unregisterListener : function(eventType, listener) {
		if (this.domref != null) {
			gara.EventManager.removeListener(this.domref, eventType, listener);
		}
	},

	/**
	 * @method
	 * updates this tabfolder
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	update : function() {
		this.checkWidget();
		var firstBuild = false;
		if (this.domref == null) {
			this._create();
			firstBuild = true;
		}

		this.domref.className = this._className;
		this.domref.style.width = this._width != null ? this._width + "px" : "auto";
		this.domref.style.height = this._height != null ? this._height + "px" : "auto";

		this._tabbar.style.width = this._width != null ? this._width + "px" : "auto"
		this._tabbar.style.width = this._width != null ? this._width + "px" : "auto";

		if (this._height != null) {
			this._clientArea.style.height = (this._height 
				- (this._tabbar.offsetHeight
					+ parseInt(gara.Utils.getStyle(this._tabbar, "margin-top"))
					+ parseInt(gara.Utils.getStyle(this._tabbar, "margin-bottom")))
				- parseInt(gara.Utils.getStyle(this._clientArea, "margin-top"))
				- parseInt(gara.Utils.getStyle(this._clientArea, "border-top-width"))
				- parseInt(gara.Utils.getStyle(this._clientArea, "border-bottom-width"))
				- parseInt(gara.Utils.getStyle(this._clientArea, "margin-bottom"))
				) + "px";
		}

		if (this._width != null) {
			this._clientArea.style.width = this._width
				- parseInt(gara.Utils.getStyle(this._clientArea, "margin-left"))
				- parseInt(gara.Utils.getStyle(this._clientArea, "border-left-width"))
				- parseInt(gara.Utils.getStyle(this._clientArea, "border-right-width"))
				- parseInt(gara.Utils.getStyle(this._clientArea, "margin-right"))
			+ "px";	
		}

		// update items
		this._items.forEach(function(item, index, arr) {
			item._setClientArea(this._clientArea);
			
			// create item ...
			if (!item.isCreated()) {
				node = item._create();
				this._tabbar.appendChild(node);
			}

			// ... or update it
			if (item.hasChanged()) {
				item.update();
				item.releaseChange();
			}
		}, this);
		
		if (firstBuild && this._items.length) {
			this._activateItem(this._items[0]);
		}
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * gara Table Widget
 * 
 * @class Table
 * @author Thomas Gossmann
 * @namespace gara.jswt
 * @extends gara.jswt.Composite
 */
$class("Table", {
	$extends : gara.jswt.Composite,

	/**
	 * @constructor
	 * 
	 * @param {gara.jswt.Composite|HTMLElement} parent parent dom node or composite
	 * @param {int} style The style for the list
	 */
	$constructor : function(parent, style) {
		this.$base(parent, style);

		// Table default style
		if (this._style == JSWT.DEFAULT) {
			this._style = JSWT.SINGLE;
		}

		// items
		this._items = [];
		this._columns = [];
		this._columnOrder = [];

		// flags
		this._headerVisible = false;
		this._linesVisible = false;

		// nodes
		this._thead = null;
		this._theadRow = null;
		this._tbody = null;
		this._tbodyPadding = null;
		this._paddingFiller = null;

		this._className = this._baseClass = "jsWTTable";
		this._className += " jsWTTableInactive";

		this._event = null;
		this._selection = [];
		this._selectionListener = [];
		this._shiftItem = null;
		this._activeItem = null;
	},

	_activateItem : function(item) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TableItem)) {
			throw new TypeError("item is not type of gara.jswt.TableItem");
		}

		// set a previous active item inactive
		if (this._activeItem != null && !this._activeItem.isDisposed()) {
			this._activeItem.setActive(false);
			this._activeItem.update();
		}

		this._activeItem = item;
		this._activeItem.setActive(true);
		this._activeItem.update();
	},

	_addItem : function(item, index) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TableItem)) {
			throw new TypeError("item is not a gara.jswt.TableItem");
		}

		if (typeof(index) != "undefined") {
			this._items.insertAt(index, item);
		} else {
			this._items.push(item);
		}
		item._setParentNode(this._tbody);
	},

	_addColumn : function(column, index) {
		this.checkWidget();
		if (!$class.instanceOf(column, gara.jswt.TableColumn)) {
			throw new TypeError("column is not a gara.jswt.TableColumn");
		}

		if (index) {
			this._columns[index] = column;
			if (!this._columnOrder.contains(index)) {
				this._columnOrder.push(index);
			}
		} else {
			this._columns.push(column);
			this._columnOrder.push(this._columns.length - 1);
		}
		column._setParentNode(this._theadRow);
	},
	
	/**
	 * @method
	 * Adds a selection listener on the table
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.SelectionListener} listener the desired listener to be added to this table
	 * @throws {TypeError} if the listener is not a SelectionListener
	 * @return {void}
	 */
	addSelectionListener : function(listener) {
		if (!$class.instanceOf(listener, gara.jswt.SelectionListener)) {
			throw new TypeError("listener is not type of gara.jswt.SelectionListener");
		}
		
		if (!this._selectionListener.contains(listener)) {
			this._selectionListener.push(listener);
		}
	},
	
	/**
	 * @method
	 * Clears an item at a given index
	 * 
	 * @author Thomas Gossmann
	 * @param {int} index the position of the item
	 * @return {void}
	 */
	clear : function(index) {
		this.checkWidget();
		var item = this._items[index];
		item.clear();
	},

	_create : function() {
		this.domref = document.createElement("table");
		this.domref.obj = this;
		this.domref.control = this;
		base2.DOM.EventTarget(this.domref);

		// table head
		this._thead = document.createElement("thead");
		this._thead.obj = this;
		this._thead.control = this;
		base2.DOM.EventTarget(this._thead);
		this.domref.appendChild(this._thead);

		this._theadRow = document.createElement("tr");
		this._theadRow.obj = this;
		this._theadRow.control = this;
		base2.DOM.EventTarget(this._theadRow);
		this._thead.appendChild(this._theadRow);

		if ((this._style & JSWT.CHECK) == JSWT.CHECK) {
			var checkboxCol = document.createElement("th");
			this._theadRow.appendChild(checkboxCol);
		}

		for (var i = 0, len = this._columnOrder.length; i < len; ++i) {
			this._columns[this._columnOrder[i]]._setParentNode(this._theadRow);
			this._columns[this._columnOrder[i]].update();
		}

		// table body
		this._tbody = document.createElement("tbody");
		this._tbody.obj = this;
		this._tbody.control = this;
		base2.DOM.EventTarget(this._tbody);
		this.domref.appendChild(this._tbody);

		this._tbodyPadding = document.createElement("tbody");
		this._tbodyPadding.obj = this;
		this._tbodyPadding.control = this;
		this._tbodyPadding.style.display = "none";
		base2.DOM.EventTarget(this._tbodyPadding);
		this.domref.appendChild(this._tbodyPadding);

		var tr = document.createElement("tr");
		this._paddingFiller = document.createElement("td");
		this._paddingFiller.colspan = this._columns.length;
		this._paddingFiller.appendChild(document.createTextNode("&nbsp;"));
		tr.appendChild(this._paddingFiller);
		this._tbodyPadding.appendChild(tr);

		// listeners
		/* buffer unregistered user-defined listeners */
		var unregisteredListener = {};			
		for (var eventType in this._listener) {
			unregisteredListener[eventType] = this._listener[eventType].concat([]);
		}

		/* Table event listener */
		this.addListener("mousedown", this);

		/* register user-defined listeners */
		for (var eventType in unregisteredListener) {
			unregisteredListener[eventType].forEach(function(elem, index, arr) {
				this._registerListener(eventType, elem);
			}, this);
		}

		/* If parent is not a composite then it *must* be a HTMLElement
		 * but because of IE there is no cross-browser check. Or no one I know of.
		 */
		if (!$class.instanceOf(this._parent, gara.jswt.Composite)) {
			this._parentNode = this._parent;
		}
		
		if (this._parentNode != null) {
			this._parentNode.appendChild(this.domref);
		}
	},

	/**
	 * @method
	 * Deselects a specific item
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TreeItem} item the item to deselect
	 * @return {void}
	 */
	deselect : function(item) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TableItem)) {
			throw new TypeError("item is not type of gara.jswt.TableItem");
		}

		if (this._selection.contains(item)) {
			item._setSelected(false);
			this._selection.remove(item);
			this._shiftItem = item;
			this._activateItem(item);
			this._notifySelectionListener();
		}
	},
	
	deselectAll : function() {
		this.checkWidget();
		while (this._selection.length) {
			this.deselect(this._selection[0]);
		}
	},

	dispose : function() {
		this.deselectAll();
		this.$base();
		
		this._columns.forEach(function(col, index, arr) {
			col.dispose();
		}, this);
		
		this._items.forEach(function(item, index, arr) {
			item.dispose();
		}, this);

		this._thead.removeChild(this._theadRow);
		this.domref.removeChild(this._thead);
		this.domref.removeChild(this._tbody);
		this.domref.removeChild(this._tbodyPadding);

		if (this._parentNode != null) {
			this._parentNode.removeChild(this.domref);
		}

		delete this._theadRow;
		delete this._thead;
		delete this._tbody;
		delete this._tbodyPadding;
		delete this.domref;
	},
	
	getColumn : function(index) {
		this.checkWidget();
		if (index >= 0 && index < this._columns.length) {
			return this._columns[index];
		}
		return null;
	},
	
	getColumnCount : function() {
		return this._columns.length;
	},
	
	getColumnOrder : function() {
		return this._columnOrder;
	},
	
	getColumns : function() {
		return this._columns;
	},

	getHeaderVisible : function() {
		return this._headerVisible;
	},
	
	/**
	 * @method
	 * Gets a specified item with a zero-related index
	 * 
	 * @author Thomas Gossmann
	 * @param {int} index the zero-related index
	 * @throws {gara.OutOfBoundsException} if the requested index is out of bounds
	 * @return {gara.jswt.TreeItem} the item
	 */
	getItem : function(index) {
		this.checkWidget();
		if (index >= this._items.length) {
			throw new gara.OutOfBoundsException("The requested index exceeds the bounds");
		}
	
		return this._items[index];
	},

	getItemCount : function() {
		return this._items.length;
	},
	
	getItems : function() {
		return this._items;
	},

	getLinesVisible : function() {
		return this._linesVisible;
	},

	/**
	 * @method
	 * Returns an array with the items which are currently selected in the table
	 * 
	 * @author Thomas Gossmann
	 * @return {gara.jswt.TreeItem[]}an array with items
	 */
	getSelection : function() {
		return this._selection;
	},

	/**
	 * @method
	 * Returns the amount of the selected items in the table
	 * 
	 * @author Thomas Gossmann
	 * @return {int} the amount
	 */
	getSelectionCount : function() {
		return this._selection.length;
	},

	handleEvent : function(e) {
		this.checkWidget();
		var obj = e.target.obj || null;
		
		if (obj && $class.instanceOf(obj, gara.jswt.TableItem)) {
			e.item = obj;
		}
		e.widget = this;
		this._event = e;
		
		switch (e.type) {
			case "mousedown":
				if (!this._hasFocus) {
					this.forceFocus();
				}

				if ($class.instanceOf(obj, gara.jswt.TableItem)) {
					var item = obj;
					
					if (!e.ctrlKey && !e.shiftKey) {
						this.select(item, false);
					} else if (e.ctrlKey && e.shiftKey) {
						this._selectShift(item, true);
					} else if (e.shiftKey) {
						this._selectShift(item, false);
					} else if (e.ctrlKey) {
						if (this._selection.contains(item)) {
							this.deselect(item);
						} else {
							this.select(item, true);
						}
					} else {
						this.select(item);
					}
				}

				if ($class.instanceOf(obj, gara.jswt.TableColumn)) {
					obj.handleEvent(e);
				}
				break;

			case "keyup":
			case "keydown":
			case "keypress":
				if (this._activeItem != null) {
					this._activeItem.handleEvent(e);
				}

				this._notifyExternalKeyboardListener(e, this, this);
				
				if (e.type == "keydown") {
					this._handleKeyEvent(e);					
				}
				break;
		}

		if ($class.instanceOf(obj, gara.jswt.TableItem)) {
			this.handleContextMenu(e);
		}

		e.stopPropagation();
		
		/* in case of ie6, it is necessary to return false while the type of
		 * the event is "contextmenu" and the menu isn't hidden in ie6
		 */
		return false;
	},
	
	_handleKeyEvent : function(e) {
		this.checkWidget();
		if (this._activeItem == null) {
			return;
		}

		switch (e.keyCode) {
			case 38 : // up
				// determine previous item
				var prev = false;
				var activeIndex = this.indexOf(this._activeItem);
				
				if (activeIndex != 0) {
					prev = this._items[activeIndex - 1];
				}

				if (prev) {
					// update scrolling
					var h = 0;
					for (var i = 0; i < (activeIndex - 1); i++) {
						h += this._items[i].domref.offsetHeight
							+ parseInt(gara.Utils.getStyle(this._items[i].domref, "margin-top"))
							+ parseInt(gara.Utils.getStyle(this._items[i].domref, "margin-bottom"));
					}
					if (h < this._tbody.scrollTop) {
						this._tbody.scrollTop = h;
					}
					
					// handle select
					if (!e.ctrlKey && !e.shiftKey) {
						//this.deselect(this._activeItem);
						this.select(prev, false);
					} else if (e.ctrlKey && e.shiftKey) {
						this._selectShift(prev, true);
					} else if (e.shiftKey) {
						this._selectShift(prev, false);
					} else if (e.ctrlKey) {
						this._activateItem(prev);
					}
				}
				break;

			case 40 : // down
				// determine next item
				var next = false;
				var activeIndex = this.indexOf(this._activeItem);
				
				if (activeIndex != this._items.length - 1) {
					next = this._items[activeIndex + 1];
				}

				if (next) {
					// update scrolling
					var h = 0;
					for (var i = 0; i <= (activeIndex + 1); i++) {
						h += this._items[i].domref.offsetHeight
							+ parseInt(gara.Utils.getStyle(this._items[i].domref, "margin-top"))
							+ parseInt(gara.Utils.getStyle(this._items[i].domref, "margin-bottom"));
					}
					var viewport = this._tbody.clientHeight + this._tbody.scrollTop;
					if (h > viewport) {
						this._tbody.scrollTop = h - this._tbody.clientHeight;
					}

					// handle select
					if (!e.ctrlKey && !e.shiftKey) {
						this.select(next, false);
					} else if (e.ctrlKey && e.shiftKey) {
						this._selectShift(next, true);
					} else if (e.shiftKey) {
						this._selectShift(next, false);
					} else if (e.ctrlKey) {
						this._activateItem(next);
					}
				}
				break;

			case 32 : // space
				if (this._selection.contains(this._activeItem) && e.ctrlKey) {
					this.deselect(this._activeItem);
				} else {
					this.select(this._activeItem, true);
				}
				break;
				
			case 36 : // home
				this._tbody.scrollTop = 0;
			
				if (!e.ctrlKey && !e.shiftKey) {
					this.select(this._items[0], false);
				} else if (e.shiftKey) {
					this._selectShift(this._items[0], false);
				} else if (e.ctrlKey) {
					this._activateItem(this._items[0]);
				}
				break;

			case 35 : // end
				this._tbody.scrollTop = this._tbody.scrollHeight - this._tbody.clientHeight;

				var lastOffset = this._items.length - 1;
				if (!e.ctrlKey && !e.shiftKey) {
					this.select(this._items[lastOffset], false);
				} else if (e.shiftKey) {
					this._selectShift(this._items[lastOffset], false);
				} else if (e.ctrlKey) {
					this._activateItem(this._items[lastOffset]);
				}
				break;
		}
	},
	
	/**
	 * @method
	 * Looks for the index of a specified item
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TableItem} item the item for the index
	 * @throws {gara.jswt.ItemNotExistsException} if the item does not exist in this table
	 * @throws {TypeError} if the item is not a TableItem
	 * @return {int} the index of the specified item
	 */
	indexOf : function(item) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TableItem)) {
			throw new TypeError("item not instance of gara.jswt.TableItem");
		}

		if (!this._items.contains(item)) {
			throw new gara.jswt.ItemNotExistsException("item [" + item + "] does not exists in this list");
		}

		return this._items.indexOf(item);
	},
	
	/**
	 * @method
	 * Notifies all selection listeners about the selection change
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_notifySelectionListener : function() {
		this._selectionListener.forEach(function(item, index, arr) {
			item.widgetSelected(this._event);
		}, this);
	},

	_registerListener : function(eventType, listener) {
		if (this.domref) {
			gara.EventManager.addListener(this.domref, eventType, listener);
		}
	},

	/**
	 * @method
	 * Removes an item from the table
	 * 
	 * @author Thomas Gossmann
	 * @param {int} index the index of the item
	 * @return {void}
	 */
	remove : function(index) {
		this.checkWidget();
		var item = this._items.removeAt(index)[0];
		item.dispose();
		delete item;
	},

	/**
	 * @method
	 * Removes items within an indices range
	 * 
	 * @author Thomas Gossmann
	 * @param {int} start start index
	 * @param {int} end end index
	 * @return {void}
	 */
	removeRange : function(start, end) {
		this.checkWidget();
		for (var i = start; i <= end; ++i) {
			this.remove(start);
		}
	},

	/**
	 * @method
	 * Removes items whose indices are passed by an array
	 * 
	 * @author Thomas Gossmann
	 * @param {Array} inidices the array with the indices
	 * @return {void}
	 */
	removeFromArray : function(indices) {
		this.checkWidget();
		indices.forEach(function(item, index, arr) {
			this.remove(index);
		}, this);
	},
	
	/**
	 * @method
	 * Removes all items from the table
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	removeAll : function() {
		this.checkWidget();
		while (this._items.length) {
			var item = this._items.pop();
			this.domref.removeChild(item.domref);
			delete item;
		}
	},

	/**
	 * @method
	 * Removes a selection listener from this table
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.SelectionListener} listener the listener to be removed from this table
	 * @throws {TypeError} if the listener is not a SelectionListener
	 * @return {void}
	 */
	removeSelectionListener : function(listener) {
		if (!$class.instanceOf(listener, gara.jswt.SelectionListener)) {
			throw new TypeError("listener is not type of gara.jswt.SelectionListener");
		}

		if (this._selectionListener.contains(listener)) {
			this._selectionListener.remove(listener);
		}
	},
	
	/**
	 * @method
	 * Selects an item
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TableItem} item the item that should be selected
	 * @throws {TypeError} if the item is not a TableItem
	 * @return {void}
	 */
	select : function(item, _add) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TableItem)) {
			throw new TypeError("item not instance of gara.jswt.TableItem");
		}

		if (!_add || (this._style & JSWT.MULTI) != JSWT.MULTI) {
			while (this._selection.length) {
				var i = this._selection.pop();
				i._setSelected(false);
				i.update();
			}
		}

		if (!this._selection.contains(item)) {
			this._selection.push(item);
			item._setSelected(true);
			this._shiftItem = item;
			this._activateItem(item);
			this._notifySelectionListener();
		}
	},
	
	/**
	 * @method
	 * Selects a Range of items. From shiftItem to the passed item.
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TableItem} item the item
	 * @return {void}
	 */
	_selectShift : function(item, _add) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TableItem)) {
			throw new TypeError("item is not type of gara.jswt.TableItem");
		}

		if (!_add) {
			while (this._selection.length) {
				var i = this._selection.pop();
				i._setSelected(false);
				i.update();
			}
		}

		if ((this._style & JSWT.MULTI) == JSWT.MULTI) {
			var indexShift = this.indexOf(this._shiftItem);
			var indexItem = this.indexOf(item);
			var from = indexShift > indexItem ? indexItem : indexShift;
			var to = indexShift < indexItem ? indexItem : indexShift;

			for (var i = from; i <= to; ++i) {
				this._selection.push(this._items[i]);
				this._items[i]._setSelected(true);
				this._items[i].update();
			}

			this._activateItem(item);			
			this._notifySelectionListener();
		} else {
			this.select(item);
		}
	},
	
	setColumnOrder : function(order) {
		this._columnOrder = order;
	},

	setHeaderVisible : function(show) {
		this._headerVisible = show;
	},
	
	setLinesVisible : function(show) {
		this._linesVisible = show;
	},
	
	toString : function() {
		return "[gara.jswt.Table]";
	},
	
	/**
	 * @method
	 * Unregister listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_unregisterListener : function(eventType, listener) {
		if (this.domref != null) {
			gara.EventManager.removeListener(this.domref, eventType, listener);
		}
	},

	update : function() {
		this.checkWidget();
		if (this.domref == null) {
			this._create();
		}

		// update table head
		while (this._theadRow.childNodes.length) {
			this._theadRow.removeChild(this._theadRow.childNodes[0]);
		}
		if ((this._style & JSWT.CHECK) == JSWT.CHECK) {
			var checkboxCol = document.createElement("th");
			checkboxCol.innerHTML = "&nbsp;"; // for IE6
			checkboxCol.className = "jsWTTableCheckboxCol";
			this._theadRow.appendChild(checkboxCol);
		}
		for (var i = 0, len = this._columnOrder.length; i < len; ++i) {
			//this._columns[this._columnOrder[i]]._setParentNode(this._theadRow);
			this._columns[this._columnOrder[i]].update();
			this._theadRow.appendChild(this._columns[this._columnOrder[i]].domref);
		}

		if (this._headerVisible) {
			this._thead.style.display = document.all ? "block" : "table-row-group";
		} else {
			this._thead.style.display = "none";
		}
		
		this._tbody.className = "";
		this.removeClassName("jsWTTableNoLines");
		this.removeClassName("jsWTTableLines");
		this.addClassName("jsWTTable" + (this._linesVisible ? "" : "No") + "Lines");
		
		if ((this._style & JSWT.FULL_SELECTION) == JSWT.FULL_SELECTION) {
			this._tbody.className = "jsWTTableFullSelection";
		}
		
		this.domref.className = this._className;

		// update items
		this._updateItems();

		// reset measurement for new calculations
		this.domref.style.height = "auto";
		this._thead.style.height = "auto";
		this._tbody.style.height = "auto";
		this._tbodyPadding.style.display = "none";
		if (this._tbody.clientHeight + this._thead.clientHeight > this._height) {
			this._tbody.style.height = this._height - this._thead.clientHeight + "px";
		} else if (this._tbody.clientHeight + this._thead.clientHeight < this._height) {
			this._tbodyPadding.style.display = document.all ? "block" : "table-row-group";
			this._tbodyPadding.style.height = this._height - (this._tbody.clientHeight + this._thead.clientHeight) + "px";
			this._paddingFiller.style.height = this._height - (this._tbody.clientHeight + this._thead.clientHeight) + "px";
			this._paddingFiller.style.visibility = "hidden";
			this._paddingFiller.colspan = this._columns.length;
		} else {
			this._tbody.style.height = "auto";
		}
		
		this.domref.style.width = this._width != null ? this._width + "px" : "";
		this.domref.style.height = this._height != null ? this._height + "px" : "";
	},
	
	_updateItems : function() {
		this._items.forEach(function(item, index, arr) {
			item._setParentNode(this._tbody);
			item.update();
		}, this);
	}
});
/*	$Id: Item.class.js 163 2008-11-01 17:17:05Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * 'Abstract' Item class
 * @class Item
 * @author Thomas Gossmann
 * @extends gara.jswt.Widget
 * @namespace gara.jswt
 */
$class("Item", {
	$extends : gara.jswt.Widget,

	/**
	 * @constructor
	 * Constructor of gara.jswt.Item
	 * 
	 * @author Thomas Gossmann
	 * @return {gara.jswt.Item}
	 */
	$constructor : function(parent, style) {
		this.$base(parent, style);
		this._changed = false;
		this._image = null;
		this._text = "";
	},

	/**
	 * @method
	 * Returns the items image
	 * 
	 * @author Thomas Gossmann
	 * @return {Image} the items image
	 */
	getImage : function() {
		return this._image;
	},
	
	/**
	 * @method
	 * Returns the items text
	 * 
	 * @author Thomas Gossmann
	 * @return {String} the text for this item
	 */
	getText : function() {
		return this._text;
	},
	
	/**
	 * @method
	 * Tells wether there is new data available since last question.
	 * 
	 * @author Thomas Gossmann
	 * @return {boolean} true if data changed, false if not
	 */
	hasChanged : function() {
		return this._changed;
	},
	
	/**
	 * @method
	 * Tells wether the item is created or not
	 * 
	 * @author Thomas Gossmann
	 * @return {boolean} true if the item is created or false if not
	 */
	isCreated : function() {
		return this.domref != null;
	},
	
	/**
	 * @method
	 * Reset the change notification buffer to recognize new changes. 
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	releaseChange : function() {
		this._changed = false;
	},

	/**
	 * @method
	 * Sets the item active or inactive
	 * 
	 * @author Thomas Gossmann
	 * @param {boolean} active true for active and false for inactive
	 * @return {void}
	 */
	setActive : function(active) {
		this._active = active;
		if (active) {
			this.addClassName("active");
		} else {
			this.removeClassName("active");
		}
		this._changed = true;
	},

	/**
	 * @method
	 * Sets the image for the item
	 * 
	 * @author Thomas Gossmann
	 * @param {Image} image the new image
	 * @throws {TypeError} when image is not instance of Image
	 * @return {void}
	 */
	setImage : function(image) {
//		if(!$class.instanceOf(image, Image)) {
//			throw new TypeError("image not instance of Image");
//		}
		
		this._image = image;
		this._changed = true;
	},

	/**
	 * @method
	 * Sets the text for the item
	 * 
	 * @author Thomas Gossmann
	 * @param {String} text the new text
	 * @return {void}
	 */
	setText : function(text) {
		this._text = text;
		this._changed = true;
	},

	toString : function() {
		return "[gara.jswt.Item]";
	}
});
/*	$Id: ListItem.class.js 176 2008-11-22 01:27:51Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @summary
 * gara ListItem for List Widget
 * 
 * @description
 * 
 * @class ListItem
 * @author Thomas Gossmann
 * @namespace gara.jswt
 * @extends gara.jswt.Item
 */
$class("ListItem", {
	$extends : gara.jswt.Item,

	/**
	 * @constructor
	 * Constructor
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.List} parent the List Widget for this item
	 * @param {int} style the style for this item
	 * @param {int} index index to insert the item at
	 * @throws {TypeError} if the list is not a List widget
	 * @return {gara.jswt.ListItem}
	 */
	$constructor : function(parent, style, index) {
		if (!$class.instanceOf(parent, gara.jswt.List)) {
			throw new TypeError("parent is not type of gara.jswt.List");
		}
		this.$base(parent, style);
		this._parent = parent;
		this._list = parent;
		this._list._addItem(this, index);

		// dom references
		this._span = null;
		this._spanText = null;
		this._img = null;
		this._checkbox = null;

		this._selected = false;
		this._grayed = false;
		this._checked = false;
	},

	/**
	 * @method
	 * Internal creation process of this item
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_create : function() {
		this.domref = document.createElement("li");
		this.domref.className = this._className;
		this.domref.obj = this;
		this.domref.control = this._list;

		this._checkbox = document.createElement("input");
		this._checkbox.type = "checkbox";
		this._checkbox.obj = this;
		this._checkbox.control = this._list;
		this._checkbox.style.display = "none";
		if (this._grayed) {
			this._checkbox.disabled = true;
		}
		if (this._checked) {
			this._checkbox.checked = true;
		}
		if ((this._list.getStyle() & JSWT.CHECK) == JSWT.CHECK) {
			this._checkbox.style.display = "inline";
		}
		
		this.domref.appendChild(this._checkbox);

		// create item nodes
		this._img = null;

		// set image
		if (this._image != null) {
			this._img = document.createElement("img");
			this._img.obj = this;
			this._img.control = this._list;
			this._img.src = this._image.src;

			// put the image into the dom
			this.domref.appendChild(this._img);
			base2.DOM.EventTarget(this._img);
		}

		this._spanText = document.createTextNode(this._text);
		
		this._span = document.createElement("span");
		this._span.obj = this;
		this._span.control = this._list;
		this._span.appendChild(this._spanText);
		this.domref.appendChild(this._span);
		
		base2.DOM.EventTarget(this.domref);
		base2.DOM.EventTarget(this._checkbox);
		base2.DOM.EventTarget(this._span);
		
		gara.EventManager.addListener(this._checkbox, "mousedown", this);
		gara.EventManager.addListener(this._checkbox, "keydown", this);

		// register listener
		for (var eventType in this._listener) {
			this._listener[eventType].forEach(function(elem, index, arr) {
				this._registerListener(eventType, elem);
			}, this);
		}
		
		var items = this._list.getItems();
		var index = items.indexOf(this);
		var nextNode = index == 0 
			? this._parentNode.firstChild
			: items[index - 1].domref.nextSibling;

		if (!nextNode) {
			this._parentNode.appendChild(this.domref);					
		} else {
			this._parentNode.insertBefore(this.domref, nextNode);
		}
	},
	
	dispose : function() {
		this.$base();

		if (this._img != null) {
			this.domref.removeChild(this._img);
			delete this._img;
			this._image = null;
		}

		this.domref.removeChild(this._span);

		if (this._parentNode != null) {
			this._parentNode.removeChild(this.domref);
		}

		delete this._span;
		delete this.domref;
	},

	getChecked : function() {
		this.checkWidget();
		this._checked = this._checkbox.checked;
		return this._checked;
	},

	getGrayed : function() {
		this.checkWidget();
		return this._grayed;
	},

	/**
	 * @method
	 * Event handler for this item. Its main use is to pass through keyboard events
	 * to all listeners.
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {Event} e DOMEvent
	 * @return {void} 
	 */
	handleEvent : function(e) {
		this.checkWidget();
		
		if (e.target == this._checkbox
				&& (e.type == "mousedown"
					|| e.type == "keydown" && e.keyCode == 32)) {
			e.garaDetail = gara.jswt.JSWT.CHECK;
		}

		switch (e.type) {
			case "keyup":
			case "keydown":
			case "keypress":
				this._notifyExternalKeyboardListener(e, this, this._list);
				break;
		}
	},

	/**
	 * @method
	 * Register listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_registerListener : function(eventType, listener) {
		if (this._img != null) {
			gara.EventManager.addListener(this._img, eventType, listener);
		}

		if (this._span != null) {
			gara.EventManager.addListener(this._span, eventType, listener);
		}
	},
	
	setChecked : function(checked) {
		if (!this._grayed) {
			this._checked = checked;
			if (this._checked) {
				this._checkbox.checked = true;
			} else {
				this._checkbox.checked = false;
			}
		}
	},
	
	setGrayed : function(grayed) {
		this._grayed = grayed;
		if (this._grayed) {
			this._checkbox.disabled = true;
		} else {
			this._checkbox.disabled = false;
		}
	},
	
	_setSelected : function(selected) {
		this.checkWidget();
		this._selected = selected;
	},
	
	toString : function() {
		return "[gara.jswt.ListItem]";
	},
	
	/**
	 * @method
	 * Unregister listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_unregisterListener : function(eventType, listener) {
		if (this._img != null) {
			gara.EventManager.removeListener(this._img, eventType, listener);
		}

		if (this._span != null) {
			gara.EventManager.removeListener(this._span, eventType, listener);
		}
	},

	/**
	 * @method
	 * Updates the list item
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	update : function() {
		this.checkWidget();
		
		if (this.domref == null) {
			this._create();
		} else {
			// create image
			if (this._image != null && this._img == null) {
				this._img = document.createElement("img");
				this._img.obj = this;
				this._img.control = this._list;
				this._img.alt = this._text;
				this._img.src = this._image.src;
				this.domref.insertBefore(this._img, this._span);
				base2.DOM.EventTarget(this._img);
				
				// event listener
				for (var eventType in this._listener) {
					this._listener[eventType].forEach(function(elem, index, arr){
						this.registerListener(this._img, eventType, elem);
					}, this);
				}
			}
			
			// simply update image information
			else if (this._image != null) {
				this._img.src = this._image.src;
				this._img.alt = this._text;
			}
				
			// delete image
			else if (this._img != null && this._image == null) {
				this.domref.removeChild(this._img);
				this._img = null;
				
				// event listener
				for (var eventType in this._listener) {
					this._listener[eventType].forEach(function(elem, index, arr){
						gara.EventManager.removeListener(this._img, eventType, elem);
					}, this);
				}
			}
			
			if ((this._list.getStyle() & JSWT.CHECK) == JSWT.CHECK) {
				this._checkbox.style.display = "inline";
			} else {
				this._checkbox.style.display = "none";
			}
			
			this._spanText.nodeValue = this._text;
		}
		
		this.removeClassName("selected");

		if (this._selected) {
			this.addClassName("selected");
		}		
		this.domref.className = this._className;
		this.releaseChange();
	}
});
/*	$Id: TreeItem.class.js 176 2008-11-22 01:27:51Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * gara TreeItem
 * 
 * @class TreeItem
 * @author Thomas Gossmann
 * @namespace gara.jswt
 * @extends gara.jswt.Item
 */
$class("TreeItem", {
	$extends : gara.jswt.Item,
	
	toggleNode : null,

	$constructor : function(parent, style, index) {
		
		if (!($class.instanceOf(parent, gara.jswt.Tree) || $class.instanceOf(parent, gara.jswt.TreeItem))) {
			throw new TypeError("parent is neither a gara.jswt.Tree or gara.jswt.TreeItem");
		}
		
		this.$base(parent, style);

		this._images = [];
		this._texts = [];

		this._items = new Array();
		this._expanded = true;
		this._checked = false;
		this._grayed = false;
		this._selected = false;
		this._changed = false;
		this._parent = parent;
		this._tree = null;

		if ($class.instanceOf(parent, gara.jswt.Tree)) {
			this._tree = parent;
		} else if ($class.instanceOf(parent, gara.jswt.TreeItem)) {
			this._tree = parent.getParent();
			parent._addItem(this, index);
		}
		this._tree._addItem(this, index);

		// domNode references
		this._img = null;
		this._span = null;
		this._spanText = null;
		this._toggleNode = null;
		this._childContainer = null;
		this._checkbox = null;
	},

	/**
	 * @method
	 * Adds an item to this item
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TreeItem} item the item to be added
	 * @throws {TypeError} when the item is not type of a TreeItem
	 * @return {void}
	 */
	_addItem : function(item, index) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TreeItem)) {
			throw new TypeError("item is not type of gara.jswt.TreeItem");
		}

		if (typeof(index) != "undefined") {
			this._items.insertAt(index, item);
		} else {
			this._items.push(item);
		}
		
		this._changed = true;
	},

	/**
	 * Internal method for creating a node representing an item. This is used for
	 * creating a new item or put updated content to an existing node of an earlier
	 * painted item.
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {boolean} wether this item is at the bottom position or not
	 * @return {void}
	 */
	_create : function() {
		/*
		 * DOM of created item:
		 * 
		 * <li>
		 *  <span class="toggler [togglerExpanded] [togglerCollapsed]"></span>
		 *  [<img src=""/>]
		 *  <span class="text"></span>
		 * </li>
		 */

		if ($class.instanceOf(this._parent, gara.jswt.Tree)) {
			this._parentNode = this._parent.domref;
		} else if ($class.instanceOf(this._parent, gara.jswt.TreeItem)) {
			this._parentNode = this._parent._getChildContainer();
		}

		var parentItems = this._parent.getItems();

		this.removeClassName("bottom");
		if (parentItems.indexOf(this) == parentItems.length - 1) {
			// if bottom
			this.addClassName("bottom");
		}

		// create item node
		this.domref = document.createElement("li");
		this.domref.className = this._className;
		this.domref.obj = this;
		this.domref.control = this._tree;
		base2.DOM.EventTarget(this.domref);

		// toggler
		this._toggleNode = document.createElement("span");
		this._toggleNode.obj = this;
		this._toggleNode.control = this._tree;
		base2.DOM.EventTarget(this._toggleNode);
				
		// set this.toggler
		this._toggleNode.className = "toggler";
		this._toggleNode.className += this._hasChilds() 
			? (this._expanded
				? " togglerExpanded"
				: " togglerCollapsed")
			: "";
		this.domref.appendChild(this._toggleNode);

		// checkbox
		this._checkbox = document.createElement("input");
		this._checkbox.type = "checkbox";
		this._checkbox.obj = this;
		this._checkbox.control = this._list;
		this._checkbox.style.display = "none";
		if (this._grayed) {
			this._checkbox.disabled = true;
		}
		if (this._checked) {
			this._checkbox.checked = true;
		}
		if ((this._tree.getStyle() & JSWT.CHECK) == JSWT.CHECK) {
			this._checkbox.style.display = "inline";
		}
		base2.DOM.EventTarget(this._checkbox);
		gara.EventManager.addListener(this._checkbox, "mousedown", this);
		gara.EventManager.addListener(this._checkbox, "keydown", this);
		
		this.domref.appendChild(this._checkbox);


		// set image
		if (this.getImage() != null) {
			this._img = document.createElement("img");
			this._img.obj = this;
			this._img.src = this.getImage().src;
			this._img.control = this._tree;
			base2.DOM.EventTarget(this._img);
	
			// put the image into the dom
			this.domref.appendChild(this._img);
		}

		// span and text
		this._span = document.createElement("span");
		this._span.obj = this;
		this._span.control = this._tree;
		this._span.className = "text";
		this._spanText = document.createTextNode(this.getText());
		this._span.appendChild(this._spanText);
		base2.DOM.EventTarget(this._span);

		this.domref.appendChild(this._span);
	
		// if childs are available, create container for them
		if (this._hasChilds()) {
			this._createChildContainer();
		}

		/* register user-defined listeners */
		for (var eventType in this._listeners) {
			this._listeners[eventType].forEach(function(elem, index, arr) {
				this._registerListener(eventType, elem);
			}, this);
		}
		
		this._parentNode.appendChild(this.domref);
	},

	/**
	 * @method
	 * Create container for items
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_createChildContainer : function() {
		this.checkWidget();
		this._childContainer = document.createElement('ul');
		base2.DOM.EventTarget(this._childContainer);
	
		if (this.getClassName().indexOf("bottom") != -1) { // bottom
			this._childContainer.className = "bottom";
		}
	
		if (this._expanded) {
			this._childContainer.style.display = "block";
		} else {
			this._childContainer.style.display = "none";
		}
		
		this.domref.appendChild(this._childContainer);
	},

	/**
	 * @method
	 * Deselect all child items
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_deselectItems : function() {
		this.checkWidget();
		this._items.forEach(function(child, index, arr) {
			if (child._hasChilds()) {
				child._deselectItems();
			}
			this._tree._deselect(child);
		}, this);
	},
	
	dispose : function() {
		this.$base();

		if (this._childContainer != null) {
			this._items.forEach(function(item, index, arr){
				item.dispose();
			}, this);

			this.domref.removeChild(this._childContainer);
			delete this._childContainer;
		}

		if (this._img != null) {
			this.domref.removeChild(this._img);
			delete this._img;
			this._image = null;
		}

		
		this.domref.removeChild(this._toggleNode);
		this.domref.removeChild(this._span);

		if (this._parentNode != null) {
			this._parentNode.removeChild(this.domref);
		}

		delete this._toggleNode;
		delete this._span;
		delete this._spanText;
		delete this.domref;
	},

	/**
	 * @method
	 * Returns the child container
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {HTMLElement} the child container
	 */
	_getChildContainer : function() {
		if (this._childContainer == null) {
			this._createChildContainer();
		}
		return this._childContainer;
	},
	
	/**
	 * @method
	 * Returns the checked state for this item
	 * 
	 * @author Thomas Gossmann
	 * @return {boolean} the checked state
	 */
	getChecked : function() {
		this.checkWidget();
		this._checked = this._checkbox.checked;
		return this._checked;
	},

	/**
	 * @method
	 * Returns the expanded state for this item
	 * 
	 * @author Thomas Gossmann
	 * @return {boolean} the expanded state
	 */
	getExpanded : function() {
		this.checkWidget();
		return this._expanded;
	},

	getGrayed : function() {
		this.checkWidget();
		return this._grayed;
	},

	getImage : function(columnIndex) {
		this.checkWidget();
		if (typeof(columnIndex) == "undefined")
			columnIndex = 0;
		return this._images[columnIndex];
	},

	/**
	 * @method
	 * Returns a specifiy item with a zero-related index
	 * 
	 * @author Thomas Gossmann
	 * @param {int} index the zero-related index
	 * @throws {OutOfBoundsException} if the index does not live within this tree
	 * @return {gara.jswt.TreeItem} the item
	 */
	getItem : function(index) {
		this.checkWidget();
		if (index >= this._items.length) {
			throw new gara.OutOfBoundsException("Your item lives outside of this Tree");
		}
	
		return this._items[index];
	},

	/**
	 * @method
	 * Returns the amount of the items in the tree
	 * 
	 * @author Thomas Gossmann
	 * @return {int} the amount
	 */
	getItemCount : function() {
		return this._items.length;
	},

	/**
	 * @method
	 * Returns an array with all the items in the tree
	 * 
	 * @author Thomas Gossmann
	 * @return {gara.jswt.TreeItem[]} an array with the items
	 */
	getItems : function() {
		return this._items;
	},

	/**
	 * @method
	 * Returns the widgets parent, which must be a <tt>Tree</tt>
	 * 
	 * @author Thomas Gossmann
	 * @return {gara.jswt.Tree} the parent of this widget
	 */
	getParent : function() {
		return this._tree;
	},

	/**
	 * @method
	 * Returns the item's parent item, which must be a <tt>TreeItem</tt> or null when the item is a root.
	 * 
	 * @author Thomas Gossmann
	 * @return {gara.jswt.TreeItem} the parent item
	 */
	getParentItem : function() {
		if (this._parent == this._tree) {
			return null;
		} else {
			return this._parent;
		}
	},

	getText : function(columnIndex) {
		this.checkWidget();
		if (typeof(columnIndex) == "undefined")
			columnIndex = 0;
		return this._texts[columnIndex];
	},

	/**
	 * @method
	 * Returns wether there are items or not
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {boolean} true wether there are items or false if there are non
	 */
	_hasChilds : function() {
		return this._items.length > 0;
	},

	/**
	 * @method
	 * Internal event handler
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {Event} e W3C event
	 * @return {void}
	 */
	handleEvent : function(e) {
		this.checkWidget();

		if (e.target == this._checkbox
				&& (e.type == "mousedown"
					|| e.type == "keydown" && e.keyCode == 32)) {
			e.garaDetail = gara.jswt.JSWT.CHECK;
		}
		var obj = e.target.obj || null;

		switch (e.type) {
			case "mousedown":
				if ($class.instanceOf(obj, gara.jswt.TreeItem)) {
					var item = obj;

					if (e.target == this._toggleNode) {
						if (this._expanded) {
							this.setExpanded(false);
						} else {
							this.setExpanded(true);
						}
						this._tree.update();
					}
				}
				break;

			case "dblclick":
				/*if ($class.instanceOf(obj, gara.jswt.TreeItem)) {
					var item = obj;

					// toggle childs
					if (e.target != this._toggleNode) {
						if (this._expanded) {
							this.setExpanded(false);
						} else {
							this.setExpanded(true);
						}

						this._tree.update();
					}
				}*/
				break;
				
			case "keyup":
			case "keydown":
			case "keypress":
				this._notifyExternalKeyboardListener(e, this, this._tree);
				break;
		}
	},

	/**
	 * @method
	 * Looks for the index of a specified item
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TreeItem} item the item for the index
	 * @throws {gara.jswt.ItemNotExistsException} if the item does not exist in this tree
	 * @throws {TypeError} if the item is not a TreeItem
	 * @return {int} the index of the specified item
	 */
	indexOf : function(item) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.TreeItem)) {
			throw new TypeError("item not instance of gara.jswt.TreeItem");
		}

		if (!this._items.contains(item)) {
			throw new gara.jswt.ItemNotExistsException("item [" + item + "] does not exists in this list");
			return;
		}

		return this._items.indexOf(item);
	},

	/**
	 * @method
	 * Registers Listener for this widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {String} eventType the event type
	 * @param {Object} listener the listener
	 * @return {void}
	 */
	_registerListener : function(eventType, listener) {
		if (this._img != null) {
			gara.EventManager.addListener(this._img, eventType, listener);
		}
	
		if (this._span != null) {
			gara.EventManager.addListener(this._span, eventType, listener);
		}
	},
	
	/**
	 * @method
	 * Removes an item from the tree-item
	 * 
	 * @author Thomas Gossmann
	 * @param {int} index the index of the item
	 * @return {void}
	 */
	remove : function(index) {
		this.checkWidget();
		var item = this._items.removeAt(index)[0];
		this._tree._removeItem(item);		

		if (!item.isDisposed()) {
			item.dispose();
		}
		delete item;
	},

	/**
	 * @method
	 * Removes items within an indices range
	 * 
	 * @author Thomas Gossmann
	 * @param {int} start start index
	 * @param {int} end end index
	 * @return {void}
	 */
	removeRange : function(start, end) {
		this.checkWidget();
		for (var i = start; i <= end; ++i) {
			this.remove(i);
		}
	},

	/**
	 * @method
	 * Removes items which indices are passed by an array
	 * 
	 * @author Thomas Gossmann
	 * @param {Array} inidices the array with the indices
	 * @return {void}
	 */
	removeFromArray : function(indices) {
		this.checkWidget();
		indices.forEach(function(item, index, arr) {
			this.remove(index);
		}, this);
	},

	/**
	 * @method
	 * Removes all items from the tree-item
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	removeAll : function() {
		this.checkWidget();
		while (this._items.length) {
			var item = this._items.pop();
			this.domref.removeChild(item.domref);
			delete item;
		}
	},

	/**
	 * Sets the item active or inactive
	 * 
	 * @author Thomas Gossmann
	 * @param {boolean} active true for active and false for inactive
	 * @return {void}
	 */
	setActive : function(active) {
		this.checkWidget();
		this._active = active;
	},

	/**
	 * @method
	 * Sets the checked state for this item
	 * 
	 * @author Thomas Gossmann
	 * @param {boolean} checked the new checked state
	 * @return {void}
	 */
	setChecked : function(checked) {
		if (!this._grayed) {
			this._checked = checked;
			if (this._checked) {
				this._checkbox.checked = true;
			} else {
				this._checkbox.checked = false;
			}
		}
	},

	/**
	 * @method
	 * Sets a new expanded state for the item
	 * 
	 * @author Thomas Gossmann
	 * @param {boolean} expanded the new expanded state
	 * @return {void}
	 */
	setExpanded : function(expanded) {
		this.checkWidget();
		this._expanded = expanded;

		if (!expanded) {
			this._deselectItems();
		}
		
		this._changed = true;
	},
	
	setGrayed : function(grayed) {
		this._grayed = grayed;
		if (this._grayed) {
			this._checkbox.disabled = true;
		} else {
			this._checkbox.disabled = false;
		}
	},
	
	setImage : function(columnIndex, image) {
		if (typeof(image) == "undefined") {
			image = columnIndex;
			columnIndex = 0;
		}
		
		this._images[columnIndex] = image;
	},
	
	_setSelected : function(selected) {
		this.checkWidget();
		this._selected = selected;
	},
	
	setText : function(columnIndex, text) {
		if (typeof(columnIndex) == "string") {
			text = columnIndex;
			columnIndex = 0;
		}
		
		this._texts[columnIndex] = text;
	},
	
	toString : function() {
		return "[gara.jswt.TreeItem]";
	},
	
	/**
	 * @method
	 * Unregister listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_unregisterListener : function(eventType, listener) {
		if (this._img != null) {
			gara.EventManager.removeListener(this._img, eventType, listener);
		}
	
		if (this._span != null) {
			gara.EventManager.removeListener(this._span, eventType, listener);
		}
	},
	
	/**
	 * @method
	 * Updates this item
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	update : function() {
		this.checkWidget();
		
		if (this.domref == null) {
			this._create();
		} else if (this.hasChanged()) {
			if (this._hasChilds()) {
				this._toggleNode.className = strReplace(this._toggleNode.className, " togglerCollapsed", "");
				this._toggleNode.className = strReplace(this._toggleNode.className, " togglerExpanded", "");
				
				if (this._expanded) {
					this._toggleNode.className += " togglerExpanded";
				}
				else {
					this._toggleNode.className += " togglerCollapsed";
				}
			} else if (!this._hasChilds() && this._childContainer != null) {
				this._toggleNode.className = "toggler";
			}

			// create image
			if (this.getImage() != null && this._img == null) {
				this._img = document.createElement("img");
				this._img.obj = this;
				this._img.control = this._tree;
				this._img.alt = this.getText();
				this._img.src = this.getImage().src;
				this.domref.insertBefore(this._img, this._span);
				base2.DOM.EventTarget(this._img);
			}

			// update image information
			else if (this.getImage() != null) {
				this._img.src = this.getImage().src;
				this._img.alt = this._text;
			}

			// delete image
			else if (this._img != null && this.getImage() == null) {
				this.domref.removeChild(this._img);
				this._img = null;
			}

			// if childs are available, create container for them
			if (this._hasChilds() && this._childContainer == null) {
				this._createChildContainer();
			}

			// update expanded state
			if (this._childContainer != null) {
				if (this._expanded) {
					this._childContainer.style.display = "block";
				} else {
					this._childContainer.style.display = "none";
				}
			}
			// delete childContainer
			else if (!this._hasChilds() && this._childContainer != null) {
				this.domref.removeChild(this._childContainer);
				this._childContainer = null;
			}

			// check for bottom style
			var parentItems = this._parent.getItems();
			this.removeClassName("bottom");
			if (parentItems.indexOf(this) == parentItems.length - 1) {
				// if bottom
				this.addClassName("bottom");
			}

			if ((this._tree.getStyle() & JSWT.CHECK) == JSWT.CHECK) {
				this._checkbox.style.display = "inline";
			} else {
				this._checkbox.style.display = "none";
			}

			this._spanText.nodeValue = this.getText();
			this.domref.className = this._className;

			this.releaseChange();
		}

		if (this._selected) {
			this._span.className = "text selected";
		} else {
			this._span.className = "text";
		}

		if (this._active) {
			this._span.className += " active";
		} else {
			this._span.className = this._span.className.replace(/ *active/, "");
		}
		
		// update items
		this._items.forEach(function(item, index, arr) {
			if (item.isDisposed()) {
				this.remove(index);
			} else {
				item.update();
			}
		}, this);
	}
});
/*	$Id: TabItem.class.js 171 2008-11-14 15:58:31Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * gara TreeItem
 * 
 * @class TabItem
 * @author Thomas Gossmann
 * @namespace gara.jswt
 * @extends gara.jswt.Item
 */
$class("TabItem", {
	$extends : gara.jswt.Item,

	$constructor : function(parent, style) {

		if (!$class.instanceOf(parent, gara.jswt.TabFolder)) {
			throw new TypeError("parentWidget is neither a gara.jswt.TabFolder");
		}
		
		this.$base(parent, style);

		this._active = false;
		this._content = null;
		this._control = null;
		
		this._clientArea = null;
		this._clientContent = null;
		this._clientAppended = false;

		this._toolTipText = null;
		this._span = null;
		this._img = null;

		this._parent._addItem(this);
	},

	/**
	 * @method
	 * Contstructs the dom for this tabitem
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {HTMLElement} the created node
	 */
	_create : function() {
		this.domref = document.createElement("li");
		this.domref.className = this._className;
		this.domref.obj = this;
		this.domref.control = this._parent;
		if (this._toolTipText != null) {
			this.domref.title = this._toolTipText;
		}
		base2.DOM.EventTarget(this.domref);

		// set image
		if (this._image != null) {
			this._img = document.createElement("img");
			this._img.obj = this;
			this._img.control = this._parent;
			this._img.src = this._image.src;
			this._img.alt = this._text;
			base2.DOM.EventTarget(this._img);

			// put the image into the dom
			this.domref.appendChild(this._img);
		}

		this._spanText = document.createTextNode(this._text);

		this._span = document.createElement("span");
		this._span.obj = this;
		this._span.control = this._parent;
		this._span.appendChild(this._spanText);
		this.domref.appendChild(this._span);
		base2.DOM.EventTarget(this._span);
		
		this._clientContent = document.createElement("div");
		this._clientContent.style.display = "none";
		if(this._control != null) {
			this._control.update();
			this._clientContent.appendChild(this._control.domref);
		} else {
			if (typeof(this._content) == "string") {
				this._clientContent.appendChild(document.createTextNode(this._content));
			} else {
				this._clientContent.appendChild(this._content);
			}
		}
		if (this._clientArea != null) {
			this._clientArea.appendChild(this._clientContent);
			this._clientAppended = true;
		}

		// register listener
		for (var eventType in this._listener) {
			this._listener[eventType].forEach(function(elem, index, arr) {
				this.registerListener(eventType, elem);
			}, this);
		}
		this._changed = false;
		return this.domref;
	},
	
	dispose : function() {
		this.$base();

		if (this._img != null) {
			this.domref.removeChild(this._img);
			delete this._img;
			this._image = null;
		}

		this.domref.removeChild(this._span);

		if (this._parentNode != null) {
			this._parentNode.removeChild(this.domref);
		}

		if (this._control != null) {
			this._control.dispose();
		}
		
		delete this._span;
		delete this.domref;
	},

	/**
	 * @method
	 * Returns the content for this item
	 * 
	 * @author Thomas Gossmann
	 * @return {string} the content;
	 */
	getContent : function() {
		this.checkWidget();
		return this._content;
	},

	/**
	 * @method
	 * Returns the content control for this item
	 * 
	 * @author Thomas Gossmann
	 * @return {gara.jswt.Control} the control
	 */
	getControl : function() {
		this.checkWidget();
		return this._control;
	},

	/**
	 * @method
	 * Returns the tooltip text for this item
	 * 
	 * @author Thomas Gossmann
	 * @return {string} the tooltip text 
	 */
	getToolTipText : function() {
		this.checkWidget();
		return this._toolTipText;
	},

	/**
	 * @method
	 * Event handler for this item. Its main use is to pass through keyboard events
	 * to all listeners.
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {Event} e DOMEvent
	 * @return {void} 
	 */
	handleEvent : function(e) {
		this.checkWidget();
		
		switch (e.type) {
			
			case "keyup":
			case "keydown":
			case "keypress":
			
				this._notifyExternalKeyboardListener(e, this, this._parent);
				break;
		}
	},

	/**
	 * @method
	 * Widget implementation to register listener
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_registerListener : function() {
		if (this.domref != null) {
			gara.EventManager.addListener(this.domref, eventType, listener);
		}
	},

	/**
	 * @method
	 * Set a new active state for this item
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {boolean} the new active state
	 * @return {void}
	 */
	_setActive : function(active) {
		this.checkWidget();
		this._active = active;

		if (active) {
			this._className += " active";
		} else {
			this._className = this._className.replace(/ *active/, "");
		}

		this._changed = true;
	},
	
	_setClientArea : function(clientArea) {
		this._clientArea = clientArea;
	},

	/**
	 * @method
	 * Sets content for this item that appears in the client area of the TabFolder when 
	 * this item is activated. Use EITHER setContent OR setControl!
	 * 
	 * @author Thomas Gossmann
	 * @param {string} content the content
	 * @return {void}
	 */
	setContent : function(content) {
		this.checkWidget();
		this._content = content;
		this._changed = true;
	},

	/**
	 * @method
	 * Sets a control for that appears in the client area of the TabFolder when this item is activated
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.Control} control the control
	 * @throws {TypeError} when that is not a gara.jswt.Control
	 * @return {void} 
	 */
	setControl : function(control) {
		this.checkWidget();
		if (!$class.instanceOf(control, gara.jswt.Control)) {
			throw new TypeError("control is not instance of gara.jswt.Control");
		}

		this._control = control;
	},

	/**
	 * @method
	 * Sets the ToolTip text for this item
	 * 
	 * @author Thomas Gossmann
	 * @param {string} text the tooltip text
	 * @return {void}
	 */
	setToolTipText : function(text) {
		this._toolTipText = text;
		this._changed = true;
	},
	
	toString : function() {
		return "[gara.jswt.TabItem]";
	},

	/**
	 * @method
	 * Unregister listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_unregisterListener : function(eventType, listener) {
		if (this.domref != null) {
			gara.EventManager.removeListener(this.domref, eventType, listener);
		}
	},

	/**
	 * @method
	 * Update this item
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	update : function() {
		this.checkWidget();
		// create image
		if (this._image != null && this._img == null) {
			this._img = document.createElement("img");
			this._img.obj = this;
			this._img.control = this._parent;
			this._img.alt = this._text;
			this._img.src = this._image.src;
			this.domref.insertBefore(this._img, this._span);
			base2.DOM.EventTarget(this._img);
			
			// event listener
			for (var eventType in this._listener) {
				this._listener[eventType].forEach(function(elem, index, arr) {
					this.registerListener(this._img, eventType, elem);
				}, this);
			}
		}

		// simply update image information
		else if (this._image != null) {
			this._img.src = this._image.src;
			this._img.alt = this._text;
		}

		// delete image
		else if (this._img != null && this._image == null) {
			this.domref.removeChild(this._img);
			this._img = null;

			// event listener
			for (var eventType in this._listener) {
				this._listener[eventType].forEach(function(elem, index, arr) {
					gara.EventManager.removeListener(this._img, eventType, elem);
				}, this);
			}
		}
		
		if (this._clientArea != null && !this._clientAppended) {
			this._clientArea.appendChild(this._clientContent);
			this._clientAppended = true;
		}
		
		if (this._active) {
			this._clientContent.style.display = "block";
		} else {
			this._clientContent.style.display = "none";
		}

		this._spanText.nodeValue = this._text;
		this.domref.className = this._className;
		
		if (this._toolTipText != null) {
			this.domref.title = this._toolTipText;
		}
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

function getStyle(el, styleProp, ieStyleProp)
{
	var x = el;
	if (x.currentStyle)
		var y = x.currentStyle[ieStyleProp];
	else if (window.getComputedStyle)
		var y = document.defaultView.getComputedStyle(x,null).getPropertyValue(styleProp);
	return y;
}

/**
 * gara TableColumn
 * 
 * @class TableColumn
 * @author Thomas Gossmann
 * @namespace gara.jswt
 * @extends gara.jswt.Item
 */
$class("TableColumn", {
	$extends : gara.jswt.Item,

	$constructor : function(parent, style, index) {
		
		if (!$class.instanceOf(parent, gara.jswt.Table)) {
			throw new TypeError("parent is not a gara.jswt.Table");
		}

		this.$base(parent, style);

		this._table = parent;
		this._table._addColumn(this, index);
		this._shadow = null;

		this._width = null;
		this._img = null;
		this._span = null;
		this._spanText = null
		this._operator = null;
		
		this._moveable = true;
		this._resizable = true;
		
		this._isMoving = false;
		this._isResizing = false;
	},

	_create : function() {
		this.domref = document.createElement("th");
		this.domref.obj = this;
		this.domref.control = this._table;

		if (this._image != null) {
			this._img = document.createElement("img");
			this._img.obj = this;
			this._img.control = this._table;
			this._img.src = this._image.src;
			base2.DOM.EventTarget(this._img);

			this.domref.appendChild(this._img);
		}

		this._operator = document.createElement("span");
		this._operator.className = "mover";
		this._operator.obj = this;
		this._operator.control = this._table;
		this.domref.appendChild(this._operator);

		this._span = document.createElement("span");
		this._span.obj = this;
		this._span.control = this._table;
		this._span.className = "text";
		this._spanText = document.createTextNode(this._text);
		this._span.appendChild(this._spanText);
		this.domref.appendChild(this._span);

		base2.DOM.EventTarget(this.domref);		
		base2.DOM.EventTarget(this._operator);
		base2.DOM.EventTarget(this._span);

		if (this._parentNode != null) {
			this._parentNode.appendChild(this.domref);
		}
	},

	_computeWidth : function() {
		this.checkWidget();
		if (this.domref != null && this.domref.style.display != "none") {
			var paddingLeft = getStyle(this.domref, "padding-left", "paddingLeft");
			var paddingRight = getStyle(this.domref, "padding-right", "paddingRight");
			this._width = this.domref.clientWidth - parseInt(paddingLeft) - parseInt(paddingRight);
			//this._width = this.domref.clientWidth; 
		}
	},

	dispose : function() {
		this.$base();
		
		if (this._img != null) {
			this.domref.removeChild(this._img);
			delete this._img;
			delete this._image;
		}
		this.domref.removeChild(this._operator);
		this.domref.removeChild(this._span);
		
		if (this._parentNode != null) {
			this._parentNode.removeChild(this.domref);
		}

		delete this._operator;
		delete this._span;
		delete this.domref;
	},

	getWidth : function() {
		this.checkWidget();
		if (this._width == null || this._width == "auto") {
			this._computeWidth();
		}
		
		return this._width;
	},

	handleEvent : function(e) {
		this.checkWidget();
		switch(e.type) {
			case "mousedown":
				if (e.target == this._operator && this._resizable) {
					this._isResizing = true;

					this.allColsWidth = 0;
					var columns = this._table.getColumns();
					columns.forEach(function(item, index, arr) {
						var width = item.getWidth();
						item.domref.style.width = width + "px";
						this.allColsWidth += width;
					}, this);
					
					var order = this._table.getColumnOrder();
					var thisColumnIndex = columns.indexOf(this);
					var thisColumnOrder = order.indexOf(thisColumnIndex);
					this.nextColumn = columns[order[thisColumnOrder + 1]];
					this.nextColumn.domref.style.width = "auto";
					this.lessColsWidth = this.allColsWidth - this.getWidth() - this.nextColumn.getWidth();

					this.resizeStart = e.clientX;
					this.startWidth = this._width;

					gara.EventManager.addListener(document, "mousemove", this);
					gara.EventManager.addListener(document, "mouseup", this);
				}

				if (e.target == this.domref && this._moveable) {
					this._isMoving = true;

					var shadowWidth = null;
					var order = this._table.getColumns();
					var offset = order.indexOf(this);

					this._shadow = new gara.jswt.Table(document.getElementsByTagName("body")[0], this._table.getStyle() &~ JSWT.CHECK);
					this._shadow.setHeaderVisible(this._table.getHeaderVisible());

					this._table.getColumns().forEach(function(col, index, arr) {
						if (index == offset) {
							var c = new gara.jswt.TableColumn(this._shadow);
							shadowWidth = col.getWidth();
							c.setText(col.getText());
							c.setWidth(shadowWidth);
						}
					}, this);

					//var cols = this._table.getColumnCount();
					this._table.getItems().forEach(function(item, index, arr) {
						var i = new gara.jswt.TableItem(this._shadow);
						i.setText(item.getText(offset));
						i.setImage(item.getImage(offset));
					}, this);


					this._shadow.update();
					this._shadow.domref.style.position = "absolute";					
					this._shadow.domref.style.left = e.clientX + 16 + "px";
					this._shadow.domref.style.top = e.clientY + 16 + "px";
					this._shadow.domref.style.opacity = "0.3";
					this._shadow.domref.style.width = shadowWidth + "px";
					
					gara.EventManager.addListener(document, "mousemove", this);
					gara.EventManager.addListener(document, "mouseup", this);
				}
				break;
			
			case "mousemove":
				if (this._isResizing) {
					var minWidth = 2;
					
					var delta = e.clientX - this.resizeStart;
					this._width = this.startWidth + delta;
					
					if (this._width > minWidth) {
						this.domref.style.width = this._width + "px";
					}
				}

				if (this._isMoving) {
					this._shadow.domref.style.left = e.clientX + 16 + "px";
					this._shadow.domref.style.top = e.clientY + 16 + "px";
				}
				break;

			case "mouseup":
				if (this._isResizing) {
					var nextWidth = this.allColsWidth - (this.lessColsWidth + this.getWidth()); 
					this.nextColumn.setWidth(nextWidth);
					this.nextColumn.domref.style.width = nextWidth + "px";
					gara.EventManager.removeListener(document, "mousemove", this);
					gara.EventManager.removeListener(document, "mouseup", this);
					this._isResizing = false;
				}
				
				if (this._isMoving) {
					gara.EventManager.removeListener(document, "mousemove", this);
					gara.EventManager.removeListener(document, "mouseup", this);
					this._isMoving = false;
					this._shadow.dispose();
					
					delete this._shadow;
					
					this._shadow = null;
				
					if (e.target.obj && $class.instanceOf(e.target.obj, gara.jswt.TableColumn)
						&& e.target.obj.getParent() == this._table) {
						var col = e.target.obj;
						var colOrder = this._table.getColumnOrder();
						var colIndex = this._table.getColumns().indexOf(col);
						var orderIndex = colOrder.indexOf(colIndex);
						var thisColIndex = this._table.getColumns().indexOf(this);
						colOrder.remove(thisColIndex);
						colOrder.insertAt(orderIndex, thisColIndex);
						this._table.update();
					}
				}
				break;
		}
	},
	
	_registerListener : function() {
		
	},
	
	setWidth : function(width) {
		this.checkWidget();
		this._width = width;
	},
	
	toString : function() {
		return "[gara.jswt.TableColumn]";
	},
	
	/**
	 * @method
	 * Unregister listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_unregisterListener : function(eventType, listener) {
	},
	
	update : function() {
		this.checkWidget();
		if (this.domref == null) {
			this._create();
		}

		if (this.hasChanged()) {
			// create image
			if (this._image != null && this._img == null) {
				this._img = document.createElement("img");
				this._img.obj = this;
				this._img.control = this._table;
				this._img.src = this._image.src;
				this.domref.insertBefore(this._img, this._operator);
				base2.DOM.EventTarget(this._img);
			}

			// update image information
			else if (this._image != null) {
				this._img.src = this._image.src;
			}

			// delete image
			else if (this._img != null && this._image == null) {
				this.domref.removeChild(this._img);
				this._img = null;
			}

			this._spanText.nodeValue = this._text;
		}

		this.removeClassName("operator");

		var columnOrder = this._table.getColumnOrder();
		if (this._table.getColumns()[columnOrder[columnOrder.length - 1]] != this) {
			this.addClassName("operator");
		}

		this.domref.className = this._className;

		if (!isNaN(this._width) && this._width != null) {
			this.domref.style.width = this._width + "px";
		}

		this.releaseChange();
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * gara TableItem
 * 
 * @class TableItem
 * @author Thomas Gossmann
 * @namespace gara.jswt
 * @extends gara.jswt.Item
 */
$class("TableItem", {
	$extends : gara.jswt.Item,

	$constructor : function(parent, style, index) {
		if (!$class.instanceOf(parent, gara.jswt.Table)) {
			throw new TypeError("parent is not a gara.jswt.Table");
		}

		this.$base(parent, style);

		this._table = parent;
		this._table._addItem(this, index);

		this._cells = [];
		this._checkboxTd = null;
		this._checkbox = null;

		this._active = false;
		this._checked = false;
		this._grayed = false;
		this._selected = false;

		this.domref = null;
	},
	
	clear : function() {
		this.checkWidget();
		this._text = "";
		this._image = null;
		this._cells = [];
		this._active = this._checked = false;
	},

	_create : function() {
		this.domref = document.createElement("tr");
		this.domref.obj = this;
		this.domref.control = this._table;
		base2.DOM.EventTarget(this.domref);

		this._checkbox = document.createElement("input");
		this._checkbox.type = "checkbox";
		this._checkbox.obj = this;
		this._checkbox.control = this._table;
		if (this._grayed) {
			this._checkbox.disabled = true;
		}
		if (this._checked) {
			this._checkbox.checked = true;
		}
		this._checkboxTd = document.createElement("td");
		this._checkboxTd.appendChild(this._checkbox);
		if ((this._table.getStyle() & JSWT.CHECK) == JSWT.CHECK) {
			this.domref.appendChild(this._checkboxTd);
		}
		base2.DOM.EventTarget(this._checkbox);
		gara.EventManager.addListener(this._checkbox, "mousedown", this);
		gara.EventManager.addListener(this._checkbox, "keydown", this);

		var order = this._table.getColumnOrder();
		for (var i = 0, len = order.length; i < len; ++i) {
			var cell = this._cells[order[i]];
			cell.td = document.createElement("td");
			cell.td.obj = this;
			cell.td.control = this._table;
			base2.DOM.EventTarget(cell.td);
			this.domref.appendChild(cell.td);

			if (cell.image) {
				cell.img = document.createElement("img");
				cell.img.obj = this;
				cell.img.control = this._table;
				cell.img.src = cell.image.src;
				base2.DOM.EventTarget(cell.img);
				cell.td.appendChild(cell.img);
			}
			cell.textNode = document.createTextNode(cell.text);
			cell.td.appendChild(cell.textNode);
		}

		this._changed = false;

		if (this._parentNode != null) {
			this._parentNode.appendChild(this.domref);
		}
	},

	dispose : function() {
		this.$base();

		var cell;
		for (var i = 0, len = this._cells.length; i < len; i++) {
			cell = this._cells[i];
			if (cell.img) {
				cell.td.removeChild(cell.img);
				delete cell.img;
				cell.image = null;
			}
			this.domref.removeChild(cell.td);

			delete cell.td;
		}
		this._cells.clear();
		delete this._cells;

		if (this._parentNode != null) {
			this._parentNode.removeChild(this.domref);
		}

		delete this.domref;
	},

	/**
	 * @method
	 * Returns the checked state for this item
	 * 
	 * @author Thomas Gossmann
	 * @return {boolean} the checked state
	 */
	getChecked : function() {
		this.checkWidget();
		this._checked = this._checkbox.checked;
		return this._checked;
	},

	getGrayed : function() {
		this.checkWidget();
		return this._grayed;
	},

	getText : function(index) {
		this.checkWidget();
		if (this._cells[index]) {
			return this._cells[index].text;
		}
		return null;
	},

	getImage : function(index) {
		this.checkWidget();
		if (this._cells[index]) {
			return this._cells[index].image;
		}
		return null;
	},

	handleEvent : function(e) {
		this.checkWidget();

		if (e.target == this._checkbox
				&& (e.type == "mousedown"
					|| e.type == "keydown" && e.keyCode == 32)) {
			e.garaDetail = gara.jswt.JSWT.CHECK;
		}
	},

	_registerListener : function(eventType, listener) {
		
	},

	setActive : function(active) {
		this._active = active;
	},

	setChecked : function(checked) {
		if (!this._grayed) {
			this._checked = checked;
			if (this._checked) {
				this._checkbox.checked = true;
			} else {
				this._checkbox.checked = false;
			}
		}
	},

	setGrayed : function(grayed) {
		this._grayed = grayed;
		if (this._grayed) {
			this._checkbox.disabled = true;
		} else {
			this._checkbox.disabled = false;
		}
	},

	setImage : function(index, image) {
		if (!image) {
			image = index;
		}

		if (typeof(image) == "undefined" || image == null) {
			return;
		}

		if ($class.instanceOf(image, Array)) {
			image.forEach(function(image, index, arr) {
				if (!this._cells[index]) {
					this._cells[index] = {};
				}
				this._cells[index].image = image;
			}, this);
		} else if (!isNaN(index)) {
			if (!this._cells[index]) {
				this._cells[index] = {};
			}
			this._cells[index].image = image;
		} else {
			if (!this._cells[0]) {
				this._cells[0] = {};
			}
			this._cells[0].image = image;
		}

		this._changed = true;
	},

	_setSelected : function(selected) {
		this.checkWidget();
		this._selected = selected;
		this._changed = true;
	},

	setText : function(index, text) {
		this.checkWidget();
		if (typeof(text) == "undefined") {
			text = index;
		}

		if ($class.instanceOf(text, Array)) {
			text.forEach(function(text, index, arr) {
				if (!this._cells[index]) {
					this._cells[index] = {};
				}	
				this._cells[index].text = text;
			}, this);
		} else if (!isNaN(index)) {
			if (!this._cells[index]) {
				this._cells[index] = {};
			}
			this._cells[index].text = text;
		} else {
			if (!this._cells[0]) {
				this._cells[0] = {};
			}
			this._cells[0].text = text;
		}

		this._changed = true;
	},
	
	toString : function() {
		return "[gara.jswt.TableItem]";
	},
	
	/**
	 * @method
	 * Unregister listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_unregisterListener : function(eventType, listener) {

	},

	update : function() {
		this.checkWidget();
		
		if (this.domref == null) {
			this._create();
		} else {
			while (this.domref.childNodes.length) {
				this.domref.removeChild(this.domref.childNodes[0]);
			}
			if ((this._table.getStyle() & JSWT.CHECK) == JSWT.CHECK) {
				this.domref.appendChild(this._checkboxTd);
			}

			var order = this._table.getColumnOrder();
			for (var i = 0, len = order.length; i < len; ++i) {
				var cell = this._cells[order[i]];
				
				if (this.hasChanged()) {
					if (!cell.td) {
						cell.td = document.createElement("td");
						cell.td.obj = this;
						cell.td.control = this._table;
						base2.DOM.EventTarget(cell.td);
						cell.textNode = document.createTextNode(cell.text);
						cell.td.appendChild(cell.textNode);
					}
					
					if (cell.image) {
						if (!cell.img) {
							cell.img = document.createElement("img");
							cell.img.obj = this;
							cell.img.control = this._table;
							
							base2.DOM.EventTarget(cell.img);
							cell.td.insertBefore(cell.img, cell.textNode);
						}
						cell.img.src = cell.image.src;
					}
					
					cell.td.className = "";
					
					if (this._selected && i == 0) {
						cell.td.className = "selected";
					}
					
					cell.textNode.nodeValue = cell.text;
				}
				
				this.domref.appendChild(cell.td);
			}
		}
		
		this.removeClassName("selected");

		if (this._selected) {
			this.addClassName("selected");
		}

		this.domref.className = this._className;
		this.releaseChange();
	}
});
/*	$Id: ControlManager.class.js 140 2008-07-20 22:24:27Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class ControlManager
 * @author Thomas Gossmann
 * @namespace gara.jswt
 * @private
 */
$class("ControlManager", {
	$implements : gara.jswt.FocusListener,

	_instance : $static(null),

	$constructor : function() {
		this._activeControl = null;
		this._controls = [];

		base2.DOM.EventTarget(document);

		gara.EventManager.addListener(document, "keydown", this);
		gara.EventManager.addListener(document, "mousedown", this);
	},
	
	getInstance : $static(function() {
		if (this._instance == null) {
			this._instance = new gara.jswt.ControlManager();
		}

		return this._instance;
	}),

	addControl : function(control) {
		if (!this._controls.contains(control)) {
			this._controls.push(control);
		}
	},

	focusGained : function(control) {
		if (!$class.instanceOf(control, gara.jswt.Control)) {
			throw new TypeError("control is not a gara.jswt.Control");
		}
		
		if (this._activeControl != null && this._activeControl != control) {
			this._activeControl.looseFocus();
		}

		this._activeControl = control;
	},

	focusLost : function(control) {
		if (!$class.instanceOf(control, gara.jswt.Control)) {
			throw new TypeError("control is not a gara.jswt.Control");
		}

		if (this._activeControl == control) {
			this._activeControl = null;
		}
	},

	handleEvent : function(e) {
		switch(e.type) {
			case "mousedown":
				if (this._activeControl != null && (e.target.control
						? e.target.control != this._activeControl : true)) {
					this._activeControl.looseFocus();
					this._activeControl = null;
				}
				break;

			case "keydown":
				if (this._activeControl != null && this._activeControl.handleEvent) {
					this._activeControl.handleEvent(e);
				}
				break;
		}
	},

	removeControl : function(control) {
		if (!$class.instanceOf(control, gara.jswt.Control)) {
			throw new TypeError("control is not a gara.jswt.Control");
		}

		if (this._controls.contains(control)) {
			if (this._activeControl == control) {
				this._activeControl = null;
			}
			this._controls.remove(control);
		}
	},
	
	toString : function() {
		return "[gara.jswt.ControlManager]";
	}
});
/*	$Id: List.class.js 114 2007-12-27 20:41:27Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @summary
 * gara Menu Widget
 * 
 * @description
 * long description for the Menu Widget...
 * 
 * @class Menu
 * @author Thomas Gossmann
 * @namespace gara.jswt
 * @extends gara.jswt.Widget
 */
$class("Menu", {
	$extends : gara.jswt.Widget,
	
	$constructor : function(parent, style) {
		this.$base(parent, style);

		// Menu default style
		if ((this._style & JSWT.DEFAULT) == JSWT.DEFAULT) {
			this._style = JSWT.BAR;
		}

		if ($class.instanceOf(parent, gara.jswt.Control)) {
			this._style = JSWT.POP_UP;
		}
		
		if ($class.instanceOf(parent, gara.jswt.MenuItem) 
				&& (parent.getStyle() & JSWT.CASCADE) != JSWT.CASCADE) {
			throw new Exception("parent has no JSWT.CASCADE style!");
		}
		
		if ($class.instanceOf(parent, gara.jswt.MenuItem)) {
			this._style = JSWT.DROP_DOWN;
		}
		
		this._items = [];
		this._menuListener = [];

		// location
		this._x = 0;
		this._y = 0;

		// flags
		this._enabled = false;
		this._visible = true;
		
		if ((this._style & JSWT.POP_UP) == JSWT.POP_UP) {
			this._visible = false;
		}
		
		this._className = this._baseClass = "jsWTMenu";

		//window.oncontextmenu = function() {return false;};
	},

	_addItem : function(item, index) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.MenuItem)) {
			throw new TypeError("item is not instance of gara.jswt.MenuItem");
		}

		if (typeof(index) != "undefined") {
			this._items.insertAt(index, item);
		} else {
			this._items.push(item);
		}
	},
	
	addMenuListener : function(listener) {
		this.checkWidget();
		if (!$class.instanceOf(listener, gara.jswt.MenuListener)) {
			throw new TypeError("listener is not instance of gara.jswt.MenuListener");
		}
		
		if (!this._menuListener.contains(listener)) {
			this._menuListener.push(listener);
		}
	},

	_create : function() {

		this.domref = document.createElement("ul");
		this.domref.obj = this;
		this.domref.control = this;
		base2.DOM.EventTarget(this.domref);

		if ((this._style & JSWT.BAR) == JSWT.BAR) {
			this.addClassName("jsWTMenuBar");
			this._parentNode = this._parent;
		}

		if ((this._style & JSWT.POP_UP) == JSWT.POP_UP) {
			this.addClassName("jsWTMenuPopUp");
			this.domref.style.display = "none";
			this.domref.style.position = "absolute";
			this._parentNode = document.getElementsByTagName("body")[0];
		}

		if ((this._style & JSWT.DROP_DOWN) == JSWT.DROP_DOWN) {
			this.addClassName("jsWTMenuDropDown");
			this.domref.style.position = "absolute";
			this._parentNode = this._parent.domref;
		}

		/* buffer unregistered user-defined listeners */
		var unregisteredListener = {};
		for (var eventType in this._listener) {
			unregisteredListener[eventType] = this._listener[eventType].concat([]);
		}

		/* Menu event listener */
		this.addListener("click", this);

		/* register user-defined listeners */
		for (var eventType in unregisteredListener) {
			unregisteredListener[eventType].forEach(function(elem, index, arr) {
				this._registerListener(eventType, elem);
			}, this);
		}

		this._parentNode.appendChild(this.domref);
	},
	
	dispose : function() {
		this.$base();

		this._items.forEach(function(item, index, arr) {
			item.dispose();
		}, this);

		if (this._parentNode != null) {
			this._parentNode.removeChild(this.domref);
		}
		delete this.domref;
	},

	getItem : function(index) {
		this.checkWidget();
		if (index > this._items.length || index < 0) {
			throw new gara.OutOfBoundsException("Menu doesn't have that much items");
		}

		return this._items[index];
	},

	getItemCount : function() {
		return this._items.length;
	},

	getItems : function() {
		return this._items;
	},

	getParent : function() {
		return this._parent;
	},

	getParentItem : function() {
		return this._parent;
	},

	getVisible : function() {
		return this._visible;
	},
	
	handleEvent : function(e) {
		this.checkWidget();
		e.widget = this;
		switch(e.type) {
			case "mousedown":
				if ((e.target.control ? e.target.control != this : true)
						&& (this.getStyle() & JSWT.POP_UP) == JSWT.POP_UP
						&& !$class.instanceOf(e.target.obj, gara.jswt.MenuItem)) {
					this.setVisible(false);
				}
				break;
				
			case "click":
				if (e.target.obj && $class.instanceOf(e.target.obj, gara.jswt.MenuItem)) {
					e.target.obj._select(e);
				}
				break;
		}
		e.stopPropagation();
	},

	indexOf : function(item) {
		this.checkWidget();
		if (!$class.instanceOf(item, gara.jswt.MenuItem)) {
			throw new TypeError("item is not instance of gara.jswt.MenuItem");
		}

		return this._items.indexOf(item);
	},

	isVisible : function() {
		return this._visible;
	},

	/**
	 * @method
	 * Register listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_registerListener : function(eventType, listener) {
		if (this.domref != null) {
			gara.EventManager.addListener(this.domref, eventType, listener);
		}
	},

	removeMenuListener : function(listener) {
		this.checkWidget();
		if (!$class.instanceOf(listener, gara.jswt.MenuListener)) {
			throw new TypeError("listener is not instance of gara.jswt.MenuListener");
		}

		if (this._menuListener.contains(listener)) {
			this._menuListener.remove(listener);
		}
	},

	setLocation : function(x, y) {
		this._x = x;
		this._y = y;
	},

	setVisible : function(visible, event) {
		this.checkWidget();
		this._visible = visible;
		this.update();
		if (visible) {
			gara.EventManager.addListener(document, "mousedown", this);
			if ($class.instanceOf(this._parent, gara.jswt.Control)) {
				this._parent.addListener("mousedown", this);
			}

			this._menuListener.forEach(function(listener, index, arr) {
				listener.menuShown(this);
			}, this);
		} else {
			gara.EventManager.removeListener(document, "mousedown", this);
			if ($class.instanceOf(this._parent, gara.jswt.Control)) {
				this._parent.removeListener("mousedown", this);
			}

			this._menuListener.forEach(function(listener, index, arr) {
				listener.menuHidden(this);
			}, this);
		}
	},

	toString : function() {
		return "[gara.jswt.Menu]";
	},

	/**
	 * @method
	 * Unregister listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_unregisterListener : function(eventType, listener) {
		if (this.domref != null) {
			gara.EventManager.removeListener(this.domref, eventType, listener);
		}
	},

	update : function() {
		this.checkWidget();
		if (!this.domref) {
			this._create();
		}

		if ((this._style & JSWT.POP_UP) == JSWT.POP_UP) {
			this.domref.style.top = this._y + "px";
			this.domref.style.left = this._x + "px";
		}
		
		if (this._visible) {
			this.domref.style.display = "block";
		} else {
			this.domref.style.display = "none";
		}
		
		this.domref.className = this._className;
		
		// update items
		this._items.forEach(function(item, index, arr) {

			item.update();
			
			/* create item ...
			if (!item.isCreated()) {
				var node = item._create();
				var nextNode = index == 0 
					? this.domref.firstChild
					: arr[index - 1].domref.nextSibling;

				if (!nextNode) {
					this.domref.appendChild(node);					
				} else {
					this.domref.insertBefore(node, nextNode);
				}
			}

			// ... or update it
			if (item.hasChanged()) {
				item.update();
				item.releaseChange();
			}*/
		}, this);
	}
});
/*	$Id: List.class.js 114 2007-12-27 20:41:27Z tgossmann $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @summary
 * gara MenuItem Widget
 * 
 * @description
 * long description for the MenuItem Widget...
 * 
 * @class MenuItem
 * @author Thomas Gossmann
 * @namespace gara.jswt
 * @extends gara.jswt.Item
 */
$class("MenuItem", {
	$extends : gara.jswt.Item,
	
	$constructor : function(parent, style, index) {
		if (!$class.instanceOf(parent, gara.jswt.Menu)) {
			throw new TypeError("parent is not type of gara.jswt.Menu");
		}
		this.$base(parent, style);
		this._parent = parent;
		this._parent._addItem(this, index);
		this._span = null;
		this._spanText = null;
		this._img = null;
		this._hr = null;

		this._selectionListener = [];

		this._menu = null;
		this._enabled = true;
		this._selected = false;
	},

	/**
	 * @method
	 * Adds a selection listener on the MenuItem
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.SelectionListener} listener the desired listener to be added to this menuitem
	 * @throws {TypeError} if the listener is not an instance SelectionListener
	 * @return {void}
	 */
	addSelectionListener : function(listener) {
		this.checkWidget();
		if (!$class.instanceOf(listener, gara.jswt.SelectionListener)) {
			throw new TypeError("listener is not instance of gara.jswt.SelectionListener");
		}

		if (!this._selectionListener.contains(listener)) {
			this._selectionListener.push(listener);
		}
	},

	_create : function() {
		this.domref = document.createElement("li");
		this.domref.obj = this;
		this.domref.control = this._parent;

		if ((this._style & JSWT.SEPARATOR) == JSWT.SEPARATOR) {
			this.domref.className = "jsWTMenuItemSeparator";
			if ((this._parent.getStyle() & JSWT.BAR) != JSWT.BAR) {
				this._hr = document.createElement("hr");
				this.domref.appendChild(this._hr);
			}
		} else {
			// create item nodes
			this._img = null;
			
			// set image
			if (this._image != null) {
				this._img = document.createElement("img");
				this._img.obj = this;
				this._img.control = this._parent;
				this._img.src = this._image.src;
				this._img.alt = this._text;
				
				// put the image into the dom
				this.domref.appendChild(this._img);
				base2.DOM.EventTarget(this._img);
			}
			
			this._spanText = document.createTextNode(this._text);
			
			this._span = document.createElement("span");
			this._span.obj = this;
			this._span.control = this._parent;
			this._span.appendChild(this._spanText);
			this.domref.appendChild(this._span);
			
			base2.DOM.EventTarget(this.domref);
			base2.DOM.EventTarget(this._span);
			
			/* buffer unregistered user-defined listeners */
			var unregisteredListener = {};
			for (var eventType in this._listener) {
				unregisteredListener[eventType] = this._listener[eventType].concat([]);
			}
			
			/* Menu event listener */
			try {
				var node = this.domref;
				this.domref.attachEvent("onmouseover", function(){
					node.className += " hover";
				});
				this.domref.attachEvent("onmouseout", function(){
					node.className = node.className.replace(new RegExp('\\shover', 'g'), '');
				});
			} catch (e) {}

			/* register user-defined listeners */
			for (var eventType in unregisteredListener) {
				unregisteredListener[eventType].forEach(function(elem, index, arr){
					this.registerListener(eventType, elem);
				}, this);
			}
			
			if (this._menu != null) {
				this.addClassName("jsWTMenuItemCascade");
				this._menu.update();
			}

			if (!this._enabled) {
				this.addClassName("disabled");
			}

			if (this._selected) {
				this.addClassName("checked");
			}

			this.domref.className = this._className;
		}
		this._changed = false;
		this.domref;
		
		var index = this._parent.indexOf(this);
		var parentItems = this._parent.getItems();
		var parentDomref = this._parent.domref;
		
		var nextNode = index == 0 
			? parentDomref.firstChild
			: parentItems[index - 1].domref.nextSibling;

		if (!nextNode) {
			parentDomref.appendChild(this.domref);					
		} else {
			parentDomref.insertBefore(this.domref, nextNode);
		}
	},
	
	dispose : function() {
		this.$base();

		if (this._menu != null) {
			this._menu.dispose();
			delete this._menu;
		}

		if (this._img != null) {
			this.domref.removeChild(this._img);
			delete this._img;
			this._image = null;
		}
		
		if (this._hr != null) {
			this.domref.removeChild(this._hr);
		}
		
		if (this._span != null) {
			this.domref.removeChild(this._span);
		}

		if (this._parentNode != null) {
			this._parentNode.removeChild(this.domref);
		}

		delete this._hr;
		delete this._span;
		delete this.domref;
	},
	
	getEnabled : function() {
		return this._enabled;
	},
	
	getMenu : function() {
		return this._menu;
	},
	
	getParent : function() {
		return this._parent;
	},
	
	getSelection : function() {
		return this._selected;
	},
	
	/**
	 * @method
	 * Register listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_registerListener : function(eventType, listener) {
		if (this.domref != null) {
			gara.EventManager.addListener(this.domref, eventType, listener);
		}
		
		if (this._img != null) {
			gara.EventManager.addListener(this._img, eventType, listener);
		}

		if (this._span != null) {
			gara.EventManager.addListener(this._span, eventType, listener);
		}
	},
	
	/**
	 * @method
	 * Removes a selection listener from this MenuItem
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.SelectionListener} listener the listener to remove from this menuitem
	 * @throws {TypeError} if the listener is not an instance SelectionListener
	 * @return {void}
	 */
	removeSelectionListener : function(listener) {
		this.checkWidget();
		if (!$class.instanceOf(listener, gara.jswt.SelectionListener)) {
			throw new TypeError("listener is not instance of gara.jswt.SelectionListener");
		}

		if (this._selectionListener.contains(listener)) {
			this._selectionListener.remove(listener);
		}
	},
	
	_select : function(e) {
		e.item = this;
		if ((this._style & JSWT.SEPARATOR) == JSWT.SEPARATOR 
				|| !this._enabled) {
			return;
		}

		if ((this._style & JSWT.CHECK) == JSWT.CHECK) {
			this._selected = !this._selected;
			this._changed = true;
		}

		this.update();

		// blurring menu, if POP_UP
		var parent = this;
		while (parent.getParent && parent.getParent() != null
				&& ($class.instanceOf(parent.getParent(), gara.jswt.Menu)
					|| $class.instanceOf(parent.getParent(), gara.jswt.MenuItem)
				)) {
			parent = parent.getParent();
		}

		if ((parent.getStyle() & JSWT.POP_UP) == JSWT.POP_UP) {
			parent.setVisible(false);
		}

		// notify selection listener
		this._selectionListener.forEach(function(listener, index, arr) {
			listener.widgetSelected(e);
		}, this);
	},

	setEnabled : function(enabled) {
		this._enabled = enabled;
		this._changed = true;
		
		if (this.domref != null) {
			this.update();
		}
	},

	setImage : function(image) {
		this.$base(image);
		
		if (this.domref != null) {
			this.update();
		}
	},

	setMenu : function(menu) {
		this.checkWidget();
		if (!$class.instanceOf(menu, gara.jswt.Menu)) {
			throw new TypeError("menu is not instance of gara.jswt.Menu");
		}

		this._menu = menu;
		this._changed = true;
	},

	setSelection : function(selected) {
		this._selected = selected;
	},

	setText : function(text) {
		this.$base(text);
		
		if (this.domref != null) {
			this.update();
		}
	},

	toString : function() {
		return "[gara.jswt.MenuItem]";
	},

	/**
	 * @method
	 * Unregister listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_unregisterListener : function(eventType, listener) {
		if (this.domref != null) {
			gara.EventManager.removeListener(this.domref, eventType, listener);
		}
		
		if (this._img != null) {
			gara.EventManager.removeListener(this._img, eventType, listener);
		}

		if (this._span != null) {
			gara.EventManager.removeListener(this._span, eventType, listener);
		}
	},

	update : function() {
		if (!this.domref) {
			this._create();
		} else if (this._changed){
			this.checkWidget();
			
			// create image
			if (this._image != null && this._img == null) {
				this._img = document.createElement("img");
				this._img.obj = this;
				this._img.control = this._menu;
				this._img.alt = this._text;
				this._img.src = this._image.src;
				this.domref.insertBefore(this._img, this._span);
				base2.DOM.EventTarget(this._img);
				
				// event listener
				for (var eventType in this._listener) {
					this._listener[eventType].forEach(function(elem, index, arr) {
						this.registerListener(this._img, eventType, elem);
					}, this);
				}
			}
	
			// simply update image information
			else if (this._image != null) {
				this._img.src = this._image.src;
				this._img.alt = this._text;
			}
	
			// delete image
			else if (this._img != null && this._image == null) {
				this.domref.removeChild(this._img);
				this._img = null;
	
				// event listener
				for (var eventType in this._listener) {
					this._listener[eventType].forEach(function(elem, index, arr) {
						gara.EventManager.removeListener({
							domNode : this._img,
							type: eventType, 
							listener : elem
						});
					}, this);
				}
			}
	
			this.removeClassName("disabled");
			this.removeClassName("checked");
			this.removeClassName("jsWTMenuItemCascade");
			if (this._menu != null) {
				this.addClassName("jsWTMenuItemCascade");
				this._menu.update();
			}

			if (!this._enabled) {
				this.addClassName("disabled");
			}
			
			if (this._selected) {
				this.addClassName("checked");
			}
	
			this._spanText.nodeValue = this._text;
			this.domref.className = this._className;
			
			this._changed = false;
		}

		// update sub menu
		if (this._menu != null) {
			this._menu.update();
		}
	}
});
/*	$Id: $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class DialogManager
 * @author Thomas Gossmann
 * @namespace gara.jswt
 * @private
 */
$class("DialogManager", {

	_instance : $static(null),

	$constructor : function() {
		this._activeDialog = null;
		this._dialogs = [];
		
		base2.DOM.EventTarget(document);
		gara.EventManager.addListener(document, "keydown", this);
	},

	getInstance : $static(function() {
		if (this._instance == null) {
			this._instance = new gara.jswt.DialogManager();
		}

		return this._instance;
	}),

	activate : function(dialog) {
		if (!$class.instanceOf(dialog, gara.jswt.Dialog)) {
			throw new TypeError("dialog is not a gara.jswt.Dialog");
		}

		if (this._activeDialog != dialog) {
			if (this._activeDialog != null) {
				this._activeDialog.domref.style.zIndex = 600;
			}
			
			this._activeDialog = dialog;
			this._activeDialog.domref.style.zIndex = 601;
		}
	},

	addDialog : function(dialog) {
		if (!$class.instanceOf(dialog, gara.jswt.Dialog)) {
			throw new TypeError("dialog is not a gara.jswt.Dialog");
		}

		if (!this._dialogs.contains(dialog)) {
			this._dialogs.push(dialog);
		}
	},
	
	getActiveDialog : function() {
		if (this._activeDialog != null) {
			return this._activeDialog;
		}
		return null;
	},
	
	getDialogs : function() {
		return this._dialogs;
	},

	handleEvent : function(e) {
		switch(e.type) {
			case "mousedown":
				if (e.target.obj 
						&& $class.instanceOf(e.target.obj, gara.jswt.Dialog)) {
					console.log("DialogMananger.handleEvent(mousedown)");
					this.activate(e.target.obj);
				}
				break;
			
			case "keydown":
				if (this._activeDialog != null && e.keyCode == 9) {
					return false;
				} 
				break;
		}

	},

	removeDialog : function(dialog) {
		if (!$class.instanceOf(dialog, gara.jswt.Dialog)) {
			throw new TypeError("dialog is not a gara.jswt.Dialog");
		}

		if (this._dialogs.contains(dialog)) {
			if (this._activeDialog == dialog) {
				this._activeDialog = null;
			}
			this._dialogs.remove(dialog);
		}
	},

	toString : function() {
		return "[gara.jswt.DialogManager]";
	}
});
/*	$Id: $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class Dialog
 * @author Thomas Gossmann
 * @namespace gara.jswt
 */
$class("Dialog", {

	/**
	 * @constructor
	 */
	$constructor : function(parent, style) {
		if (typeof(style) == "undefined") {
			style = parent;
			this._parentWindow = window.top;
		} else {
			this._parentWindow = parent;
		}

		this._style = style;
		this._disposed = false;
		this._text = " ";
		
		this.domref = null;
		this._parentWindow = window;
		this._modalLayer = null;
		this._dialogBar;
		this._dialogBarLeft;
		this._dialogBarText;
		this._dialogBarButtons;
		this._dialogContent;
		this._barCancelButton;

		this._dX;
		this._dY;

		
		this._tabIndexes = [];	
		this._tabbableTags = ["A","BUTTON","TEXTAREA","INPUT","IFRAME"]; 

		gara.jswt.DialogManager.getInstance().addDialog(this);
	},

	/**
	 * @method
	 * 
	 * Creates the frame for the dialog. Content is populated by a
	 * specialised subclass.
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_create : function() {
		if ((this._style & JSWT.APPLICATION_MODAL) == JSWT.APPLICATION_MODAL) {
			this._disableTabIndexes();
			var modalLayer;
			if (modalLayer = document.getElementById("jsWTModalLayer")) {
				modalLayer.style.display = "block";
			} else {
				modalLayer = document.createElement("div");
				modalLayer.id = "jsWTModalLayer";
				document.getElementsByTagName("body")[0].appendChild(modalLayer);
			}

			modalLayer.style.width = this._getViewportWidth() + "px";
			modalLayer.style.height = this._getViewportHeight() + "px";
		}

		this._parent = this._parentWindow.document.getElementsByTagName("body")[0];

		this.domref = document.createElement("div");
		this.domref.className = "jsWTDialog";
		this.domref.obj = this;
		
		this._dialogBar = document.createElement("div");
		this._dialogBar.className = "jsWTDialogBar";
		
		this._dialogContent = document.createElement("div");
		this._dialogContent.className = "jsWTDialogContent";
		
		this._dialogBarLeft = document.createElement("div");
		this._dialogBarLeft.className = "jsWTDialogBarLeft";

		this._dialogBarText = document.createElement("div");
		this._dialogBarText.className = "jsWTDialogBarText";

		this._dialogBarButtons = document.createElement("div");
		this._dialogBarButtons.className = "jsWTDialogBarButtons";

		var clearer = document.createElement("div");
		clearer.className = "jsWTDialogBarClearer";

		this._barCancelButton = document.createElement("span");
		this._barCancelButton.className = "jsWTDialogCancelButton";

		this._dialogContent = document.createElement("div");
		this._dialogContent.className = "jsWTDialogContent";

		this.domref.appendChild(this._dialogBar);
		this.domref.appendChild(this._dialogContent);

		this._dialogBar.appendChild(this._dialogBarLeft);
		this._dialogBar.appendChild(this._dialogBarText);
		this._dialogBar.appendChild(this._dialogBarButtons);
		this._dialogBarText.appendChild(document.createTextNode(this._text));
		this._dialogBarButtons.appendChild(this._barCancelButton);
		this._dialogBar.appendChild(clearer);
		
		base2.DOM.EventTarget(this._parentWindow);
		base2.DOM.EventTarget(this._parentWindow.document);
		base2.DOM.EventTarget(this.domref);
		base2.DOM.EventTarget(this._dialogBar);
		base2.DOM.EventTarget(this._barCancelButton);
		
		gara.EventManager.addListener(this.domref, "mousedown", this);
		gara.EventManager.addListener(this._barCancelButton, "mousedown", this);
		gara.EventManager.addListener(this._parentWindow, "resize", this);
		
		this._parent.appendChild(this.domref);
		
		gara.jswt.DialogManager.getInstance().activate(this);
	},

	/**
	 * @method
	 * Disable tab indexes when dialog is opened
	 * 
	 * Code below taken from subModal {@link http://gabrito.com/files/subModal/}
	 * 
	 * @private
	 */
	_disableTabIndexes : function() {
		if (document.all) {
			var i = 0;
			for (var j = 0; j < this._tabbableTags.length; j++) {
				var tagElements = document.getElementsByTagName(this._tabbableTags[j]);
				for (var k = 0 ; k < tagElements.length; k++) {
					this._tabIndexes[i] = tagElements[k].tabIndex;
					tagElements[k].tabIndex="-1";
					i++;
				}
			}
		}
	},

	/**
	 * @method
	 * Deletes and destroys the dialog
	 * 
	 *  @private
	 *  @author Thomas Gossmann
	 *  @return {void}
	 */
	dispose : function() {
		gara.EventManager.removeListener(this.domref, "mousedown", this);
		gara.EventManager.removeListener(this._barCancelButton, "mousedown", this);
		gara.EventManager.removeListener(window, "resize", this);

		if ((this._style & JSWT.APPLICATION_MODAL) == JSWT.APPLICATION_MODAL) {
			this._restoreTabIndexes();
		}
		gara.jswt.DialogManager.getInstance().removeDialog(this);
		this.domref.obj = null;
		this._parent.removeChild(this.domref);
		
		if ((this._style & JSWT.APPLICATION_MODAL) == JSWT.APPLICATION_MODAL) {
			document.getElementById("jsWTModalLayer").style.display = "none";
		}

		this._disposed = true;
	},

	/**
	 * @method
	 * Returns the title text from the Dialog
	 * 
	 * @return {String} the title
	 * @author Thomas Gossmann
	 */
	getText : function() {
		return this._text;
	},

	/**
	 * @method
	 * Gets height of the viewport
	 * 
	 * Code below taken from - http://www.evolt.org/article/document_body_doctype_switching_and_more/17/30655/
	 * Modified 4/22/04 to work with Opera/Moz (by webmaster at subimage dot com)
	 * Gets the full width/height because it's different for most browsers.
	 * 
	 * Found on {@link http://gabrito.com/files/subModal/}
	 * 
	 * @private
	 * @return {int} viewport height
	 */
	_getViewportHeight : function() {
		if (window.innerHeight!=window.undefined) return window.innerHeight;
		if (document.compatMode=='CSS1Compat') return document.documentElement.clientHeight;
		if (document.body) return document.body.clientHeight;
		return window.undefined;
	},

	/**
	 * @method
	 * Gets width of the viewport
	 * 
	 * Code below taken from - http://www.evolt.org/article/document_body_doctype_switching_and_more/17/30655/
	 * Modified 4/22/04 to work with Opera/Moz (by webmaster at subimage dot com)
	 * Gets the full width/height because it's different for most browsers.
	 * 
	 * Found on {@link http://gabrito.com/files/subModal/}
	 * 
	 * @private
	 * @return {int} viewport width
	 */
	_getViewportWidth : function() {
		if (window.innerWidth!=window.undefined) return window.innerWidth;
		if (document.compatMode=='CSS1Compat') return document.documentElement.clientWidth;
		if (document.body) return document.body.clientWidth;
		return window.undefined;
	},

	/**
	 * @method
	 * Handling events on the dialog widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {Event} e
	 * @return {void}
	 */
	handleEvent : function(e) {
		switch(e.type) {
			case "mousedown":
				gara.jswt.DialogManager.getInstance().activate(this);
				if (e.target == this._barCancelButton) {
					this.dispose();
				} else if (e.target == this._dialogBar 
						|| e.target == this._dialogBarText
						|| e.target == this._dialogBarButtons){
					gara.EventManager.addListener(this._parentWindow.document, "mousemove", this);
					gara.EventManager.addListener(this._dialogBar, "mouseup", this);
					this._dX = e.clientX - this.domref.offsetLeft;
					this._dY = e.clientY - this.domref.offsetTop;
				}
				break;

			case "mouseup":
				gara.EventManager.removeListener(this._parentWindow.document, "mousemove", this);
				gara.EventManager.removeListener(this._dialogBar, "mouseup", this);
				break;

			case "mousemove":
				this.domref.style.left = (e.clientX - this._dX) + "px";
				this.domref.style.top = (e.clientY - this._dY) + "px";
				break;

			case "resize":
				if (modalLayer = document.getElementById("jsWTModalLayer")) {
					modalLayer.style.width = this._getViewportWidth() + "px";
					modalLayer.style.height = this._getViewportHeight() + "px";
				}
				break;
		}
	},
	
	isDisposed : function() {
		return this._disposed;
	},

	open : $abstract(function() {}),

	/**
	 * @method
	 * Restores tab indexes when dialog is closed
	 * 
	 * Code below taken from subModal {@link http://gabrito.com/files/subModal/}
	 * 
	 * @private
	 */
	_restoreTabIndexes : function() {
		if (document.all) {
			var i = 0;
			for (var j = 0; j < this._tabbableTags.length; j++) {
				var tagElements = document.getElementsByTagName(this._tabbableTags[j]);
				for (var k = 0 ; k < tagElements.length; k++) {
					tagElements[k].tabIndex = this._tabIndexes[i];
					tagElements[k].tabEnabled = true;
					i++;
				}
			}
		}
	},

	/**
	 * @method
	 * Set the title text
	 * @param {String} text the new title
	 * @return {void}
	 */
	setText : function(text) {
		this._text = text;
	},

	toString : function() {
		return "[gara.jswt.Dialog]";
	}
});	
/*	$Id: $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

function getStyle(el, styleProp, ieStyleProp)
{
	var x = el;
	if (x.currentStyle)
		var y = x.currentStyle[ieStyleProp];
	else if (window.getComputedStyle)
		var y = document.defaultView.getComputedStyle(x,null).getPropertyValue(styleProp);
	return y;
}

/**
 * @class MessageBox
 * @author Thomas Gossmann
 * @extends gara.jswt.Dialog
 * @namespace gara.jswt
 */
$class("InputDialog", {
	$extends : gara.jswt.Dialog, 

	/**
	 * @constructor
	 */
	$constructor : function(parent, style) {
		this.$base(parent, style);
		
		this._callback = null;
		this._context = window;
		this._message = "";
		this._value = "";
		this._style |= JSWT.APPLICATION_MODAL;
		
		this._input;
		this._btnOk;
		this._btnCancel;
	},

	/**
	 * @method
	 * 
	 * Creates the frame for the dialog. Content is populated by a
	 * specialised subclass.
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_create : function() {
		this.$base();
		
		this.domref.className += " jsWTInputDialog";
		var text = document.createElement("div");
		text.className = "jsWTInputDialogContentText";
		text.appendChild(document.createTextNode(this._message));
		
		
		this._input = document.createElement("input");
		this._input.type = "text";
		this._input.value = this._value;
		base2.DOM.EventTarget(this._input);
		gara.EventManager.addListener(this._input, "keydown", this);

		text.appendChild(this._input);		
		this._dialogContent.appendChild(text);

		var buttons = document.createElement("div");
		buttons.className = "jsWTInputDialogButtonBar";
		
		this._btnOk = document.createElement("input");
		this._btnOk.type = "button";
		this._btnOk.value = gara.i18n.get("ok");
		base2.DOM.EventTarget(this._btnOk);
		buttons.appendChild(this._btnOk);
		gara.EventManager.addListener(this._btnOk, "click", this);

		this._btnCancel = document.createElement("input");
		this._btnCancel.type = "button";
		this._btnCancel.value = gara.i18n.get("cancel");
		base2.DOM.EventTarget(this._btnCancel);
		buttons.appendChild(this._btnCancel);
		gara.EventManager.addListener(this._btnCancel, "click", this);

		this._dialogContent.appendChild(buttons);
		
		this._input.focus();
		
		
		// position
		var left = this._getViewportWidth() / 2 - this.domref.clientWidth/2;
		var top = this._getViewportHeight() / 2 - this.domref.clientHeight/2;
		
		this.domref.style.left = left + "px";
		this.domref.style.top = top + "px";
	},

	getMessage : function() {
		return this._message;
	},
	
	getValue : function() {
		return this._value;
	},
	
	handleEvent : function(e) {
		this.$base(e);
		if (this._disposed && this._callback != null) {
			this._callback.call(this._context, null);
		}
		switch(e.type) {
			case "keydown":
				// ESC
				if (e.target == this._input && e.keyCode == 27) {
					this.dispose();
					this._callback.call(this._context, null);
				}

				// ENTER
				if (e.target == this._input 
						&& (e.keyCode == 13 || e.keyCode == 10) 
						&& this._callback != null) {
					this.dispose();
					this._callback.call(this._context, this._input.value);
				}
				break;
			
			case "click":
				var response;
				switch(e.target) {
					case this._btnOk:
						response = this._input.value;
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

	open: function(callback, context) {
		this._create();
		this._callback = callback;
		this._context = context || window;
	},
	
	setMessage : function(message) {
		this._message = message;
	},
	
	setValue : function(value) {
		this._value = value;
	},

	toString : function() {
		return "[gara.jswt.MessageBox]";
	}
});	
/*	$Id: $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

function getStyle(el, styleProp, ieStyleProp)
{
	var x = el;
	if (x.currentStyle)
		var y = x.currentStyle[ieStyleProp];
	else if (window.getComputedStyle)
		var y = document.defaultView.getComputedStyle(x,null).getPropertyValue(styleProp);
	return y;
}

/**
 * @class MessageBox
 * @author Thomas Gossmann
 * @extends gara.jswt.Dialog
 * @namespace gara.jswt
 */
$class("IframeDialog", {
	$extends : gara.jswt.Dialog,
	
	/**
	 * @constructor
	 */
	$constructor : function(parent, style) {
		this.$base(parent, style);

		this._width = 0;
		this._height = 0;
		this._title = "";
		this._iframe;
		this._overlay;
		this._iDoc = null;
	},

	/**
	 * @method
	 * 
	 * Creates the frame for the dialog. Content is populated by a
	 * specialised subclass.
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_create : function(src) {
		this.$base();
		
		this._overlay = document.createElement("div");
		this._overlay.style.position = "absolute";
		this._overlay.style.left = "0";
		this._overlay.style.right = "0";
		this._overlay.style.top = "0";
		this._overlay.style.bottom = "0";
		
		this.domref.className += " jsWTIframeDialog";
		this._iframe = document.createElement("iframe");
		this._iframe.src = src;
		this._iframe.style.width = "100%";
		this._iframe.style.height = "100%";
		this._dialogContent.appendChild(this._iframe);

		if ((this._style & gara.jswt.JSWT.ICON_WORKING) == gara.jswt.JSWT.ICON_WORKING) {
			this._overlay.className = "loading";
			this._showOverlay();
		}
		
		this.domref.style.width = this._width + "px";
		this._dialogContent.style.height = this._height + "px";
		this._dialogContent.style.position = "relative";
		
		base2.DOM.EventTarget(this._iframe);
		base2.DOM.EventTarget(this._dialogContent);
		
		gara.EventManager.addListener(this._iframe, "load", this);

		this._dialogBarText.appendChild(document.createTextNode(this._title));
		this._dialogBarText.style.width = (this._width - 40) + "px";

		// position
		var left = this._getViewportWidth() / 2 - this.domref.clientWidth/2;
		var top = this._getViewportHeight() / 2 - this.domref.clientHeight/2;

		this.domref.style.left = left + "px";
		this.domref.style.top = top + "px";
	},

	getHeight : function() {
		return this._height;
	},

	getTitle : function() {
		return this._title;
	},

	getWidth : function() {
		return this._width;
	},
	
	handleEvent : function(e) {
		this.$base(e);
		
		switch (e.type) {
			case "load":
				if (this._iDoc == null) {
					try {
						this._iDoc = this._iframe.contentDocument; // W3C
					} catch (e) {
						try {
							this._iDoc = this._iframe.document; // IE (6?)
						} catch (e) {}
					}
				}
				
				if (this._iDoc != null) {
					try {
						this._iDoc.obj = this;
						base2.DOM.EventTarget(this._iDoc);
						gara.EventManager.addListener(this._iDoc, "mousedown", this);
					} catch(e) {}
				}

				if ((this._style & gara.jswt.JSWT.ICON_WORKING) == gara.jswt.JSWT.ICON_WORKING) {
					this._overlay.className = "";
					this._hideOverlay();
				}
				break;
			
			case "mousedown":
				gara.jswt.DialogManager.getInstance().activate(this);
				if (e.target == this._dialogBar ||
					e.target == this._dialogBarText ||
					e.target == this._dialogBarButtons) {
					
					gara.jswt.DialogManager.getInstance().getDialogs().forEach(function(diag, index, arr) {
						if ($class.instanceOf(diag, gara.jswt.IframeDialog)) {
							diag._showOverlay();
						}
					}, this);
				}
				break;
				
			case "mouseup":
				gara.jswt.DialogManager.getInstance().getDialogs().forEach(function(diag, index, arr) {
					if ($class.instanceOf(diag, gara.jswt.IframeDialog)) {
						diag._hideOverlay();
					}
				}, this);
				break;
		}
	},
	
	_hideOverlay : function() {
		this._dialogContent.removeChild(this._overlay);
	},

	open: function(src) {
		this._create(src);
	},
	
	_showOverlay : function() {
		this._dialogContent.appendChild(this._overlay);
	},

	setHeight : function(height) {
		this._height = height;
	},

	setTitle : function(title) {
		this._title = title;
	},

	setWidth : function(width) {
		this._width = width;
	},

	toString : function() {
		return "[gara.jswt.IframeDialog]";
	}
});
/*	$Id: $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

function getStyle(el, styleProp, ieStyleProp)
{
	var x = el;
	if (x.currentStyle)
		var y = x.currentStyle[ieStyleProp];
	else if (window.getComputedStyle)
		var y = document.defaultView.getComputedStyle(x,null).getPropertyValue(styleProp);
	return y;
}

/**
 * @class MessageBox
 * @author Thomas Gossmann
 * @extends gara.jswt.Dialog
 * @namespace gara.jswt
 */
$class("MessageBox", {
	$extends : gara.jswt.Dialog, 

	/**
	 * @constructor
	 */
	$constructor : function(parent, style) {
		this.$base(parent, style);
		
		this._callback = null;
		this._context = window;
		this._message = "";
		this._style |= JSWT.APPLICATION_MODAL;

		this._btnOk;
		this._btnYes;
		this._btnNo;
		this._btnAbort;
		this._btnRetry;
		this._btnIgnore;
		this._btnCancel;
	},

	/**
	 * @method
	 * 
	 * Creates the frame for the dialog. Content is populated by a
	 * specialised subclass.
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	_create : function() {
		this.$base();
		
		this.domref.className += " jsWTMessageBox";
		var text = document.createElement("div");
		text.className = "jsWTMessageBoxContentText";
		text.appendChild(document.createTextNode(this._message));
		
		// ICON_ERROR, ICON_INFORMATION, ICON_QUESTION, ICON_WARNING, ICON_WORKING
		if ((this._style & JSWT.ICON_ERROR) == JSWT.ICON_ERROR) {
			text.className += " jsWTIconError";
		}

		if ((this._style & JSWT.ICON_INFORMATION) == JSWT.ICON_INFORMATION) {
			text.className += " jsWTIconInformation";
		}

		if ((this._style & JSWT.ICON_QUESTION) == JSWT.ICON_QUESTION) {
			text.className += " jsWTIconQuestion";
		}

		if ((this._style & JSWT.ICON_WARNING) == JSWT.ICON_WARNING) {
			text.className += " jsWTIconWarning";
		}

		if ((this._style & JSWT.ICON_WORKING) == JSWT.ICON_WORKING) {
			text.className += " jsWTIconWorking";
		}
		
		this._dialogContent.appendChild(text);

		var buttons = document.createElement("div");
		buttons.className = "jsWTMessageBoxButtonBar";
		
		if ((this._style & JSWT.OK) == JSWT.OK) {
			this._btnOk = document.createElement("input");
			this._btnOk.type = "button";
			this._btnOk.value = gara.i18n.get("ok");
			base2.DOM.EventTarget(this._btnOk);
			buttons.appendChild(this._btnOk);
			gara.EventManager.addListener(this._btnOk, "click", this);
		}
		
		if ((this._style & JSWT.YES) == JSWT.YES) {
			this._btnYes = document.createElement("input");
			this._btnYes.type = "button";
			this._btnYes.value = gara.i18n.get("yes");
			base2.DOM.EventTarget(this._btnYes);
			buttons.appendChild(this._btnYes);
			gara.EventManager.addListener(this._btnYes, "click", this);
		}
		
		if ((this._style & JSWT.NO) == JSWT.NO) {
			this._btnNo = document.createElement("input");
			this._btnNo.type = "button";
			this._btnNo.value = gara.i18n.get("no");
			base2.DOM.EventTarget(this._btnNo);
			buttons.appendChild(this._btnNo);
			gara.EventManager.addListener(this._btnNo, "click", this);
		}
		
		if ((this._style & JSWT.ABORT) == JSWT.ABORT) {
			this._btnAbort = document.createElement("input");
			this._btnAbort.type = "button";
			this._btnAbort.value = gara.i18n.get("abort");
			base2.DOM.EventTarget(this._btnAbort);
			buttons.appendChild(this._btnAbort);
			gara.EventManager.addListener(this._btnAbort, "click", this);
		}
		
		if ((this._style & JSWT.RETRY) == JSWT.RETRY) {
			this._btnRetry = document.createElement("input");
			this._btnRetry.type = "button";
			this._btnRetry.value = gara.i18n.get("retry");
			base2.DOM.EventTarget(this._btnRetry);
			buttons.appendChild(this._btnRetry);
			gara.EventManager.addListener(this._btnRetry, "click", this);
		}

		if ((this._style & JSWT.IGNORE) == JSWT.IGNORE) {
			this._btnIgnore = document.createElement("input");
			this._btnIgnore.type = "button";
			this._btnIgnore.value = gara.i18n.get("ignore");
			base2.DOM.EventTarget(this._btnIgnore);
			buttons.appendChild(this._btnIgnore);
			gara.EventManager.addListener(this._btnIgnore, "click", this);
		}

		if ((this._style & JSWT.CANCEL) == JSWT.CANCEL) {
			this._btnCancel = document.createElement("input");
			this._btnCancel.type = "button";
			this._btnCancel.value = gara.i18n.get("cancel");
			base2.DOM.EventTarget(this._btnCancel);
			buttons.appendChild(this._btnCancel);
			gara.EventManager.addListener(this._btnCancel, "click", this);
		}

		this._dialogContent.appendChild(buttons);
		
		// position
		var left = this._getViewportWidth() / 2 - this.domref.clientWidth/2;
		var top = this._getViewportHeight() / 2 - this.domref.clientHeight/2;
		
		this.domref.style.left = left + "px";
		this.domref.style.top = top + "px";
	},

	getMessage : function() {
		return this._message;
	},
	
	handleEvent : function(e) {
		this.$base(e);
		if (this._disposed && this._callback != null) {
			this._callback.call(this._context, JSWT.CANCEL);
		}
		switch(e.type) {
			case "click":
				var response;
				switch(e.target) {
					case this._btnOk:
						response = JSWT.OK;
						break;
					
					case this._btnYes:
						response = JSWT.YES;
						break;
						
					case this._btnNo:
						response = JSWT.NO;
						break;
					
					case this._btnAbort:
						response = JSWT.ABORT;
						break;
					
					case this._btnRetry:
						response = JSWT.RETRY;
						break;
					
					case this._btnIgnore:
						response = JSWT.IGNORE;
						break;
					
					default:
					case this._btnCancel:
						response = JSWT.CANCEL;
						break;
				}
				this.dispose();
				if (this._callback != null) {
					this._callback.call(this._context, response);
				}
				break;
		}
	},

	open: function(callback, context){
		this._create();
		this._callback = callback || null;
		this._context = context || window;
	},
	
	setMessage : function(message) {
		this._message = message;
	},

	toString : function() {
		return "[gara.jswt.MessageBox]";
	}
});	
var jswtPkg = new gara.Package({
	name : "jswt",
	exports : "JSWT,ControlManager,Widget,Control,Composite,Item,List,ListItem,Tree,TreeItem,TabFolder,TabItem,FocusListener,SelectionListener"
});
gara.jswt.namespace = jswtPkg.namespace;
gara.jswt.toString = function() {
	return "[gara.jswt]";
}

$package("");
})();

/**
 * @function
 * @private
 */
(function() {
$package("gara.jsface");
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @interface IBaseLabelProvider
 * @namespace gara.jsface
 * @author Thomas Gossmann
 * 
 * <p>
 * A label provider maps an element of the viewer's model to an optional image 
 * and optional text string used to display the element in the viewer's control.
 * Certain label providers may allow multiple labels per element. This is an 
 * "abstract interface", defining methods common to all label providers, but 
 * does not actually define the methods to get the label(s) for an element. 
 * This interface should never be directly implemented. Most viewers will take 
 * either an ILabelProvider or an ITableLabelProvider.
 * </p>
 */
$interface("IBaseLabelProvider", {

	/**
	 * @method
	 * Returns whether the label would be affected by a change to the given
	 * property of the given element.
	 * 
	 * @param {Object} element
	 * @param {String} property
	 * @returns {boolean} <code>true</code> if the label would be affected, and <code>false</code> if it would be unaffected
	 */
	isLabelProperty : function(element, property) {}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @interface ILabelProvider
 * @extends gara.jsface.IBaseLabelProvider
 * @namespace gara.jsface
 * @author Thomas Gossmann
 * 
 * Extends <code>IBaseLabelProvider</code> with the methods to provide the text 
 * and/or image for the label of a given element. Used by most structured 
 * viewers, except table viewers.
*/
$interface("ILabelProvider", {
	$extends : gara.jsface.IBaseLabelProvider,
	
	/**
	 * @method
	 * Returns the image for the label of the given element
	 * 
	 * @param {Object} element the element for which to provide the label image
	 * @returns the image used to label the element, or <code>null</code> if there is no image for the given object
	 */
	getImage : function(element) {},

	/**
	 * @method
	 * Returns the text for the label of the given element.
	 * 
	 * @param {Object} element the element for which to provide the label text 
	 * @returns the text string used to label the element, or <code>null</code> if there is no text label for the given object
	 */	
	getText : function(element) {}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @interface ITableLabelProvider
 * @extends gara.jsface.IBaseLabelProvider
 * @namespace gara.jsface
 * @author Thomas Gossmann
 * 
 * Extends <code>IBaseLabelProvider</code> with the methods to provide the text
 * and/or image for each column of a given element. Used by table viewers.
 */
$interface("ITableLabelProvider", {
	$extends : gara.jsface.IBaseLabelProvider,
	
	/**
	 * @method
	 * Returns the label image for the given column of the given element.
	 * 
	 * @param {Object} element the object representing the entire row, or <code>null</code> indicating that no input object is set in the viewer
	 * @param {int} columnIndex the zero-based index of the column in which the label appears
	 * @returns Image or <code>null</code> if there is no image for the given object at columnIndex
	 */
	getColumnImage : function(element, columnIndex) {},

	/**
	 * @method
	 * Returns the label text for the given column of the given element.
	 * 
	 * @param {Object} element the object representing the entire row, or <code>null</code> indicating that no input object is set in the viewer
	 * @param {int} columnIndex the zero-based index of the column in which the label appears 
	 * @returns String or or <code>null</code> if there is no text for the given object at columnIndex
	 */	
	getColumnText : function(element, columnIndex) {}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @interface ILabelProviderListener
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$interface("ILabelProviderListener", {
	labelProviderChanged : function() {}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class LabelProvider
 * @namespace gara.jsface
 * @author Thomas Gossmann
 * @implements gara.jsface.ILabelProvider
 * 
 * A label provider implementation which, by default, uses an element's toString
 * value for its text and null for its image. This class may be used as is, or
 * subclassed to provide richer labels. Subclasses may override any of the
 * following methods:
 * <ul>
 * <li>isLabelProperty</li>
 * <li>getImage</li>
 * <li>getText</li>
 * </ul>
 */
$class("LabelProvider", {
	$implements : gara.jsface.ILabelProvider,

	/**
	 * @constructor
	 */
	$constructor : function() {
	},

	getImage : function() {
		
	},

	getText : function() {
		
	},
	
	isLabelProperty : function(element, property) {
		
	},

	toString : function() {
		return "[gara.jsface.LabelProvider]";
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class BaseLabelProvider
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("BaseLabelProvider", {
	$implements : [gara.jsface.IBaseLabelProvider],
	
	$constructor : function() {
		this.$base();
		this._listener = null;
	},
	
	addListener : function(listener) {
		if (!$class.instanceOf(listener, gara.jsface.ILabelProviderListener)) {
			throw new TypeError("listener not type of gara.jsface.ILabelProviderListener");
		}
		
		if (this._listener == null) {
			this._listener = [];
		}
		
		this._listener.add(listener);
	},
	
	isLabelProperty : function(element, property) {
		return true;
	},

	removeListener : function(listener) {
		if (!$class.instanceOf(listener, gara.jsface.ILabelProviderListener)) {
			throw new TypeError("listener not type of gara.jsface.ILabelProviderListener");
		}

		if (this._listener != null && this._listener.contains(listener)) {
			this._listener.remove(listener);
		}
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class CellLabelProvider
 * @extends gara.jsface.BaseLabelProvider
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("CellLabelProvider", {
	$extends : gara.jsface.BaseLabelProvider,
	
	$constructor : function() {
		this.$base();
	},
	
	createViewerLabelProvider : $static(function(labelProvider) {
		if ($class.instanceOf(labelProvider, gara.jsface.ITableLabelProvider)) {
			return new gara.jsface.TableColumnViewerLabelProvider(labelProvider);
		}

		if ($class.instanceOf(labelProvider, gara.jsface.CellLabelProvider)) {
			return labelProvider;
		}
		return new gara.jsface.WrappedViewerLabelProvider(labelProvider);
	}),

	update : $abstract(function(cell){})
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class ColumnLabelProvider
 * @extends gara.jsface.CellLabelProvider
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("ColumnLabelProvider", {
	$extends : gara.jsface.CellLabelProvider,
	$implements : [gara.jsface.ILabelProvider],

	$constructor : function() {
		this.$base();
	},

	getImage : function(element) {
		return null;
	},

	getText : function(element) {
		return element == null ? "" : element.toString();
	},
	
	isLabelProperty : function(element, property) {
		return true;
	},
	
	update : function(cell) {
		if (!$class.instanceOf(cell, gara.jsface.ViewerCell)) {
			throw new TypeError("cell is not instance of gara.jsface.ViewerCell");
		}
		
		var element = cell.getElement();
		cell.setText(this.getText(element));
		cell.setImage(this.getImage(element));
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class WrappedViewerLabelProvider
 * @extends gara.jsface.ColumnLabelProvider
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("WrappedViewerLabelProvider", {
	$extends : gara.jsface.ColumnLabelProvider,

	defaultLabelProvider : $static(new gara.jsface.LabelProvider()),

	$constructor : function(labelProvider) {
		this.$base();
		
		this._labelProvider = this.defaultLabelProvider;
		this._tableLabelProvider;
		this._viewerLabelProvider;
		
		this.setProviders(labelProvider);
	},

	getLabelProvider : function() {
		return this._labelProvider;
	},

	getImage : function(element) {
		return this.getLabelProvider().getImage(element);
	},

	getText : function(element) {
		return this.getLabelProvider().getText(element);
	},

	setProviders : function(provider) {
//		if ($class.instanceOf(provider, gara.jsface.ITableLabelProvider))
//			this._tableLabelProvider = provider;

//		if ($class.instanceOf(provider, gara.jsface.IViewerLabelProvider))
//			this._viewerLabelProvider = provider;

		if ($class.instanceOf(provider, gara.jsface.ILabelProvider))
			this._labelProvider = provider;
	},
	
	update : function(cell) {
		if (!$class.instanceOf(cell, gara.jsface.ViewerCell)) {
			throw new TypeError("cell is not instance of gara.jsface.ViewerCell");
		}
		
		var element = cell.getElement();
		cell.setText(this.getText(element));
		cell.setImage(this.getImage(element));
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class TableColumnViewerLabelProvider
 * @extends gara.jsface.WrappedViewerLabelProvider
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("TableColumnViewerLabelProvider", {
	$extends : gara.jsface.WrappedViewerLabelProvider,
	
	$constructor : function(labelProvider) {
		this.$base(labelProvider);
		
		if ($class.instanceOf(labelProvider, gara.jsface.ITableLabelProvider)) {
			this._tableLabelProvider = labelProvider;
		}
	},

	update : function(cell) {
		if (!$class.instanceOf(cell, gara.jsface.ViewerCell)) {
			throw new TypeError("cell is not instance of gara.jsface.ViewerCell");
		}

		var element = cell.getElement();
		var index = cell.getColumnIndex();

		if (this._tableLabelProvider == null) {
			cell.setText(this.getLabelProvider().getText(element));
			cell.setImage(this.getLabelProvider().getImage(element));
		} else {
			cell.setText(this._tableLabelProvider.getColumnText(element, index));
			cell.setImage(this._tableLabelProvider.getColumnImage(element, index));
		}
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @interface IContentProvider
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$interface("IContentProvider", {
	inputChanged : function(viewer, oldInput, newInput) {}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @interface IStructuredContentProvider
 * @extends gara.jsface.IContentProvider
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$interface("IStructuredContentProvider", {
	$extends : gara.jsface.IContentProvider,
	
	getElements : function(inputElement) {}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @interface ITreeContentProvider
 * @extends gara.jsface.IStructuredContentProvider
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$interface("ITreeContentProvider", {
	$extends : gara.jsface.IStructuredContentProvider,
	
	getChildren : function(parentElement) {},
	
	getParent : function(element) {},
	
	hasChildren : function(element) {}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @interface ISelectionChangedListener
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$interface("ISelectionChangedListener", {
	selectionChanged : function(listener){}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @interface ICheckStateListener
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$interface("ICheckStateListener", {
	checkStateChanged : function(listener){}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @interface ICheckable
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$interface("ICheckable", {
	addCheckStateListener : function(listener){},

	getChecked : function(element){},

	removeCheckStateListener : function(listener){},

	setChecked : function(element, checked) {}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class CheckStateChangedEvent
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("CheckStateChangedEvent", {
	$constructor : function(source, element, state) {
		this._source = source;
		this._element = element;
		this._state = state;
	},

	getElement : function() {
		return this._element;
	},

	getSource : function() {
		return this._source;
	},

	getState : function() {
		return this._state;
	},

	toString : function() {
		return "[gara.jsface.CheckStateChangedEvent]";
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class SelectionChangedEvent
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("SelectionChangedEvent", {
	$constructor : function(source, selection) {
		this._source = source;
		this._selection = selection;
	},

	getSelection : function() {
		return this._selection;
	},

	getSource : function() {
		return this._source;
	},
	
	toString : function() {
		return "[gara.jsface.SelectionChangedEvent]";
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class Viewer
 * @author Thomas Gossmann
 * @namespace gara.jsface
 */
$class("Viewer", {
	/**
	 * @constructor
	 */
	$constructor : function() {
		this._selectionChangedListeners = [];
	},
	
	addSelectionChangedListener : function(listener) {
		if (!$class.instanceOf(listener, gara.jsface.ISelectionChangedListener)) {
			throw new TypeError("listener not instance of gara.jsface.ISelectionChangedListener");
		}
		
		if (!this._selectionChangedListeners.contains(listener)) {
			this._selectionChangedListeners.push(listener);
		}
	},
	
	_fireSelectionChanged : function(event) {
		this._selectionChangedListeners.forEach(function(listener, index, arr) {
			listener.selectionChanged(event);
		});
	},

	getControl : $abstract(function() {}),

	getInput : $abstract(function() {}),

	/**
	 * Internal hook Method called when the input to this viewer is
     * initially set or subsequently changed.
     * <p>
     * The default implementation does nothing. Subclassers may override 
     * this method to do something when a viewer's input is set.
     * A typical use is populate the viewer.
     * </p>
     * 
     * @param input the new input of this viewer, or <code>null</code> if none
     * @param oldInput the old input element or <code>null</code> if there
     *   was previously no input
	 */
	inputChange : function(input, oldInput) {},

	refresh : $abstract(function() {}),
	
	removeSelectionChangedListener : function(listener) {
		if (!$class.instanceOf(listener, gara.jsface.ISelectionChangedListener)) {
			throw new TypeError("listener not instance of gara.jsface.ISelectionChangedListener");
		}
		
		this._selectionChangedListeners.remove(listener);
	},

	setInput : $abstract(function(input) {})
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class ContentViewer
 * @extends gara.jsface.Viewer
 * @author Thomas Gossmann
 * @namespace gara.jsface
 */
$class("ContentViewer", {
	$extends : gara.jsface.Viewer,

	/**
	 * @constructor
	 */
	$constructor : function() {
		this._input = null;
		this._contentProvider = null;
		this._labelProvider = null;
	},

	getContentProvider : function() {
		return this._contentProvider;
	},
	
	getInput : function() {
		return this._input;
	},

	getLabelProvider : function() {
		return this._labelProvider;
	},
	
	inputChanged : $abstract(function() {}),

	setContentProvider : function(contentProvider) {
		if (!$class.instanceOf(contentProvider, gara.jsface.IContentProvider)) {
			throw new TypeError("contentProvider is not type of gara.jsface.IContentProvider");
		}
		this._contentProvider = contentProvider;
	},
	
	setInput : function(input) {
		var oldInput = this.getInput();
		this._contentProvider.inputChanged(this, oldInput, input);
		this._input = input;
		this.inputChanged(this._input, oldInput);
	},

	setLabelProvider : function(labelProvider) {
		if (!$class.instanceOf(labelProvider, gara.jsface.IBaseLabelProvider)) {
			throw new TypeError("labelProvider is not type of gara.jsface.IBaseLabelProvider");
		}
		this._labelProvider = labelProvider;
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class StructuredViewer
 * @extends gara.jsface.ContentViewer 
 * @namespace gara.jsface
 * @author Thomas Gossmann
  */
$class("StructuredViewer", {
	$implements : [gara.jswt.SelectionListener],
	$extends : gara.jsface.ContentViewer,

	/**
	 * @constructor
	 */
	$constructor : function() {
		this._map = [];
		this._items = [];
		
		this._sorter = null;
		this._filters = [];
		
		this._elementMap = null;
	},
	
	addFilter : function(filter) {
		if (!$class.instanceOf(filter, gara.jsface.ViewerFilter)) {
			throw new TypeError("filter not instance of gara.jsface.ViewerFilter");
		}

		if (!this._filters.contains(filter)) {
			this._filters.push(filter);
		}
		this.refresh();
	},

	_associate : function(element, item) {
		var data = item.getData();
		if (data != element) {
			if (data != null) {
				this._disassociate(item);
			}
			item.setData(element);
		}

		this._mapElement(element, item);
	},

	/**
	 * Disassociates the given item from its corresponding element. Sets the
	 * item's data to <code>null</code> and removes the element from the
	 * element map (if enabled).
	 * 
	 * @param item
	 *            the widget
	 */
	_disassociate : function(item) {
		var element = item.getData();

		this._unmapElement(element, item);
		item.setData(null);
	},

	_doUpdateItem : $abstract(function(widget, element){}),

	_doFindInputItem : $abstract(function(element){}),

	_findItem : $final(function(element) {
		var results = this._findItems(element);
		return results.length == 0 ? null : results[0];
	}),

	_findItems : $final(function(element) {
		if (!element.hasOwnProperty("__garaUID")) {
			return [];
		}
		var result = this._doFindInputItem(element);
		if (result != null) {
			return [result];
		}
		
		if (this._usingElementMap()) {
			var widgetOrWidgets = null;
			if (element.hasOwnProperty("__garaUID")
					&& this._elementMap.hasOwnProperty(element.__garaUID)) {
				widgetOrWidgets = this._elementMap[element.__garaUID];
			}

			if (widgetOrWidgets == null) {
				return [];
			} else if ($class.instanceOf(widgetOrWidgets, gara.jswt.Widget)) {
				return [widgetOrWidgets];
			} else {
				return widgetOrWidgets;
			}
		}

		return [];
	}),

	_getRawChildren : function(parent) {
		var result = null;
		if (parent != null) {
			var cp = this.getContentProvider();
			if (cp != null) {
				result = cp.getElements(parent);
			}
		}

		return (result != null && $class.instanceOf(result, Array)) ? result : [];
	},

	_getItemFromElementMap : function(element) {
		if (element == null) {
			return null;
		}
		
		var id;
		if (typeof(element) == "object" && element.hasOwnProperty("__garaUID")) {
			id = element.__garaUID;
		} else {
			id = element;
		}

		if (this._elementMap.hasOwnProperty(id)) {
			return this._elementMap[id];
		}
		
		return null;
	},
	
	_getFilteredChildren : function(parent) {
		var children = this._getRawChildren(parent);
		this._filters.forEach(function(f, i, a) {
			children = f.filter(this, parent, children);
		}, this);
		return children;
	},
	
	_getSelection : function() {
		var control = this.getControl();
		if (control == null || control.isDisposed()) {
			return [];
		}
		return this._getSelectionFromWidget();
	},
	
	_getSelectionFromWidget : $abstract(function() {}),

	_getSortedChildren : function(parent) {
		var children = this._getFilteredChildren(parent);
		if (this._sorter != null) {
			children = this._sorter.sort(this, children);
		}
		return children;
	},
	
	getSorter : function() {
		if ($class.instanceOf(this._sorter, gara.jsface.ViewerSorter)) 
			return this._sorter;
		return null;
	},

	_getRoot : function() {
		return this._input;
	},
	
	_hookControl : function(control) {
		control.addSelectionListener(this);
	},
	
	_handleSelect : function(event) {
		control = this.getControl();
		if (control != null && !control.isDisposed()) {
			this._updateSelection(this._getSelection());
		}
	},

	_internalRefresh : $abstract(function(element, updateLabels) {}),

	_mapElement : function(element, item) {
		if (this._elementMap == null) {
			this._elementMap = {};
		}
		
		// generating hash (unique-id)
		var d = new Date();
		var id = d.valueOf();

		if (typeof(element) == "object") {
			if (!element.hasOwnProperty("__garaUID")) {
				element.__garaUID = id;
			} else {
				id = element.__garaUID;
			}
		} else {
			id = element;
		}

		this._elementMap[id] = item;
	},

	refresh : function(first, second) {
		var element, updateLabels;
		if (typeof(first) == "boolean") {
			updateLabels = first;
		} else if (typeof(first) == "object") {
			element = first;
		}

		if (typeof(second) == "boolean") {
			updateLabels = second;
		}

		this._internalRefresh(element, updateLabels);
	},
	
	setFilters : function(filters) {
		if (filters.length == 0) {
			this._filters = [];
		} else {
			filters.forEach(function(filter, i, a){
				this.addFilter(filter);
			}, this);
		}
	},

	setInput : function(input) {
		this._unmapAllElements();
		this.$base(input);
	},

	setSorter : function(sorter) {
		if (!$class.instanceOf(sorter, gara.jsface.ViewerSorter)) {
			throw new TypeError("sorter not instance of gara.jsface.ViewerSorter");
		}

		this._sorter = sorter;
		this.refresh();
	},

	_unmapAllElements : function() {
		this._elementMap = {};
	},

	_unmapElement : function(element, item) {
		if (this._elementMap == null || element == null
				|| !(typeof(element) == "object" && element.hasOwnProperty("__garaUID"))) {
			return;
		}
		
		var id;
		if (typeof(element) == "object" && element.hasOwnProperty("__garaUID")) {
			id = element.__garaUID;
		} else {
			id = element;
		}
		
		if ($class.instanceOf(item, Array)) {
			this._elementMap[id] = item;
		} else {
			delete this._elementMap[id];
		}
	},

	_updateItem : function(widget, element) {
		this._doUpdateItem(widget, element);
	},
	
	_usingElementMap : function() {
		return this._elementMap != null;
	},
	
	_updateSelection : function(selection) {
		var event = new gara.jsface.SelectionChangedEvent(this, selection);
		this._fireSelectionChanged(event);
	},
	
	widgetSelected : function(e) {
		this._handleSelect(e);
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class AbstractListViewer
 * @extends gara.jsface.StructuredViewer
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("AbstractListViewer", {
	$extends : gara.jsface.StructuredViewer,

	/**
	 * @constructor
	 * 
	 */
	$constructor : function() {
		this._storedSelection = [];
	},

	_createListItem : $abstract(function(element, style, index) {}),
	
	/* Method declared on StructuredViewer. */
	_doFindInputItem : function(element) {
		// compare with root
		var root = this._getRoot();
		if (root == null) {
			return null;
		}

		if (root == element) {
			return this.getControl();
		}
		return null;
	},
	
	_doGetSelection : $abstract(function() {}),
	
	_doUpdateItem : function(item, element) {
		if (item.isDisposed()) {
			this._unmapElement(element, item);
			return;
		}

		item.setText(this._getLabelProviderText(this.getLabelProvider(), element));
		item.setImage(this.getLabelProvider().getImage(element));

		this._associate(element, item);
	},

	getControl : $abstract(function() {}),

	_getLabelProviderText : function(labelProvider, element) {
		var text = labelProvider.getText(element);
		if (text == null) {
			text = "";
		}

		return text;
	},
	
	_getSelectionFromWidget : function() {
		var items = this._doGetSelection();
		var list = [];
		for (var i = 0; i < items.length; i++) {
			var item = items[i];
			var e = item.getData();
			if (e != null) {
				list.push(e);
			}
		}
		return list;
	},

	inputChanged : function(input, oldInput) {
		this._listRemoveAll();
		this.getControl().setSelection([]);

		this._internalRefresh();
	},

	_internalRefresh : function(element, updateLabels) {
		if (element == null || element == this._getRoot()) {
			// store selection
			var selected = [];
			var selection = this.getControl().getSelection();
			for (var i = 0; i < selection.length; ++i) {
				selected.push(selection[i].getData());
			}

			var elementChildren = this._getSortedChildren(this._getRoot());
			var items = this.getControl().getItems();
			var itemCount = items.length;			
			var min = Math.min(elementChildren.length, items.length);
			
			
			// dispose of items, optimizing for the case where elements have
			// been deleted but not reordered, or all elements have been removed.
			var numItemsToDispose = items.length - min;
			if (numItemsToDispose > 0) {
				var children = [];
				for (var i = 0; i < elementChildren.length; i++) {
					children.push(elementChildren[i]);
				}
	
				var i = 0;
				while (numItemsToDispose > 0 && i < items.length) {
					var data = items[i].getData();
					if (data == null || items.length - i <= numItemsToDispose || !children.contains(data)) {
						if (data != null) {
							this._disassociate(items[i]);
						}
						items[i].dispose();
						items.removeAt(i);
						numItemsToDispose--;
					} else {
						i++;
					}
				}
			}

			// compare first min items, and update item if necessary
			// need to do it in two passes:
			// 1: disassociate old items
			// 2: associate new items
			// because otherwise a later disassociate can remove a mapping made for
			// a previous associate,
			// making the map inconsistent
			for (var i = 0; i < min; ++i) {
				var item = items[i];
				var oldElement = item.getData();
				if (oldElement != null) {
					var newElement = elementChildren[i];
					if (newElement != oldElement) {
						if (newElement == oldElement) {
							// update the data to be the new element, since
							// although the elements
							// may be equal, they may still have different labels
							// or elementChildren
							var data = item.getData();
							if (data != null) {
								this._unmapElement(data, item);
							}
							item.setData(newElement);
							this._mapElement(newElement, item);
						} else {
							this._disassociate(item);
							// Clear the text and image to force a label update
							item.setImage(null);
							item.setText("");

							if (storedSelection.contains(items[i])) {
								storedSelection.remove(items[i]);
							}
						}
					}
				}
			}

			for (var i = 0; i < min; ++i) {
				var item = items[i];
				var newElement = elementChildren[i];
				if (item.getData() == null) {
					// old and new elements are not equal
					this._associate(newElement, item);
					this._updateItem(item, newElement);
				} else {
					// old and new elements are equal
					if (updateLabels) {
						this._updateItem(item, newElement);
					}
				}
			}

			// add any remaining elements
			if (min < elementChildren.length) {
				for (var i = min; i < elementChildren.length; ++i) {
					//this._createListItem(widget, elementChildren[i], i);
					var item = this._createListItem(elementChildren[i], gara.jswt.JSWT.DEFAULT, i);
					this._associate(elementChildren[i], item);
				}
			}

			// restore selection
			var selection = [];
			selected.forEach(function(elem, i, arr) {
				var item = this._getItemFromElementMap(elem);
				if (item != null) {
					selection.push(item);
				}
			}, this);
			this.getControl().update();
			this.getControl().setSelection(selection);
			this.getControl().update();
		} else {
			var item = this._getItemFromElementMap(element);
			if (item != null) {
				this._updateItem(item, element);
			}
		}
		
		this.getControl().update();
	},

	_listRemoveAll : $abstract(function() {}),

	_listSetItems : $abstract(function() {})
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class ListViewer
 * @extends gara.jsface.AbstractListViewer
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("ListViewer", {
	$extends : gara.jsface.AbstractListViewer,

	$constructor : function(parent, style) {
		if ($class.instanceOf(parent, gara.jswt.List)) {
			this._list = parent;
		} else {
			this._list = new gara.jswt.List(parent, style);
		}
		this._hookControl(this._list);
	},

	_createListItem : function(el, style, index) {
		var item = new gara.jswt.ListItem(this._list, style, index);
		item.setText(this._getLabelProviderText(this.getLabelProvider(), el));
		item.setImage(this.getLabelProvider().getImage(el));
		item.setData(el);
		
		return item;
	},
	
	_doGetSelection : function() {
		return this._list.getSelection();
	},
	
	getControl : function() {
		return this._list;
	},
	
	getList : function() {
		return this._list;
	},
	
	_listRemoveAll : function() {
		this._list.removeAll();
	},
	
	_listSetItems : function(strings) {
		this._list.setItems(strings);
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class ColumnViewer
 * @extends gara.jsface.StructuredViewer 
 * @namespace gara.jsface
 * @author Thomas Gossmann
  */
$class("ColumnViewer", {
	$extends : gara.jsface.StructuredViewer,

	/**
	 * @constructor
	 */
	$constructor : function() {
		this._cell = new gara.jsface.ViewerCell(null, 0, null);
	},

	_createViewerColumn : function(columnOwner, labelProvider) {
		if (!$class.instanceOf(labelProvider, gara.jsface.CellLabelProvider)) {
			throw new TypeError("labelProvider not instance of gara.jsface.CellLabelProvider");
		}

		var column = new gara.jsface.ViewerColumn(this, columnOwner);
		column.setLabelProvider(labelProvider, false);
		return column;
	},
	
	_getColumnViewerOwner : $abstract(function(columnIndex) {}),

	_getViewerColumn : function(columnIndex) {
		var columnOwner = this._getColumnViewerOwner(columnIndex);

		if (columnOwner == null) {
			return null;
		}

		var viewer = columnOwner.getData(gara.jsface.ViewerColumn.COLUMN_VIEWER_KEY);

		if (viewer == null) {
			viewer = this._createViewerColumn(columnOwner, gara.jsface.CellLabelProvider.createViewerLabelProvider(this.getLabelProvider()));
		}

		return viewer;
	},

	_getViewerRowFromItem : $abstract(function(item) {}),

	setLabelProvider : function(labelProvider) {
		if (!($class.instanceOf(labelProvider, gara.jsface.ITableLabelProvider)
			|| $class.instanceOf(labelProvider, gara.jsface.ILabelProvider)
			|| $class.instanceOf(labelProvider, gara.jsface.CellLabelProvider))) {
			throw new TypeError("labelProvider is not instance of either gara.jsface.ITableLabelProvider, gara.jsface.ILabelProvider or gara.jsface.CellLabelProvider");
		}
		
		this._updateColumnParts(labelProvider);

		this.$base(labelProvider);
	},

	toString : function() {
		return "[gara.jsface.ColumnViewer]";
	},

	_updateCell : function(rowItem, column, element) {
		this._cell.update(rowItem, column, element);
		return this._cell;
	},

	_updateColumnParts : function(labelProvider) {
		var column, i = 0;

		while ((column = this._getViewerColumn(i++)) != null) {
			column.setLabelProvider(gara.jsface.CellLabelProvider
					.createViewerLabelProvider(labelProvider), false);
		}
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class AbstractTreeViewer
 * @extends gara.jsface.ColumnViewer
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("AbstractTreeViewer", {
	$extends : gara.jsface.ColumnViewer,

	/**
	 * @constructor
	 * Top Constructor von die AbstractListViewer
	 */
	$constructor : function() {
	},
	
	_createTreeItem : function (parent, element, index) {
		var item = this._newItem(parent, gara.jswt.JSWT.NULL, index);
		this._updateItem(item, element);
	},
	
	_disassociate : function(item) {
		this.$base(item);
		this._disassociateChildren(item);
	},
	
	_disassociateChildren : function(item) {
		var items = this._getChildren(item);
		for (var i = 0; i < items.length; i++) {
			if (items[i].getData() != null) {
				this._disassociate(items[i]);
			}
		}
	},
	
	_doGetColumnCount : function() {
		return 0;
	},
	
	_doGetSelection : $abstract(function() {}),
	
	/* Method declared on StructuredViewer. */
	_doFindInputItem : function(element) {
		// compare with root
		var root = this._getRoot();
		if (root == null) {
			return null;
		}

		if (root == element) {
			return this.getControl();
		}
		return null;
	},

	/* Method declared on StructuredViewer. */
	_doFindItem : function(element) {
		// compare with root
		var root = getRoot();
		if (root == null) {
			return null;
		}

		var items = this._getChildren(this.getControl());
		if (items != null) {
			for (var i = 0; i < items.length; i++) {
				var o = this._internalFindItem(items[i], element);
				if (o != null) {
					return o;
				}
			}
		}
		return null;
	},
	
	_doUpdateItem : function(item, element) {
		if (item.isDisposed()) {
			this._unmapElement(element, item);
			return;
		}

		var viewerRowFromItem = this._getViewerRowFromItem(item);
		var columnCount = this._doGetColumnCount();
		if (columnCount == 0) // If no columns are created then fake one
			columnCount = 1;

		for (var column = 0; column < columnCount; column++) {
			var columnViewer = this._getViewerColumn(column);
			var cellToUpdate = this._updateCell(viewerRowFromItem, column, element);
			
			columnViewer.refresh(cellToUpdate);

			// As it is possible for user code to run the event
			// loop check here.
			if (item.isDisposed()) {
				this._unmapElement(element, item);
				return;
			}
		}
		
		this._associate(element, item);
	},

	_getChildren : $abstract(function() {}),

	getControl : $abstract(function() {}),
	
	_getExpanded : $abstract(function(item) {}),

	_getLabelProviderText : function(labelProvider, element) {
		var text = labelProvider.getText(element);
		if (text == null) {
			text = "";
		}

		return text;
	},
	
	_getRawChildren : function(parent) {
		var cp = this.getContentProvider();
		if (parent == this._getRoot()) {
			return this.$base(parent);
		} else if ($class.instanceOf(cp, gara.jsface.ITreeContentProvider)) {
			var result = cp.getChildren(parent);
			if (result != null) {
				return result;
			}
		}
		
		return [];
	},

	_getSelectionFromWidget : function() {
		var items = this._doGetSelection();
		var list = [];
		for (var i = 0; i < items.length; i++) {
			var item = items[i];
			var e = item.getData();
			if (e != null) {
				list.push(e);
			}
		}
		return list;
	},

	inputChanged : function(input, oldInput) {
		this._treeRemoveAll();
		this._internalRefresh();
	},
	
	_internalFindItem : function(parent, element) {
		// compare with node
		var data = parent.getData();
		if (data != null) {
			if (data == element) {
				return parent;
			}
		}
 
		// recurse over children
		var items = this._getChildren(parent);
		for (var i = 0; i < items.length; i++) {
			var item = items[i];
			var w = this._internalFindItem(item, element);
			if (w != null) {
				return w;
			}
		}
		return null;
	},

	_internalRefresh : function(element, updateLabels) {
		var test;
		// save selected elements
		var selected = [];
		var selection = this.getControl().getSelection();
		for (var i = 0; i < selection.length; ++i) {
			selected.push(selection[i].getData());
		}
		
		if (element == null || element == this._getRoot()) {
			this._internalRefreshItems(this.getControl(), this._getRoot(), updateLabels);
		} else {
			var items = this._findItems(element);
			if (items.length != 0) {
				for (var i = 0; i < items.length; i++) {
					this._internalRefreshItems(items[i], element, updateLabels);
				}
			}
		}

		// restore selection
		var selection = [];
		selected.forEach(function(elem, i, arr) {
			var item = this._getItemFromElementMap(elem);
			if (item != null) {
				selection.push(item);
			}
		}, this);
		this.getControl().update();
		this.getControl().setSelection(selection);
		this.getControl().update();
	},
	
	_internalRefreshItems : function(widget, element, updateLabels) {
		this._updateChildren(widget, element, updateLabels);
		var children = this._getChildren(widget);
		if (children != null) {
			for (var i = 0; i < children.length; i++) {
				var item = children[i];
				var data = item.getData();
				if (data != null) {
					this._internalRefreshItems(item, data, updateLabels);
				}
			}
		}
	},
	
	_newItem : $abstract(function(parent, style, index) {}),
	
	_setExpanded : $abstract(function(item, expanded) {}),
	
	_treeRemoveAll : $abstract(function() {}),
	
	_updateChildren : function(widget, parent, updateLabels) {
		var elementChildren = this._getSortedChildren(parent);
		var tree = this.getControl();
		var items = this._getChildren(widget);

		// save the expanded elements
		var expanded = [];

		for (var i = 0; i < items.length; ++i) {
			if (this._getExpanded(items[i])) {
				var element = items[i].getData();
				if (element != null) {
					expanded.push(element);
				}
			}
		}

		var min = Math.min(elementChildren.length, items.length);
		// dispose of surplus items, optimizing for the case where elements have
		// been deleted but not reordered, or all elements have been removed.
		var numItemsToDispose = items.length - min;
		if (numItemsToDispose > 0) {
			var children = [];
			for (var i = 0; i < elementChildren.length; i++) {
				children.push(elementChildren[i]);
			}

			var i = 0;
			while (numItemsToDispose > 0 && i < items.length) {
				var data = items[i].getData();
				if (data == null || items.length - i <= numItemsToDispose || !children.contains(data)) {
					if (data != null) {
						this._disassociate(items[i]);
					}
					items[i].dispose();
					items.removeAt(i);
					numItemsToDispose--;
				} else {
					i++;
				}
			}
		}
		
		// compare first min items, and update item if necessary
		// need to do it in two passes:
		// 1: disassociate old items
		// 2: associate new items
		// because otherwise a later disassociate can remove a mapping made for
		// a previous associate,
		// making the map inconsistent
		for (var i = 0; i < min; ++i) {
			var item = items[i];
			var oldElement = item.getData();
			if (oldElement != null) {
				var newElement = elementChildren[i];
				if (newElement == oldElement) {
					// update the data to be the new element, since
					// although the elements
					// may be equal, they may still have different labels
					// or children
					var data = item.getData();
					if (data != null) {
						this._unmapElement(data, item);
					}
					item.setData(newElement);
					this._mapElement(newElement, item);
				} else {
					this._disassociate(item);
					// Clear the text and image to force a label update
					item.setImage(null);
					item.setText("");
				}
			}
		}

		for (var i = 0; i < min; ++i) {
			var item = items[i];
			var newElement = elementChildren[i];
			if (item.getData() == null) {
				// old and new elements are not equal
				this._associate(newElement, item);
				this._updateItem(item, newElement);
			} else {
				// old and new elements are equal
				if (updateLabels) {
					this._updateItem(item, newElement);
				}
			}
		}

		// Restore expanded state for items that changed position.
		for (var i = 0; i < min; ++i) {
			var item = items[i];
			var newElement = elementChildren[i];
			this._setExpanded(item, expanded.contains(newElement));
		}

		// add any remaining elements
		if (min < elementChildren.length) {
			for (var i = min; i < elementChildren.length; ++i) {
				this._createTreeItem(widget, elementChildren[i], i);
			}

			// Need to restore expanded state in a separate pass
			// because createTreeItem does not return the new item.
			// Avoid doing this unless needed.
			if (expanded.length > 0) {
				// get the items again, to include the new items
				items = this._getChildren(widget);
				for (var i = min; i < elementChildren.length; ++i) {
					// Restore expanded state for items that changed position.
					// Only need to call setExpanded if element was expanded
					if (expanded.contains(elementChildren[i])) {
						this._setExpanded(items[i], true);
					}
				}
			}
		}

	},

	setContentProvider : function(contentProvider) {
		if (!$class.instanceOf(contentProvider, gara.jsface.ITreeContentProvider)) {
			throw new TypeError("contentProvider is not type of gara.jsface.ITreeContentProvider");
		}
		this._contentProvider = contentProvider;
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class TreeViewer
 * @extends gara.jsface.AbstractTreeViewer
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("TreeViewer", {
	$extends : gara.jsface.AbstractTreeViewer,

	$constructor : function(parent, style) {
		if ($class.instanceOf(parent, gara.jswt.Tree)) {
			this._tree = parent;
		} else {
			this._tree = new gara.jswt.Tree(parent, style);
		}
		this._hookControl(this._tree);
		this._cachedRow = null;
	},
	
	_createNewRowPart : function(parent, style, rowIndex) {
		if (parent == null) {
			if (rowIndex >= 0) {
				return this._getViewerRowFromItem(new gara.jswt.TreeItem(this._tree, style, rowIndex));
			}
			return this._getViewerRowFromItem(new gara.jswt.TreeItem(this._tree, style));
		}

		if (rowIndex >= 0) {
			return this._getViewerRowFromItem(new gara.jswt.TreeItem(parent.getItem(), gara.jswt.JSWT.NONE, rowIndex));
		}

		return this._getViewerRowFromItem(new gara.jswt.TreeItem(parent.getItem(), gara.jswt.JSWT.NONE));
	},

	_getColumnViewerOwner : function(columnIndex) {
		if (columnIndex < 0 || (columnIndex > 0 && columnIndex >= this._tree.getColumnCount())) {
			return null;
		}

		if (this._tree.getColumnCount() == 0)// Hang it off the table if it
			return this._tree;

		return this._tree.getColumn(columnIndex);
	},
	
	doGetColumnCount : function() {
		return this._tree.getColumnCount();
	},
	
	_doGetSelection : function() {
		return this._tree.getSelection();
	},
	
	_getChildren : function(widget) {
		if ($class.instanceOf(widget, gara.jswt.TreeItem)
				|| $class.instanceOf(widget, gara.jswt.Tree)) {
			return widget.getItems().concat([]);
		}
		return null;
	},

	getControl : function() {
		return this._tree;
	},
	
	_getExpanded : function(item) {
		return item.getExpanded();
	},
	
	_getViewerRowFromItem : function(item) {
		if( this._cachedRow == null ) {
			this._cachedRow = new gara.jsface.TreeViewerRow(item);
		} else {
			this._cachedRow.setItem(item);
		}
		
		return this._cachedRow;
	},

	getTree : function() {
		return this._tree;
	},
	
	_newItem : function(parent, style, index) {
		var item;

		if ($class.instanceOf(parent, gara.jswt.TreeItem)) {
			item = this._createNewRowPart(this._getViewerRowFromItem(parent),
					style, index).getItem();
		} else {
			item = this._createNewRowPart(null, style, index).getItem();
		}

		return item;
	},
	
	_setExpanded : function(item, expanded) {
		item.setExpanded(expanded);
	},

	_treeRemoveAll : function() {
		this._tree.removeAll();
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class AbstractTableViewer
 * @extends gara.jsface.ColumnViewer
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("AbstractTableViewer", {
	$extends : gara.jsface.ColumnViewer,

	$constructor : function() {
		this.$base();
	},
	
	_createItem : function(element, index) {
		this._updateItem(this._internalCreateNewRowPart(gara.jswt.JSWT.NONE, index).getItem(), element);
	},
	
	/* Method declared on StructuredViewer. */
	_doFindInputItem : function(element) {
		// compare with root
		var root = this._getRoot();
		if (root == null) {
			return null;
		}

		if (root == element) {
			return this.getControl();
		}
		return null;
	},

	_doClear : $abstract(function(index) {}),

	_doGetColumn : $abstract(function() {}),

	_doGetColumnCount : $abstract(function() {}),

	_doGetItems : $abstract(function() {}),
	
	_doGetSelection : $abstract(function() {}),

	_doRemoveRange : $abstract(function(from, to) {}),

	_doUpdateItem : function(widget, element) {
		if ($class.instanceOf(widget, gara.jswt.Item)) {
			var item = widget;

			if (item.isDisposed()) {
				this._unmapElement(element, item);
				return;
			}

			var data = item.getData();
			if (data != null) {
				this._unmapElement(data, item);
			}
			item.setData(element);
			this._mapElement(element, item);

			var columnCount = this._doGetColumnCount();
			if (columnCount == 0) {
				columnCount = 1;// If there are no columns do the first one
			}

			var viewerRowFromItem = this._getViewerRowFromItem(item);

			for (var column = 0; column < columnCount || column == 0; column++) {
				var columnViewer = this._getViewerColumn(column);
				var cellToUpdate = this._updateCell(viewerRowFromItem, column, element);

				columnViewer.refresh(cellToUpdate);
			}
		}
	},

	_getColumnViewerOwner : function(columnIndex) {
		var columnCount = this._doGetColumnCount();

		if (columnIndex < 0
				|| (columnIndex > 0 && columnIndex >= columnCount)) {
			return null;
		}

		if (columnCount == 0) {
			return this.getControl();
		}

		return this._doGetColumn(columnIndex);
	},
	
	_getSelectionFromWidget : function() {
		var items = this._doGetSelection();
		var list = [];
		for (var i = 0; i < items.length; i++) {
			var item = items[i];
			var e = item.getData();
			if (e != null) {
				list.push(e);
			}
		}
		return list;
	},

	inputChanged : function(input, oldInput) {
		this._internalRefresh();
	},

	_internalCreateNewRowPart : $abstract(function(style, index){}),

	_internalRefresh : function(element, updateLabels) {
		if (element == null || element == this._getRoot()) {
			this._internalRefreshAll();
		} else {
			var w = this._findItem(element);
			if (w != null) {
				this._updateItem(w, element);
			}
		}
		this.getControl().update();
	},

	_internalRefreshAll : function() {
		var children = this._getSortedChildren(this._getRoot());
		var items = this._doGetItems();
		var min = Math.min(children.length, items.length);

		for (var i = 0; i < min; ++i) {
			var item = items[i];

			if (children[i] == item.getData()) {
				this._updateItem(item, children[i]);
				this._associate(children[i], item);
			} else {
				this._disassociate(item);
				this._doClear(i);
			}
		}

		// dispose all items beyond the end of the current elements
		if (min < items.length) {
			for (var i = min; i < items.length; ++i) {
				this._disassociate(items[i]);
			}
			
			this._doRemoveRange(min, items.length - 1);
		}

		// update disassociated items
		for (var i = 0; i < min; ++i) {

			var item = items[i];
			if (item.getData() == null) {
				this._updateItem(item, children[i]);
			}
		}

		// add any remaining elements
		for (var i = min; i < children.length; ++i) {
			this._createItem(children[i], i);
		}
	}

});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class TableViewer
 * @extends gara.jsface.StructuredViewer
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("TableViewer", {
	$extends : gara.jsface.AbstractTableViewer,
	
	$constructor : function(parent, style) {
		if ($class.instanceOf(parent, gara.jswt.Table)) {
			this._table = parent;
		} else {
			this._table = new gara.jswt.Table(parent, style);
		}
		this._hookControl(this._table);
	},
	
	_doClear : function(index) {
		this._table.clear(index);
	},

	_doGetColumn : function(index) {
		return this._table.getColumn(index);
	},

	_doGetColumnCount : function() {
		return this._table.getColumnCount();
	},
	
	_doGetItems : function() {
		return this._table.getItems();
	},
	
	_doGetSelection : function() {
		return this._table.getSelection();
	},
	
	_doRemoveRange : function(from, to) {
		this._table.removeRange(from, to);
	},

	getControl : function() {
		return this._table;
	},

	getTable : function() {
		return this._table;
	},

	_getViewerRowFromItem : function(item) {
		if (this._cachedRow == null) {
			this._cachedRow = new gara.jsface.TableViewerRow(item);
		} else {
			this._cachedRow.setItem(item);
		}

		return this._cachedRow;
	},
	
	_internalCreateNewRowPart : function(style, rowIndex) {
		var item;

		if (rowIndex >= 0) {
			item = new gara.jswt.TableItem(this._table, style, rowIndex);
		} else {
			item = new gara.jswt.TableItem(this._table, style);
		}

		return this._getViewerRowFromItem(item);
	},

//	_internalRefresh : function() {
//		this._table.update();
//	},

	refresh : function(element) {
		if (typeof(element) == "undefined") {
			element = null;
		}
		this._internalRefresh(element);
	},

	_tableRemoveAll : function() {
		this._table.removeAll();
	}
	
});

/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class CheckboxListViewer
 * @extends gara.jsface.ListViewer
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("CheckboxListViewer", {
	$extends : gara.jsface.ListViewer,
	
	$implements : [gara.jsface.ICheckable],
	
	$constructor : function(list) {
		if (!$class.instanceOf(list, gara.jswt.List)) {
			throw new TypeError("list not instance of gara.jswt.List");
		}
		this._checkStateListener = [];
		this.$base(list);
	},

	newCheckList : $static(function(parent, style) {
		var list = new gara.jswt.List(parent, style | gara.jswt.JSWT.CHECK);
		return new gara.jsface.CheckboxListViewer(list);
	}),
	
	_fireCheckStateChanged : function(event) {
		this._checkStateListener.forEach(function(listener, index, arr) {
			listener.checkStateChanged(event);
		});
	},

	addCheckStateListener : function(listener) {
		if (!$class.instanceOf(listener, gara.jsface.ICheckStateListener)) {
			throw new TypeError("listener not instance of gara.jsface.ICheckStateListener");
		}
		
		if (!this._checkStateListener.contains(listener)) {
			this._checkStateListener.push(listener);
		}
	},

	getChecked : function(element) {
		var item = this._getItemFromElementMap(element);
		if (item != null) {
			return item.getChecked();
		}
		return null;		
	},

	/**
     * Returns a list of elements corresponding to checked table items in this
     * viewer.
     * <p>
     * This method is typically used when preserving the interesting
     * state of a viewer; <code>setCheckedElements</code> is used during the restore.
     * </p>
     *
     * @return {Array} the array of checked elements
     */
	getCheckedElements : function() {
		var items = this._list.getItems();
		var checkedItems = [];
		items.forEach(function(item, index, arr) {
			if (item.getChecked()) {
				checkedItems.push(item.getData());
			}
		}, this);
		return checkedItems;
	},

	/**
     * Returns the grayed state of the given element.
     *
     * @param {object} element the element
     * @return {boolean} <code>true</code> if the element is grayed,
     *   and <code>false</code> if not grayed
     */
	getGrayed : function(element) {
		var item = this._getItemFromElementMap(element);
		if (item != null) {
			return item.getGrayed();
		}
		return null;
	},

	/**
     * Returns a list of elements corresponding to grayed nodes in this
     * viewer.
     * <p>
     * This method is typically used when preserving the interesting
     * state of a viewer; <code>setGrayedElements</code> is used during the restore.
     * </p>
     *
     * @return {Array} the array of grayed elements
     */
	getGrayedElements : function() {
		var items = this._list.getItems();
		var checkedItems = [];
		items.forEach(function(item, index, arr) {
			if (item.getGrayed()) {
				checkedItems.push(item.getData());
			}
		}, this);
		return checkedItems;
	},

	_handleSelect : function(event) {
		this.$base(event);
		
		if (event.garaDetail && event.garaDetail == gara.jswt.JSWT.CHECK) {
			var item = event.item;
			var data = item.getData();
			if (data != null) {
				// negated state, because state changes after mouseup and we are in mousedown event
				this._fireCheckStateChanged(new gara.jsface.CheckStateChangedEvent(this, data, !item.getChecked()));
			}
		}
	},

	removeCheckStateListener : function(listener){
		if (!$class.instanceOf(listener, gara.jsface.ICheckStateListener)) {
			throw new TypeError("listener not instance of gara.jsface.ICheckStateListener");
		}
		
		this._checkStateListener.remove(listener);
	},

	/**
     * Sets to the given value the checked state for all elements in this viewer.
     *
     * @param {boolean} state <code>true</code> if the element should be checked,
     *  and <code>false</code> if it should be unchecked
     */
    setAllChecked : function(state) {
        var items = this._list.getItems();
		items.forEach(function(item, index, arr) {
			item.setChecked(state);
		}, this);
    },

    /**
     * Sets to the given value the grayed state for all elements in this viewer.
     *
     * @param {boolean} state <code>true</code> if the element should be grayed,
     *  and <code>false</code> if it should be ungrayed
     */
    setAllGrayed : function(state) {
        var items = this._list.getItems();
		items.forEach(function(item, index, arr) {
			item.setGrayed(state);
		}, this);
    },

	setChecked : function(element, checked) {
		var item = this._getItemFromElementMap(element);
		if (item != null) {
			item.setChecked(checked);
			return true;
		}
		return false;
	},
	
	/**
     * Sets which nodes are checked in this viewer.
     * The given list contains the elements that are to be checked;
     * all other nodes are to be unchecked.
     * <p>
     * This method is typically used when restoring the interesting
     * state of a viewer captured by an earlier call to <code>getCheckedElements</code>.
     * </p>
     *
     * @param {Array} elements the list of checked elements (element type: <code>Object</code>)
     */
    setCheckedElements : function(elements) {
		var items = this._list.getItems();
		items.forEach(function(item, index, arr) {
			var element = item.getData();
			if (element != null) {
				var check = elements.contains(element);
				// only set if different, to avoid flicker
				if (item.getChecked() != check) {
				    item.setChecked(check);
				}
			}
		});
	},

	/**
     * Sets the grayed state for the given element in this viewer.
     *
     * @param {object} element the element
     * @param {boolean} state <code>true</code> if the item should be grayed,
     *  and <code>false</code> if it should be ungrayed
     * @return {boolean} <code>true</code> if the element is visible and the gray
     *  state could be set, and <code>false</code> otherwise
     */
	setGrayed : function(element, grayed) {
		var item = this._getItemFromElementMap(element);
		if (item != null) {
			item.setGrayed(grayed);
			return true;
		}
		return false;
	},
	
	/**
     * Sets which nodes are grayed in this viewer.
     * The given list contains the elements that are to be grayed;
     * all other nodes are to be ungrayed.
     * <p>
     * This method is typically used when restoring the interesting
     * state of a viewer captured by an earlier call to <code>getGrayedElements</code>.
     * </p>
     *
     * @param elements the array of grayed elements
     *
     * @see #getGrayedElements
     */
	setGrayedElements : function(elements) {
		var items = this._list.getItems();
		items.forEach(function(item, index, arr) {
			var element = item.getData();
			if (element != null) {
				var check = elements.contains(element);
				// only set if different, to avoid flicker
				if (item.getGrayed() != check) {
				    item.setGrayed(check);
				}
			}
		});
	},
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class ViewerCell
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("ViewerCell", {
	
	$constructor : function(rowItem, columnIndex, element) {
		this._row = rowItem;
		this._columnIndex = columnIndex;
		this._element = element;
	},
	
	getColumnIndex : function() {
		return this._columnIndex;
	},
	
	getControl : function() {
		return this._row.getControl();
	},
	
	getElement : function() {
		if (this._element != null) {
			return this._element;
		}
		return this._row.getElement();
	},
	
	getText : function() {
		return this._row.getText(columnIndex);
	},
	
	getImage : function() {
		return this._row.getImage(columnIndex);
	},
	
	getItem : function() {
		return this._row.getItem();
	},
	
	getViewerRow : function() {
		return this._row;
	},
	
	setText : function(text) {
		this._row.setText(this._columnIndex, text);
	},
	
	setImage : function(image) {
		this._row.setImage(this._columnIndex, image);
	},
	
	setColumn : function(columnIndex) {
		this._columnIndex = columnIndex;
	},
	
	update : function(rowItem, columnIndex, element) {
		this._row = rowItem;
		this._columnIndex = columnIndex;
		this._element = element;
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class ViewerColumn
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("ViewerColumn", {

	COLUMN_VIEWER_KEY : $static("jsface.columnViewer"),

	/**
	 * @constructor
	 * Create a new instance of the receiver at columnIndex.
	 * 
	 * @param viewer
	 *            the viewer the column is part of
	 * @param columnOwner
	 *            the widget owning the viewer in case the widget has no columns
	 *            this could be the widget itself
	 */
	$constructor : function(viewer, columnOwner) {
		if (!$class.instanceOf(viewer, gara.jsface.ColumnViewer)) {
			throw new TypeError("viewer not instance of gara.jsface.ColumnViewer");
		}
		
		if (!$class.instanceOf(columnOwner, gara.jswt.Widget)) {
			throw new TypeError("columnOwner not instance of gara.jswt.Widget");
		}

		columnOwner.setData(this.COLUMN_VIEWER_KEY, this);
		this._labelProvider = null;
	},

	/**
	 * @method
	 * Return the label provider for the receiver.
	 * 
	 * @return {gara.jsface.CellLabelProvider}
	 */
	getLabelProvider : function() {
		return this._labelProvider;
	},

	/**
	 * @method
	 * Set the label provider for the column. Subclasses may extend but must
	 * call the super implementation.
	 * 
	 * @param {gara.jsface.CellLabelProvider} labelProvider
	 *            the new CellLabelProvider
	 * @param {bool} registerListener
	 *            wether a listener should registered on the labelProvider or not
	 */
	setLabelProvider : function(labelProvider, registerListener) {
		if (!$class.instanceOf(labelProvider, gara.jsface.CellLabelProvider)) {
			throw new TypeError("labelProvider not instance of gara.jsface.CellLabelProvider");
		}
		this._labelProvider = labelProvider;
	},

	/**
	 * @method
	 * Refresh the cell
	 * 
	 * @param {gara.jsface.ViewerCell} cell
	 */
	refresh : function(cell) {
		if (!$class.instanceOf(cell, gara.jsface.ViewerCell)) {
			throw new TypeError("cell not instance of gara.jsface.ViewerCell");
		}

		this.getLabelProvider().update(cell);
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class ViewerRow
 * @extends gara.jsface.ViewerRow
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("ViewerRow", {
	$constructor : function() {
		this.$base();
	},
	
	getItem : $abstract(function() {}),
	
	getColumnCount : $abstract(function() {}),
	
	getImage : $abstract(function(columnIndex) {}),
	
	setImage : $abstract(function(columnIndex, image) {}),
	
	getText : $abstract(function(columnIndex) {}),
	
	setText : $abstract(function(columnIndex, text) {}),
	
	getCell : function(column) {
		if (column >= 0) {
			return new gara.jsface.ViewerCell(this, column, this.getElement());
		}
		
		return null;
	},
	
	getElement : $abstract(function() {}),

	getControl : $abstract(function() {})
	
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class TableViewerRow
 * @extends gara.jsface.ViewerRow
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("TableViewerRow", {
	$extends : gara.jsface.ViewerRow,

	$constructor : function(item) {
		if (!$class.instanceOf(item, gara.jswt.TableItem)) {
			throw new TypeError("item is not instance of gara.jswt.TableItem");
		}
		this._item = item;
	},

	getItem : function() {
		return this._item;
	},

	getColumnCount : function() {
		return this._item.getParent().getColumnCount();		
	},

	getImage : function(columnIndex) {
		return this._item.getImage(columnIndex);
	},

	getText : function(columnIndex) {
		return this._item.getText(columnIndex);
	},

	getElement : function() {
		return this._item.getData();
	},

	getControl : function() {
		return this._item.getParent();
	},

	setText : function(columnIndex, text) {
		this._item.setText(columnIndex, text == null ? "" : text);
	},

	setImage : function(columnIndex, image) {
		var oldImage = this._item.getImage(columnIndex);
		if (oldImage != image) {
			this._item.setImage(columnIndex, image);
		}
	},

	setItem : function(item) {
		if (!$class.instanceOf(item, gara.jswt.TableItem)) {
			throw new TypeError("item is not instance of gara.jswt.TableItem");
		}
		this._item = item;
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class TreeViewerRow
 * @extends gara.jsface.ViewerRow
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("TreeViewerRow", {
	$extends : gara.jsface.ViewerRow,

	$constructor : function(item) {
		if (!$class.instanceOf(item, gara.jswt.TreeItem)) {
			throw new TypeError("item is not instance of gara.jswt.TreeItem");
		}
		this._item = item;
	},

	getItem : function() {
		return this._item;
	},

	getColumnCount : function() {
		return this._item.getParent().getColumnCount();		
	},

	getImage : function(columnIndex) {
		return this._item.getImage(columnIndex);
	},

	getText : function(columnIndex) {
		return this._item.getText(columnIndex);
	},

	getElement : function() {
		return this._item.getData();
	},

	getControl : function() {
		return this._item.getParent();
	},

	setText : function(columnIndex, text) {
		this._item.setText(columnIndex, text == null ? "" : text);
	},

	setImage : function(columnIndex, image) {
		var oldImage = this._item.getImage(columnIndex);
		if (oldImage != image) {
			this._item.setImage(columnIndex, image);
		}
	},

	setItem : function(item) {
		if (!$class.instanceOf(item, gara.jswt.TreeItem)) {
			throw new TypeError("item is not instance of gara.jswt.TreeItem");
		}
		this._item = item;
	}
});

/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class ViewerComparator
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("ViewerComparator", {

	$constructor : function() {
	},

	/**
     * Returns the category of the given element. The category is a
     * number used to allocate elements to bins; the bins are arranged
     * in ascending numeric order. The elements within a bin are arranged
     * via a second level sort criterion.
     * <p>
     * The default implementation of this framework method returns
     * <code>0</code>. Subclasses may reimplement this method to provide
     * non-trivial categorization.
     * </p>
     *
     * @param {object} element the element
     * @return the category
     */
	category : function(element) {
        return 0;
	},

	/**
     * Returns a negative, zero, or positive number depending on whether
     * the first element is less than, equal to, or greater than
     * the second element.
     * <p>
     * The default implementation of this method is based on
     * comparing the elements' categories as computed by the <code>category</code>
     * framework method. Elements within the same category are further 
     * subjected to a case insensitive compare of their label strings, either
     * as computed by the content viewer's label provider, or their 
     * <code>toString</code> values in other cases. Subclasses may override.
     * </p>
     * 
     * @param {gara.jsface.Viewer} viewer the viewer
     * @param {object} e1 the first element
     * @param {object} e2 the second element
     * @return a negative number if the first element is less  than the 
     *  second element; the value <code>0</code> if the first element is
     *  equal to the second element; and a positive number if the first
     *  element is greater than the second element
     */
    compare : function(e1, e2) {
		var a = e1.toString().toLowerCase();
		var b = e2.toString().toLowerCase();

		if (a < b) {
			return -1;
		} else if (a > b) {
			return 1;
		}

		return 0;
	},

	/**
     * Returns whether this viewer sorter would be affected 
     * by a change to the given property of the given element.
     * <p>
     * The default implementation of this method returns <code>false</code>.
     * Subclasses may reimplement.
     * </p>
     *
     * @param {object} element the element
     * @param {string} property the property
     * @return <code>true</code> if the sorting would be affected,
     *    and <code>false</code> if it would be unaffected
     */
    isSorterProperty : function(element, property) {
        return false;
    },

	/**
     * Sorts the given elements in-place, modifying the given array.
     * <p>
     * The default implementation of this method uses the 
     * Array#sort algorithm on the given array, 
     * calling <code>compare</code> to compare elements.
     * </p>
     * <p>
     * Subclasses may reimplement this method to provide a more optimized implementation.
     * </p>
     *
     * @param {gara.jsface.Viewer} viewer the viewer
     * @param {object[]} elements the elements to sort
     */
    sort : function(viewer, elements) {
		console.log("sort");
		return elements.sort(this.compare);
    },

	toString : function() {
		return "[gara.jsface.ViewerComparator]";
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class ViewerSorter
 * @namespace gara.jsface
 * @extends gara.jsface.ViewerComparator
 * @author Thomas Gossmann
 */
$class("ViewerSorter", {
	$extends : gara.jsface.ViewerComparator,

	$constructor : function() {
	},

	toString : function() {
		return "[gara.jsface.ViewerSorter]";
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class ViewerFilter
 * @namespace gara.jsface
 * @author Thomas Gossmann
  */
$class("ViewerFilter", {
	
	/**
	 * @constructor
	 */
	$constructor : function() {
	},
	
	/**
     * Filters the given elements for the given viewer.
     * The input array is not modified.
     * <p>
     * The default implementation of this method calls 
     * <code>select</code> on each element in the array, 
     * and returns only those elements for which <code>select</code>
     * returns <code>true</code>.
     * </p>
     * @param {gara.jsface.Viewer} viewer the viewer
     * @param {object} parent the parent element
     * @param {object[]} elements the elements to filter
     * @return {object[]} the filtered elements
     */
    filter : function(viewer, parent, elements) {
        out = [];
		elements.forEach(function(elem, index, arr){
			if (this.select(viewer, parent, elem)) {
				out.push(elem);
			}
		}, this);

        return out;
    },
    
    /**
     * Returns whether this viewer filter would be affected 
     * by a change to the given property of the given element.
     * <p>
     * The default implementation of this method returns <code>false</code>.
     * Subclasses should reimplement.
     * </p>
     *
     * @param {object} element the element
     * @param {String} property the property
     * @return <code>true</code> if the filtering would be affected,
     *    and <code>false</code> if it would be unaffected
     */
    isFilterProperty : function(element, property) {
        return false;
    },

    /**
     * Returns whether the given element makes it through this filter.
     *
     * @param {gara.jsface.Viewer} viewer the viewer
     * @param {object} parentElement the parent element
     * @param {object} element the element
     * @return {boolean} <code>true</code> if element is included in the
     *   filtered set, and <code>false</code> if excluded
     */
    select : $abstract(function(viewer, parentElement, element){}),

	toString : function() {
		return "[gara.jsface.ViewerFilter]";
	}
});
/*	$Id $

		gara - Javascript Toolkit
	===========================================================================

		Copyright (c) 2007 Thomas Gossmann
	
		Homepage:
			http://gara.creative2.net

		This library is free software;  you  can  redistribute  it  and/or
		modify  it  under  the  terms  of  the   GNU Lesser General Public
		License  as  published  by  the  Free Software Foundation;  either
		version 2.1 of the License, or (at your option) any later version.

		This library is distributed in  the hope  that it  will be useful,
		but WITHOUT ANY WARRANTY; without  even  the  implied  warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See  the  GNU
		Lesser General Public License for more details.

	===========================================================================
*/

/**
 * @class PatternFilter
 * @extends ViewerFilter
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("PatternFilter", {
	$extends : gara.jsface.ViewerFilter,

	/**
	 * @constructor
	 */
	$constructor : function() {
		this._pattern = "";
	},

	isElementVisible : function(viewer, element) {
		return this._isParentMatch(viewer, element) || this._isLeafMatch(viewer, element);
	},

	_isLeafMatch : function(viewer, element) {
		var lblProvider = viewer.getLabelProvider();
		if ($class.instanceOf(lblProvider, gara.jsface.ITableLabelProvider)) {
			var cols = viewer.getControl().getColumnCount();
			for (var i = 0; i < cols; ++i) {
				var labelText = lblProvider.getColumnText(element, i);
				if (labelText != null) {
					var result = this._match(labelText);
					if (result) {
						return result;
					}
				}
			}
			return false;
		} else {
			var labelText = lblProvider.getText(element);
			if (labelText == null) {
				return false;
			}
	        return this._match(labelText);
		}

	},

	_isParentMatch : function(viewer, element) {
		var cp = viewer.getContentProvider();

		if ($class.instanceOf(cp, gara.jsface.ITreeContentProvider)) {
			var children = cp.getChildren(element);

	        if (children != null && children.length > 0) {
				var elementFound = false;
				for (var i = 0; i < children.length && !elementFound; i++) {
					elementFound = this.isElementVisible(viewer, children[i]);
				}
				return elementFound;
			}
		}
        return false;
	},

	_match : function(text) {
		return text.toLowerCase().indexOf(this._pattern.toLowerCase()) != -1;
	},

	select : function(viewer, parentElement, element) {
		if (this._pattern == "") {
			return true;
		}
		var result = this.isElementVisible(viewer, element);
		return result;
	},
	
	setPattern : function(pattern) {
		this._pattern = pattern;
	},

	toString : function() {
		return "[gara.jsface.PatternFilter]";
	}
});
	
var jswtPkg = new gara.Package({
	name : "jswt",
	exports : "IBaseLabelProvider,ILabelProvider,ITableLabelProvider,LabelProvider"
});
gara.jsface.namespace = jswtPkg.namespace;
gara.jsface.toString = function() {
	return "[gara.jsface]";
}

$package("");
})();

