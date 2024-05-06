@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>{{ $error }}
        @endforeach
    </div>
@endif