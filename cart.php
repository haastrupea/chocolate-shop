<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./src/vendor/css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="./src/vendor/css/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="./src/vendor/css/animate/animate.css">
  <link rel="stylesheet" href="./src/resources/css/box-order.css">
  <title>Box order</title>
</head>
<body class="loading-overlay">
  <header class="container">
    <nav class="navbar">
      <div class="navbar-brand">
        <!-- <div class="logo">
          <img src="./src/resources/images/logo.webp" alt="Logo">
        </div> -->
      </div>
      <div class=" navbar-text">
        <div id="cart-icon">
          <div class="ec-cart-widget"></div>
      </div>

      

    </div>
    </nav>
  </header>


  <main>
    <div class="container">
      <h1 class="mt-3">Build your own box</h1>
      <div class="box-heading">
        <div class="alert alert-info">Select some chocolate! Spots left: <span id="spot-counter"></span></div>
      </div>
      <div class="row main">
        <div class="col">
         <div class="box-stage container">
           <div class="box-header">
             <h2>Boxes</h2>
           </div>
           
           <ul id="box-with-Spot" class="box-frame my-4 mx-auto row">
           
           </ul>
           <div id="cart-form" class="row align-items-center justify-content-center mb-4 d-none">
            <form id="box-form" action="#" method="post">
               <div class="form-row">
                 <div class="col-4 offset-2"><input id="quantity" value="1"  min="1" type="number" name="quantity" id="" class="form-control text-center"></div>
                 <div class="col-6"><button class="btn btn-warning">Add To Cart</button></div>
               </div>
              </form>
              </div>
           <div class="row align-items-center justify-content-center">
             <button id="resetBox" class=" btn btn-warning">Empty Box</button>
           </div>
         </div>
        </div>
        <div class="col-lg-4 col-sm-12 d-flex align-items-center">
          <div id="product-Details">
            <h4 id="product-name" ></h4>
            <a href="./index.php#!/build-Box/c/56350146/offset=0&sort=normal">
            <span>Back to catalog</span>
            </a>
            <h2 id="price"></h2>
            <div id="decription">
              <h5 class="desc-title">Product Description</h5>
              <p class="desc-content">
              </p>
              </div>
          </div>

        </div>
      </div>

      <ul id="chocolates" class="row">
      </ul>
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
  <!-- <script src="./src/resources/data/chocolates.js"></script> -->
  <script data-cfasync="false" type="text/javascript" src="https://app.ecwid.com/script.js?13470050&data_platform=code&data_date=2020-07-18" charset="utf-8"></script>
<script type="text/javascript">
Ecwid.init();

</script>

  <script>
 var selectedBoxesData = [];
 var product;
 var boxSize= 0;
 var data = [];


function getProduct(id,callback){
      let baseUrl = `https://app.ecwid.com/api/v3/13470050/products?token=public_6WzqZ3LWix5yrNhew8B7v7pXcfNUsTa3&productId=${id}`
      let xhr = new XMLHttpRequest();
          xhr.open('GET',baseUrl);
          xhr.onreadystatechange = function(e){
            if(xhr.readyState==4 && xhr.status==200){
              callback(JSON.parse(xhr.responseText))
            }
          }

          xhr.send();
}

function getflavours(callback){
  let flavourId = 56389044;
  let baseUrl = `https://app.ecwid.com/api/v3/13470050/products?token=public_6WzqZ3LWix5yrNhew8B7v7pXcfNUsTa3&category=${flavourId}&enabled=true`;
      let xhr = new XMLHttpRequest();
          xhr.open('GET',baseUrl);
          xhr.onreadystatechange = function(e){
            if(xhr.readyState==4 && xhr.status==200){
              callback(JSON.parse(xhr.responseText))
            }
          }

          xhr.send();
}

function buildProductOptions(){
  let allChocolateInBox = document.querySelectorAll('.selected input');
  let options={};
      allChocolateInBox.forEach((chocolate,i)=>{
        options[`Chocolate ${i+1}`] = chocolate.value;
      });

      return options;
}
function addToCartCallBack(success,product,cart){

  let docFrag = new DocumentFragment();
  let div = document.createElement('div');
      div.classList.add('alert','text-center','message-alert');
      div.style.position = 'fixed';
      div.style.top = 0;
      div.style.left = 0;
      div.style.right = 0;
      div.style.width = '50%';
      div.style.margin = 'auto';
      div.style.zIndex = '9999';

  let message="Product Added to cart successfully";

      if(success){
        div.classList.add('alert-success');
      }else{
        div.classList.add('alert-danger');
        message = "Failed to Add product to Cart, Please try Again";
      }
      div.innerHTML = message;

      document.body.appendChild(div);

      setTimeout(function(){
        let d = document.querySelector('.message-alert');
            d.parentElement.removeChild(d);
      },5000);
      


}
function addToCart(e){
      e.preventDefault();
  let cartProduct = {};

  //get productId
  cartProduct.id = Number(product.id);
  //get quantity
  cartProduct.quantity = document.getElementById('quantity').value;
  //get options;
  cartProduct.options = buildProductOptions();

  cartProduct.callback = addToCartCallBack;

  // console.log(cartProduct);

  Ecwid.Cart.addProduct(cartProduct);

}


