<table class="table table-bordered">
  <thead>
    <tr>
      <th>{{lang_trans('txt_sno')}}</th>
      <th>{{lang_trans('txt_product')}}</th>
      <th>{{lang_trans('txt_room')}}</th>
      <th>{{lang_trans('txt_stock')}}</th>
      <th>{{lang_trans('txt_qty')}}</th>
      <th>{{lang_trans('txt_price')}}</th>
      <th>{{lang_trans('txt_by')}}</th>
      <th>{{lang_trans('txt_date')}}</th>
      <th>{{lang_trans('txt_remark')}}</th>
    </tr>
  </thead>
  <tbody>
    @if($datalist->count()>0)
    @foreach($datalist as $k=>$val)
      <tr>
        <td>{{$k+1}}</td>
        <td>{{$val->product->name}}</td>
        <td>{{($val->room) ? $val->room->room_no.' ('.$val->room->room_name.')' : ''}}</td>
        <td>{{ucfirst($val->stock_is)}}</td>
        <td>{{$val->qty}}</td>
        <td>@if($val->price>0) {{getCurrencySymbol()}} {{$val->price}} @endif</td>
        <td>{{ucfirst($val->user->name)}}</td>
        <td>{{dateConvert($val->created_at,'d-m-Y h:i')}}</td>
        <td>{!!$val->remark!!}</td>
      </tr>
    @endforeach
    @endif
  </tbody>
</table>