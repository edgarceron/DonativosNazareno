<?php
class DonantesTipoAction extends CAction
{
	public $desde;
	public $hasta;
	
    public function run()
    {                   
        $this->inicializar();
		$criteria = $this->getCriteria();
		$totales = Donaciones::model()->findAll($criteria);
		
		$tipos = array(1 => 'Persona natural', 2 => 'Empresa', 3 => 'Extrangero');
		$reporte = array();
		foreach($totales as $t){
			$reporte[$t['idDonanteDonacion']['tipo_documento_donante']] = $t['valor_donacion'];
		}

        $this->controller->render('grafico',array(
			'desde' => $this->desde,
			'hasta' => $this->hasta,
			'tipos' => $tipos,
			'reporte' => $reporte,
        ));
    }
	
	public function getCriteria(){
		$criteria = new CDbCriteria;
		
		$criteria->with = array(
			'idDonanteDonacion' => array(
				'alias'=> 't1', 
				'together' => true,
				'select' => array('t1.tipo_documento_donante'),
			),
			'idEvento' => array(
				'alias'=> 't2', 
				'together' => true,
				'select' => array(),
			),
		);
		$criteria->select = 'SUM(valor_donacion) as valor_donacion';
		$criteria->group = 't1.tipo_documento_donante';
		$criteria->compare('validez_donacion', 1);
		if($this->desde != '' && $this->hasta != ''){
			$criteria->addCondition('t2.fecha_evento BETWEEN "'.$this->desde.'" AND DATE_ADD("'.$this->hasta.'", INTERVAL 1 DAY)');
		}
		else if($this->desde != ''){
			$criteria->addCondition('t2.fecha_evento > "'.$this->desde.'"');
		}
		else if($this->hasta != ''){
			$criteria->addCondition('t2.fecha_evento < "'.$this->hasta.'"');
		}
		
		return $criteria;
	}
	
	public function inicializar(){
		
		if(isset($_GET['desde'])){
			$this->desde = $_GET['desde'];
		}
		else{
			$this->desde = '';
		}
		
		if(isset($_GET['hasta'])){
			$this->hasta = $_GET['hasta'];
		}
		else{
			$this->hasta = '';
		}
		
	}
}

