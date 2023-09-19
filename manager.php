<?php
require_once 'settings.php';
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

// Function to update the status of an order
function updateOrderStatus($orderID, $order_status)
{
    global $conn;
    $order_status = mysqli_real_escape_string($conn, $order_status);
    $updateQuery = "UPDATE orders SET order_status = '$order_status' WHERE order_id = $orderID";
    $result = mysqli_query($conn, $updateQuery);

    if (!$result) {
        // Error occurred while updating the order status
        die("Failed to update order status: " . mysqli_error($conn));
    }
}

// Function to delete a pending order
function deleteOrder($orderID)
{
    global $conn;
    $deleteQuery = "DELETE FROM orders WHERE order_id = $orderID";
    $result = mysqli_query($conn, $deleteQuery);

    if (!$result) {
        // Error occurred while deleting the order
        die("Failed to delete order: " . mysqli_error($conn));
    }
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_status']) && isset($_POST['order_id']) && isset($_POST['status'])) {
        $orderID = $_POST['order_id'];
        $order_status = $_POST['status'];
        updateOrderStatus($orderID, $order_status);
    } elseif (isset($_POST['cancel_order']) && isset($_POST['order_id'])) {
        $orderID = $_POST['order_id'];
        deleteOrder($orderID);
    }
}

// Retrieve the orders based on the selected query
$selectQuery = "SELECT order_id, order_time, firstname, lastname, movie, date, time, seats, opt, total, comment, order_status FROM orders";

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    switch ($query) {
        case 'customer':
            if (isset($_GET['search'])) {
                $search = mysqli_real_escape_string($conn, $_GET['search']);
                $selectQuery .= " WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%'";
            }
            break;
        case 'product':
            if (isset($_GET['search'])) {
                $product = mysqli_real_escape_string($conn, $_GET['search']);
                $selectQuery .= " WHERE movie LIKE '%$search%'";
            }
            break;
        case 'pending':
            $selectQuery .= " WHERE order_status = 'Pending'";
            break;
        case 'cost':
            $selectQuery .= " ORDER BY total";
            break;
        case 'date_range':
            if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
                $start_date = mysqli_real_escape_string($conn, $_GET['start_date']);
                $end_date = mysqli_real_escape_string($conn, $_GET['end_date']);
                $selectQuery .= " WHERE date BETWEEN '$start_date' AND '$end_date'";
            }
            break;
        default:
            // Display all orders by default
            break;
    }
}

$result = mysqli_query($conn, $selectQuery);

function sortMultiArray(&$array, $column, $direction = 'asc')
{
    if (!function_exists('array_column')) {
        function array_column($array, $columnKey, $indexKey = null)
        {
            $result = array();
            foreach ($array as $key => $value) {
                if (isset($value[$columnKey])) {
                    if ($indexKey !== null && isset($value[$indexKey])) {
                        $result[$value[$indexKey]] = $value[$columnKey];
                    } else {
                        $result[] = $value[$columnKey];
                    }
                }
            }
            return $result;
        }
    }
    $sortColumn = array_column($array, $column);
    if ($direction === 'desc') {
        array_multisort($sortColumn, SORT_DESC, $array);
    } else {
        array_multisort($sortColumn, SORT_ASC, $array);
    }
}

// Check if a sorting parameter is provided in the URL
$sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'order_id';
$sortDirection = isset($_GET['dir']) ? $_GET['dir'] : 'asc';

// Perform sorting based on the specified column and direction

// Reverse the sort direction for the next click

if (!$result) {
    // Error occurred while retrieving orders
    die("Failed to retrieve orders: " . mysqli_error($conn));
}

$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

$averageOrdersQuery = "SELECT COUNT(*) AS tot_orders , DATE(order_time) AS order_date FROM `orders` GROUP BY DATE(order_time) ORDER BY order_date";
$averageOrdersResult = mysqli_query($conn, $averageOrdersQuery);

if (!$averageOrdersResult) {
    // Error occurred while retrieving the average number of orders
    die("Failed to retrieve the average number of orders: " . mysqli_error($conn));
}

$distinctDaysQuery = "SELECT COUNT(DISTINCT DATE(order_time)) AS distinct_days FROM orders";
$distinctDaysResult = mysqli_query($conn, $distinctDaysQuery);

if (!$distinctDaysResult) {
    // Error occurred while retrieving the distinct number of days
    die("Failed to retrieve the distinct number of days: " . mysqli_error($conn));
}

$distinctDays = mysqli_fetch_assoc($distinctDaysResult)['distinct_days'];

if ($averageOrdersResult && $averageOrdersResult->num_rows > 0) {
    $totalDays = 0;
    $totalOrders = 0;

    while ($row = $averageOrdersResult->fetch_assoc()) {
        $totalDays++;
        $totalOrders += $row['tot_orders'];
    }

    $averageOrdersPerDay = $totalOrders / $distinctDays;
}

sortMultiArray($orders, $sortColumn, $sortDirection);
$nextSortDirection = $sortDirection === 'asc' ? 'desc' : 'asc';

