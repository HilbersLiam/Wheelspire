<?php
class Admin extends Dbh
{
    public $totals = [];

    public function getRecentOrders()
    {
        // Join the orders table and users table by userid to retrieve all the information about the users orders.
        $query = "SELECT o.orderid, o.ordertotal, o.orderdate, o.status, u.first_name, u.last_name
                FROM orders o  
                INNER JOIN users u ON o.userid = u.userid
                ORDER BY o.orderid DESC";

        // Fetch all information.
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTotals()
    {
        $this->totals['totalsales'] = 0;
        $query = "SELECT * FROM orders";

        // Fetch all information.
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $orderRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->totals['totalorders'] = count($orderRows);

        foreach ($orderRows as $row) {
            $this->totals['totalsales'] += $row['ordertotal'];
        }

        $query = "SELECT * FROM users";

        // Fetch all information.
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $userRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->totals['totalusers'] = count($userRows);
        return $this->totals;
    }
    public function getAllUsers()
    {
        $query = "SELECT * FROM users";

        // Fetch all information.
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllProducts()
    {
        $query = "SELECT * FROM products";

        // Fetch all information.
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProduct($productid)
    {
        $query = "SELECT * FROM products WHERE productid = :productid";

        // Fetch all information.
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":productid", $productid);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function editProduct($column_name, $data, $productid)
    {
        $query = "UPDATE products SET $column_name = :data WHERE productid = :productid";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":data", $data);
        $stmt->bindParam(":productid", $productid);
        $stmt->execute();
    }
}