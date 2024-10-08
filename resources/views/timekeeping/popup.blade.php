<div class="modal fade" id="additionalWork" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="additionalWorkTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="additionalWorkTitle">BỔ SUNG CÔNG/NGHỈ PHÉP</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row" id="type-timekeeping">
                <div class="form-group col-md-12" id="col-type-timekeeping">
                    <label for="type" class="form-label small">Loại ngày công</label>
                    <select class="custom-select" id="type">
                        <option selected disabled>Chọn loại ngày công</option>
                        @foreach ($data['npVsBs'] as $item)
                            <option value="{{$item->RowId}}" type="{{$item->WorkDay}}">{{ $item->Name }}</option>
                        @endforeach
                    </select>
                    <span id="validate-type-error" class="text-danger small"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="start" class="form-label small">Từ ngày</label>
                    <input type="date" class="form-control" id="start">
                    <span id="validate-start-error" class="text-danger small"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="end" class="form-label small">Đến ngày</label>
                    <input type="date" class="form-control" id="end">
                    <span id="validate-end-error" class="text-danger small"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="description" class="form-label small">Lý do</label>
                    <textarea class="form-control" id="description" class="text-danger small"></textarea>
                    <span id="validate-description-error" class="text-danger small"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    Số ngày nghỉ phép còn lại: {{ $data['vacation'] }} phép
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary shadow-sm" id="supplements_and_leave">Bổ sung</button>
        </div>
      </div>
    </div>
</div>