<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enhanced Table</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        /* Custom Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .btn {
            padding: 6px 12px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        @if (@session('message'))
        <p style="color: red">{{@session('message')}}</p>
        @endif
        <div class="table-responsive">
            <h1>Your Selected Subjects </h1>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                         $i = 1;
                        @endphp

                        @foreach ($selected_subjects as $subject)
                        <tr>
                             <th>{{ $i }}</th>
                                <td>{{ $subject->name }}</td>
                                <td>
                                    <a href="{{ url('/drop/' . $subject->id) }}" class="btn btn-primary view-subjects-btn">Drop Subjects</a>
                                </td>
                                 </tr>
                            @php
                            $i++;
                            @endphp
                            @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
