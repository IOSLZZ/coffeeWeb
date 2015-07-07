<?php 

class CoffeeEntity{
    public $id;
    public $name;
    public $type;
    public $price;
    public $roast;
    public $country;
    public $image;
    public $review;
	
// 注意构造函数是 双下划线
    function __construct($id,$name,$type,$price,$roast,$country,$image,$review){
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->price= $price;
        $this->roast = $roast;
        $this->country = $country;
        $this->image = $image;
        $this->review = $review;
    }


}


?>