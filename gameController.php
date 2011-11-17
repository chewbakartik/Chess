<?php
/*
 * Class Name: GameController
 * Properties:
 *  - Board $board
 *  - Colour $currentPlayer
 * Methods:
 *  - void newGame()
 *  - bool getMove(int $fromIndex, int $toIndex);
 * Description: The controller initializes the game, keeps track of who's turn it
 *    currently is, and passes the input from the user(s) to the board
 * Remarks:
 *  - The UI is currently missing
 */
class GameController {
  //Private Properties
  private $board;
  private $currentPlayer;
  
  function __construct() {
    $this->newGame();
  }
  
  /*
   * Name: newGame
   * Parameters: none
   * Returns: nothing
   * Description: Initializes the game board and sets the starting player
   */
  public function newGame() {
    $this->board = new Board();
    $this->currentPlayer = Colour::WHITE;
  }
  
  /*
   * Name: getMove
   * Parameters:
   *  - int $fromIndex
   *  - int $toIndex
   * Returns:
   *  - string: It returns confirmation or error message to the user.
   * Description: Takes input from the user, and passes the requested move to the
   *    board to check the move's validity
   */
  public function getMove($fromIndex, $toIndex) {
    //Ensure that the square attempting to be moved has a piece that contains the
    //current player's piece
    if($this->board->hasSameColourPiece($fromIndex, $this->currentPlayer)) {
      $moveMade = $this->board->attemptMove($fromIndex, $toIndex);
      if($moveMade == true) {
        //Toggle the current player.
        //Colour::WHITE = 0
        //Colour::BLACK = 1
        //If current player is white, then we set next player to 1 - 0 (which is Black)
        //If current player is black, then we set next player to 1 - 1 (which is White)
        $this->currentPlayer = 1 - $this->currentPlayer;
      }
    } else {
      $moveMade = false;
    }
    if($moveMade == false) {
      return "Not a valid move";
    }
    return "Move Successful";
  }
}
?>