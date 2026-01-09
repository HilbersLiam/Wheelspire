<?php
class Orders extends Dbh
{

    public function createOrder($userid, $order_total, $total_products)
    {
        $query = "INSERT INTO orders (userid, ordertotal, total_products)
                  VALUES(:userid, :ordertotal, :total_products);";
        $pdo = $this->connect();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":userid", $userid);
        $stmt->bindParam(":ordertotal", $order_total);
        $stmt->bindParam(":total_products", $total_products);
        if ($stmt->execute()) {
            $orderid = $pdo->lastInsertId();
            return $orderid;
        }
    }

    public function addOrderItems($orderid, $productid, $quantity, $product_option)
    {
        $query = "INSERT INTO order_items (orderid, productid, quantity, product_option)
                  VALUES(:orderid, :productid, :quantity, :product_option);";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":orderid", $orderid);
        $stmt->bindParam(":productid", $productid);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":product_option", $product_option);
        $stmt->execute();
    }

    public function getOrders($userid)
    {
        // Join the orders table, order items table and products table by userid to retrieve all the information about the users orders.
        $query = "SELECT o.orderid, o.ordertotal, o.orderdate, o.total_products, o.status, oi.productid, oi.quantity, oi.product_option, p.name, p.description, p.price, p.image_url
                FROM orders o  
                INNER JOIN order_items oi ON o.orderid = oi.orderid
                INNER JOIN products p ON oi.productid = p.productid
                WHERE o.userid=:userid
                ORDER BY o.orderid DESC";

        // Fetch all information.
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":userid", $userid);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Create a orders array.
        $orders = [];
        // Loop through each result from the query
        foreach ($rows as $row) {
            // Get the orderid from the query.
            $orderid = $row['orderid'];

            // Check if order_info has been created yet for the current orderid.
            // If not then create a order_info array with the ordertotal and date.
            if (!isset($orders[$orderid]['order_info'])) {
                $orders[$orderid]['order_info'] = [
                    'ordertotal' => $row['ordertotal'],
                    'orderdate' => $row['orderdate'],
                    'total_products' => $row['total_products'],
                    'order_status' => $row['status'],
                    'items' => []  // initialize items as empty array
                ];
            }
            // Make an array to map each orderid to the items in the order.
            // And fill the array with the current rows data.
            $orders[$orderid]['order_info']['items'][] = [
                'name' => $row['name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'quantity' => $row['quantity'],
                'product_option' => $row['product_option'],
                'image_url' => $row['image_url'],
            ];
        }
        return $orders;
    }
}
