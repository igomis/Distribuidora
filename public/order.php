<h3><img src='img/cesta.png' alt='Cesta' width='24' height='21'>Comanda</h3>
<hr />
<?php if (empty($_SESSION['order'])) echo "<p>Buïda</p>";
      else {
          foreach($_SESSION['order'] as $key => $amount) {
              $product = loadProduct($key);
              echo "<p> $product->name - $amount </p>";

          }    ?>
              <form id='vaciar' action='deleteOrder.php' method='post'>
                  <input type='submit' name='empty' class='boton' value='Buidar'  />
              </form>
              <form id='comprar' action='processOrder.php' method='post'>
                  <input type='submit' name='buy' class='boton' value='Processar'  />
              </form>
    <?php } ?>
