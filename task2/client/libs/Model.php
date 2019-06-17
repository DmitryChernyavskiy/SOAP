<?php 

class Model
{ 
    private $array;
    private $select;
    
    public function __construct()
    {
        //$client = new SoapClient("http://tc.geeksforless.net/~user10/SOAP/task2/server/?WSDL", array('cache_wsdl'=>WSDL_CACHE_NONE));

        //$res = $client->lastCars();

        $this->array = array('%TITLE%'=>'Car market');
	    $this->select = Array('credit card', 'cash');
        $this->resetForm();
        $this->createSelectList(0);
    }
    
    private function resetForm()
    {
        $this->array['%ERRORS%'] = '';//'Empty field';
        $this->array['%ERROR_NAME%'] = '';
        $this->array['%ERROR_EMAIL%'] = '';
        $this->array['%ERROR_TYPEMSG%'] = '';
        $this->array['%ERROR_TEXT%'] = '';
        $this->array['%VAL_BRAND%'] = '';
        $this->array['%VAL_MODEL%'] = '';
        $this->array['%VAL_YEAR%'] = '';
        $this->array['%VAL_VOLUME%'] = '';
        $this->array['%VAL_SPEED%'] = '';
        $this->array['%VAL_COLOR%'] = '';
        $this->array['%VAL_PRICE%'] = '';
        $this->array['%VAL_NAME%'] = '';
        $this->array['%VAL_SURNAME%'] = '';
    }
    
    private function createSelectList($selected)
    {
        $selected = (int)$selected;
        $str = '';
        for($i = 0; $i<count($this->select); $i++)
        {
            $str = $str.'<option value = '.$i.' '.($selected == $i ? 'selected': '').'>'.$this->select[$i].'</option>';
        }
        $this->array['%SELECT%'] = $str;
        
    }
       
    public function getArray()
    {	    
    	return $this->array;	
    }
    
    public function checkForm()
    {
        $return_flag = true;
        /*$Name = trim($_POST['Name']);
        $typemessage = trim($_POST['typemessage']);
        $email = trim($_POST['email']);
        $text = nl2br(trim($_POST['text']));
        
        //save values of form
        $this->array['%VAL_NAME%'] = $Name;
        $this->createSelectList($typemessage);
        $this->array['%VAL_EMAIL%'] = $email;
        $this->array['%VAL_TEXT%'] = $text;
        
        //check and create error message
        
        if ($Name == '')
        {
            $this->array['%ERROR_NAME%'] = '* The name must be specified';
            $return_flag = false;
        }
        elseif (!ctype_alpha($Name))
        {
            $this->array['%ERROR_NAME%'] = '* Name contains invalid characters';
            $return_flag = false;
        }
        
        if ($email == '')
        {
            $this->array['%ERROR_EMAIL%'] = '* The e-mail must be specified';
            $return_flag = false;
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $this->array['%ERROR_EMAIL%'] = '* E-mail is incorrect';
            $return_flag = false;
        }
        
        if ($text == '')
        {
            $this->array['%ERROR_TEXT%'] = '* The message text must be specified';
            $return_flag = false;
        }
        
        if ($typemessage == 0)
        {
            $this->array['%ERROR_TYPEMSG%'] = '* Select message type!';
            $return_flag = false;
        }*/
        
    	return $return_flag;			
    }
    
    public function sendEmail()
    {
        /*$Name = trim($_POST['Name']);
        $typemessage = trim($_POST['typemessage']);
        $email = trim($_POST['email']);
        $text = nl2br(trim($_POST['text']));
       
        $header = 'From: '.$Name.' <'.$email.'>';
        $subject = $this->select[$typemessage].' (from '.$Name.' IP='.getHostByName(getHostName()).')';
        
        if(!mail(ADMINMAIL, $subject, $text, $header))
        {
            $this->array['%ERRORS%'] = 'Error send message';
            return false;
        }
    	$this->resetForm();
    	$this->createSelectList(0);
    	$this->array['%ERRORS%'] = 'the letter was sent';*/
    }		
}
