<?php
class Personality{
  public $name;
  public $shortDescription;
  public $longDescription;
  public $color;
  public $image;

  public function __construct($name, $shortDescription, $longDescription, $color, $image){
    $this->name = $name;
    $this->shortDescription = $shortDescription;
    $this->longDescription = $longDescription;
    $this->color = $color;
    $this->image = $image;
  }

  public function generateCard() {
    return '
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 py-5">
      <div class="card p-4 rounded-5" style="background-color: '.$this->color.';">
        <div class="p-2">
          <img src="'.$this->image.'" class="card-img-top" alt="'.$this->name.'">
        </div> 
        <div class="h3 text-center">
          '.$this->name.'
        </div>
        <div class="mb-3 text-secondary text-center">
          '.$this->shortDescription.'
        </div>
        <div class="mb-3 text-center">
          '.$this->longDescription.'
        </div>
      </div>
    </div>
    ';
  }
}
?>