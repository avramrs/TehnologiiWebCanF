<?php

class Db
{
    var $conn = null;
    public function __construct()
    {
        $this->connect();
    }
    private function connect()
    {
        if ($this->conn === null) {
            $this->conn = new mysqli(
                'localhost',
                'root',
                '',
                'TWProject'
            );
        }
    }

    public function updateProduct($product, $uploadInfo)
    {
        $statement = $this->conn->prepare("INSERT INTO products (user_id, upload_date, cans_number, url_image, name, ingredients, packaging, quantity, serving, brand, shop, country, made_in) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->bind_param("isissssssssss", $uploadInfo["user_id"],$uploadInfo["upload_date"], $product["cans_number"], $product["url_image"], $product["name"],$product["ingredients"],$product["packaging"], $product["quantity"],$product["serving"],$product["brand"],$product["shop"],$product["country"],$product["made_in"]);
        $statement->execute();
    }

    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}
?>
