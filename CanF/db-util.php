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
    public function updateProductByID($productInfo){
        $statement = $this->conn->prepare("UPDATE products SET upload_date=?, cans_number=?, url_image=?, name=?, ingredients=?, packaging=?, quantity=?, serving=?, brand=?, shop=?, country=?, made_in=?  WHERE product_id=?");
        $statement->bind_param("sissssssssssi", $productInfo["upload_date"], $productInfo["cans_number"], $productInfo["url_image"], $productInfo["name"],$productInfo["ingredients"],$productInfo["packaging"], $productInfo["quantity"],$productInfo["serving"],$productInfo["brand"],$productInfo["shop"],$productInfo["country"],$productInfo["made_in"],$productInfo["product_id"]);
        $statement->execute();
    }
    public function getProduct($id){
        $result = $this->conn->query("SELECT * FROM products WHERE product_id=".$id);
        return $result->fetch_row();
    }

    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}
?>
