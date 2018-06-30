<?php 

namespace app\Http\Controllers;
use app\Models\Player;
use DB;
use Request;
use app\Helpers;


class BoardCompositionController extends Controller {

        
        public function  composition(){
            
    
          
            //tratando parametros recebidos pela rota
            $player1 = Request::route('player1');
            $player2 = Request::route('player2');

            $player1 = Player::where('user_name', $player1)->get();
            $player2 = Player::where('user_name', $player2)->get();

            
            //Pegando Level do Player 2
            $levelPlayer2 = Player::join('level','level.id_level','=','players.level_id')
                ->select('level.level')
                ->where('user_name','=', $player2[0]->user_name)->get();

               
       
            //atribuição das coordenadas player 1            
            $coordPlayer1[0] = $player1[0]->latitude;
            $coordPlayer1[1] = $player1[0]->longitude;
           
            //atribuição das coordenadas player 2
            $coordPlayer2[0] =  $player2[0]->latitude;
            $coordPlayer2[1] =  $player2[0]->longitude;

            //definição da coordenada Combinada
            $coordCombination[0] = $player1[0]->latitude;
            $coordCombination[1] = $player2[0]->longitude;

            $extensionLongLat = Helpers::calcExtensionLongLat($coordPlayer1, $coordPlayer2, $coordCombination); //VERIFICAR!!!!!
            //echo $extensionLongLat[0];

            //$d =Helpers::calcDistance(-2.923498,-41.747195, -2.923498, -41.749085 );
            //echo '</br>', $d;
          
            //definindo coordenada Base, maior longitude
            if($coordPlayer1[1] > $coordPlayer2[1]){
               $coordBase = $coordPlayer1;               
          
            }elseif($coordPlayer2[1] > $coordPlayer1[1]){
                $coordBase = $coordPlayer2; 

            }else{
                 if($coordPlayer1[0] != $coordPlayer2[0]){
                     $coordBase = $coordPlayer1;

                 //as coordenadas dos jogadores são extamente as mesmas
                 }else{
                    $message = "impossible";
                    return response()->json($message);
                 }
            }

            //verificando a maior distância e multiplicando-a por um número aleatório de 1 a 3 p/ definir distancias do par P1
            if($extensionLongLat[0] > $extensionLongLat[1]){
                $dist1P1 = $extensionLongLat[0] * mt_rand(1,3);
                $dist2P1 = $extensionLongLat[0] * mt_rand(1,3);

            }elseif($extensionLongLat[1] > $extensionLongLat[0]){
                $dist1P1 = $extensionLongLat[1] * mt_rand(1,3);
                $dist2P1 = $extensionLongLat[1] * mt_rand(1,3);
            //extensão longitudinal e latitudinal são iguais, portanto, não difere qual extensão selecionar como a maior   
            }else{
                $dist1P1 = $extensionLongLat[0] * mt_rand(1,3);
                $dist2P1 = $extensionLongLat[0] * mt_rand(1,3);
            }

            //definindo distancias do par P2
            $aux = mt_rand(1,2); //utilizada somente 1P1 e 1P2. 1P2 é sempre o mesmo que 2P1

            switch($aux){
                case 1:
                    $dist1P2 = $dist1P1;
                    $dist2P2 = $dist2P1; 
                    break; 
                case 2:
                    $dist1P2 = $dist2P1;
                    $dist2P2 = $dist1P1; 
                    break; 
            }

           $distTotal = $dist1P1 + $dist2P1;

         //  $distTotal = 15000;

            //marcando coordenada 1 do par P1            
            $coord1P1 = Helpers::markingCoordinates($coordBase, $dist1P1, 'west'); //1P1 a OESTE da coordenada base
            
            
            //marcando coordenada 1 do par P2           
            $coord1P2 = Helpers::markingCoordinates($coordBase, $dist1P2, 'north'); //1P2 ao NORTE da coordenada base

            //coordenada A1            
            $board[0][0] = array($coord1P2[0], $coord1P1[1]);
           
            //definindo quantidade e tamanho dos quadrantes do tabuleiro
            $numbSquare =  mt_rand(7,15); // numbSquare+1 resulta em um tabuleiro numbSquare+1 por numbSquare+1
            $sizeSquare = round($distTotal / $numbSquare);
           
           
            //marcando pontos do tabuleiro  --> $j-1 justifica: $numbSquare+1          
            for($j = 1; $j<=$numbSquare+1; $j++ ){
                for($i = 1; $i<=$numbSquare; $i++ ){
                  $board[$j-1][$i] = Helpers::markingCoordinates($board[$j-1][$i-1], $sizeSquare, 'east');
                }
                if($j!= $numbSquare+1){
                    $board[$j][$i-$i] = Helpers::markingCoordinates($board[$j-1][$i-$i], $sizeSquare, 'south');
                }
            }
          
            //mostra pontos marcados no tabuleiro            
            //Helpers::showBoard($board, $numbSquare );

                        
            //adequando as coordenadas do  Player1 no tabuleiro
            $coordPlayer1Board = Helpers::markCoordPlayerBoard($coordPlayer1, $board, $numbSquare);

            //adequando as coordenadas do  Player1 no tabuleiro
            $coordPlayer2Board = Helpers::markCoordPlayerBoard($coordPlayer2, $board, $numbSquare);


            //TRATANDO COORDENADAS COM NO MÍNIMO 2,51 METROS DE DISTÂNCIA E COM COOORDENADAS IGUAIS APÓS A NORMATIZAÇÃO NO TABULEIRO
            if (($coordPlayer1Board[0]  == $coordPlayer2Board[0]) and ($coordPlayer1Board[1]  == $coordPlayer2Board[1]) ) {
                    $message = "impossible";
                    return response()->json($message);
            }

            // echo '</br>antes</br>', $coordPlayer1[0];
            //echo '</br>', $coordPlayer1[1];
            // echo '</br>depois</br>', $coordPlayer1Board[0];
            //  echo '</br>', $coordPlayer1Board[1];

            
            //definição do ponto 0,0
          //  $x = rand(0,$numbSquare); 
          //  $y = rand (0,$numbSquare);


            //CRIAR NIVEIS, OU SEJA, MUDAR A ESCALA

            switch ($levelPlayer2[0]->level) {
                case  1:
                    $x = $numbSquare; 
                    $y = 0;
                    $scale = 1;
                    break;

                case 2:
                    $x = $numbSquare; 
                    $y = 0;
                    for($i=  INF; $i=1;$i++){
                        $scale = mt_rand(2 , 10);  
                        if($scale % 2==0){
                          //  echo '<script>console.log("scala colocada',$scale,'")</script>';  
                            break;
                        }
  
                       // echo '<script>console.log("scala ',$scale,'")</script>';  
                    }
                                    
                    break;

                case 3:
                    $x = mt_rand(0,$numbSquare); 
                    $y = mt_rand(0,$numbSquare);
                    $scale = 1;                  
                    break;   
                    
                case 4:
                    $x = mt_rand(0,$numbSquare); 
                    $y = mt_rand(0,$numbSquare);
                    $scale = mt_rand(2 , 10); ;                  
                    break;   
                    
                case 5:
                    $x = mt_rand(0,$numbSquare); 
                    $y = mt_rand (0,$numbSquare);
                    //verificar
                    for($i=0; $i>-1;$i++){
                        $scale = mt_rand(2 , 22);  
                        if($scale % 2==0){
                            $scale = (25 / $scale);
                            $scale = round($scale, 1);
                            break;

                        }

                    }

                //segunda opção dividir dois números aleatórios
                  //  $scale = mt_rand(1,5)+ mt_rand(2,9) ;                  
                    break;    
            }

            //$scale = 1; //escala ==> usar no lugar do auxiliar <==

            //axisX: longitude, valor
            $axisX[0][$y] = $board[$x][$y][1]; // apenas longitude
            $axisX[1][$y] = 0;
                    
            //axisY: latitude, valor
            $axisY[0][$x] = $board[$x][$y][0]; // apenas latitude
            $axisY[1][$x]= 0;
            
        
            //EIXO DAS ABCISSAS (X)
            //definindo coordenadas do eixo X - pontos negativos 
            // echo '</br>';
            //echo '</br>', $axisY[0][$x], ' ' ;
            //echo  $axisX[0][$y];
            //echo '</br>', $x, ' ', $y;

            $aux = 1;
            for($i = $y-1; $i >= 0; $i--) {
                $axisX[0][$i] = $board[$x][$y-$aux][1]; 
                $axisX[1][$i] = -$scale * $aux; 
                $aux++;
                          
              //echo '<script>console.log("entro -X")</script>';   
            }
             //definindo coordenadas do eixo X - pontos positivos 
             $aux = 1;
            for($i = $y+1; $i <= $numbSquare; $i++) {
                $axisX[0][$i] = $board[$x][$y+$aux][1];
                $axisX[1][$i] = $scale * $aux; 
                $aux++;           
            //echo '<script>console.log("entro +X")</script>';   
            }
            
            //echo '</br>';
            //echo $axisX[0][$y];
            //print_r($axisX[0]);

            //EIXO DAS ORDENADAS (Y)
            //definindo coordenadas do eixo Y - pontos positivos 
            $aux = 1;
            for($i = $x-1; $i >= 0; $i--) {
                $axisY[0][$i] = $board[$x-$aux][$y][0]; 
                $axisY[1][$i] = $scale *$aux; 
                $aux++;           
               //  echo '<script>console.log("entro Y")</script>';   
            }
            
            //definindo coordenadas do eixo Y - pontos negativos
            $aux = 1;
            for($i = $x+1; $i <= $numbSquare; $i++) {
                $axisY[0][$i] = $board[$x+$aux][$y][0];
                $axisY[1][$i] = -$scale * $aux; 
                $aux++;           
                //echo '<script>console.log("entro -Y")</script>';   
            }

            //echo '</br> eixo Y </br> ';
            //echo $axisX[0][$y];
            //print_r($axisY);

            //definindo valores das coordenadas dos Players no Plano cartesiano
            $coordPlayer1Plane = Helpers::markCoordPlayerPlane($coordPlayer1Board, $axisX, $axisY, $numbSquare);
            $coordPlayer2Plane = Helpers::markCoordPlayerPlane($coordPlayer2Board, $axisX, $axisY, $numbSquare);
            
            //print_r($coordPlayer1Plane);

        
            $rs = array($board,  $coordPlayer1Board, $coordPlayer2Board, $coordPlayer1Plane, $coordPlayer2Plane,
             $axisX, $axisY, $distTotal, $levelPlayer2[0]->level );
            return response()->json($rs);
           

            //echo Helpers::calcDistance($board[1][2][0], $board[1][2][1], $board[1][3][0], $board[1][3][1] );
            //return $board;         
            
            
           
            //teste de marcação de coordenadas 
           // Helpers::testMarkCoord($dist1P1, $coordBase, $coord1P1, 'x', 'west');
            //echo '</br>',$numbSquare;

           
            /*/////////////////////////////////////////////////////////////////////////////

             $distDown = INF;
            for($j = 0; $j < $numbSquare; $j++ ){
                for($i = 0; $i < $numbSquare; $i++ ){
                    $dist = Helpers::calcDistance($coordPlayer1[0], $coordPlayer1[1], $board[$j][$i][0], $board[$j][$i][1]);

                if ($dist< $distDown){
                    $coordPlayer1Board[0] = $board[$j][$i][0];
                    $coordPlayer1Board[1] = $board[$j][$i][1];
                    $distDown = $dist;
                }
                }
            } 

            //2P1 a LESTE da coordenada base
            $coord2P1 = Helpers::markingCoordinates($coordBase, $dist2P1, 'east');
            //1P2 ao SUL da coordenada base
            $coord2P2 = Helpers::markingCoordinates($coordBase, $dist2P2, 'south');
            // echo 'P1 ', $dist1P1, '  ',  $dist2P1, ' P2  ',   $dist1P2, '  ',   $dist2P2;

          
            //$ExtensionLong = Helpers::calcDistance($coordUser1[0], $coordUser1[1], $coordBase[0], $coordBase[1]);

            //$ExtensionLat = Helpers::calcDistance($coordUser2[0], $coordUser2[1], $coordBase[0], $coordBase[1]);
            //echo $coordUser1[0];


                     
           
            /*
            echo $html = 'Player '. $player1[0]->user_name . ' - latitude: ' . $coordUser1[0] 
            . ' longitude: '. $coordUser1[1];
            echo $html = '</br> Player '. $player2[0]->user_name . ' -  latitude: ' . $coordUser2[0]
            . ' longitude: '. $coordUser2[1];
          

         
            /* 
            $html = '<h1 align=center>Players battleship </h1>';     
            $player = DB::select('select * from players where user_name = ?', [$id]);
            foreach($player as $p ){
                $html .= '</br>Player: ' . $p->user_name;

            }

            */
            //return $html;
            
        }

}
