<?php

/**
 * This is the model class for table "bbl_log_informe".
 *
 * The followings are the available columns in table 'bbl_log_informe':
 * @property integer $id
 * @property string $informe_id
 * @property string $fecha
 * @property string $estado
 * @property string $accion
 * @property string $usuario_id
 */
class LogInforme extends CActiveRecord
{
	public $nombre_completo;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bbl_log_informe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('informe_id, usuario_id', 'required'),
			array('informe_id, usuario_id', 'length', 'max'=>20),
			array('estado, accion', 'length', 'max'=>45),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, informe_id, fecha, estado, accion, usuario_id', 'safe', 'on'=>'search'),
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
			'usuario'=>array(self::BELONGS_TO, 'Usuario', 'usuario_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'informe_id' => 'Informe',
			'fecha' => 'Fecha',
			'estado' => 'Estado',
			'accion' => 'Accion',
			'usuario_id' => 'Usuario',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('informe_id',$this->informe_id,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('accion',$this->accion,true);
		$criteria->compare('usuario_id',$this->usuario_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LogInforme the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
