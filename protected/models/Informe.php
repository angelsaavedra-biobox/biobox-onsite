<?php

/**
 * This is the model class for table "bbl_informe".
 *
 * The followings are the available columns in table 'bbl_informe':
 * @property string $id
 * @property string $study_iuid
 * @property string $study_pk
 * @property string $texto
 * @property string $pat_name
 * @property string $paciente_cuil
 * @property string $firmado_id
 * @property string $estado
 * @property string $fecha
 */
class Informe extends CActiveRecord
{
    public static $estados = array('grabar'=>'A Grabar','transcribir'=>'Transcribir','entregar'=>'Entregar');
	#public static $estados = array('grabar'=>'A Grabar','transcribir'=>'Transcribir','revisar'=>'Revisar','finalizar'=>'Finalizar','entregar'=>'Entragado');
    public $archivo='';
	/**
	 * @return string the associated database table name
	 */
	public static function getEstados($key=null)
    {
        if($key!==null)
            return self::$estados[$key];
        return self::$estados;
    }
    
	public function tableName()
	{
		return 'bbl_informe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			#array('study_iuid, study_pk, paciente_cuil, firmado_id', 'required'),
			array('paciente_cuil', 'numerical', 'integerOnly'=>true),
			array('study_iuid', 'length', 'max'=>250),
			array('study_pk, firmado_id', 'length', 'max'=>20),
			array('pat_name', 'length', 'max'=>255),
			array('estado', 'length', 'max'=>45),
			array('texto, fecha', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, study_iuid, study_pk, texto, pat_name, paciente_cuil, firmado_id, estado, fecha', 'safe', 'on'=>'search'),
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
          'paciente' => array(self::BELONGS_TO, 'Paciente', 'paciente_cuil'),
		  'estudio' => array(self::BELONGS_TO, 'Study', 'study_iuid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'study_iuid' => 'Study Iuid',
			'study_pk' => 'Study Pk',
			'texto' => 'Texto',
			'pat_name' => 'Paciente DICOM',
			'paciente_cuil' => 'Paciente',
			'firmado_id' => 'Firmado',
			'estado' => 'Estado',
			'fecha' => 'Fecha Informe subido',
			'archivo'=>'Archivo del Informe',
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
		$criteria->compare('study_iuid',$this->study_iuid,true);
		$criteria->compare('study_pk',$this->study_pk,true);
		$criteria->compare('texto',$this->texto,true);
		$criteria->compare('pat_name',$this->pat_name,true);
		$criteria->compare('paciente_cuil',$this->paciente_cuil);
		$criteria->compare('firmado_id',$this->firmado_id,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->join('INNER JOIN study estudio ON t.study_iuid=estudio.study_iuid');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Informe the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	protected function afterFind()
    {
        $this->fecha=($this->fecha)? date('d-m-Y H:i:s', strtotime($this->fecha)) : null;
        $this->pat_name = trim(str_replace('^',' ', $this->pat_name)); 
        return TRUE;
    }
    
    
    public function beforeSave()
    {
        $this->fecha=($this->fecha)? date('Y-m-d H:i:s', strtotime($this->fecha)) : null; 
        return TRUE;
    }
}
