@extends('adminPanel/print_master')   
    @section('content')
    <h3 style="margin-top:40px;">File Details</h3>
	
	</section>
        <div class="row pl-5 pr-5">
            <div class="col-md-9"><h5>Report </h5></div>
            <div class="col-md-3"><h5>Details</h5></div>
            <div class="col-md-9"><h6>Society: {{ $files_data->filesSociety->society_name }}</h6></div>
            <div class="col-md-3"><h6>Location: {{  $files_data->fileslocation->location_name }}</h6></div>
            <div class="col-md-9"><h6>Print Date: {{ date('d-m-Y') }}</h6></div>
            <div class="col-md-3"><h6>Status: {{ $files_data->status  }}</h6></div>
            
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
                        <td style="border:1px solid black;">{{ $files_data->id }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Registration No.</td>
                        <td style="border:1px solid black;">{{ $files_data->registration_no }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Status</td>
                        <td style="border:1px solid black;">     @php
                                                                     if($files_data->status == 'pending'){
                                                                        $isActive = false;
                                                                     }else{
                                                                        $isActive = true;
                                                                     }
                                                                
                                                                @endphp
                                                                    <span style="color:white;" @class([
                                                                        'badge',
                                                                        'bg-success' => $isActive,
                                                                        'bg-danger' => ! $isActive,
                                                                    ])>{{ $files_data->status  }}</span> 
                                                    </td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Location</td>
                        <td style="border:1px solid black;">{{ $files_data->fileslocation->location_name }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Scoiety</td>
                        <td style="border:1px solid black;">{{ $files_data->filesSociety->society_name }}</td>
                     </tr>
                       
                     <tr>
                        <td style="border:1px solid black;">Block</td>
                        <td style="border:1px solid black;">{{ $files_data->filesBlock->block_name }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Purchase Amount</td>
                        <td style="border:1px solid black;">{{ number_format($files_data->purchase_amount) }}</td>
                     </tr>
                    
                     <tr>
                        <td style="border:1px solid black;">Purchase Date</td>
                        <td style="border:1px solid black;">{{ date('d-m-Y',strtotime($files_data->purchase_date)) }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Marala</td>
                        <td style="border:1px solid black;">{{ $files_data->filesMaral->marala }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">State Type</td>
                        <td style="border:1px solid black;">{{ $files_data->state_type }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Sold Date</td>
                        <td style="border:1px solid black;">
                        @isset($files_data->sold_date)
                            {{ date('d-m-Y',strtotime($files_data->sold_date)) }}
                        @endisset
                        </td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Sale Amount</td>
                        <td style="border:1px solid black;">{{ number_format($files_data->sale_amount) }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Customer</td>
                        <td style="border:1px solid black;">
                        @isset($files_data->customer_id)
                            {{ $files_data->filesCustomer->custfname." ".$files_data->filesCustomer->custlname }}
                        @endisset
                        </td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Agent</td>
                        <td style="border:1px solid black;">
                        @isset($files_data->agent_id)
                         {{ $files_data->filesAgent->fname." ".$files_data->filesAgent->lname }}
                         @endisset
                        </td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Agent Commission</td>
                        <td style="border:1px solid black;">{{ number_format($files_data->commission_amount) }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Payment From Account</td>
                        <td style="border:1px solid black;">{{ $files_data->filesPaymentAccount->account_name }}</td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Payment Received Account</td>
                        <td style="border:1px solid black;">
                        @isset($files_data->account_id_recv)
                            {{ $files_data->filesPaymentRecvAccount->account_name }}
                        @endisset
                        </td>
                     </tr>

                     <tr>
                        <td style="border:1px solid black;">Description</td>
                        <td style="border:1px solid black;">{!! $files_data->description !!}</td>
                     </tr>
                </tbody>
                
                </table>
            </div>
        </div>
		
    @endsection