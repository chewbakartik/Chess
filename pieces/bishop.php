<?php
/*
 * Class Name: Bishop
 * Extends: Piece
 */
class Bishop extends Piece {

  function __construct(Board $b, Colour $c, Square $s) {
    parent::__construct($b, $c, $s);
  }
  
  /*
   * Name: moveAllowed
   * Parameters:  Square $s: The Square that the piece is attempting to move to.
   * Remarks:
   *    - A delta of multiples of 9 is the bishop moving diagonally from top left to bottom right (or vice versa)
   *    - A delta of multiples of 7 is the bishop moving diagonally from top right to bottom left (or vice versa)
   */
  protected function moveAllowed(Square $s) {
    //Get the position difference between the current square and the desired square
    $delta = $s->index - $this->location->index;
    
    //Determine which direction the piece is moving, up or down the array
    if($delta > 0) {
      $direction = 1;
    } else {
      $direction = -1;
    }

    //A piece may not be able to move to another square with a piece of the same colour
    if($this-board->hasSameColourPiece($s, $this->colour)) {
      return MoveType::ILLEGAL;
    }

    // Moving from top left to bottom right
    if(abs($delta) % 9 == 0) {
      if($this->board->spacesBetweenEmpty($this->location->index, $delta / 9, 9, $direction)) {
        return MoveType::NORMAL;
      }
    }
    
    // Moving from top right to bottom left
    if(abs($delta) % 7 == 0) {
      if($this->spacesBetweenEmpty($this->location->index, $delta / 7, 7, $direction)) {
        return MoveType::NORMAL;
      }
    }
    
    //If the above cases do not satisfy, move is illegal
    return MoveType::ILLEGAL;
  }
}
?>