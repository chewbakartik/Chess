<?php
/*
 * Class Name: Square
 * Properties:
 *  - int $column
 *  - int $row
 *  - int $index
 *  - Piece $piece
 * Methods:
 * Description: The square is the placeholder for the game pieces
 */
class Square {
  public $column;
  public $row;
  public $index;
  public $piece;
  
  function __construct(Piece $piece, $index) {
    $this->piece = $piece;
    $this->index = $index;
    $this->column = $index % 8;
    $this->row = floor($index / 8);
  }
}
?>