<?php 


class Wine extends Databaseobject {

    static protected $table_name = 'wines';
    static protected $db_columns = ['id', 'wine_name', 'wine_region_country', 'wine_grapes', 'wine_year', 'wine_volume', 'wine_size',
     'wine_price', 'wine_real_price', 'wine_date', 'wine_boughtby', 'wine_img', 'users_userid'];


    public $id;
    public $wine_name;
    public $wine_region_country;
    public $wine_grapes;
    public $wine_year;
    public $wine_volume;
    public $wine_size;
    public $wine_price;
    public $wine_real_price;
    public $wine_date;
    public $wine_boughtby;
    public $wine_img;
    public $users_userid;


    public function __construct($args=[]) {
        $this->id = $args['id'] ?? '';
        $this->wine_name = $args['wine_name'] ?? '';
        $this->wine_region_country = $args['wine_region_country'] ?? '';
        $this->wine_grapes = $args['wine_grapes'] ?? '';
        $this->wine_year = $args['wine_year'] ?? '';
        $this->wine_volume = $args['wine_volume'] ?? '';
        $this->wine_size = $args['wine_size'] ?? '';
        $this->wine_price = $args['wine_price'] ?? '';
        $this->wine_real_price = $args['wine_real_price'] ?? '';
        $this->wine_date = $args['wine_date'] ?? '';
        $this->wine_boughtby = $args['wine_boughtby'] ?? '';
        $this->wine_img = $args['wine_img'] ?? '';
        $this->users_userid = $args['users_userid'] ?? '';
    }


    public function wine_price() {
        return $this->wine_price;
    }

}





?>