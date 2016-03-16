<!DOCTYPE html>
<html>
    <head>
        <title> Resultado </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="index.css" type="text/css"></link>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  
    </head>
    <body>
        <?php
            $valor = $_GET['valor'];
            
            //Porcentagens das faixas INSS
            $PorcenFaixaA_INSS = 0.08;
            $PorcenFaixaB_INSS = 0.09;      
            $PorcenFaixaC_INSS = 0.11;
            
            //Porcentagens das faixas Imposto de Renda
            $PorcenFaixaA_RENDA = "ISENTO";
            $PorcenFaixaB_RENDA = 0.075;
            $PorcenFaixaC_RENDA = 0.15;      
            $PorcenFaixaD_RENDA = 0.225;
            $PorcenFaixaE_RENDA = 0.275;
            
           // Iniciando as vartiaveis
           $valorDeduzidoRenda = 0;
           $Porcen_RENDA = 0;
           
           // Inicio do IF que compara o valor bruto com as faixas de desconto do INSS
            if($valor<=1556.94){
                $Porcen_INSS = $PorcenFaixaA_INSS;
                $valorDeduzido_porcen_INSS = $valor * $Porcen_INSS;
                $valorComDescINSS = $valor-$valorDeduzido_porcen_INSS;
                
            }elseif($valor<=2594.92){
                $Porcen_INSS = $PorcenFaixaB_INSS;
                $valorDeduzido_porcen_INSS = $valor * $Porcen_INSS;
                $valorComDescINSS = $valor - $valorDeduzido_porcen_INSS;
                
            }elseif($valor<=5189.81){
                $Porcen_INSS = $PorcenFaixaC_INSS;
                $valorDeduzido_porcen_INSS = $valor * $Porcen_INSS; 
                $valorComDescINSS = $valor - $valorDeduzido_porcen_INSS;
          
            }else{
                $Porcen_INSS = $PorcenFaixaC_INSS;
                $valorTeto = 5189.82;
                $valorDeduzido_porcen_INSS = $valorTeto * $Porcen_INSS;
                $valorComDescINSS = $valor - $valorDeduzido_porcen_INSS;
            }    
            
            // Inicio do IF que compara o valor com as faixas de desconto do Imposto de Renda
            if($valorComDescINSS<=1903.98){
                $valorLiquido = $valorComDescINSS;
                
            }elseif($valorComDescINSS<=2826.65){
                $Porcen_RENDA = $PorcenFaixaB_RENDA;
                $valorDescontadoRenda = $valorComDescINSS * $Porcen_RENDA;
                $valorDeduzidoRenda = $valorDescontadoRenda - 142.80;
                $valorLiquido = $valorComDescINSS - $valorDeduzidoRenda;
                
            }elseif($valorComDescINSS<=3751.05){
                $Porcen_RENDA = $PorcenFaixaC_RENDA;
                $valorDescontadoRenda = $valorComDescINSS * $Porcen_RENDA;
                $valorDeduzidoRenda = $valorDescontadoRenda - 354.80;
                $valorLiquido = $valorComDescINSS - $valorDeduzidoRenda;
                
            }elseif($valorComDescINSS<=4664.68){
                $Porcen_RENDA = $PorcenFaixaD_RENDA;
                $valorDescontadoRenda = $valorComDescINSS * $Porcen_RENDA;
                $valorDeduzidoRenda = $valorDescontadoRenda - 636.13; 
                $valorLiquido = $valorComDescINSS - $valorDeduzidoRenda;
                
            }else{
                $Porcen_RENDA = $PorcenFaixaE_RENDA;
                $valorDescontadoRenda = $valorComDescINSS * $Porcen_RENDA;
                $valorDeduzidoRenda = $valorDescontadoRenda - 869.36; 
                $valorLiquido = $valorComDescINSS - $valorDeduzidoRenda;
                
            }    
            
            //Valor total de descontos 
            $valorTotalDescontos = $valorDeduzido_porcen_INSS + $valorDeduzidoRenda;
            

        ?>
        <h1> Resultado </h1>
        
        <table border = "1" id="tab">
            <tr class="dif">
                <th> Evento </th>
                <th> Ref. </th>
                <th> Proventos </th>
                <th> Descontos </th>
            </tr>
            
            <tr>
                <td> Salário Bruto </td>
                <td> - </td>
                <td><?php echo 'R$ ' . number_format($valor, 2, ',', '.');  ?> </td>
                <td> - </td>
            </tr>
            
            <tr class="dif">
                <td> INSS </td>
                <td> <?php $Porcen_INSS = $Porcen_INSS * 100; echo "$Porcen_INSS %" ?> </td>
                <td> - </td>
                <td> <?php echo 'R$ ' . number_format($valorDeduzido_porcen_INSS, 2, ',', '.');   ?> </td>
            </tr>
            
            <tr >
                <td> IRRF </td>
                <td> <?php $Porcen_RENDA = $Porcen_RENDA * 100; echo "$Porcen_RENDA %" ?>  </td>
                <td> - </td>
                <td><?php echo 'R$ ' . number_format($valorDeduzidoRenda, 2, ',', '.');  ?> </td>
            </tr>
            
            <tr class="dif">
                <td colspan="2"> Total Descontos </td>
                <td colspan="2"><?php echo 'R$ ' . number_format($valorTotalDescontos, 2, ',', '.');  ?> </td>
            </tr>
            
            <tr >
                <td colspan="2"> Salário Líquido </td>
                <td colspan="2"> <?php echo 'R$ ' . number_format($valorLiquido, 2, ',', '.');  ?> </td>
            </tr>
        </table>
    </body>
</html>