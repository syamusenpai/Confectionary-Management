<?php
// Database connection parameters
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'aneka_2.0');

// Create connection
$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($dbc->connect_error) {
    die("Connection failed: " . $dbc->connect_error);
}

// Fetch categories from the database
$sql = "SELECT id, name FROM product_categories";
$resultCategories = $dbc->query($sql);
// Check if the form is submitted for searching
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST["search"];
    $selectedCategory = $_POST["category"];

    // Construct the SQL query with search criteria and category filter
    $query = "SELECT * FROM products";

    // Add WHERE clause if search criteria is provided
    if (!empty($search)) {
        $query .= " WHERE name LIKE '%$search%' OR details LIKE '%$search%'";
    }

    // Add AND only if WHERE clause is present
    if (!empty($selectedCategory)) {
        $query .= (!empty($search) ? " AND" : " WHERE") . " id IN (SELECT product_id FROM product_category_mapping WHERE category_id = '$selectedCategory')";
    }
} else {
    // Default query to fetch all products
    $query = "SELECT * FROM products";
}

$result = mysqli_query($dbc, $query);

?>

<!DOCTYPE html>
<html lang="en">
<?php include '../include/user_header.php'; ?>
<head>
    <meta charset="UTF-8">
    <title>Product Listing</title>
    <link rel="stylesheet" type="text/css" href="../style/style2.css">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Add your other stylesheets and scripts here -->
</head>


<body>

    <div id="wrapper">
        <div id="header">
            <!-- Include your header content here -->
        </div>

        <div class="cart-icon-bottom">
</div>

<div id="checkout" style="cursor: pointer; padding: 10px; background-color: #4CAF50; color: white; text-align: center;">
    CHECKOUT
</div>
<br>

        <div id="sidebar">
            <h3>CART</h3>
            <div id="cart">
                <span class="empty">No items in cart.</span>
            </div>

           
        </div>
        <form method="post" action="">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search">

    <label for="category">Filter by Category:</label>
    <select id="category" name="category">
        <option value="">All Categories</option>
        <?php
        // Populate the dropdown with fetched categories
        while ($category = $resultCategories->fetch_assoc()) {
            echo "<option value='{$category['id']}'>{$category['name']}</option>";
        }
        ?>
    </select>

    <input type="submit" value="Search">
</form>


        <div class="feature-content">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="row">
                        <div class="main-row">
                            <div class="row-text">
                                <h3><?php echo $row['name']; ?></h3>
                                <h6>Description:<br><?php echo $row['details']; ?></h6>
                                <span class="product_price">RM<?php echo $row['price']; ?></span>
                                <p>Quantity in Stock: <?php echo $row['quantity']; ?></p>
                            </div>
                            <div class="row-img">
                                <center><img src="../img/<?php echo $row['image_01']; ?>" alt="<?php echo $row['name']; ?>"></center>
                            </div>
                            <div class="quantity-input">
                                <label for="quantity<?php echo $row['id']; ?>">Quantity:</label>
                                <input type="number" id="quantity<?php echo $row['id']; ?>" name="quantity" value="1" min="1" max="<?php echo $row['quantity']; ?>">
                            </div>
                            <center><button class="add-cart-large">Add To Cart</button></center>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "No products found.";
            }

            // Close the database connection
            mysqli_close($dbc);
            ?>
        </div>
    </div>

    
    <script src="../style/style.js"></script>
   
</body>

