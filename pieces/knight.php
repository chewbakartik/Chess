<?php
/*
 * Class Name: Knight
 * Extends: Piece
 */
class Knight extends Piece {

  function __construct(Board $b, Colour $c, $index) {
    parent::__construct($b, $c, $index, "knight");
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
   *  - A delta of 6 is the Knight moving down 1 left 2 or up 1 right 2
   *  - A delta of 10 is the Knight moving up 1 left 2 or down 1 right 2
   *  - A delta of 15 is the Knight moving down 2 left 1 or up 2 right 1
   *  - A delta of 17 is the Knight moving up 2 left 1 or down 2 right 1
   */
  protected function moveAllowed(Square $s) {
    //Get the position difference between the current square and the desired square
    $delta = $s->index - $this->location;

    //A piece may not be able to move to another square with a piece of the same colour
    if($this-board->hasSameColourPiece($s, $this->colour)) {
      return MoveType::ILLEGAL;
    }

    //Check for a normal move
    if((abs($delta) == 6) || (abs($delta) == 10) || (abs($delta) == 15) || (abs($delta) == 17)){
      return MoveType::NORMAL;
    }

    //If the above cases do not satisfy, move is illegal
    return MoveType::ILLEGAL;
  }
}
?>