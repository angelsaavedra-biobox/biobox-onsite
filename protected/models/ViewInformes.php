<?php

/**
 * This is the model class for table "bbl_view_informes".
 *
 * The followings are the available columns in table 'bbl_view_informes':
 * @property string $id
 * @property string $study_datetime
 * @property string $study_iuid
 * @property string $study_desc
 * @property string $nombre
 * @property string $apellido
 * @property string $nacimiento
 * @property string $cuil
 * @property integer $num_instances
 * @property string $estado
 * @property string $fecha
 * @property string $texto
 * @property string $mods_in_study
 * @property string $pat_name
 * @property integer $con_audio
 */
class ViewInformes extends CActiveRecord
{
    public $archivo;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bbl_view_informes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('num_instances', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>20),
			array('study_iuid, study_desc, mods_in_study, pat_name', 'length', 'max'=>250),
			array('nombre, apellido, cuil, estado', 'length', 'max'=>45),
			array('study_datetime, nacimiento, fecha, texto', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, study_datetime, study_iuid, study_desc, nombre, apellido, nacimiento, cuil, num_instances, estado, fecha, texto, mods_in_study, pat_name, con_audio', 'safe', 'on'=>'search'),
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
		  #'pc'=>array(self::BELONGS_TO, 'Paciente','paciente_cuil'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'study_datetime' => 'Fecha',
			'study_iuid' => 'Estudio ID',
			'study_desc' => 'Estudio',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'nacimiento' => 'Nacimiento',
			'cuil' => 'CUIL',
			'num_instances' => 'Imágenes',
			'estado' => 'Estado',
			'fecha' => 'Fecha',
			'texto' => 'Texto',
			'mods_in_study' => 'Modos',
			'pat_name' => 'Paciente',
			'con_audio' => 'Con Audio',
			'paciente_cuil'=> 'Paciente Asignado',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('study_datetime',$this->study_datetime,true);
		$criteria->compare('study_iuid',$this->study_iuid,true);
		$criteria->compare('study_desc',$this->study_desc,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('nacimiento',$this->nacimiento,true);
		$criteria->compare('cuil',$this->cuil,true);
		$criteria->compare('num_instances',$this->num_instances);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('texto',$this->texto,true);
		$criteria->compare('mods_in_study',$this->mods_in_study,true);
		$criteria->compare('pat_name',$this->pat_name,true);
		$criteria->compare('con_audio',$this->con_audio,true);
		
        $criteria->order = 't.fecha desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewInformes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
