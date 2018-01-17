


<?php session_start() ?>
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
 
        <div class="navbar-header">
            <a class="navbar-brand" href="home_user.php">Etusivu</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                
                <li>
                    <a href="cart.php">
                        <?php
                         //laskee ostoskorin
                        if(isset($_SESSION['cart_items'])){
							$cart_count=count($_SESSION['cart_items']);
                        ?>
                        Cart <span class="badge" id="comparison-count"><?php echo $cart_count; ?></span>
						<?php }?>
                    </a>
					 
                </li>
				
            </ul>
			
    </div>
	<a href="logout.php">
		Kirjaudu ulos</a>
        </div> 
</div>

