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
        <li><a href="#add"><i class="fa fa-plus"></i>Add</a>
        </li>
        <li><a href="#add"><i class="fa fa-search"></i>Search</a>
        </li>
        <li><a href="#add">Payment Status</a>
        </li>
        <li><a href="#add">Gurantee Status</a>
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
        <div id="admin-add">
          <form id="form_add" name="form_add" method="POST" action="addPurchase">
            <input type="submit" name="submit" />
            <h2>New Purchase Order</h2>
            <div>
              <label for="">Job No : </label>
              <input type="text" name="new[job_no]" />
            </div>
            <hr>
            <div style="float: left;">
              <div class='table'>
                <h3>Project Summary</h3>
                <div class='table-row'>
                  <div class='table-cell'>Contractor Name</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="new[contractor_name]" />
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Project Name</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="new[project_name]" />
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="new[project_name_check]" value="project_name_check" />
                    <label for="">None</label>
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Project Location</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="new[project_location]" />
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="new[project_location_check]" value="project_location" />
                    <label for="">None</label>
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Project Owner's Name</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="new[project_owner_name]" />
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="new[project_owner_name_check]" value="project_owner_name" />
                    <label for="">None</label>
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Secrecy Agreement</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="radio" name="new[secrecy_agreement]" value="true" />
                    <label for="" class="fa fa-check"></label>
                    <input type="radio" name="new[secrecy_agreement]" value="false" />
                    <label for="" class='fa fa-times'></label>
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="new[secrecy_agreement_check]" value="secrecy_agreement" />
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
                      <input type="date" name="new[start_date]" />
                    </div>
                  </div>
                  <div class='table-row'>
                    <div class='table-cell'>Complete Date</div>
                    <div class='table-cell colon'></div>
                    <div class='table-cell'>
                      <input type="date" name="new[complete_date]" />
                    </div>
                    <div class='table-cell'>
                      <input type="checkbox" name="new[complete_date_check]" value="complete_date" />
                      <label for="">None</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div style="float: left; margin-left: 150px;">
              <div class='table'>
                <h3>Po Info.</h3>
                <div class='table-row'>
                  <div class='table-cell'>Po No</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="new[po_no]" />
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="new[po_no_check]" value="po_no" />
                    <label for="">None</label>
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Po Date</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="new[po_date]" />
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="new[po_date_check]" value="po_date" />
                    <label for="">None</label>
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Po Type</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <select name="new[po_type]">
                      <option value="0">---</option>
                    </select>
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="new[po_type_check]" value="po_type" />
                    <label for="">None</label>
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Po Amount</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="new[contractor_name]" />
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'></div>
                  <div class='table-cell'></div>
                  <div id="show_foreign_currency" class='table-cell'>+ Add Foreign Currency</div>
                </div>
                <div class='table-row foreign_currency' style="display:none;">
                  <div class='table-cell'></div>
                  <div class='table-cell'></div>
                  <div class='table-cell'>
                    <label for="foreign_currency_value">Value : </label>
                    <input type="text" id="foreign_currency_value" name="new[foreign_currency_value]" />
                  </div>
                </div>
                <div class='table-row foreign_currency' style="display:none;">
                  <div class='table-cell'></div>
                  <div class='table-cell'></div>
                  <div class='table-cell'>
                    <label for="foreign_currency_type">Type : </label>
                    <input type="text" id="foreign_currency_type" name="new[foreign_currency_type]" />
                  </div>
                  <div class='table-cell'>
                    <label for="foreign_currency_rate">Rate : </label>
                    <input type="text" id="foreign_currency_rate" name="new[foreign_currency_rate]" />
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Goveming Law</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="new[goveming_law]" />
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="new[goveming_law_check]" value="goveming_law" />
                    <label for="">None</label>
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Credit Term</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="text" name="new[credit_term]" />
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="new[credit_term_check]" value="credit_term" />
                    <label for="">None</label>
                  </div>
                </div>
                <div class='table-row'>
                  <div class='table-cell'>Late Payment Financial Change</div>
                  <div class='table-cell colon'></div>
                  <div class='table-cell'>
                    <input type="radio" name="new[late_payment]" value="yes" />
                    <label for="" class="fa fa-check"></label>
                    <input type="radio" name="new[late_payment]" value="no" />
                    <label for="" class="fa fa-times"></label>
                  </div>
                  <div class='table-cell'>
                    <input type="checkbox" name="new[late_payment_check]" value="late_payment" />
                    <label for="">None</label>
                  </div>
                </div>
              </div>
            </div>
            <div class='clearfix'></div>
            <hr>
            <div>
              <div style="float: left; width: 50%;">
                <h3><input type="checkbox" id="check-payment-terms"  name="new[payment_terms_checkbox]" value="check" />Payment Terms</h3>
                <div id='show-payment-terms' style="display:none;">
                  <div id="list-payment-terms">
                    <div class='table'>
                      <ol class='table-row'>
                        <li class='table-cell'></li>
                        <li class='table-cell'>Description</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <select name="new[payment_terms][0][payment_terms_select]">
                            <option value="0">----</option>
                          </select>
                        </li>
                      </ol>
                      <ol class='table-row'>
                        <li class='table-cell'></li>
                        <li class='table-cell'>Term</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell' style="text-decoration: underline;">1</li>
                      </ol>
                      <ol class='table-row'>
                        <li class='table-cell'>
                          <input type="radio" class='payment_amount' name="new[payment_terms][0][payment_terms_amount_select]" checked='checked' />
                        </li>
                        <li class='table-cell'>Amount</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <input type="text" class='payment_amount_value' name="new[payment_terms][0][payment_terms_amount_thb]" /> THB</li>
                      </ol>
                      <ol class='table-row'>
                        <li class='table-cell'>
                          <input type="radio" class='payment_amount' name="new[payment_terms][0][payment_terms_amount_select]" />
                        </li>
                        <li class='table-cell'>Amount</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <input type="text" class='payment_amount_value' name="new[payment_terms][0][payment_terms_amount_thb]" disabled='disabled' /> %</li>
                      </ol>
                      <ol class='table-row'>
                        <li class="table-cell"></li>
                        <li class='table-cell'>Payment Date Plan</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <input type="date" name="new[payment_terms][0][payment_terms_date_plan]" />
                        </li>
                      </ol>
                    </div>
                  </div>
                  <p id='add-payment-terms'> + Add Payment Terms.</p>
                </div>
              </div>
              <div style="float: left; margin-left: 150px;">
                <h3><input type="checkbox" id="check-bank-guarantee" name="new[bank_guarantee_checkbox]" value="check" />Bank Guarantee</h3>
                <div id='show-bank-guarantee' style='display: none;'>
                  <div id="list-bank-guarantee">
                    <div class='table'>
                      <ol class='table-row'>
                        <li class='table-cell'></li>
                        <li class='table-cell'>Description</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <select name="new[bank_guarantee][0][bank_guarantee_select]">
                            <option value="0">----</option>
                          </select>
                        </li>
                      </ol>
                      <ol class='table-row'>
                        <li class='table-cell'></li>
                        <li class='table-cell'>Term</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell' style="text-decoration: underline;">1</li>
                      </ol>
                      <ol class='table-row'>
                        <li class='table-cell'>
                          <input type="radio" name="new[bank_guarantee][0][bank_guarantee_amount_select]" checked='checked' />
                        </li>
                        <li class='table-cell'>Amount</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <input type="text" name="new[bank_guarantee][0][bank_guarantee_amount_thb]" /> THB</li>
                      </ol>
                      <ol class='table-row'>
                        <li class='table-cell'>
                          <input type="radio" name="new[bank_guarantee][0][bank_guarantee_amount_select]" />
                        </li>
                        <li class='table-cell'>Amount</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <input type="text" name="new[bank_guarantee][0][bank_guarantee_amount_thb]" disabled='disabled' /> %</li>
                      </ol>
                      <ol class='table-row'>
                        <li class='table-cell'>
                          <input type="radio" name="new[bank_guarantee][0][bank_guarantee_amount_select]" />
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
                          <input type="date" name="new[bank_guarantee][0][bank_guarantee_start_date]" />
                        </li>
                      </ol>
                      <ol class='table-row'>
                        <li class="table-cell"></li>
                        <li class='table-cell'>Until Plan</li>
                        <li class='table-cell colon'></li>
                        <li class='table-cell'>
                          <input type="date" name="new[bank_guarantee][0][bank_guarantee_until_date]" />
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
                  <select name="new[payment_terms][numbers][payment_terms_select]">
                    <option value="0">----</option>
                  </select>
                </li>
              </ol>
              <ol class='table-row'>
                <li class='table-cell'></li>
                <li class='table-cell'>Term</li>
                <li class='table-cell colon'></li>
                <li class='table-cell' style="text-decoration: underline;">($number)</li>
              </ol>
              <ol class='table-row'>
                <li class='table-cell'>
                  <input type="radio" class='payment_amount'  name="new[payment_terms][numbers][payment_terms_amount_select]" checked='checked' />
                </li>
                <li class='table-cell'>Amount</li>
                <li class='table-cell colon'></li>
                <li class='table-cell'>
                  <input type="text" class='payment_amount_value' name="new[payment_terms][numbers][payment_terms_amount_thb]" /> THB</li>
              </ol>
              <ol class='table-row'>
                <li class='table-cell'>
                  <input type="radio" class='payment_amount' name="new[payment_terms][numbers][payment_terms_amount_select]" />
                </li>
                <li class='table-cell'>Amount</li>
                <li class='table-cell colon'></li>
                <li class='table-cell'>
                  <input type="text" class='payment_amount_value' name="new[payment_terms][numbers][payment_terms_amount_thb]" disabled='disabled' /> %</li>
              </ol>
              <ol class='table-row'>
                <li class="table-cell"></li>
                <li class='table-cell'>Payment Date Plan</li>
                <li class='table-cell colon'></li>
                <li class='table-cell'>
                  <input type="date" name="new[payment_terms][numbers][payment_terms_date_plan]" />
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
                  <select name="new[bank_guarantee][numbers][bank_guarantee_select]">
                    <option value="0">----</option>
                  </select>
                </li>
              </ol>
              <ol class='table-row'>
                <li class='table-cell'></li>
                <li class='table-cell'>Term</li>
                <li class='table-cell colon'></li>
                <li class='table-cell' style="text-decoration: underline;">($number)</li>
              </ol>
              <ol class='table-row'>
                <li class='table-cell'>
                  <input type="radio" name="new[bank_guarantee][numbers][bank_guarantee_amount_select]" checked='checked' />
                </li>
                <li class='table-cell'>Amount</li>
                <li class='table-cell colon'></li>
                <li class='table-cell'>
                  <input type="text" name="new[bank_guarantee][numbers][bank_guarantee_amount_thb]" /> THB</li>
              </ol>
              <ol class='table-row'>
                <li class='table-cell'>
                  <input type="radio" name="new[bank_guarantee][numbers][bank_guarantee_amount_select]" />
                </li>
                <li class='table-cell'>Amount</li>
                <li class='table-cell colon'></li>
                <li class='table-cell'>
                  <input type="text" name="new[bank_guarantee][numbers][bank_guarantee_amount_thb]" disabled='disabled' /> %</li>
              </ol>
              <ol class='table-row'>
                <li class='table-cell'>
                  <input type="radio" name="new[bank_guarantee][numbers][bank_guarantee_amount_select]" />
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
                  <input type="date" name="new[bank_guarantee][numbers][bank_guarantee_start_date]" />
                </li>
              </ol>
              <ol class='table-row'>
                <li class="table-cell"></li>
                <li class='table-cell'>Until Plan</li>
                <li class='table-cell colon'></li>
                <li class='table-cell'>
                  <input type="date" name="new[bank_guarantee][numbers][bank_guarantee_until_date]" />
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>