</html>
<script>
$(document).ready(function(){
    // Function to handle product card animations
    function handleProductCardAnimations(productCard) {
        $(productCard).find('.make3D').hover(function(){
            $(this).parent().css('z-index', "20");
            $(this).addClass('animate');
            $(this).find('div.carouselNext, div.carouselPrev').addClass('visible');
        }, function(){
            $(this).removeClass('animate');
            $(this).parent().css('z-index', "1");
            $(this).find('div.carouselNext, div.carouselPrev').removeClass('visible');
        });

        $(productCard).find('.view_gallery').click(function(){
            $(productCard).find('div.carouselNext, div.carouselPrev').removeClass('visible');
            $(productCard).find('.make3D').addClass('flip-10');
            setTimeout(function(){
                $(productCard).find('.make3D').removeClass('flip-10').addClass('flip90').find('div.shadow').show().fadeTo(80, 1, function(){
                    $(productCard).find('.product-front, .product-front div.shadow').hide();
                });
            }, 50);

            setTimeout(function(){
                $(productCard).find('.make3D').removeClass('flip90').addClass('flip190');
                $(productCard).find('.product-back').show().find('div.shadow').show().fadeTo(90, 0);
                setTimeout(function(){
                    $(productCard).find('.make3D').removeClass('flip190').addClass('flip180').find('div.shadow').hide();
                    setTimeout(function(){
                        $(productCard).find('.make3D').css('transition', '100ms ease-out');
                        $(productCard).find('.cx, .cy').addClass('s1');
                        setTimeout(function(){$(productCard).find('.cx, .cy').addClass('s2');}, 100);
                        setTimeout(function(){$(productCard).find('.cx, .cy').addClass('s3');}, 200);
                        $(productCard).find('div.carouselNext, div.carouselPrev').addClass('visible');
                    }, 100);
                }, 100);
            }, 150);
        });

        $(productCard).find('.flip-back').click(function(){
            $(productCard).find('.make3D').removeClass('flip180').addClass('flip190');
            setTimeout(function(){
                $(productCard).find('.make3D').removeClass('flip190').addClass('flip90');

                $(productCard).find('.product-back div.shadow').css('opacity', 0).fadeTo(100, 1, function(){
                    $(productCard).find('.product-back, .product-back div.shadow').hide();
                    $(productCard).find('.product-front, .product-front div.shadow').show();
                });
            }, 50);

            setTimeout(function(){
                $(productCard).find('.make3D').removeClass('flip90').addClass('flip-10');
                $(productCard).find('.product-front div.shadow').show().fadeTo(100, 0);
                setTimeout(function(){
                    $(productCard).find('.product-front div.shadow').hide();
                    $(productCard).find('.make3D').removeClass('flip-10').css('transition', '100ms ease-out');
                    $(productCard).find('.cx, .cy').removeClass('s1 s2 s3');
                }, 100);
            }, 150);
        });

        makeCarousel(productCard);
    }

    // Function to initialize carousel for each product
    function makeCarousel(productCard){
        var carousel = $(productCard).find('.carousel ul');
        var carouselSlideWidth = 315;
        var carouselWidth = 0;
        var isAnimating = false;
        var currSlide = 0;
        $(carousel).attr('rel', currSlide);

        $(carousel).find('li').each(function(){
            carouselWidth += carouselSlideWidth;
        });
        $(carousel).css('width', carouselWidth);

        $(productCard).find('div.carouselNext').on('click', function(){
            var currentLeft = Math.abs(parseInt($(carousel).css("left")));
            var newLeft = currentLeft + carouselSlideWidth;
            if(newLeft == carouselWidth || isAnimating === true){return;}
            $(carousel).css({'left': "-" + newLeft + "px", "transition": "300ms ease-out"});
            isAnimating = true;
            currSlide++;
            $(carousel).attr('rel', currSlide);
            setTimeout(function(){isAnimating = false;}, 300);
        });

        $(productCard).find('div.carouselPrev').on('click', function(){
            var currentLeft = Math.abs(parseInt($(carousel).css("left")));
            var newLeft = currentLeft - carouselSlideWidth;
            if(newLeft < 0  || isAnimating === true){return;}
            $(carousel).css({'left': "-" + newLeft + "px", "transition": "300ms ease-out"});
            isAnimating = true;
            currSlide--;
            $(carousel).attr('rel', currSlide);
            setTimeout(function(){isAnimating = false;}, 300);
        });
    }

    // Initialize product card animations for each product
    $('.product').each(function(i, el){
        handleProductCardAnimations(el);
    });
// Add to Cart functionality
var totalCartPrice = 0;  // Initialize total cart price

$('.add-cart-large').each(function (i, el) {
    $(el).click(function () {
        var productCard = $(this).closest('.row');
        var position = productCard.offset();
        var productImage = $(productCard).find('img').attr('src');
        var productName = $(productCard).find('h3').text();

        // Ensure the price is a valid number (remove 'RM' and convert to float)
        var productPrice = parseFloat($(productCard).find('.product_price').text().replace('RM', '').trim()) || 0;

        // Use val() to get input value for quantity
        var quantity = parseInt($(productCard).find('.quantity-input input').val()) || 1;

        var totalPrice = productPrice * quantity;

        totalCartPrice += totalPrice;  // Accumulate total cart price

        $("body").append('<div class="floating-cart"></div>');
        var cart = $('div.floating-cart');
        $(productCard).clone().appendTo(cart);
        $(cart).css({ 'top': position.top + 'px', 'left': position.left + 'px' }).fadeIn("slow").addClass('moveToCart');
        setTimeout(function () { $("body").addClass("MakeFloatingCart"); }, 800);
        setTimeout(function () {
            $('div.floating-cart').remove();
            $("body").removeClass("MakeFloatingCart");

            var cartItem =
            "<div class='cart-item'>" +
            "   <div class='img-wrap'><img src='" + productImage + "' alt='' /></div>" +
            "   <span>" + productName + "</span>" +
            "   <div class='quantity-in-cart'>Quantity: " + quantity + "</div>" +
            "   <strong> RM " + totalPrice.toFixed(2) + "</strong>" +
            "   <div class='total-cart-price'>Total Cart Price: RM " + totalCartPrice.toFixed(2) + "</div>" +
            "   <div class='cart-item-border'></div>" +
            "   <div class='delete-item'>" +
            "       <a href='#' class='delete-link'><img src='../img/garbagecan.png' alt='Delete'></a>" +
            "   </div>" +
            "</div>";
        

            $("#cart .empty").hide();
            $("#cart").append(cartItem);
            $("#checkout").fadeIn(500);

            $("#cart .cart-item").last()
            .addClass("flash")
            .find(".delete-item").click(function () {
                var deletedItemPrice = parseFloat($(this).siblings('strong').text().replace('RM', '').trim()) || 0;
                totalCartPrice -= deletedItemPrice;  // Subtract deleted item price from total
                $(this).parent().fadeOut(300, function () {
                    $(this).remove();
                    if ($("#cart .cart-item").size() == 0) {
                        $("#cart .empty").fadeIn(500);
                        $("#checkout").fadeOut(500);
                    }
                });
            });
        
            setTimeout(function () {
                $("#cart .cart-item").last().removeClass("flash");
            }, 10);

        }, 1000);
    });
});


// Add your other scripts or include the existing ones here

// Save cart data to local storage
function saveCartDataToLocalStorage(cartData) {
    localStorage.setItem('cartData', JSON.stringify(cartData));
}

// Load cart data from local storage
function loadCartDataFromLocalStorage() {
    var cartData = localStorage.getItem('cartData');
    return cartData ? JSON.parse(cartData) : [];
}

// Add click event handler for the checkout button
$('#checkout').click(function () {
    // Check if the cart is not empty before redirecting
    if ($("#cart .cart-item").length > 0) {
        // Get the cart data
        var cartData = getCartData();
        
        // Save the cart data to local storage
        saveCartDataToLocalStorage(cartData);

        // Redirect to the checkout page
        window.location.href = 'checkout.php?cartData=' + encodeURIComponent(JSON.stringify(cartData));
    } else {
        // Show a message or alert that the cart is empty
        alert("Your cart is empty. Add items before checking out.");
    }
});

// Function to get the cart data
function getCartData() {
    var cartData = [];
    $("#cart .cart-item").each(function () {
        var item = {
            image: $(this).find('.img-wrap img').attr('src'),
            name: $(this).find('span').text(),
            quantity: parseInt($(this).find('.quantity-in-cart').text().replace('Quantity: ', '')),
            price: parseFloat($(this).find('strong').text().replace('RM ', ''))
        };
        cartData.push(item);
    });
    return cartData;
}


});

// Add your other scripts or include the existing ones here

</script>