function getBoxSize(prod){
  return prod.options.length;
}

function setBoxFrameSize(){
  let boxFrame = document.getElementById('box-with-Spot');
  let box = 155;
  let even = 310;
  let odd = 452;
  let size = even;

  if(boxSize% 2===0){
    boxFrame.classList.remove('odd');
    boxFrame.classList.add('even');
    size = box * (boxSize/2);

    let rowSize = size / box ;
        if(rowSize>4){
    size = box * 4;
        }
        if(boxSize===2){
          size = box* 2;
        }
  }else{
    boxFrame.classList.remove('even');
    boxFrame.classList.add('odd');

    size = box * (boxSize/3);

let rowSize = size / box ;
    if(rowSize>5){
size = box * 5;
    }else{
size = box * 3;
    }
  }

  boxFrame.style.width = size+"px";
}

function renderSpot(spotLeft){
  let spotCount = document.getElementById('spot-counter');
      spotCount.innerHTML=spotLeft;
}

function renderProductDetails(){
  // console.log(product);
  //render name
  document.getElementById('product-name').innerHTML = product.name;
  //price
  document.getElementById('price').innerHTML = product.defaultDisplayedPriceFormatted;
  //description
  document.querySelector('#decription .desc-content').innerHTML = product.description;

}


function getSpotLeft(){
  let spotCount = document.getElementById('spot-counter');
      return spotCount.innerHTML;
}

function flavourDataAdapter(flavour){
  let dat = [];
  flavour.items.forEach(elm=>{
        // console.log(elm)
    let d = {};
        d.name  = elm.name;
        d.description = elm.description;
    
    let imgs = elm.media.images[0].image400pxUrl;
    let xRay = elm.media.images[1]?elm.media.images[1].image400pxUrl:"";

        d.img = imgs;

        if(xRay.length!==0){
          d.xRay = xRay;
        }
    dat.push(d);
    });

    data = dat
    // console.log(data);

    //safe to popluate selector here
    initNrenderChocolateSelector()
}

function setMinBoxToOrder(boxSize){
  //some box sizes have minimum quantity that can be ordered
  let quantityInput = document.getElementById('quantity');
  let minQuantity = (boxSize<=3)? 20:1;  
  quantityInput.setAttribute('min',minQuantity);
  quantityInput.setAttribute('value',minQuantity);
}


function cartForm(spotLeft){
    let form = document.getElementById('cart-form');
        (spotLeft===0)?form.classList.remove('d-none'):form.classList.add('d-none');

        let boxForm = document.getElementById('box-form');

        if(spotLeft===0){
          boxForm.addEventListener('submit',addToCart,false);
        }else{
          boxForm.removeEventListener('submit',addToCart,false);
        }
  }


function deleteEmptyBox(target){
    let index = target.querySelector("img").getAttribute('data-index');
    let del = selectedBoxesData.indexOf(data[index]);
        selectedBoxesData.splice(del,1);//update selecteddata array by deleting
        target.innerHTML="";
        target.classList.replace('selected','empty');
        target.removeEventListener('click',removeChocolate,false);
        
  }


function emptyAllBox(){
    let selectedBoxes = document.querySelectorAll('.box-frame .box.selected');
        if(selectedBoxes !=null){
          selectedBoxes.forEach(box=>{
            deleteEmptyBox(box);
          })

          if(arguments.length!=0){
            selectedBoxesData=[];
          }
          // spotCount.innerHTML=boxSize;
          renderSpot(boxSize);
          cartForm(boxSize);
        }
  }


function removeChocolate(e){
    let target = e.currentTarget;
        deleteEmptyBox(target);
        let spotLeft=Number(getSpotLeft())+1;
        // spotCount.innerHTML=spotLeft;
        renderSpot(spotLeft);
        cartForm(spotLeft);

  }//remove any selected  clicked on by the user


