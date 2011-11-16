<?php
class Bishop extends Piece {
  protected function MoveAllowed(Square $s) {
    $delta = $s->index - $this->location->index;
    if($delta > 0) {
      $direction = 1;
    } else {
      $direction = -1;
    }

    if($this-board->HasSameColourPiece($s, $this->colour)) {
      return MoveType::ILLEGAL;
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
  }
  
  function TryMove(Square $s) {
    $mt = $this->MoveAllowed($s);
    if($mt != MoveType::ILLEGAL) {
      $this->board->Move($this->location, $s);
    }
  }

}
?>