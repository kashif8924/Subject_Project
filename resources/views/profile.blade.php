<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>

        .divider::after,
        .divider::before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
            margin: 10px; /* Adjust spacing between lines if needed */
            display: block; /* Ensure pseudo-elements are displayed as block elements */
        }
    </style>

    <title>Profile</title>
</head>
<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            @if (session('message'))
            <p style="color: red">{{ session('message') }}</p>
            @endif
          <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
              <img src="{{asset($user->image)}}"
                class="img-fluid" alt="Phone image">

            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <form method="POST" action="{{url('/profileupdate')}}" enctype="multipart/form-data">
                    @csrf
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" id="form1Example13" value="{{ $user->email }}" name="email" class="form-control form-control-lg"/>
                        <label class="form-label" for="form1Example13">Email address</label>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="form1Example23" value="{{ $user->first_name }}" name="first_name" class="form-control form-control-lg"/>
                        <label class="form-label" for="form1Example23">First Name</label>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="form1Example23" value="{{ $user->last_name }}" name="last_name" class="form-control form-control-lg"/>
                        <label class="form-label" for="form1Example23">Last Name</label>
                    </div>

                    <div class="form-group">
                        <label for="profile_image">Upload Profile Image</label>
                        <input type="file" id="profile_image" name="profile_image" accept="image/*" class="form-control-file">
                    </div>
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block">Save Changes</button>
                </form>
            </div>
          </div>
        </div>
      </section>
</body>
</html>
