<?php
/*
 * Class Name: King
 * Extends: Piece
 */
class King extends Piece {

  function __construct(Board $b, Colour $c, Square $s) {
    parent::__construct($b, $c, $s);
  }
  
  /*
   * Name: moveAllowed
   * Parameters:  Square $s: The Square that the piece is attempting to move to.
   * Remarks:
   *    - A delta of 1 is the King moving left or right
   *    - A delta of 7 is the King moving diagonally from top right to bottom left (or vice versa)
   *    - A delta of 9 is the King moving diagonally from top left to bottom right (or vice versa)
   *    - A delta of 8 is the King moving from one row to the next
   */
  protected function moveAllowed(Square $s) {
    //Get the position difference between the current square and the desired square
    $delta = $s->index - $this->location->index;

    //A piece may not be able to move to another square with a piece of the same colour
    if($this-board->hasSameColourPiece($s, $this->colour)) {
      return MoveType::ILLEGAL;
    }

    //Checking for a legal move
    if((abs($delta) == 1) || (abs($delta) == 7) || (abs($delta) == 9) || (abs($delta) == 8)){
      return MoveType::NORMAL;
    }

    //If the above cases do not satisfy, move is illegal
    return MoveType::ILLEGAL;
  }
}
?>