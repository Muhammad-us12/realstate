
         @extends('adminPanel/master')   
         @section('style')
            <link href="{{ asset('public/adminPanel/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
         @endsection
         @section('content')        
                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        
                                    </div>
                                    <h4 class="page-title">Accounts</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-5">
                                                <h4 class="page-title">Add Received Payment</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="{{ URL::to('received-list') }}" class="btn btn-success" ><i class="mdi mdi-plus-circle me-2"></i>Received List</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                            <form action="{{ URL::to('received-sub') }}" id="payment_from" method="post" data-select2-id="6">
                                                @csrf
                                                <div class="mt-3" data-select2-id="5">
                                                    <div class="row">
                                                        <div class="col-md-1">
                                                            <label for="">id</label>
                                                            <input type="text" id="" readonly="" name="" value="24" class="form-control">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="">Date</label>
                                                            <input type="date" id="current_date" name="current_date" value="{{ date('Y-m-d') }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="">Received Account</label>
                                                            <select name="payment_from" required id="payment_from" onchange="fetchCashAccountBalance()" class="form-control select2bs4">
                                                                @isset($CashAccountsdata)
                                                                    @foreach($CashAccountsdata as $cash_res_data)
                                                                    <option value="{{ $cash_res_data->id }}">{{ $cash_res_data->account_name }}</option>
                                                                    @endforeach
                                                                @endisset
                                                            </select>
                                                        </div>                              
                                                        <div class="col-md-2">
                                                            <label for="">Previous Balance</label>
                                                            <input type="number" id="account_balance" name="account_prev_bal" class="form-control" readonly="">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="">Updated Balance</label>
                                                            <input type="number" id="updated_balnc" name="updated_balnc" class="form-control" readonly="">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="">Total Payments</label>
                                                            <input type="number" readonly="" id="total_payments" name="total_payments" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2 mt-2">
                                                            <label for="">Received From</label>
                                                            <select name="sel_data" id="sel_data" onchange="select_data()" class="form-control select2bs4">
                                                                <option value="-1">Select One</option>
                                                                <option value="agents">Agents</option>
                                                                <option value="customer">Customer</option>
                                                                <option value="account">Different Account</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2 mt-2" id="">
                                                        <label for="" id="label_name">Select Content:</label>
                                                        <select name="sel_content" id="sel_content" data-toggle="select2" class="form-control select2">

                                                        </select>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-2 mt-2">
                                                            <label for="">Prev.Balance</label>
                                                            <input type="number" name="" id="seelcted_content_bal" class="form-control" readonly="">
                                                        </div>
                                                        <div class="col-md-3 mt-2">
                                                            <label for="">Amount</label>
                                                            <input type="number" name="pay_amount" id="pay_amount" class="form-control">
                                                        </div>
                                                    
                                                        <div class="col-md-1">
                                                            <label for=""></label>
                                                            <button type="button" class="btn btn-success btn-md mt-2" id="enter_row_item" onclick="add_to_cart()">Add</button>
                                                        </div>
                                                    </div>
                                                    <div class="row my-5">
                                                            <table id="payments_table_id" class="table table-centered w-100 nowrap">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>Received From</th>
                                                                        <th>Payments Person</th>
                                                                        <th>Amount</th>
                                                                        <th>Remarks</th>
                                                                        <th style="width: 85px;">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="payments_table">
                                                                    
                                                                </tbody>
                                                            </table>

                                                     </div>
                                                    </div> 
                                                    <div class="row">
                                                        <div class="col-md-12 text-right">
                                                        <button type="button" onclick="disabledSubmitButton(this)" name="submit_payments" id="sub_pys" class="btn btn-primary">
                                                            Save
                                                        </button>
                                                        </div>
                                                    </div>  
                                                </form>
                                            </div>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                     
                        <!-- end row -->

                    </div>

                    <div id="error-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content modal-filled bg-danger">
                                <div class="modal-body p-4">
                                    <div class="text-center">
                                        <i class="dripicons-wrong h1"></i>
                                        <h4 class="mt-2">Oh snap!</h4>
                                        <p class="mt-3" id="alert_data"></p>
                                        <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Continue</button>
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
         @endsection

         @section('scripts')
         <script src="{{ asset('public/adminPanel/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
         <script src="{{ asset('public/adminPanel/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
         
            <script>
                $("#scroll-horizontal-datatable").DataTable({scrollX:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}})
            </script>   
            
            <script>
                 var submit_form = true;
                function disabledSubmitButton(form) {
                    console.log(form);
                    console.log('Form is submit now ');
                    if(submit_form){
                        submit_form = false;
                        $('#payment_from').submit();
                    }
                    
                }

                 fetchCashAccountBalance = ()=>{
                    var accountId = $('#payment_from').val();
                    $.ajax({
                        url:"fetch_cash_acc_bal/"+accountId,
                        type:'GET',
                        data:{ },
                        success:function(data) {
                            $('#updated_balnc').val(data);
                            $('#account_balance').val(data);
                            console.log(data);
                            // let maralsHtml = ``;
                            // data.forEach((marala)=>{
                            //     maralsHtml += `<option value="${marala['id']}">${marala['marala']}</option>`
                                
                            // });

                            // $('#select_marala').html(maralsHtml);
                        }
                    });
                }

                fetchCashAccountBalance();

                fetchCustomerBalance = ()=>{
                    var customerData = $('#sel_content').val();
                    customerData = JSON.parse(customerData);
                    console.log(customerData);
                    $.ajax({
                        url:"fetch_customer_bal/"+customerData['id'],
                        type:'GET',
                        data:{ },
                        success:function(data) {
                            $('#seelcted_content_bal').val(data);
                            // $('#account_balance').val(data);
                            console.log(data);
                            // let maralsHtml = ``;
                            // data.forEach((marala)=>{
                            //     maralsHtml += `<option value="${marala['id']}">${marala['marala']}</option>`
                                
                            // });

                            // $('#select_marala').html(maralsHtml);
                        }
                    });
                }

                fetchCashAccBalance = ()=>{
                    var accountData = $('#sel_content').val();
                        accountData = JSON.parse(accountData);
                    $.ajax({
                        url:"fetch_cash_acc_bal/"+accountData['id'],
                        type:'GET',
                        data:{ },
                        success:function(data) {
                            $('#seelcted_content_bal').val(data);
                            console.log(data);
                            // let maralsHtml = ``;
                            // data.forEach((marala)=>{
                            //     maralsHtml += `<option value="${marala['id']}">${marala['marala']}</option>`
                                
                            // });

                            // $('#select_marala').html(maralsHtml);
                        }
                    });
                }

                fetchAgentBalance = ()=>{
                    var agentData = $('#sel_content').val();
                    agentData = JSON.parse(agentData);
                    console.log(agentData);
                    $.ajax({
                        url:"fetch_agent_bal/"+agentData['id'],
                        type:'GET',
                        data:{ },
                        success:function(data) {
                            $('#seelcted_content_bal').val(data);
                            // $('#account_balance').val(data);
                            console.log(data);
                            
                        }
                    });
                }

                select_data = ()=>{
                    var selectedContent = $('#sel_data').val();

                    if(selectedContent == 'agents'){
                        fetchAgentLists();
                    }

                    if(selectedContent == 'customer'){
                        fetchCustomerLists();
                    }

                    if(selectedContent == 'account'){
                        fetchAccountsLists();
                    }
                    console.log('The content is '+selectedContent);
                }

                $('#sel_content').on('change',function(){
                    var selectedContent = $('#sel_data').val();

                    if(selectedContent == 'agents'){
                        fetchAgentBalance();
                    }

                    if(selectedContent == 'customer'){
                        fetchCustomerBalance();
                    }

                    if(selectedContent == 'account'){
                        fetchCashAccBalance();
                    }
                })

                var trId = 1;
                add_to_cart = ()=>{
                    var selectedCrit = $('#sel_data').val();
                    if(selectedCrit != '-1'){
                        var payValue = $('#pay_amount').val();
                        if(payValue > 0){
                            var selectedContent = $('#sel_content').val();
                            selectedContent = JSON.parse(selectedContent);

                            var contentId = selectedContent['id'];

                            if(selectedCrit == 'agents'){
                                var contentName = selectedContent['fname']+" "+selectedContent['lname'];
                                var contentPerson = 'Agent';
                            }

                            if(selectedCrit == 'customer'){
                                var contentName = selectedContent['custfname']+" "+selectedContent['custlname'];
                                var contentPerson = 'Customer';
                            }

                            if(selectedCrit == 'account'){
                                var contentName = selectedContent['account_name'];
                                var contentPerson = 'Account';
                            }

                            



                            console.log(selectedContent);
                            var tableTrHtml = `<tr id="${trId}">
                                                    <td><input type="text" class="form-control" name="criteria[]" readonly="" value="${contentPerson}"></td>
                                                    <td><input type="text" class="form-control" name="content[]" readonly="" value="${contentName}"><input type="text" name="content_ids[]" hidden="" value="${contentId}"></td>
                                                    <td><input type="text" class="form-control enter_payment_inp" name="amount[]" required="" value="${payValue}"></td>
                                                    <td><input type="text" class="form-control" name="remarks[]"  value=""></td>
                                                    <td><button type="button" onclick="delete_row(${trId})" class="btn btn-sm btn-danger">X</button></td>
                                                </tr>`;

                            $('#payments_table').prepend(tableTrHtml).children('tr:first').append();
                            calculateTotalPayment();
                            $('#pay_amount').val('');
                        }else{
                            $('#alert_data').html('Please Enter Payment Amount');
                            $('#error-alert-modal').modal('show');
                        }
                    }else{
                        $('#alert_data').html('Please Select Any Content');
                        $('#error-alert-modal').modal('show');
                    }
                }

    calculateTotalPayment = ()=>{
        // console.log('funciton is call ');
        
        var table = document.getElementById('payments_table');

        // console.log(table);
            // LOOP THROUGH EACH ROW OF THE TABLE AFTER HEADER.
            var totalPayments = 0;
            var balnc=0;
            
            for (i = 0; i < table.rows.length; i++) {
        
                // GET THE CELLS COLLECTION OF THE CURRENT ROW.
                var objCells = table.rows.item(i).cells;
                console.log(objCells);
                // console.log(objCells.item(2).children[0].value);
                var itemValue = objCells.item(2).children[0].value;
                console.log("new coming value"+itemValue)
                totalPayments = +totalPayments + +itemValue;
                // console.log(total_recv_payments);

                
            }
            console.log(totalPayments);
            var currrt_balance= $('#account_balance').val();
        // // console.log("prevoius balnc"+currrt_balance);
            balnc= +currrt_balance + +totalPayments;

            
            $('#updated_balnc').val(balnc);
            $('#total_payments').val(totalPayments);

            
        }

                fetchCustomerLists = ()=>{
                    $.ajax({
                        url:"fetch_customer_list",
                        type:'GET',
                        data:{ },
                        success:function(data) {
                            // $('#updated_balnc').val(data);
                            // $('#account_balance').val(data);
                            console.log(data);
                            let customerHtml = ``;
                            data.forEach((customer)=>{
                                var customerObj = JSON.stringify(customer);
                                customerHtml += `<option value='${customerObj}'>${customer['custfname']} ${customer['custlname']}</option>`
                                
                            });

                            $('#sel_content').html(customerHtml);
                            fetchCustomerBalance();
                        }
                    });
                }

                fetchAgentLists = ()=>{
                    $.ajax({
                        url:"fetch_agent_list",
                        type:'GET',
                        data:{ },
                        success:function(data) {
                            // console.log(data);
                            let agentHtml = ``;
                            data.forEach((agent)=>{
                                var agentObj = JSON.stringify(agent);
                                agentHtml += `<option value='${agentObj}'>${agent['fname']} ${agent['lname']}</option>`
                                
                            });

                            $('#sel_content').html(agentHtml);
                            fetchAgentBalance();
                        }
                    });
                }

                fetchAccountsLists = ()=>{
                    $.ajax({
                        url:"fetch_account_list",
                        type:'GET',
                        data:{ },
                        success:function(data) {
                            // console.log(data);
                            let accountHtml = ``;
                            data.forEach((account)=>{
                                var accountObj = JSON.stringify(account);
                                accountHtml += `<option value='${accountObj}'>${account['account_name']}</option>`
                                
                            });

                            $('#sel_content').html(accountHtml);
                            fetchCashAccBalance();
                        }
                    });
                }

                delete_row = (id)=>{
                    console.log('button id is '+id);
                    $('#'+id+'').remove();
                    calculateTotalPayment();
                    
                }

                
                document.querySelector('#payments_table').addEventListener('keyup',function(event){
                    calculateTotalPayment();

                })

            
            </script>
         @endsection
                    <!-- container -->

                