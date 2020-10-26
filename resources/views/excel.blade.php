<?php $a=0;?>
<table>
    <thead>
        <tr>  
        <th>FECHA</th>      
        <th>PLATO</th>
        <th>CANTIDAD</th>
        <th>PRECIO</th>
        </tr>                    
    </thead>  
    <tbody> 
    @foreach($data as $detapla)           
        @foreach($detapla as $item) 
            <tr>
                <td>{{$keys[$a]}}</td>     
                <td>{{$item['plt_nom']}}</td>
                <td>{{$item['dtall_cant']}}</td>
                <td>{{$item['plt_pvp']}}</td> 
            </tr>                       
        @endforeach
                <?php $a++;?>                           
    @endforeach
    </tbody>
</table>
