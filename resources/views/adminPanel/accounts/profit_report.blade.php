@extends('adminPanel/print_master')   
    @section('content')
    <h3 style="margin-top:40px;">Profit Report</h3>
	
	</section>
        <div class="row pl-5 pr-5">
            <div class="col-md-9"><h5>Report </h5></div>
            <div class="col-md-3"><h5>Details</h5></div>
            
            <div class="col-md-9"><h6>Reporting Date: {{ date('d-m-Y') }}</h6></div>
            <div class="col-md-3"><h6>Reporting Time: {{ date('h:i:sa') }}</h6></div>
        </div>
	<section style="margin: 20px;">
		<h4 style="text-align: right;" id=""></h4>
		<table class="table table-sm table-hover table-bordered" style="border: 2px solid black;">
            <thead style="color: black; border: 1px solid black;">
                <tr style="background-color: lightgray; color: black;">
                    <th style="border:1px solid black;">Sr</th>
                    <th style="border:1px solid black;">Particular</th>
                    <td style="border:1px solid black;">Profit</td>
                </tr>

            </thead>
            <tbody style="border: 2px solid black;">
                    <?php
                    $files_profit = 0;
                    $total_file_purhase = 0;
                    $total_file_sale = 0;
                    $total_file_commission = 0;
                    foreach($sale_files as $file_res){
                        $file_gross_profit = $file_res->sale_amount - $file_res->purchase_amount;
                        $file_net_profit = $file_gross_profit - $file_res->commission_amount;
                        $files_profit += $file_net_profit; 
                        
                        $total_file_purhase += $file_res->purchase_amount;
                        $total_file_sale += $file_res->sale_amount;
                        $total_file_commission += $file_res->commission_amount;
                    }
                    ?>


                
                    <?php
                    $local_profit = 0;
                    foreach($localproperty as $local_res){
                        $local_profit += $local_res->commission_amount;
                    }

                    $gross_profit = $files_profit + $local_profit;
                    $net_profit  = $gross_profit - $expense;
                    ?>
                    <tr>
                        <td style="border:1px solid black;">1</td>
                        <td style="border:1px solid black;">Files Purchase</td>
                        <td style="border:1px solid black;">{{ number_format($total_file_purhase) }}</td>
                       
                     </tr>   
                     
                     <tr>
                        <td style="border:1px solid black;">2</td>
                        <td style="border:1px solid black;">Files Sale</td>
                        <td style="border:1px solid black;">{{ number_format($total_file_sale) }}</td>
                       
                     </tr>    
                     
                     <tr>
                        <td style="border:1px solid black;">3</td>
                        <td style="border:1px solid black;">Sale Files Commmission</td>
                        <td style="border:1px solid black;">{{ number_format($total_file_commission) }}</td>
                       
                     </tr>    

                     <tr>
                        <td style="border:1px solid black;">4</td>
                        <td style="border:1px solid black;">Sale Files Profit</td>
                        <td style="border:1px solid black;">{{ number_format($files_profit) }}</td>
                       
                     </tr>    

                     <tr>
                        <td style="border:1px solid black;">5</td>
                        <td style="border:1px solid black;">Property Commission Received</td>
                        <td style="border:1px solid black;">{{ number_format($local_profit) }}</td>
                       
                     </tr> 
                     
                     <tr>
                        <td style="border:1px solid black;">6</td>
                        <td style="border:1px solid black;">Gross Profit</td>
                        <td style="border:1px solid black;">{{ number_format($gross_profit) }}</td>
                       
                     </tr> 

                     <tr>
                        <td style="border:1px solid black;">7</td>
                        <td style="border:1px solid black;">Total Expense</td>
                        <td style="border:1px solid black;">{{ number_format($expense) }}</td>
                       
                     </tr> 

                     <tr>
                        <td style="border:1px solid black;">8</td>
                        <td style="border:1px solid black;">Net Profit</td>
                        <td style="border:1px solid black;">{{ number_format($net_profit) }}</td>
                       
                     </tr> 
                          
                                              
            </tbody>
           
            </table>
    @endsection

    @section('prepaid_by')
      {{ Helper::getUserName('') }}
    @endsection