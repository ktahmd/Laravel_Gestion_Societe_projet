<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Facture</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
    }

    h1, h3 {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        text-align: left;
    }

    .details {
        margin-bottom: 20px;
    }

    .total {
        text-align: right;
    }
</style>
</head>
<body>

<div class="container">
    <h1>Facture</h1>
    <div class="details">
        <p>Client : {{ $client }}</p>
        <p>Date : {{$commandes->created_at}}</p>
        <p>Référence : {{$commandes->id}}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>MONTANT</th>
            </tr>
        </thead>
        <tbody>
            {{$s=0;}}
            @foreach($factures as $f)
            <tr>
                <td>{{ $f->produit->nom }}</td>
                <td>{{ $f->qty }}</td>
                <td>{{ $f->produit->prix }}</td>
                <td>{{ $f->qty * $f->produit->prix }}</td>{{$s=$s+$f->qty * $f->produit->prix}}
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="total">
        <h3>Total payé : <span id="totalPaye">{{$s}}</span> MRU</h3>
    </div>
</div>

</body>
</html>
