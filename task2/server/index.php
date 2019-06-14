<?php
    include_once "./libs/carMarket.php";
    //include_once "./libs/function.php";
    include_once "./config.php";


    $dfd = new carMarket();
    //print_r($dfd->lastCars());

    //$server = new SoapServer('/home/user10/public_html/SOAP/task2/server/carmarket.wsdl');
    $server = new SoapServer('http://tc.geeksforless.net/~user10/SOAP/task2/server/carmarket.wsdl');
    $server->setClass('carMarket');
    $server->handle();

    /*
    $msg = array();
    
    $myDB = new MySQL(TYPE_MYSQL_DB, HOST_MYSQL_DB, NAME_MYSQL_DB, USER_MYSQL_DB, PASS_MYSQL_DB);
    $msg[] = "***************** test mySQL *******************";
    for ($i=0; $i<=1; $i++)
    {
        $msg[] =  "*** 1. select all record";
        $res = $myDB->connect()->setTableName("newbooks")->SetFild("title")->SetFild("price")->select()->execution();
        $msg = addToArray($res, $msg);
    
        $msg[] =  "*** 2. insert new record";
        $res = $myDB->connect()->setTableName("newbooks")->SetFild("title", "My book")->SetFild("price", 1000)->insert()->execution();
        //select
        $res = $myDB->connect()->setTableName("newbooks")->SetFild("title")->SetFild("price")->select()->execution();
        $msg = addToArray($res, $msg);
        
        $msg[] =  "<br>*** 2.select record (price=100, left join with table 'author_book' and 'author')";
        $res = $myDB->connect()->setTableName("newbooks")->SetFild("title")->SetFild("content")->SetFild("price")->SetConditions("price", 100)->select()->
            setTableName("author_book")->SetFild("author_id")->setJoinConditions("newbooks.id = author_book.id")->leftJoin()->
            setTableName("author")->SetFild("name")->SetConditions("name", "Jay Asher")->setJoinConditions("author.id = author_book.author_id")->leftJoin()->execution();
        $msg = addToArray($res, $msg);

        $msg[] =  "<br>*** 3. select record (price=100, natural join with table 'author_book' and left join with 'author')";
        $res = $myDB->connect()->setTableName("newbooks")->SetFild("title")->SetFild("content")->SetFild("price")->SetConditions("price", 100)->select()->
            setTableName("author_book")->SetFild("author_id")->naturalJoin()->
            setTableName("author")->SetFild("name")->SetConditions("name", "Jay Asher")->setJoinConditions("author.id = author_book.author_id")->leftJoin()->execution();
        $msg = addToArray($res, $msg);
        
        $msg[] =  "<br>*** 4. select record (price=100)";
        $myDB->connect()->setTableName("newbooks")->SetFild("title")->SetSum("price", "sum_price")->SetConditions("price", 100)->select()->
            setTableName("author_book")->SetMin("author_id")->SetMax("author_id")->naturalJoin()->
            setTableName("author")->SetFild("name")->setJoinConditions("author.id = author_book.author_id")->leftJoin()->
            group()->setHaving("sum_price", 100)->setOrder("name");
            echo $myDB->getQuery();
            $res =   $myDB ->execution();
        $msg = addToArray($res, $msg);
        //$msg[] = $res;
        
        unset($myDB);//destructot
        
        if ($i == 1) { continue; }
        $myDB = new MySQL(TYPE_PGSQL_DB, HOST_PGSQL_DB, NAME_PGSQL_DB, USER_PGSQL_DB, PASS_PGSQL_DB);
        $msg[] = "***************** test pgSQL *******************";
    }
    
    include_once "./templates/index.php";*/
    