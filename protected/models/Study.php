<?php

/**
 * This is the model class for table "study".
 *
 * The followings are the available columns in table 'study':
 * @property string $pk
 * @property string $patient_fk
 * @property string $accno_issuer_fk
 * @property string $study_iuid
 * @property string $study_id
 * @property string $study_datetime
 * @property string $accession_no
 * @property string $ref_physician
 * @property string $ref_phys_fn_sx
 * @property string $ref_phys_gn_sx
 * @property string $ref_phys_i_name
 * @property string $ref_phys_p_name
 * @property string $study_desc
 * @property string $study_custom1
 * @property string $study_custom2
 * @property string $study_custom3
 * @property string $study_status_id
 * @property string $mods_in_study
 * @property string $cuids_in_study
 * @property integer $num_series
 * @property integer $num_instances
 * @property string $ext_retr_aet
 * @property string $retrieve_aets
 * @property string $fileset_iuid
 * @property string $fileset_id
 * @property integer $availability
 * @property integer $study_status
 * @property string $checked_time
 * @property string $updated_time
 * @property string $created_time
 * @property string $study_attrs
 *
 * The followings are the available model relations:
 * @property RelStudyPcode[] $relStudyPcodes
 * @property Series[] $series
 * @property Issuer $accnoIssuerFk
 * @property Patient $patientFk
 * @property StudyOnFs[] $studyOnFs
 */
class Study extends CActiveRecord
{
    //public $primaryKey = 'study_iuid';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'study';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('study_iuid, num_series, num_instances, availability, study_status', 'required'),
			array('num_series, num_instances, availability, study_status', 'numerical', 'integerOnly'=>true),
			array('patient_fk, accno_issuer_fk', 'length', 'max'=>20),
			array('study_iuid, study_id, accession_no, ref_physician, ref_phys_fn_sx, ref_phys_gn_sx, ref_phys_i_name, ref_phys_p_name, study_desc, study_custom1, study_custom2, study_custom3, study_status_id, mods_in_study, cuids_in_study, ext_retr_aet, retrieve_aets, fileset_iuid, fileset_id', 'length', 'max'=>250),
			array('study_datetime, checked_time, updated_time, created_time, study_attrs', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pk, patient_fk, accno_issuer_fk, study_iuid, study_id, study_datetime, accession_no, ref_physician, ref_phys_fn_sx, ref_phys_gn_sx, ref_phys_i_name, ref_phys_p_name, study_desc, study_custom1, study_custom2, study_custom3, study_status_id, mods_in_study, cuids_in_study, num_series, num_instances, ext_retr_aet, retrieve_aets, fileset_iuid, fileset_id, availability, study_status, checked_time, updated_time, created_time, study_attrs', 'safe', 'on'=>'search'),
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
			/*'relStudyPcodes' => array(self::HAS_MANY, 'RelStudyPcode', 'study_fk'),
			'series' => array(self::HAS_MANY, 'Series', 'study_fk'),
			'accnoIssuerFk' => array(self::BELONGS_TO, 'Issuer', 'accno_issuer_fk'),
			'patientFk' => array(self::BELONGS_TO, 'Patient', 'patient_fk'),
			'studyOnFs' => array(self::HAS_MANY, 'StudyOnFs', 'study_fk'),
			#'informe' => array(self::HAS_ONE, 'Informe', 'fk_study'),*/
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk' => 'Pk',
			'patient_fk' => 'Patient Fk',
			'accno_issuer_fk' => 'Accno Issuer Fk',
			'study_iuid' => 'Study Iuid',
			'study_id' => 'Study',
			'study_datetime' => 'Study Datetime',
			'accession_no' => 'Accession No',
			'ref_physician' => 'Ref Physician',
			'ref_phys_fn_sx' => 'Ref Phys Fn Sx',
			'ref_phys_gn_sx' => 'Ref Phys Gn Sx',
			'ref_phys_i_name' => 'Ref Phys I Name',
			'ref_phys_p_name' => 'Ref Phys P Name',
			'study_desc' => 'Study Desc',
			'study_custom1' => 'Study Custom1',
			'study_custom2' => 'Study Custom2',
			'study_custom3' => 'Study Custom3',
			'study_status_id' => 'Study Status',
			'mods_in_study' => 'Mods In Study',
			'cuids_in_study' => 'Cuids In Study',
			'num_series' => 'Num Series',
			'num_instances' => 'Num Instances',
			'ext_retr_aet' => 'Ext Retr Aet',
			'retrieve_aets' => 'Retrieve Aets',
			'fileset_iuid' => 'Fileset Iuid',
			'fileset_id' => 'Fileset',
			'availability' => 'Availability',
			'study_status' => 'Study Status',
			'checked_time' => 'Checked Time',
			'updated_time' => 'Updated Time',
			'created_time' => 'Created Time',
			'study_attrs' => 'Study Attrs',
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
		$criteria->compare('patient_fk',$this->patient_fk,true);
		$criteria->compare('accno_issuer_fk',$this->accno_issuer_fk,true);
		$criteria->compare('study_iuid',$this->study_iuid,true);
		$criteria->compare('study_id',$this->study_id,true);
		$criteria->compare('study_datetime',$this->study_datetime,true);
		$criteria->compare('accession_no',$this->accession_no,true);
		$criteria->compare('ref_physician',$this->ref_physician,true);
		$criteria->compare('ref_phys_fn_sx',$this->ref_phys_fn_sx,true);
		$criteria->compare('ref_phys_gn_sx',$this->ref_phys_gn_sx,true);
		$criteria->compare('ref_phys_i_name',$this->ref_phys_i_name,true);
		$criteria->compare('ref_phys_p_name',$this->ref_phys_p_name,true);
		$criteria->compare('study_desc',$this->study_desc,true);
		$criteria->compare('study_custom1',$this->study_custom1,true);
		$criteria->compare('study_custom2',$this->study_custom2,true);
		$criteria->compare('study_custom3',$this->study_custom3,true);
		$criteria->compare('study_status_id',$this->study_status_id,true);
		$criteria->compare('mods_in_study',$this->mods_in_study,true);
		$criteria->compare('cuids_in_study',$this->cuids_in_study,true);
		$criteria->compare('num_series',$this->num_series);
		$criteria->compare('num_instances',$this->num_instances);
		$criteria->compare('ext_retr_aet',$this->ext_retr_aet,true);
		$criteria->compare('retrieve_aets',$this->retrieve_aets,true);
		$criteria->compare('fileset_iuid',$this->fileset_iuid,true);
		$criteria->compare('fileset_id',$this->fileset_id,true);
		$criteria->compare('availability',$this->availability);
		$criteria->compare('study_status',$this->study_status);
		$criteria->compare('checked_time',$this->checked_time,true);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('study_attrs',$this->study_attrs,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Study the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	protected function afterFind()
    {
        $this->study_datetime=($this->study_datetime)? date('d-m-Y H:i:s', strtotime($this->study_datetime)) : null; 
        return TRUE;
    }
    
    
    public function beforeSave()
    {
        $this->study_datetime=($this->study_datetime)? date('Y-m-d H:i:s', strtotime($this->study_datetime)): null; 
        return TRUE;
    }
}
