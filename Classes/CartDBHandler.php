<?php

class CartDBHandler extends Dbh
{
    private $productid;
    private $userid;
    private $quantity;
    private $product_option;
    private $cartResults = [];

    // Function to add an item into the cart database.
    public function insertCart($productid, $userid, $quantity, $product_option)
    {
        $this->productid = $productid;
        $this->userid = $userid;
        $this->quantity = $quantity;
        $this->product_option = $product_option;

        $query = "INSERT INTO cart(productid, userid, quantity, product_option) 
                VALUES(:productid, :userid, :quantity, :product_option);";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":productid", $this->productid);
        $stmt->bindParam(":userid", $this->userid);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":product_option", $this->product_option);
        $stmt->execute();
    }
        // Function to get the cart by userid
    public function getCart($userid)
    {
        $query = "SELECT cart.quantity, cart.product_option, products.productid, products.price, products.name, products.price, products.image_url
                FROM cart 
                INNER JOIN products ON cart.productid=products.productid;
                WHERE userid=:userid";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":userid", $userid);
        $stmt->execute();
        $this->cartResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->cartResults;
    }

    // Function to clear the cart
    public function clearEntireCart($userid)
    {
        $query = "DELETE FROM cart WHERE userid = :userid;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":userid", $userid);
        $stmt->execute();
    }


    public function countCart()
    {
        return $count = count($this->cartResults);
    }

    public function isCartEmpty($userid)
    {
        return empty($this->getCart($userid));
    }

    public function cartTotal($userid)
    {
        $this->getCart($userid);
        $subtotal = 0;
        foreach ($this->cartResults as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        return $subtotal;
    }
}
