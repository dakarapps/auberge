@php 
  $orderStatus = getConstants('LIST_LAUNDRY_ORDER_STATUS');
@endphp
<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>S.No.</th>
      <th>Vendor</th>
      <th>Invoice No.</th>
      <th>Order No.</th>
      <th>Order Date</th>
      <th>Room</th>
      <th>Order Status</th>
      <th>Gst</th>
      <th>Cgst</th>
      <th>Total Amount</th>
      <th>Customer Name</th>
      <th>Customer Mobile</th>
    </tr>
  </thead>
  <tbody>
    @foreach($datalist as $k=>$val)
      <tr>
        <td>{{$k+1}}</td>
        <td>{{$val->vendor_info->vendor_name}}</td>
        <td>{{$val->invoice_num}}</td>
        <td>{{$val->order_num}}</td>
        <td>{{dateConvert($val->order_date, 'Y-m-d')}}</td>
        <td>{{ ($val->room_info) ? $val->room_info->room_no.' | '.$val->room_info->room_name : '' }}</td>
        <td>{{$orderStatus[$val->order_status]}}</td>
        <td>{{numberFormat($val->gst_amount)}}</td>
        <td>{{numberFormat($val->cgst_amount)}}</td>
        <td>{{numberFormat($val->total_amount)}}</td>
        <td>{{$val->customer_name}}</td>
        <td>{{$val->customer_mobile}}</td>
      </tr>
    @endforeach
    </tbody>
</table>
