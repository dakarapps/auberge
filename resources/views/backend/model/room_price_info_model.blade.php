<div id="room_price_model_{{$key}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{lang_trans('txt_date_wise_price_info')}}</h4>
      </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
             <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th width="20%" class="text-center">{{lang_trans('txt_date')}}</th>
                  <th width="20%" class="text-center">{{lang_trans('txt_price')}}</th>
                </tr>
              </thead>
              <tbody class="">
                @forelse($list as $dt=>$rs)
                  <tr>
                    <td class="text-center">{{dateConvert($dt)}}</td>
                    <td class="text-right">{{getCurrencySymbol()}} {{numberFormat($rs['price'])}}</td>
                  </tr>
                @empty
                @endforelse
                <tr>
                  <td></td>
                  <td class="text-right"><b>{{getCurrencySymbol()}} {{($total)}}</b></td>
                </tr>
              </tbody>
            </table>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>