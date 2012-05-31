<?php
/**
 * Openbiz Cubi Application Platform
 *
 * LICENSE http://code.google.com/p/openbiz-cubi/wiki/CubiLicense
 *
 * @package   cubi.extend.element
 * @copyright Copyright (c) 2005-2011, Openbiz Technology LLC
 * @license   http://code.google.com/p/openbiz-cubi/wiki/CubiLicense
 * @link      http://code.google.com/p/openbiz-cubi/
 * @version   $Id$
 */

class AccessList extends Listbox
{
	public function getSelectFrom(){
		$formname = $this->getFormObj()->m_ParentFormName;
		if(!$formname)
		{
			$formname = "extend.widget.ExtendSettingListEditForm";
		}			
		return BizSystem::getObject($formname)
					->m_ParentFormElementMeta['ATTRIBUTES']['ACCESSSELECTFROM'];
	}
    protected function translateList(&$list, $tag)
    {	
		$package = $this->getSelectFrom();		
    	I18n::AddLangData(substr($package,0,intval(strpos($package,'.'))),"extend");
    	parent::translateList($list, $tag);
    }
}
?>