<?php

$action = $_GET['action'] ?? 'view';

// Different Actions that can be taken with their multiple functions 
switch ($action) {

    case 'add':
        add_to_cart();
        break;

    case 'remove':
        remove_from_cart();
        break;

    case 'update':
        update_cart();
        break;

    case 'checkout':
        show_checkout();
        break;

    case 'place_order':
        place_order();
        break;

    default:
        show_cart();
        break;
}

// Adds the products to cart in the specified quantities
function add_to_cart() {
    $id = intval($_POST['product_id']);
    $qty = intval($_POST['quantity']);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] += $qty;
    } else {
        $_SESSION['cart'][$id] = $qty;
    }

    header("Location: cart.php");
    exit;
}

// Removes the items from cart 
function remove_from_cart() {
    $id = intval($_GET['id']);
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit;
}

// Updates the cart 
function update_cart() {
    $id = intval($_POST['product_id']);
    $qty = intval($_POST['quantity']);

    if ($qty <= 0) {
        unset($_SESSION['cart'][$id]);
    } else {
        $_SESSION['cart'][$id] = $qty;
    }

    header("Location: cart.php");
    exit; 
}

// Displays Checkout
function show_checkout() {
    echo '
        <form method="post" action="cart.php?action=place_order">
            <input name="address" placeholder="Shipping Address">
            <input name="billing" placeholder="Billing Info (fake)">
            <button type="submit">Place Order</button>
        </form>
    ';
}

// Places the Order
function place_order() {
    global $pdo;

    $cart = $_SESSION['cart'] ?? [];
    if (empty($cart)) return;

    $address = $_POST['address'];
    $billing = $_POST['billing'];

    $ids = implode(',', array_keys($cart));
    $stmt = $pdo->query("SELECT id, price FROM Products WHERE id IN ($ids)");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total = 0;
    foreach ($products as $p) {
        $total += $p['price'] * $cart[$p['id']];
    }

    $stmt = $pdo->prepare("INSERT INTO Orders (customer_id, total, status, ship_address) VALUES (1, ?, 'Processing', ?)");
    $stmt->execute([$total, $address]);
    $order_id = $pdo->lastInsertId();

    foreach ($cart as $id => $qty) {
        $stmt = $pdo->prepare("INSERT INTO OrderItems (order_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$order_id, $id, $qty]);
    }

    $_SESSION['cart'] = [];

    echo "Order placed!";
}

// Displays the cart 
function show_cart() {
    global $pdo;

    $cart = $_SESSION['cart'] ?? [];

    if (empty($cart)) {
        echo "Your cart is empty.";
        return;
    }

    $ids = implode(',', array_keys($cart));
    $stmt = $pdo->query("SELECT id, name, price FROM Products WHERE id IN ($ids)");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total = 0;

    foreach ($products as $p) {
        $id = $p['id'];
        $qty = $cart[$id];
        $line = $p['price'] * $qty;
        $total += $line;

        echo $p['name'] . " — Qty: $qty — $" . number_format($line, 2);
    }

    echo "<br>Total: $" . number_format($total, 2);
}
