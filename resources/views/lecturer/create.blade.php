<x-app>

    <x-slot:title>{{ $title }}</x-slot>


    <form method="POST" action="{{ route('lecturer.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror id="name" name="name"
                value="{{ old('name') }}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Department</label>

            <select class="form-select @error('department_id') is-invalid @enderror" id="department_id"
                name="department_id">
                <option value="">Choose Department</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}">
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>

            @error('department_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <a href="{{ route('lecturer.index') }}" class="btn btn-warning me-1">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>


    </form>
</x-app>
