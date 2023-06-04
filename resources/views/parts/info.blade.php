
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                <div class="row">
                    <ul class="list-group w-100">
                        @foreach ($datas as $data)
                          <li class="list-group-item p-1 mt-1 {{ $data['color'] }}">
                            {{ $data['info'] }}
                          </li>
                        @endforeach
                      </ul>
                </div>
                </p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
