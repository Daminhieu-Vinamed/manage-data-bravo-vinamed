<div class="modal fade" id="timekeepingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CHẤM CÔNG CHO NGÀY HÔM NAY</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-around">
                    <div class="text-center col-4">
                        <label for="hour" class="h3 text-primary font-weight-bold">GIỜ</label>
                        <div id="hour" class="bg-primary shadow-sm rounded-circle w-50 mx-auto">
                            <h4 class="text-white py-3 run-hour">00</h4>
                        </div>
                    </div>
                    <div class="text-center col-4">
                        <label for="minute" class="h3 text-primary font-weight-bold">PHÚT</label>
                        <div id="minute" class="bg-primary shadow-sm rounded-circle w-50 mx-auto">
                            <h4 class="text-white py-3 run-minute">00</h4>
                        </div>
                    </div>
                    <div class="text-center col-4">
                        <label for="second" class="h3 text-primary font-weight-bold">GIÂY</label>
                        <div id="second" class="bg-primary shadow-sm rounded-circle w-50 mx-auto">
                            <h4 class="text-white py-3 run-second">00</h4>
                        </div>
                    </div>
                </div>
                <div class="bd-highlight mt-4 mx-4">
                    <div class="bd-highlight d-sm-flex align-items-center justify-content-center">
                        <h5 class="text-primary font-weight-bold pb-2 date-today"></h5>
                    </div>
                    <div class="bd-highlight d-sm-flex align-items-center justify-content-between">
                        <p class="font-weight-bold">
                            <b class="text-primary">Thời gian vào:</b>
                            <b
                                id="timekeeping-in">{{ !empty($data['start']) ? date('H:i:s', strtotime($data['start'])) : config('constants.timekeeping.min') }}</b>
                        </p>
                        <p class="font-weight-bold">
                            <b class="text-primary">Thời gian ra:</b>
                            <b
                                id="timekeeping-out">{{ !empty($data['end']) ? date('H:i:s', strtotime($data['end'])) : config('constants.timekeeping.min') }}</b>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if (isset($data['start']))
                    <button class="btn btn-danger shadow-sm" time-now="{{$data['now']}}" id="clock_out">Kết thúc</button>
                @else
                    <button class="btn btn-primary shadow-sm" id="clock_in">Chấm công</button>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="additionalWork" tabindex="-1" role="dialog" aria-labelledby="additionalWorkTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="additionalWorkTitle">BỔ SUNG CÔNG/NGHỈ PHÉP</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="d-sm-flex align-items-center justify-content-center" id="type-timekeeping">
                <div class="form-group col-md-12" id="col-type-timekeeping">
                    <label for="type" class="form-label small">Loại ngày công</label>
                    <select class="form-control" id="type">
                        <option selected disabled>Chọn loại ngày công</option>
                        @foreach ($data['npVsBs'] as $item)
                            <option value="{{$item->RowId}}" type="{{$item->WorkDay}}">{{ $item->Name }}</option>
                        @endforeach
                    </select>
                    <span id="validate-type-error" class="text-danger small"></span>
                </div>
            </div>
            <div class="d-sm-flex align-items-center justify-content-between">
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
            {{-- <div class="d-sm-flex align-items-center justify-content-center">
                <div class="form-group col-md-12">
                    <label for="reason" class="form-label small">Lý do</label>
                    <textarea class="form-control" id="reason" class="text-danger small"></textarea>
                    <span id="validate-reason-error" class="text-danger small"></span>
                </div>
            </div> --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary shadow-sm" id="supplements_and_leave">Bổ sung</button>
        </div>
      </div>
    </div>
</div>