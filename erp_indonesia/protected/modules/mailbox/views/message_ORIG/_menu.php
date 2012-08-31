<?php
$newMsgs = $this->module->getNewMsgs();
$action = $this->getAction()->getId();

if($this->module->authManager)
{
	$authNew = Yii::app()->user->checkAccess("Mailbox.Message.New");
	$authInbox = Yii::app()->user->checkAccess("Mailbox.Message.Inbox");
	$authSent = Yii::app()->user->checkAccess("Mailbox.Message.Sent");
	$authTrash = Yii::app()->user->checkAccess("Mailbox.Message.Trash");
}
else
{
	$authNew = $this->module->sendMsgs && (!$this->module->readOnly || $this->module->isAdmin());
	$authInbox = ( !$this->module->readOnly || $this->module->isAdmin() );
	$authTrash = $this->module->trashbox && (!$this->module->readOnly || $this->module->isAdmin());
	$authSent = $this->module->sentbox && (!$this->module->readOnly || $this->module->isAdmin());
}
?>
<div class="mailbox-menu ">
<?php 
	$this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>array(
				array('label'=>'Inbox', 'count'=>$newMsgs, 'icon'=>'list-alt','url'=>$this->createUrl('/mailbox/message/inbox'),'visible'=>$authInbox),
				array('label'=>'Sent Mail', 'icon'=>'list-alt','url'=>$this->createUrl('/mailbox/message/sent'),'visible'=>$authSent),
				array('label'=>'Trash', 'icon'=>'list-alt','url'=>$this->createUrl('/mailbox/message/trash'),'visible'=>$authTrash),
		),
	)); 
?>

<br/>
<br/>

<?php
if($authNew)
	echo CHtml::link('New Message',Yii::app()->createUrl('/mailbox/message/new'),array('class'=>'btn'));
?>

</div>