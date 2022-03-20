<form action="{{ route($route, $id) }}" method="POST" class="d-inline-block">
    @csrf
    @method("delete")

    <button type="submit" class="btn btn-link text-danger">
        <i class="fa-regular fa-trash-can"></i>
    </button>
</form>