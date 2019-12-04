<?php

/***
 * Get the search results from the database
 * @param string $search The search term
 * @param int $category The category id
 * @param string $orderBy What to sort the items by: can be ["nameAZ", "nameZA", "priceHighLow", "priceLowHigh"]
 * @param int $page The page number
 * @param int $itemsPerPage The amount of items per page to return
 * @return array
 */
function getSearchResults($search, $category, $orderBy, $page, $itemsPerPage) {
    global $connection;
    $searchSQL = "%$search%";
    $orderSQL = getOrderBy($orderBy);
    $offset = ($page - 1) * $itemsPerPage;

    if($category == null || $category == 0) {
        $stmt = $connection->prepare("CALL get_stockitem_results(?,?,?,?)");
        if($stmt == FALSE) {
            return array(array("StockItemID"=>"1","StockItemName"=>"We're sorry, something went wrong","UnitPrice"=>"0,00","Photo"=>""));
        }
        $stmt->bind_param("siii", $searchSQL,$orderSQL, $offset, $itemsPerPage);
    } else {
        $stmt = $connection->prepare("CALL get_stockitem_results_category(?,?,?,?,?)");
        if($stmt == FALSE) {
            return array(array("StockItemID"=>"1","StockItemName"=>"We're sorry, something went wrong","UnitPrice"=>"0,00","Photo"=>""));
        }
        $stmt->bind_param("siiii", $searchSQL, $category, $orderSQL, $offset, $itemsPerPage );
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $resultArray = array();
    while($row = $result->fetch_assoc()) {
        $resultArray[] = $row;
    }
    $stmt->close();
    return $resultArray;
}

/***
 * A function to get the category name when provided with an ID
 * @param int $category The category ID
 * @return string
 */
function getCategoryName($category) {
    if($category == 0)
        return '';
    global $connection;
    $stmt = $connection->prepare("CALL get_stock_group(?)");
    $stmt->bind_param("i", $category);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_array()[0];
    $stmt->close();
    return $result;
}

/***
 * A function to get the order sql
 * @param string $orderBy The order by option
 * @return int
 */
function getOrderBy($orderBy) {
    //Order by code
    $orderSQL = "ORDER BY StockItemName";
    switch ($orderBy) {
        case 'nameAZ':
            $orderSQL = 1;
            break;
        case 'nameZA':
            $orderSQL = 2;
            break;
        case 'priceHighLow':
            $orderSQL = 4;
            break;
        case 'priceLowHigh':
            $orderSQL = 3;
            break;
    }
    return $orderSQL;
}



/***
 * @param string $search The search query
 * @param int $category The category id
 * @return int The number of results
 */
function getNumberResults($search, $category) {
    global $connection;
    $searchSQL = "%$search%";
    if($category == null || $category == 0) {
        $stmt = $connection->prepare("get_number_results(?) ");
        $stmt->bind_param("s", $searchSQL);
    } else {
        $stmt = $connection->prepare("get_number_results_category(?,?)");
        $stmt->bind_param("si", $searchSQL, $category);
    }
    $stmt->execute();
    $result = $stmt->get_result()->fetch_array()[0];
    $stmt->close();
    return $result;
}

/***
 * A function to get the GET value if it exists, else default
 * @param string $param The parameter key
 * @param string|int $default The default value
 * @return string|int The value of the parameter
 */
function getIfExists($param, $default) {
    $returnValue = ISSET($_GET[$param]) ? htmlspecialchars(strip_tags($_GET[$param])) : $default;
    if(gettype($default) == "integer" && ($returnValue < 1 || preg_match_all("/\D+/", $returnValue)))
        $returnValue = $default;
    return $returnValue;
}

/***
 * Function to print selected on a select option
 * @param string $param The parameter key to check the value with
 * @param string|int $valueToCheck The value you want to check
 */
function setSelected($param, $valueToCheck) {
    if(getIfExists($param, '') == $valueToCheck) {
        print("selected");
    }
}

/**
 * Function to change the parameter value
 * @param string $parameter The parameter to change
 * @param string $parameterValue The value the parameter should have
 * @return string The url with the changed parameter
 */
function change_url_parameter($parameter,$parameterValue) {
    $url=parse_url($_SERVER['REQUEST_URI']);
    parse_str($url["query"],$parameters);
    unset($parameters[$parameter]);
    $parameters[$parameter]=$parameterValue;
    return  $url["path"]."?".http_build_query($parameters);
}
?>
