<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <title>SUB Shop</title>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark">

    <div class="container-fluid">
        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-light" href="/product">products</a>
            </li>
            </li>
        </ul>
    </div>

</nav>

<div class="container">

    @if($message = Session::get('success'))
        <div class="alert alert-success alert-block mt-1">
            {{ $message }}
        </div>
    @endif

    <div style="text-align: right">
        <a href="product/create" class="btn btn-dark mt-2">New Product</a>
    </div>

    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">SN</th>
                <th scope="col">name</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <?php $i = 1 ?>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <img src="products/{{ $product->image }}" class="rounded-circle" width="40" height="40">
                    </td>
                    <td>
                        <a href="product/{{ $product->id }}/edit" class="btn btn-primary">edit</a>
                        <a href="product/delete/{{ $product->id }}" class="btn btn-danger">delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