function addChocolateToBox(e){
      let target = e.currentTarget;
      let targetIndex = target.getAttribute('data-index');
      let targetData= data[targetIndex];
          
      let nextBoxEmptySpot = document.querySelector('.box-frame .box.empty');
        
      if(nextBoxEmptySpot !=null){
        
          selectedBoxesData.push(targetData);//undate box data array
          nextBoxEmptySpot.addEventListener('click',removeChocolate,false);

      //set up the content of selected box
      let docFrag= new DocumentFragment();
      let img = document.createElement('img');
          img.src = targetData.img;
          img.alt = targetData.name;
          img.setAttribute('data-index',targetIndex);
          docFrag.appendChild(img);
      
      let removeIcon = document.createElement('div');
        removeIcon.classList.add("remove-icon");
        removeIcon.title = targetData.description;

      let faICon = document.createElement('span');
          faICon.classList.add('fa','fa-minus-circle', 'fa-2x');
          removeIcon.appendChild(faICon);
          docFrag.appendChild(removeIcon);

      let input = document.createElement('input');
          input.type = 'hidden';
          input.value = targetData.name;
          docFrag.appendChild(input);

          nextBoxEmptySpot.appendChild(docFrag);
          nextBoxEmptySpot.classList.replace('empty','selected');
      let spotLeft = Number(getSpotLeft())-1;
          renderSpot(spotLeft);
          cartForm(spotLeft);

      }else{
        //update the alert that the box is full
      }
  }


function initNrenderEmptyBox(){
  let boxSpot = document.getElementById('box-with-Spot');
      
      setBoxFrameSize()
    // boxSpot.classList.remove("box4","box6","box12",'box2',"box3",'box24');
    // boxSpot.classList.add(`box${boxSize}`);
  let spotFrag = new DocumentFragment();
      for (let i = 0; i < boxSize; i++) {
        let spot = document.createElement('li');
          spot.classList.add('box','empty');
          spotFrag.appendChild(spot)
      }
      boxSpot.innerHTML="";
      boxSpot.appendChild(spotFrag);
}


function initNrenderChocolateSelector(){
  let ul = document.getElementById('chocolates');
  let docfrag = new DocumentFragment();
      data.forEach((elm,index) => {
        let li = document.createElement('li');
        let figure = document.createElement('figure');
            figure.setAttribute("data-name",elm.name);
            figure.setAttribute("data-index",index);
            figure.addEventListener('click',addChocolateToBox);
        let img = document.createElement('img');
            img.src = elm.img;
            img.alt = elm.name;
            figure.appendChild(img);

            if(elm.xRay){
                  img.classList.add("main-image");
              let img2 = document.createElement('img');
                  img2.src = elm.xRay;
                  img2.alt = elm.name;
                  img2.classList.add("xray-image",'my-auto');
                  figure.appendChild(img2);
            }
        
        let addIcon = document.createElement('div');
            addIcon.classList.add("add-icon");
            addIcon.title = elm.description;

        let faICon = document.createElement('span');
            faICon.classList.add('fa','fa-plus-circle', 'fa-2x');
            addIcon.appendChild(faICon);
            figure.appendChild(addIcon);

            li.appendChild(figure);

        let h5 = document.createElement('h5');
            h5.textContent = elm.name;

            li.appendChild(h5);

            docfrag.appendChild(li);
      });
      ul.innerHTML="";
      ul.appendChild(docfrag);

      clearLoader();// remove overlay from pages
}

function clearLoader(){
  document.body.classList.remove('loading-overlay');
  let overLay = document.querySelector('.overlay');
      overLay.parentElement.removeChild(overLay);
}

function initCartPage(prod){
        if(prod.items instanceof Array){
              product = prod.items[0];
              boxSize = getBoxSize(product);

              //set minBox that can be ordered
              setMinBoxToOrder(boxSize);

              //init spot size in the spot counter
              renderSpot(boxSize);

              //add event listener to reset button
              document.getElementById('resetBox').addEventListener('click',emptyAllBox,false);

              //set up and add empty box spot to the page
              initNrenderEmptyBox();

              //get flavour data and set chocolate to be clicked on
              getflavours(flavourDataAdapter);
              

              //fill the product details
              renderProductDetails();

              //remove loader
             

          }//product code is valid
          
  }// called when product info is gotten from the server
function backHome(){
  window.location.href ="./index.php#!/build-Box/c/56350146/offset=0&sort=normal";
}


  Ecwid.OnAPILoaded.add(function(){

            if(location.hash.substr(1).length==0){
              backHome();
            }

            let productId = Number(location.hash.substr(1));

                if(!isNaN(productId)){
                  localStorage.setItem("product", productId);
                }

              productId = localStorage.getItem('product');

              if(productId !=null){
                getProduct(Number(productId),initCartPage);
              }else{
                backHome();
              }
  });



  </script>
</body>
</html>