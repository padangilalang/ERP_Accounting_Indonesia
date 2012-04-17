<?php
class xUploadForm extends CFormModel
{
	public $file;
	public $mime_type;
	public $size;
	public $name;

	public function rules()
	{
		return array(
				array('file', 'file'),
		);
	}

	public function attributeLabels()
	{
		return array(
				'file'=>'Upload files',
		);
	}

	public function getReadableFileSize($retstring = null) {
		$sizes = array('bytes', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');

		if ($retstring === null) {
			$retstring = '%01.2f %s';
		}

		$lastsizestring = end($sizes);

		foreach ($sizes as $sizestring) {
			if ($this->size < 1024) {
				break;
			}
			if ($sizestring != $lastsizestring) {
				$this->size /= 1024;
			}
		}
		if ($sizestring == $sizes[0]) {
			$retstring = '%01d %s';
		}
		return sprintf($retstring, $this->size, $sizestring);
	}
}
