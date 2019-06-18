<?php

class Controller
{
    private $model;
    private $view;

    public function __construct()
    {		
        $this->model = new Model();
        $this->view = new View(TEMPLATE);	

        print_r($_POST);
        if(isset($_POST['infoCar']))
        {	
            $this->pageInfoCar();
        }
        elseif(isset($_POST['name']))
        {	
            $this->pageBuyCar();
        }
        elseif(isset($_POST['volume']) || isset($_POST['speed']) || isset($_POST['year']) || isset($_POST['price']) || isset($_POST['brand']) || isset($_POST['model']) || isset($_POST['color']))
        {	
            $this->pageFindCar();
        }
        else
        {
            $this->pageDefault();	
        }

        $this->view->templateRender();			
    }	

    private function pageDefault()
    {   
        $this->model->listCars();
        $mArray = $this->model->getArray();		
        $this->view->addToReplace($mArray);			   
    }	
    
    private function pageInfoCar()
    {
        $this->model->InfoCars();
        $mArray = $this->model->getArray();
        $this->view->addToReplace($mArray);
    }
    
    private function pageBuyCar()
    {   
        //if($this->model->checkForm() === true)
        {
            $this->model->setOrder();
        }
        $this->pageDefault();			   
    }
    
    private function pageFindCar()
    {
        $this->model->findCars();
        $mArray = $this->model->getArray();
        $this->view->addToReplace($mArray);
    }
			
}
