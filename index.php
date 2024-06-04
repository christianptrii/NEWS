<?php
session_start();
include('config.php');

// Cek apakah pengguna sudah login


$user_id = @$_SESSION['user_id'];

// Ambil kategori yang dipilih oleh pengguna dari database
$sql = "SELECT tb_category.category FROM tb_tampil_category 
        JOIN tb_category ON tb_tampil_category.id_category = tb_category.id_category 
        WHERE tb_tampil_category.id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$categories = [];

while ($row = $result->fetch_assoc()) {
    $categories[] = $row['category'];
}

$stmt->close();
$conn->close();

// Ubah array kategori menjadi string yang bisa digunakan dalam JavaScript, dipisahkan oleh spasi
$categories_string = implode(' ', $categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoZone</title>

    <!--font awesome-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap"
      rel="stylesheet"
    />
    <!---css style-->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
        <img src="logo.png" width="120px" />

        <div class="inputSearch desktop">
            <form id="searchForm">
                <input type="text" placeholder="Type to search..." id="searchInput" />
                <span> <i class="fa-solid fa-search"></i></span>
            </form>
        </div>
        <nav class="desktop">
            <ul>
                <li onclick="Search('health')">Health</li>
                <li onclick="Search('tech')">Tech</li>
                <li onclick="Search('food')">Food</li>
                <li onclick="Search('movies')">Movies</li>
                <li onclick="Search('business')">Business</li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="menuBtn">
            <i class="fa-solid fa-bars"></i>
        </div>

        <div class="mobile hidden">
            <nav>
                <ul>
                    <li onclick="Search('health')">Health</li>
                    <li onclick="Search('tech')">Tech</li>
                    <li onclick="Search('food')">Food</li>
                    <li onclick="Search('movies')">Movies</li>
                    <li onclick="Search('business')">Business</li>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
                </ul>
            </nav>
            <div class="inputSearch">
                <form id="searchFormMobile" id="searchInputMobile">
                    <input type="text" placeholder="Type to search..." id="searchInputMobile" />
                    <span> <i class="fa-solid fa-search"></i></span>
                </form>
            </div>
        </div>
    </header>

    <header class="header2">
        <div class="section__container header__container">
            <p>News Portal</p>
            <h1>Trusted Portal News</h1>
            <button class="btn">Read More</button>
        </div>
    </header>

    <br>

    <main><main>

    <footer class="footer">
      <div class="footer__bar">
          Copyright © 2024 InfoZone. All rights reserved.
      </div>
    </footer>

    <script>
        // Dapatkan kategori yang dipilih dari PHP
        const userCategories = "<?php echo $categories_string; ?>";
        console.log('User Categories:', userCategories);  // Debugging log
    </script>

    <script src="script.js"></script>

</body>
</html>
