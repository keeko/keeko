<?php

 *
 * @package net.keeko.cms.core.output
 */
			$this->styleSheets[] = $styleSheet;
			$this->styleSheet = null;
		}
	 *
		if ($offset) {
			unset($this->styleSheets[$offset]);
			$this->styleSheet = null;
		}
	}
			$this->generateStyleSheet();
		}

		return $this->styleSheet;
			throw new Exception('no source data');
		}

		$processor = new \XSLTProcessor();
		$processor->importStyleSheet($this->getStyleSheet());
		return $processor->transformToXML($this->source);
		$stylesheet = $xsl->createElementNS('http://www.w3.org/1999/XSL/Transform', 'xsl:stylesheet');
		$stylesheet->setAttribute('version', '1.0');
		$xsl->appendChild($stylesheet);

		foreach ($this->styleSheets as $styleSheetPath) {
			$include = $xsl->createElementNS('http://www.w3.org/1999/XSL/Transform', 'import');
			$include->setAttribute('href', $styleSheetPath);
			$stylesheet->appendChild($include);
		}

		$this->styleSheet = $xsl;