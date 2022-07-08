var productType = document.querySelector("#productType");
function onChangeSelect() {
  var sizeInput = document.querySelector(".size-input");
  var weightInput = document.querySelector(".weight-input");
  var dimensionInput = document.querySelector(".dimension-input");
  switch (productType) {
    case "dvd":
      weightInput.style.display = "none";
      dimensionInput.forEach((element) => {
        element.style.display = "none";
      });
      break;
    case "book":
      sizeInput.style.display = "none";
      dimensionInput.forEach((element) => {
        element.style.display = "none";
      });
      break;
    case "furniture":
      sizeInput.style.display = "none";
      weightInput.style.display = "none";
      break;
  }
}
productType.addEventListener("change", onChangeSelect);
