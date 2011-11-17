<?php
/*
 * Class Name: Rook
 * Extends: Piece
 */
class Rook extends Piece {

  function __construct(Board $b, Colour $c, Square $s) {
    parent::__construct($b, $c, $s);
  }
  
  /*
   * Name: moveAllowed
   * Parameters:  Square $s: The Square that the piece is attempting to move to.
   * Remarks:
   *    - Rook can move by staying on the same row or same column
   */
  protected function moveAllowed(Square $s) {
    $newColumn = $s->column;
    $newRow = $s->row;

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

    //Moving up and down a column
    if($newColumn == $this->location->column) && ($newRow != $this->location->row) {
      //Check to see if spaces in between are the same
      if($this->spacesBetweenEmpty($this->location->index, $delta / 8, 8, $direction)) {
        return MoveType::NORMAL;
      }
    }
    
    //Moving up and down a row
    if($newColumn != $this->location->column) && ($newRow == $this->location->row) {
      //Check to see if spaces in between are the same
      if($this->spacesBetweenEmpty($this->location->index, $delta / 1, 1, $direction)) {
        return MoveType::NORMAL;
      }
      //Check for Castle Move
    }
    
    //If the above cases do not satisfy, move is illegal
    return MoveType::ILLEGAL;
  }
  
  /*
   * Name:        tryMove
   * Parameters:  Square $s: The Square that the piece is attempting to move to.
   * Description: This method will attempt to move the piece on the board
   *              Overrides method on parent class in order to consider the special Castle move
   */
  function tryMove(Square $s) {
    $mt = $this->moveAllowed($s);
    if($mt != MoveType::ILLEGAL) {
      $this->board->move($this->location, $s);
    }
  }
}
?>