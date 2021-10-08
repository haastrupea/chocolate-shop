
xProductBrowser("categoriesPerRow=3","views=grid(20,3) list(60) table(60)","categoryView=grid","searchView=list","id=my-store-13470050");

function clearLoader(){
  document.body.classList.remove('loading-overlay');
  let overLay = document.querySelector('.overlay');
      overLay.parentElement.removeChild(overLay);
}

Ecwid.init();

Ecwid.OnPageSwitch.add(function(page) {
  const {type, productId } = page
  if (type === "PRODUCT") {
    window.location.href = `cart.php#${productId}`
      return false
  }
})

clearLoader();