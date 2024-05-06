
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
    <td>ID</td>
        <td>Nom</td>
        <td>description</td>
    </tr>
    </thead>
    @foreach($client as $c)
        <tbody>
        <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->nom }}</td>
            <td>{{ $c->descripyion}}</td>
           
        </tr>
        </tbody>
    @endforeach

</table>



