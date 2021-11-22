
xProductBrowser("categoriesPerRow=3","views=grid(20,3) list(60) table(60)","categoryView=grid","searchView=list","id=my-store-13470050");

function clearLoader(){
  document.body.classList.remove('loading-overlay');
  let overLay = document.querySelector('.overlay');
      overLay.parentElement.removeChild(overLay);
}

Ecwid.init();

const buildBoxCategoryId = 56350146

Ecwid.OnPageSwitch.add(function(page) {
  const {type, productId, categoryId } = page
  
  console.log(categoryId, "product's category")
  if (type === "PRODUCT" && categoryId === buildBoxCategoryId) {
    window.location.href = `cart.html#${productId}`
      return false
  }
})

clearLoader();