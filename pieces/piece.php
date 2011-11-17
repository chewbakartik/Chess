<?php
/*
 * Class Name: Piece
 * Properties:
 *    - Board $board
 *    - Colour $colour
 *    - int $location: index in the board->squares[]
 *    - int $moveCount
 *    - string $pieceType
 *    - bool $taken
 * Methods:
 *    - MoveType moveAllowed(Square $s);
 * Description: Abstract base class for all of the piece objects
 */
abstract class Piece {
  //Protected Properties
  protected $board;
  
  //Public Properties
  public $colour;
  public $moveCount;
  public $location;
  public $pieceType;
  public $taken;
  
  //Constructor
  function __construct(Board $b, Colour $c, $index, $pieceType) {
    $this->board = $b;
    $this->colour = $c;
    $this->location = $index;
    $this->pieceType = $pieceType;
  }
  
  //Abstract Methods
  
  /*
   * Name: moveAllowed
   * Parameters:
   *  - Square $s: The Square that the piece is attempting to move to.
   * Returns: MoveType constant
   * Description: This method contains the logic that determines whether or not the piece
   *    can be moved to the square passed in.  This method must be overwritten in
   *    all sub classes.
   */
  abstract protected function moveAllowed(Square $s); 
}
?>