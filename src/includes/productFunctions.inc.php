<?php
/**
 * Adds product to shopping cart
 * @param int $productId
 * @param int $amount
 */
function addToCart($productId, $amount = 1) {
    if ($amount > 0) {
        if (!isset($_SESSION['shoppingCart'])) {
            $_SESSION['shoppingCart'] = array();
        }
        if (isset($_SESSION['shoppingCart'][$productId])) {
            $_SESSION['shoppingCart'][$productId] += $amount;
        } else {
            $_SESSION['shoppingCart'][$productId] = $amount;
        }
    }
}

/**
 * Returns array with all product details for the specified product
 * @param int $id Product ID
 * @return array|null
 */
function getProductInfo($id) {
    global $connection;
    $stmt = $connection->prepare('CALL get_product_information(?)');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row;
}

/**
 * Checks if GET or POST value is an integer.
 * @param string $method
 * @param string $name
 * @return bool
 */
function checkInt($method, $name) {
    $return = false;
    if ($method === 'POST') {
        if (isset($_POST[$name]) && filter_var($_POST[$name], FILTER_VALIDATE_INT) && $_POST[$name] > 0) {
            $return = true;
        }
    } elseif ($method === 'GET') {
        if (isset($_GET[$name]) && filter_var($_GET[$name], FILTER_VALIDATE_INT) && $_GET[$name] > 0) {
            $return = true;
        }
    }
    return $return;
}