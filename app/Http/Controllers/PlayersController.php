<?php 

namespace app\Http\Controllers;
use app\Models\Player;
use app\Models\Level;
use app\Models\Rematch;
use DB;
use Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class PlayersController extends Controller {

        
        public function  opponentsList(){

            $player = Request::route('player');


             $players  = Player::join('level','level.id_level','=','players.level_id')
                ->select('players.user_name', 'level.level', 'level.patent', 'level.ship' , 'level.attack_force', 'level.defense_force', 
                'level.amount_life', 'level.amount_bomb', 'level.time', 'level.xp_given')
                ->where('user_name','!=', $player)->get();

                 //orderBy('id_noticias','DESC')

     


           
             return  $players;
        }


        public function  rematchList(){



             $player = Request::route('player');


        }

        

        public function authenticate(Request $request){

                $err ="err";
                $email = Request::input('email');
                $password = Request::input('password');
                //$password =md5($password);

                $passHash = Player::select('password')
                ->where('email', '=', $email)->get();

                if (empty($passHash[0])){
                        return response()->json($err);
                }
              
                if (password_verify($password, $passHash[0]->password)){
                        return Player::select('user_name')
                        ->where('email', '=',$email )->get();
                        
                }else{
                        return response()->json($err);
                }
   
        }

        public function getPlayer(){

                $player = Request::input('user_name');


                $dataPlayer  = Player::join('level','level.id_level','=','players.level_id')                
                        ->select('players.user_name', 'level.level', 'level.patent', 'level.ship' , 'level.attack_force', 
                        'level.defense_force', 'players.amount_xp', 'players.amount_victories_total', 'players.amount_defeats_total', 'level.amount_level_up',
                        'level.amount_life')
                        ->where('user_name','=', $player)->get();
     
               
                        return  $dataPlayer; 
        
        }


        public function verifyUserName(){
                $user_name = Request::input('user_name');

                $user_name  = Player::where('user_name','=', $user_name)->get();


                if(empty($user_name [0])){
                        $message = "available";
                        return response()->json($message);
                }else{
                        $message = "unavailable";
                        return response()->json($message);
                }

             
        }

        public function verifyEmail(){
                $email = Request::input('email');

                $email  = Player::where('email','=', $email)->get();


                if(empty($email[0])){
                        $message = "available";
                        return response()->json($message);
                }else{
                        $message = "unavailable";
                        return response()->json($message);
                }

             
        }

        public function createNewPlayer(){
                $user_name = Request::input('user_name');
                $name = Request::input('name');
                $email = Request::input('email');
                $sex = Request::input('sex');
                $password = Request::input('password');
                // $password = md5($password);
                //$password = password_hash($password, PASSWORD_ARGON2I, ['memory_cost' => 1<<12, 'time_cost' => 4, 'threads' => 4]);
                
                $options = [
                         'cost' => 10,
                ];
                
                $password = password_hash($password, PASSWORD_BCRYPT, $options);
              
                
                
                $newPlayer = Player::create(['user_name' => $user_name, 'name' => $name, 
                'email' => $email, 'sex' => $sex, 'password' => $password]);

                return $newPlayer;
        }


        public function plusVictory(){
                $user_name = Request::input('user_name');
                $amountVictory = Player::select('amount_victories_total')
                        ->where('user_name', '=',$user_name )->get();

                $amountVictory[0]->amount_victories_total++ ;

                Player::where('user_name',  $user_name)
                ->update(['amount_victories_total' =>  $amountVictory[0]->amount_victories_total]);

                return $amountVictory[0]->amount_victories_total;

        }

        public function plusDefeat(){
                $user_name = Request::input('user_name');
                $amountDefeat = Player::select('amount_defeats_total')
                        ->where('user_name', '=',$user_name )
                        ->get();

                $amountDefeat[0]->amount_defeats_total++;

                Player::where('user_name',  $user_name)
                ->update(['amount_defeats_total' =>  $amountDefeat[0]->amount_defeats_total]);

                return $amountDefeat[0]->amount_defeats_total;
        }

        public function plusXp(){
                $user_name = Request::input('user_name');
                $xpGained = Request::input('xpGained');

                $xpCurrent = Player::select('amount_xp')
                        ->where('user_name', '=', $user_name )
                        ->get();
                $xpGained = $xpGained + $xpCurrent[0]->amount_xp;

                Player::where('user_name',  $user_name)
                ->update(['amount_xp' =>  $xpGained]);

                return $xpGained;

        }


        public function plusLevel(){
                $user_name = Request::input('user_name');

                $level = Player::join('level','level.id_level','=','players.level_id')                
                        ->select('level.level')
                        ->where('user_name','=', $user_name)->get();

                $level[0]->level++;

                $idNewLevel = Level::select('id_level')
                        ->where('level','=', $level[0]->level)->get();

                
                Player::where('user_name',  $user_name)
                ->update(['level_id' =>  $idNewLevel[0]->id_level]);

                return $idNewLevel[0]->id_level;
        }

        public function addRematch(){
                $user_name = Request::input('user_name');
                $user_name_adversary = Request::input('user_name_adversary');

                $count = Rematch::where('player_adversary','=', $user_name_adversary )
                        ->where('user_name_player', '=', $user_name)->count();

                if ($count == 0) {
                         $newRematch = Rematch::create(['user_name_player' => $user_name, 'amount_victories' => 1, 
                        'player_adversary' => $user_name_adversary]);

                        return $newRematch;

                }


                if ($count == 1) {
                        $victories = Rematch::select('amount_victories')
                                ->where('player_adversary','=', $user_name_adversary )
                                ->where('user_name_player', '=', $user_name)->get();

                        $victories[0]->amount_victories++;

                        Rematch::where('player_adversary','=', $user_name_adversary )
                                ->where('user_name_player', '=', $user_name)
                                ->update(['amount_victories' =>  $victories[0]->amount_victories]);
                        return $victories[0]->amount_victories;
                }   
                
                
           

        }

        public function getRematch(){
                $user_name = Request::input('user_name');
               

                $player_adversary = Rematch::join('players','players.user_name','=','rematches.player_adversary')
                        ->join('level','level.id_level','=','players.level_id')  
                        ->select('rematches.amount_victories', 'rematches.player_adversary', 'level.patent','level.ship', 'level.attack_force',
                        'level.defense_force','level.amount_life', 'level.level', 'level.amount_bomb', 'level.time', 'level.xp_given', 'players.amount_xp' )
                        ->where('user_name_player','=', $user_name)->get();

                return $player_adversary;


                
        }

        public function delRematch(){ 
                $user_name = Request::input('user_name');
                $user_name_adversary = Request::input('user_name_adversary');

                $del = Rematch::where('player_adversary','=', $user_name_adversary )
                        ->where('user_name_player', '=', $user_name)->delete();

                return $del;
        
        }

        public function setLocation(){
                $user_name = Request::input('user_name');
                $lat = Request::input('lat');
                $lng = Request::input('lng');

               if((!empty($lat)) and (!empty($lng))){
                Player::where('user_name',  $user_name)
                 ->update(['latitude' =>  $lat ,  'longitude' => $lng ]);
                       
                return response()->json("success");

               }
               return response()->json("err");
                
        }

        //não utilizado
        public function test(){
                 $password = Request::input('password');

               
                //$custo = '08';
                //$salt = 'Cf1f11ePArKlBJomM0F6aJ';
                //$password  = crypt( $password, '$2a$' . $custo . '$' . $salt . '$');

                $password = password_hash($password,PASSWORD_ARGON2I, ['memory_cost' => 1<<12, 'time_cost' => 4, 'threads' => 4]);

                return $password;
        }

        //não utilizado
        public function test2(){

                $password = Request::input('password');
                $password2 = Request::input('password2');

                if (password_verify($password, $password2)) {
                          echo 'valido';
                } else {
                         echo 'invalido';
                }

                //if (crypt($password , $password2 ) === $password2 ) {
	        //        echo 'Senha OK!';
                //} else {
	          //      echo 'Senha incorreta!';
                //}
                 
        }

    

}