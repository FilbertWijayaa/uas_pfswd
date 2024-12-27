<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #81BFDA;
            font-family: 'Poppins', sans-serif;
        }

        .login-container {
            margin-top: 100px;
            background: #F5F5F5;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-signup {
            background-color: #007BFF;
            color: #fff;
        }

        .btn-signup:hover {
            background-color: #0056b3;
        }

        .title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .icon {
            font-size: 3rem;
            color: #007BFF;
        }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center">
    <div class="col-md-6 login-container">
        <div class="text-center mb-4">
            <i class="bi bi-person-circle icon"></i>
            <h2 class="title">Sign Up</h2>
        </div>
        <form>
            <div class="form-floating mb-3">
                <select class="form-select" id="floatingSelectGrid">
                    <option selected>Freelancer</option>
                    <option value="1">Client</option>
                </select>
                <label for="floatingSelectGrid">Daftar sebagai</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingName" placeholder="Nama">
                <label for="floatingName">Nama</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingEmail" placeholder="Email">
                <label for="floatingEmail">Email</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-signup">Sign Up</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
