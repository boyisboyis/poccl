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
    	      <option value="">-</option>
      	    <option value="Milestone Payment">Milestone Payment</option>
      	    <option value="Retention Payment">Retention Payment</option>
      	    <option value="Other Payment">Other Payment</option>
      	  </select>
      	  <p>Amount</p>
      	  <div>
      	   <input type="text" name="Amount_Actual_Price" data-type="Amount_Actual_Price" value="" />
      	  </div>
      	  <p>Amount Percentang</p>
      	  <div>
      	    <input type="text" name="Amount_Actual_Percentage" data-type="Amount_Actual_Percentage" value="" />
      	  </div>
      	  <p>Payment Date Plan</p>
      	  <div>
      	    <input type="text" name="Payment_date_plan" data-type="Payment_date_plan" value="" class='datepicker' />
      	  </div>
	    </div>
	    <div>
	      <button id="update-save-payment-terms">Save</button><button id="update-close-payment-terms">Close</button>
	    </div>

	  </div>
	</div>
	
	<div id='search-clone' style="display: none;">
	   <div id="payment_description_clone">
	     
	   </div>
	  <!--<div id="payment_description_clone">
	      <select class='payment_description'>
	      <option value="">-</option>
  	    <option value="Milestone Payment">Milestone Payment</option>
  	    <option value="Retention Payment">Retention Payment</option>
  	    <option value="Other Payment">Other Payment</option>
  	  </select>-->
	  </div>
	</div>
</div>
<!-- <div id="admin-search" class='t1'>
  <div id='admin-search-box-search'>
    <div id="front-message">Search By : </div>
    <select id="select-search">
      <option value="contract">Contract Name</option>
      <option value="job">Job No</option>
      <option value="poid">PO No</option>
    </select>
    <input type="search" id="input-search" name="input-search" />
    <button id="search-now">search</button>
		<button class="admin-search-delete" style="margin-right: 200px;">delete test</button>
  </div>
  <table id="admin-search-box-result">
    <thead>
      <tr>
        <th>JID</th>
        <th>Contactor Name</th>
        <th>Po No</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      
    </tbody>
  </table>
</div> -->
