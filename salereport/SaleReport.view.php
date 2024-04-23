<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top 10 paying customers</title>
</head>
<body>
    <h1> Top 10 paying customers </h1>
    
    <?php 
    // we will add a bar chart
    \koolreport\widgets\google\BarChart::create(array(
        "dataSource"=>$this->dataStore("result")
    ));

    ?>
    
    <?php
     \koolreport\widgets\koolphp\Table::create(array(
      "dataSource"=>$this->dataStore("result")
     ));
    ?>
   
</body>
</html>