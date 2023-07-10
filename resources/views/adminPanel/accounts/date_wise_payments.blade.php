@extends('adminPanel/print_master')   
    @section('content')
    <h3 style="margin-top:40px;">Date wise Payments report</h3>
	
	</section>
        <div class="row pl-5 pr-5">
            <div class="col-md-9"><h5>Report </h5></div>
            <div class="col-md-3"><h5>Details</h5></div>
            <div class="col-md-9"><h6>User: {{ Helper::getUserName(\Auth::user()->id) }}</h6></div>
            <div class="col-md-3"><h6>Start Date: {{ $request->start_date }}</h6></div>
            <div class="col-md-9"><h6>End Date: {{ $request->end_date }}</h6></div>
            <div class="col-md-3"><h6>Reporting Date: {{ date('d-m-Y') }}</h6></div>
            <div class="col-md-9"><h6>Reporting Time: {{ date('h:i:sa') }}</h6></div>
        </div>
	<section style="margin: 20px;">
		<h4 style="text-align: right;" id=""></h4>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-sm table-hover table-bordered" style="border: 2px solid black;">
                <thead style="color: black; border: 1px solid black;">
                    <tr style="background-color: lightgray; color: black;">
                        <th style="border:1px solid black;">Sr</th>
                        <th style="border:1px solid black;">ID</th>
                        <th style="border:1px solid black;">Date</th>
                        <th style="border:1px solid black;">Payment Account</th>
                        <th style="border:1px solid black;">Amount</th>
                        
                    </tr>

                </thead>
                <tbody style="border: 2px solid black;">
                        @php 
                            $total_amount = 0;
                        @endphp
                    @isset($payments_data)
                        
                        @foreach($payments_data as $pay_res)
                        <tr>
                            <td style="border:1px solid black;">{{ $loop->iteration }}</td>
                            <td style="border:1px solid black;">{{ $pay_res->id }}</td>
                            <td style="border:1px solid black;">{{ date('d-m-Y',strtotime($pay_res->date)) }}</td>
                            
                            <td style="border:1px solid black;">{{ $pay_res->account_name." / ".$pay_res->account_number}}</td>
                            <td style="border:1px solid black;">{{ number_format($pay_res->total_payments) }}</td>
                        </tr> 
                        @php 
                            $total_amount += $pay_res->total_payments;
                        @endphp  
                        @endforeach 
                    @endisset  
                        
                </tbody>
                <tfoot>
                    <tr class="font-weight-bold" style="background-color: #f0eded !important; font-size: 20px;">
                
                                                        <tr class="font-weight-bold">
                                                        <td style="border:1px solid black;">Totals</td>
                                                        <td style="border:1px solid black;"></td>
                                                        <td style="border:1px solid black;"></td>
                                                        <td style="border:1px solid black;">{{ Helper::getAmountInWords($total_amount) }}</td>

                                                        <td style="border:1px solid black;">{{ number_format($total_amount) }}</td>
                                                        
                                                        </tr>
                </tfoot>
                </table>
            </div>
        </div>
		
    @endsection

    @section('prepaid_by')
    {{ Helper::getUserName(\Auth::user()->id) }}
    @endsection