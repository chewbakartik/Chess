<?php
/*
 * Class Name: Piece
 * Properties:
 *    - Board $board
 *    - Colour $colour
 *    - Square $location
 *    - int $moveCount
 * Methods:
 *    - moveAllowed(Square $s);
 *    - tryMove(Square $s);
 * Description: Abstract base class for all of the piece objects
 */
abstract class Piece {
  //Protected Properties
  protected $board;
  protected $colour;
  protected $location;
  protected $moveCount;
  
  //Abstract Methods
  
  /*
   * Name:        moveAllowed
   * Parameters:  Square $s: The Square that the piece is attempting to move to.
   * Returns:     MoveType constant
   * Description: This method contains the logic that determines whether or not the piece
   *              can be moved to the square passed in.  This method must be overwritten in
   *              all sub classes.
   */
  abstract protected function moveAllowed(Square s); //returns MoveType Object
  
  //Constructor
  function __construct(Board $b, Colour $c, Square $s) {
    $this->board = $b;
    $this->colour = $c;
    $this->location = $s;
  }
  
  /*
   * Name:        tryMove
   * Parameters:  Square $s: The Square that the piece is attempting to move to.
   * Description: This method will attempt to move the piece on the board
   */
  public function tryMove(Square $s) {
    $mt = $this->moveAllowed($s);
    if($mt != MoveType::ILLEGAL) {
      $this->board->move($this->location, $s);
    }
  }
  
  /*
   * Name:        setLocation
   * Parameters:  Square $s: The Square that the piece is moving to.
   * Description: This method updates the piece's knowledge of which square it's on.
   */
  public function setLocation(Square $s) {
    $this->location = $s;
  }
  
  /*
   * Name:        setLocationCoord
   * Parameters:  int $x, int $y: The coordinates of the square that the piece is moving to.
   * Description: This method updates the piece's knowledge of which square it's on.
   */
  public function setLocationCoord($x, $y) {
    $this->location->x = $x;
    $this->location->y = $y;
  }
}
?>