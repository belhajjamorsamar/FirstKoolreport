<?php 
require_once "../vendor/autoload.php";


class SaleReport extends \koolreport\KoolReport
{

    use \koolreport\bootstrap5\Theme;


      //Create settings()
      protected function settings(){

        return array(

        "dataSources"=>array(
            "automaker" => array(
                "connectionString" => "mysql:host=localhost;dbname=automaker",
                "username" => "root", // Change this to your actual username
                "password" => "", // Change this to your actual password
                "charset" => "utf8",
            )
           )
        );   
    }



//setup report


protected function setup()
{
    //we will get the top 10 paying customers
    $this->src("automaker")->query("
    SELECT  customers.customerName, sum(payments.amount) as saleamount
    FROM payments
    JOIN customers ON customers.customerNumber=payments.customerNumber
    GROUP BY customers.customerName
    ORDER BY saleamount desc
    LIMIT 10
    ")
    ->pipe($this->dataStore("result"));
}



}

?>
