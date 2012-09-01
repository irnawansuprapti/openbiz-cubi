<?php
/**
 * Openbiz Cubi Application Platform
 *
 * LICENSE http://code.google.com/p/openbiz-cubi/wiki/CubiLicense
 *
 * @package   cubi.service
 * @copyright Copyright (c) 2005-2011, Openbiz Technology LLC
 * @license   http://code.google.com/p/openbiz-cubi/wiki/CubiLicense
 * @link      http://code.google.com/p/openbiz-cubi/
 * @version   $Id: TaskService.php 3371 2012-08-30 06:17:21Z fsliit@gmail.com $
 */
 include_once(MODULE_PATH."/sms/lib/sms.class.php");
class TaskService 
{
	protected $m_SmsTasklistDO='sms.task.do.TaskDO';
	protected $m_SmsQueueDO='sms.queue.do.QueueDO';
	
	public function insertSmsQueue($taskId){
		if(!$taskId)
		{
			return false;
		}
		$RecrdArr=$taskId->getActiveRecord();
		$TasklistDO = BizSystem::getObject($this->m_SmsTasklistDO);
		$SmsQueueDO = BizSystem::getObject($this->m_SmsQueueDO);
		$TasklistArr=$TasklistDO->fetchOne('id='.$RecrdArr['Id']);
		 if($TasklistArr)
		 {
			$TasklistArr=$TasklistArr->toArray();
		 }
		$data=array(
				'tasklist_id'=>$TasklistArr['Id'],
				'mobile'=>$TasklistArr['mobile'],
				'provider'=>$TasklistArr['provider'],
				'content'=> $TasklistArr['content'],
				'status'=>$TasklistArr['pending']
				);
		$SmsQueueDO->insertRecord($data);
	}
	 
}
?>