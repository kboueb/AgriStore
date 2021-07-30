<form action="{{ route('products.search') }}" class="d-flex mr-3">
    <div class="form-group mb-0 mr-2">
        <input type="text" name="q" class="form-control" value="{{ request()->q ?? '' }}">
    </div>
    <button type="submit" style="background-color: #37a09c; border:none; margin-left:5px" class="btn btn-info"><i class="fa fa-search text-light"   aria-hidden="true"></i></button>
</form>