<?php
class Personality
{

  public $id;
  public $name;
  public $shortDescription;
  public $longDescription;
  public $color;
  public $image;

  public function __construct($id, $name, $shortDescription, $longDescription, $color, $image)
  {
    $this->id = $id;
    $this->name = $name;
    $this->shortDescription = $shortDescription;
    $this->longDescription = $longDescription;
    $this->color = $color;
    $this->image = $image;
  }

  public function generateCard()
  {

    $link = "personality-template.php?id=" . $this->id;

    return '
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 py-5 border-bottom">
      <a href="' . $link . '" class="card-link" style="text-decoration: none;">
        <div class="card p-4 rounded-42" style="background-color: ' . $this->color . '; height: 100%;">
          <div class="p-2">
            <img src="' . $this->image . '" class="card-img-top rounded" alt="' . $this->name . '">
          </div> 
          <div class="h1 text-center pt-2">
            ' . $this->name . '
          </div>
          <div class="mb-3 text-center" style="color:white;">
            ' . $this->shortDescription . '
          </div>
          <div class="mb-3 text-center">
            <a href="' . $link . '" class="btn btn-primary" style="background-color: '. $this->color.'; border-color: white;">Read More</a>
          </div>
        </div>
      </a>
    </div>
    ';
  }
}



class IslandContent
{

  public $id;

  public $pkid;

  public $image;

  public $content;

  public $color;

  public function __construct($id, $pkid, $image, $content, $color)
  {

    $this->id = $id;

    $this->pkid = $pkid;

    $this->image = $image;

    $this->content = $content;

    $this->color = $color;

  }

  public function generateContent()
{
    return '
    <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
      <div class="card shadow border-0"> 
        <img src="' . $this->image . '" alt="' . $this->content . '" class="card-img-top img-fluid rounded" style="height: 250px; object-fit:cover; width: 100%;">
        <div class="card-body">
            <p class="text-center"  style="color:' . $this->color . ';">
              ' . $this->content . '
            </p>
        </div>
      </div>
    </div>';
}
}
?>