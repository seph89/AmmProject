<?php
session_start();
$page = 'carrello.php';
define('ROOT',dirname(__FILE__));
define('DS',DIRECTORY_SEPARATOR);
require_once ROOT.DS."config".DS."db.php";
require_once ROOT.DS."config".DS."conf.php";


if (isset($_GET['add'])){
    $quantity = mysql_query('SELECT product_id, product_quantity FROM mvc_products WHERE product_id='.mysql_real_escape_string((int)$_GET['add']));
    while ($quantity_row = mysql_fetch_array($quantity)){
        if ($quantity_row['product_quantity']!=$_SESSION['cart_'.(int)$_GET['add']]){
            $_SESSION['cart_'.(int)$_GET['add']]+= '1';
        }
    }
    header('Location: '.$page);
}
if (isset($_GET['remove'])){
    $_SESSION['cart_'.(int)$_GET['remove']]--;
    header('Location:'.$page);
}

if (isset($_GET['delete'])){
    $_SESSION['cart_'.(int)$_GET['delete']]='0';
    header('Location:'.$page);
}


function products(){
    $get = mysql_query('SELECT product_id, product_name, product_description, product_price 
        FROM mvc_products WHERE product_quantity > 0 ORDER by product_id');
    if(mysql_num_rows($get) == 0){
        echo "Non ci sono prodotti da mostrare";
    } else {
        while ($get_row = mysql_fetch_assoc($get)) {
            echo '<p>'.$get_row['product_id'].')&nbsp;&nbsp;'.$get_row['product_name']
                .'<br />'.$get_row['product_description'].'<br /> &euro;'.number_format($get_row['product_price'], 2).'
                    <a href="admin_carrello.php?add='.$get_row['product_id'].'">Aggiungi</a></p>';
        }
    }
}    

function paypal_items(){
    $num = 0;
    foreach($_SESSION as $name => $value){
        if ($value!=0){
            if (substr($name, 0, 5)=='cart_') {
                $id = substr($name, 5, strlen($name)-5);
                $get = mysql_query('SELECT product_id, product_name, product_price, product_ship FROM mvc_products 
                                    WHERE product_id='.mysql_real_escape_string((int)$id));
                while ($get_row = mysql_fetch_assoc($get)){
                    $num++;
                    echo '<input type="hidden" name="item_number_'.$num.'" value="'.$id.'">';
                    echo '<input type="hidden" name="item_name_'.$num.'" value="'.$get_row['product_name'].'">';
                    echo '<input type="hidden" name="amount_'.$num.'" value="'.$get_row['product_price'].'">';
                    echo '<input type="hidden" name="shipping_'.$num.'" value="'.$get_row['product_ship'].'">';
                    echo '<input type="hidden" name="shipping2_'.$num.'" value="'.$get_row['product_ship'].'">';
                    echo '<input type="hidden" name="quantity_'.$num.'" value="'.$value.'">';

                }
            } 
        }
    }
}

function cart(){
    foreach($_SESSION as $name => $value){
        if ($value>0) {
            if(substr($name, 0, 5) == 'cart_'){
              $id = substr($name, 5, (strlen($name)-5));
              $get = mysql_query('SELECT product_id, product_name, product_price FROM mvc_products WHERE product_id='.mysql_real_escape_string((int)$id));
              while($get_row = mysql_fetch_assoc($get)){
                  
                  $sub = $get_row['product_price']*$value;
                  echo $get_row['product_name'].' x '.$value.' @  &euro;'.number_format($get_row['product_price'], 2).' = 
                      &euro;'.number_format($sub, 2).'<a href="admin_carrello.php?remove='.$id.'"</a> [-] <a href="admin_carrello.php?add='.$id.'"> [+]</a> <a href="admin_carrello.php?delete='.$id.'"> [Delete]  </a> <br /> ';
              }
              
            }
            if(empty($total)){
                
                if(empty($sub)){
                    //non fare niente
                
                }else{
                //se il totale è indefinito, questo lo definisce
                //con almeno un valore
                $total = $sub;
                }
            //ora che è stato definito
            }else{
            //combina il totale di $sub per ogni riga
            $total += $sub;
            }
    
        }
    } if ($total==0){
        echo "Il tuo carrello e' vuoto.";
    }else{
        //Mostro a video il totale del carrello
        echo '<p>Totale : &euro;'.number_format($total, 2).'</p>';
        ?>

        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="upload" value="1">
        <input type="hidden" name="business" value="iosonouncane@shop.com">
        <?php paypal_items(); ?>
        <input type="hidden" name="currency_code" value="EUR">
        <input type="hidden" name="amount" value="<?php echo $total; ?>">
        <input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but03.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
        </form>
        <?php
    }
}
?>
