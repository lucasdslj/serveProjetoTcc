<?php 

namespace app;

class Helpers{

  //calculo de distancia entre duas coordenadas, formula de haversine
  public static function calcDistance($lat1, $lon1, $lat2, $lon2) {

        $earthRadius = 6371; 

        $lat1 = deg2rad($lat1);
        $lat2 = deg2rad($lat2);
        $lon1 = deg2rad($lon1);
        $lon2 = deg2rad($lon2);

        $latDelta = $lat2 - $lat1;
        $lonDelta = $lon2 - $lon1;
        

        $dist = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        cos($lat1) * cos($lat2) * pow(sin($lonDelta / 2), 2)));
        $dist = $dist * $earthRadius  *1000;
        return number_format($dist, 2, '.', '');
        //return $dist;
    }      
  
  //calculo de distancia das extensões longitudinais e latitudinais  
  public static function calcExtensionLongLat($CPlayer1, $CPlayer2, $CCombination){ //VERIFICAR

      //Extensão longitudinal
      $extensionLong = Helpers::calcDistance($CPlayer1[0], $CPlayer1[1], $CCombination[0], $CCombination[1]);

      //extensão latitudinal  
      $extensionLat = Helpers::calcDistance($CPlayer2[0], $CPlayer2[1], $CCombination[0], $CCombination[1]);

      //normatização da extensão longitudinal por 5 e arredondamento ---> É AQUI QUE TAMBÉM SE TRATA AS COORDENADAS COM NO MÍNIMO 2,51 METROS DE DISTÂNCIA
      if ( fmod( $extensionLong , 5) >= 2.51 ){
        $extensionLong = $extensionLong - fmod( $extensionLong, 5) + 5;
      } else{
        $extensionLong = $extensionLong - fmod( $extensionLong, 5);
      }

      //normatização da extensão latitudinal por 5 e arredondamento
      if ( fmod( $extensionLat , 5) >= 2.51 ){
           $extensionLat = $extensionLat - fmod($extensionLat, 5); + 5;
      } else{
          $extensionLat = $extensionLat - fmod($extensionLat, 5);
      }
      
      return array($extensionLong , $extensionLat);
    }  
  
  //marcação de coordenadas distantes x metros de uma coordenada referencia em visada direta
  public static function markingCoordinates($CRef, $dist, $direction){
        
      
      if(($direction == 'west') or ($direction == 'east')){
        
        $distDegreesDec = ($dist / 5) * 0.000045;        
        $distDegreesDec += ( floor(( $dist / 5) / 1000 )) * 0.000022; //compensação 
            
        $markCoord[0] = $CRef[0];
        //verificando de fato se a coordenada é ao OESTE(-) ou ao LESTE(+)      
        $direction == 'west' ? $markCoord[1] = $CRef[1] -  $distDegreesDec : 
        $markCoord[1] = $CRef[1] +  $distDegreesDec;

       // echo '<script>console.log("entro em ',$direction,'")</script>';  
        return $markCoord;
       }else{
        $distDegreesDec = ($dist / 5) * 0.000045;            
        $distDegreesDec -= ( floor(( $dist / 5) / 1000 )) * 0.000036; //compensação
           
        
        //verificando de fato se a coordenada é ao NORTE(+) ou ao SUL(-)  
        $direction == 'north' ? $markCoord[0] = $CRef[0] +  $distDegreesDec : 
        $markCoord[0] = $CRef[0] -  $distDegreesDec;

        $markCoord[1] = $CRef[1];
            
        //echo '<script>console.log("entro em ',$direction,'")</script>';  
        return $markCoord;
      }
      
    }
  public static function markCoordPlayerBoard($coordPlayer, $board, $numbSquare  ){ 
    
     $distDown = INF;
            for($j = 0; $j <= $numbSquare; $j++ ){
                for($i = 0; $i <= $numbSquare; $i++ ){
                    $dist = Helpers::calcDistance($coordPlayer[0], $coordPlayer[1], $board[$j][$i][0], $board[$j][$i][1]);

                if ($dist< $distDown){
                    $coordPlayerBoard[0] = $board[$j][$i][0];
                    $coordPlayerBoard[1] = $board[$j][$i][1];
                    $distDown = $dist;
                }
                }
            } 
            return $coordPlayerBoard;
    }        
  
  public static function markCoordPlayerPlane($coordPlayerBoard, $axisX, $axisY, $numbSquare ) {

    for($i=0; $i <=$numbSquare; $i++){
               if($coordPlayerBoard[1] == $axisX[0][$i]){
                    $coordPlayerPlane[0] = $axisX[1][$i]; // valor cartesiano
                    for($j = 0; $j <= $numbSquare; $j++){
                        if($coordPlayerBoard[0] == $axisY[0][$j]){
                        $coordPlayerPlane[1] = $axisY[1][$j];
                        break;
                        }
                    }
               }
            }
            return $coordPlayerPlane;
    }

   //TESTES
   //Teste das coordenadas marcadas
   public static function testMarkCoord( $dist, $coordRef, $coodMark, $axis, $direction ){

      echo ' </br>Distancia desejada: ', $dist;
      echo '</br>Direção: ', $direction;
      echo ' </br>Coordenada Referencia Latitude : ', $coordRef[0];
      echo ' </br>Coordenada Referencia Longitude: ', $coordRef[1];
      
      
      echo ' </br>Coordenada Obtida Latitude: ', $coodMark[0];
      echo ' </br>Coordenada Obtida Longitude: ', $coodMark[1];

      $axis == 'x' ? $d =Helpers::calcDistance(-2.923498,-41.747195, $coordRef[0], $coodMark[1] ) : 
      $d =Helpers::calcDistance(-2.923498,-41.747195, $coodMark[0], $coordRef[1]  );
      
      echo '</br>Distancia real: ', $d;          
    }
  
  //mostra todas coordenadas do tabuleiro
  public static function showBoard( $board, $numbSquare ){
      for($j = 0; $j<=$numbSquare; $j++ ){
        for($i = 0; $i<=$numbSquare; $i++ ){
          echo '[', $board[$j][$i][0], ', '; 
          echo ' ',$board[$j][$i][1], ']; ';

          }
          echo '</br>';
      } 
      
          echo '</br>';
      echo '</br>Tabuleiro ', $numbSquare+1 , ' por ', $numbSquare+1;    
         
    }
    


  }