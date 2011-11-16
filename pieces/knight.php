<?php
/*
 * Class Name: Knight
 * Extends: Piece
 */
class Knight extends Piece {

  function __construct(Board $b, Colour $c, Square $s) {
    parent::__construct($b, $c, $s);
  }
  
  /*
   * Name: moveAllowed
   * Parameters:  Square $s: The Square that the piece is attempting to move to.
   * Remarks:
   *    - A delta of 6 is the Knight moving down 1 left 2 or up 1 right 2
   *    - A delta of 10 is the Knight moving up 1 left 2 or down 1 right 2
   *    - A delta of 15 is the Knight moving down 2 left 1 or up 2 right 1
   *    - A delta of 17 is the Knight moving up 2 left 1 or down 2 right 1
   */
  protected function moveAllowed(Square $s) {
    $delta = $s->index - $this->location->index;
    if($this-board->hasSameColourPiece($s, $this->colour)) {
      return MoveType::ILLEGAL;
    }

    if((abs($delta) == 6) || (abs($delta) == 10) || (abs($delta) == 15) || (abs($delta) == 17)){
      return MoveType::NORMAL;
    }
    return MoveType::ILLEGAL;
  }
}
?>