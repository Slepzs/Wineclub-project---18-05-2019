<?php
class Star extends Wine {

    static protected $table_name = 'stars';
    static protected $db_columns = ['wines_wineid', 'users_userid', 'stars'];

    public $wines_wineid;
    public $users_userid;
    public $stars;


    public function __construct($args=[])
    {
        $this->wines_wineid = $args['wines_wineid'] ?? '';
        $this->users_userid = $args['users_userid'] ?? '';
        $this->stars = $args['stars'] ?? '';
    }

    public function value($wineid, $wine_price) {
        $sql = ("SELECT stars, wine_price FROM stars
        INNER JOIN wines ON wines_wineid = $wineid AND wine_price = $wine_price;");
        $star = static::find_by_sql($sql);

        foreach($star as $stars) {
         $valuearray[] = $stars->stars;
        }

        if(!empty($valuearray)) {
          $allstars = array_sum($valuearray);
          $avgstar = $allstars / count($valuearray);
         } else {

          }
        
          if(!empty($avgstar)) { 
            $value = (pow($avgstar, 2)/ $stars->wine_price )*100;
            echo round($value, 2);
           } else {
 
          }

    
      }


      public function rating($wineid) {
        $sql = ("SELECT stars FROM stars where wines_wineid = $wineid");
        $starcalc = static::find_by_sql($sql);

        $starsarray = [];
        foreach($starcalc as $stars) {
          $starsarray[] = $stars->stars;
         }
      
        if(empty($starsarray)) { } else {
          $allstars = array_sum($starsarray);
          $avgstar = $allstars / count($starsarray);
        }
      
        if(empty($avgstar)) { } else {
          echo round($avgstar, 2);
        }
      }


      public function starscalc($wineid) {
        $sql = ("SELECT stars FROM stars where wines_wineid = $wineid");
        $starcalc = static::find_by_sql($sql);

        $starsarray = [];
        foreach($starcalc as $stars) {
          $starsarray[] = $stars->stars;
         }
      
        if(empty($starsarray)) { } else {
          $allstars = array_sum($starsarray);
          $avgstar = $allstars / count($starsarray);
        }
      
        if(empty($avgstar)) { } else {
          echo '<span id="starnumber">' . round($avgstar, 2) . '</span>';
          $ss = '';
      
            if($avgstar >= 1 && $avgstar < 2) {
              $ss = '<i class="fas fa-star"></i>';
              echo $ss;
            } elseif($avgstar >= 2 && $avgstar < 3 ) {
              $ss = '<i class="fas fa-star"></i><i class="fas fa-star"></i>';
                  echo $ss;
            } elseif($avgstar >= 3 && $avgstar < 4) {
              $ss = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
                  echo $ss;
            } elseif($avgstar >= 4 && $avgstar < 5) {
              $ss = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
                  echo $ss;
            } elseif($avgstar >= 5 && $avgstar < 6) {
              $ss = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
              echo $ss;
            } elseif($allstars >= 6) {
              $ss = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
              echo $ss;
            } else {
              $ss = '<i class="fas fa-star">0</i>';
              echo $ss;
            }
      
      }
      
        }

}


?>