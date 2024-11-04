<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produtos</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
    }

    h1 {
      text-align: center;
      color: #333;
    }

    .loading-message {
      font-size: 1.2em;
      color: #555;
      margin-bottom: 20px;
    }

    .products-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .card {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 300px;
      text-align: center;
    }

    .card img {
      width: 100%;
      height: auto;
      border-radius: 4px;
      margin-bottom: 15px;
    }

    .card h2 {
      font-size: 1.2em;
      color: #333;
      margin: 10px 0;
    }

    .card p {
      font-size: 1em;
      color: #666;
    }

    .card a {
      display: inline-block;
      margin-top: 15px;
      text-decoration: none;
      color: #fff;
      background-color: #007bff;
      padding: 10px 15px;
      border-radius: 4px;
      transition: background-color 0.3s ease;
    }

    .card a:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>
  <h1>Lista de Produtos</h1>
  <div class="products-container">
    @foreach($products as $product)
    <div class="card">
      <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
      <h2>{{ $product->name }}</h2>
      <p>Preço: R$ {{ number_format($product->price, 2, ',', '.') }}</p>
      <p>{{ \Str::limit($product->description, 100, '...') }}</p>
      <!-- <a href="{{ $product->product_url }}" target="_blank">Ver no site</a> -->
    </div>
    @endforeach
  </div>
</body>

</html>