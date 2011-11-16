<?php
class Knight extends Piece {
  protected function MoveAllowed(Square $s) {
    $delta = $s->index - $this->location->index;
    if($this-board->HasSameColourPiece($s, $this->colour)) {
      return MoveType::ILLEGAL;
    }

    if((abs($delta) == 6) || (abs($delta) == 10)){
      return MoveType::NORMAL;
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