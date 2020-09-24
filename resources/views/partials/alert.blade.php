<div class="row justify-content-center">
    <div class="col-12 col-md-6 mt-3 mb-0">
        <div class="alert alert-{{ Session::has('alert') ? Session::get('alert') : "info" }} alert-dismissible fade show" role="alert">
            {{-- {{dd(Session::get('alert'))}} --}}
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
