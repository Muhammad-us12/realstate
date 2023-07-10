@extends('adminPanel/print_master')   
    @section('content')
    <h3 style="margin-top:40px;">Agent Ledeger report</h3>
	
	</section>
        <div class="row pl-5 pr-5">
            <div class="col-md-9"><h5>Report </h5></div>
            <div class="col-md-3"><h5>Details</h5></div>
            <div class="col-md-9"><h6>User: {{ Helper::getUserName(\Auth::user()->id) }}</h6></div>
            <div class="col-md-3"><h6>Agent Name: {{ $agent_data->fname." ".$agent_data->lname }}</h6></div>
            <div class="col-md-9"><h6>Reporting Date: {{ date('d-m-Y') }}</h6></div>
            <div class="col-md-3"><h6>Reporting Time: {{ date('h:i:sa') }}</h6></div>

        </div>
	<section style="margin: 20px;">
		<h4 style="text-align: right;" id=""></h4>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-sm table-hover table-bordered" style="border: 2px solid black;">
                <thead style="color: black; border: 1px solid black;">
                    <tr style="background-color: lightgray; color: black;">
                        <th style="border:1px solid black;">Sr</th>
                        <th style="border:1px solid black;">Date</th>
                        <th style="border:1px solid black;">Desctiption</th>
                        <th style="border:1px solid black;">Comission</th>
                        <th style="border:1px solid black;">Payment</th>
                        <th style="border:1px solid black;">Received</th>
                        
                        <th style="border:1px solid black;">Balance</th>
                        
                        
                    </tr>

                </thead>
                <tbody style="border: 2px solid black;">
                        <tr>
                            <td style="border:1px solid black;">Opening Balance</td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;">{{ number_format($agent_data->opening_bal) }}</td>
                            <td style="border:1px solid black;"></td>

                        </tr> 
                        @php 
                            $total_amount = 0;
                        @endphp
                    @isset($agentLedeger)
                        
                        @foreach($agentLedeger as $pay_res)

                        <?php 
                            $desc = '';
                        

                            if(isset($pay_res->payment_id)){
                                $desc = "Payment Amount | Id:".$pay_res->payment_id;
                            }

                            if(isset($pay_res->recevied_id)){
                                $desc = "Received Amount | Id:".$pay_res->recevied_id;
                            }

                            if(isset($pay_res->file_id)){
                                $desc = "File Amount | Id:".$pay_res->file_id;
                            }

                            if(isset($pay_res->property_id)){
                                $desc = "Property Amount | Id:".$pay_res->property_id;
                            }

                            if(isset($pay_res->expense_id)){
                                $desc = "Property Amount | Id:".$pay_res->expense_id;
                            }
                        ?>
                        <tr>
                            <td style="border:1px solid black;">{{ $loop->iteration }}</td>
                            <td style="border:1px solid black;">{{ date('d-m-Y',strtotime($pay_res->created_at)) }}</td>
                            <td style="border:1px solid black;">{{ $desc  }}</td>
                            <td style="border:1px solid black;">{{ $pay_res->commission }}</td>
                            <td style="border:1px solid black;">{{ number_format($pay_res->payment) }}</td>
                            <td style="border:1px solid black;">{{ number_format($pay_res->received) }}</td>
                            
                            
                            <td style="border:1px solid black;">{{ number_format($pay_res->balance) }}</td>
                            

                        </tr> 
                         
                        @endforeach 
                    @endisset  
                        
                </tbody>
                
                </table>
            </div>
        </div>
		
    @endsection

    @section('prepaid_by')
    {{ Helper::getUserName(\Auth::user()->id) }}
    @endsection