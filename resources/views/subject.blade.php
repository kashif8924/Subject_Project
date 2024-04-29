<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Selection</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS styles */
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }

        .main-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            position: relative; /* Ensure relative positioning for absolute positioning */
        }

        .main-card:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .main-card .card-body {
            padding: 20px;
            position: relative; /* Ensure relative positioning for absolute positioning */
        }

        .main-card .card-title {
            font-size: 20px;
            margin-bottom: 10px;
            color: #333;
        }

        .select-btn {
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: 1px solid #007bff;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .select-btn:hover {
            background-color: #0056b3;
            color: #fff;
        }

        .view-subjects-btn {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        /* Custom CSS for pagination icons */
        .pagination .page-item .page-link {
            font-size: 14px; /* Adjust the font size as needed */
        }

        .search-form {
            display: flex;
            align-items: center;
        }

        .search-input {
            flex: 1;
            margin-right: 10px;
        }

        .search-btn {
            width: 100px;
        }

        /* Custom CSS for profile and login buttons */
        .profile-btn,
        .login-btn {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{url('/addsubject')}}" class="btn btn-success profile-btn">Add Subject</a>
            <a href="{{url('/profile')}}" class="btn btn-success profile-btn">Profile</a>
            <a href="{{url('/logout')}}" class="btn btn-primary login-btn">LogOut</a>
        </div>
        <form action="{{ url('/subjects') }}" method="GET" class="mb-3">
            <div class="form-group search-form">
                <input type="text" name="subject" class="form-control search-input" placeholder="Search...">
                <button type="submit" class="btn btn-primary search-btn">Search</button>
            </div>
        </form>
        <h2 class="mb-4">Subject Selection</h2>
        <div class="card main-card">
            @if (session('error'))
            <p style="color: red">{{ session('error') }}</p>
            @endif
            <div class="card-body">
                <a href="{{ url('/viewsubject') }}" class="btn btn-primary view-subjects-btn">View Subjects</a>
                <h5 class="card-title mb-3">All Subjects</h5>
                <div class="row">
                    @if (count($subjects))
                    @foreach ($subjects as $subject)
                    <div class="col-md-4">

                        <div class="card subject-card">

                            <div class="card-body text-center">
                                @if(!empty($subject->users) && count($subject->users) > 0)
                        @if($subject->users[0]->id = auth()->id())
                        <button type="button" class="btn btn-success">Sellected</button>
                        @endif
                        @endif
                                <img src="{{ asset($subject->image) }}" alt="Subject Image" class="img-fluid mb-3">
                                <h5 class="card-title mb-3">{{ $subject->name }}</h5>
                                <a href="{{ url('/select/'.$subject->id) }}" class="btn btn-primary view-subjects-btn">Select</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <h2>Record not found</h2>
                    @endif
                    <div class="pagination">
                        {{ $subjects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
