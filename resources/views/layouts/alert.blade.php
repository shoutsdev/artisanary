@if(session()->has('success'))
<div class="alert alert-success  alert-dismissible fade show" role="alert">
    <strong>Success!</strong> {{ session()->get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger  alert-dismissible fade show" role="alert">
    <strong>Error!</strong> {{ session()->get('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if(session()->has('warning'))
<div class="alert alert-success  alert-dismissible fade show" role="alert">
    <strong>Warning!</strong> {{ session()->get('warning') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if(session()->has('info'))
<div class="alert alert-success  alert-dismissible fade show" role="alert">
    <strong>Info!</strong> {{ session()->get('info') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
