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
/*	$Id: EventManager.class.js 79 2007-08-23 20:34:07Z tgossmann $

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

	$constructor : function() {
		this._listeners = [];
		//base2.DOM.bind(document);
		base2.DOM.EventTarget(window);
		//base2.DOM.bind(window);
		window.addEventListener("unload", this, false);
//		var eventMgr = this;
//		window.onunload = function(e) {
//			eventMgr.handleEvent(e);
//		}
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
	addListener : function(domNode, type, listener) {
//		console.log("EventMngr.addListener: " + domNode.nodeName + " " + type + " " + listener);
		domNode.addEventListener(type, listener, false);
		
		var event = {
			domNode : domNode,
			type : type,
			listener : listener
		}
		this._listeners.push(event);
		
		return event;
	},

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
	removeListener : function(e) {
		e.domNode.removeEventListener(e.type, e.listener, false);

		if (this._listeners.contains(e)) {
			this._listeners.remove(e);
		}
	},

	/**
	 * @method
	 * 
	 * Removes all stored listeners on the page unload.
	 * @private
	 */
	_unregisterAllEvents : function() {
		while (this._listeners.length > 0) {
			var event = this._listeners.pop();
			this.removeListener(event);
		}
	},
	
	toString : function() {
		return "[gara.EventManager]";
	}
});
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
/*	$Id: onDOMLoaded.function.js 63 2007-07-20 15:36:50Z tgossmann $

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
var onDOMLoaded = gara.onDOMLoaded = function(f) {
	/* for Mozilla/Opera9 */
	if (document.addEventListener) {
		document.addEventListener("DOMContentLoaded", f, false);
	}
	
	/* for Internet Explorer */
	else if (window.ActiveX) {
		document.write("<scr"+"ipt id=__ie_onload defer src=javascript:void(0)><\/script>");
		var script = document.getElementById("__ie_onload");
		script.onreadystatechange = function() {
			if (this.readyState == "complete") {
				f(); // call the onload handler
			}
		};
	}

	/* for Safari */
	else if (/WebKit/i.test(navigator.userAgent)) { // sniff
		var _timer = setInterval(function() {
			if (/loaded|complete/.test(document.readyState)) {
				f(); // call the onload handler
			}
		}, 10);
	}

	/* for other browsers */
	else {
		window.onload = f;
	}
}
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
	 * @field
	 * Style constant for full row selection behavior (value is 1&lt;&lt;16).
	 */
	FULL_SELECTION : $static(1 << 16),

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
/*	$Id: Widget.class.js 91 2007-12-09 18:58:43Z tgossmann $

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
		this._style = typeof(style) == "undefined" ? JSWT.DEFAULT : style;
		this._data = null;
		this._dataMap = {};
		
		this._className = "";
		this._baseClass = "";
		this._listener = {};
		
		this._disposed = false;
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
		this.registerListener(eventType, listener);
	},

	dispose : function() {
		this._disposed = true;
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

	registerListener : $abstract(function(eventType, listener){}),

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
	 * Removes a listener from this item
	 * 
	 * @author Thomas Gossmann
	 * @param {String} eventType the type of the event
	 * @param {Object} listener the listener
	 * @return {void}
	 */
	removeListener : function(eventType, listener) {
		this._listener[eventType].remove(listener);
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
	
	toString : function() {
		return "[gara.jswt.Widget]";
	}
});
/*	$Id: Control.class.js 91 2007-12-09 18:58:43Z tgossmann $

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
	
	setMenu : function(menu) {
		if (!$class.instanceOf(menu, gara.jswt.Menu)) {
			throw new TypeError("menu is not a gara.jswt.Menu");
		}

		this._menu = menu;
		this.addListener("mousedown", this);
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

		this._items = [];
		this._selection = [];
		this._selectionListener = [];
		this._activeItem = null;
		this._shiftItem = null;
		this._className = this._baseClass = "jsWTList";
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
		if (!$class.instanceOf(item, gara.jswt.ListItem)) {
			throw new TypeError("item is not type of gara.jswt.ListItem");
		}
		// set a previous active item inactive
		if (this._activeItem != null) {
			this._activeItem.setActive(false);
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
		if (!$class.instanceOf(listener, gara.jswt.SelectionListener)) {
			throw new TypeError("listener is not instance of gara.jswt.SelectionListener");
		}

		this._selectionListener.push(listener);
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
		if (!$class.instanceOf(item, gara.jswt.ListItem)) {
			throw new TypeError("item not instance of gara.jswt.ListItem");
		}

		if (this._selection.contains(item)) {
			this._selection.remove(item);
			this.notifySelectionListener();
			item.setUnselected();
			this._shiftItem = item;
			this._activateItem(item);
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
		for (var i = 0, len = this._items.length; i < len; ++i) {
			this.deselect(this._items[i]);
		}
		this.update();
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
	 * Handles events on the list. Implements DOMEvent Interface by the W3c.
	 * 
	 * @author Thomas Gossmann
	 * @param {Event} e event the users triggers
	 * @return {void}
	 */
	handleEvent : function(e) {
		// special events for the list
		var obj = e.target.obj || null;
		
//		console.log("List.handleEvent(" + e.type + ")");
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
				
				if (e.which == 3 && this._menu != null) {
					if (this.domref.style.position != "") {
						this._menu.setLocation(e.layerX, e.layerY);
					} else {
						this._menu.setLocation(e.clientX, e.clientY);
					}
					this._menu.setVisible(true);
					return false;
				}
				break;

			case "keyup":
			case "keydown":
			case "keypress":

				this._items.forEach(function(item, index, arr) {
					item.handleEvent(e);
				});

				this._notifyExternalKeyboardListener(e, this, this);
				
				if (e.type == "keydown") {
					this._handleKeyEvent(e);					
				}
				break;
		}

		e.stopPropagation();
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
			case 38 : // up
				// determine previous item
				var prev = false;
				var activeIndex = this.indexOf(this._activeItem);
				
				if (activeIndex != 0) {
					prev = this._items[activeIndex - 1];
				}

				if (prev) {
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

			case 40 : // down
				// determine next item
				var next = false;
				var activeIndex = this.indexOf(this._activeItem);
				
				// item is last;
				if (activeIndex != this._items.length - 1) {
					next = this._items[activeIndex + 1];
				}

				if (next) {
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

			case 32 : // space
				if (this._selection.contains(this._activeItem) && e.ctrlKey) {
					this.deselect(this._activeItem);
				} else {
					this.select(this._activeItem, true);
				}
				break;
				
			case 36 : // home
				if (!e.ctrlKey && !e.shiftKey) {
					this.select(this._items[0], false);
				} else if (e.shiftKey) {
					this.selectRange(this._items[0], false);
				} else if (e.ctrlKey) {
					this._activateItem(this._items[0]);
				}
				break;
				
			case 35 : // end
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
			this._selectionListener[i].widgetSelected(this);
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
	registerListener : function(eventType, listener) {
		if (this.domref != null) {
			gara.EventManager.getInstance().addListener(this.domref, eventType, listener);
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
		var item = this._items.removeAt(index)[0];
		this.domref.removeChild(item.domref);
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
	 * Removes all items from the list
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	removeAll : function() {
		while (this._items.length) {
			var item = this._items.pop();
			this.domref.removeChild(item.domref);
			delete item;
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
		if (!$class.instanceOf(item, gara.jswt.ListItem)) {
			throw new TypeError("item not instance of gara.jswt.ListItem");
		}

		if (!_add || (this._style & JSWT.SINGLE) == JSWT.SINGLE) {
			while (this._selection.length) {
				this._selection.pop().setUnselected();
			}
		}

		if (!this._selection.contains(item)) {
			this._selection.push(item);
			item.setSelected();
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
		for (var i = 0, len = this._items.length; i < len; ++i) {
			this.select(this._items[i], true);
		}
		this.update();
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
		if (!$class.instanceOf(item, gara.jswt.ListItem)) {
			throw new TypeError("item not instance of gara.jswt.ListItem");
		}

		// only, when selection mode is MULTI
		if (!_add) {
			while (this._selection.length) {
				this._selection.pop().setUnselected();
			}
		}

		if ((this._style & JSWT.MULTI) == JSWT.MULTI) {
			var indexShift = this.indexOf(this._shiftItem);
			var indexItem = this.indexOf(item);
			var from = indexShift > indexItem ? indexItem : indexShift;
			var to = indexShift < indexItem ? indexItem : indexShift;

			for (var i = from; i <= to; ++i) {
				this._selection.push(this._items[i]);
				this._items[i].setSelected();
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
		if (!$class.instanceOf(items, Array)) {
			throw new TypeError("items are not instance of an Array");
		}

		this._selection = items;
		this.notifySelectionListener();
	},

	toString : function() {
		return "[gara.jswt.List]";
	},

	/**
	 * @method
	 * Updates the list!
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	update : function() {
		// create widget if domref equals null
		if (this.domref == null) {
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
					this.registerListener(eventType, elem);
				}, this);
			}

			/* If parent is not a composite then it *must* be a HTMLElement
			 * but because of IE there is no cross-browser check. Or no one I know of.
			 */
			if (!$class.instanceOf(this._parent, gara.jswt.Composite)) {
				this._parent.appendChild(this.domref);
			}
		}

		this.removeClassName("jsWTListFullSelection");

		if ((this._style & JSWT.FULL_SELECTION) == JSWT.FULL_SELECTION) {
			this.addClassName("jsWTListFullSelection");
		}

		this.domref.className = this._className;

		// update items
		this._items.forEach(function(item, index, arr) {

			// create item ...
			if (!item.isCreated()) {
				var node = item.create();
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
			}
		}, this);
	}
});
/*	$Id: Tree.class.js 125 2007-12-30 14:55:37Z tgossmann $

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

		this._shiftItem = null;
		this._activeItem = null;
		this._className = this._baseClass = "jsWTTree";
		
		this._selection = [];
		this._selectionListeners = [];
		this._items = [];
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
		if (!$class.instanceOf(item, gara.jswt.TreeItem)) {
			throw new TypeError("item is not type of gara.jswt.TreeItem");
		}
		// set a previous active item inactive
		if (this._activeItem != null) {
			this._activeItem.setActive(false);
		}

		this._activeItem = item;
		this._activeItem.setActive(true);
		this.update();
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
				+ getDescendents(parentItem)
				+ 1;

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
	
	/**
	 * @method
	 * Deselects a specific item
	 * 
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TreeItem} item the item to deselect
	 * @return {void}
	 */
	deselect : function(item) {
		if (!$class.instanceOf(item, gara.jswt.TreeItem)) {
			throw new TypeError("item is not type of gara.jswt.TreeItem");
		}
	
		if (this._selection.contains(item)
				&& item.getParent() == this) {
			this._selection.remove(item);
			this._notifySelectionListener();
			item.setChecked(false);
			this._shiftItem = item;
			this._activateItem(item);
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
		for (var i = this._selection.length; i >= 0; --i) {
			this.deselect(this._selection[i]);
		}
		this.update();
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
		// special events for the tree
		var obj = e.target.obj || null;
		var item = null;
		
		if ($class.instanceOf(obj, gara.jswt.TreeItem)) {
			item = obj;
		}
		
		switch (e.type) {
			case "mousedown":
				if (!this._hasFocus) {
					this.forceFocus();
				}

				if (item != null) {
					if (e.target != item.toggleNode) {
						if (e.ctrlKey && !e.shiftKey) {
							if (this._selection.contains(item)) {
								this.deselect(item);
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
				
				if (e.which == 3 && this._menu != null) {
					if (this.domref.style.position != "") {
						this._menu.setLocation(e.layerX, e.layerY);
					} else {
						this._menu.setLocation(e.clientX, e.clientY);
					}
					this._menu.setVisible(true);
				}
				break;

			case "dblclick":
				// dummy handler. dblclick event is passed to the item
				break;

			case "keyup":
			case "keydown":
			case "keypress":
			
				this._items.forEach(function(item, index, arr) {
					item.handleEvent(e);
				});

				this._notifyExternalKeyboardListener(e, this, this);
				
				if (e.type == "keydown") {
					this._handleKeyEvent(e);					
				}
				break;
		}

		if (item != null) {
			item.handleEvent(e);
		}

		e.stopPropagation();
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
					this.deselect(this._activeItem);
				} else {
					this._select(this._activeItem, true);
				}
				break;
				
			case 36 : // home
				if (!e.ctrlKey && !e.shiftKey) {
					this._select(this._items[0], false);
				} else if (e.shiftKey) {
					this._selectShift(this._items[0], false);
				} else if (e.ctrlKey) {
					this._activateItem(this._items[0]);
				}
				break;
				
			case 35 : // end
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
			item.widgetSelected(this);
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
	registerListener : function(eventType, listener) {
		if (this.domref != null) {
			gara.EventManager.getInstance().addListener(this.domref, eventType, listener);
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
		var item = this._firstLevelItems.removeAt(index)[0];
		this.domref.removeChild(item.domref);
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
		if (!$class.instanceOf(item, gara.jswt.SelectionListener)) {
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
		if (!$class.instanceOf(item, gara.jswt.TreeItem)) {
			throw new TypeError("item is not type of gara.jswt.TreeItem");
		}

		if (!_add || (this._style & JSWT.MULTI) != JSWT.MULTI) {
			while (this._selection.length) {
				this._selection.pop().setChecked(false);
			}
		}

		if (!this._selection.contains(item)
				&& item.getParent() == this) {
			this._selection.push(item);
			item.setChecked(true);
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
		this._items.forEach(function(item, index, arr) {
			this._select(item, true);
		}, this);
		this.update();
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
		if (!$class.instanceOf(item, gara.jswt.TreeItem)) {
			throw new TypeError("item is not type of gara.jswt.TreeItem");
		}

		if (!_add) {
			while (this._selection.length) {
				this._selection.pop().setChecked(false);
			}
		}

		if ((this._style & JSWT.MULTI) == JSWT.MULTI) {
			var indexShift = this._items.indexOf(this._shiftItem);
			var indexItem = this._items.indexOf(item);
			var from = indexShift > indexItem ? indexItem : indexShift;
			var to = indexShift < indexItem ? indexItem : indexShift;

			for (var i = from; i <= to; ++i) {
				this._selection.push(this._items[i]);
				this._items[i].setChecked(true);
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
		if (!$class.instanceOf(items, Array)) {
			throw new TypeError("items are not instance of an Array");
		}

		this._selection = items;
		this._notifySelectionListener();
	},

	toString : function() {
		return "[gara.jswt.Tree]";
	},
	
	/**
	 * @method
	 * Updates the widget
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	update : function() {
		if (this.domref == null) {
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
			this.addListener("dblclick", this);

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
				this._parent.appendChild(this.domref);
			}
		}

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
		this._updateItems(this._firstLevelItems, this.domref);
	},
	
	/**
	 * @method
	 * Update Items
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @param {gara.jswt.TreeItem[]} items to update
	 * @param {HTMLElement} parentNode the parent dom node
	 * @return {void}  
	 */
	_updateItems : function(items, parentNode) {
		var itemCount = items.length;
		items.forEach(function(item, index, arr) {
			// create item ...
			if (!item.isCreated()) {
				item.create();
				parentNode.appendChild(item.domref);
			}

			// ... or update it
			if (item.hasChanged()) {
				item.update();
				item.releaseChange();
			}

			if (item.getItemCount() > 0) {
				var childContainer = item._getChildContainer();
				this._updateItems(item.getItems(), childContainer);			
			}
		}, this);
	}
});
/*	$Id: TabFolder.class.js 91 2007-12-09 18:58:43Z tgossmann $

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

		this._tabbar = null;
		this._clientArea = null;
		this._className = this._baseClass = "jsWTTabFolder";
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
		if (!$class.instanceOf(item, gara.jswt.TabItem)) {
			throw new TypeError("item is not type of gara.jswt.TabItem");
		}

		var count = this.getItemCount();
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
		if (!$class.instanceOf(item, gara.jswt.TabItem)) {
			throw new TypeError("item is not type of gara.jswt.TabItem");
		}
		
		if (this._activeItem != null) {
			this._activeItem.setActive(false);
		}
		
		this._activeItem = item;
		item._setActive(true);

		// clean up client area
		for (var i = 0, len = this._clientArea.childNodes.length; i < len; ++i) {
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
		}

		this.update();

		this._selection = [];
		this._selection.push(item);
		this._notifySelectionListener();
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
		var obj = e.target.obj || null;
		switch (e.type) {
			case "mousedown":
				if (!this._hasFocus) {
					this.forceFocus();
				}

				if ($class.instanceOf(obj, gara.jswt.TabItem)) {
					var item = obj;

					this._activateItem(item);
				}
				
				if (e.which == 3 && this._menu != null) {
					if (this.domref.style.position != "") {
						this._menu.setLocation(e.layerX, e.layerY);
					} else {
						this._menu.setLocation(e.clientX, e.clientY);
					}
					this._menu.setVisible(true);
					return false;
				}
				break;
			
						
			case "keyup":
			case "keydown":
			case "keypress":
			
				this._items.forEach(function(item, index, arr) {
					item.handleEvent(e);
				});

				this._notifyExternalKeyboardListener(e, this, this);
				
				break;
		}

		if (e.target != this.domref) {
			e.stopPropagation();
		}
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
			this._selectionListener[i].widgetSelected(this);
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
	registerListener : function(eventType, listener) {
		if (this.domref != null) {
			gara.EventManager.getInstance().addListener(this.domref, eventType, listener);
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
	 * updates this tabfolder
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	update : function() {
		var firstBuild = false;
		if (this.domref == null) {
			this.domref = document.createElement("div");
			this.domref.obj = this;
			this.domref.control = this;
			base2.DOM.EventTarget(this.domref);

			this._tabbar = document.createElement("ul");
			this._tabbar.obj = this;
			this._tabbar.control = this;
			base2.DOM.EventTarget(this._tabbar);

			this._clientArea = document.createElement("div");
			this._clientArea.className = "jsWTTabClientArea"
			base2.DOM.EventTarget(this._clientArea);

			if (this._style == JSWT.TOP) {
				this.domref.appendChild(this._tabbar);
				this.domref.appendChild(this._clientArea);
				this._tabbar.className = "jsWTTabbar jsWTTabbarTop";
			} else {
				this.domref.appendChild(this._clientArea);
				this.domref.appendChild(this._tabbar);
				this._tabbar.className = "jsWTTabbar jsWTTabbarBottom";
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
				this._parent.appendChild(this.domref);
			}

			firstBuild = true;
		}

		this.domref.className = this._className;

		// update items
		this._items.forEach(function(item, index, arr) {
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

		this._className = this._baseClass = "jsWTTable";
		
		this._selection = [];
		this._selectionListener = [];
		this._shiftItem = null;
		this._activeItem = null;
	},

	_activateItem : function(item) {
		if (!$class.instanceOf(item, gara.jswt.TableItem)) {
			throw new TypeError("item is not type of gara.jswt.TableItem");
		}
		// set a previous active item inactive
		if (this._activeItem != null) {
			this._activeItem.setActive(false);
		}

		this._activeItem = item;
		this._activeItem.setActive(true);
		this.update();
	},

	_addItem : function(item, index) {
		if (!$class.instanceOf(item, gara.jswt.TableItem)) {
			throw new TypeError("item is not a gara.jswt.TableItem");
		}

		if (typeof(index) != "undefined") {
			this._items.insertAt(index, item);
		} else {
			this._items.push(item);
		}
	},

	_addColumn : function(column, index) {
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
		var item = this._items[index];
		item.clear();
	},

	_create : function() {
		this.domref = document.createElement("table");
		this.domref.obj = this;
		this.domref.control = this;
		base2.DOM.EventTarget(this.domref);

		this._createTableHead();

		this._tbody = document.createElement("tbody");
		this._tbody.obj = this;
		this._tbody.control = this;
		base2.DOM.EventTarget(this._tbody);
		this.domref.appendChild(this._tbody);
		
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
			this._parent.appendChild(this.domref);
		}
	},

	_createTableHead : function() {
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

		for (var i = 0, len = this._columnOrder.length; i < len; ++i) {
			this._columns[this._columnOrder[i]].update();
			this._theadRow.appendChild(this._columns[this._columnOrder[i]].domref);
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
		if (!$class.instanceOf(item, gara.jswt.TableItem)) {
			throw new TypeError("item is not type of gara.jswt.TableItem");
		}
	
		if (this._selection.contains(item)) {
			this._selection.remove(item);
			this._notifySelectionListener();
			item.setSelected(false);
			this._shiftItem = item;
			this._activateItem(item);
		}
	},
	
	getColumn : function(index) {
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
		var obj = e.target.obj || null;
		
//		console.log("List.handleEvent(" + e.type + ")");
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
			
				this._items.forEach(function(item, index, arr) {
					item.handleEvent(e);
				});

				this._notifyExternalKeyboardListener(e, this, this);
				
				if (e.type == "keydown") {
					this._handleKeyEvent(e);					
				}
				break;
		}

		e.stopPropagation();
	},
	
	_handleKeyEvent : function(e) {
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
				if (!e.ctrlKey && !e.shiftKey) {
					this.select(this._items[0], false);
				} else if (e.shiftKey) {
					this._selectShift(this._items[0], false);
				} else if (e.ctrlKey) {
					this._activateItem(this._items[0]);
				}
				break;
				
			case 35 : // end
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
			item.widgetSelected(this);
		}, this);
	},

	registerListener : function(eventType, listener) {
		if (this.domref) {
			gara.EventManager.getInstance().addListener(this.domref, eventType, listener);
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
		//this._items[index].dispose();
		var item = this._items.removeAt(index)[0];
		this._tbody.removeChild(item.domref);
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
		if (!$class.instanceOf(item, gara.jswt.TableItem)) {
			throw new TypeError("item not instance of gara.jswt.TableItem");
		}

		if (!_add || (this._style & JSWT.MULTI) != JSWT.MULTI) {
			while (this._selection.length) {
				this._selection.pop().setSelected(false);
			}
		}

		if (!this._selection.contains(item)) {
			this._selection.push(item);
			item.setSelected(true);
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
		if (!$class.instanceOf(item, gara.jswt.TableItem)) {
			throw new TypeError("item is not type of gara.jswt.TableItem");
		}

		if (!_add) {
			while (this._selection.length) {
				this._selection.pop().setSelected(false);
			}
		}

		if ((this._style & JSWT.MULTI) == JSWT.MULTI) {
			var indexShift = this.indexOf(this._shiftItem);
			var indexItem = this.indexOf(item);
			var from = indexShift > indexItem ? indexItem : indexShift;
			var to = indexShift < indexItem ? indexItem : indexShift;

			for (var i = from; i <= to; ++i) {
				this._selection.push(this._items[i]);
				this._items[i].setSelected(true);
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

	update : function() {
		if (this.domref == null) {
			this._create();
		} else {
			// update table head
			while (this._theadRow.childNodes.length) {
				this._theadRow.removeChild(this._theadRow.childNodes[0]);
			}
			for (var i = 0, len = this._columnOrder.length; i < len; ++i) {
				this._columns[this._columnOrder[i]].update();
				this._theadRow.appendChild(this._columns[this._columnOrder[i]].domref);
			}
		}

		if (this._headerVisible) {
			this._thead.style.display = "table-row-group";
		} else {
			this._thead.style.display = "none";
		}

		this._tbody.className = "";
		this.removeClassName("jsWTTableNoLines");
		this.removeClassName("jsWTTableLines");

		if (this._linesVisible) {
			this.addClassName("jsWTTableLines");
		} else {
			this.addClassName("jsWTTableNoLines");
		}

		if ((this._style & JSWT.FULL_SELECTION) == JSWT.FULL_SELECTION) {
			this._tbody.className = "jsWTTableFullSelection";
		}

		this.domref.className = this._className;

		// update items
		this._updateItems();
	},
	
	_updateItems : function() {
		this._items.forEach(function(item, index, arr) {
			// create item ...
			if (!item.isCreated()) {
				item._create();
				this._tbody.appendChild(item.domref);
			} else {
				item.update();
			}
		}, this);
	}
});
/*	$Id: Item.class.js 91 2007-12-09 18:58:43Z tgossmann $

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
	 * Set this item selected
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	setSelected : function() {
		this.addClassName("selected");
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

	/**
	 * @method
	 * Set this item unselected
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	setUnselected : function() {
		this.removeClassName("selected");
	},
	
	toString : function() {
		return "[gara.jswt.Item]";
	}
});
/*	$Id: ListItem.class.js 124 2007-12-29 18:38:17Z tgossmann $

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
		this._span = null;
		this._spanText = null;
		this._img = null;
	},

	/**
	 * @method
	 * Internal creation process of this item
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	create : function() {
		this.domref = document.createElement("li");
		this.domref.className = this._className;
		this.domref.obj = this;
		this.domref.control = this._list;

		// create item nodes
		this._img = null;

		// set image
		if (this._image != null) {
			this._img = document.createElement("img");
			this._img.obj = this;
			this._img.control = this._list;
			this._img.src = this._image.src;
			this._img.alt = this._text;

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
		base2.DOM.EventTarget(this._span);

		// register listener
		for (var eventType in this._listener) {
			this._listener[eventType].forEach(function(elem, index, arr) {
				this.registerListener(eventType, elem);
			}, this);
		}

		this._changed = false;
		return this.domref;
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
	registerListener : function(eventType, listener) {
		if (this._img != null) {
			gara.EventManager.getInstance().addListener(this._img, eventType, listener);
		}

		if (this._span != null) {
			gara.EventManager.getInstance().addListener(this._span, eventType, listener);
		}
	},
	
	toString : function() {
		return "[gara.jswt.ListItem]";
	},

	/**
	 * @method
	 * Updates the list item
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	update : function() {
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
					gara.EventManager.getInstance().removeListener({
						domNode : this._img,
						type: eventType, 
						listener : elem
					});
				}, this);
			}
		}

		this._spanText.nodeValue = this._text;
		this.domref.className = this._className;
	}
});
/*	$Id: TreeItem.class.js 121 2007-12-27 21:18:06Z tgossmann $

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

		this._items = new Array();
		this._expanded = true;
		this._checked = false;
		this._changed = false;
		this._childContainer = null;
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
		if (!$class.instanceOf(item, gara.jswt.TreeItem)) {
			throw new TypeError("item is not type of gara.jswt.TreeItem");
		}

		if (typeof(index) != "undefined") {
			this._items.insertAt(index, item);
		} else {
			this._items.push(item);
		}
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
	create : function() {
		/*
		 * DOM of created item:
		 * 
		 * old:
		 * <li>
		 *  <span class="toggler [togglerExpanded] [togglerCollapsed]"></span>
		 *  <span class="textBox">
		 *   [<img src=""/>]
		 *   <span class="text"></span>
		 *  </span>
		 * </li>
		 * 
		 * new:
		 * <li>
		 *  <span class="toggler [togglerExpanded] [togglerCollapsed]"></span>
		 *  [<img src=""/>]
		 *  <span class="text"></span>
		 * </li>
		 */

		var parentItems = this._parent.getItems();
		
		this.removeClassName("bottom");
		if (parentItems.indexOf(this) == parentItems.length - 1) {
			// if bottom
			this.addClassName("bottom");
		}

		// create item noe
		this.domref = document.createElement("li");
		this.domref.className = this._className;
		this.domref.obj = this;
		this.domref.control = this._tree;
		base2.DOM.EventTarget(this.domref);
	
		// create item nodes
		this.toggleNode = document.createElement("span");
		this.toggleNode.obj = this;
		this.toggleNode.control = this._tree;
		base2.DOM.EventTarget(this.toggleNode);
		
		this._span = document.createElement("span");
		this._span.obj = this;
		this._span.control = this._tree;
		this._span.className = "text";
		this._spanText = document.createTextNode(this._text);
		this._span.appendChild(this._spanText);
		base2.DOM.EventTarget(this._span);
	
		// set this.toggler
		this.toggleNode.className = "toggler";
		this.toggleNode.className += this._hasChilds() 
			? (this._expanded
				? " togglerExpanded"
				: " togglerCollapsed")
			: "";
		this.domref.appendChild(this.toggleNode);
	
		// set image
		if (this._image != null) {
			this._img = document.createElement("img");
			this._img.obj = this;
			this._img.src = this._image.src;
			this._img.control = this._tree;
			base2.DOM.EventTarget(this._img);
	
			// put the image into the dom
			this.domref.appendChild(this._img);
		}

		
		this.domref.appendChild(this._span);
	
		// if childs are available, create container for them
		if (this._hasChilds()) {
			this._createChildContainer();
		}

		/* register user-defined listeners */
		for (var eventType in this._listeners) {
			this._listeners[eventType].forEach(function(elem, index, arr) {
				this.registerListener(eventType, elem);
			}, this);
		}
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
		this._items.forEach(function(child, index, arr) {
			if (child._hasChilds()) {
				child._deselectItems();
			}
			this._tree.deselect(child);
		}, this);
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
		return this._expanded;
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
		var obj = e.target.obj || null;

		switch (e.type) {
			case "mousedown":
				if ($class.instanceOf(obj, gara.jswt.TreeItem)) {
					var item = obj;

					if (e.target == this.toggleNode) {
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
				if ($class.instanceOf(obj, gara.jswt.TreeItem)) {
					var item = obj;

					// toggle childs
					if (e.target != this.toggleNode) {
						if (this._expanded) {
							this.setExpanded(false);
						} else {
							this.setExpanded(true);
						}

						this._tree.update();
					}
				}
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
	registerListener : function(eventType, listener) {
		if (this._img != null) {
			gara.EventManager.getInstance().addListener(this._img, eventType, listener);
		}
	
		if (this._span != null) {
			gara.EventManager.getInstance().addListener(this._span, eventType, listener);
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
		var item = this._items.removeAt(index)[0];
		this._childContainer.removeChild(item.domref);
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
	 * Removes all items from the tree-item
	 * 
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	removeAll : function() {
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
		this._active = active;
	
		if (active) {
			this._span.className += " active";
		} else {
			this._span.className = this._span.className.replace(/ *active/, "");
		}
	
		this._changed = true;
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
		//TODO: Respect selection flag from tree - if this has been done here...
		if (checked) {
			this._span.className = "text selected";
		} else {
			this._span.className = "text";
		}
		
		this._checked = checked;
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
		this._expanded = expanded;

		if (!expanded) {
			this._deselectItems();
		}
		
		this._changed = true;
	},
	
	toString : function() {
		return "[gara.jswt.TreeItem]";
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
		if (this._hasChilds()) {
			this.toggleNode.className = strReplace(this.toggleNode.className, " togglerCollapsed", "");
			this.toggleNode.className = strReplace(this.toggleNode.className, " togglerExpanded", "");
	
			if (this._expanded) {
				this.toggleNode.className += " togglerExpanded";
			} else {
				this.toggleNode.className += " togglerCollapsed";
			}
		}

		// create image
		if (this._image != null && this._img == null) {
			this._img = document.createElement("img");
			this._img.obj = this;
			this._img.control = this._tree;
			this._img.alt = this._text;
			this._img.src = this._image.src;
			this.domref.insertBefore(this._img, this._span);
			base2.DOM.EventTarget(this._img);
		}

		// update image information
		else if (this._image != null) {
			this._img.src = this._image.src;
			this._img.alt = this._text;
		}
		
		// delete image
		else if (this._img != null && this._image == null) {
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

		this._spanText.nodeValue = this._text;
		this.domref.className = this._className;
	}
});
/*	$Id: TabItem.class.js 124 2007-12-29 18:38:17Z tgossmann $

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

		// register listener
		for (var eventType in this._listener) {
			this._listener[eventType].forEach(function(elem, index, arr) {
				this.registerListener(eventType, elem);
			}, this);
		}
		this._changed = false;
		return this.domref;
	},

	/**
	 * @method
	 * Returns the content for this item
	 * 
	 * @author Thomas Gossmann
	 * @return {string} the content;
	 */
	getContent : function() {
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
	registerListener : function() {
		if (this.domref != null) {
			gara.EventManager.getInstance().addListener(this.domref, eventType, listener);
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
		this._active = active;

		if (active) {
			this._className += " active";
		} else {
			this._className = this._className.replace(/ *active/, "");
		}

		this._changed = true;
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

	/**
	 * @method
	 * Update this item
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	update : function() {
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
					gara.EventManager.getInstance().removeListener({
						domNode : this._img,
						type: eventType, 
						listener : elem
					});
				}, this);
			}
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
		base2.DOM.EventTarget(this.domref);

		if (this._image != null) {
			this._img = document.createElement("img");
			this._img.obj = this;
			this._img.control = this._table;
			this._img.src = this._image.src;
			base2.DOM.EventTarget(this._img);

			this.domref.appendChild(this._img);
		}

		this._operator = document.createElement("span");
		this._operator.obj = this;
		this._operator.control = this._table;
		base2.DOM.EventTarget(this._operator);
		this.domref.appendChild(this._operator);

		this._spanText = document.createTextNode(this._text);
		this.domref.appendChild(this._spanText);
	},
	
	_computeWidth : function() {
		if (this.domref != null) {
			var paddingLeft = getStyle(this.domref, "padding-left", "paddingLeft");
			var paddingRight = getStyle(this.domref, "padding-right", "paddingRight");
			this._width = this.domref.clientWidth - parseInt(paddingLeft) - parseInt(paddingRight); 
		}
	},
	
	getWidth : function() {
		if (this._width == null || this._width == "auto") {
			this._computeWidth();
		}
		
		return this._width;
	},
	
	handleEvent : function(e) {
		switch(e.type) {
			case "mousedown":
				if (e.target == this._operator && this._resizable) {
					this._isResizing = true;
					if (this._width == null || this._width == "auto") {
						this._computeWidth();
					}

					this.resizeStart = e.clientX;
					this.startWidth = this._width;

					gara.EventManager.getInstance().addListener(document, "mousemove", this);
					gara.EventManager.getInstance().addListener(document, "mouseup", this);
				}

				if (e.target == this.domref && this._moveable) {
					this._isMoving = true;

					var shadowWidth = null;
					var order = this._table.getColumns();
					var offset = order.indexOf(this);

					this._shadow = new gara.jswt.Table(this._table.domref.parentNode, this._table.getStyle());
					this._shadow.setHeaderVisible(this._table.getHeaderVisible());

					this._table.getColumns().forEach(function(col, index, arr) {
						if (index == offset) {
							var c = new gara.jswt.TableColumn(this._shadow);
							shadowWidth = col.getWidth();
							c.setText(col.getText());
							c.setWidth(shadowWidth);
						}
					}, this);

					var cols = this._table.getColumnCount();
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
					
					gara.EventManager.getInstance().addListener(document, "mousemove", this);
					gara.EventManager.getInstance().addListener(document, "mouseup", this);
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
					gara.EventManager.getInstance().removeListener({domNode:document, type:"mousemove", listener:this});
					gara.EventManager.getInstance().removeListener({domNode:document, type:"mouseup", listener:this});
					this._isResizing = false;
				}
				
				if (this._isMoving) {
					gara.EventManager.getInstance().removeListener({domNode:document, type:"mousemove", listener:this});
					gara.EventManager.getInstance().removeListener({domNode:document, type:"mouseup", listener:this});
					this._isMoving = false;
					this._table.domref.parentNode.removeChild(this._shadow.domref);
					
					delete this._shadow;
					
					this._shadow = null;
				
					if (e.target.obj && $class.instanceOf(e.target.obj, gara.jswt.TableColumn)
						&& e.target.obj.getParent() == this._table) {
						var col = e.target.obj;
						var colIndex = this._table.getColumns().indexOf(col);
						var colOrder = this._table.getColumnOrder();
						var orderIndex = colOrder.indexOf(colIndex);
						var thisColIndex = this._table.getColumns().indexOf(this);
						colOrder.remove(thisColIndex);
						colOrder.insertAt(thisColIndex, orderIndex);
						this._table.update();
					}
				}
				break;
		}
	},
	
	registerListener : function() {
		
	},
	
	setWidth : function(width) {
		this._width = width;
	},
	
	update : function() {
		if (this.domref == null) {
			this._create();
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

		this._active = false;
		this._checked = false;
		this._selected = false;

		this.domref = null;
	},
	
	clear : function() {
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
	},

	getText : function(index) {
		if (this._cells[index]) {
			return this._cells[index].text;
		}
		return null;
	},

	getImage : function(index) {
		if (this._cells[index]) {
			return this._cells[index].image;
		}
		return null;
	},

	handleEvent : function(e) {
		
	},

	registerListener : function(eventType, listener) {
		
	},

	setActive : function(active) {
		this._active = active;
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

	setSelected : function(selected) {
		this._selected = selected;
		this._changed = true;
	},

	setText : function(index, text) {
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

	update : function() {
		while (this.domref.childNodes.length) {
			this.domref.removeChild(this.domref.childNodes[0]);
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

				cell.textNode.value = cell.text;
			}

			this.domref.appendChild(cell.td);
		}

		this.removeClassName("selected");

		if (this._selected) {
			this.addClassName("selected");
		}

		this.domref.className = this._className;
		this.releaseChange();
	}
});
/*	$Id: ControlManager.class.js 82 2007-08-31 01:53:43Z tgossmann $

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

		gara.EventManager.getInstance().addListener(document, "keydown", this);
		gara.EventManager.getInstance().addListener(document, "mousedown", this);
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

//		console.log("ControlManager.focusGained() new active control is: " + control);
		
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
//		console.log("ControlMananger.handleEvent("+e.type+"): activeControl: " + this._activeControl);
		if (e.type == "keydown") {
//			console.log("ControlManager.handleEvent(keydown) on " + e.target);
			if (this._activeControl != null && this._activeControl.handleEvent) {
				this._activeControl.handleEvent(e);
			}
		}

		if (e.type == "mousedown") {
			if (this._activeControl != null && (e.target.control
				? e.target.control != this._activeControl : true)) {
				this._activeControl.looseFocus();
				this._activeControl = null;
			}
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
		if (this._style == JSWT.DEFAULT) {
			this._style = JSWT.BAR;
		}

		if ($class.instanceOf(parent, gara.jswt.Control)) {
			this._style = JSWT.POP_UP;
		}
		
		if ($class.instanceOf(parent, gara.jswt.MenuItem)) {
			this._style = JSWT.DROP_DOWN;
		}
		
		this._items = [];

		// location
		this._x = 0;
		this._y = 0;

		// flags
		this._enabled = false;
		this._visible = false;
		this._visibleEvent = null;
		this._justVisible = false;
		
		this._className = this._baseClass = "jsWTMenu";

		window.oncontextmenu = function() {return false;};
	},

	_addItem : function(item, index) {
		if (!$class.instanceOf(item, gara.jswt.MenuItem)) {
			throw new TypeError("item is not instance of gara.jswt.MenuItem");
		}

		if (typeof(index) != "undefined") {
			this._items.insertAt(index, item);
		} else {
			this._items.push(item);
		}
	},
	
	_create : function() {
		var parentNode = document.getElementsByTagName("body")[0];

//		if ($class.instanceOf(this._parent, gara.jswt.Widget)) {
//			parentNode = this._parent.domref;
//		}

		this.domref = document.createElement("ul");
		this.domref.obj = this;
		this.domref.control = this;
		
		if ((this._style & JSWT.POP_UP) == JSWT.POP_UP
			|| (this._style & JSWT.DROP_DOWN) == JSWT.DROP_DOWN) {
			this.domref.style.display = "none";
			this.domref.style.position = "absolute";
		}
		
//		if ((this._style & JSWT.POP_UP) == JSWT.POP_UP) {
//			parentNode = document.getElementsByTagName("body")[0];
//		}

		/* register user-defined listeners */
		for (var eventType in this._listener) {
			this._listener[eventType].forEach(function(elem, index, arr) {
				this.registerListener(eventType, elem);
			}, this);
		}

		parentNode.appendChild(this.domref);
	},

	getItem : function(index) {
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
		switch(e.type) {
			case "mousedown":
				if ((!e.target.control || e.target.control != this)
					&& !this._justVisible 
					&& this._visibleEvent != e) {

					this.setVisible(false);
				}
				this._justVisible = false;
				this._visibleEvent = e;
				break;
		}
	},

	indexOf : function(item) {
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
	registerListener : function(eventType, listener) {
		if (this.domref != null) {
			gara.EventManager.getInstance().addListener(this.domref, eventType, listener);
		}
	},

	setLocation : function(x, y) {
		this._x = x;
		this._y = y;
	},

	setVisible : function(visible) {
		this._visible = visible;
		this.update();
		if (visible) {
			this._justVisible = true;
			gara.EventManager.getInstance().addListener(document, "mousedown", this);
			if ($class.instanceOf(this._parent, gara.jswt.Control)) {
				this._parent.addListener("mousedown", this);
			}
		} else {
			gara.EventManager.getInstance().removeListener({domNode:document,type:"mousedown",listener:this});
			if ($class.instanceOf(this._parent, gara.jswt.Control)) {
				this._parent.removeListener("mousedown", this);
			}
		}
	},

	toString : function() {
		return "[gara.jswt.Menu]";
	},

	update : function() {
		if (!this.domref) {
			this._create();
		}

		if ((this._style & JSWT.POP_UP) == JSWT.POP_UP
			|| (this._style & JSWT.DROP_DOWN) == JSWT.DROP_DOWN) {
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

			// create item ...
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
			}
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
		this._menu = parent;
		this._menu._addItem(this, index);
		this._span = null;
		this._spanText = null;
		this._img = null;
	},
	
	_create : function() {
		this.domref = document.createElement("li");this.domref.className = this._className;
		this.domref.obj = this;
		this.domref.control = this._menu;

		// create item nodes
		this._img = null;

		// set image
		if (this._image != null) {
			this._img = document.createElement("img");
			this._img.obj = this;
			this._img.control = this._menu;
			this._img.src = this._image.src;
			this._img.alt = this._text;

			// put the image into the dom
			this.domref.appendChild(this._img);
			base2.DOM.EventTarget(this._img);
		}

		this._spanText = document.createTextNode(this._text);
		
		this._span = document.createElement("span");
		this._span.obj = this;
		this._span.control = this._menu;
		this._span.appendChild(this._spanText);
		this.domref.appendChild(this._span);
		
		base2.DOM.EventTarget(this.domref);
		base2.DOM.EventTarget(this._span);

		// register listener
		for (var eventType in this._listener) {
			this._listener[eventType].forEach(function(elem, index, arr) {
				this.registerListener(eventType, elem);
			}, this);
		}

		this._changed = false;
		return this.domref;
	},
	
	/**
	 * @method
	 * Register listeners for this widget. Implementation for gara.jswt.Widget
	 * 
	 * @private
	 * @author Thomas Gossmann
	 * @return {void}
	 */
	registerListener : function(eventType, listener) {
		if (this._img != null) {
			gara.EventManager.getInstance().addListener(this._img, eventType, listener);
		}

		if (this._span != null) {
			gara.EventManager.getInstance().addListener(this._span, eventType, listener);
		}
	},
	
	toString : function() {
		return "[gara.jswt.MenuItem]";
	},
	
	update : function() {
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
					gara.EventManager.getInstance().removeListener({
						domNode : this._img,
						type: eventType, 
						listener : elem
					});
				}, this);
			}
		}

		this._spanText.nodeValue = this._text;
		this.domref.className = this._className;
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
	},
	
	isLabelProperty : function(element, property) {
		return true;
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
		if ($class.instanceOf(provider, gara.jsface.ITableLabelProvider)) {
			this._tableLabelProvider = provider;
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
 * @class Viewer
 * @author Thomas Gossmann
 * @namespace gara.jsface
 */
$class("Viewer", {
	/**
	 * @constructor
	 */
	$constructor : function() {
		
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
	$extends : gara.jsface.ContentViewer,

	/**
	 * @constructor
	 */
	$constructor : function() {
		this._map = [];
		this._items = [];
		
		this._elementMap = {};
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

	_getRawChildren : function(parent) {
		var result = null;
		if (parent != null) {
			var cp = this.getContentProvider();
			if (cp != null) {
				result = cp.getElements(parent);
			}
		}

		return (result != null) ? result : [0];
	},
	
	_getSortedChildren : function(parent) {
		return this._getRawChildren(parent);
	},

	_getRoot : function() {
		return this._input;
	},

	_internalRefresh : function() {},

	_mapElement : function(element, item) {
		if (this._elementMap.hasOwnProperty(element)) {
			this._elementMap[element] = item;
		}
	},

	refresh : function(updateLabels) {
		this._internalRefresh();
	},

	setInput : function(input) {
		this._unmapAllElements();
		this.$base(input);
	},

	_unmapAllElements : function() {
		this._map.clear();
		this._items.clear();
	},

	_unmapElement : function(element, item) {
		if ($class.instanceOf(item, Array)) {
			this._elementMap[element] = item;
		} else {
			delete this._elementMap[element];
		}
	},

	_updateItem : function(widget, element) {
		this._doUpdateItem(widget, element);
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
	},

	_createListItem : $abstract(function(element, index) {}),

	getControl : $abstract(function() {}),

	_getLabelProviderText : function(labelProvider, element) {
		var text = labelProvider.getText(element);
		if (text == null) {
			text = "";
		}

		return text;
	},

	inputChanged : function(input, oldInput) {
		this._listRemoveAll();

		var children = this._getRawChildren(this._getRoot());
		
		for (var i = 0, len = children.length; i < len; ++i) {
			var el = children[i];
			this._mapElement(el, this._createListItem(el));
		}
		
		this._internalRefresh();
	},

	_internalRefresh : function() {
		this.getControl().update();
		this.getControl().setSelection([]);
	},

	_listRemoveAll : $abstract(function() {}),

	_listSetItems : $abstract(function() {}),

	refresh : function() {
		var children = this._getRawChildren(this._getRoot());
		var handledChildren = [];

		for (var i = 0, len = children.length; i < len; ++i) {
			var el = children[i];

			// add item
			if (!this._map.contains(el)) {
				this._mapElement(el, this._createListItem(el, i));
			}
			// update
			else {
				var item = this._items[this._map.indexOf(el)];
				item.setText(this._getLabelProviderText(this.getLabelProvider(), el));
				item.setImage(this.getLabelProvider().getImage(el));
			}
			handledChildren.push(el);
		}

		// delete loop
		for (var i = 0, len = this._map.length; i < len; ++i) {
			var el = this._map[i];

			// delete item in the widget
			if (!handledChildren.contains(el)) {
				this.getControl().remove(i);
				this._unmapElement(el);
			}
		}

		delete handledChildren;

		this._internalRefresh();
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
 * @class ListViewer
 * @extends gara.jsface.AbstractListViewer
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("ListViewer", {
	$extends : gara.jsface.AbstractListViewer,
	
	$constructor : function(parent, style) {
		this._list = new gara.jswt.List(parent, style);
	},
	
	_createListItem : function(el, index) {
		var item = new gara.jswt.ListItem(this._list, gara.jswt.JSWT.DEFAULT, index);
		item.setText(this._getLabelProviderText(this.getLabelProvider(), el));
		item.setImage(this.getLabelProvider().getImage(el));
		item.setData(el);
		
		return item;
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
		if (!$class.instanceOf(columnOwner, gara.jswt.TableColumn)) {
			throw new TypeError("columnOwner not instance of gara.jswt.TableColumn");
		}

		if (!$class.instanceOf(labelProvider, gara.jsface.CellLabelProvider)) {
			throw new TypeError("labelProvider not instance of gara.jsface.CellLabelProvider");
		}

		var column = new gara.jsface.ViewerColumn(this, columnOwner);
		column.setLabelProvider(labelProvider, false);
		return column;
	},

	_getViewerColumn : function(columnIndex) {
		var viewer;
		var columnOwner = this._getColumnViewerOwner(columnIndex);

		if (columnOwner == null) {
			return null;
		}

		viewer = columnOwner.getData(gara.jsface.ViewerColumn.COLUMN_VIEWER_KEY);

		if (viewer == null) {
			viewer = this._createViewerColumn(columnOwner, gara.jsface.CellLabelProvider
					.createViewerLabelProvider(this.getLabelProvider()));
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

		this.$base(labelProvider);
	},

	toString : function() {
		return "[gara.jsface.ColumnViewer]";
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
	
	_createTreeItem : $abstract(function(element) {}),
	
	_doUpdateItem : function(widget, element) {

	},
	
	getControl : $abstract(function() {}),

	_getLabelProviderText : function(labelProvider, element) {
		var text = labelProvider.getText(element);
		if (text == null) {
			text = "";
		}

		return text;
	},

	inputChanged : function(input, oldInput) {
		this._treeRemoveAll();

		var children = this._getRawChildren(this._getRoot());

		for (var i = 0; i < children.length; ++i) {
			var el = children[i];
			this._createTreeItem(this.getControl(), el, i);
		}

		this._internalRefresh();
	},

	_internalRefresh : function() {
		this.getControl().update();
	},

	_treeRemoveAll : $abstract(function() {}),
	
	refresh : function() {
		var children = this._getRawChildren(this._getRoot());
		var handledChildren = [];

		// adding and updating recursively
		this._refreshItems(children, handledChildren);		

		// delete loop
		var tmpMap = this._map.concat([]);
		for (var i = 0, len = tmpMap.length; i < len; ++i) {
			var el = tmpMap[i];

			// delete item in the widget
			if (!handledChildren.contains(el)) {
				var item = this._items[tmpMap.indexOf(el)];
				var parent = item.getParentItem();
				if (parent == null) {
					parent = item.getParent();
				}
				parent.remove(parent.indexOf(item));
				this._unmapElement(el);
			}
		}

		delete handledChildren;
		delete tmpMap;

		this._internalRefresh();
	},

	// @TODO: instead of refreshItems => refresh(parentNode)
	_refreshItems : function(children, handledCollector) {
		for (var i = 0, len = children.length; i < len; ++i) {
			var el = children[i];

			// add item
			if (!this._map.contains(el)) {
				var parent = this.getContentProvider().getParent(el);
				var item = this._items[this._map.indexOf(parent)];
				this._createTreeItem(item, el, i);
			}
			// update
			else {
				var item = this._items[this._map.indexOf(el)];
				item.setText(this._getLabelProviderText(this.getLabelProvider(), el));
				item.setImage(this.getLabelProvider().getImage(el));
			}
			handledCollector.push(el);

			// refresh childs
			if (this.getContentProvider().hasChildren(el)) {
				this._refreshItems(this.getContentProvider().getChildren(el), handledCollector);
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
		this._tree = new gara.jswt.Tree(parent, style);
	},

	_createTreeItem : function(parent, el, index) {
		var item = new gara.jswt.TreeItem(parent, gara.jswt.JSWT.DEFAULT, index);
		item.setText(this._getLabelProviderText(this.getLabelProvider(), el));
		item.setImage(this.getLabelProvider().getImage(el));
		item.setData(el);

		this._mapElement(el, item);

		if (this.getContentProvider().hasChildren(el)) {
			var children = this.getContentProvider().getChildren(el);
			for (var i = 0, len = children.length; i < len; ++i) {
				this._createTreeItem(item, children[i], i);
			}
		}

		return item;
	},

	getControl : function() {
		return this._tree;
	},
	
	_getViewerRowFromItem : function(item) {
		return null;
	},

	getTree : function() {
		return this._tree;
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

	_doClear : $abstract(function(index) {}),

	_doGetColumn : $abstract(function() {}),

	_doGetColumnCount : $abstract(function() {}),

	_doGetItems : $abstract(function() {}),
	
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
	
	inputChanged : function(input, oldInput) {
		this._internalRefresh();
	},

	_internalCreateNewRowPart : $abstract(function(style, index){}),

	_internalRefresh : function(element) {
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
	},

	_updateCell : function(rowItem, column, element) {
		this._cell.update(rowItem, column, element);
		return this._cell;
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
		this._table = new gara.jswt.Table(parent, style);
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
 * @class Viewer
 * @author Thomas Gossmann
 * @namespace gara.jsface
 */
$class("Viewer", {
	/**
	 * @constructor
	 */
	$constructor : function() {
		
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
 * @extends gara.jsface.ColumnViewer
 * @namespace gara.jsface
 * @author Thomas Gossmann
 */
$class("ViewerColumn", {
	$extends : gara.jsface.ColumnViewer,

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
	 */
	setLabelProvider : function(labelProvider) {
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

