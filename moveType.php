<?php
/*
 * Class Name: MoveType
 * Description: Contains the name of all types of moves possible in a chess game.
 *              Enables special moves to be handled differently.
 */
class MoveType {
    const NORMAL = 0;
    const CASTLE = 1;
    const DOUBLESTEP = 2;
    const ILLEGAL = 3;
    const ENPASSANT = 4;
}
?>