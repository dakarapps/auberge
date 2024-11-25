@php
  $itemId = null;
  $sentQty = null;
  $rcvQty = null;
  $price = null;
  if(isset($item)){
    $itemId = $item->item_id;
    $sentQty = $item->sent_item_qty;
    $rcvQty = $item->rcv_item_qty;
    $price = $item->item_price;
  }
  if(isset($blank_form)){
    $itemId = null;
    $sentQty = null;
    $rcvQty = null;
    $price = null;
  }
@endphp
<div class="row laundry_item_elem per_item_elem">
  <div class="col-md-2 col-sm-2 col-xs-12">
    <label class="control-label {{$show_label ? '' : 'hide_elem'}}"> {{lang_trans('txt_laundry_item')}} </label>
    {{ Form::select('item[ids][]',$item_list,$itemId,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
  </div>
  <div class="col-md-2 col-sm-2 col-xs-12">
    <label class="control-label {{$show_label ? '' : 'hide_elem'}}"> {{lang_trans('txt_qty')}} </label>
    {{Form::number('item[sent_qty][]',$sentQty,['class'=>"form-control col-md-7 col-xs-12 per_item_sent_qty", "id"=>"sent_qty", "min"=>1, "step"=>1, "required"=>"required"])}}
  </div>
  @if($isShowFinalStepElem)
    <div class="col-md-2 col-sm-2 col-xs-12">
      <label class="control-label {{$show_label ? '' : 'hide_elem'}}"> {{lang_trans('txt_rcv_qty')}} </label>
      {{Form::number('item[rcv_qty][]',$rcvQty,['class'=>"form-control col-md-7 col-xs-12 per_item_rcv_qty", "id"=>"rcv_qty", "min"=>1, "step"=>1, "required"=>"required"])}}
    </div>
    <div class="col-md-2 col-sm-2 col-xs-12">
      <label class="control-label {{$show_label ? '' : 'hide_elem'}}"> {{lang_trans('txt_price')}} </label>
      {{Form::text('item[price][]',$price,['class'=>"form-control col-md-7 col-xs-12 per_item_price", "id"=>"price", "required"=>"required"])}}
    </div>
  @endif
  <div class="col-md-2 col-sm-2 col-xs-12"> 
    @if($show_plus_btn)
      <label class="control-label {{$show_label ? '' : 'hide_elem'}}"> &nbsp;</label><br/>
      <button type="button" class="btn btn-success add-row"><i class="fa fa-plus"></i></button>
    @else
      <button type="button" class="btn btn-danger delete-row"><i class="fa fa-minus"></i></button>
    @endif
  </div>
</div> 