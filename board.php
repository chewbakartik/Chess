<?php
/*
 * Class Name: Board
 * Properties:
 *  - Square[64] $squares
 *  - bool $blackCheck
 *  - bool $blackMate
 *  - bool $whiteCheck
 *  - bool $whiteMate
 *  - bool $staleMate
 * Methods:
 *  - bool hasPiece(Square $s);
 *  - bool hasSameColourPiece(Square $s, Colour $colour);
 *  - bool spacesBetweenEmpty(int $index, int $spaces, int $spaceDiff, int $direction);
 *  - bool hasOpposingPiece(Square $s, Colour $colour);
 *  - bool hasPieceAtIndex(int $i);
 *  - void move(Square $from, Square $to);
 * Description: The board contains the information about the state of the game, it holds the
 *    array of squares, where each piece currently is on the board. When directed by the 
 *    game controller, the board also preforms the moves of pieces from one square to another.
 * Remarks:
 *  - Missing advanced moves for En Passant, Castle, and promoting the Pawn
 */
class Board {
  //Private Properties
  private $squares = array(64);
  private $blackCheck = false;
  private $blackMate = false;
  private $whiteCheck = false;
  private $whiteMate = false;
  private $staleMate = false;
  
  //Protected Properties
  protected $takenPieces = array();
  
  //Public Properties
  public $isGameOver = false;
  
  function __construct() {
    //Initialize squares and game pieces;
    $this->initializeBoard();
  }
  
  /*
   * Name: initializeBoard
   * Parameters: none
   * Returns: nothing
   * Description: Instantiates all the pieces and places them on the appropriate squares on the board
   */
  public function initializeBoard() {
    squares[0] = new Square(new Rook($this, Colour::BLACK, 0), 0);
    squares[1] = new Square(new Knight($this, Colour::BLACK, 1), 1);
    squares[2] = new Square(new Bishop($this, Colour::BLACK, 2), 2);
    squares[3] = new Square(new Queen($this, Colour::BLACK, 3), 3);
    squares[4] = new Square(new King($this, Colour::BLACK, 4), 4);
    squares[5] = new Square(new Bishop($this, Colour::BLACK, 5), 5);
    squares[6] = new Square(new Knight($this, Colour::BLACK, 6), 6);
    squares[7] = new Square(new Rook($this, Colour::BLACK, 7), 7);

    for($i = 8; $i < 16; $i++) {
      squares[$i] = new Square(new Pawn($this, Colour::BLACK, $i), $i);
    }
    
    for($i = 16; $i < 48; $i++) {
      squares[$i] = new Square(null, $i);
    }
    
    for($i = 48; $i < 56; $i++) {
      squares[$i] = new Square(new Pawn($this, Colour::WHITE, $i), $i);
    }

    squares[56] = new Square(new Rook($this, Colour::WHITE, 56), 56);
    squares[57] = new Square(new Knight($this, Colour::WHITE, 57), 57);
    squares[58] = new Square(new Bishop($this, Colour::WHITE, 58), 58);
    squares[59] = new Square(new Queen($this, Colour::WHITE, 59), 59);
    squares[60] = new Square(new King($this, Colour::WHITE, 60), 60);
    squares[61] = new Square(new Bishop($this, Colour::WHITE, 61), 61);
    squares[62] = new Square(new Knight($this, Colour::WHITE, 62), 62);
    squares[63] = new Square(new Rook($this, Colour::WHITE, 63), 63);
  }

  /*
   * Name: attemptMove
   * Parameters:
   *  - int $fromIndex
   *  - int $toIndex
   * Returns: bool
   * Description: Validates a move's legality, then executes the move
   */
  public function attemptMove($fromIndex, $toIndex) {
    $mt = $this->squares[$fromIndex]->piece->moveAllowed($squares[$toIndex]);

    if($mt != MoveType::ILLEGAL) {
      $this->move($this->squares[$fromIndex], $this->squares[$toIndex]);
      return true;
    }

    return false;
  }

  /*
   * Name: hasPiece
   * Parameters:
   *  - Square $s: The square being examined
   * Returns: bool
   * Description: Determines whether or not there is a piece currently occupying the
   *    square in question
   */
  public function hasPiece(Square $s) {
    if($squares[$s->index]->piece != null) {
      return true;
    }
    return false;
  }
  
  /*
   * Name: hasSameColourPiece
   * Parameters:
   *  - int $index
   *  - Colour $colour
   * Returns: bool
   * Description: Determines if the square has a piece, and if so, whether or not the piece
   *    occupying the square is the same colour the player whose turn it currently is
   */
  public function hasSameColourPiece($index, Colour $colour) {
    if($this->hasPiece($this->squares[$index]) && $this->squares[$index]->piece->colour == $colour) {
      return true;
    }
    return false;
  }
  
  /*
   * Name: spacesBetweenEmpty
   * Parameters:
   *  - int $index: Index of the current square in the squares array
   *  - int $spaces: The number of squares a piece is trying to move
   *  - int $spaceDiff: The difference of the indexes in the squares array for a piece
   *                    to move one square.
   *  - int $direction: A positive or negative 1 determining if the piece is moving up or down
   *                    the array.
   * Returns: bool
   * Description: Examines the squares between the starting position, and the square a piece
   *    intends to move to.  It ensures that every square between those two points is empty.
   */
  public function spacesBetweenEmpty($index, $spaces, $spaceDiff, $direction) {
    for($i = 1; $i < $spaces; $i++) {
      if($this->board->hasPieceAtIndex($index + ($direction * $i * $spaceDiff))) {
        return false;
      }
      return true;
    }
  }
  
  /*
   * Name: hasOpposingPiece
   * Parameters:
   *  - Square $s
   *  - Colour $colour
   * Returns: bool
   * Description: Determines if the square has a piece, and if so, whether or not the piece
   *    occupying the square is the opposing colour
   */
  public function hasOpposingPiece(Square $s, Colour $colour) {
    if($this->hasPiece($s) && $this->squares[$s->index]->piece->colour != $colour) {
      return true;
    }
    return false;
  }
  
  /*
   * Name: hasPieceAtIndex
   * Parameters:
   *  - int $i
   * Returns: bool    
   * Description: Determines whether or not there is a piece currently occupying the
   *    square in question 
   */
  public function hasPieceAtIndex($i) {
    if($this->squares[$i]->piece != null) {
      return true;
    }
    return false;
  }
  
  /*
   * Name: move       
   * Parameters:
   *  - int $from
   *  - Square $to
   * Returns: nothing
   * Description: Preforms the move operation of a piece from one square to another
   */
  public function move(Square $from, Square $to)
  {
    //Increment move count for piece
    $from->piece->moveCount += 1;
    
    //If $to square has opposing piece, remove it from the game
    if($this->hasOpposingPiece($to, $from->piece->colour)) {
      $to->piece->taken = true;
      $to->piece->location = null;
      $this->takenPieces[] = $to->piece;
    }
    
    //Update $to square to have the piece from $from, and remove the piece from $from
    $to->piece = $from->piece;
    $to->piece->location = $to->index;
    $from->piece = null;
  }
}
?>