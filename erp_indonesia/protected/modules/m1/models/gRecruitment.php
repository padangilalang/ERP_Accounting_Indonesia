<?php

/**
 * This is the model class for table "g_recruitment".
 *
 * The followings are the available columns in table 'g_recruitment':
 * @property integer $id
 * @property string $for_position
 * @property string $for_project
 * @property string $candidate_name
 * @property string $birthdate
 * @property string $quick_background
 * @property string $work_experience
 * @property integer $sallary_expectation
 * @property integer $source_id
 * @property string $followup_date
 * @property integer $followup_id
 * @property string $followup_remark
 * @property string $interview1_date
 * @property string $interview1_by
 * @property string $interview1_result
 * @property string $interview2_date
 * @property string $interview2_by
 * @property string $interview2_result
 * @property string $interview3_date
 * @property string $interview3_by
 * @property string $interview3_result
 * @property string $review
 * @property integer $final_result_id
 * @property string $general_remark
 * @property integer $created_date
 * @property integer $created_id
 * @property integer $updated_date
 * @property integer $updated_id
 */
class gRecruitment extends BaseModel
{
	public $image;
	public $docs;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GRecruitment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'g_recruitment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('for_position, for_project, candidate_name, birthdate, quick_background, work_experience, source_id, followup_id, final_result_id', 'required'),
				array('sallary_expectation, source_id, followup_id, final_result_id, created_date, created_id, updated_date, updated_id', 'numerical', 'integerOnly'=>true),
				array('for_position, for_project, candidate_name, interview1_by, interview2_by, interview3_by, general_remark', 'length', 'max'=>50),
				array('quick_background, photo_path', 'length', 'max'=>300),
				array('work_experience', 'length', 'max'=>1500),
				array('followup_remark, interview1_result, interview2_result, interview3_result', 'length', 'max'=>100),
				array('review', 'length', 'max'=>250),
				array('image', 'file', 'types'=>'jpg','allowEmpty'=>true),
				array('docs', 'file', 'allowEmpty'=>true),
				array('image, followup_date, interview1_date, interview2_date, interview3_date', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, for_position, for_project, candidate_name, birthdate, quick_background, work_experience, sallary_expectation, source_id, followup_date, followup_id, followup_remark, interview1_date, interview1_by, interview1_result, interview2_date, interview2_by, interview2_result, interview3_date, interview3_by, interview3_result, review, final_result_id, general_remark, created_date, created_id, updated_date, updated_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'for_position' => 'For Position',
				'for_project' => 'For Project',
				'candidate_name' => 'Candidate Name',
				'birthdate' => 'Birthdate',
				'quick_background' => 'Quick Background',
				'work_experience' => 'Work Experience',
				'sallary_expectation' => 'Sallary Expectation',
				'source_id' => 'Source',
				'followup_date' => 'Followup Date',
				'followup_id' => 'Followup',
				'followup_remark' => 'Followup Remark',
				'interview1_date' => 'Interview1 Date',
				'interview1_by' => 'Interview1 By',
				'interview1_result' => 'Interview1 Result',
				'interview2_date' => 'Interview2 Date',
				'interview2_by' => 'Interview2 By',
				'interview2_result' => 'Interview2 Result',
				'interview3_date' => 'Interview3 Date',
				'interview3_by' => 'Interview3 By',
				'interview3_result' => 'Interview3 Result',
				'review' => 'Review',
				'final_result_id' => 'Final Result',
				'general_remark' => 'General Remark',
				'photo_path' => 'Photo Path',
				'image' => 'Photo Profile',
				'docs' => 'Documents',
				'created_date' => 'Created Date',
				'created_id' => 'Created',
				'updated_date' => 'Updated Date',
				'updated_id' => 'Updated',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id=1)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		if ($id !=0)
			$criteria->compare('followup_id',$id);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}