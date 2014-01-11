<?php

/**
 * This is the model class for table "bbl_usuario".
 *
 * The followings are the available columns in table 'bbl_usuario':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $rol
 * @property integer $activo
 * @property string $nombre_completo
 */
class Usuario extends CActiveRecord
{
	public static $estados = array('Inactivo','Activo');
	public static $roles = array('admin'=>'Administardor','usuario'=>'Usuario');
	public $new_password;
	public $repeat_password;
	
	public static function getEstados($key=null)
	{
		if($key!==null)
			return self::$estados[$key];
		return self::$estados;
	}
	
	public static function getRoles($key=null)
	{
		if($key!==null)
			return self::$roles[$key];
		return self::$roles;
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bbl_usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, nombre_completo', 'required'),
			array('activo', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>250),
			array('email, rol, nombre_completo', 'length', 'max'=>255),
				
			array('new_password, repeat_password', 'required', 'on'=>'insert'),
			array('new_password, repeat_password', 'length', 'min'=>6, 'max'=>40),
			
			array('repeat_password', 'compare', 'compareAttribute'=>'new_password'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, email, rol, activo, nombre_completo', 'safe', 'on'=>'search'),
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
			'username' => 'Usuario',
			'new_password' => 'Contraseña',
			'repeat_password' => 'Repita Contraseña',
			'email' => 'Email',
			'rol' => 'Rol',
			'activo' => 'Activo',
			'nombre_completo' => 'Nombre Completo',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('rol',$this->rol,true);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('nombre_completo',$this->nombre_completo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave()
	{
		if (!empty($this->new_password))
		{
			$this->password = sha1($this->new_password);
		}			
		return true;
	}
	
	
}
