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
    public function listCars()
    {
        $res = $this->DB->connect()->setTableName("cars")->SetFild("id")->select()->
            setTableName("brands")->SetFild("brand")->setJoinConditions("cars.id_brand = brands.id")->leftJoin()->
            setTableName("models")->SetFild("model")->setJoinConditions("cars.id_model = models.id")->leftJoin()->execution();
        return $res;
        //return array(array("id"=>1, "name"=>"test1"), array("id"=>2, "name"=>"test1"));
    }
    public function getInfo($idCar)
    {
        if (isset($idCar))
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
        if (isset($volume) && $volume!=0)
        {
            $query->setConditions("volume", $volume);
        };
        if (isset($speed) && $speed!=0)
        {
            $query->setConditions("speed", $speed);
        };
        if (isset($year) && $year!=0)
        {
            $query->setConditions("year", $year);
        };
        if (isset($price) && $price!=0)
        {
            $query->setConditions("price", $price);
        };    
        $query->select()->setTableName("brands")->SetFild("brand");
        //brand
        if (isset($brand) && $brand!="")
        {
            $query->setConditions("brand", $brand)->setJoinConditions("cars.id_brand = brands.id")->innerJoin();
        }
        else
        {
            $query->setJoinConditions("cars.id_brand = brands.id")->leftJoin();
        };
        //model
        $query->setTableName("models")->SetFild("model", $model);
        if (isset($model) && $model!="")
        {
            $query->setConditions("model", $model)->setJoinConditions("cars.id_model = models.id")->innerJoin();
        }
        else
        {
            $query->setJoinConditions("cars.id_model = models.id")->leftJoin();
        };
        //color
        if (isset($color) && $color!="")
        {
            $query->setTableName("colors_cars")->setJoinConditions("cars.id = colors_cars.id_car")->innerJoin()->
            setTableName("colors")->SetFild("color", $color)->setConditions("color", $color);
        };
        $res = $query->execution();
        return $res;
    }
    public function setOrder($idCar, $name, $surName, $paymentMethod)
    {
        $fd = fopen("/home/user10/public_html/hello.txt", 'w') or die("не удалось создать файл");
        $str = "setOrder ".$idCar."_".$name."_".$surName."_".$paymentMethod."_";
        fwrite($fd, $str);
        fclose($fd);
        if (isset($idCar) && isset($name) && isset($surName) && isset($paymentMethod))
        {
            $this->DB->connect()->setTableName("orders_cars")->SetFild("id_car", $idCar)->SetFild("name", $name)->SetFild("surName", $surName)->SetFild("pay", $paymentMethod)->insert();

            $this->DB->execution();
            return $res;
        }
        return false;
    }
    public function getOrders()
    {
        $res = $this->DB->connect()->setTableName("orders_cars")->SetFild("id")->SetFild("name")->SetFild("surName")->select()->execution();
        return $res;
    }
}