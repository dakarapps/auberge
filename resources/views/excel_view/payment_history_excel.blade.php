@php 
  $i = $j = 0; 
  $totalAmount = 0;
  $totalNetAmoun = 0;
  $totalIncomeAmount = 0;
  $totalExpenseAmount = 0;
@endphp
<table class="table table-bordered">                            
  <thead>
    <tr>
      <th>{{lang_trans('txt_sno')}}</th>
      <th>{{lang_trans('txt_transaction_id')}}</th>
      <th>{{lang_trans('txt_activity')}}</th>
      <th>{{lang_trans('txt_payment_mode')}}</th>
      <th>{{lang_trans('txt_date')}}</th>
      <th>{{lang_trans('txt_total_amount')}}</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($datalist as $k=>$val)
      @if($val->is_checkout==0)
        @php 
          if($val->payment_of=='cr') {
            $totalIncomeAmount += $val->payment_amount;
          }
          else if($val->payment_of=='dr') {
            $totalExpenseAmount += $val->payment_amount;
          }
          $totalAmount += $val->payment_amount;
          $i++; 
        @endphp
      <tr>
        <td>{{$i}}</td>
        <td>{{$val->transaction_id}}</td>
        <td>{{getPaymentPurpose($val->purpose)}}</td>
        <td>{{$val->payment_type}}</td>
        <td>{{dateConvert($val->payment_date  ,'d-m-Y H:i')}}</td>
        <td>{{numberFormat($val->payment_amount)}}</td>
        <td>{{ucfirst($val->payment_of)}}</td>
      </tr>
        @endif
      @endforeach
    </tbody>
</table>

@php
  $totalNetAmoun = $totalIncomeAmount-$totalExpenseAmount;
@endphp
<table class="table table-bordered">
    <tr>
      <th>{{lang_trans('txt_total_income')}}</th>
      <th>{{numberFormat($totalIncomeAmount)}}</th>
    </tr>
    <tr>
      <th>{{lang_trans('txt_total_expense')}}</th>
      <th>{{numberFormat($totalExpenseAmount)}}</th>
    </tr>
    <tr>
      <th>{{lang_trans('txt_total_netamount')}}</th>
      <th>{{numberFormat($totalNetAmoun)}}</th>
    </tr>
    <tr>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <th>Amount In ({{getCurrencySymbol()}})</th>
      <th></th>
    </tr>
</table>