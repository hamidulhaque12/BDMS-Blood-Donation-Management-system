<x-backend.layouts.master>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Events</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Events</li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
        @if (session('message'))
            <p class="alert alert-success">{{ session('message') }}</p>
        @endif
        <!-- form-group // -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>


    <div class="card mb-4">
        <div class="card-header">

            <div class="row">
                <div class="col-9">
                    <i class="fas fa-table me-1"></i>
                    Create a event
                </div>
                <div class="col-3">
                    <a href="{{ route('events.index') }}" class="btn btn-outline-primary" role="button">Event
                        List</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="form6Example1" class="form-control" name="title"
                                value="{{ old('title') }}" />
                            <label class="form-label" for="form6Example1">Event title</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <input type="date" id="form6Example5" class="form-control" name="event_date"
                                value="{{ old('event_date') }}" />
                            <label class="form-label" for="form6Example5">Event's date:</label>
                        </div>
                    </div>
                </div>

                <!-- Text input -->


                <!-- Text input -->


                <!-- Email input -->
                <div class="form-outline mb-4">
                    <div class="row mb-4">
                        <div class="col">
                            <input type="text" id="form6Example2" class="form-control" />
                            <label class="form-label" for="form6Example2">Area</label>

                        </div>
                        <div class="col">
                            <div class="form-outline mb-4">
                                <input type="text" id="form6Example6" class="form-control" name="organized_by"
                                    value="{{ old('organized_by') }}" />
                                <label class="form-label" for="form6Example6">Organized by:</label>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- Number input -->


                <!-- Message input -->
                <div class="form-outline mb-4">
                    <textarea class="form-control" id="mytextarea" name="description" rows="4">{{ old('description') }}</textarea>
                    <label class="form-label" for="mytextarea">Description</label>
                </div>

                <!-- Checkbox -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="customFile">Select a image:</label>
                    <input type="file" class="form-control" id="customFile" name="image"
                        value="{{ old('image') }}" />
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Upload Event</button>


            </form>
        </div>
    </div>
    </div>
</div>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</x-backend.layouts.master>
