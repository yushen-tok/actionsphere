<?php
session_start();
$username = $_SESSION['cust_username'];
$_SESSION['cust_username'] = $username;
// Check if the file is accessed through a valid flow
if (!isset($_SERVER['HTTP_REFERER']) || (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'book.php') === false)) {
    // Invalid access attempt
    header('HTTP/1.0 403 Forbidden');

    echo '<script> window.alert("Access denied. Direct access is not allowed.");
    window.location.href = "index.php" </script>;';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ActionSphere Food & Beverage</title>

    <style>
        body {
            background-image: url("../styles/images/bg.png");
            background-size: cover;
            background-position: center;
            font-family: "Noto Sans", sans-serif;
            margin: 20px;

        }

        .container {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            /* Adjusted grid-template-columns */
            gap: 5px;
            /* Adjusted gap */
            max-width: 800px;
            /* Set a maximum width for the container */
            margin: 0 auto;
        }

        /* Rest of your CSS as before */


        .item {
            border: 1px solid #ccc;
            padding: 20px;
            width: 200px;
            text-align: center;
        }

        .item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .item:hover {
            background-color: #f0f0f0;
        }

        .checkout {
            margin-top: 20px;
            text-align: center;
        }

        .checkout button {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <a href="book.php" class="back-button">&lt; Back</a>
    <h1>Food & Beverage</h1>
    <div class="container">
        <div class="item">
            <img src="images/comboA.png" alt="comboA">
            <h2>Combo A</h2>
            <p>RM 10.00</p>
            <div class="quantity">
                <button onclick="decrementQuantity('comboA')">-</button>
                <span id="comboAQuantity">0</span>
                <button onclick="incrementQuantity('comboA')">+</button>
            </div>
        </div>
        <div class="item">
            <img src="images/comboB.png" alt="comboB">
            <h2>Combo B</h2>
            <p>RM 12.00</p>
            <div class="quantity">
                <button onclick="decrementQuantity('comboB')">-</button>
                <span id="comboBQuantity">0</span>
                <button onclick="incrementQuantity('comboB')">+</button>
            </div>
        </div>
        <div class="item">
            <img src="images/comboC.png" alt="comboC">
            <h2>Combo C</h2>
            <p>RM 15.00</p>
            <div class="quantity">
                <button onclick="decrementQuantity('comboC')">-</button>
                <span id="comboCQuantity">0</span>
                <button onclick="incrementQuantity('comboC')">+</button>
            </div>
        </div>
        <div class="item">
            <img src="images/ala1.png" alt="ala1">
            <h2>HotDog</h2>
            <p>RM 8.00</p>
            <div class="quantity">
                <button onclick="decrementQuantity('ala1')">-</button>
                <span id="ala1Quantity">0</span>
                <button onclick="incrementQuantity('ala1')">+</button>
            </div>
        </div>
        <div class="item">
            <img src="images/ala2.png" alt="ala2">
            <h2>Popcorn Chickens</h2>
            <p>RM 9.00</p>
            <div class="quantity">
                <button onclick="decrementQuantity('ala2')">-</button>
                <span id="ala2Quantity">0</span>
                <button onclick="incrementQuantity('ala2')">+</button>
            </div>
        </div>
        <div class="item">
            <img src="images/ala3.png" alt="ala3">
            <h2>Fresh Nuggets</h2>
            <p>RM 6.00</p>
            <div class="quantity">
                <button onclick="decrementQuantity('ala3')">-</button>
                <span id="ala3Quantity">0</span>
                <button onclick="incrementQuantity('ala3')">+</button>
            </div>
        </div>
    </div>

    <!-- OYZ modified 4th Oct-->
    <div class="checkout">
        <form method="post" action="payment.php">
            <input type="hidden" name="totalfoodandbeverage" id="totalfoodandbeverage">

            <!-- Move the JavaScript code to calculate total cost here -->
            <script>
                var quantities = {
                    comboA: 0,
                    comboB: 0,
                    comboC: 0,
                    ala1: 0,
                    ala2: 0,
                    ala3: 0
                };

                function incrementQuantity(item) {
                    quantities[item]++;
                    document.getElementById(item + 'Quantity').innerText = quantities[item];
                    updateTotal();
                }

                function decrementQuantity(item) {
                    if (quantities[item] > 0) {
                        quantities[item]--;
                        document.getElementById(item + 'Quantity').innerText = quantities[item];
                        updateTotal();
                    }
                }

                function updateTotal() {
                    var totalcomboA = quantities.comboA * 10;
                    var totalcomboB = quantities.comboB * 12;
                    var totalcomboC = quantities.comboC * 15;
                    var totalala1 = quantities.ala1 * 8;
                    var totalala2 = quantities.ala2 * 9;
                    var totalala3 = quantities.ala3 * 6;

                    var totalfoodandbeverage = totalcomboA + totalcomboB + totalcomboC + totalala1 + totalala2 + totalala3;
                    document.getElementById("totalfoodandbeverage").value = totalfoodandbeverage;
                    sessionStorage.setItem('totalfoodandbeverage', totalfoodandbeverage);
                    tot_price.innerText = totalfoodandbeverage;
                }
            </script>
            <!-- End of JavaScript code -->

            <h2>Total Price: RM <span id="tot_price"> <?php echo '0'?> </span></h2>
            <button type="submit">Proceed to Payment</button>
        </form>
    </div>
    <!-- OYZ modified 4th Oct-->

</body>

</html>