<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoZone</title>
</head>
<body>

<header>
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
            </ul>
        </nav>

        <div class="menuBtn"></div>

        <div class="mobile hidden">
            <nav>
                <ul>
                    <li onclick="Search('health')">Health</li>
                    <li onclick="Search('tech')">Tech</li>
                    <li onclick="Search('food')">Food</li>
                    <li onclick="Search('movies')">Movies</li>
                    <li onclick="Search('business')">Business</li>
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

    <main><main>


    <script src="script.js"></script>

</body>
</html>
