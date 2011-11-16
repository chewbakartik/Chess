<?php
class Queen extends Piece {
  private $column;
  private $row;
  
  protected function MoveAllowed(Square $s) {
    $newColumn = $s->index % 8;
    $newRow = floor($s->index / 8);
    $delta = $s->index - $this->location->index;
    if($delta > 0) {
      $direction = 1;
    } else {
      $direction = -1;
    }

    if($this-board->HasSameColourPiece($s, $this->colour)) {
      return MoveType::ILLEGAL;
    }

    if($newColumn == $this->column) && ($newRow != $this->row) {
      //Check to see if spaces in between are the same
      if($this->SpacesBetweenEmpty($this->location->index, $delta / 8, 8, $direction)) {
        return MoveType::NORMAL;
      }
    }
    
    if($newColumn != $this->column) && ($newRow == $this->row) {
      //Check to see if spaces in between are the same
      if($this->SpacesBetweenEmpty($this->location->index, $delta / 1, 1, $direction)) {
        return MoveType::NORMAL;
      }
    }
    
    if(abs($delta) % 9 == 0) {
      if($this->board->SpacesBetweenEmpty($this->location->index, $delta / 9, 9, $direction)) {
        return MoveType::NORMAL;
      }
    }
    if(abs($delta) % 7 == 0) {
      if($this->SpacesBetweenEmpty($this->location->index, $delta / 7, 7, $direction)) {
        return MoveType::NORMAL;
      }
    }

    return MoveType::ILLEGAL;
  }
  
  function __construct(Board $b, Colour $c, Square $s) {
    parent::__construct($b, $c, $s);
    $this->column = $this->location->index % 8;
    $this->row = floor($this->location->index / 8);
  }
  
  function TryMove(Square $s) {
    $mt = $this->MoveAllowed($s);
    if($mt != MoveType::ILLEGAL) {
      $this->board->Move($this->location, $s);
    }
  }
}
?>