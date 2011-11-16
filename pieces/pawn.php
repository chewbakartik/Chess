<?php
class Pawn extends Piece {
  private $direction;
  
  protected function MoveAllowed(Square $s) {
    $delta = $s->index - $this->location->index;
    //Check for a normal move
    if(($delta == ($this->direction * 8)) && (!$this->board->HasPiece($s))) {
      return MoveType::NORMAL;
    }
    //Check for the double step
    if(($delta == ($this->direction * 16)) && (!$this->board->HasPiece($s)) && ($this->moveCount == 0)) {
      return MoveType::DOUBLESTEP;
    }
    //Check for a normal attack
    if((($delta == ($this->direction * 13)) || ($delta == ($this->direction * 9))) && ($this-board->HasOpposingPiece($s, $this->colour)))
    {
      return MoveType::NORMAL;
    }
    //Check for En Passant
    if($this->board->IsEnPassant($s, $this->location))
    {
      return MoveType::ENPASSANT;
    }
    return MoveType::ILLEGAL;
  }
  
  function __construct(Board $b, Colour $c, Square $s) {
    parent::__construct($b, $c, $s);
    if($c == Colour::WHITE)
      $this->direction = +1;
    else
      $this->direction = -1;
  }
  
  function TryMove(Square $s) {
    $mt = $this->MoveAllowed($s);
    if($mt != MoveType::ILLEGAL) {
      if($mt == MoveType::ENPASSANT) {
        $this->board->MoveEnPassant($this->location, $s);
      } else {
        $this->board->Move($this->location, $s);
      }
    }
  }
}
?>