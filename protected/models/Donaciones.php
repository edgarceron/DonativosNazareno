<?php

/**
 * This is the model class for table "donaciones".
 *
 * The followings are the available columns in table 'donaciones':
 * @property integer $id
 * @property integer $id_evento
 * @property integer $id_donante_donacion
 * @property integer $id_representante_donacion
 * @property string $valor_donacion
 * @property integer $validez_donacion
 *
 * The followings are the available model relations:
 * @property Donantes $idDonanteDonacion
 * @property Donantes $idRepresentanteDonacion
 * @property Eventos $idEvento
 */
class Donaciones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'donaciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_evento, id_donante_donacion, valor_donacion, validez_donacion', 'required'),
			array('id_evento, id_donante_donacion, id_representante_donacion, validez_donacion', 'numerical', 'integerOnly'=>true),
			array('valor_donacion', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_evento, id_donante_donacion, id_representante_donacion, valor_donacion, validez_donacion', 'safe', 'on'=>'search'),
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
			'idDonanteDonacion' => array(self::BELONGS_TO, 'Donantes', 'id_donante_donacion'),
			'idRepresentanteDonacion' => array(self::BELONGS_TO, 'Donantes', 'id_representante_donacion'),
			'idEvento' => array(self::BELONGS_TO, 'Eventos', 'id_evento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_evento' => 'Evento',
			'id_donante_donacion' => 'Donante',
			'id_representante_donacion' => 'Id Representante Donacion',
			'valor_donacion' => 'Valor Donacion',
			'validez_donacion' => 'Validez Donacion',
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
		$criteria->compare('id_evento',$this->id_evento);
		$criteria->compare('id_donante_donacion',$this->id_donante_donacion);
		$criteria->compare('id_representante_donacion',$this->id_representante_donacion);
		$criteria->compare('valor_donacion',$this->valor_donacion,true);
		$criteria->compare('validez_donacion',$this->validez_donacion);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
	 * @return Donaciones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
