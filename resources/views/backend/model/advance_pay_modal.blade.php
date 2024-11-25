<div id="advance_pay_{{$val->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{lang_trans('btn_advance_pay')}}</h4>
      </div>
      {{ Form::open(array('url'=>route('advance-pay'),'id'=>"advance-pay-form")) }}
      {{ Form::hidden('id', $val->id) }}

        <div class="modal-body">
          <div class="form-group w-100">
              <label class="control-label col-sm-12 text-success">Previous Advance: {{($val->advance_payment) ? $val->advance_payment : 0}}</label>
          </div>
          <br/>
          <div class="form-group w-100">
              <label class="control-label col-sm-12">{{lang_trans('txt_amount')}}<span class="required">*</span></label>
              <div class="col-sm-12">
                  {{ Form::number('advance_payment',null,array('class'=>"form-control w-100", 'min'=>0, 'required'=>true, 'placeholder'=>'Add More Amount')) }}
              </div>
          </div>
          <div class="form-group w-100">
              <label class="control-label col-sm-12">{{lang_trans('txt_payment_mode')}}<span class="required">*</span></label>
              <div class="col-md-12">
                {{Form::select('payment_mode',config('constants.PAYMENT_MODES'),null,['class'=>"form-control", 'required'=>true, "placeholder"=>"--Select"])}}
              </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{lang_trans('btn_cancel')}}</button>
          <button type="submit" class="btn btn-success">{{lang_trans('btn_submit')}}</button>
        </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
