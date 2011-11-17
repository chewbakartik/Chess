<?php
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