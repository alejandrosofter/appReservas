<?php

/**
 * This is the model class for table "emails".
 *
 * The followings are the available columns in table 'emails':
 * @property integer $id
 * @property string $emisor
 * @property string $receptor
 * @property string $mensaje
 * @property string $fecha
 * @property string $estado
 */
class Mail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mail the static model class
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
		return 'emails';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emisor, receptor, estado', 'length', 'max'=>255),
			array('mensaje, fecha', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, emisor, receptor, mensaje, fecha, estado', 'safe', 'on'=>'search'),
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
			'emisor' => 'Emisor',
			'receptor' => 'Receptor',
			'mensaje' => 'Mensaje',
			'fecha' => 'Fecha',
			'estado' => 'Estado',
		);
	}

	public function enviarMensajeBase($destinatario,$cuerpoMensaje,$titulo,$remitente=null)
	{
		$parametros['cuerpo']=$cuerpoMensaje;
        if($remitente==null)$remitente= Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN');
        $parametros['empresa']=Settings::model()->getValorSistema('DATOS_EMPRESA_FANTASIA');
        $parametros['direccion']=Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION');
        $parametros['telefono']=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO');
        $parametros['horariosAtencion']= Settings::model()->getValorSistema('DATOS_EMPRESA_HORARIOS');
        $parametros['emailAdmin']= Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN');
        $parametros['site']= Settings::model()->getValorSistema('DATOS_EMPRESA_SITE');
        $parametros['titulo']= $titulo;
        $parametros['fecha']= Date('d-m-Y H:i');
        self::model()->enviarMail ( $destinatario, Settings::model()->getValorSistema('PLANTILLA_BASE',$parametros,'impresiones'), $titulo, $remitente);
	}
	public function enviarMail($mail,$mensaje,$titulo,$desde,$attachs=null)
	{
		if(Settings::model()->getValorSistema('ACTIVO_EMAIL')==1){
			$estado="ENVIADO";
			try {
    		Yii::app()->mailer->AddAddress($mail);
			Yii::app()->mailer->Subject = $titulo;
			Yii::app()->mailer->MsgHTML($mensaje);
			Yii::app()->mailer->From=$desde;
			Yii::app()->mailer->Send();
			}catch (Exception $e) {
    			$estado="FALLO DE ENVIO";
			}
			self::ingresa($estado,$mail,$mensaje,$titulo,$desde,Date('Y-m-d H:i:s'));
		}
	
	}
	private function ingresa($estado,$mail,$mensaje,$titulo,$desde,$fecha)
	{
		$model=new Mail;
		$model->emisor=$desde;
		$model->receptor=$mail;
		$model->estado=$estado;
		$model->fecha=$fecha;
		$model->mensaje=$mensaje;
		$model->save();
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('emisor',$this->emisor,true);
		$criteria->compare('receptor',$this->receptor,true);
		$criteria->compare('mensaje',$this->mensaje,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->order='id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}