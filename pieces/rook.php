<?php
class Rook extends Piece {

  function __construct(Board $b, Colour $c, Square $s) {
    parent::__construct($b, $c, $s);
  }
  
  protected function moveAllowed(Square $s) {
    $newColumn = $s->column;
    $newRow = $s->row;
    $delta = $s->index - $this->location->index;
    if($delta > 0) {
      $direction = 1;
    } else {
      $direction = -1;
    }

    if($this-board->hasSameColourPiece($s, $this->colour)) {
      return MoveType::ILLEGAL;
    }

    if($newColumn == $this->location->column) && ($newRow != $this->location->row) {
      //Check to see if spaces in between are the same
      if($this->spacesBetweenEmpty($this->location->index, $delta / 8, 8, $direction)) {
        return MoveType::NORMAL;
      }
    }
    
    if($newColumn != $this->location->column) && ($newRow == $this->location->row) {
      //Check to see if spaces in between are the same
      if($this->spacesBetweenEmpty($this->location->index, $delta / 1, 1, $direction)) {
        return MoveType::NORMAL;
      }
      //Check for Castle Move
    }
    
    return MoveType::ILLEGAL;
  }
  
  function tryMove(Square $s) {
    $mt = $this->moveAllowed($s);
    if($mt != MoveType::ILLEGAL) {
      $this->board->move($this->location, $s);
    }
  }
}
?>