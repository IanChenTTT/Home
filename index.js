import Game from "./util/Game.js";
let test = new Game();
console.table(test.UserColorBoard);
test.setUserHistoryBoard(0, 0, 7, 7);
console.table(test.UserHistoryBoard);
const piece = document.querySelectorAll(".CanDrag");
const block = document.querySelectorAll(".dropable");
piece.forEach((element) => {
  AddDragEvent(element);
});
block.forEach((element, key) => {
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
  });
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
function dragStart(event, element) {
  event.dataTransfer.setData("Text", event.target.className);
  const data = event.dataTransfer.getData("text");
  console.log(data);
  console.log(element.className[0] + " " + element.className[2]);
  //  Catch if user drag own color
//   socket.emit("JudgeColor", element.className[0], element.className[2]);
  console.log("drag start");
}
function dragEnd(event, element) {
  console.log("enter drag end");
//   socket.emit("dragEnd", "drag has end");
}
