@php
    use App\Models\User;

    $user = null;
    if (session()->has('user_details')) {
        $user_id = session('user_details')->id;
        $user = User::find($user_id);
    }
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QIC Software</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/images/style.css">
</head>

<body>
  <!-- ======================navbar-start====================== -->
  <nav class="navbar navbar-expand-lg  m-0 p-0">
    <div class="container-fluid">
      <h1 class="ms-3"><img src="assets/images/logo.svg" alt=""></h1>
      <button class=" navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item active">
              <a style="color: #3A0CA3; font-weight: 700; font-size:1.0625rem; margin-right: 4rem;" class="nav-link "
                href="#">What is it? </a>
            </li>
            <li class="nav-item">
              <a style="color: #ACADAE; font-weight: 500; font-size:1.0625rem;margin-right: 4rem;"" class=" nav-link"
                href="/home">Home </a>
            </li>
            <li class="nav-item">
              <a style="color: #ACADAE; font-weight: 500; font-size:1.0625rem;margin-right: 4rem;"" class=" nav-link"
                href="#">About </a>
            </li>
            @if($user)
            <li class="nav-item ">
              <a style="color: #ACADAE; font-weight: 500; font-size:1.0625rem;margin-right: 3rem;"" class=" nav-link"
                href="/">Dashboard </a>
            </li>
            @endif
            @if(!$user)
            <li class="nav-item ">
              <a style="color: #ACADAE; font-weight: 500; font-size:1.0625rem;margin-right: 3rem;"" class=" nav-link"
                href="/login">Login </a>
            </li>
            @else
            <li class="nav-item ">
              <a style="color: #ACADAE; font-weight: 500; font-size:1.0625rem;margin-right: 3rem;"" class=" nav-link"
                href="/logout">Log Out </a>
            </li>
            @endif
          </ul>
        </div>
    </div>
  </nav>
  <!-- ======================navbar-start====================== -->
  