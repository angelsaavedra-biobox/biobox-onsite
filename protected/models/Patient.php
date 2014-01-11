<?php

/**
 * This is the model class for table "patient".
 *
 * The followings are the available columns in table 'patient':
 * @property string $pk
 * @property string $merge_fk
 * @property string $pat_id
 * @property string $pat_id_issuer
 * @property string $pat_name
 * @property string $pat_fn_sx
 * @property string $pat_gn_sx
 * @property string $pat_i_name
 * @property string $pat_p_name
 * @property string $pat_birthdate
 * @property string $pat_sex
 * @property string $pat_custom1
 * @property string $pat_custom2
 * @property string $pat_custom3
 * @property string $updated_time
 * @property string $created_time
 * @property string $pat_attrs
 *
 * The followings are the available model relations:
 * @property Gppps[] $gppps
 * @property Gpsps[] $gpsps
 * @property Mpps[] $mpps
 * @property MwlItem[] $mwlItems
 * @property Patient $mergeFk
 * @property Patient[] $patients
 * @property RelPatOtherPid[] $relPatOtherPs
 * @property Study[] $studies
 * @property Ups[] $ups
 */
class Patient extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'patient';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('merge_fk', 'length', 'max'=>20),
			array('pat_id, pat_id_issuer, pat_name, pat_fn_sx, pat_gn_sx, pat_i_name, pat_p_name, pat_birthdate, pat_sex, pat_custom1, pat_custom2, pat_custom3', 'length', 'max'=>250),
			array('updated_time, created_time, pat_attrs', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk, merge_fk, pat_id, pat_id_issuer, pat_name, pat_fn_sx, pat_gn_sx, pat_i_name, pat_p_name, pat_birthdate, pat_sex, pat_custom1, pat_custom2, pat_custom3, updated_time, created_time, pat_attrs', 'safe', 'on'=>'search'),
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
			'gppps' => array(self::HAS_MANY, 'Gppps', 'patient_fk'),
			'gpsps' => array(self::HAS_MANY, 'Gpsps', 'patient_fk'),
			'mpps' => array(self::HAS_MANY, 'Mpps', 'patient_fk'),
			'mwlItems' => array(self::HAS_MANY, 'MwlItem', 'patient_fk'),
			'mergeFk' => array(self::BELONGS_TO, 'Patient', 'merge_fk'),
			'patients' => array(self::HAS_MANY, 'Patient', 'merge_fk'),
			'relPatOtherPs' => array(self::HAS_MANY, 'RelPatOtherPid', 'patient_fk'),
			'studies' => array(self::HAS_MANY, 'Study', 'patient_fk'),
			'ups' => array(self::HAS_MANY, 'Ups', 'patient_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk' => 'Pk',
			'merge_fk' => 'Merge Fk',
			'pat_id' => 'Pat',
			'pat_id_issuer' => 'Pat Id Issuer',
			'pat_name' => 'Pat Name',
			'pat_fn_sx' => 'Pat Fn Sx',
			'pat_gn_sx' => 'Pat Gn Sx',
			'pat_i_name' => 'Pat I Name',
			'pat_p_name' => 'Pat P Name',
			'pat_birthdate' => 'Pat Birthdate',
			'pat_sex' => 'Pat Sex',
			'pat_custom1' => 'Pat Custom1',
			'pat_custom2' => 'Pat Custom2',
			'pat_custom3' => 'Pat Custom3',
			'updated_time' => 'Updated Time',
			'created_time' => 'Created Time',
			'pat_attrs' => 'Pat Attrs',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('pk',$this->pk,true);
		$criteria->compare('merge_fk',$this->merge_fk,true);
		$criteria->compare('pat_id',$this->pat_id,true);
		$criteria->compare('pat_id_issuer',$this->pat_id_issuer,true);
		$criteria->compare('pat_name',$this->pat_name,true);
		$criteria->compare('pat_fn_sx',$this->pat_fn_sx,true);
		$criteria->compare('pat_gn_sx',$this->pat_gn_sx,true);
		$criteria->compare('pat_i_name',$this->pat_i_name,true);
		$criteria->compare('pat_p_name',$this->pat_p_name,true);
		$criteria->compare('pat_birthdate',$this->pat_birthdate,true);
		$criteria->compare('pat_sex',$this->pat_sex,true);
		$criteria->compare('pat_custom1',$this->pat_custom1,true);
		$criteria->compare('pat_custom2',$this->pat_custom2,true);
		$criteria->compare('pat_custom3',$this->pat_custom3,true);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('pat_attrs',$this->pat_attrs,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Patient the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
