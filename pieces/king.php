<?php
class King extends Piece {
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

    if((abs($delta) == 1) || (abs($delta) == 7) || (abs($delta) == 9){
      return MoveType::NORMAL;
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