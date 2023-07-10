@extends('adminPanel/print_master')   
    @section('content')
    <h3 style="margin-top:40px;">Property Details</h3>
	
	</section>
        <div class="row pl-5 pr-5">
            <div class="col-md-9"><h5>Report </h5></div>
            <div class="col-md-3"><h5>Details</h5></div>
            <div class="col-md-9"><h6>Society: {{ $property_data->PropertySociety->society_name }}</h6></div>
            <div class="col-md-3"><h6>Location: {{  $property_data->Propertylocation->location_name }}</h6></div>
            <div class="col-md-9"><h6>Print Date: {{ date('d-m-Y') }}</h6></div>
            <div class="col-md-3"><h6>Status: {{ $property_data->status  }}</h6></div>
            
        </div>
	<section style="margin: 20px;">
		<h4 style="text-align: right;" id=""></h4>
        <div class="row">
            <div class="col-md-12" style="padding:1rem 3rem;">
                <table class="table table-sm table-hover table-bordered" style="border: 2px solid black;">
                <thead style="color: black; border: 1px solid black;">
                    <tr style="background-color: lightgray; color: black;">
                        <th style="border:1px solid black;" width="30%">Content</th>
                        <th style="border:1px solid black;" width="70%">Detail</th>

                        
                    </tr>

                </thead>
                <tbody style="border: 2px solid black;">
                    <tr>
                        <td style="border:1px solid black;">ID</td>
                        <td style="border:1px solid black;">{{ $property_data->id }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Status</td>
                        <td style="border:1px solid black;">     @php
                                                                     if($property_data->status == 'pending'){
                                                                        $isActive = false;
                                                                     }else{
                                                                        $isActive = true;
                                                                     }
                                                                
                                                                @endphp
                                                                    <span style="color:white;" @class([
                                                                        'badge',
                                                                        'bg-success' => $isActive,
                                                                        'bg-danger' => ! $isActive,
                                                                    ])>{{ $property_data->status  }}</span> 
                                                    </td>
                     </tr>
                     <tr>
                        <td style="border:1px solid black;">Title</td>
                        <td style="border:1px solid black;">{{ $property_data->title }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Location</td>
                        <td style="border:1px solid black;">{{ $property_data->Propertylocation->location_name }}</td>
                     </tr>

                     

                     <tr>
                        <td style="border:1px solid black;">Society</td>
                        <td style="border:1px solid black;">{{ $property_data->PropertySociety->society_name }}</td>
                     </tr>
                       
                     <tr>
                        <td style="border:1px solid black;">State Type</td>
                        <td style="border:1px solid black;">{{ $property_data->state_type }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Property Type</td>
                        <td style="border:1px solid black;">{{ $property_data->property_type }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Marla Type</td>
                        <td style="border:1px solid black;">{{ $property_data->PropertyMaral->marala }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Area</td>
                        <td style="border:1px solid black;">{{ $property_data->area }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Road Size</td>
                        <td style="border:1px solid black;">{{ $property_data->road_size }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Streat Size</td>
                        <td style="border:1px solid black;">{{ $property_data->street_size }}</td>
                     </tr>
                    
                     <tr>
                        <td style="border:1px solid black;">Customer</td>
                        <td style="border:1px solid black;">{{ $property_data->PropertyCustomer->custfname." ".$property_data->PropertyCustomer->custlname }}</td>
                     </tr>
                    
                     <tr>
                        <td style="border:1px solid black;">Owner Name</td>
                        <td style="border:1px solid black;">{{ $property_data->owner_name }} ( {{ $property_data->owner_phone_no }} )</td>
                     </tr>
                     <tr>
                        <td style="border:1px solid black;">Final Amount</td>
                        <td style="border:1px solid black;">{{ number_format($property_data->demand_amount) }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">FNF Amount</td>
                        <td style="border:1px solid black;">{{ number_format($property_data->taken_amount) }}</td>
                     </tr>
                    

                     <tr>
                        <td style="border:1px solid black;">Agent</td>
                        <td style="border:1px solid black;">
                        @isset($property_data->agent_id)
                         {{ $property_data->PropertyAgent->fname." ".$property_data->PropertyAgent->lname }}
                         @endisset
                        </td>
                     </tr>
                    @if($property_data->status != 'pending')
                     <tr>
                        <td style="border:1px solid black;">Buyer</td>
                        <td style="border:1px solid black;">
                        @isset($property_data->buyer_id)
                            {{ $property_data->PropertyBuyer->fname." ".$property_data->PropertyBuyer->lname }}
                        @endisset
                        </td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Comission Received Account</td>
                        <td style="border:1px solid black;">
                        @isset($property_data->account_id_recv)
                            {{ $property_data->PropertyPaymentAccount->account_name }}
                        @endisset
                        </td>
                     </tr>


                     <tr>
                        <td style="border:1px solid black;">Sold Date</td>
                        <td style="border:1px solid black;">
                        @isset($property_data->sold_date)
                        {{ date('d-m-Y',strtotime($property_data->sold_date)) }}
                        @endisset
                        </td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Sold Amount</td>
                        <td style="border:1px solid black;">{{ number_format($property_data->sale_amount) }}</td>
                     </tr>
                     
                     <tr>
                        <td style="border:1px solid black;">Commission Received</td>
                        <td style="border:1px solid black;">{{ number_format($property_data->commission_amount) }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Commission Paid</td>
                        <td style="border:1px solid black;">{{ number_format($property_data->commission_paid) }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Agent Commission</td>
                        <td style="border:1px solid black;">{{ number_format($property_data->agent_commission) }}</td>
                     </tr>

                     
                    @endif

                     <tr>
                        <td style="border:1px solid black;">Description</td>
                        <td style="border:1px solid black;">{!! $property_data->description !!}</td>
                     </tr>
                </tbody>
                
                </table>
            </div>
        </div>
		
    @endsection