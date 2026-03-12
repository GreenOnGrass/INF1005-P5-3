<?php
$inventory = [];
$errorMsg = "";
$success = true;

function getUserDetails($user_id)
{
    global $errorMsg, $success, $username, $email, $points;
    // Create database connection.
    $config = parse_ini_file('/var/www/private/db-config.ini');
    if (!$config) {
        $errorMsg = "Failed to read database config file.";
        $success = false;
    } else {
        $conn = new mysqli(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['dbname']
        );
        // Check connection
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            // Prepare the statement:
            $stmt = $conn->prepare("SELECT username, email, points FROM Users
                                            WHERE id = ?");
            // Bind & execute the query statement:
            if (!$stmt) {
                $errorMsg = "Prepare failed: (" . $conn->errno . ") " .
                    $conn->error;
                $success = false;
            } else {
                $stmt->bind_param("i", $user_id);
                if (!$stmt->execute()) {
                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " .
                        $stmt->error;
                    $success = false;
                } else {
                    $result = $stmt->get_result();
                    if (!$result) {
                        $errorMsg = "Get result failed: (" . $stmt->errno . ") " .
                            $stmt->error;
                        $success = false;
                    } elseif ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $username = $row['username'];
                        $email = $row['email'];
                        $points = $row['points'];
                        $stmt->close();
                    } else {
                        return null;
                    }
                }
                $stmt->close();
            }
        }
        $conn->close();
    }
}
function getUserInventory($user_id)
{
    global $errorMsg, $success;
    // Create database connection.
    $config = parse_ini_file('/var/www/private/db-config.ini');
    if (!$config) {
        $errorMsg = "Failed to read database config file.";
        $success = false;
    } else {
        $conn = new mysqli(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['dbname']
        );
        // Check connection
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            // Prepare the statement:
            $stmt = $conn->prepare("SELECT * FROM User_Inventory
                                            WHERE user_id = ?");
            // Bind & execute the query statement:
            if (!$stmt) {
                $errorMsg = "Prepare failed: (" . $conn->errno . ") " .
                    $conn->error;
                $success = false;
            } else {
                $stmt->bind_param("i", $user_id);
                if (!$stmt->execute()) {
                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " .
                        $stmt->error;
                    $success = false;
                } else {
                    $result = $stmt->get_result();
                    if (!$result) {
                        $errorMsg = "Get result failed: (" . $stmt->errno . ") " .
                            $stmt->error;
                        $success = false;
                    } elseif ($result->num_rows > 0) {
                        $inventory = [];
                        while ($row = $result->fetch_assoc()) {
                            $inventory[] = $row;
                        }
                        $stmt->close();
                        $conn->close();
                        return $inventory;
                    } else {
                        $stmt->close();
                        $conn->close();
                        return [];
                    }
                }
                $stmt->close();
            }
        }
        $conn->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<?php
$style = "index.css";
include "inc/head.inc.php";
?>

<body>
    <?php include 'inc/nav.inc.php'; ?>

    <main>
        <div class="container">
            <h1 class="text-center mb-4" style="color: white;">My Account</h1>
            <p class="text-center mb-5" style="color: white;">Manage your account details and view your points.</p>

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card bg-dark text-light">
                        <div class="card-body">
                            <?php
                            // For demonstration, using a hardcoded user ID. In a real application, this would come from the session.
                            $user_id = 1;
                            getUserDetails($user_id);
                            if ($success) {
                                echo "<h5 class='card-title'>Username: <span class='text-primary'>$username</span></h5>";
                                echo "<p class='card-text'>Email: <span class='text-primary'>$email</span></p>";
                                echo "<p class='card-text'>Points: <span class='text-primary'>$points</span></p>";
                            } else {
                                echo "<p class='text-danger'>Error fetching user details: $errorMsg</p>";
                            }
                            getUserInventory($user_id);
                            if ($success) {
                                echo "<h5 class='card-title mt-4'>My Inventory</h5>";
                                if (!empty($inventory)) {
                                    echo "<ul class='list-group list-group-flush'>";
                                    foreach ($inventory as $item) {
                                        echo "<li class='list-group-item bg-dark text-light'>Card ID: <span class='text-primary'>{$item['card_id']}</span>, Quantity: <span class='text-primary'>{$item['quantity']}</span></li>";
                                    }
                                    echo "</ul>";
                                } else {
                                    echo "<p class='text-muted'>Your inventory is empty.</p>";
                                }
                            } else {
                                echo "<p class='text-danger'>Error fetching inventory: $errorMsg</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>