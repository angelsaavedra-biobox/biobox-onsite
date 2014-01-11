<?php

class InformeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $o;
	public $estado;
	public $userid;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	private function _antes($nuevoEstado)
	{
		$ok = false;
		$this->estado = $nuevoEstado;
		$this->userid = Usuario::model()->findByAttributes(array('username'=>Yii::app()->user->getId()))->id;
		$this->o = new stdClass;
		$this->o->ok = false;
    	$this->o->texto = '';
    	$this->o->problema = '';
    	$this->o->eid = (!empty($_POST['eid']))? $_POST['eid'] : null;	
		$this->o->id = (!empty($_REQUEST['id']))? $_REQUEST['id'] : null;
		$this->o->informe = (!empty($_POST['informe']))? $_POST['informe'] : null;
		$this->o->con_audio = (!empty($_POST['con_audio']))? $_POST['con_audio'] : 0;
		if($this->o->id)
			$ok = true;
		else
			$this->o->problema = 'Falta el ID';
		return $ok;
	}
	
	private function returnJson()
	{
		echo json_encode($this->o);
	}
	
	private function saveLog($nuevoEstado)
	{
		$modelo = new LogInforme;
		$modelo->informe_id = $this->o->id;
		$modelo->estado = $this->estado;
		$modelo->fecha = date('Y-m-d H:i:s');
		$modelo->usuario_id = $this->userid;
		$this->o->ok = ($modelo->save())? true : false;
	}
	/**
	 * Listado de acciones del menú
	 */
	public function actionIndex($estado=null)
	{		
		$model=new ViewInformes('search');
		$model->unsetAttributes();  // clear any default values
		#echo $estado; exit();
		//$model->estado='grabar';
		if(isset($_GET['ViewInformes']))
			$model->attributes=$_GET['ViewInformes'];
		if(empty($model->attributes['estado']))
		  $model->estado='grabar';
		if(!empty($estado) and !isset($_GET['ViewInformes']))
		  $model->estado=$estado;
		$this->render('index',array(
				'model'=>$model,
		));
		
	}
	
	public function actionInforme($id=null)
	{
	    if($id)
	    {
	        
	        $model = Informe::model()->findByPk($id);
	        $estudio = Study::model()->findByAttributes(array('study_iuid'=>$model->study_iuid));
                    
	        if(!$estudio)
	        {
	            $this->redirect(array('index','estado'=>$model->estado));
	        }
	        if(isset($_POST['Informe']) and $model){
	            
	            $model->paciente_cuil = $_POST['Informe']['paciente_cuil'];
	            $model->estado = $_POST['Informe']['estado'];
	            if(!empty($_FILES['Informe']['name']['archivo']))
	            {
	                $model->archivo=CUploadedFile::getInstance($model,'archivo');
                    if(!is_dir("informes/{$model->paciente_cuil}"))
                        mkdir("informes/{$model->paciente_cuil}");
                    if(file_exists("informes/{$model->paciente_cuil}/{$model->study_iuid}.pdf"))
                        unlink("informes/{$model->paciente_cuil}/{$model->study_iuid}.pdf");
                    $model->archivo->saveAs("informes/{$model->paciente_cuil}/{$model->study_iuid}.pdf");
	            }
	            
	            if($model->save())
	            {
	                $this->redirect(array('index','estado'=>$model->estado));
	            }
	               
	        }
	        if(file_exists("informes/{$model->paciente_cuil}/{$model->study_iuid}.pdf"))
	           $model->archivo = "informes/{$model->paciente_cuil}/{$model->study_iuid}.pdf";
	        
	        $this->render('informe', array('model'=>$model, 'estudio'=>$estudio));
        } else
            $this->redirect(array('index','estado'=>$model->estado));
    }
    
    public function actionGrabar($id=null)
    {
        if($id)
        {
            
            $model = Informe::model()->findByPk($id);
            $estudio = Study::model()->findByAttributes(array('study_iuid'=>$model->study_iuid));
            if(!$estudio)
            {
                $this->redirect(array('index','estado'=>$model->estado));
            }
            if(isset($_POST['Informe']) and $model){
                $model->estado = $_POST['Informe']['estado'];
                if($model->save())
                {
                    $this->redirect(array('index','estado'=>$model->estado));
                }
                   
            }
            $this->render('grabacion', array('model'=>$model, 'estudio'=>$estudio));
        } else
            $this->redirect(array('index','estado'=>$model->estado));
    }
    
    public function actionDescargar($id)
    {
        $ok = false;
        if($id)
        {
            $model = Informe::model()->findByPk($id);
            if($model)
            {
                $archivo = 'informes/'.$model->paciente_cuil.'/'.$model->study_iuid.'.pdf';
                if(file_exists($archivo))
                {
                    // We'll be outputting a PDF
                    header('Content-type: application/pdf');
                    
                    // It will be called downloaded.pdf
                    header('Content-Disposition: attachment; filename="informe.pdf"');
                    
                    // The PDF source is in original.pdf
                    readfile($archivo);
                    $ok = true;
                }                
            }
        }
        if(!$ok)
            $this->redirect(array('index'));
    }
    
	public function actionGet()
	{
		if($this->_antes('obtener')){
			$modelo = Informe::model()->find("id={$this->o->id}");
			$this->o->texto = base64_decode($modelo->texto);		
			$this->o->eid = $modelo->study_iuid;
			$this->o->id = $modelo->id;
			$this->saveLog($this->estado);
		}
		$this->returnJson();
	}
	
	public function actionAsignar()
	{
	    $eid = (empty($_POST['eid']))? null : $_POST['eid'];
	    $cuil = (empty($_POST['cuil']))? null : $_POST['cuil'];
	    $o = new stdClass;
	    $o->ok = false;
	    if($eid and $cuil)
	    {
	        Informe::model()->updateByPk($eid, 
	           array(
                'paciente_cuil'=>$cuil
               )
            );
	        $o->ok = true;
	    }
	    echo json_encode($o);
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Informe::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='informe-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
