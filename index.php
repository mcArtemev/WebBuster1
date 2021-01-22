<?php
$file_json = 'product.json';
$get_content_json = file_get_contents($file_json);
$decodeJsonToArray = json_decode($get_content_json,true);
$product = $decodeJsonToArray['product'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebBuster</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500&display=swap" rel="stylesheet">
</head>
<body>
    <section>
        <div class="wrapper">
            <div class="grid">
           <?php foreach ($product as $key => $value) { 
            ?>
            
                <div class="grid-item grid-item-catalog">
                    <div class="bg-white">
                        <div class="thumb">
                            <img src="<?=$value["img"];?>" alt="chair">
                        </div>
                        <p class="grid-title"><?=$value["name"];?></p>
                        <p class="grid-price"><?=$value["price"];?> ₽</p>
                        <a class="grid-btn" onclick="callback_form('block');">Купить</a>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </section>
    
<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="form.js"></script>
<script src="ajax.js"></script>
<script>
      
</script>
</body>
</html>