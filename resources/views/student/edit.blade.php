<x-app>

    <x-slot:title>{{ $title }}</x-slot>


    <form method="POST" action="{{ route('student.update', $student) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror id="name" name="name"
                value="{{ old('name', $student->name) }}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nim</label>
            <input type="number" class="form-control @error('nim') is-invalid @enderror id="nim" name="nim"
                value="{{ old('nim', $student->nim) }}">
            @error('nim')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <a href="{{ route('student.index') }}" class="btn btn-warning me-1">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>


    </form>
</x-app>
