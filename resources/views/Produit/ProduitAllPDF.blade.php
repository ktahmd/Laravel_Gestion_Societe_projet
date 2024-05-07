
<style>
    #Produit {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #Produit td, #Produit th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #Produit tr:nth-child(even){background-color: #f2f2f2;}

    #Produit tr:hover {background-color: #ddd;}

    #Produit th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="Produit" width="100%">
    <thead>
    <tr>
        <td>Nom</td>
        <td>Description</td>
        <td>Prix</td>
        <td>categorie_id</td>
        <td>quantite_stock</td>
    </tr>
    </thead>
    @foreach($Produit as $c)
        <tbody>
        <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->nom }}</td>
            <td>{{ $c->descripyion}}</td>
            <td>{{ $c->categorie_id }}</td>
            <td>{{ $c->quantite_stock}}</td>  
        </tr>
        </tbody>
    @endforeach

</table>



