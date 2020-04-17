<?php include('dbConnectionInfo.php'); ?>

<?php
	//set up connection and connect
	$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
	if (mysqli_connect_errno()) die("Unable to connect to MySQL: " . mysqli_connect_error());
    $products = array();
    $sql = "SELECT ProductID, PName FROM PRODUCT";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row1 = mysqli_fetch_array($result)){
                $products[$row1['ProductID']] = $row1['PName'];
            }
            mysqli_free_result($result);
        } else{
            echo "No records matching your query were found.";
        }
    } else{
        echo "ERROR: Could not execute $sql. " . mysqli_error($link);
    }
    $price = array();
    $sql = "SELECT ProductID, Price FROM PRODUCT";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row2 = mysqli_fetch_array($result)){
                $price[$row2['ProductID']] = (int)$row2['Price'];
            }
            mysqli_free_result($result);
        } else{
            echo "No records matching your query were found.";
        }
    } else{
        echo "ERROR: Could not execute $sql. " . mysqli_error($link);
    }

    $cart["items"] = array();
?>

<!doctype html>
<html lang="en">
<head>  
<title>Products</title>
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="icon" href="https://bottlenose.imgix.net/ginovino/_yV3GJtsg0">

<style>
#grid {
    display: grid;
    grid-template-rows: repeat(3, 1fr);
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 10px;
}
#grid > div {
    background-color: white;
    color: black;
    font-size: 2vw;
    font-style: italic;
    padding: 10px;
    width:380px; 
    max-width:380px; 
    max-height: 400px;
}

</style>
</head>

<body>
    <!--Javascript cart-->
    

    <script>
        var cart = <?php echo json_encode($cart); ?>;
        var products = <?php echo json_encode($products); ?>;
        var price = <?php echo json_encode($price); ?>;
        // var myData = [cart,products,price];
    </script>

    <script src="shoppingCart.js"></script>
    
    <div class="topnav">
        <a class="active" href="http://localhost:8080/Lab10/index.html">Home</a>
        <a href="http://localhost:8080/Lab10/products.php">Products</a>
        <a href="http://localhost:8080/Lab10/contact.html">Contact</a>
        <button onclick="viewCart()">View Cart</button>
        <button onclick="emptyCart()">Empty Cart</button>
    </div>

    <div id="grid">
            
        <?php    
            // Attempt select query execution
            $sql = "SELECT ProductID, PName, PDescription, Price, PhotoSrc FROM PRODUCT";
            if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){

                    while($row = mysqli_fetch_array($result)){
                        echo "<div>";
                            echo $row['PName'] . "<br>";
                            echo "<button onclick='addToCart(". $row['ProductID'].")'>Add To Cart</button> ";
                            echo "<img src='" . $row["PhotoSrc"] . "'  alt='Pic' width='200' height='200'>";
                        echo "</div>";
                    }

                mysqli_free_result($result);
                } else{
                    echo "No records matching your query were found.";
                }
            } else{
                echo "ERROR: Could not execute $sql. " . mysqli_error($link);
            }
            mysqli_close($link);
        ?>
           
            <div>
                <a href="shoppingCart.html" id="checkout">Checkout</a>
            </div>
            <!--Build the table using javascript-->
            <div id="tabl">

            </div>
    </div>
    <script>
        document.getElementById('checkout').onclick = function () {
            localStorage.setItem('carty', JSON.stringify(cart));
            localStorage.setItem("producty", JSON.stringify(products));
            localStorage.setItem("pricy", JSON.stringify(price));
        }; 
    </script>
        
</body>

</html>