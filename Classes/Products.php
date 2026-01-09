<?php

class Products extends Dbh
{
    private $products = [];

    // Function to get the products
    public function get_products()
    {
        $query = "SELECT * FROM products";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();

        $this->products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->products;
    }
    // Function to display the products based on the category
    public function display_products($category)
    {
        $products = $this->get_products();
        foreach ($products as $product) {
            if ($product["category"] === $category) {
?>
                <div class="products-container">
                    <img class="product-img" src="/<?= htmlspecialchars($product["image_url"]) ?>" alt="<?= htmlspecialchars($product["name"]) ?>" />
                    <div class="text-container">
                        <span class="product-name"><?php echo $product["name"] ?><span class="product-price"><?php echo '$' . $product["price"] . ' ' . 'CAD' ?></span></span>
                        <span class="product-description"><?php echo $product["description"] ?></span>
                        <span class="product-description">
                            <img src="/Assets/Product-Images/rating-star-filled.svg" alt="rating star filled" />
                            <img src="/Assets/Product-Images/rating-star-filled.svg" alt="rating star filled" />
                            <img src="/Assets/Product-Images/rating-star-filled.svg" alt="rating star filled" />
                            <img src="/Assets/Product-Images/rating-star-notfilled.svg" alt="rating star filled" />
                            <img src="/Assets/Product-Images/rating-star-notfilled.svg" alt="rating star filled" />
                        </span>
                    </div>
                    <div class="cart-form">
                        <form method="post" action="/includes/cart.inc.php">
                            <p class="product-subtitle">Options</p>

                            <input type="hidden" name="productid" value="<?= $product["productid"] ?>">
                            <input type="hidden" name="category" value="<?= $product["category"] ?>">

                            <input type="radio" id="<?php echo "blue" . htmlspecialchars($product["name"]) ?>" name="color" value="Blue" checked>
                            <label for="<?php echo "blue" . htmlspecialchars($product["name"]) ?>" class="blue-radio">Blue</label>

                            <input type="radio" id="<?php echo "red" . htmlspecialchars($product["name"]) ?>" name="color" value="Red">
                            <label for="<?php echo "red" . htmlspecialchars($product["name"]) ?>" class="red-radio">Red</label>
                            <br></br>
                            <p class="product-subtitle">Quantity</p>
                            <input type="number" name="quantity" value="1" min="1">
                            <br><br>
                            <button type="submit" class="add-to-cart">
                                Add To Cart
                            </button>
                        </form>
                    </div>
                </div>
<?php
            } else {
                continue;
            }
        }
    }
}
