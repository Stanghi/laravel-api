<form action="{{ route('admin.' . $route . '.destroy', $entity) }}" method="POST"
    onsubmit="return confirm('confermi l\'eliminazione?')">
    @csrf
    @method('DELETE')

    <button title="Delete" type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i>
    </button>
</form>
