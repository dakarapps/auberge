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
            $invoiceNum = $data_row->order_num;
            $calculatedAmount = calcLaundryAmount($data_row, 1);
            $gstApply = $calculatedAmount['gstApply'];
            $gstPerc = $calculatedAmount['gstPerc'];
            $cgstPerc = $calculatedAmount['cgstPerc'];
            $gstAmount = $calculatedAmount['gstAmount'];
            $cgstAmount = $calculatedAmount['cgstAmount'];
            $totalDiscount = $calculatedAmount['totalDiscount'];
            $subtotalAmount = $calculatedAmount['subtotalAmount'];
            $totalAmount = $calculatedAmount['totalAmount'];
        @endphp
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 class-inv-11">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <strong>GSTIN: {{$settings['gst_num']}}</strong>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                        <strong>Tax Invoice</strong>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
                        <strong>Ph. {{$settings['hotel_phone']}}</strong>
                        <br/>
                        <strong>(M) {{$settings['hotel_mobile']}}</strong>
                    </div>
                </div>
            </div>
            <div class="row text-center p-rel">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <span class="class-inv-12">{{$settings['hotel_name']}}</span>
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
                            {{dateConvert($data_row->order_date,'d-m-Y')}}
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
                            {{$data_row->customer_name}}
                        </div>
                    </td>
                    <th class="text-right"></th>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td colspan="3">
                        <div class="class-inv-16">
                            {{$data_row->customer_address}}
                        </div>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" width="2%">{{lang_trans('txt_sno')}}.</th>
                        <th class="text-center" width="20%">{{lang_trans('txt_laundry_item')}}</th>
                        <th class="text-center" width="5%">{{lang_trans('txt_qty')}}</th>
                        <th class="text-center" width="5%">{{lang_trans('txt_rcv_qty')}}</th>
                        <th class="text-center" width="10%">{{lang_trans('txt_price')}} ({{getCurrencySymbol()}})</th>
                        <th class="text-center" width="10%">{{lang_trans('txt_total')}} ({{getCurrencySymbol()}})</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data_row->order_items) 
                      @foreach($data_row->order_items as $key=>$orderItem)
                        <tr class="per_room_tr">
                          <td class="text-center">{{$key+1}}</td>
                          <td>{{ ($orderItem->item_info) ? $orderItem->item_info->name : ""}}</td>
                          <td class="text-center">{{$orderItem->sent_item_qty}}</td>
                          <td class="text-center">{{$orderItem->rcv_item_qty}}</td>
                          <td class="text-right">{{numberFormat($orderItem->item_price)}}</td>
                          <td class="text-right">{{numberFormat($orderItem->item_price*$orderItem->rcv_item_qty)}}</td>
                        </tr>
                      @endforeach
                    @endif
                    <tr>
                        <th class="text-right" colspan="5">Subtotal</th>
                        <td class="text-right">{{ numberFormat($subtotalAmount) }}</td>
                    </tr>
                    @if($gstAmount>0)
                        <tr>
                            <th class="text-right" colspan="5">GST ({{$gstPerc}} %)</th>
                            <td class="text-right">{{ numberFormat($gstAmount) }}</td>
                        </tr>
                    @endif
                    @if($cgstAmount>0)
                        <tr>
                            <th class="text-right" colspan="5">CGST ({{$cgstPerc}} %)</th>
                            <td class="text-right">{{ numberFormat($cgstAmount) }}</td>
                        </tr>
                    @endif
                    @if($totalDiscount>0)
                        <tr>
                            <th class="text-right" colspan="5">Discount</th>
                            <td class="text-right">{{ numberFormat($totalDiscount) }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th class="text-right" colspan="5">Grand Total</th>
                        <td class="text-right">{{ numberFormat($totalAmount) }}</td>
                    </tr>
                    <tr>
                        <th class="text-right" colspan="2">Amount in Words:-</th>
                        <td class="class-inv-17" colspan="4">{{ getIndianCurrency(numberFormat($totalAmount)) }}</td>
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
                </tbody>
            </table>
        </div>
    </div>

<div class="col-sm-12 text-center no-print">
    <br/>
    <button class="btn btn-sm btn-success no-print" onclick="window.print()">
        {{lang_trans('btn_print')}}
    </button>
    <br/><br/>
</div>