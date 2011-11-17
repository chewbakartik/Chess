<?php
/*
 * Class Name: Pawn
 * Extends: Piece
 */
class Pawn extends Piece {

  private $direction;
  
  function __construct(Board $b, Colour $c, $index) {
    parent::__construct($b, $c, $index, "pawn");
    if($c == Colour::WHITE)
      $this->direction = +1;
    else
      $this->direction = -1;
  }
  
  /*
   * Name: moveAllowed
   * Parameters:
   *  - Square $s: The Square that the piece is attempting to move to.
   * Returns: MoveType constant
   * Description: This method contains the logic that determines whether or not the piece
   *    can be moved to the square passed in.  This method must be overwritten in
   *    all sub classes.
   * Remarks:
   *  - A delta of 8 is the Pawn to the next row
   *  - A delta of 16 is the Pawn opening with a doublestep (2 rows)
   *  - A delta of 13 or 9 is the Pawn attacking diagonally
   */
  protected function moveAllowed(Square $s) {
    //Get the position difference between the current square and the desired square
    $delta = $s->index - $this->location;

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
/*    if($this->board->isEnPassant($s, $this->location))
    {
      return MoveType::ENPASSANT;
    }
*/
    //If the above cases do not satisfy, move is illegal
    return MoveType::ILLEGAL;
  }
}
?>