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
  $jsonDecode = json_decode($data_row->amount_json);

  $discount = (isset($jsonDecode->room_amount_discount)) ? $jsonDecode->room_amount_discount : 0;

  $durOfStay = $data_row->duration_of_stay;
  $perRoomPrice = $data_row->per_room_price;
  $roomQty = $data_row->room_qty;
  $totalAmount = ($durOfStay * $perRoomPrice * $roomQty); 

  $gstPerc = $data_row->gst_perc;
  $cgstPerc = $data_row->cgst_perc;

  $gst =  gstCalc($totalAmount,'room_amount',$gstPerc,$cgstPerc);
  $roomAmountGst = $gst['gst'];
  $roomAmountCGst = $gst['cgst'];

  $advancePayment = $data_row->advance_payment;  
  $finalAmount = $totalAmount+$roomAmountGst+$roomAmountCGst-$advancePayment-$discount;
  
  $totalOrdersAmount = 0;

  $invoiceNum = $data_row->invoice_num;
  if($type==2){
    $invoiceNum = ($data_row->orders_info!=null) ? $data_row->orders_info->invoice_num : '';
  }

  $rooms = [];
  if($data_row->room_num){
    $exp = explode(',', $data_row->room_num);
    foreach($exp as $roomNum){
        $roomData = getRoomByNum($roomNum);
        if($roomData){
            $rooms[$roomNum] = $roomData->room_name;
        }
    }
  }
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
                            Advance Slip
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
                        {{-- <strong class="fsize-label">
                            No.:
                            <span class="class-inv-19">
                                {{$invoiceNum}}
                            </span>
                        </strong> --}}
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                        <br/>
                        <strong class="fsize-label">
                            Dated :
                        </strong>
                        <spa class-inv-16n="">
                            {{dateConvert($data_row->created_at,'d-m-Y H:i')}}
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
                    <th>Comapny Name:</th>
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
                            {{addSubDate('+', $data_row->duration_of_stay, $data_row->check_in, 'd-m-Y H:i')}}
                        </div>
                    </td>
                </tr>
                @endif
            </thead>
        </table>
    </div>
</div>
@if($type==1)
<div class="row page-break">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" width="5%">
                        {{lang_trans('txt_sno')}}.
                    </th>
                    <th class="text-center" width="30%">
                        Description
                    </th>
                    <th class="text-center" width="10%">
                        HSN/SAC
                    </th>
                    <th class="text-center" width="30%">
                        Room Name/No.
                    </th>
                    <th class="text-center" width="10%">
                        Room Qty
                    </th>
                    <th class="text-center" width="10%">
                        Room Rent ({{getCurrencySymbol()}})
                    </th>
                    <th class="text-center" width="10%">
                        Total Days
                    </th>
                    <th class="text-center" width="10%">
                        Amount ({{getCurrencySymbol()}})
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">
                        1.
                    </td>
                    <td class="text-center">
                        {{$data_row->customer->name}}
                    </td>
                    <td class="text-center">
                        9963
                    </td>
                    <td class="text-center">
                        @if(count($rooms))
                            @foreach($rooms as $rNum=>$rName)
                                {{$rName.' ('.$rNum.')'}}<br/>
                            @endforeach
                        @else
                            {{$data_row->room_num}}
                        @endif
                    </td>
                    <td class="text-center">
                        {{$data_row->room_qty}}<br/>
                    </td>
                    <td class="text-center">
                        {{$data_row->per_room_price}}
                    </td>
                    <td class="text-center">
                        {{$data_row->duration_of_stay}}
                    </td>
                    <td class="text-center">
                        {{ $totalAmount }}
                    </td>
                </tr>
                <tr>
                    <th class="text-right" colspan="7">
                        Total
                    </th>
                    <td class="text-right">
                        {{ numberFormat($totalAmount) }}
                    </td>
                </tr>
                @if($roomAmountGst>0)
                <tr>
                    <th class="text-right" colspan="7">
                        GST ({{$gstPerc}} %)
                    </th>
                    <td class="text-right">
                        {{ numberFormat($roomAmountGst) }}
                    </td>
                </tr>
                <tr>
                    <th class="text-right" colspan="7">
                        CGST ({{$cgstPerc}} %)
                    </th>
                    <td class="text-right">
                        {{ numberFormat($roomAmountCGst) }}
                    </td>
                </tr>
                @endif
                    @if($advancePayment>0)
                <tr>
                    <th class="text-right" colspan="7">
                        Advance
                    </th>
                    <td class="text-right">
                        {{ numberFormat($advancePayment) }}
                    </td>
                </tr>
                @endif
                    @if($discount>0)
                <tr>
                    <th class="text-right" colspan="7">
                        Discount
                    </th>
                    <td class="text-right">
                        {{ numberFormat($discount) }}
                    </td>
                </tr>
                @endif
                <tr>
                    <th class="text-right" colspan="7">
                        Grand Total
                    </th>
                    <td class="text-right">
                        {{ numberFormat($finalAmount) }}
                    </td>
                </tr>
                <tr>
                    <th class="text-right" colspan="2">
                        Amount in Words:-
                    </th>
                    <td class="class-inv-17" colspan="6">
                        {{ getIndianCurrency(numberFormat($finalAmount)) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
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
            </tbody>
        </table>
    </div>
</div>
<div>
    <table class="table table-bordered">
        <tr>
            <th class="">
                Terms and Conditions
            </th>
        </tr>
        <tr>
            <td>
                <ul>
                    <li>SMS and valid photo id proof (passport with VISA, Voter ID card, driving licence , Aadhar card etc.) at the time of check in.</li>
                    <li>Final payment required at the time of check in if pending and invoice will be provided by Aranyak Hotel & Resort.</li>
                    <li>Rooms may be changed due to any unavoidable circumstances.</li>
                    <li>In-case of transfer booking - Any transfer to other hotel / resort, the remaining amount should be paid by the guest.</li>
                    <li>Any damage made to the furniture and fixtures of the hotel by the guest during their stay will be billed to the guest.</li>
                    <li>No pets are allowed inside the hotel premises.</li>
                    <li>In the event of a natural calamity or disaster, poor weather condition, any civil disturbance, suspension of service related to transportation, accommodation etc. Any governmental order or other circumstances which are beyond our  control and when safe and smooth tour operation according to the itinerary specified in the travel contract has become impossible or there is  valid reason to believe that the tour can’t be continued.</li>
                    <li>Refund and Cancellation Policy:-
                        <ul>
                            <li>25% cancellation charges will apply on total amount after confirmation till 15 days of travel date.</li>
                            <li>50% cancellation charges will apply on total amount if canceled between 14 - 07 days of travel date.</li>
                            <li>75% cancellation charges will apply on total amount if canceled between 06- 03 days of travel date.</li>
                            <li>100% cancellation charges will apply on total amount if canceled on or before 02 days of travel date.</li>
                        </ul>
                    </li>
                    <li>50% advance will be applicable on total amount of the booking charges.</li>
                    <li>The authority of Aranyak Hotel & Resort will not be held responsible for any type of electrical fault and distribution. During load shedding lift, Air- conditioning and geyser will not be functional.</li>
                    <li>SMS opted in.</li>
                </ul>
            </td>
        </tr>
        <tr>
            <th class="text-center">
                    Thank you for staying with us.
            </th>
        </tr>
    </table>
</div>

@endif

<div class="col-sm-12 text-center no-print">
    <br/>
    <button class="btn btn-sm btn-success no-print" onclick="window.print()">
        {{lang_trans('btn_print')}}
    </button>
    <br/><br/>
</div>