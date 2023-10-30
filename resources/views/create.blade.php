<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <h2>{{ !empty($tasks->id) ? 'Edit' : 'Add' }} Task</h2>

        <form action="{{!empty($tasks->id) ? route('tasks.update',$tasks->id) : route('tasks.store') }}" method="POST">
            @csrf
            {{!empty($tasks->id) ? method_field('PUT') : ''}}
            <div class="form-group">
                <label for="title">Title <span style="color: red;">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ !empty($tasks->title) ? $tasks->title : old('title') }}">
                @error('title')
                <div class="error" style="color: red;">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{ !empty($tasks->description) ? $tasks->description : old('description') }}</textarea>
                @error('description')
                <div class="error" style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            @if(!empty($tasks->id))
            <div class="form-group">
                <label>Status:</label><br>
                <input type="radio" name="status" value="1" {{$tasks->status ? 'checked' : ''}} id="status_complete">
                <label for="status_complete">Complete</label>

                <input type="radio" name="status" value="0" {{  $tasks->status ? '' : 'checked' }} id="status_incomplete">
                <label for="status_incomplete">Incomplete</label>
            </div>
            @endif

            <button type="submit" class="btn btn-primary">{{ !empty($tasks->id) ? 'Update' : 'Add' }}</button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>