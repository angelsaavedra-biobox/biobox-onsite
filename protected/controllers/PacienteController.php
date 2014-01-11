<?php

class PacienteController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $o;
	public $regId = "ij0asdiq0wierf8jf3wja0";

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
            array('allow',
                'actions' => array('existe'),
                'users' => array('*'),
            ), 
			array('allow',
				'users' => array('*'), 
				'expression' => 'Yii::app()->user->isUsuario()',
			), 
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	private function _antes()
	{
		$ok = false;
		$this->o = new stdClass;
		$this->o->ok = false;
    	$this->o->texto = '';
    	$this->o->problema = '';
    	$this->o->id = 1;
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

	public function actionGet()
	{
		$this->_antes();
		$this->returnJson();
	}
	
	public function actionExiste()
	{
	    $o = new stdClass;
	    $output = '';
        $id = (empty($_REQUEST['cuil']))? null : $_REQUEST['cuil'];
        if($id){
            
            $ch = curl_init();
            $host = ($_SERVER['HTTP_HOST']!='biobox.local')? '127.0.0.1' : 'biobox.web';
            
            curl_setopt($ch, CURLOPT_URL, "http://$host/paciente/existe?cuil=$id&regid={$this->regId}");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)');
            $output = curl_exec($ch);
            $a = json_decode($output);

            if(!empty($a->data->cuil)){
                $p = Paciente::model()->findByAttributes(array('cuil'=>$a->data->cuil));
                if(!empty($p->cuil))
                    $a->local = $p->cuil;
            }
            echo json_encode($a);
            curl_close($ch);
        }  
	}
	
	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Paciente;
		$this->performAjaxValidation($model);
		$registro = sprintf("1%010d",rand(1,9999999999));

		if(isset($_POST['Paciente']) and isset($_POST['existe']))
		{
			$model->attributes=$_POST['Paciente'];
			$model->alta = date('Y-m-d H:i:s');
			    
            if($_POST['existe']!=1)
            {                
                $model->registro = $registro;       
                $fields_string = '';
                $ch = curl_init();
                // set url
                $host = ($_SERVER['HTTP_HOST']!='biobox.local')? '127.0.0.1' : 'biobox.web';
                //$host = 'biobox.web';
                curl_setopt($ch, CURLOPT_URL, "http://$host/paciente/createJson?regid={$this->regId}");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                
                
                $_POST['Paciente']['alta'] = date('Y-m-d H:i:s');
                $_POST['Paciente']['nacimiento']=date('Y-m-d', strtotime($_POST['Paciente']['nacimiento'])); 
                $_POST['Paciente']['registro'] = $registro;
                $_POST['Paciente']['sexo'] = $_POST['Paciente']['sexo'];

                $fields = array(
                        'data' => urlencode(trim(serialize($_POST['Paciente'])))
                );
                foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                rtrim($fields_string, '&');
                   
                curl_setopt($ch,CURLOPT_POST, count($fields));
                curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)');
        
                $output = curl_exec($ch);
                $a = json_decode($output);
                curl_close($ch);
                if($a->ok){
                    if($model->save())
                        $this->redirect(array('index'));
                }
            } 
            else 
            {
                $model->registro = $_POST['Paciente']['registro'];       
                
                if($model->save())
                    $this->redirect(array('index'));
            }				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Paciente']))
		{
			$model->attributes=$_POST['Paciente'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
    
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionRegistro($id)
	{
	    $this->layout='//layouts/column3';
		$model=$this->loadModel($id);
        if($model){
            $this->render('registro',array(
                'model'=>$model,
            )); 
        }
        
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Paciente('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Paciente']))
			$model->attributes=$_GET['Paciente'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Paciente::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='paciente-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
