<?php include './php/config/database.php' ?>

<?php 

  $sku = $name = $price = $type = '';

  if(isset($_POST['submit'])){
    $sku = filter_input(INPUT_POST, 'sku',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = filter_input(INPUT_POST, 'name',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_input(INPUT_POST, 'price',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $type = filter_input(INPUT_POST, 'productType',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if($type == 'dvd'){
      $size =  filter_input(INPUT_POST, 'size',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $sql = "INSERT INTO item_list(sku,name,price,type) VALUES('$sku','$name','$price','$type')";
      $sqlDvd = "INSERT INTO dvd(sku,size) VALUES('$sku','$size')";
      if(mysqli_query($conn, $sql) && mysqli_query($conn, $sqlDvd)){
        header('Location: ./index.php');
      }else{
        echo 'Error' . mysqli_error($conn);
      }
    }
    else if($type == 'book'){
      $weight =  filter_input(INPUT_POST, 'weight',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $sql = "INSERT INTO item_list(sku,name,price,type) VALUES('$sku','$name','$price','$type')";
      $sqlBook = "INSERT INTO books(sku,weight) VALUES('$sku','$weight')";
      if(mysqli_query($conn, $sql)  && mysqli_query($conn, $sqlBook)){
        header('Location: index.php');
      }
    }
    else if($type == 'furniture'){
      $length =  filter_input(INPUT_POST, 'length',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $width =  filter_input(INPUT_POST, 'width',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $height =  filter_input(INPUT_POST, 'height',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $sql = "INSERT INTO item_list(sku,name,price,type) VALUES('$sku','$name','$price','$type')";
      $sqlFurniture = "INSERT INTO furniture(sku,length,width,height) VALUES('$sku','$length','$width','$height')";
      if(mysqli_query($conn, $sql) && mysqli_query($conn, $sqlFurniture)){
        header('Location: index.php');
      }
    }
  }


?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <nav class="navbar container">
      <div class="nav-title"><h1>Product Add</h1></div>
      <div class="product-actions">
        <ul>
          <li>
              <button type="submit" name ="submit"  value="send" form="product_form">Save</button>
          </li>
          <li>
            <a href="./index.php">
              <button id="delete-product-btn">Cancel</button>
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" id="product_form" class="container" method="POST">
      <div class="form-item">
        <label for="sku" >SKU </label>
        <input type="text" name="sku" id="sku" required />
      </div>
      <div class="form-item">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required />
      </div>
      <div class="form-item">
        <label for="price">Price($)</label>
        <input type="text" name="price" id="price" required />
      </div>
      <div class="form-item">
        <label for="productType">Type Switcher</label>
        <select name="productType" id="productType">
          <option value="dvd">DVD</option>
          <option value="book">Book</option>
          <option value="furniture">Furniture</option>
        </select>
      </div>
      <div class="form-item size-input">
        <label for="#size">Size (MB)</label>
        <input type="number" name="size" id="size" />
      </div>
      <div class="form-item weight-input">
        <label for="#weight">Weight (KG)</label>
        <input type="number" name="weight" id="weight" />
      </div>
      <div class="form-item dimension-input">
        <label for="#height">Height (CM)</label>
        <input type="number" name="height" id="height" />
      </div>
      <div class="form-item dimension-input">
        <label for="#width">Width (CM)</label>
        <input type="number" name="width" id="width" />
      </div>
      <div class="form-item dimension-input">
        <label for="#length">Length (CM)</label>
        <input type="number" name="length" id="length" />
      </div>
    </form>
    <script defer>
      var productType = document.querySelector("#productType");
      function onChangeSelect() {
        var sizeInput = document.querySelector(".size-input");
        var weightInput = document.querySelector(".weight-input");
        var dimensionInput = document.querySelectorAll(".dimension-input");
        switch (productType.value) {
          case "dvd":
            sizeInput.style.display = "flex";
            weightInput.style.display = "none";
            dimensionInput.forEach((element) => {
              element.style.display = "none";
            });
            break;
          case "book":
            weightInput.style.display = "flex";
            sizeInput.style.display = "none";
            dimensionInput.forEach((element) => {
              element.style.display = "none";
              element.setAttribute(required);
            });
            break;
          case "furniture":
            sizeInput.style.display = "none";
            weightInput.style.display = "none";
            dimensionInput.forEach((element) => {
              element.style.display = "flex";
            });
            break;
        }
      }
      productType.addEventListener("change", onChangeSelect);
    </script>
  </body>
</html>
