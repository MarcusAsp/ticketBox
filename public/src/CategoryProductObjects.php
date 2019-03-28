<?php 
    class CategoryProducts {

        private $conn;
        public function __construct(){
            $this->conn = new Dbh();
            $this->conn = $this->conn->connect();
        }

        private function getProducts($nrRows){
            $this->conn = $this->conn->prepare("SELECT  * FROM products LIMIT $nrRows");
            $this->conn->execute();
            return $this->conn;
        }

        public function printProducts($nrRows = 25){
            if(isset($_GET['products'])){
                $nrRows = $_GET['products'];
                $stmt = $this->getProducts($nrRows);
                $nrRows += 25;
            }else{
                $nrRows = 50;
                $stmt = $this->getProducts($nrRows);
            }
            
                    while ($row = $stmt->fetch()){
            
            ?>
                <a class="product-card" href="products.php?product=<?php echo $row['productName'];?>">
                    <section name="<?php echo $row['productName']; ?>">
                        <img src="<?php ?>https://picsum.photos/300/300" alt="product-<?php echo $row['productCode'];?>">
                        <section>
                            <h2><?php echo $row['productName'];?></h2> <!-- Product name -->
                            <p class="shortDescription"><?php echo $row['productDescription'];?></p> <!-- Small description -->
                            <p>Price: $<?php echo $row['buyPrice'];?></p>
                            <p class="card-readmore">Read more</p>
                        </section>
                    </section>
                </a>
                <?php 
                }
                return $nrRows;
        }

    }
