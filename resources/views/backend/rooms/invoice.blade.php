@php 
  $settings = getSettings();
@endphp
<!DOCTYPE html>
<html lang="en">
     <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <title>{{$settings['site_page_title']}}: Invoice</title>
        <link href="{{URL::asset('public/assets/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('public/css/invoice_style.css')}}" rel="stylesheet">
    </head>
    <body>
        @php 
            $invTypeList = ['org'=>'ORIGINAL', 'dup'=>'DUPLICATE'];
            $invoiceType = (isset($invTypeList[Request::segment(5)])) ? $invTypeList[Request::segment(5)] : '';
  
            $invoiceNum = $data_row->invoice_num;
            if($type==2){
                $invoiceNum = ($data_row->orders_info!=null) ? $data_row->orders_info->invoice_num : '';
            }

            $calculatedAmount = calcFinalAmount($data_row, 1);
            $additionalAmount = $calculatedAmount['additionalAmount'];
            $additionalAmountReason = $data_row->additional_amount_reason;

            $gstPerc = $calculatedAmount['totalRoomGstPerc'];
            $cgstPerc = $calculatedAmount['totalRoomCGstPerc'];
            $roomAmountGst = $calculatedAmount['totalRoomAmountGst'];
            $roomAmountCGst = $calculatedAmount['totalRoomAmountCGst'];
            $totalRoomAmount = $calculatedAmount['subtotalRoomAmount'];
            $advancePayment = $calculatedAmount['advancePayment'];
            $roomAmountDiscount = $calculatedAmount['totalRoomAmountDiscount'];
            $finalRoomAmount = $calculatedAmount['finalRoomAmount']+$additionalAmount;

            $gstPercFood = $calculatedAmount['totalOrderGstPerc'];
            $cgstPercFood = $calculatedAmount['totalOrderCGstPerc'];
            $foodAmountGst = $calculatedAmount['totalOrderAmountGst'];
            $foodAmountCGst = $calculatedAmount['totalOrderAmountCGst'];
            $foodOrderAmountDiscount = $calculatedAmount['totalOrderAmountDiscount'];
            $gstFoodApply = $calculatedAmount['gstFoodApply'];
            $totalOrdersAmount = $calculatedAmount['subtotalOrderAmount'];
            $finalOrderAmount = $calculatedAmount['finalOrderAmount'];

        @endphp
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 class-inv-11">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <strong>
                            GSTIN: {{$settings['gst_num']}}
                        </strong>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                        <strong>
                            Tax Invoice
                        </strong>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
                        <strong>
                            Ph. {{$settings['hotel_phone']}}
                        </strong>
                        <br/>
                        <strong>
                            (M) {{$settings['hotel_mobile']}}
                        </strong>
                    </div>
                </div>
            </div>
            <div class="row text-center p-rel">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <span class="class-inv-12">
                        {{$settings['hotel_name']}}
                    </span>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <img src="{{checkFile(@$settings['site_logo'],'uploads/logo/','default_logo.jpg')}}" width="{{@$settings['site_logo_width']}}" height="{{@$settings['site_logo_height']}}" class="inv-logo">
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="class-inv-13">
                        {{$settings['hotel_tagline']}}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="class-inv-14">
                        {{$settings['hotel_address']}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="class-inv-15">
                        <span>
                            {{$settings['hotel_website']}}
                        </span>
                        |
                        <span>
                            E-mail:-
                        </span>
                        <span>
                            {{$settings['hotel_email']}}
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 class-inv-6">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <strong class="fsize-label">
                            No.:
                            <span class="class-inv-19">
                                {{$invoiceNum}}
                            </span>
                        </strong>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                        <br/>
                        <strong class="fsize-label">
                            Dated :
                        </strong>
                        <spa class-inv-16n="">
                            {{dateConvert($data_row->check_out,'d-m-Y H:i')}}
                        </spa>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table bank-details-tbl">
            <thead>
                <tr>
                    <th>Customer Name:</th>
                    <td colspan="2">
                        <div class="class-inv-16">
                            {{$data_row->customer->name}}
                        </div>
                    </td>
                    <th class="text-right">{{strtoupper($invoiceType)}}</th>
                </tr>
                <tr>
                    <th>Comapny Company:</th>
                    <td colspan="{{(!$data_row->company_gst_num) ? 3 : ''}}">
                        <div class="class-inv-16">
                            {{$data_row->company_name}}&nbsp;
                        </div>
                    </td>
                    @if($data_row->company_gst_num)
                        <th>GST No.</th>
                        <td>
                            <div class="class-inv-16">
                                {{$data_row->company_gst_num}}
                            </div>
                        </td>
                    @endif
                </tr>
                <tr>
                    <th>Address:</th>
                    <td colspan="3">
                        <div class="class-inv-16">
                            {{$data_row->customer->address}}
                        </div>
                    </td>
                </tr>
                @if($type==1)
                    <tr>
                        <th>Check In:</th>
                        <td>
                            <div class="class-inv-16">
                                {{dateConvert($data_row->check_in,'d-m-Y H:i')}}
                            </div>
                        </td>
                        <th>Check Out:</th>
                        <td>
                            <div class="class-inv-16">
                                {{dateConvert($data_row->check_out,'d-m-Y H:i')}}
                            </div>
                        </td>
                    </tr>
                @endif
            </thead>
        </table>
    </div>
</div>
@if($type==1)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">{{lang_trans('txt_sno')}}.</th>
                        <th class="text-center" width="10%">HSN/SAC</th>
                        <th class="text-center" width="30%">Room Name/No.</th>
                        <th class="text-center" width="10%">Total Days</th>
                        {{-- <th class="text-center" width="10%">Room Rent ({{getCurrencySymbol()}})</th> --}}
                        <th>&nbsp;</th>
                        <th class="text-center" width="10%">Amount ({{getCurrencySymbol()}})</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data_row->booked_rooms) 
                        @foreach($data_row->booked_rooms as $key=>$roomInfo)
                            @php
                              $checkIn = dateConvert($roomInfo->check_in, 'Y-m-d');
                              $checkOut = dateConvert($roomInfo->check_out, 'Y-m-d');
                              $durOfStayPerRoom = dateDiff($checkIn, $checkOut, 'days');
                              // $amountPerRoom = ($durOfStayPerRoom * $roomInfo->room_price);
                              $priceInfo = getDateWisePriceList($roomInfo->date_wise_price);
                              $amountPerRoom = $priceInfo[1];
                            @endphp
                            <tr>
                              <td class="text-center">{{$key+1}}</td>
                              <td class="text-center">9963</td>
                              <td>
                                  {{ ($roomInfo->room_type) ? $roomInfo->room_type->title : ""}}
                                  ({{lang_trans('txt_room_num')}} : {{$roomInfo->room->room_no}})
                              </td>
                              <td class="text-center">
                                <span class="{{ ($roomInfo->swapped_from_room) ? 'swapped_room' : 'no_swapped_room'}}">{{$durOfStayPerRoom}}</span>
                              </td>
                              {{-- <td class="text-right">{{ numberFormat($roomInfo->room_price) }}</td> --}}
                              <td>&nbsp;</td>
                              <td class="text-right">{{ numberFormat($amountPerRoom) }}</td>
                            </tr>
                        @endforeach
                    @endif
                    <tr>
                        <th class="text-right" colspan="5">Total</th>
                        <td class="text-right">{{ numberFormat($totalRoomAmount) }}</td>
                    </tr>
                    @if($roomAmountGst>0)
                    <tr>
                        <th class="text-right" colspan="5">GST ({{$gstPerc}} %)</th>
                        <td class="text-right">{{ numberFormat($roomAmountGst) }}</td>
                    </tr>
                    <tr>
                        <th class="text-right" colspan="5">CGST ({{$cgstPerc}} %)</th>
                        <td class="text-right">{{ numberFormat($roomAmountCGst) }}</td>
                    </tr>
                    @endif
                        @if($advancePayment>0)
                    <tr>
                        <th class="text-right" colspan="5">Less Advance</th>
                        <td class="text-right">{{ numberFormat($advancePayment) }}</td>
                    </tr>
                    @endif
                    @if($roomAmountDiscount>0)
                    <tr>
                        <th class="text-right" colspan="5">Discount</th>
                        <td class="text-right">{{ numberFormat($roomAmountDiscount) }}</td>
                    </tr>
                    @endif
                    @if($additionalAmount>0)
                    <tr>
                        <th class="text-right" colspan="5">{{$additionalAmountReason}}</th>
                        <td class="text-right">{{ numberFormat($additionalAmount) }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th class="text-right" colspan="5">Grand Total</th>
                        <td class="text-right">{{ numberFormat($finalRoomAmount) }}</td>
                    </tr>
                    <tr>
                        <th class="text-right" colspan="2">Amount in Words:-</th>
                        <td class="class-inv-17" colspan="4">{{ getIndianCurrency(numberFormat($finalRoomAmount)) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            @if(@$settings['bank_name'] && @$settings['bank_acc_num'])
                                <div>
                                    <table class="table table-condensed bank-details-tbl">
                                        <tr>
                                            <th colspan="2">Bank Details</th>
                                        </tr>
                                        <tr>
                                            <td>Name:</td>
                                            <td>{{@$settings['bank_acc_name']}}</td>
                                        </tr>
                                        <tr>
                                            <td>IFSC Code:</td>
                                            <td>{{@$settings['bank_ifsc_code']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Account No.:</td>
                                            <td>{{@$settings['bank_acc_num']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Bank & Branch:</td>
                                            <td>{{@$settings['bank_name']}}, {{$settings['bank_branch']}}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        </td>
                        <td colspan="1">
                            <div class="class-inv-20">
                                Guest Sign
                            </div>
                        </td>
                        <td class="text-right" colspan="1">
                            <div class="class-inv-20">
                                Cashier Sign
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">Terms and Conditions</th>
                        <td colspan="4">The Hotel is obliged to avail the rooms that the guest has reserved in accordance with these Terms and Conditions and to provide the agreed services.</td>
                    </tr>
                    <tr>
                        <th class="text-center" colspan="6">
                                Thank you for staying with us.
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endif

@if($type==2)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" width="2%">{{lang_trans('txt_sno')}}.</th>
                        <th class="text-center" width="20%">Item Details</th>
                        <th class="text-center" width="5%">HSN/SAC</th>
                        <th class="text-center" width="5%">Date</th>
                        <th class="text-center" width="5%">Item Qty</th>
                        <th class="text-center" width="5%">Item Price ({{getCurrencySymbol()}})</th>
                        <th class="text-center" width="10%">Amount ({{getCurrencySymbol()}})</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data_row->orders_items as $k=>$val)
                      @php
                        $totalOrdersAmount = $totalOrdersAmount + ($val->item_qty*$val->item_price);
                      @endphp
                        <tr>
                            <td class="text-center">{{$k+1}}</td>
                            <td class="">{{$val->item_name}}</td>
                            <td class="text-center">9963</td>
                            <td class="text-center">{{dateConvert($val->check_out,'d-m-Y')}}</td>
                            <td class="text-center">{{$val->item_qty}}</td>
                            <td class="text-center">{{numberFormat($val->item_price)}}</td>
                            <td class="text-center">{{numberFormat($val->item_qty*$val->item_price)}}</td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="7">No Orders</td>
                    </tr>
                    @endforelse
                    <tr>
                        <th class="text-right" colspan="6">Total</th>
                        <td class="text-right">{{ numberFormat($totalOrdersAmount) }}</td>
                    </tr>
                    @if($foodAmountGst>0)
                    <tr>
                        <th class="text-right" colspan="6">GST ({{$gstPercFood}} %)</th>
                        <td class="text-right">{{ numberFormat($foodAmountGst) }}</td>
                    </tr>
                    @endif
                        @if($foodAmountCGst>0)
                    <tr>
                        <th class="text-right" colspan="6">CGST ({{$cgstPercFood}} %)</th>
                        <td class="text-right">{{ numberFormat($foodAmountCGst) }}</td>
                    </tr>
                    @endif
                    
                    @if($foodOrderAmountDiscount>0)
                        <tr>
                            <th class="text-right" colspan="6">Discount</th>
                            <td class="text-right">{{ numberFormat($foodOrderAmountDiscount) }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th class="text-right" colspan="6">Grand Total</th>
                        <td class="text-right">{{ numberFormat($finalOrderAmount) }}</td>
                    </tr>
                    <tr>
                        <th class="text-right" colspan="2">Amount in Words:-</th>
                        <td class="class-inv-17" colspan="5">{{ getIndianCurrency(numberFormat($finalOrderAmount)) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div>
                                <table class="table table-condensed bank-details-tbl">
                                    <tr>
                                        <th colspan="2">Bank Details</th>
                                    </tr>
                                    <tr>
                                        <td>Name:</td>
                                        <td>{{$settings['bank_acc_name']}}</td>
                                    </tr>
                                    <tr>
                                        <td>IFSC Code:</td>
                                        <td>{{$settings['bank_ifsc_code']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Account No.:</td>
                                        <td>{{$settings['bank_acc_num']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Bank & Branch:</td>
                                        <td>{{$settings['bank_name']}}, {{$settings['bank_branch']}}</td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="class-inv-20">
                                Guest Sign
                            </div>
                        </td>
                        <td class="text-right" colspan="2">
                            <div class="class-inv-20">
                                Cashier Sign
                            </div>
                        </td>
                    </tr>
                     <tr>
                        <th colspan="2">Terms and Conditions</th>
                        <td class="" colspan="5">The Hotel is obliged to avail the rooms that the guest has reserved in accordance with these Terms and Conditions and to provide the agreed services.</td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="7">
                            <div class="">
                                Thank you for staying with us.
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        {!!$settings['invoice_term_condition']!!}
    </div>
@endif
<div class="col-sm-12 text-center no-print">
    <br/>
    <button class="btn btn-sm btn-success no-print" onclick="window.print()">
        {{lang_trans('btn_print')}}
    </button>
    <br/><br/>
</div>