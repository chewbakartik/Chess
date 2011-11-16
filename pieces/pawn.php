<?php
/*
 * Class Name: Pawn
 * Extends: Piece
 */
class Pawn extends Piece {
  private $direction;
  
  protected function moveAllowed(Square $s) {
    $delta = $s->index - $this->location->index;
    //Check for a normal move
    if(($delta == ($this->direction * 8)) && (!$this->board->hasPiece($s))) {
      return MoveType::NORMAL;
    }
    //Check for the double step
    if(($delta == ($this->direction * 16)) && (!$this->board->hasPiece($s)) && ($this->moveCount == 0)) {
      return MoveType::DOUBLESTEP;
    }
    //Check for a normal attack
    if((($delta == ($this->direction * 13)) || ($delta == ($this->direction * 9))) && ($this-board->hasOpposingPiece($s, $this->colour)))
    {
      return MoveType::NORMAL;
    }
    //Check for En Passant
    if($this->board->isEnPassant($s, $this->location))
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
  
  function tryMove(Square $s) {
    $mt = $this->moveAllowed($s);
    if($mt != MoveType::ILLEGAL) {
      if($mt == MoveType::ENPASSANT) {
        $this->board->moveEnPassant($this->location, $s);
      } else {
        $this->board->move($this->location, $s);
      }
    }
  }
}
?>