<?php
  
  if(Session::getSessionUID() === null){
    Redirect::to("login");
  }

?>
<!DOCTYPE html>
<html>

<head>
  <title>Admin</title>
  <link rel="stylesheet" href="maincss" type="text/css" />
  <link rel="stylesheet" href="fontcss" type="text/css" />
  <link rel="stylesheet" href="admincss" type="text/css" />
  <script type="text/javascript" src="jquery"></script>
  <script type="text/javascript" src="adminjs"></script>
</head>

<body>
  <div id="wrapper-admin">
    <nav id="content-nav">
      <ol>
        <li><a href="#add" class='sub-menu'><i class="fa fa-plus"></i>Add</a>
        </li>
        <li><a href="#search" class='sub-menu'><i class="fa fa-search"></i>Search</a>
        </li>
        <li><a href="#payment" class='sub-menu'>Payment Status</a>
        </li>
        <li><a href="#guarantee" class='sub-menu'>Guarantee Status</a>
        </li>
      </ol>
    </nav>
    <div id="content-article">
      <nav id="wrap-nav">
        <ul>
          <li><i class="fa fa-power-off"></i><a href="logout">Logout</a>
          </li>
        </ul>
      </nav>
      <header id="wrap-header">
        <section>
          <h1>Purchase Order Admin Controller</h1>
        </section>
      </header>

      <div id="wrap-content">
        <div id="admin-add" class='t0'>
          <form id="form_add" name="form_add" method="POST" action="addPurchase">
            <button type="submit" name="submit"><i class="fa fa-plus">Add</i></button>
            <h2>New Purchase Order</h2>
            <div>
              <label for="">Job No : </label>
              <input type="text" name="job_no" />
            </div>
            <hr>
            <div style="float: left; width: 50%;">
              <div class='table'>
                <h3>Project Summary</h3>
                <div class='table-row'>
                  <div class='table-cell'>Contractor Name</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="contractor_name"  />
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Project Name</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="project_name" />
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="project_name" value="none" />
                    <label for="">None</label>
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Project Location</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="project_location" />
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="project_location" value="none" />
                    <label for="">None</label>
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Project Owner's Name</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="project_owner_name" />
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="project_owner_name" value="none" />
                    <label for="">None</label>
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Secrecy Agreement</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="radio" name="secrecy_agreement" value="true" />
                    <label for="" class="fa fa-check"></label>
                    <input type="radio" name="secrecy_agreement" value="false" />
                    <label for="" class='fa fa-times'></label>
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="secrecy_agreement" value="none" />
                    <label for="">None</label>
                  </div>
                </div>
              </div>
              <div class="table">
                <div class='table-row'>
                  <h3>Working Remark</h3>
                  <div class='table-row'>
                    <div class='table-cell'>Start Date</div>
                    <div class='table-cell colon'></div>
                    <div class='table-cell'>
                      <input type="date" name="start_date" />
                    </div>
                  </div>
                  <div class='table-row'>
                    <div class='table-cell'>Complete Date</div>
                    <div class='table-cell colon'></div>
                    <div class='table-cell'>
                      <input type="date" name="complete_date" />
                    </div>
                    <div class='table-cell'>
                      <input type="checkbox" name="complete_date" value="none" />
                      <label for="">None</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div style="float: left; width: 50%;">
              <div class='table'>
                <h3>Po Info.</h3>
                <div class='table-row'>
                  <div class='table-cell'>Po No</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="po_no" />
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="po_no" value="none" />
                    <label for="">None</label>
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Po Date</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="po_date" />
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="po_date" value="none" />
                    <label for="">None</label>
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Po Type</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <select name="po_type">
                      <option value="">---</option>
                    </select>
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="po_type" value="none" />
                    <label for="">None</label>
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Po Amount</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="po_amount" />
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'></div>
                  <div class='table-cell'></div>
                  <div id="show_foreign_currency" class='table-cell' style="cursor: pointer; color: #ed8151">
                    <i class="fa fa-plus"></i> Add Foreign Currency
                    <input id="add_foreign_currency_checkbox" type="hidden" name="add_foreign_currency_checkbox" value="hide" />
                  </div>
                </div>
                <div class='table-row foreign_currency' style="display:none;">
                  <div class='table-cell' style="text-align: right;">Value</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" id="foreign_currency_value" name="foreign_currency_value" />
                  </div>
                </div>
                <div class='table-row foreign_currency' style="display:none;">
                  <div class='table-cell' style="text-align: right;">Type</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" id="foreign_currency_type" name="foreign_currency_type" />
                  </div>
                  <div class='table-cell'>
                    <label for="foreign_currency_rate">Rate : </label>
                    <input type="text" id="foreign_currency_rate" name="foreign_currency_rate" />
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Goveming Law</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="goveming_law" />
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="goveming_law" value="none" />
                    <label for="">None</label>
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Credit Term</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="credit_term" />
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="credit_term" value="none" />
                    <label for="">None</label>
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Late Payment Financial Change</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="radio" name="late_payment" value="yes" />
                    <label for="" class="fa fa-check"></label>
                    <input type="radio" name="late_payment" value="no" />
                    <label for="" class="fa fa-times"></label>
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="late_payment" value="none" />
                    <label for="">None</label>
                  </div>
                </div>
              </div>
            </div>
            <div class='clearfix'></div>
            <hr>
            <div>
              <div style="float: left; width: 50%;">
                <h3><input type="checkbox" id="check-payment-terms"  name="payment_terms_checkbox" value="check" />Payments</h3>
                <div id='show-payment-terms' style="display:none;">
                  <div id="list-payment-terms">
                    <div class='table'>
                      <ol class='table-row'>
                        <li class='table-cell'></li>
                        <li class='table-cell'>Description</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <select name="payment_terms[0][payment_terms_select]">
                            <option value="">----</option>
                            <option value="Advance Payment">Advance Payment</option>
                          </select>
                        </li>
                      </ol>
                      <ol class='table-row'>
                        <li class='table-cell'></li>
                        <li class='table-cell'>Term</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <input type="hidden" name="payment_terms[0][payment_term]" value="1" />
                          <input type="text" class="payment_term" disabled="disabled" value="1" />
                        </li>
                      </ol>
                      <ol class='table-row'>
                        <li class='table-cell'>
                          <input type="radio" class='payment_amount' name="payment_terms[0][payment_terms_amount_select]" checked='checked' />
                        </li>
                        <li class='table-cell'>Amount</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <input type="text" class='payment_amount_value' name="payment_terms[0][payment_terms_amount_thb]" /> THB</li>
                      </ol>
                      <ol class='table-row'>
                        <li class='table-cell'>
                          <input type="radio" class='payment_amount' name="payment_terms[0][payment_terms_amount_select]" />
                        </li>
                        <li class='table-cell'>Amount</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <input type="text" class='payment_amount_value' name="payment_terms[0][payment_terms_amount_percentage]" disabled='disabled' /> %</li>
                      </ol>
                      <ol class='table-row'>
                        <li class="table-cell"></li>
                        <li class='table-cell'>Payment Date Plan</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <input type="date" name="payment_terms[0][payment_terms_date_plan]" />
                        </li>
                      </ol>
                    </div>
                  </div>
                  <p id='add-payment-terms' style="color: #ed8151; cursor: pointer;"> <i class="fa fa-plus"></i> Add Payment Terms.</p>
                </div>
              </div>
              <div style="float: left; width: 50%;">
                <h3><input type="checkbox" id="check-bank-guarantee" name="bank_guarantee_checkbox" value="check" />Bank Guarantee</h3>
                <div id='show-bank-guarantee' style='display: none;'>
                  <div id="list-bank-guarantee">
                    <div class='table'>
                      <ol class='table-row'>
                        <li class='table-cell'></li>
                        <li class='table-cell'>Description</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <select name="bank_guarantee[0][bank_guarantee_select]">
                            <option value="">----</option>
                            <option value="Advance Guarantee">Advance Guarantee</option>
                          </select>
                        </li>
                      </ol>
                      <ol class='table-row'>
                        <li class='table-cell'></li>
                        <li class='table-cell'>Term</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <input type="hidden" name="bank_guarantee[0][bank_guarantee_term]" value="1" />
                          <input type="text" class="bank_guarantee_term" disabled="disabled" value="1" />
                        </li>
                      </ol>
                      <ol class='table-row'>
                        <li class='table-cell'>
                          <input type="radio" class='bank_guarantee' name="bank_guarantee[0][bank_guarantee_amount_select]" checked='checked' />
                        </li>
                        <li class='table-cell'>Amount</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <input type="text" class='bank_guarantee_value'  name="bank_guarantee[0][bank_guarantee_amount_thb]" /> THB</li>
                      </ol>
                      <ol class='table-row'>
                        <li class='table-cell'>
                          <input type="radio" class='bank_guarantee' name="bank_guarantee[0][bank_guarantee_amount_select]" />
                        </li>
                        <li class='table-cell'>Amount</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <input type="text" class='bank_guarantee_value' name="bank_guarantee[0][bank_guarantee_amount_percentage]" disabled='disabled' /> %</li>
                      </ol>
                      <ol class='table-row'>
                        <li class='table-cell'>
                          <input type="radio" class='bank_guarantee' name="bank_guarantee[0][bank_guarantee_amount_select]" />
                        </li>
                        <li class='table-cell'>Amount</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>None</li>
                      </ol>
                      <ol class='table-row'>
                        <li class="table-cell"></li>
                        <li class='table-cell'>Start Plan</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <input type="date" name="bank_guarantee[0][bank_guarantee_start_date]" />
                        </li>
                      </ol>
                      <ol class='table-row'>
                        <li class="table-cell"></li>
                        <li class='table-cell'>Until Plan</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <input type="date" name="bank_guarantee[0][bank_guarantee_until_date]" />
                        </li>
                      </ol>
                    </div>
                  </div>
                  <p id="add-bank-guarantee"> + Add Bank Guarantee.</p>
                </div>
              </div>
            </div>
          </form>
          <div id="clone-payment-terms" style='display: none;'>
            <div class='table'>
              <ol class='table-row'>
                <li class='table-cell'></li>
                <li class='table-cell'>Description</li>
                <li class='table-cell colon'></li>
                <li class='table-cell'>
                  <select name="payment_terms[numbers][payment_terms_select]">
                    <option value="">----</option>
                  </select>
                </li>
              </ol>
              <ol class='table-row'>
                <li class='table-cell'></li>
                <li class='table-cell'>Term</li>
                <li class='table-cell colon'></li>
                <li class='table-cell' style="text-decoration: underline;">
                  <input type="hidden" name="payment_terms[numbers][payment_term]" value="next_number" />
                  <input type="text" class="payment_term" disabled="disabled" value="next_number" />
                </li>
              </ol>
              <ol class='table-row'>
                <li class='table-cell'>
                  <input type="radio" class='payment_amount'  name="payment_terms[numbers][payment_terms_amount_select]" checked='checked' />
                </li>
                <li class='table-cell'>Amount</li>
                <li class='table-cell colon'></li>
                <li class='table-cell'>
                  <input type="text" class='payment_amount_value' name="payment_terms[numbers][payment_terms_amount_thb]" /> THB</li>
              </ol>
              <ol class='table-row'>
                <li class='table-cell'>
                  <input type="radio" class='payment_amount' name="payment_terms[numbers][payment_terms_amount_select]" />
                </li>
                <li class='table-cell'>Amount</li>
                <li class='table-cell colon'></li>
                <li class='table-cell'>
                  <input type="text" class='payment_amount_value' name="payment_terms[numbers][payment_terms_amount_percentage]" disabled='disabled' /> %</li>
              </ol>
              <ol class='table-row'>
                <li class="table-cell"></li>
                <li class='table-cell'>Payment Date Plan</li>
                <li class='table-cell colon'></li>
                <li class='table-cell'>
                  <input type="date" name="payment_terms[numbers][payment_terms_date_plan]" />
                </li>
              </ol>
            </div>
          </div>
          <div id="clone-bank-guarantee" style='display: none;'>
            <div class='table'>
              <ol class='table-row'>
                <li class='table-cell'></li>
                <li class='table-cell'>Description</li>
                <li class='table-cell colon'></li>
                <li class='table-cell'>
                  <select name="bank_guarantee[numbers][bank_guarantee_select]">
                    <option value="">----</option>
                  </select>
                </li>
              </ol>
              <ol class='table-row'>
                <li class='table-cell'></li>
                <li class='table-cell'>Term</li>
                <li class='table-cell colon'></li>
                <li class='table-cell' style="text-decoration: underline;">
                  <input type="hidden" name="bank_guarantee[numbers][bank_guarantee_term]" value="next_number" />
                  <input type="text" class="bank_guarantee_term" disabled="disabled" value="next_number" />
                </li>
              </ol>
              <ol class='table-row'>
                <li class='table-cell'>
                  <input type="radio" class='bank_guarantee' name="bank_guarantee[numbers][bank_guarantee_amount_select]" checked='checked' />
                </li>
                <li class='table-cell'>Amount</li>
                <li class='table-cell colon'></li>
                <li class='table-cell'>
                  <input type="text" class='bank_guarantee_value' name="bank_guarantee[numbers][bank_guarantee_amount_thb]" /> THB</li>
              </ol>
              <ol class='table-row'>
                <li class='table-cell'>
                  <input type="radio" class='bank_guarantee' name="bank_guarantee[numbers][bank_guarantee_amount_select]" />
                </li>
                <li class='table-cell'>Amount</li>
                <li class='table-cell colon'></li>
                <li class='table-cell'>
                  <input type="text" class='bank_guarantee_value' name="bank_guarantee[numbers][bank_guarantee_amount_percentage]" disabled='disabled' /> %</li>
              </ol>
              <ol class='table-row'>
                <li class='table-cell'>
                  <input type="radio" class='bank_guarantee' name="bank_guarantee[numbers][bank_guarantee_amount_select]" />
                </li>
                <li class='table-cell'>Amount</li>
                <li class='table-cell colon'></li>
                <li class='table-cell'>None</li>
              </ol>
              <ol class='table-row'>
                <li class="table-cell"></li>
                <li class='table-cell'>Start Plan</li>
                <li class='table-cell colon'></li>
                <li class='table-cell'>
                  <input type="date" name="bank_guarantee[numbers][bank_guarantee_start_date]" />
                </li>
              </ol>
              <ol class='table-row'>
                <li class="table-cell"></li>
                <li class='table-cell'>Until Plan</li>
                <li class='table-cell colon'></li>
                <li class='table-cell'>
                  <input type="date" name="bank_guarantee[numbers][bank_guarantee_until_date]" />
                </li>
              </ol>
            </div>
          </div>
        </div>
        <?php include('_search.php'); ?>
      </div>
    </div>
  </div>
</body>

</html>