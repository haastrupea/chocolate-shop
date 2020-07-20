<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./src/vendor/css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="./src/vendor/css/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="./src/vendor/css/animate/animate.css">
  <link rel="stylesheet" href="./src/resources/css/box-order.css">
  <title>Chocolate store::build your own box of chocolate</title>
</head>
<body class="loading-overlay">
  <header class="container">
    <nav class="navbar">
      <div class="navbar-brand">
        <div class="logo">
          <img src="./src/resources/images/logo.webp" alt="Logo">
        </div>
      </div>
      <div class=" navbar-text">
        <div id="cart-icon">
          <!-- <span id="cart-item-count">2</span>
          <span class="fa fa-stack">
            <a href="#"><span class="fa fa-cart-arrow-down fa-2x mini-cart-icon"></span></a>
          </span> -->
          <div class="ec-cart-widget">

          </div>
      </div>

      

    </div>
    </nav>
  </header>
  
 <main id="shop-main">
  <div id="my-store-13470050">

  </div>
 </main>
 <div class="overlay">
    <div class="loader d-flex align-items-center">
      <div class="box-loading d-flex animate infinite fa-spin">
        <img width="50" height="50" src="/src/resources/images/AHA.webp" alt="">
        <img width="50" height="50" src="/src/resources/images/AO.webp" alt="">
        <img width="50" height="50" src="/src/resources/images/hotchocolate.webp" alt="">
        <img width="50" height="50" src="/src/resources/images/Biscotti.webp" alt="">
      </div>
      <h3 class="animated pulse infinite">Building your own Box</h3>
    </div>
  </div>

</body>
<script data-cfasync="false" type="text/javascript" src="https://app.ecwid.com/script.js?13470050&data_platform=code&data_date=2020-07-18" charset="utf-8"></script><script type="text/javascript"> 

xProductBrowser("categoriesPerRow=3","views=grid(20,3) list(60) table(60)","categoryView=grid","searchView=list","id=my-store-13470050");

function clearLoader(){
  document.body.classList.remove('loading-overlay');
  let overLay = document.querySelector('.overlay');
      overLay.parentElement.removeChild(overLay);
}


Ecwid.init();
Ecwid.OnAPILoaded.add(function(){
  console.log('API');
  
})
Ecwid.OnPageLoaded.add(function() {
  console.log('PAGE'); 

document.querySelectorAll('.grid-product').forEach(elm=>{
   let link = elm.querySelector('a');
   
   if(!link.href.includes('Gift-card')){
        let cloneG = elm.firstElementChild.cloneNode(true);
            elm.innerHTML="";// clear initial content
            elm.appendChild(cloneG);// replace with cloned content
      }// only clone products that are not gift cards;
})


document.querySelectorAll('.grid-product a').forEach(link=>{
    let patern = /p\/(\d+)\//;
    let productId = link.href.match(patern)[1];
          if(!link.href.includes('Gift-card')){
          //rewrite the link
        link.href = `./cart.php#${productId}`;
        
          }// only work on product link;
  })

  Ecwid.OnAPILoaded.add(function(){
  //remove loader
    clearLoader();
})


});

</script>
</html>