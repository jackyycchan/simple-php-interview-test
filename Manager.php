<?php
require_once("Quote.php");

class Manager {
    const API          = 'https://www.alphavantage.co/query';
    const API_KEY      = "0244";
    const API_FUNCTION = "GLOBAL_QUOTE";
    const DB_USER      = "test";
    const DB_PWD       = "test1234";
    const DB_SERVER    = "localhost";
    const DB_NAME      = "stock";

    const RESPONSE_KEY = "Global Quote";

    const RESPONSE_KEY_SYMBOL = "01. symbol";
    const RESPONSE_KEY_HIGH   = "03. high";
    const RESPONSE_KEY_LOW    = "04. low";
    const RESPONSE_KEY_PRICE  = "05. price";

    private $conn;

    public function __construct() {
        // Create connection
        $conn = new mysqli(self::DB_SERVER, self::DB_USER,
            self::DB_PWD, self::DB_NAME);

        // Check connection
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . mysqli_connect_error());
        } else {
            $this->conn = $conn;
        }
    }

    public function exec($q) {
        $result_str = $this->callApi($q);

        // store to database
        $result_arr = json_decode($result_str, true);
        $response = $result_arr[self::RESPONSE_KEY];

        $quote = new Quote();
        $quote->setHigh($response[self::RESPONSE_KEY_HIGH]);
        $quote->setSymbol($response[self::RESPONSE_KEY_SYMBOL]);
        $quote->setLow($response[self::RESPONSE_KEY_LOW]);
        $quote->setPrice($response[self::RESPONSE_KEY_PRICE]);

        // insert to database
        $this->insert($quote);

        return $quote;

    }

    private function callApi($q) {
        $curl = curl_init();

        $query = array("function" => self::API_FUNCTION,
            "symbol" => $q,
            "apikey" => self::API_KEY);
        $url = sprintf("%s?%s", self::API, http_build_query($query));

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    private function insert($quote) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO quote (symbol, high, low, price) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sddd", $symbol, $high, $low, $price);

            $symbol = $quote->getSymbol();
            $high = $quote->getHigh();
            $low = $quote->getLow();
            $price = $quote->getPrice();
            $stmt->execute();
            $stmt->close();
        } catch (Exception $e) {
            // handle exxception
        }
    }
}
