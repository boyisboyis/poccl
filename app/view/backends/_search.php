<div id="admin-search" class='t1'>
  <div id='admin-search-box-search'>
    <div id="front-message">Search By : </div>
    <select id="select-search">
      <option value="contract">Contract Name</option>
      <option value="job">Job No</option>
      <option value="poid">PO No</option>
    </select>
    <input type="search" id="input-search" name="input-search" />
    <button id="search-now">search</button>
  </div>
	<div id="admin-search-box-content">
		
	</div>
	<div id="admin-search-box-alert" style="display: none;">
		<section>
			<h3>Are you sure?</h3>
			<div>
				<button id="confirm-yes">Yes</button>
				<button id="confirm-no">NO</button>
			</div>
		</section>
	</div>
	
	<div id="box-alert" style="display: none;">
	  <div id="alert-box-payment-terms">
	    <h3>Term : <span id="new-payment-terms"></span></h3>
	    <input type="hidden" id="payment-temrs-jid" name="payment-temrs-jid" value=""/>
	    <input type="hidden" id="payment-temrs-id" name="payment-temrs-id" value=""/>
	    <input type="hidden" id="payment-temrs-index" name="payment-temrs-index" value=""/>
	    <div>
	        <p>Description</p>
    	    <select class='payment_description' name="payment-description">

    	    	<?php
    	    		$result = DB::query("SELECT payment_type.Description FROM payment_type")->get();
							for($count = 0; $count < count($result); $count++) {
    	    	?>
      	    	<option value="<?php echo $result[$count]->Description; ?>"><?php echo $result[$count]->Description; ?></option>
						<?php
							}
						?>

      	  </select>
      	  <p>Amount</p>
      	  <div style="padding-right: 19px;">
      	   <input type='radio' class="payment-radio-amount" name="payment-radio-amount" value="price" checked/><input type="text" class="number-only" id='alert-amount-actual-price' name="Amount_Actual_Price" data-type="Amount_Actual_Price" value=""/>
      	  </div>
      	  <p>Amount Percentang</p>
      	  <div style="padding-right: 19px;">
      	   <input type='radio' class="payment-radio-amount" name="payment-radio-amount" value="percentage" /><input class="read-only number-only" type="text" id="alert-amount-actual-percentage" name="Amount_Actual_Percentage" data-type="Amount_Actual_Percentage" value="" readonly/>
      	  </div>
      	  <p>Invoice Date</p>
      	  <div>
      	    <input type="text" name="Payment_date_plan" data-type="Payment_date_plan" value="" class='datepicker' required/>
      	  </div>
	    </div>
	    <div>
	      <button id="update-save-payment-terms">Save</button><button id="update-close-payment-terms">Close</button>
	    </div>

	  </div>
	  <div id="alert-box-guarantee-terms">
	    <h3>Term : <span id="new-guarantee-terms"></span></h3>
	    <input type="hidden" id="guarantee-temrs-jid" name="guarantee-temrs-jid" value=""/>
	    <input type="hidden" id="guarantee-temrs-id" name="guarantee-temrs-id" value=""/>
	    <input type="hidden" id="guarantee-temrs-index" name="guarantee-temrs-index" value=""/>
	    <div>
	        <p>Description</p>
    	    <select class='guarantee_description' name="guarantee-description">

    	      <?php
    	    		$result = DB::query("SELECT guarantee_type.Description FROM guarantee_type")->get();
							for($count = 0; $count < count($result); $count++) {
    	    	?>
      	    	<option value="<?php echo $result[$count]->Description; ?>"><?php echo $result[$count]->Description; ?></option>
						<?php
							}
						?>

      	  </select>
      	  <p>Amount</p>
      	  <div style="padding-right: 19px;">
      	   <input type='radio' class="guarantee-radio-amount" name="payment-radio-amount" value="price" checked/><input id="guarantee-alert-amount-actual-price" type="text" name="Amount_Actual_Price" data-type="Amount_Actual_Price" value="" />
      	  </div>
      	  <p>Amount Percentang</p>
      	  <div style="padding-right: 19px;">
      	    <input type='radio' class="guarantee-radio-amount" name="payment-radio-amount" value="percentage"/><input id="guarantee-alert-amount-actual-percentage" class='read-only' type="text" name="Amount_Actual_Percentage" data-type="Amount_Actual_Percentage" value="" />
      	  </div>
      	  <p>Start Plan</p>
      	  <div>
      	    <input type="text" name="Start_plan" data-type="Start_plan" value="" class='datepicker' />
      	  </div>
      	  <p>Until Plan</p>
      	  <div>
      	    <input type="text" name="until_plan" data-type="until_plan" value="" class='datepicker' />
      	  </div>
	    </div>
	    <div>
	      <button id="update-save-guarantee-terms">Save</button><button id="update-close-guarantee-terms">Close</button>
	    </div>

	  </div>
	</div>
	

	<div id='po-type-clone' style="display: none;">
		<div id="po-description-clone">
			<select id="po-type-select-block">
				<option value=''>None</option>
				<?php 
					$result = DB::query("SELECT po_type.Description FROM po_type")->get();
					$result_count = count($result);
					for($count = 0; $count < $result_count; $count++) {
				?>
					<option value="<?php echo $result[$count]->Description; ?>"><?php echo $result[$count]->Description; ?></option>
				<?php
					}
				?>
			</select>
		</div>
	</div>
	
	
	<div id="admin-checklist" style="display: none;">
		<input type="hidden" id="checklist-jid" name="checklist-jid" value=""/>
		<div>
			
			<div class="header">
				<section>
					<h4 style="display:inline-block;">Has Checklist</h4>
					<div style="display:inline-block; margin-left: 50px;">
						<span class='has-checklist checklist-true' data-value="1">True</span>
						<span style="margin: 0 5px;">/</span>
						<span class='has-checklist checklist-false select' data-value="0">False</span>
					</div>
				</section>
			</div>
			<hr/>
			<div class="section group content">
				<section class="col span_1_of_2">
					<h4>Payment</h4>
					<div class='checklist-content nano'>
						<div class='nano-content payment_checklist'>
						</div>
					</div>
				</section>
				<section class="col span_1_of_2">
					<h4>Guarantee</h4>
					<div class='checklist-content nano'>
						<div class='nano-content guarantee_checklist'>

						</div>
					</div>
				</section>
			</div>
			<div>
				<button id="checklist-close" style="position: relative; top: 0; left: 0; width: 100%; height: 50px; margin: 0; color: #FFFFFF; font-size: 20px;">Close</button>
			</div>
		</div>
	</div>
</div>

