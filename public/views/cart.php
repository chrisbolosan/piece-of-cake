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
    global $pdo;

    $id = intval($_POST['product_id']);
    $qty = intval($_POST['quantity']);

    // Get stock from database
    $stmt = $pdo->prepare("SELECT NumInStock FROM CAKE WHERE CakeID = ?");
    $stmt->execute([$id]); 
    $stock = $stmt->fetchColumn();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Current quantity already in cart
    $current = $_SESSION['cart'][$id] ?? 0;

    // New desired quantity
    $newQty = $current + $qty; 
    
    // Enforce stock limit
    if ($newQty > $stock) {
        $newQty = $stock;
    }

    $_SESSION['cart'][$id] = $newQty;

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
    global $pdo;

    $id = intval($_POST['product_id']);
    $qty = intval($_POST['quantity']);

    $stmt = $pdo->prepare("SELECT NumInStock FROM CAKE WHERE CakeID = ?");
    $stmt->execute([$id]);
    $stock = $stmt->fetchColumn();

    if ($qty <= 0) {
        unset($_SESSION['cart'][$id]);
    } else {
        if ($qty > $stock) {
            $qty = $stock;
        }
        $_SESSION['cart'][$id] = $qty;
    }

    header("Location: index.php?page=cart");
    exit; 
}

// Displays Checkout
function show_checkout() {
    echo '
        <div class="card" style="max-width:600px; margin:40px auto; text-align:center;">
            <h2>Checkout</h2>

            <form method="post" action="index.php?page=cart&action=place_order">

                <h3>Shipping Address</h3>

                <input name="street" placeholder="Street Address" required
                       style="width:90%; padding:10px; margin:10px;"><br>

                <input name="apt" placeholder="Apt / Unit (optional)"
                       style="width:90%; padding:10px; margin:10px;"><br>

                <input name="city" placeholder="City" required
                       style="width:90%; padding:10px; margin:10px;"><br>

                <input name="state" placeholder="State" required
                       style="width:90%; padding:10px; margin:10px;"><br>

                <input name="zip" placeholder="ZIP Code" required
                       style="width:90%; padding:10px; margin:10px;"><br>

                <h3>Billing Info</h3>

                <input name="billing_name" placeholder="Cardholder Name" required
                       style="width:90%; padding:10px; margin:10px;"><br>

                <input name="billing_last4" placeholder="Last 4 Digits" maxlength="4" required
                       style="width:90%; padding:10px; margin:10px;"><br>

                <button type="submit" class="main-button">Place Order</button>
            </form>
        </div>
    ';
}


// Places the Order
function place_order() {
    global $pdo;

    if (empty($_SESSION['cart'])) return;

    $cart = $_SESSION['cart'];

    // Collects form data
    $cust_name  = trim($_POST['cust_name']);
    $cust_email = trim($_POST['cust_email']);
    $cust_phone = trim($_POST['cust_phone']);

    $street = trim($_POST['street']);
    $apt    = trim($_POST['apt']);
    $city   = trim($_POST['city']);
    $state  = trim($_POST['state']);
    $zip    = trim($_POST['zip']);

    $billing_name  = trim($_POST['billing_name']);
    $billing_last4 = trim($_POST['billing_last4']);

    // Inserts into DESTINATION
    $stmt = $pdo->prepare("
        INSERT INTO DESTINATION (StreetAddress, AptNumber, ZIP, City, State)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([$street, $apt, $zip, $city, $state]);
    $address_id = $pdo->lastInsertId();

    // Calculates total
    $ids = array_keys($cart);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $stmt = $pdo->prepare("SELECT CakeID, BasePrice FROM CAKE WHERE CakeID IN ($placeholders)");
    $stmt->execute($ids);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total = 0;
    foreach ($products as $p) {
        $total += $p['BasePrice'] * $cart[$p['CakeID']];
    }

    // Inserts into CUSTOMER
    $stmt = $pdo->prepare("
    INSERT INTO CUSTOMER (Name, Email, PhoneNum)
    VALUES (?, ?, ?)
    ");
    $stmt->execute([$cust_name, $cust_email, $cust_phone]);
    $customer_id = $pdo->lastInsertId();


    // Inserts into PAYMENT
    $stmt = $pdo->prepare("
        INSERT INTO PAYMENT (Method, Amount, PaymentStatus, CardholderName, CardLastFour)
        VALUES ('Card', ?, 'Processing', ?, ?)
    ");
    $stmt->execute([$total, $billing_name, $billing_last4]);
    $payment_id = $pdo->lastInsertId();


    // Inserts into ORDERS
   $stmt = $pdo->prepare("
    INSERT INTO ORDERS (CustomerID, PaymentID, AddressID, Notes)
    VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([$customer_id, $payment_id, $address_id, "Order placed"]);
    
    // Capture Order ID
    $order_id = $pdo->lastInsertId();

    // Inserts ORDER_ITEM rows
    $stmt = $pdo->prepare("
        INSERT INTO ORDER_ITEM (OrderID, CakeID, Quantity)
        VALUES (?, ?, ?)
        UPDATE CAKE SET NumInStock = NumInStock - ?
    ");

    foreach ($cart as $cake_id => $qty) {
        $stmt->execute([$order_id, $cake_id, $qty]);
    }

    // Clears cart
    $_SESSION['cart'] = [];

    
    // Confirmation message
    echo '
        <div class="card" style="max-width:500px; margin:50px auto; text-align:center;">
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
                <strong>Qty:</strong> <input type="number" name="quantity" value="' . $qty . '" min="0" style="width:60px; padding:5px;">
                
                <button type="submit" class="main-button">Update</button>

                <a href="index.php?page=cart&action=remove&id=' . $id . '" 
                style="color:#cc3366; font-weight:bold; text-decoration:none;">Remove</a>
            </form>
        </div>        ';

    }

    echo '<h3 style="text-align:center; color:#1e2366;">Total: $' . number_format($total, 2) . '</h3>';

    echo '
        <div style="text-align:center; margin-top:20px;">
            <a href="index.php?page=billing" class="main-button;">Proceed to Checkout</a>
        </div>
      ';
}
?>
