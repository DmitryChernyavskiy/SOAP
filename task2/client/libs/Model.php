<?php

include_once 'config.php';

class Model
{ 
    private $array;
    private $select;
    private $client;
    
    public function __construct()
    {
        
        $this->client = new SoapClient(SOAP_SERVER, array('cache_wsdl'=>WSDL_CACHE_NONE));

        $this->array = array('%TITLE%'=>'Car market');
	    $this->select = Array('credit card', 'cash');
        $this->resetForm();
        $this->createSelectListPay($this->select[0]);
    }
    
    private function resetForm()
    {
        $this->array['%ERRORS%'] = '';//'Empty field';
        $this->array['%ERROR_NAME%'] = '';
        $this->array['%ERROR_EMAIL%'] = '';
        $this->array['%ERROR_TYPEMSG%'] = '';
        $this->array['%ERROR_TEXT%'] = '';
        $this->array['%VAL_ID%'] = '';
        $this->array['%VAL_BRAND%'] = '';
        $this->array['%VAL_MODEL%'] = '';
        $this->array['%VAL_YEAR%'] = '';
        $this->array['%VAL_VOLUME%'] = '';
        $this->array['%VAL_SPEED%'] = '';
        $this->array['%VAL_COLOR%'] = '';
        $this->array['%VAL_PRICE%'] = '';
        $this->array['%VAL_NAME%'] = '';
        $this->array['%VAL_SURNAME%'] = '';
        $this->array['%VAL_LISTCAR%'] = '';
        $this->array['%VAL_ORDERS%'] = '';
        $this->array['%VAL_BUTTON%'] = 'Find';
        $this->array['%SECTION_SELECT%'] = 'display: none;';
        $this->array['%SECTION_CLIENTDATA%'] = 'display: none;';
        $this->array['%SECTION_LISTCARS%'] = 'display: none;';
        $this->array['%SECTION_ORDERS%'] = 'display: none;';
        $this->array['%EDIT_CARINFO%'] = '';
        
    }
    
    private function createSelectListPay($selected)
    {
        //$selected = (int)$selected;
        $str = '<select name = "paymentMethod" class = "box">';
        for($i = 0; $i<count($this->select); $i++)
        {
            $str = $str.'<option value = '.$i.' '.($selected == $i ? 'selected': '').'>'.$this->select[$i].'</option>';
            //$str = $str.'<option value = '.$this->select[$i].' '.($selected == $this->select[$i] ? 'selected': '').'>'.$this->select[$i].'</option>';
        }
        $str .= '</select>';
        $this->array['%SELECT%'] = $str;
        $this->array['%SECTION_SELECT%'] = '';
    }

    private function createSelec($list, $name)
    {
        $arr = $list[$name];
        //print_r($arr);
        $str ='<select name = "'.$name.'" class = "box">
                <option value = "" >all</option>';;
        for($i = 0; $i<count($arr); $i++)
        {
            $str .= '<option value = '.$arr[$i].' >'.$arr[$i].'</option>';
            //echo $i.' '.'>'.$list["".$i];
        }
        $str .= '</select>';
        return $str;
    }

    private function createSelectList()
    {
        $list = $this->client->getDataDescription();
        $this->array['%VAL_ID%'] = "all";
        $this->array['%VAL_BRAND%'] = $this->createSelec($list, "brand");
        $this->array['%VAL_MODEL%'] = $this->createSelec($list, "model");
        $this->array['%VAL_YEAR%'] = $this->createSelec($list, "year");
        $this->array['%VAL_VOLUME%'] = $this->createSelec($list, "volume");
        $this->array['%VAL_SPEED%'] = $this->createSelec($list, "speed");
        $this->array['%VAL_COLOR%'] = $this->createSelec($list, "color");
        $this->array['%VAL_PRICE%'] = $this->createSelec($list, "price");
    }
    
       
    public function getArray()
    {	    
    	return $this->array;	
    }
    
    private function createCarTable($list)
    {
        $res = "";
        foreach ($list as $row)
        {
            $res .= '<tr><td>'.$row['id'].'</td><td>'.$row['brand'].'</td><td>'.$row['model'].'</td><td>'.$row['color'].'</td><td align="center">'
                    . '<form method="POST" style="margin: 5;"><input type = "hidden" name = "infoCar" Value = '.$row['id'].'><input type = "hidden" name = "color" Value = '.$row['color'].'><input type = "submit" Value = "info"></form>'
                    . '</td></tr>';
        }
        return $res;
    }

    public function listCars()
    {
        $list = $this->client->listCars();
        $this->array['%VAL_LISTCAR%'] = $this->createCarTable($list);
        $this->array['%SECTION_LISTCARS%'] = '';

        $this->createSelectList();
    } 
    
    public function findCars()
    {
        $list = $this->client->findCars($_POST);
        $this->array['%VAL_LISTCAR%'] = $this->createCarTable($list);
        $this->array['%SECTION_LISTCARS%'] = '';

        $this->createSelectList();
    } 
    
    public function InfoCars()
    {
        $this->resetForm();
        $list = $this->client->getInfo($_POST['infoCar'],$_POST['color']);
        if (0 <= count($list))
        {
            $row = $list[0];
            $this->array['%VAL_ID%'] = $row['id'];
            $this->array['%VAL_BRAND%'] = $row['brand'];
            $this->array['%VAL_MODEL%'] = $row['model'];
            $this->array['%VAL_YEAR%'] = $row['year'];
            $this->array['%VAL_VOLUME%'] = $row['volume'];
            $this->array['%VAL_SPEED%'] = $row['speed'];
            $this->array['%VAL_COLOR%'] = $row['color'];
            $this->array['%VAL_PRICE%'] = $row['price'];
            $this->array['%VAL_BUTTON%'] = 'Buy';
            $this->array['%SECTION_SELECT%'] = '';
            $this->array['%SECTION_CLIENTDATA%'] = '';
            $this->array['%EDIT_CARINFO%'] = 'readonly';
        }
        else
        {
            unset($_POST);
        }
    }  
    
    public function setOrder()
    {
        $name = trim($_POST['name']);
        $surName = trim($_POST['surname']);
        $idCar = trim($_POST['idCar']);
        $paymentMethod = trim($_POST['paymentMethod']);
        
        $this->client->setOrder($idCar, $name, $surName, $this->select[$paymentMethod]);
    }

    public function getOrders()
    {
        $this->resetForm();
        $list = $this->client->getOrders();
        $res = "";
        foreach ($list as $row)
        {
            $res .= '<tr><td>'.$row['id_car'].'</td><td>'.$row['name'].'</td><td>'.$row['surName'].'</td><td>'.$row['pay'].'</td></tr>';
        }
        $this->array['%VAL_ORDERS%'] = $res;
        $this->array['%SECTION_ORDERS%'] = '';
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
        $this->createSelectListPay($typemessage);
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
	
}
