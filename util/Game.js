import GameBoard from "./GameBoard.js";
export default class Game extends GameBoard {
  #PlayerColorBoard = null;
  #CurrentGameBoard = null;
  #Player1Color = "W";
  recordCounter = 0;
  #Player2Color = "B";
  #CurrentTarget = [];
  constructor() {
    super();
    this.#PlayerColorBoard = [
      ["B", "B", "B", "B", "B", "B", "B", "B"],
      ["B", "B", "B", "B", "B", "B", "B", "B"],
      ["", "", "", "", "", "", "", ""],
      ["", "", "", "", "", "", "", ""],
      ["", "", "", "", "", "", "", ""],
      ["", "", "", "", "", "", "", ""],
      ["W", "W", "W", "W", "W", "W", "W", "W"],
      ["W", "W", "W", "W", "W", "W", "W", "W"],
    ];
    this.#CurrentGameBoard = this.InitChess_Board;
  }
  setUserHistoryBoard(y, x, y1, x2) {
    let first = Object.entries(this.#CurrentGameBoard[y][x]);
    let second = Object.entries(this.#CurrentGameBoard[y1][x2]);
    let temp = first[0][0];
    let temp1 = second[0][0];
    console.log(this.#CurrentGameBoard[y][x][temp], "Settting Board");
    this.#CurrentGameBoard[y1][x2][temp1] = this.#CurrentGameBoard[y][x][temp];
    this.#CurrentGameBoard[y][x][temp] = "";
    // Object.values(this.#CurrentGameBoard[y][x])="";
  }
  setUserColorBoard(y, x, y1, x2) {
    this.#PlayerColorBoard[y1][x2] = this.#PlayerColorBoard[y][x];
    this.#PlayerColorBoard[y][x] = "";
  }
  ColorBoard_XY(y, x) {
    console.log(this.#PlayerColorBoard[y][x], " and ", this.UserColor);
    return this.#PlayerColorBoard[y][x];
  }
  getSearchHistory(y, x) {
    return this.#CurrentGameBoard[y][x];
  }
  get UserHistoryBoard() {
    return this.#CurrentGameBoard;
  }
  get UserColorBoard() {
    return this.#PlayerColorBoard;
  }
  setrecordCounter() {
    this.recordCounter++;
  }
  get recordCounter() {
    return this.recordCounter;
  }
  set UserColor(Color) {
    this.#Player1Color = Color;
  }
  get UserColor() {
    return this.#Player1Color;
  }
  /**
   * @param {target[]} Target
   */
  set CurrentTarget(Target) {
    this.#CurrentTarget = Target;
  }
  get CurrentTarget() {
    return this.#CurrentTarget;
  }
  //   conssider extreme case (0,0) (7,7) (0,7) (7,0)
  #Rooksmove(y, x) {
    return new Promise((resolve, reject) => {
      let Arr = [];
      let isBlock = false;
      let isBlock1 = false;
      let isBlock2 = false;
      let isBlock3 = false;
      // Check one side each time
      for (let x1 = x + 1; x1 < 8; x1++) {
        let tempArr = [];
        // offload
        setTimeout(() => {
          let a = Object.values(this.#CurrentGameBoard[y][x1]);
          tempArr.push(a[0].toString());
          if (tempArr[0] !== "" && isBlock === false) {
            isBlock = true;
            if (tempArr[0] === this.#Player2Color) Arr.push(`${y}_${x1}`);
          } else if (isBlock === false) Arr.push(`${y}_${x1}`);
        }, 0);
      }
      for (let x2 = x - 1; x2 >= 0; x2--) {
        let tempArr = [];

        // offload
        setTimeout(() => {
          let a = Object.values(this.#CurrentGameBoard[y][x2]);
          tempArr.push(a[0].toString());
          if (tempArr[0] !== "" && isBlock1 === false) {
            isBlock1 = true;
            if (tempArr[0] === this.#Player2Color) Arr.push(`${y}_${x2}`);
          } else if (isBlock1 === false) Arr.push(`${y}_${x2}`);
        }, 0);
      }
      for (let y1 = y + 1, counter = 0; y1 < 8; y1++) {
        let tempArr = [];
        // offload
        setTimeout(() => {
          let a = Object.values(this.#CurrentGameBoard[y1][x]);
          tempArr.push(a[0].toString());
          if (tempArr[0] !== "" && isBlock2 === false) {
            isBlock2 = true;
            if (tempArr[0] === this.#Player2Color) Arr.push(`${y1}_${x}`);
          } else if (isBlock2 === false) Arr.push(`${y1}_${x}`);
        }, 0);
      }
      for (let y2 = y - 1, counter = 0; y2 >= 0; y2--) {
        let tempArr = [];
        // offload
        setTimeout(() => {
          let a = Object.values(this.#CurrentGameBoard[y2][x]);
          tempArr.push(a[0].toString());
          if (tempArr[0] !== "" && isBlock3 === false) {
            isBlock3 = true;
            if (tempArr[0] === this.#Player2Color) Arr.push(`${y1}_${x}`);
          } else if (isBlock3 === false) Arr.push(`${y2}_${x}`);
        }, 0);
      }
      //   Queing microtask inorder send data
      setTimeout(() => {
        resolve(Arr);
      }, 0);
    });
  }
  #Knightmove(y, x) {
    return new Promise((resolve) => {
      setTimeout(() => {
        // console.log(this.#gameHistory[y-10][x-10]);
        let test = [];
        y - 2 >= 0 && x - 1 >= 0 ? test.push(`${y - 2}_${x - 1}`) : null;
        y - 1 >= 0 && x - 2 >= 0 ? test.push(`${y - 1}_${x - 2}`) : null;
        y + 1 < 8 && x - 2 >= 0 ? test.push(`${y + 1}_${x - 2}`) : null;
        y + 2 < 8 && x - 1 >= 0 ? test.push(`${y + 2}_${x - 1}`) : null;
        y + 2 < 8 && x + 1 < 8 ? test.push(`${y + 2}_${x + 1}`) : null;
        y + 1 < 8 && x + 2 < 8 ? test.push(`${y + 1}_${x + 2}`) : null;
        y - 1 >= 0 && x + 2 < 8 ? test.push(`${y - 1}_${x + 2}`) : null;
        y - 2 >= 0 && x + 1 < 8 ? test.push(`${y - 2}_${x + 1}`) : null;
        resolve(test);
      }, 0);
    });
  }
  #Bishopmove(y, x) {
    return new Promise((resolve, reject) => {
      let Arr = [];
      let isBlock = false;
      let isBlock1 = false;
      let isBlock2 = false;
      let isBlock3 = false;
      // Check one side each time
      for (let x1 = x + 1, y1 = y + 1; x1 < 8 && y1 < 8; x1++, y1++) {
        let tempArr = [];
        // offload
        setTimeout(() => {
          let a = Object.values(this.#CurrentGameBoard[y1][x1]);
          tempArr.push(a[0].toString());
          if (tempArr[0] !== "" && isBlock === false) {
            isBlock = true;
            if (tempArr[0] === this.#Player2Color) Arr.push(`${y2}_${x1}`);
          } else if (isBlock === false) Arr.push(`${y2}_${x1}`);
        }, 0);
      }
      for (let x2 = x - 1, y2 = y + 1; x2 >= 0 && y2 < 8; x2--, y2++) {
        let tempArr = [];

        // offload
        setTimeout(() => {
          let a = Object.values(this.#CurrentGameBoard[y2][x2]);
          tempArr.push(a[0].toString());
          if (tempArr[0] !== "" && isBlock1 === false) {
            isBlock1 = true;
            if (tempArr[0] === this.#Player2Color) Arr.push(`${y2}_${x2}`);
          } else if (isBlock1 === false) Arr.push(`${y2}_${x2}`);
        }, 0);
      }
      for (let y3 = y - 1, x3 = x - 1; y3 >= 0 && x3 >= 0; y3--, x3--) {
        let tempArr = [];
        // offload
        setTimeout(() => {
          let a = Object.values(this.#CurrentGameBoard[y3][x3]);
          tempArr.push(a[0].toString());
          if (tempArr[0] !== "" && isBlock2 === false) {
            isBlock2 = true;
            if (tempArr[0] === this.#Player2Color) Arr.push(`${y3}_${x3}`);
          } else if (isBlock2 === false) Arr.push(`${y3}_${x3}`);
        }, 0);
      }
      for (let y4 = y - 1, x4 = x + 1; y4 >= 0 && x4 < 8; y4--, x4++) {
        let tempArr = [];
        // offload
        setTimeout(() => {
          let a = Object.values(this.#CurrentGameBoard[y4][x4]);
          tempArr.push(a[0].toString());
          if (tempArr[0] !== "" && isBlock3 === false) {
            isBlock3 = true;
            if (tempArr[0] === this.#Player2Color) Arr.push(`${y4}_${x4}`);
          } else if (isBlock3 === false) Arr.push(`${y4}_${x4}`);
        }, 0);
      }
      //   Queing microtask inorder send data
      setTimeout(() => {
        resolve(Arr);
      }, 0);
    });
  }
  async #Queenmove(y, x) {
    return new Promise(async (resolve) => {
      let temp = [];
      let temp2 = await this.#Bishopmove(y, x);
      temp = temp2.concat(await this.#Rooksmove(y, x));
      resolve(temp);
    });
  }
  #Kingmove(y, x) {
    return new Promise((resolve) => {
      setTimeout(() => {
        // console.log(this.#gameHistory[y-10][x-10]);
        let test = [];
        // y-1 x-1
        y - 1 >= 0 && x - 1 >= 0 ? test.push(`${y - 1}_${x - 1}`) : null;
        y - 1 >= 0 ? test.push(`${y - 1}_${x}`) : null;
        y - 1 >= 0 && x + 1 < 8 ? test.push(`${y - 1}_${x + 1}`) : null;
        x - 1 >= 0 ? test.push(`${y}_${x - 1}`) : null;
        x + 1 < 8 ? test.push(`${y}_${x + 1}`) : null;
        y + 1 < 8 && x - 1 >= 0 ? test.push(`${y + 1}_${x - 1}`) : null;
        y + 1 < 8 ? test.push(`${y + 1}_${x}`) : null;
        y + 1 < 8 && x + 1 < 8 ? test.push(`${y + 1}_${x + 1}`) : null;
        resolve(test);
      }, 0);
    });
  }
  #Pawnmove(y, x) {
    return new Promise((resolve) => {
      let test = [];
      if (this.#Player1Color === "W") {
        // if (y === 6) {
        //   test.push(`${y - 1}_${x}`);
        //   test.push(`${y - 2}_${x}`);
        // }
        // else if (y - 1 >= 0 && this.ColorBoard_XY(y - 1, x) === "") test.push(`${y - 1}_${x}`);
       if (this.ColorBoard_XY(y - 2, x) === "" && y ===6) test.push(`${y - 2}_${x}`);
       if (this.ColorBoard_XY(y - 1, x) === "") test.push(`${y - 1}_${x}`);
       if (this.ColorBoard_XY(y - 1, x - 1) === "B") test.push(`${y - 1}_${x - 1}`);
       if (this.ColorBoard_XY(y - 1, x + 1) === "B") test.push(`${y - 1}_${x + 1}`);
      } else {
        // if (y === 1) {
        //   test.push(`${y + 1}_${x}`);
        //   test.push(`${y + 2}_${x}`);
        // }
        // else if (y + 1 < 8 && this.ColorBoard_XY(y+1,x) === "") test.push(`${y + 1}_${x}`);
       if (this.ColorBoard_XY(y + 2, x) === "" && y === 1) test.push(`${y + 2}_${x}`);
       if (this.ColorBoard_XY(y + 1, x) === "") test.push(`${y + 1}_${x}`);
       if (this.ColorBoard_XY(y + 1, x - 1) === "W") test.push(`${y + 1}_${x - 1}`);
       if (this.ColorBoard_XY(y + 1, x + 1) === "W") test.push(`${y + 1}_${x + 1}`);
      }
      console.log(test);
      resolve(test);
    });
  }

  async getTarget(...target) {
    let y = target[0];
    let x = target[1];
    let current = this.#CurrentGameBoard[y][x];
    let a = Object.values(current);
    let holder = [];
    // Object values return array [['R','W']]
    switch (a[0][0].toString()) {
      case "R":
        holder = await this.#Rooksmove(y, x);
        break;
      case "N":
        holder = await this.#Knightmove(y, x);
        break;
      case "B":
        holder = await this.#Bishopmove(y, x);
        break;
      case "Q":
        holder = await this.#Queenmove(y, x);
        break;
      case "K":
        holder = await this.#Kingmove(y, x);
        break;
      case "P":
        holder = await this.#Pawnmove(y, x);
        break;
    }
    this.CurrentTarget = holder;
    // ex: [ '5_0', '6_3', '5_2' ] string[0] string [2]
    // Handle same color overllap
    let holder2 = [];
    holder.forEach((value) => {
      if (this.#PlayerColorBoard[value[0]][value[2]] !== this.#Player1Color) {
        holder2.push(value);
      }
    });
    this.#CurrentTarget = holder2;
    return holder2;
  }
}
