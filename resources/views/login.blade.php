<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Signin</title>

  <!-- Bootstrap CSS from CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  
  <style>
    body, html {
      height: 100%;
      background-color: #f8f9fa;
    }
    .form-signin-container {
      height: 100%;
      display: flex;
      align-items: center;   /* vertical center */
      justify-content: center; /* horizontal center */
    }
    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      background: white;
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .copyright {
      margin-top: 15px;
      text-align: center;
      color: #6c757d;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

  <div class="form-signin-container">
    <main class="form-signin">
      <form action="{{route('login')}}" method="post">
       @csrf
        <h1 class="h3 mb-3 fw-normal text-center">Please sign in</h1>
        @error('email')
        <div class="alert alert-danger">
            {{$message}}
        </div>
            
        @enderror        
        <div class="form-floating mb-3">
          <input type="email" name="email"  value="{{old('email')}}"  class="form-control" id="floatingInput" placeholder="name@example.com" />
          <label for="floatingInput">Email address</label>
        </div>

        <div class="form-floating mb-3">
          <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" />
          <label for="floatingPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" name="remember" value="1" /> Remember me
          </label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>

        <p class="copyright">&copy; 2017–2025</p>
      </form>
    </main>
  </div>

  <!-- Bootstrap JS Bundle from CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
