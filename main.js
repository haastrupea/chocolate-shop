
xProductBrowser("categoriesPerRow=3","views=grid(20,3) list(60) table(60)","categoryView=grid","searchView=list","id=my-store-13470050");

function clearLoader(){
  document.body.classList.remove('loading-overlay');
  let overLay = document.querySelector('.overlay');
      overLay.parentElement.removeChild(overLay);
}

function startApp (){
  Ecwid.init();
Ecwid.OnPageLoaded.add(function() {
  
document.querySelectorAll('.grid-product').forEach(elm=>{

  elm.querySelectorAll('a').forEach(lin=>{
    let patern = /p\/(\d+)\//;
    let productId = lin.href.match(patern)[1];

          if(lin.href.includes('56350146')){
          //rewrite the link
        lin.href = `./cart.php#${productId}`;
          }// only work on product link;
  });



   let link = elm.querySelector('a');
   
   if(link.href.includes('cart')){
        let cloneG = elm.firstElementChild.cloneNode(true);
            elm.innerHTML="";// clear initial content
            elm.appendChild(cloneG);// replace with cloned content

        //stop default click event on this product

    elm.querySelector('.grid-product__wrap').addEventListener("click", function (event) {
          event.stopPropagation();
         }, true);

         
        }// only clone products that are not gift cards;

        //make the button into a link
      let btn = elm.querySelector('button');
          if(btn){
            let a = document.createElement("a")
                a.href = link.href;
            let cloneBtn = btn.cloneNode(true);
                // console.log(cloneBtn,'clone btn')
                a.appendChild(cloneBtn);
            let btnParent = btn.parentElement;
              // console.log(btnParent,'button Parent')
                btnParent.innerHTML = "";
                btnParent.appendChild(a)
          }

})

  Ecwid.OnAPILoaded.add(function(){
    
  //remove loader
    clearLoader();
  });

})}

window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
  if ( historyTraversal ) {
    // Handle page restore.
    window.location.reload();
    // startApp()
    // return
  }

});


startApp()
