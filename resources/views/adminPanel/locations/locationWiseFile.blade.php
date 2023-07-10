@extends('adminPanel/print_master')   
    @section('content')
    <h3 style="margin-top:40px;">Location Wise Files report</h3>
	
	</section>
        <div class="row pl-5 pr-5">
            <div class="col-md-9"><h5>Report </h5></div>
            <div class="col-md-3"><h5>Details</h5></div>
            <div class="col-md-9"><h6>Status: @if($status != 1) {{ $status }} @else All @endif</h6></div>
            <div class="col-md-3"><h6>Reporting Date: {{ date('d-m-Y') }}</h6></div>
            <div class="col-md-9"><h6>Reporting Time: {{ date('h:i:sa') }}</h6></div>
            <div class="col-md-3"><h6>User: {{ Helper::getUserName(\Auth::user()->id) }}</h6></div>
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
                        <th style="border:1px solid black;">Reg ID</th>
                        <th style="border:1px solid black;">Location</th>
                        <th style="border:1px solid black;">Society</th>
                        <th style="border:1px solid black;">Block</th>
                        <th style="border:1px solid black;">Marala</th>
                        
                        <th style="border:1px solid black;">Purchase</th>
                        @if($status != 'pending' && $status !== 'Purchase')
                        <th style="border:1px solid black;">Sale</th>
                        <th style="border:1px solid black;">Comission</th>
                        <th style="border:1px solid black;">Status</th>
                        @endif
                        
                    </tr>

                </thead>
                <tbody style="border: 2px solid black;">
                

                        @php 
                            $total_purchase = 0;
                            $total_sale = 0;
                            $total_commissons = 0;
                            
                            $pending_qty = 0;
                            $purchase_qty = 0;
                            $pending_sale_qty = 0;
                            $sale_qty = 0;
                        @endphp
                    @isset($files_data)
                        
                        @foreach($files_data as $file_res)
                        <tr>
                            <td style="border:1px solid black;">{{ $loop->iteration }}</td>
                            <td style="border:1px solid black;">{{ $file_res->id }}</td>
                            <td style="border:1px solid black;">{{ $file_res->registration_no }}</td>
                            <td style="border:1px solid black;">{{ $file_res->fileslocation->location_name }}</td>
                            <td style="border:1px solid black;">{{ $file_res->filesSociety->society_name }}</td>
                            <td style="border:1px solid black;">{{ $file_res->filesBlock->block_name }}</td>
                            <td style="border:1px solid black;">{{ $file_res->filesMaral->marala }}</td>
                            
                            <td style="border:1px solid black;">{{ number_format($file_res->purchase_amount) }}</td>
                            @if($status != 'pending' && $status !== 'Purchase')
                            <td style="border:1px solid black;">{{ number_format($file_res->sale_amount) }}</td>
                            <td style="border:1px solid black;">{{ number_format($file_res->commission_amount) }}</td>
                            <td style="border:1px solid black;">{{ $file_res->status }}</td>
                            @endif

                        </tr> 
                        @php 
                            if($file_res->status == 'pending'){
                                $pending_qty++;
                            }
                            
                            if($file_res->status == 'Purchase'){
                                $purchase_qty++;
                            }
                            
                            if($file_res->status == 'pending sale'){
                                $pending_sale_qty++;
                            }
                            
                            if($file_res->status == 'sale'){
                                $sale_qty++;
                            }
                             
                          
                        
                            $total_purchase += $file_res->purchase_amount;
                            $total_sale += $file_res->sale_amount;
                            $total_commissons  += $file_res->commission_amount;
                        @endphp
                        @endforeach 
                    @endisset  
                    <tr>
                            <td style="border:1px solid black;">Totals</td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;">{{ Helper::getAmountInWords($total_purchase) }}</td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;"></td>
                            
                            <td style="border:1px solid black;">{{ number_format($total_purchase) }}</td>
                            @if($status != 'pending' && $status !== 'Purchase')
                            <td style="border:1px solid black;">{{ number_format($total_sale) }}</td>
                            <td style="border:1px solid black;">{{ number_format($total_commissons) }}</td>
                            <td style="border:1px solid black;"></td>
                             @endif

                        </tr> 
                </tbody>
                
                </table>

                <div class="row">
                    <div class="col-md-7 offset-md-1">
                        <h5>Summary<h5>
                        <h6>Total Purchase: {{ number_format($total_purchase) }}</h6>
                        @if($status != 'pending' && $status !== 'Purchase')
                        <h6>Total Sale: {{ number_format($total_sale) }}</h6>
                        <h6>Total Comission: {{ number_format($total_commissons) }}</h6>
                        
                        <?php 
                            $profit = ($total_sale - $total_purchase) - $total_commissons;
                        ?>
                        <h6>Profit: {{ number_format($profit) }}</h6>
                        @endif
                    </div>
            
    
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6"><h5>Status</h5></div>
                            <div class="col-md-6"><h5>Files Qty</h5></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6"><h6>Pending</h6></div>
                            <div class="col-md-6"><h6>{{ $pending_qty }}</h6></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6"><h6>Purchase</h6></div>
                            <div class="col-md-6">{{ $purchase_qty }}</div>
                        </div>
                        @if($status != 'pending' && $status !== 'Purchase')
                        <div class="row">
                            <div class="col-md-6"><h6>Pending Sale</h6></div>
                            <div class="col-md-6">{{ $pending_sale_qty }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6"><h6>Sale</h6></div>
                            <div class="col-md-6">{{ $sale_qty }}</div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
		
    @endsection
    
    @section('prepaid_by')
        {{ Helper::getUserName(\Auth::user()->id) }}
    @endsection