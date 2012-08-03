<?php

/**
 * Implements the BootProgress inside CDataColumn
 *
 * @author Luiz
 */
class BootProgressColumn extends CDataColumn {
	// Progress bar types.

	const TYPE_DEFAULT = '';
	const TYPE_INFO = 'info';
	const TYPE_SUCCESS = 'success';
	const TYPE_DANGER = 'danger';

	/**
	 * @var string the bar type.
	 * Valid values are '', 'info', 'success', and 'danger'.
	 */
	public $type = self::TYPE_DEFAULT;

	/**
	 * @var boolean whether the bar is striped.
	 */
	public $striped = false;

	/**
	 * @var boolean whether the bar is animated.
	 */
	public $animated = false;

	/**
	 * @var integer the progress.
	 */
	public $percent = 0;

	public $htmlOpt = array('class'=>'progress');

	/**
	 * Initializes the widget.
	 */
	public function init() {
		$classes = array('progress');

		$validTypes = array(self::TYPE_DEFAULT, self::TYPE_INFO, self::TYPE_SUCCESS, self::TYPE_DANGER);
		if ($this->type !== self::TYPE_DEFAULT && in_array($this->type, $validTypes))
			$classes[] = 'progress-' . $this->type;

		if ($this->striped)
			$classes[] = 'progress-striped';

		if ($this->animated)
			$classes[] = 'active';

		$classes = implode(' ', $classes);

		$this->htmlOpt['class'] = $classes;

		if ($this->percent < 0)
			$this->percent = 0;
		else if ($this->percent > 100)
			$this->percent = 100;
	}

	protected function renderDataCellContent($row, $data) {
		if ($this->value !== null)
		{
			$value = $this->evaluateExpression($this->value, array('data' => $data, 'row' => $row));

		}
		else if ($this->name !== null)
			$value = CHtml::value($data, $this->name);

		if($this->percent!==0)
			$this->percent = $value;
		echo CHtml::openTag('div', $this->htmlOpt);
		echo '<div class="bar" style="width: ' . $this->percent . '%;"></div>';
		echo '</div>';
	}

	/**
	 * Renders the filter cell.
	 */
	public function renderFilterCell()
	{
		echo '<td><div class="filter-container">';
		$this->renderFilterCellContent();
		echo '</div></td>';
	}

}

?>