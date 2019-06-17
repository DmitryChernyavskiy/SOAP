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
        $res = $this->DB->connect()->setTableName("cars")->SetFild("id")->select()->
            setTableName("brands")->SetFild("brand")->setJoinConditions("cars.id_brand = brands.id")->leftJoin()->
            setTableName("models")->SetFild("model")->setJoinConditions("cars.id_model = models.id")->leftJoin()->execution();
        return $res;
        //return array(array("id"=>1, "name"=>"test1"), array("id"=>2, "name"=>"test1"));
    }

    public function getInfo($idCar)
    {
        if (isset($idCar) && isset($name) && isset($surName))
        {
            $res = $this->DB->connect()->setTableName("cars")->SetFild("id")->SetFild("volume")->SetFild("speed")->SetFild("year")->SetFild("price")->setConditions("id", $idCar)->select()->
                setTableName("brands")->SetFild("brand")->setJoinConditions("cars.id_brand = brands.id")->leftJoin()->
                setTableName("models")->SetFild("model")->setJoinConditions("cars.id_model = models.id")->leftJoin()->
                setTableName("colors_cars")->setJoinConditions("cars.id = colors_cars.id_car")->leftJoin()->
                setTableName("colors")->SetFild("color")->setJoinConditions("colors_cars.id_color = colors.id")->leftJoin()->execution();
            return $res;
        }
        return array();
    }

    public function findCars($volume, $speed, $year, $price, $brand, $model, $color)
    {
        $query = $this->DB->connect()->setTableName("cars")->SetFild("id");
        if (isset($volume))
        {
            $query->setConditions("volume", $volume);
        };
        if (isset($speed))
        {
            $query->setConditions("speed", $speed);
        };
        if (isset($year))
        {
            $query->setConditions("year", $year);
        };
        if (isset($price))
        {
            $query->setConditions("price", $price);
        };    
        $query->select();
        //brand
        if (isset($brand))
        {
            $query->setTableName("brands")->setConditions("brand", $brand)->setJoinConditions("cars.id_brand = brands.id")->innerJoin();
        };
        //model
        if (isset($model))
        {
            $query->setTableName("models")->setConditions("model", $model)->setJoinConditions("cars.id_model = models.id")->innerJoin();
        };
        //color
        if (isset($color))
        {
            $query->setTableName("colors_cars")->setJoinConditions("cars.id = colors_cars.id_car")->innerJoin()->
            setTableName("colors")->setConditions("color", $color)->setJoinConditions("colors_cars.id_color = colors.id")->innerJoin()
        };
        $query->execution();
        return $res;
    }

    public function setOrder($idCar, $name, $surName)
    {
        if (isset($idCar) && isset($name) && isset($surName))
        {
            $res = $this->DB->connect()->setTableName("orders_cars")->SetFild("name", $name)->SetFild("surName", $surName)->setConditions("id", $idCar)->insert()->execution();
            return true;
        }
        return false;
    }

    public function getOrders()
    {
        $res = $this->DB->connect()->setTableName("orders_cars")->SetFild("id")->SetFild("name")->SetFild("surName")->select()->execution();
        return $res;
    }
}