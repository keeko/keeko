<?php
namespace net::keeko::utils::webform;

abstract class Control {

	// config
	protected $id;
	protected $name;
	protected $label;
	protected $title;
	protected $description;
	protected $default;
	protected $validators = array();

	// options
	protected $required = false;
	protected $disabled = false;
	protected $readonly = false;
	private $webform;

	public function __construct(Webform $webform) {
		$this->webform = $webform;
		$this->id = uniqid('wc');
	}
	
	public function getLabel() {
		return $this->label;
	}

	public function getRequestValue() {
		$method = $this->webform->getMethod();
		
		switch($method) {
			case Webform::GET:
				return isset($_GET[$this->name]) ? trim($_GET[$this->name]) : null;
			
			case Webform::POST:
				return isset($_POST[$this->name]) ? trim($_POST[$this->name]) : null;
		}
	}
	
	/**
	 * 
	 * @return Webform
	 */
	public function getWebform() {
		return $this->webform;
	}
	
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name attribute of a controls &lt;input&gt; tag
	 * 
	 * @param String $name the value for name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Sets the label text for the control
	 * 
	 * @param String $label the label text
	 */
	public function setLabel($label) {
		$this->label = $label;
	}

	/**
	 * Sets a title for the &lt;label&gt; tag
	 * 
	 * @param String $title the title text
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Sets a description text
	 * 
	 * @param String $description the description text
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Sets a default value for the &lt;input&gt;
	 * 
	 * @param String $default the default value
	 */
	public function setDefault($default) {
		$this->default = $default;
	}
	
	/**
	 * Sets en- or disabled state for this &lt;input&gt;
	 */
	public function setDisabled($disabled) {
		$this->disabled = $disabled;
	}

	public function setId($id) {
		$this->id = $id;
	}
	
	public function setReadonly($readonly) {
		$this->readonly = $readonly;
	}

	public function setRequired($required) {
		$this->required = $required;
	}

	public function addValidator(Validator $validator) {
		if (!in_array($validator, $this->validators)) {
			$validator->setControl($this);
			$this->validators[] = $validator;
		}
	}

	public function removeValidator(Validator $validator) {
		if ($offset = array_search($validator, $this->validators)) { 
			unset($this->validators[$offset]);
		}
	}

	public abstract function toXml();

	public function validate() {
		$val = $this->getRequestValue();

		if ($this->required && empty($val)) {
			throw new WebformException(sprintf($this->webform->getI18n('error/empty'), $this->label));
		}

		foreach ($this->validators as $validator) {
			try {
				$validator->validate($val);
			} catch (WebformException $e) {
				throw $e;
			}
		}
	}
}
?>