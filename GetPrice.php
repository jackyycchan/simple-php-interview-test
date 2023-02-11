<?php
require_once("Manager.php");

$q = $_REQUEST["q"];

if (is_string($q)) {
    // call api
    try {
        $manager = new Manager();
    } catch (Exception $e) {
        echo $e;
        exit();
    }

    $quote = $manager->exec($q);

    // return to client
    echo "<table>";
    echo "<tr><td>Symbol: <td><td>" . $quote->getSymbol(). "</td></tr>";
    echo "<tr><td>High: <td><td>" . $quote->getHigh(). "</td></tr>";
    echo "<tr><td>Low: <td><td>" . $quote->getLow(). "</td></tr>";
    echo "<tr><td>Price: <td><td>" . $quote->getPrice(). "</td></tr>";
    echo "</table>";
}
?>

