<?php
include_once "./libs/MySQL.php";
include_once "./config.php";
class carMarket
{
    private $DB;

    function __construct()
    {
        $this->DB = new MySQL(TYPE_MYSQL_DB, HOST_MYSQL_DB, NAME_MYSQL_DB, USER_MYSQL_DB, PASS_MYSQL_DB);
    }
    
    function __destruct()
    {
        unset($this->DB);
    }

    public function lastCars()
    {
        $res = $this->DB->connect()->setTableName("cars")->SetFild("id")->SetFild("volume")->SetFild("speed")->SetFild("year")->SetFild("price")->select()->
            setTableName("brands")->SetFild("name")->setJoinConditions("cars.id_brand = brands.id")->leftJoin()->
            setTableName("models")->SetFild("name")->setJoinConditions("cars.id_model = models.id")->leftJoin()->
            setTableName("colors_cars")->setJoinConditions("cars.id = colors_cars.id_car")->leftJoin()->
            setTableName("colors")->SetFild("name")->setJoinConditions("colors_cars.id_color = colors.id")->leftJoin()->execution();
        return $res;
        //return array(array("id"=>1, "name"=>"test1"), array("id"=>1, "name"=>"test1"));
    }

    public function getInfo($id)
    {
        //return $id;
    }

    public function findCars(type $Condition)
    {
        //return "";
    }

    public function setOrder(type $idCar, $name, $surName)
    {
        
    }

    public function getOrders()
    {
        //return "";
    }
}