<?php

class Event{
    public $id;
    public $img;
    public $content;

    public function __construct($id, $img, $content)
    {
      $this->id = $id;
      $this->img = $img;
      $this->content = $content;
    }

    public function generateCard(){
        return '
         <div class="col-lg-4 col-md-4 col-sm-12 py-3 ">
          <div class="card shadow border-0 rounded-3">
            <img src="'.$this->img.'" class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-text">'.$this->content.'</p>
            </div>
          </div>
        </div>
        ';
    }
}

class Training {
    public $id;
    public $img;
    public $content;

    public function __construct($id, $img, $content) {
        $this->id = $id;
        $this->img = $img;
        $this->content = $content;
    }

    public function generateTrainCard() {
        return '
        <div class="trainCard col-lg-4 col-md-6 col-12 my-3 d-flex justify-content-center rounded">
            <img 
                class="rounded shadow img-fluid " 
                src="' . $this->img . '" 
                alt="Training Image" 
                style="cursor: pointer;" 
                data-bs-toggle="modal" 
                data-bs-target="#trainingModal' . $this->id . '">
            
            <!-- Modal -->
            <div class="modal fade" id="trainingModal' . $this->id . '" tabindex="-1" aria-labelledby="trainingModalLabel' . $this->id . '" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="trainingModalLabel' . $this->id . '">Training Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>' . $this->content . '</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
    }
}


?>