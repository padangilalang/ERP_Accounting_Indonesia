<?php
/**
 * ClientScriptPacker class file.
 *
 * @author Greg Molnar
 * @link https://github.com/gregmolnar/ClientScriptPacker
 * @copyright Copyright &copy; Greg Molnar
 * @license http://www.yiiframework.com/license/
 */

/**
 * ClientScriptPacker extends CClientScript and packing and minifying javascript files to make page load faster
 *
 * @author Greg Molnar
 * @version 0.1.1
 */
class ClientScriptPacker extends CClientScript
{
	/**
	 * @var boolean whether to pack the js files or not
	 */
	public $packScriptFiles = true;

	/**
	 * @var boolean whether to compress the js files or not
	 */
	public $compressScriptFiles = false;

	/**
	 * @var array name of the packed files (position => filename)
	 */
	public $names = array(
			self::POS_HEAD => 'head.js',
			self::POS_BEGIN => 'begin.js',
			self::POS_END => 'end.js',
	);
		
	/**
	 * Inserts the scripts in the head section.
	 * @param string $output the output to be inserted with scripts.
	 */
	public function renderHead(&$output)
	{
		if ($this->packScriptFiles && $this->enableJavaScript)
			$this->packScriptFiles(self::POS_HEAD);

		parent::renderHead($output);
	}
	/**
	 * Inserts the scripts at the beginning of the body section.
	 * @param string $output the output to be inserted with scripts.
	 */
	public function renderBodyBegin(&$output)
	{
		if ($this->packScriptFiles && $this->enableJavaScript)
			$this->packScriptFiles(self::POS_BEGIN);
		parent::renderBodyBegin($output);
	}

	/**
	 * Inserts the scripts at the end of the body section.
	 * @param string $output the output to be inserted with scripts.
	 */
	public function renderBodyEnd(&$output)
	{
		if ($this->packScriptFiles && $this->enableJavaScript)
			$this->packScriptFiles(self::POS_END);
		parent::renderBodyEnd($output);
	}
	/**
	 * Merge the scripfiles
	 * @param integer $position the position of the JavaScript code. Valid values include the following:
	 * <ul>
	 * <li>CClientScript::POS_HEAD : the script is inserted in the head section right before the title element.</li>
	 * <li>CClientScript::POS_BEGIN : the script is inserted at the beginning of the body section.</li>
	 * <li>CClientScript::POS_END : the script is inserted at the end of the body section.</li>
	 * </ul>
	 */
	public function packScriptFiles($position)
	{
		$data = '';
		if(isset($this->scriptFiles[$position])){
			foreach($this->scriptFiles[$position] as $file){
				$file = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.ltrim($file,DIRECTORY_SEPARATOR);
				$data .= file_get_contents($file);
			}
			if($this->compressScriptFiles){
				require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'jsmin.php';
				$data = JSMin::minify($data);
			}
			file_put_contents( Yii::app()->assetManager->basePath.DIRECTORY_SEPARATOR.$this->names[$position], $data );
			$this->scriptFiles[$position] = array(Yii::app()->assetManager->baseUrl.'/'.$this->names[$position]);
		}

	}

	/**
	 * Registers a javascript file.
	 * @param string or array $url URL of the javascript file, or array contains multiple urls
	 * @param integer $position the position of the JavaScript code. Valid values include the following:
	 * <ul>
	 * <li>CClientScript::POS_HEAD : the script is inserted in the head section right before the title element.</li>
	 * <li>CClientScript::POS_BEGIN : the script is inserted at the beginning of the body section.</li>
	 * <li>CClientScript::POS_END : the script is inserted at the end of the body section.</li>
	 * </ul>
	 * @return CClientScript the CClientScript object itself (to support method chaining, available since version 1.1.5).
	 */
	public function registerScriptFile($url,$position=self::POS_HEAD)
	{
		$this->hasScripts=true;
		if(is_array($url)){
			foreach($url as $script){
				$this->scriptFiles[$position][$script]=$script;
			}
		}else{
			$this->scriptFiles[$position][$url]=$url;
		}
		$params=func_get_args();
		$this->recordCachingAction('clientScript','registerScriptFile',$params);
		return $this;
	}
}