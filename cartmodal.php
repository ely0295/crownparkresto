<script type="text/javascript">
function opencart(prod_code,prod_img,prod_desc,prod_price,prod_pcs) {
	 document.getElementById("prod_code").value = prod_code;
	  document.getElementById("prod_img").src = "product_img/"+prod_img;
	document.getElementById("prod_desc").value = prod_desc;
	document.getElementById("prod_price").value = prod_price;
	document.getElementById("prod_pcs").innerHTML = prod_pcs;
	
              $("#cartmodal").modal();
 }
function quantity(opperand,max){
	if(opperand == 'minus'){
		if(parseInt(document.getElementById('qty').value) <= 1){ return 0;}
		document.getElementById('qty').value = parseInt(document.getElementById('qty').value) -1;
	}
	if(opperand == 'add'){
		if(parseInt(document.getElementById('qty').value) >= parseInt(max)){ return 0;}
		document.getElementById('qty').value = parseInt(document.getElementById('qty').value)  + 1;
	}
}
</script>
<div class="modal section-padding-100" id="cartmodal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"<i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</h5>
                  </div>
				  <form id="regForm" action="addtocart.php" method = "post">
                  <div class="modal-body">
				    <div class="form-group row">
						<div class="col-xs-6">
						<img id = "prod_img" style="width:370px;height:300px;"><br>
						<small class="text-muted">Serving Size: Good for 1 person(s)</small>
                             <p class="dish-ratings" style="color:darkred;"><u>5.0</u> &#9733;&#9733;&#9733;&#9733;&#9733; |  <u> 100 Ratings</u> | <a href=""><u>View Reviews </u></a> </p>
						</div>
						<div class="col-xs-6">
						<input type="hidden"  class="form-control" id="prod_code" name="prod_code" >
						<div class="form-group">
						  <label for="usrname"><span class="glyphicon glyphicon-user"></span> Product Description</label>
						  <input type="Text" disabled class="form-control" id="prod_desc" name="prod_desc"  placeholder="Enter Description">
						</div>
						<div class="form-group">
						  <label for="usrname"><span class="glyphicon glyphicon-user"></span> Price</label>
						  <input type="number" disabled class="form-control" id="prod_price" name="prod_price" placeholder="Enter Price">
						</div>
						<div class="form-group " style = "text-align:center;">
						<label for="usrname"><span class="glyphicon glyphicon-user"></span> Available Stock: <b id = "prod_pcs"></b> Pcs</label><br>
						  
						</div>
						<div class="form-group " style = "text-align:center;">
						<label for="usrname"><span class="glyphicon glyphicon-user"></span> Quantity</label><br>
						  <div class="btn-group">
								
							  <button type="button" class="btn btn-danger" onclick = "quantity('minus',document.getElementById('prod_pcs').innerHTML)">-</button>
							  <input type="text" class="btn btn-default" id = 'qty' name = "prod_quantity" value="1">
							  <button type="button" class="btn btn-danger" onclick = "quantity('add',document.getElementById('prod_pcs').innerHTML)">+</button>
							</div>
						</div>
						
						  
						</div>
					  
					</div>
                  </div>
                  <div class="modal-footer">
				  <?php 
						if(!(isset($_SESSION['signed_in'])) ){
							?>
							<button type="button" onclick = "alert('Please Login First! Thank you');" class="cursor-point btn btn-danger"><span class="glyphicon glyphicon-ok"></span> Add to Cart 
							
						  </button>
							<?php
						}else{
							?>
							<button type="submit" class="cursor-point btn btn-danger"><span class="glyphicon glyphicon-ok"></span> Add to Cart </button>
							<?php
						}

						?>
                     <button type="button" class="cursor-point btn btn-danger" data-dismiss="modal">CLOSE</button>
                    
                  </div>
				  </form>
                </div>
              </div>
        </div>