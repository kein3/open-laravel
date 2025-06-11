<form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="document" required>
    <button type="submit">Envoyer</button>
</form>
