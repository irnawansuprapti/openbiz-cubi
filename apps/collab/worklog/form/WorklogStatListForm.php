<?php 
class WorklogStatListForm extends EasyFormGrouping
{
	public function fetchDataGroup()
	{
		
		$parentForm = BizSystem::getObject("collab.worklog.form.WorklogStatReportForm");			
		$day = sprintf('%02d',$parentForm->m_CategoryId+1);
		$workdate = $parentForm->m_Year.'-'.$parentForm->m_Month.'-'.$day;
		//$searchRule = $parentForm->m_SearchRule;
		if($parentForm->m_RecordId){
			$this->m_SearchRule="[work_date]='$workdate'";
		}

		$result = parent::fetchDataGroup();		
		return $result;
	}
}
?>