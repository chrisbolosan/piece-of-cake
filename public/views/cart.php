<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 2ec9c97 (testing)
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
        <form method="post" action="index.php?page=cart&action=place_order">
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
    $stmt = $pdo->query("SELECT CakeID, Flavor, BasePrice FROM CAKE WHERE CakeID IN ($ids)");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total = 0;

    foreach ($products as $p) {
        $id = $p['CakeID'];
        $qty = $cart[$id];
        $line = $p['BasePrice'] * $qty;
        $total += $line;

        echo '
        <form method="post" action="index.php?page=cart&action=update" style="margin-bottom:10px;">
            ' . htmlspecialchars($p['Flavor']) . ' — 
            <input type="hidden" name="product_id" value="' . $id . '">
            Qty: <input type="number" name="quantity" value="' . $qty . '" min="0" style="width:60px;">
            <button type="submit">Update</button>
            <a href="index.php?page=cart&action=remove&id=' . $id . '">Remove</a>
        </form>
        ';

    }

    echo "<br><h3>Total: $" . number_format($total, 2) . "</h3>";

    echo '
        <div style="margin-top:20px;">
            <a href="index.php?page=cart&action=checkout">
            <button style="product-details button">Proceed to Checkout</button>
            </a>
        </div>
       ';
}
<<<<<<< HEAD
<<<<<<< HEAD
=======
<h1>Your Cart</h1>

<?php if (empty($cart)): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <ul>
        <?php foreach ($cart as $id => $qty): ?>
            <li>Product ID: <?= $id ?> — Quantity: <?= $qty ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
>>>>>>> e7d664a (testing)
=======

>>>>>>> 2ec9c97 (testing)
=======
>>>>>>> 1a38dd1 (im an idiot)
