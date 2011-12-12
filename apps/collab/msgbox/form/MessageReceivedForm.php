<?php 
class MessageReceivedForm extends EasyForm
{
	private $m_ReadLogDO = "collab.msgbox.do.MessageReadLogDO";
	
	public function fetchData()
	{
		$result = parent::fetchData();
		$this->updateReadStatus();
		$result['read_status'] = $this->getReadStatus();
 		if($result['read_status']=='Read'){
 			$result["type_color"] = 'afe8fb'; 				
 		}else{
 			$result["type_color"] = 'c8c8c8';
 		}
 		$result["read_status_display"] = ucwords($result["read_status"]);
 		$result["recipient_to"] = $this->getRecipientList("Recipient");
		$result["recipient_cc"] = $this->getRecipientList("CC");
		$result["recipient_bcc"] = $this->getRecipientList("BCC");
		if($result['subject']=="")
		{
			$result['subject']="[no subject]";
		}
		$this->WriteLog($result['Id']);
		return $result;
	}
	
	public function updateReadStatus()
	{
		return BizSystem::getService("collab.msgbox.lib.messageService")->updateReadStatus($this->m_RecordId);
	}
	
	public function getReadStatus()
	{
		return BizSystem::getService("collab.msgbox.lib.messageService")->getReadStatus($this->m_RecordId);
	}
	
	public function getRecipientList($type)
	{
		return BizSystem::getService("collab.msgbox.lib.messageService")->getRecipientList($type,$this->m_RecordId);
	}

	public function DeleteReceivedMessage()
    {
    	if ($id==null || $id=='')
            $id = BizSystem::clientProxy()->getFormInputs('_selectedId');

        $selIds = BizSystem::clientProxy()->getFormInputs('row_selections', false);
        if ($selIds == null)
            $selIds[] = $id;
        foreach ($selIds as $id)
        {        	
            $dataRec = $this->getDataObj()->fetchById($id);
            $this->getDataObj()->setActiveRecord($dataRec);
                                                
            // take care of exception
            try
            {
            	$dataRec['deleted_flag'] = '1';            	
                $dataRec->Save();
            } catch (BDOException $e)
            {
                $this->processBDOException($e);
                return;
            }
        }
        
        $this->m_Notices[] = $this->getMessage("MESSAGE_HAS_BEEN_DELETED");
        
        if ($this->m_FormType == "LIST")
            $this->rerender();

        $this->runEventLog();
        $this->processPostAction();
    } 
    
	public function WriteLog($id=null)
	{
        if ($id==null || $id=='')
            $id = BizSystem::clientProxy()->getFormInputs('_selectedId');

        $selIds = BizSystem::clientProxy()->getFormInputs('row_selections', false);
        if ($selIds == null)
            $selIds[] = $id;
        foreach ($selIds as $id)
        {      		
		
			if(!$id){
				return;
			}
			$user_id = BizSystem::getUserProfile("Id");
			$do = BizSystem::getObject($this->m_ReadLogDO,1);
			$logRec = $do->fetchOne("[message_id]='$id' and [user_id]='$user_id'");
			if(!$logRec){
				$recArr = array(
					"user_id"=>$user_id,
					"message_id" => $id,
					"view_count" => 1,
					"timestamp" => date('Y-m-d H:i:s')
				);
				$do->insertRecord($recArr);
			}
			else 
			{
				$logRec['view_count'] = (int)$logRec['view_count'] + 1;
				$logRec['timestamp'] = date('Y-m-d H:i:s');
				$logRec->save();
			}
			
        }
	}
}
?>