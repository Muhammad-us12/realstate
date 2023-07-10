@extends('adminPanel/print_master')   
    @section('content')
    <h3 style="margin-top:40px;">Payable & Receivable Report</h3>
	
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
                    <th style="border:1px solid black;">Name</th>
                    <th style="border:1px solid black;">Particular</th>
                    <th style="border:1px solid black;">Payable</th>
                    <th style="border:1px solid black;">Receivable</th>
                </tr>

            </thead>
            <tbody style="border: 2px solid black;">
            @php 
                $total_payable = 0;
                $total_recv = 0;
                $counter = 0;
            @endphp
                @isset($customers)
                    @foreach($customers as $cust_res)
                        @if($cust_res->balance != 0)
                        <tr>
                            <td style="border:1px solid black;">{{ $counter++ }}</td>
                            <td style="border:1px solid black;">{{ $cust_res->custfname." ".$cust_res->custlname }}</td>
                            <td style="border:1px solid black;">{{ "Customer" }}</td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;">{{ number_format($cust_res->balance) }}</td>
                        </tr>
                        @endif
                     @php 
                        $total_recv += $cust_res->balance;
                     @endphp
                    @endforeach  
                @endisset  
                
                @isset($agents)
                    @foreach($agents as $agent_res)
                        @if($agent_res->balance != 0)
                        <tr>
                            <td style="border:1px solid black;">{{ $counter++ }}</td>
                            <td style="border:1px solid black;">{{ $agent_res->fname." ".$agent_res->lname }}</td>
                            <td style="border:1px solid black;">{{ "Agent" }}</td>
                            <td style="border:1px solid black;">{{ number_format($agent_res->balance) }}</td>
                            <td style="border:1px solid black;"></td>
                        </tr>
                        @endif
                     @php 
                        $total_payable += $agent_res->balance;
                     @endphp
                    @endforeach  
                @endisset  
            </tbody>
            <tfoot>
                <tr class="font-weight-bold" style="background-color: #f0eded !important; font-size: 20px;">
            
                                                    <tr class="font-weight-bold">
                                                    <td style="border:1px solid black;"></td>
                                                    <td style="border:1px solid black;"></td>
                                                    <td style="border:1px solid black;">{{ Helper::getAmountInWords($total_recv) }}</td>
                                                        <td style="border:1px solid black;"></td>
                                                        <td style="border:1px solid black;">{{ number_format($total_recv) }}</td>                                            
                                                    </tr>
            </tfoot>
            <tfoot>
                <tr class="font-weight-bold" style="background-color: #f0eded !important; font-size: 20px;">
            
                                                    <tr class="font-weight-bold">
                                                    <td style="border:1px solid black;"></td>
                                                    <td style="border:1px solid black;"></td>
                                                    <td style="border:1px solid black;">{{ Helper::getAmountInWords($total_payable) }}</td>
                                                        <td style="border:1px solid black;">{{ number_format($total_payable) }}</td>
                                                        <td style="border:1px solid black;"></td>                                            
                                                    </tr>
            </tfoot>
            </table>
    @endsection

    @section('prepaid_by')
      {{ "" }}
    @endsection