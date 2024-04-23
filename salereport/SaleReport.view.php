<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top 10 paying customers</title>
     <style>
        /* Conteneur flex pour les cartes */
        .card-container {
            display: flex;
            flex-wrap: wrap; /* Permet aux cartes de passer à la ligne lorsque l'espace est insuffisant */
            justify-content: space-between; /* Répartit l'espace entre les cartes */
        }

        /* Style pour les cartes */
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            width: calc(70% - 1px); /* Pour 3 cartes côte à côte */
        }
    </style>
</head>
<body>
    <h1>Top 10 paying customers</h1>
    
    <?php 
    // Bar chart
    \koolreport\widgets\google\BarChart::create(array(
        "dataSource" => $this->dataStore("result"),
        "columns" => array(
            "customerName",
            "saleamount" => array(
                "prefix" => "$"
            )
        ),
        "options" => array( // Options de style pour le graphique à barres
            "chartArea" => array( // Zone du graphique
                "width" => "70%", // Largeur de la zone du graphique
                "height" => "70%" // Hauteur de la zone du graphique
            ),
            "bars" => "vertical" // Orientation des barres
        )
    ));

    ?>
    
    <?php
    // Table
    \koolreport\widgets\koolphp\Table::create(array(
        "dataSource" => $this->dataStore("result"),
        "columns" => array(
            "customerName" => array(
                "label" => "Customer Name"
            ),
            "saleamount" => array(
                "label" => "Sale Amount",
                "prefix" => "$"
            )
        )
    ));
    ?>

<div class="card-container">
        <?php 
        $cardTitles = ["Ventes totales des 10 meilleurs clients", "Moyenne des ventes par client", "Client avec la vente la plus élevée"];
        $cardValues = [
            $this->dataStore("result")->sum("saleamount"),
            $this->dataStore("result")->sum("saleamount") / count($this->dataStore("result")->toArray()),
            $this->dataStore("result")->max("saleamount", "customerName")
        ];

        for ($i = 0; $i < 3; $i++) {
            \koolreport\widgets\koolphp\Card::create(array(
                "title" => $cardTitles[$i],
                "value" => $cardValues[$i],
                "format" => array(
                    "value" => array(
                        "prefix" => "$"
                    )
                ),
                "cssStyle" => array(
                    "card" => "border-color:#999;background:pink;",
                    "value" => "color:blue",
                    "title" => "color:green",
                )
            ));
        }
        ?>
    </div>

</body>
</html>
