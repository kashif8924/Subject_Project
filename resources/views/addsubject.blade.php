<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Add Subjects</title>
</head>
<body>
    <div class="container">
        @if (@session('message'))
        <p style="color: red">{{@session('message')}}</p>
        @endif
        <h1>Add Subject</h1>
        @error('name')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
        <form method="POST" action="{{url('/createsubject')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Subject Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" name= "name" aria-describedby="emailHelp" placeholder="Enter Subject Name">

            </div>
            @error('image')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
            <div class="form-group">
                <label for="subject_image">Upload Subject Image</label>
                <input type="file" id="subject_image" name="image" accept="image/*" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>

</body>
</html>
