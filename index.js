import Game from "./util/Game.js";
let game = new Game();
console.table(game.UserColorBoard);
console.table(game.UserHistoryBoard);
const piece = document.querySelectorAll(".CanDrag");
const block = document.querySelectorAll(".dropable");
piece.forEach((element) => {
  AddDragEvent(element);
});
block.forEach((element) => {
  AddDropEvent(element);
});
function AddDragEvent(element) {
  element.addEventListener("dragstart", function (event) {
    console.log("dragstart");
    dragStart(event, this);
  });
  // To allow drop
  element.addEventListener("dragend", function (event) {
    console.log("drag end");
    dragEnd(event, this);
  });
}
function dragStart(event, element) {
  event.dataTransfer.setData("Text", event.target.className);
  const data = event.dataTransfer.getData("text");
  console.log(data);
  let Y = parseInt(element.className[0]);
  let X = parseInt(element.className[2]);
  console.log(element.className[0] + " " + element.className[2]);
  //  Catch if user drag own color
  console.log("drag start");
  if (game.ColorBoard_XY(Y, X) !== game.UserColor) {
    event.preventDefault();
    console.log("not color");
  } else {
    //  Target return like Y_X: 5_0
    (async () => {
      let target = await game.getTarget(Y, X);
      if (target[0] != "");
      {
        console.log(target);
        target.forEach((element) => {
          let hold = document.getElementsByClassName(element);
          hold[0].classList.add("MoveAble");
        });
      }
    })();
  }
}
function dragEnd(event, element) {
  // let target = game.getTarget(Y, X);
  if (game.CurrentTarget[0] != "") {
    game.CurrentTarget.forEach((element) => {
      let hold = document.getElementsByClassName(element);
      hold[0].classList.remove("MoveAble");
    });
  }
  console.log("enter drag end");
}
function AddDropEvent(element) {
  element.addEventListener("dragover", (event) => {
    event.preventDefault();
  });
  element.addEventListener("dragenter", (event) => {
    event.preventDefault();
  });
  element.addEventListener("drop", (event) => {
    event.preventDefault();
    let target = element.className.split(" ");
    const data = event.dataTransfer.getData("text");
    let origin = data.split(" ");
    console.log(origin[0], target[0]);
    // origin[0] = 6_0
    // origin[0][0] = 6
    let y = origin[0][0] - 0;
    let x = origin[0][2] - 0;
    let y1 = target[0][0] - 0;
    let x1 = target[0][2] - 0;
    game.CurrentTarget.forEach((current) => {
      if (target[0] === current) {
        console.log("drop");
        let Pic = game.ColorBoard_XY(y, x);
        let Pic2 = Object.values(game.getSearchHistory(y, x));
        let Orig = document.getElementsByClassName(origin[0]);
        element.setAttribute("draggable", "true");
        RemoveDragEvent(Orig[0]);
        AddDragEvent(element);
        Orig[0].style.backgroundImage = `none`;
        element.style.backgroundImage = `url(./image/${Pic}${Pic2}.svg)`;
        element.classList.add("ChessPiece", "CanDrag");
        game.setUserHistoryBoard(y, x, y1, x1);
        game.setUserColorBoard(y, x, y1, x1);
        let result =Object.entries(game.getSearchHistory(y1,x1));
        // etc: ["a4","K"]
        if (game.UserColor === "W") {
          game.setrecordCounter();
          CreateRecordDOM(game.recordCounter,result[0]);
          game.UserColor = "B";
        } else {
          CreateRecordDOM_Black(game.recordCounter,result[0]);
          game.UserColor = "W";
        }
      }
    });
  });
}
function RemoveDragEvent(element) {
  element.removeEventListener("dragstart", function (event) {
    console.log("dragstart");
    dragStart(event, this);
  });
  element.removeEventListener("dragend", function (event) {
    console.log("drag end");
    dragEnd(event, this);
  });
}
function CreateRecordDOM(counter,result) {
  const record = document.querySelector("table");
  const tr = document.createElement("tr");
  tr.setAttribute("id", `MOVE${counter}`);
  const td = document.createElement("td");
  td.innerHTML = counter;
  const td2 = document.createElement("td");
  td2.innerHTML = result;
  tr.appendChild(td);
  tr.appendChild(td2);
  record.appendChild(tr);
}
function CreateRecordDOM_Black(counter,result){
 let tr = document.querySelector(`#MOVE${counter}`)
  const td = document.createElement("td");
  td.innerHTML = result;
  tr.appendChild(td);
}