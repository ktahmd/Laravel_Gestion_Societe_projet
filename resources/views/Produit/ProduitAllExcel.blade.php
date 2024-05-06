
<style>
    #categories {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #categories td, #categories th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #categories tr:nth-child(even){background-color: #f2f2f2;}

    #categories tr:hover {background-color: #ddd;}

    #categories th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="categories" width="100%">
    <thead>
    <tr>
        <td>Nom</td>
        <td>Description</td>
        <td>prix</td>
        <td>categorie_id</td>
        <td>quantite_stock</td>
       
    </tr>
    </thead>
    @foreach($categories as $c)
        <tbody>
        <tr>
            <td>{{ $c->nom }}</td>
            <td>{{ $c->description}}</td>
            <td>{{ $c-> prix}}</td>
            <td>{{ $c->categorie_id }}</td>
            <td>{{ $c-> quantite_stock}}</td>  
        </tr>
        </tbody>
    @endforeach

</table>




