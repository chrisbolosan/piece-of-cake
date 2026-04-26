<html>
<div class="product-container">

    <div class="product-image">
        <img src="<?=htmlspecialchars($cake['Img'])?>" alt="<?=htmlspecialchars($cake['Flavor'])?>">
    </div>

    <div class="product-details">
        <h2><?=htmlspecialchars($cake['Flavor'])?> Cake</h2>
        <p><strong>Size:</strong> <?=htmlspecialchars($cake['Size'])?></p>

        <h3>$<?=number_format((float)$cake['BasePrice'],2)?></h3>

        <form method="post">
            <label>Notes:</label><br>
            <textarea name="notes" rows="5" cols="40" placeholder="Enter any cake notes here..."></textarea><br><br>

            <button type="submit">Add to Cart</button>
        </form>
    </div>

</div>
</html>