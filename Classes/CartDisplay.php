<?php

class CartDisplay extends CartDBHandler
{
    public function renderCart($userid)
    {
        // Function to render the cart by the userid with all the data
        $cart_items = $this->getCart($userid);
        foreach ($cart_items as $cart_item) { ?>
            <div class="cart-items">
                <img class="cart-images" src="<?php echo htmlspecialchars($cart_item["image_url"]) ?>" alt="<?php echo htmlspecialchars($cart_item["name"]) ?>" />
                <div class="cart-text">
                    <span style><?php echo htmlspecialchars($cart_item["name"]) ?></span>
                    <span style="color: var(--text-lighter-color); font-size: 14px;">Color: <?php echo htmlspecialchars($cart_item["option"]) ?></span>
                    <span style="padding-top: 20px;"><?php echo "$" . htmlspecialchars($cart_item["price"]) ?></span>
                </div>
                <div class="quantity-container">
                    <span style="padding:10px; color:var(--text-color);"><?php echo htmlspecialchars($cart_item["quantity"]) ?></span>
                </div>
            </div>
            <hr style="color: var(--color-accent-blue);">


<?php
        }
    }
}
