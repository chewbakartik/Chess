<?php
abstract class Piece {
  //Protected Properties
  protected $board;
  protected $colour;
  protected $location;
  protected $moveCount;
  
  //Abstract Methods
  abstract protected function MoveAllowed(Square s); //returns MoveType Object
  abstract protected function TryMove(Square s);
  
  //Constructor
  function __construct(Board $b, Colour $c, Square $s) {
    $this->board = $b;
    $this->colour = $c;
    $this->location = $s;
  }
  
  //Public methods
  public function GetLocation() {
    return $square;
  }
  
  public function GetColour() {
    return $colour;
  }
  
  public function SetLocation(Square $s) {
    $this->location = $s;
  }
  
  public function SetLocation($x, $y) {
    $this->location->x = $x;
    $this->location->y = $y;
  }
}
?>