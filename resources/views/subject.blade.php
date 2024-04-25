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
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">Subject Selection</h2>
        <div class="card main-card">
            @if (session('error'))
            <p style="color: red">{{ session('error') }}</p>
             @endif
            <div class="card-body">
                <a href="{{url('/viewsubject')}}" class="btn btn-primary view-subjects-btn">View Subjects</a>
                <h5 class="card-title mb-3">All Subjects</h5>
                <div class="row">
                    @foreach ($subjects as $subject)
                    <div class="col-md-4">
                        <div class="card subject-card">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-3">{{$subject->name}}</h5>
                                <a href="{{url('/select/'.$subject->id.'')}}" class="btn btn-primary view-subjects-btn">Select</a>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    <div class="pagination">
                        {{ $subjects->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
