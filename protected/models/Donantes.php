<?php

/**
 * This is the model class for table "donantes".
 *
 * The followings are the available columns in table 'donantes':
 * @property integer $id
 * @property integer $tipo_documento_donante
 * @property string $numero_documento_donante
 * @property string $nombre_donante
 * @property string $apellido_donante
 * @property string $direccion_donante
 * @property string $correo_donante
 * @property string $telefono_donante
 *
 * The followings are the available model relations:
 * @property Donaciones[] $donaciones
 * @property Donaciones[] $donaciones1
 */
class Donantes extends CActiveRecord
{
	public $enero;
	public $febrero;
	public $marzo;
	public $abril;
	public $mayo;
	public $junio;
	public $julio;
	public $agosto;
	public $septiembre;
	public $octubre;
	public $noviembre;
	public $diciembre;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'donantes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo_documento_donante, numero_documento_donante, nombre_donante', 'required'),
			array('tipo_documento_donante', 'numerical', 'integerOnly'=>true),
			array('numero_documento_donante', 'length', 'max'=>11),
			array('nombre_donante, apellido_donante', 'length', 'max'=>50),
			array('direccion_donante', 'length', 'max'=>60),
			array('correo_donante', 'length', 'max'=>100),
			array('telefono_donante', 'length', 'max'=>14),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tipo_documento_donante, numero_documento_donante, nombre_donante, apellido_donante, direccion_donante, correo_donante, telefono_donante', 'safe', 'on'=>'search'),
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
			'donaciones' => array(self::HAS_MANY, 'Donaciones', 'id_donante_donacion'),
			'donaciones1' => array(self::HAS_MANY, 'Donaciones', 'id_representante_donacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tipo_documento_donante' => 'Tipo Documento Donante',
			'numero_documento_donante' => 'Numero Documento Donante',
			'nombre_donante' => 'Nombre Donante',
			'apellido_donante' => 'Apellido Donante',
			'direccion_donante' => 'Direccion Donante',
			'correo_donante' => 'Correo Donante',
			'telefono_donante' => 'Telefono Donante',
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
		$criteria->compare('tipo_documento_donante',$this->tipo_documento_donante);
		$criteria->compare('numero_documento_donante',$this->numero_documento_donante,true);
		$criteria->compare('nombre_donante',$this->nombre_donante,true);
		$criteria->compare('apellido_donante',$this->apellido_donante,true);
		$criteria->compare('direccion_donante',$this->direccion_donante,true);
		$criteria->compare('correo_donante',$this->correo_donante,true);
		$criteria->compare('telefono_donante',$this->telefono_donante,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function tiposDocumento(){
		return array('1' => 'Cedula de ciudadania', '2' => 'Nit', '3' => 'Cedula de extrangeria ');
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->donativos;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Donantes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
