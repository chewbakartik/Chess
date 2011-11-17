<?php
/*
 * Class Name: Rook
 * Extends: Piece
 */
class Rook extends Piece {

  function __construct(Board $b, Colour $c, $index) {
    parent::__construct($b, $c, $index, "rook");
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
   *  - Rook can move by staying on the same row or same column
   */
  protected function moveAllowed(Square $s) {
    $newColumn = $s->column;
    $newRow = $s->row;
    $currentColumn = $this->board->getColumnFromSquareIndex($this->location)
    $currentRow = $this->board->getRowFromSquareIndex($this->location)

    //Get the position difference between the current square and the desired square
    $delta = $s->index - $this->location;
    
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
    if($newColumn == $currentColumn && ($newRow != $currentRow) {
      //Check to see if spaces in between are the same
      if($this->spacesBetweenEmpty($this->location, $delta / 8, 8, $direction)) {
        return MoveType::NORMAL;
      }
    }
    
    //Moving up and down a row
    if($newColumn != $currentColumn) && ($newRow == $currentRow) {
      //Check to see if spaces in between are the same
      if($this->spacesBetweenEmpty($this->location, $delta / 1, 1, $direction)) {
        return MoveType::NORMAL;
      }
      //Check for Castle Move
    }
    
    //If the above cases do not satisfy, move is illegal
    return MoveType::ILLEGAL;
  }
}
?>