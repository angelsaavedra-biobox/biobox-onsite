<?php

/**
 * This is the model class for table "bbl_paciente".
 *
 * The followings are the available columns in table 'bbl_paciente':
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property string $cuil
 * @property string $nacimiento
 * @property string $study_pk
 */
class Paciente extends CActiveRecord
{
    public $cuil_search = null;
    public $nuevo_local = false;
    public static $sexos = array('M'=>'Masculino','F'=>'Femenino');
    
    public static function getSexos($key=null)
    {
        if($key!==null)
            return self::$sexos[$key];
        return self::$sexos;
    }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bbl_paciente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, apellido, cuil, nacimiento, sexo', 'required'),
			array('nombre, apellido', 'length', 'max'=>45),
			array('study_pk', 'length', 'max'=>20),
			array('cuil', 'length', 'min'=>11, 'max'=>11),
			array('cuil', 'numerical', 'integerOnly'=>true),
            array('cuil','validaCuil'),
			array('cuil','cargadoCuil','on'=>'create'),
			array('nacimiento', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, apellido, cuil, nacimiento, study_pk, sexo', 'safe', 'on'=>'search'),
		);
	}
	
	public function validaCuil($attribute,$params)
	{
		if(strlen($this->cuil) == 11)
		{
			$cuit = $this->cuil;
			$mult = array(5, 4, 3, 2, 7, 6, 5, 4, 3, 2);
			$total = 0;
			for ($i = 0; $i < count($mult); $i++) {
				$total += intval($cuit[$i]) * $mult[$i];
			}
			$modulo = $total % 11;
			$digito = $modulo == 0 ? 0 : $modulo == 1 ? 9 : 11 - $modulo;
			
			if($digito != intval($cuit[10]))
				$this->addError($attribute, "Nro. de CUIL no válido");
			#elseif(Paciente::model()->findByAttributes(array('cuil'=>$this->cuil, 'nacimiento'=>$this->nacimiento)))
			#	$this->addError($attribute, "Nro. de CUIL ya lo tiene asignado otra persona");
		} else
			$this->addError($attribute, "Nro. de CUIL no válido");
		return true;
	}
	
	public function cargadoCuil($attribute,$params)
    {
        if(Paciente::model()->findByAttributes(array('cuil'=>$this->cuil)))
            $this->addError($attribute, "Nro. de CUIL ya lo tiene asignado otra persona");
        return true;
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
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'cuil' => 'Cuil',
			'nacimiento' => 'Nacimiento',
			'study_pk' => 'Study Pk',
			'alta' => 'Alta',
			'usuario_id' => 'Usuario',
            'registro'=> 'Registro',
			'sexo'=> 'Sexo',
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

		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('cuil',$this->cuil,true);
		$criteria->compare('nacimiento',$this->nacimiento,true);
        $criteria->compare('study_pk',$this->study_pk,true);
		$criteria->compare('sexo',$this->sexo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Paciente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	protected function afterFind()
    {
        $this->nacimiento=date('d-m-Y', strtotime($this->nacimiento)); 
        return TRUE;
    }
    
    
    public function beforeSave()
    {
        $this->nacimiento=date('Y-m-d', strtotime($this->nacimiento)); 
        return TRUE;
    }
}
