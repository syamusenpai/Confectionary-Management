<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aneka Rasa-Home</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,700;0,900;1,500;1,800&display=swap" rel="stylesheet">
</head>
<?php include '../include/user_header.php'; ?>

<style>
.home2 {
    height: 100vh;
    width: 100%;
    background-image: url();
    background-color: white;
    background-size: cover ; 
    position: relative;
    display: flex;
    flex-direction: column;
    grid-template-columns: repeat(2,1fr);
    align-items: center !important ;
    text-align: center; /* Center text within the container */
    gap: 1.5rem;
    margin: 0 auto;
    padding: 0%;
}

.home2-img {
    width: auto;
    height: auto;
}

.home2--text {
    place-self: center;
    text-align: center; /* Center the text horizontally */
}

.home2--text h4 {
    font-size: 20px;
    font-weight: 500px;
    color: var(--other-color);
}

.home2--text h1 {
    font-size: var(--big-font);
    color: var(--text-color);
    line-height: 1.2;
    margin: 25px 0 45px;
}

</style>

<body>
    
<section class="home2">
<div class="home2--text" > 
    <br>
    <br>
    <br>
    <br><h4> Our Contacts? uh sure ! Here .</h4>
    <br>
    <br>
    
</div>       

        <div class="middle-text">
            <h2>Our Contact.<span> Hit us up okay?😼</span></h2>
        </div>
    
        <div class="product-content">
            <!-- Product Box 1 -->
            <div class="box">
                <div class="box-img">
                    <img src="../img/insta.png" alt="Instagram">
                </div>
                <br><h3>Instagram</h3>
                <h4></h4>
              
            </div>
    
            <!-- Product Box 2 -->
            <div class="box">
                <div class="box-img">
                    <img src="../img/whatsapp.png" alt="Whatsapp">
                </div>
                <br><h3>Whatsapp</h3>
                <h4></h4>
                
            </div>
    
            <!-- Product Box 3 -->
            <div class="box">
                <div class="box-img">
                    <img src="../img/tiktok.png" alt="Tiktok">
                </div>
                <br><h3>Tiktok</h3>
                <h4></h4>
                
            </div>
             <!-- Product Box 4 -->
             <div class="box">
                <div class="box-img">
                    <img src="../img/facebook.png" alt="Facebook">
                </div>
                <br><h3>Facebook</h3>
                <h4></h4>
                
            </div>
            <br>
            <br>
        </div>
        
    </section>

</body>