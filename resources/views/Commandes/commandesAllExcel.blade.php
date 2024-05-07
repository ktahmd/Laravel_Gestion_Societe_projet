
<style>
    #commandes {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #commandes td, #commandes th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #commandes tr:nth-child(even){background-color: #f2f2f2;}

    #commandes tr:hover {background-color: #ddd;}

    #commandes th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="commandes" width="100%">
    <thead>
    <tr>
        <td>ID</td>
        <td>client_id</td>
        <td>date</td>
        <td>prix total</td>
    </tr>
    </thead>
    @foreach($commandes as $c)
        <tbody>
        <tr>
        <td>{{ $c->id}}</td> 
        <td>{{ $c->client_id}}</td>
        <td>{{ $c->created_at}}</td>
        <td>{{ $c->prix_total}}</td>
        </tr>
        </tbody>
    @endforeach

</table>




