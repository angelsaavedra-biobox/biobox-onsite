<?php
 
// this file must be stored in:
// protected/components/WebUser.php
 
class WebUser extends CWebUser {
 
  // Store model to not repeat query.
  private $_model;
 
  // Return first name.
  // access it by Yii::app()->user->first_name
  function getNombre(){
    $user = $this->loadUser(Yii::app()->user->id);
    //print_r($user);
    return $user->nombre_completo;
    
  }
 
  // This is a function that checks the field 'role'
  // in the User model to be equal to 1, that means it's admin
  // access it by Yii::app()->user->isAdmin()
  function isAdmin(){
    $user = $this->loadUser(Yii::app()->user->id);
    if($user)
    	return $user->rol == 'admin';
    else
    	return false;
  }

  // This is a function that checks the field 'role'
  // in the User model to be equal to 1, that means it's admin
  // access it by Yii::app()->user->isUsuario()
  function isUsuario(){
    $user = $this->loadUser(Yii::app()->user->id);
    if($user)
    	return $user->rol == 'usuario' or $user->rol == 'admin';
    else
    	return false;
  }
 
  // Load user model.
  protected function loadUser($id=null)
	{
        if($this->_model===null)
        {
            if($id!==null)
                $this->_model=Usuario::model()->find("username='$id'");
        }
        return $this->_model;
    }
}
?>