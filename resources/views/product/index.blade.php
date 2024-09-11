<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @foreach($products as $product)
    <div>
        <h1>{{ $product->name }}</h1>
        <p>{{ $product->short_description }}</p>
        <p>{{ $product->price }}</p>
    </div>
    @endforeach

    @if($products->isEmpty())
    <div>No data</div>
    @endif
</body>

</html>