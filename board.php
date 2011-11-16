<?php
class Board {
  $squares = array(64);
  
  function __construct() {
  }
  
  function HasPiece(Square $s) {
    if($squares[$s->index]->piece != null) {
      return true;
    return false;
    }
  }
  
  function HasSameColourPiece(Square $s, Colour $colour) {
    if($this->HasPiece($s) && $this->squares[$s->index]->piece->colour == $colour)
      return true;
    return false;
  }
  
  function SpacesBetweenEmpty($index, $spaces, $spaceDiff, $direction) {
    for($i = 1; $i < $spaces; $i++) {
      if($this->board->HasPieceAtIndex($index + ($direction * $i * $spaceDiff))) {
        return false;
      }
      return true;
    }
  }
  
  function Move($from, $to)
  {
    //Do Stuff
  }
}
?>