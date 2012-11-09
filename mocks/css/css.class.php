<?php
/* Based on a class by Michael Ettl(michael@ettl.com) - http://www.codingourweb.com/parsing-css-files-and-strings-using-php/ */
class CSS {
protected $css;
protected $cssprops;
protected $cssstr;
/**
* Constructor function for PHP5
*
*/
public function __construct()  	{
   $this->css = array();
   $this->cssprops = array();
   $this->cssstr = "";
}

/**
    * Parses an entire CSS file
    *
    * @param mixed $filename CSS File to parse
    */
	public function parse_file($file_name)
	{
		$fh = fopen($file_name, "r") or die("Error opening file $file_name");
		$css_str = fread($fh, filesize($file_name));
		fclose($fh);
		return($this->parse_css($css_str));
	}

	/**
    * Parses a CSS string
    *
    * @param string $css_str CSS to parse
    */
	public function parse_css($css_str)
	{
		$this->cssstr = $css_str;
		$this->css = "";
		$this->cssprops = "";

		// Strip all line endings and both single and multiline comments
//		$css_str = preg_replace("//*.+?*//s", "", $css_str);

		$css_class = explode("}", $css_str);

		while(list($key, $val) = each($css_class)){
		    $aCSSObj = explode("{", $val);
//		    $cSel = strtolower(trim($aCSSObj[0]));
                    $cSel = trim($aCSSObj[0]);
			if($cSel){
				$this->cssprops[] = $cSel;
	    	    $a = explode(";", $aCSSObj[1]);
	    	    while(list($key, $val0) = each($a)){
					if(trim($val0)){
						$aCSSSub = explode(":", $val0);
						$cAtt = strtolower(trim($aCSSSub[0]));
						if(isset($aCSSSub[1])){
							$aCSSItem[$cAtt] = trim($aCSSSub[1]);
						}
	    	      	}
	    	    }
	    	    if((isset($this->css[$cSel])) && ($this->css[$cSel])){
	    	    	$aCSSItem = array_merge($this->css[$cSel], $aCSSItem);
	    	    }
	    	    $this->css[$cSel] = $aCSSItem;
	    	    unset($aCSSItem);
			}
			if(strstr($cSel, ",")){
				$aTags = explode(",", $cSel);
				foreach($aTags as $key0 => $value0){
					$this->css[$value0] = $this->css[$cSel];
				}
				unset($this->css[$cSel]);
			}
		}
		unset($css_str, $css_class, $aCSSSub, $aCSSItem, $aCSSObj);
		return $this->css;
	}

    /**
    * Builds a CSS string out of an existing object
    *
    * @param boolean $sorted Sort the attributes alphabetically
    * @return string Resulting CSS string
    */
	public function build_css($sorted = false)
	{
		$this->cssstr = "";
		foreach($this->css as $key0 => $value0) {
			$trimmed = trim($key0);
			$this->cssstr .= "$trimmed {\n";
			if($sorted) ksort(&$this->css[$key0], SORT_STRING);
			foreach($this->css[$key0] as $key1 => $value1) {
				$this->cssstr .= "\t$key1: $value1;\n";
			}
			$this->cssstr .= "}\n";
		}
		return ($this->cssstr);
	}

    /**
    * Writes an existing CSS string to file
    *
    * @param string $file_name File to save to
    * @param boolean $sorted Sort the attributes alphabetically
    */
	public function write_file($file_name, $sorted = false)
	{
		if($this->css == "") die("There is no CSS to write!");
		if($this->cssstr == "") $this->build_css($sorted);
		$fh = fopen($file_name, "w") or die("Error opening file $file_name");
		fwrite($fh, $this->cssstr);
		fclose($fh);
	}

    /**
    * Returns the entire CSS object
    *
    * @return object or false
    */
	public function get_css()
	{
		if (isset($this->css)) return ($this->css);
		return false;
	}

    /**
    * Returns all CSS properties
    *
    * @return array
    */
	public function get_properties()
	{
		if (isset($this->cssprops)) return ($this->cssprops);
		return array();
	}

    /**
    * Returns a specified CSS property and all its attributes
    *
    * @param string $property
    * @return array
    */
	public function get_property($prop)
	{
		if (isset($this->css[$prop])) return ($this->css[$prop]);
		return array();
	}

    /**
    * Gets attribute value of a specified CSS property
    *
    * @param string $prop CSS property
    * @param string $attr CSS attribute
    * @return string
    */
	public function get_value($prop, $attr)
	{
		if (isset($this->css[$prop][$attr])) return ($this->css[$prop][$attr]);
		return "";
	}

    /**
    * Sets attribute value of a specified CSS property
    *
    * @param string $prop CSS property
    * @param string $attr CSS attribute
    * @param string $value CSS attribute value
    * @return boolean Returns true when succeeded
    */
	public function set_value($prop, $attr, $value)
	{
		if(empty($prop)||empty($attr)) return false;
		$this->css[$prop][$attr] = $value;
        return true;
	}
    /**
    * sets the css attribute to a new parsed css attribute
    *
    * @param object $newCSS CSS style rules
    * @return boolean Returns true when succeeded
    */       
        public function set_css($newCSS) {
            $this->css = $newCSS;
            return true;
        }
    
    /**
    * divides a number by half
    *
    * @param array $input an array of regex output, the first item is expected
    *              to be the number returned from a regex on a string
    * @return int Returns half the number taken from the regular expression
    */
        private function halveNumbers($input) {
            return ((0 + $input[0]) / 2);
        }
    /**
    * takes a css background rule and parses it for positioning values (shorthand)
    *
    * @param array $input an array of output from regex, the first item is
    *              expected to be both position values of the shorthand expression 
    * @return string Returns a string with halved positioning values in same units
    */
        private function printMatches($input) {
            $arr = explode(' ', $input[0]);
            $patch = array();
            for($i = 0; $i < count($arr); $i++) {
                $patch[] = preg_replace_callback('#[0-9]+#', array($this, 'halveNumbers'), $arr[$i]);
            }
            return implode(' ', $patch);
        }
        
    /**
    * parses the css and sets the css object to new retina css
    *
    * @param object $newCSS CSS style rules
    * @return boolean Returns true when succeeded
    */       
        public function parse_for_retina($keys) {
            
            
            
            $output = $this->css;
            
            foreach($output as $pKey => $element) {
    
                foreach ($element as $key => $value) {

                    if(in_array($key, $keys)) {
                        $int = intval(str_replace('px', '', $value));
                        $int /= 2;
                        $element[$key] = $int . 'px';
                    }

                    if($key === 'background') {
                        $str = $value;
                        
                        if(strpos($value, '.png')) {
                            $str = str_replace('@2x.png', '.png', $value);
                        }

                        if(strpos($value, '.jpg')) {
                            $str = str_replace('@2x.jpg', '.jpg', $value);
                        }

                        if(strpos($value, '.gif')) {
                            $str = str_replace('@2x.gif', '.gif', $value);
                        }
                        
                        if(strpos($value, 'px')) {
                            // TODO: add support for background positions
                            $str = preg_replace_callback('#(\-?)[0-9]+(px|\%)?\s(\-?)[0-9]+(px|\%)?#', array($this, 'printMatches'), $str);
                        }

                        $element[$key] = $str;
                    }

                }

                $output[$pKey] = $element;

            }
            
            $this->css = $output;
        }
        
}