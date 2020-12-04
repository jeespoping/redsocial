<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form action="{{ route('admin.courts.store', '#create') }}" method="post">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Agrega el titulo de la cancha</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <input id="court-title" name="title"
                               class="form-control"
                               value="{{ old('title') }}"
                               placeholder="Ingresa aquí el título de la cancha" autofocus required>
                        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Crear cancha</button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        if ( window.location.hash === '#create') {
            $('#myModal').modal('show');
        }

        $('#myModal').on('hide.bs.modal', function(){
            window.location.hash = '#';
        });

        $('#myModal').on('shown.bs.modal', function(){
            $('#court-title').focus();
            window.location.hash = '#create';
        });
    </script>
@endpush