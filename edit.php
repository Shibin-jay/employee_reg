<?php

require_once realpath(__DIR__ . "/vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];
try{
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){
    echo "Connection Failed", $e->getMessage();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $dept = $_POST["dept"];
    $stmt = $conn->prepare("SELECT * FROM employeeDetails WHERE id != :id AND (email = :email OR phone = :phone)");
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":phone", $phone);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result) {
        echo "<script>alert('Phone number or Email already exists. so please provide alternative.')</script> ";
    }else{        
        try {
        $stmt = $conn->prepare("UPDATE employeeDetails SET fname = :fname, lname = :lname , email = :email, phone = :phone, dept = :dept WHERE id = :id");
        $stmt->bindParam(":fname", $fname);
        $stmt->bindParam(":lname", $lname);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":dept", $dept);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        header("Location: table.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    }
} else {
    $id = $_GET["id"];
    try {
        $stmt = $conn->prepare("SELECT * FROM employeeDetails WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo "No record found for ID: $id";
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <link rel="stylesheet" href="css/regForm.css" class="rel">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <h1>Edit Employee Details</h1>
    <div class="myform">
        <form id="updateForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="mb-3">
            <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
            <label for="fname">First Name : </label>
            <input type="text" id="fname" name="fname" value="<?php echo $result['fname']; ?>"><br><br>
        </div>
        <div class="mb-3">
            <label for="lname">Last Name : </label>
            <input type="text" id="lname" name="lname" value="<?php echo $result['lname']; ?>"><br><br>
        </div>
        <div class="mb-3">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $result['email']; ?>"><br><br>
        </div>
        <div class="mb-3">
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $result['phone']; ?>"><br><br>
        </div>
        <div class="mb-3">    
            <label for="dept">Department : </label>
            <input type="text" id="dept" name="dept" value="<?php echo $result['dept']; ?>"><br><br>
        </div>
        <button type="submit" class="btn btn-primary mx-2" value="update">Submit</button>
        <!-- <input type="submit" name="submit" value="Update"> -->
    </form>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</div>
</div>
</body>
</html>