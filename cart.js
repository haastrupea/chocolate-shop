// custom elements

function createPage(){
  let container = document.createElement('div');
      container.innerHTML = `
  <header class="container">
    <nav class="navbar">
      <div class="navbar-brand">
        <div class="logo">
          <img src="./src/resources/images/logo.webp" alt="Logo">
        </div>
      </div>
      <div class=" navbar-text">
        <div id="cart-icon">
          <span id="cart-item-count">2</span>
          <span class="fa fa-stack">
            <a href="#"><span class="fa fa-cart-arrow-down fa-2x mini-cart-icon"></span></a>
          </span>
      </div>
    </div>
    </nav>
  </header>


  <main>
    <div class="container">
      <h1 class="mt-3">Build your own box</h1>
      <div class="box-heading">
        <div class="alert alert-info">Select some chocolate! Spots left: <span id="spot-counter">6</span></div>
      </div>
      <div class="row">
        <div class="col">
         <div class="box-stage container">
           <div class="box-header">
             <h2>Boxes</h2>
           </div>
           <ul id="box-with-Spot" class="box-frame my-4 mx-auto row box6">
             <li class="box empty">
              <!-- <img src="./src/resources/images/Lavender.webp" alt="chocolates description">
              <div class="remove-icon" title="Hello, i am a tooltip">
                <span class="fa fa-minus-circle fa-2x"></span>
              </div> -->
             </li>
              <li class="box empty">
             </li>
             <li class="box empty">
            </li>
             <li class="box empty">
            </li>

            <li class="box empty">
            </li>
             <li class="box empty">
            </li>
           </ul>
           <div id="cart-form" class="row align-items-center justify-content-center mb-4 d-none">
             <form action="#" method="post">
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
        <div class="col-lg-4 col-sm-12"></div>
      </div>

      <ul id="chocolates" class="row">
        <li>
          <figure>
            <img src="./src/resources/images/Lavender.webp" alt="chocolates description">
            <div class="add-icon" title="Hello, i am a tooltip">
              <span class="fa fa-plus-circle fa-2x"></span>
            </div>
          </figure>
          <h5>Lavender</h5>
        </li>
      </ul>
    </div>
    
  </main>
  <script src="./src/resources/data/chocolates.js"></script>
`;
}



class WixDefaultCustomElement extends HTMLElement {
  constructor() {
    super();
    console.log(DEBUG_TEXT);
  }

  connectedCallback() {

    let selectedBoxesData = [];
  let boxSize= 12;
  let minQuantity=1;

//some box sizes have minimum quantity that can be ordered
  let quantityInput = document.getElementById('quantity');
      quantityInput.setAttribute('value',minQuantity);
      quantityInput.setAttribute('min',minQuantity);

  let cartForm= (spotLeft) => {
    let form = document.getElementById('cart-form');

        (spotLeft===0)?form.classList.remove('d-none'):form.classList.add('d-none');
  }


  let spotCount = document.getElementById('spot-counter');
      spotCount.innerHTML=boxSize;

  let deleteEmptyBox = (target) => {
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
          spotCount.innerHTML=boxSize;
          cartForm(boxSize);
        }
  }
document.getElementById('resetBox').addEventListener('click',emptyAllBox,false)




  let removeChocolate = (e) => {
    let target = e.currentTarget;
        deleteEmptyBox(target);
        let spotLeft=Number(spotCount.innerHTML)+1;
        spotCount.innerHTML=spotLeft;
        cartForm(spotLeft);

  }//remove any selected  clicked on by the user

  let addChocolateToBox = (e) => {
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

          nextBoxEmptySpot.appendChild(docFrag);
          nextBoxEmptySpot.classList.replace('empty','selected');
      let spotLeft = Number(spotCount.innerHTML)-1;
        spotCount.innerHTML=spotLeft;
        cartForm(spotLeft);
      }else{
        //update the alert that the box is full
      }
  }


//init box empty spots

let boxSpot = document.getElementById('box-with-Spot');
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

//init the chocolates to be selected
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


  }
}
customElements.define('product', WixDefaultCustomElement);