mysqli_free_result($result);

// Query for the most popular product ordered
$popularProductQuery = "SELECT movie, COUNT(*) AS count FROM orders GROUP BY movie ORDER BY count DESC LIMIT 1";
$popularProductResult = mysqli_query($conn, $popularProductQuery);
$popularProduct = mysqli_fetch_assoc($popularProductResult);

// Query for fulfilled orders purchased between two dates
$startDate = date('Y-m-d', strtotime('-7 days'));
$endDate = date('Y-m-d');
$fulfilledOrdersQuery = "SELECT COUNT(*) AS count FROM orders WHERE order_status = 'Fulfilled' AND order_time BETWEEN '$startDate' AND '$endDate'";
$fulfilledOrdersResult = mysqli_query($conn, $fulfilledOrdersQuery);
$fulfilledOrders = mysqli_fetch_assoc($fulfilledOrdersResult);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manager Page</title>
    <meta charset="utf-8" />
    <meta name="author" content="Saw Zi Chuen" />
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>
    <?php include 'includes/header.inc'; ?>
    <div class="space"></div>

    <h2>Order Queries</h2>
    <form action="manager.php" method="get">
        <label for="query">Select a query:</label>
        <select name="query" id="query">
            <option value="all">All Orders</option>
            <option value="customer">Orders for a Customer</option>
            <option value="product">Orders for a Product</option>
            <option value="pending">Pending Orders</option>
            <option value="cost">Orders Sorted by Total Cost</option>
        </select>
        <div id="search-section">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search" placeholder="Enter name or product">
    </div>
        <input type="submit" value="Submit">
    </form>

    <h2>Order Results</h2>
    <?php if ($orders) : ?>
        <table class="enc">

            <thead>
                <tr>
                    <th>
                        <a href="?sort=order_id&dir=<?php echo $nextSortDirection; ?>">
                            Order Number
                            <span class="sort-arrow <?php if ($sortColumn === 'order_id') echo $sortDirection; ?>"></span>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=order_time&dir=<?php echo $nextSortDirection; ?>">
                            Order Date
                            <span class="sort-arrow <?php if ($sortColumn === 'order_time') echo $sortDirection; ?>"></span>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=movie&dir=<?php echo $nextSortDirection; ?>">
                            Product Details
                            <span class="sort-arrow <?php if ($sortColumn === 'movie') echo $sortDirection; ?>"></span>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=firstname&dir=<?php echo $nextSortDirection; ?>">
                            Customer Name
                            <span class="sort-arrow <?php if ($sortColumn === 'firstname') echo $sortDirection; ?>"></span>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=order_status&dir=<?php echo $nextSortDirection; ?>">
                            Order Status
                            <span class="sort-arrow <?php if ($sortColumn === 'order_status') echo $sortDirection; ?>"></span>
                        </a>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['order_time']; ?></td>
                        <td><?php echo $order['movie'] . ' - ' . $order['date'] . ' ' . $order['time'] . ' (' . $order['seats'] . ' ' . $order['opt'] . ') Total Cost: RM' . $order['total']; ?></td>
                        <td><?php echo $order['firstname'] . ' ' . $order['lastname']; ?></td>
                        <td><?php echo $order['order_status']; ?></td>
                        <td>
                            <form action="manager.php" method="post">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                <select name="status">
                                    <option value="Fulfilled">Fulfilled</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Archived">Archived</option>
                                </select>
                                <input type="submit" name="update_status" value="Update Status">
                            </form>
                            <?php if ($order['order_status'] === 'Pending') : ?>
                                <form action="manager.php" method="post">
                                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                    <input type="submit" name="cancel_order" value="Cancel Order">
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No orders found.</p>
    <?php endif; ?>
    <h2>Additional Statistics</h2>
    <div class="statistics">
        <div class="stat">
            <h3 class="man">Most Popular Product:</h3>
            <?php if ($popularProduct) : ?>
                <p><?php echo $popularProduct['movie']; ?></p>
                <p>Ordered <?php echo $popularProduct['count']; ?> times</p>
            <?php else : ?>
                <p>No product found.</p>
            <?php endif; ?>
        </div>
        <div class="stat">
            <h3 class="man">Fulfilled Orders in the Past 7 Days: </h3>
            <?php if ($fulfilledOrders) : ?>
                <p><?php echo $fulfilledOrders['count']; ?></p>
            <?php else : ?>
                <p>No fulfilled orders found.</p>
            <?php endif; ?>
        </div>
        <div class="stat">
            <h3 class="man">Average Orders Per Day: </h3>
            <?php if ($averageOrdersPerDay) : ?>
                <p><?php echo $averageOrdersPerDay; ?></p>
            <?php else : ?>
                <p>No orders found.</p>
            <?php endif; ?>
        </div>
    </div>

    <h2>Orders Between Dates</h2>
    <form action="manager.php" method="get">
        <input type="hidden" name="query" value="date_range">
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" required>
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" required><br>
        <input type="submit" value="Submit">
    </form>


    <?php include 'includes/footer.inc'; ?>
</body>

</html>