
<style>
    #factures {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #factures td, #factures th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #factures tr:nth-child(even){background-color: #f2f2f2;}

    #factures tr:hover {background-color: #ddd;}

    #factures th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="factures" width="100%">
    <thead>
    <tr>
    <td>ID</td>
        <td>client_id</td>
        <td>produit_id</td>
        <td>commandes_id</td>
        <td>qty</td>
        <td>prix_total</td>
    </tr>
    <td>{{ $c->id }}</td>
            <td>{{ $c->client_id}}</td>
            <td>{{ $c->produit_id }}</td>
            <td>{{ $c->commandes_id }}</td>
            <td>{{ $c->qty}}</td>
            <td>{{ $c->prix_total}}</td>
    </tr>
    </thead>
    @foreach($client as $c)
        <tbody>
        <tr>
           
        </tr>
        </tbody>
    @endforeach

</table>




