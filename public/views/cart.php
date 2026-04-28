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

    header("Location: index.php?page=cart");
    exit;
}

// Removes the items from cart 
function remove_from_cart() {
    $id = intval($_GET['id']);
    unset($_SESSION['cart'][$id]);
    header("Location: index.php?page=cart");
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

    header("Location: index.php?page=cart");
    exit; 
}

// Displays Checkout
function show_checkout() {
    echo '
        <div class="card" style="max-width:500px; margin:40px auto; text-align:center;">
            <h2>Checkout</h2>

            <form method="post" action="index.php?page=cart&action=place_order">
                <input name="address" placeholder="Shipping Address" style="width:90%; padding:10px; margin:10px;"><br>
                <input name="billing" placeholder="Billing Info (fake)" style="width:90%; padding:10px; margin:10px;"><br>
                <button type="submit" class="main-button">Place Order</button>
            </form>
        </div>
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
    $stmt = $pdo->query("SELECT CakeID, BasePrice FROM CAKE WHERE CakeID IN ($ids)");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    $total = 0;
    foreach ($products as $p) {
        $total += $p['BasePrice'] * $cart[$p['CakeID']];
    }

    
    $stmt = $pdo->prepare("INSERT INTO ORDERS (CustomerID, PaymentID, AddressID, Notes) VALUES (1, 1, 1, ?)");
    $stmt->execute([$address]);
    $order_id = $pdo->lastInsertId();

    
    foreach ($cart as $id => $qty) {
        $stmt = $pdo->prepare("INSERT INTO ORDER_ITEM (OrderID, CakeID, Quantity) VALUES (?, ?, ?)");
        $stmt->execute([$order_id, $id, $qty]);
    }

    $_SESSION['cart'] = [];

    echo '
        <div class="card" style=max-width:500px; margin:50px auto; text-align:center;">
        <h2 style="color:#1e2366;">Thank You For Your Order!</h2>
        <p>Your cakes are now being prepared.</p>
        <a href="index.php">
            <button class="main-button">Return Home</button>
        </a>
    </div>
';
}

// Displays the cart 
function show_cart() {
    global $pdo;

    $cart = $_SESSION['cart'] ?? [];

    echo '<h2 style="text-align:center; color:#1e2366;">Your Shopping Cart</h2>';

    if (empty($cart)) {
        echo "<p style='text-align:center;'>Your cart is empty.</p>";
        return;
    }


    $ids = implode(',', array_keys($cart));
    $stmt = $pdo->query("SELECT CakeID, Flavor, BasePrice FROM CAKE WHERE CakeID IN ($ids)");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total = 0;

    foreach ($products as $p) {
        $id = $p['CakeID'];
        $qty = $cart[$id];
        $line = $p['BasePrice'] * $qty;
        $total += $line;

        echo '
<div class="card" style="max-width:700px; margin:20px auto; display:flex; justify-content:space-between; align-items:center;">
            
    <div>
        <h3 style="margin:0;">' . htmlspecialchars($p['Flavor']) . '</h3>
        <p style="margin:5px 0;">$' . number_format($p['BasePrice'],2) . ' each</p>
        <p style="margin:5px 0;">Subtotal: $' . number_format($line,2) . '</p>
    </div>

            <form method="post" action="index.php?page=cart&action=update" style="display:flex; align-items:center; gap:10px;">
                <input type="hidden" name="product_id" value="' . $id . '">
                <strong>Qty:</strong? <input type="number" name="quantity" value="' . $qty . '" min="0" style="width:60px; padding:5px;">
                
                <button type="submit" class="main-button">Update</button>

                <a href="index.php?page=cart&action=remove&id=' . $id . '" 
                style="color:#cc3366; font-weight:bold; text-decoration:none;">Remove</a>
            </form>
        </div>        ';

    }

    echo '<h3 style="text-align:center; color:#1e2366;">Total: $' . number_format($total, 2) . '</h3>';

    echo '
        <div style="text-align:center; margin-top:20px;">
            <a href="index.php?page=billing">
            <button class="main-button">Proceed to Checkout</button>
            </a>
        </div>
       ';
}
