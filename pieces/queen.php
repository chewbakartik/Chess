<?php
class Queen extends Piece {

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
    }
    
    if(abs($delta) % 9 == 0) {
      if($this->board->spacesBetweenEmpty($this->location->index, $delta / 9, 9, $direction)) {
        return MoveType::NORMAL;
      }
    }
    if(abs($delta) % 7 == 0) {
      if($this->spacesBetweenEmpty($this->location->index, $delta / 7, 7, $direction)) {
        return MoveType::NORMAL;
      }
    }

    return MoveType::ILLEGAL;
  }
  
}
?>