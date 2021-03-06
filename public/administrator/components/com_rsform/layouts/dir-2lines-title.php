<?php
/**
* @package RSForm! Pro
* @copyright (C) 2007-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$i	 = 0;
$out = '<div class="rsform-table" id="rsform-table2">'."\n";

foreach ($fields as $field) {
	if ($field->indetails) {
		if ($field->componentId < 0 && isset($headers[$field->componentId])) {
			$caption = JText::_('RSFP_'.$headers[$field->componentId]);
			$value	 = $this->getStaticPlaceholder($headers[$field->componentId]);
		} else {
			$caption = '{'.$field->FieldName.':caption}';
			$value 	 = '{'.$field->FieldName.':value}';
		}
		
		if ($i == 0) {
			$out .= "\t".'<p class="rsform-main-title rsform-title">'.$value.'</p>'."\n";
		} elseif ($i == 1) {
			$out .= "\t".'<p class="rsform-big-subtitle rsform-title">'.$value.'</p>'."\n";
		} elseif ($i == 2) {
			$out .= "\t".'<p class="rsform-small-subtitle rsform-title">'.$value.'</p>'."\n";
		} else {
			$out .= "\t".'<div class="rsform-table-item">'."\n";
			$out .= "\t\t".'<div class="rsform-field-title">'.$caption.'</div>'."\n";
			$out .= "\t\t".'<div class="rsform-field-value">'.$value.'</div>'."\n";
			$out .= "\t".'</div>'."\n";
		}
		$i++;
	}
}

$out .= '</div>'."\n";

if ($out != $this->_directory->ViewLayout && $this->_directory->formId) {
	// Clean it
	// Update the layout
	$db = JFactory::getDBO();
	$db->setQuery("UPDATE #__rsform_directory SET ViewLayout='".$db->escape($out)."' WHERE formId=".$this->_directory->formId);
	$db->execute();
}
	
return $out;