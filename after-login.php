<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="after-login.css">
    <title>InfoZone</title>
</head>
<body>
    <h1>Input what you like</h1>
    <form action="proses.php" method="post">
        <label for="categories">News Categories:</label><br>
        <input type="checkbox" name="categories[]" value="sport"> Sport<br>
        <input type="checkbox" name="categories[]" value="business"> Business<br>
        <input type="checkbox" name="categories[]" value="innovation"> Innovation<br>
        <input type="checkbox" name="categories[]" value="culture"> Culture<br>
        <input type="checkbox" name="categories[]" value="travel"> Travel<br>
        <input type="checkbox" name="categories[]" value="health"> Health<br>
        <input type="checkbox" name="categories[]" value="tech"> Tech<br>
        <input type="checkbox" name="categories[]" value="food"> Food<br>
        <input type="checkbox" name="categories[]" value="movies"> Movies<br><br>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>
