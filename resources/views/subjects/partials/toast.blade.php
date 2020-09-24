<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="4000">
        <div class="toast-header">
            <strong class="mr-auto">
                @if(Session::has('toastMessage'))
                    {{session('toastMessage')}}
                @endif
            </strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
</div>
