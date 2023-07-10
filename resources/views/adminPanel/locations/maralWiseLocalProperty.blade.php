@extends('adminPanel/print_master')   
    @section('content')
    <h3 style="margin-top:40px;">Marala Wise Property report</h3>
	
	</section>
        <div class="row pl-5 pr-5">
            <div class="col-md-9"><h5>Report </h5></div>
            <div class="col-md-3"><h5>Details</h5></div>
            <div class="col-md-9"><h6>Status: 
            <?php 
                if($status == 1){
                    echo "All Status";
                }else{
                    echo $status;
                }
            ?>
            </h6></div>
          
            <div class="col-md-3"><h6>Reporting Date: {{ date('d-m-Y') }}</h6></div>
            
            <div class="col-md-9"><h6>Reporting Time: {{ date('h:i:sa') }}</h6></div>
            <div class="col-md-3"><h6>User: {{ Helper::getUserName(\Auth::user()->id) }}</h6></div>
            <div class="col-md-9"><h6>Marala: {{ $marala }}</h6></div>
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
                        <th style="border:1px solid black;">Title</th>
                        <th style="border:1px solid black;">Location</th>
                        <th style="border:1px solid black;">Society</th>
                        <th style="border:1px solid black;">State Type</th>
                        <th style="border:1px solid black;">Property Type</th>
                        <th style="border:1px solid black;">Marla</th>
                        <th style="border:1px solid black;">Owner Name</th>
                        <th style="border:1px solid black;">Demand Amount</th>
                        @if($status != 'pending' && $status !== 'Purchase')
                        <th style="border:1px solid black;">Sale Amount</th>
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
                            $agent_commissons = 0;
                            $paid_commissons = 0;
                            
                            $pending_qty = 0;
                            $purchase_qty = 0;
                            $pending_sale_qty = 0;
                            $sale_qty = 0;
                        @endphp
                    @isset($LocalProperty_data)
                        
                        @foreach($LocalProperty_data as $property_res)
                        <tr>
                            <td style="border:1px solid black;">{{ $loop->iteration }}</td>
                            <td style="border:1px solid black;">
                                {{ $property_res->id }}
                            </td>
                            <td style="border:1px solid black;">
                                {{ date('d-m-Y',strtotime($property_res->created_at)) }}
                            </td>
                            
                            <td style="border:1px solid black;">
                                {{ $property_res->title }}
                            </td>
                            <td style="border:1px solid black;">
                                {{ $property_res->Propertylocation->location_name }}
                            </td>
                            <td style="border:1px solid black;">
                                {{ $property_res->PropertySociety->society_name }}
                            </td>
                            <td style="border:1px solid black;">
                                    {{ $property_res->state_type }}
                            </td>
                            <td style="border:1px solid black;">
                                {{ $property_res->property_type }}
                            </td>
                            <td style="border:1px solid black;">
                                {{ $property_res->PropertyMaral->marala }}
                            </td>
                            <td style="border:1px solid black;">
                                    {{ $property_res->owner_name }}
                            </td>
                            <td style="border:1px solid black;">
                                {{ number_format($property_res->demand_amount) }}
                            </td>
                           
                             @if($status != 'pending')
                            <td style="border:1px solid black;">{{ number_format($property_res->sale_amount) }}</td>
                            <td style="border:1px solid black;">{{ number_format($property_res->commission_amount) }}</td>
                            <td style="border:1px solid black;">{{ $property_res->status }}</td>
                            @endif

                        </tr> 
                        @php 
                            if($property_res->status == 'pending'){
                                $pending_qty++;
                            }
                            
                           
                            
                            if($property_res->status == 'Pending sale'){
                                $pending_sale_qty++;
                            }
                            
                            if($property_res->status == 'sale'){
                                $sale_qty++;
                            }
                             
                          
                        
                            $total_sale += $property_res->sale_amount;
                            $total_commissons  += $property_res->commission_amount;
                            $agent_commissons += $property_res->agent_commission;
                            $paid_commissons += $property_res->commission_paid;
                            @endphp
                        @endforeach 
                    @endisset  
                    <tr>
                            <td style="border:1px solid black;">Totals</td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;"></td>
                            
                            <td style="border:1px solid black;"></td>
                             @if($status != 'pending' && $status !== 'Purchase')
                            <td style="border:1px solid black;">{{ number_format($total_sale) }}</td>
                            <td style="border:1px solid black;">{{ Helper::getAmountInWords($total_commissons) }}</td>
                            <td style="border:1px solid black;"></td>
                             @endif

                        </tr> 
                </tbody>
                
                </table>
                
               <div class="row">
                    <div class="col-md-7 offset-md-1">
                        <h5>Summary<h5>
                        @if($status != 'pending' && $status !== 'Purchase')
                        <h6>Total Comission Received: {{ number_format($total_commissons) }}</h6>
                        <h6>Total Agent Comission: {{ number_format($agent_commissons) }}</h6>
                        <h6>Total Comission Paid: {{ number_format($paid_commissons) }}</h6>
                        
                        <?php 
                            $profit = ( $total_commissons - $agent_commissons ) - $paid_commissons;
                        ?>
                        <h6>Profit: {{ number_format($profit) }}</h6>
                        @endif
                    </div>
            
                    
    
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6"><h5>Status</h5></div>
                            <div class="col-md-6"><h5>Property Qty</h5></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6"><h6>Pending</h6></div>
                            <div class="col-md-6"><h6>{{ $pending_qty }}</h6></div>
                        </div>

                        
                        @if($status != 'pending')
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