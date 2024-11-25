@extends('layouts.master_backend')
@section('content')
@php 
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
<div class="">
      <div class="row" id="new_guest_section">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_guest_info')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content"> 
                <div class="row"> 
                  <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <tr>
                              <th>{{lang_trans('txt_fullname')}}</th>
                              <td>{{$data_row->customer_name}}</td>
                              <th>{{lang_trans('txt_email')}}</th>
                              <td>{{$data_row->customer_email}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_mobile_num')}}</th>
                              <td>{{$data_row->customer_mobile}}</td>
                              <th>{{lang_trans('txt_gender')}}</th>
                              <td>{{$data_row->customer_gender}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_address')}}</th>
                              <td colspan="3">{{$data_row->customer_address}}</td>
                            </tr>
                          
                          </tbody>
                        </table>
                      </div>
                </div>
              </div>
          </div>
      </div>
  </div>
  
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_content">
                  <div class="row">
                       <div class="col-md-12 col-sm-12 col-xs-12">
                          <table class="table table-bordered">
                            <tr>
                              <th>{{lang_trans('txt_vendor')}}</th>
                              <td>{{$data_row->vendor_info->vendor_name}}</td>
                              <th>{{lang_trans('txt_room')}}</th>
                              <td>{{ ($data_row->room_info) ? $data_row->room_info->room_no.' | '.$data_row->room_info->room_name : '' }}</td>                              
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_order_num')}}</th>
                              <td>{{$data_row->order_num}}</td>
                              <th>{{lang_trans('txt_order_date')}}</th>
                              <td>{{ ($data_row->order_date!=null) ? dateConvert($data_row->order_date,'d-m-Y') : 'NA'}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_order_status')}}</th>
                              <td>{!!getStatusBtn($data_row->order_status,4)!!}</td>
                              <th></th>
                              <td></td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_rcvd_invoice_num')}}</th>
                              <td>{{$data_row->invoice_num}}</td>  
                              <th>{{lang_trans('txt_rcv_date')}}</th>
                              <td>{{ ($data_row->received_date!=null) ? dateConvert($data_row->received_date,'d-m-Y') : 'NA'}}</td>
                            </tr>
                             <tr>
                              <th>{{lang_trans('txt_rcvd_invoice')}}</th>
                              <td>
                                @if($data_row->invoice)
                                  <a href="{{checkFile($data_row->invoice->file,'uploads/laundry_invoice/','blank_id.jpg')}}" class="btn btn-xs btn-primary" download><i class="fa fa-download"></i> {{lang_trans('txt_download')}} </a>
                                @endif
                              </td>                            
                              <th>{{lang_trans('txt_remark')}}</th>
                              <td colspan="3">{{$data_row->remark}}</td>
                            </tr>
                          </table>
                        </div>
                           
                  </div>                  
              </div>
          </div>
      </div>
  </div>

  

  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_payment_info')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th class="text-center" width="2%">{{lang_trans('txt_sno')}}.</th>
                              <th class="text-center" width="20%">{{lang_trans('txt_laundry_item')}}</th>
                              <th class="text-center" width="5%">{{lang_trans('txt_qty')}}</th>
                              <th class="text-center" width="5%">{{lang_trans('txt_rcv_qty')}}</th>
                              <th class="text-center" width="10%">{{lang_trans('txt_price')}}</th>
                              <th class="text-center" width="10%">{{lang_trans('txt_total')}}</th>
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
                                  <td class="text-right">{{getCurrencySymbol()}} {{numberFormat($orderItem->item_price)}}</td>
                                  <td class="text-right">{{getCurrencySymbol()}} {{numberFormat($orderItem->item_price*$orderItem->rcv_item_qty)}}</td>
                                </tr>
                              @endforeach
                            @endif
                          </tbody>
                        </table>
                        
                        <table class="table table-bordered">
                              <tr>
                                <th class="text-right">{{lang_trans('txt_subtotal')}}</th>
                                <td width="15%" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($subtotalAmount) }}</td>
                              </tr>
                              <tr>
                                <th class="text-right">{{lang_trans('txt_sgst')}} ({{$data_row->gst_perc}}%)</th>
                                <td width="15%" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($gstAmount) }}</td>
                              </tr>
                              <tr class="{{$data_row->cgst_perc > 0 ? '' : 'hide_elem'}}">
                                <th class="text-right">{{lang_trans('txt_cgst')}} ({{$data_row->cgst_perc}}%)</th>
                                <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($cgstAmount) }}</td>
                              </tr>
                              <tr>
                                <th class="text-right">{{lang_trans('txt_discount')}}</th>
                                <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($totalDiscount) }}</td>
                              </tr>
                              <tr class="bg-success">
                                <th class="text-right">{{lang_trans('txt_final_amount')}}</th>
                                <td width="15%" id="td_final_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($totalAmount) }}</td>
                              </tr>
                        </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>   
@endsection