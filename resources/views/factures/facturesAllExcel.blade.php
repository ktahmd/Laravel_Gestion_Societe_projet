
<table>

        <tr>
            <th>Client : </th>
            <th>{{ $client }}</th>
        </tr>   
        <tr>
            <th>Date : </th>
            <th>{{ $date }}</th>
        </tr> 
        <tr>
            <th>Date : </th>
            <th>{{ $date }}</th>
        </tr> 
        <tr>
            <th>Référence :</th>
            <th>{{ $commande->id }}</th>
        </tr> 
        

</table>
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
       
             {{$s = 0;}}
            @foreach($factures as $f)
            <tr>
                <td>{{ $f->produit->nom }}</td>
                <td>{{ $f->qty }}</td>
                <td>{{ $f->produit->prix }}</td>
                <td>{{ $f->qty * $f->produit->prix }}</td>

                 {{$s += $f->qty * $f->produit->prix; }}
            </tr>
            @endforeach
        </tbody>
    </table>
    <table>
        <tr>
            <th>Total payé :  </th>
            <th>{{ $s }}</th>
            <th>MRU</th>
        </tr>  
    </table>





