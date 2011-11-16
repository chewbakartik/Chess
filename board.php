<?php
class Board {
  private $squares = array(64);
  
  function __construct() {
  }
  
  function hasPiece(Square $s) {
    if($squares[$s->index]->piece != null) {
      return true;
    }
    return false;
  }
  
  public function hasSameColourPiece(Square $s, Colour $colour) {
    if($this->hasPiece($s) && $this->squares[$s->index]->piece->colour == $colour) {
      return true;
    }
    return false;
  }
  
  public function spacesBetweenEmpty($index, $spaces, $spaceDiff, $direction) {
    for($i = 1; $i < $spaces; $i++) {
      if($this->board->hasPieceAtIndex($index + ($direction * $i * $spaceDiff))) {
        return false;
      }
      return true;
    }
  }
  
  public function hasOpposingPiece(Square $s, Colour $colour) {
    if($this->hasPiece($s) && $this->squares[$s->index]->piece->colour != $colour) {
      return true;
    }
    return false;
  }
  
  public function hasPieceAtIndex($i) {
    if($this->squares[$i]->piece != null) {
      return true;
    }
    return false;
  }
  
  public function move($from, $to)
  {
    //Do Stuff
  }
}
?>