<?php

class Controller
{
    private $model;
    private $view;

    public function __construct()
    {		
        $this->model = new Model();
        $this->view = new View(TEMPLATE);	

        //print_r($_POST);
        $operation = $_POST['button'];
        if(isset($operation))
        {	
            if($operation=="Buy") //checkorder
            {	
                $this->pageBuyCar();
            }
            elseif($operation=="Find")
            {
                $this->pageFindCar();
            }
            elseif($operation=="order")
            {
                $this->pageOrders();
            }
            else
            {
                $this->pageDefault();	
            }
        }
        elseif(isset($_POST['infoCar']))
        {	
            $this->pageInfoCar();
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

    private function pageOrders()
    {
        $this->model->getOrders();
        $mArray = $this->model->getArray();
        $this->view->addToReplace($mArray);
    }
			
}
