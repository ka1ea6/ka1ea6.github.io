<?php include './php/config/database.php' ?>

<?php 
  $sql = 'SELECT * FROM item_list ORDER BY timestamp';
  $result = mysqli_query($conn, $sql);
  
  $itemList = mysqli_fetch_all($result, MYSQLI_ASSOC);

  if(isset($_POST['submit'])){
    if(!empty($_POST['checker'])) {
      foreach($_POST['checker'] as $selected) {
        $delSku =explode(' ',$selected)[0];
        $delType =explode(' ',$selected)[1];
        
        $sql = "DELETE FROM item_list WHERE sku = '" . $delSku . "'";
        switch($delType){
          case 'dvd':
            $sql2 = "DELETE FROM dvd WHERE sku = '".$delSku."'";
          case 'furniture':
            $sql2 = "DELETE FROM furniture WHERE sku = '". $delSku . "'";
          case 'book':
            $sql2 = "DELETE FROM books WHERE sku = '". $delSku . "'";
        }
        if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
          header('Location: index.php');
        }
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
      <div class="nav-title"><h1>Product List</h1></div>
      <div class="product-actions">
        <ul>
          <li>
            <a href="./addproduct.php">
              <button>Add</button>
            </a>
          </li>
          <li>
            <button type="submit" form="item-list-form" value="send" name="submit" id="delete-product-btn">Mass Delete</button>
          </li>
        </ul>
      </div>
    </nav>
    <?php if(empty($itemList)): ?>
      <p class="no-item">NO items</p>
    <?php endif; ?>
    <section class="products-list container">
    <form  id="item-list-form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
      <?php foreach($itemList as $item): ?>
        <?php 
            if($item['type'] === 'dvd'){
              $sqldvd = "SELECT * FROM dvd WHERE sku = '".$item['sku']."'";
              $resultdvd = mysqli_query($conn, $sqldvd);
              $dvdSize = mysqli_fetch_all($resultdvd,MYSQLI_ASSOC );
              $item['attribute'] = 'Size: ' . $dvdSize[0]['size'];
            } 
            else if($item['type'] === 'book'){
              $sqldvd = "SELECT * FROM books WHERE sku = '".$item['sku']."'";
              $resultdvd = mysqli_query($conn, $sqldvd);
              $dvdSize = mysqli_fetch_all($resultdvd,MYSQLI_ASSOC );
              $item['attribute'] = 'Weight(KG): ' . $dvdSize[0]['weight'] . " KG";
            } 
            else if($item['type'] === 'furniture'){
              $sqldvd = "SELECT * FROM furniture WHERE sku = '".$item['sku']."'";
              $resultdvd = mysqli_query($conn, $sqldvd);
              $dvdSize = mysqli_fetch_all($resultdvd,MYSQLI_ASSOC );
              $item['attribute'] = 'Dimensions: ' . $dvdSize[0]['height'] . ' x ' . $dvdSize[0]['width'] . ' x ' . $dvdSize[0]['length'] ;
            } 
        ?>
        <div class="product">

            <input
              type="checkbox"
              name="checker[]"
              value="<?= $item['sku'] . ' ' . $item['type']?>"
              class="delete-checkbox"
            />
            <p class="sku"><?= $item['sku'] ?></p>
            <p class="name"><?= $item['name'] ?></p>
            <p class="price"><?= $item['price'] . ' $' ?></p>
            <p class="attribute"><?= $item['attribute'] ?></p>
        </div>
          <?php endforeach; ?>
        </form>
    </section>
  </body>
</html>
