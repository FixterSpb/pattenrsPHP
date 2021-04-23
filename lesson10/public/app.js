const API = 'http://127.0.0.1:8082/';

const RADIUS = 30;
const WIDTH_SYMBOL = 10;
const HEIGHT_SYMBOL = 20;
const HEIGHT_NODE = HEIGHT_SYMBOL * 4;
const SPACE_X = RADIUS;
const SPACE_Y = HEIGHT_NODE + 20;
const nodes = [];
const lines = [];


function getWidthValue(node){
    if (node.type === "expression") return node.expression.length * WIDTH_SYMBOL;
    return RADIUS;
}

function fillNodesLines(tree, x = 0, y = SPACE_Y, maxX = 0, maxY = 0) {
    let leftX = 0, rightX = 0;

    if (tree.type === "expression") {
        let maxLeftY, maxRightY;
        if (tree.left) {
            [leftX, maxX, maxLeftY] = fillNodesLines(tree.left, x, y + SPACE_Y, maxY);
        }

        x = x + leftX;

        if (tree.right) {
            [rightX, maxX, maxRightY] = fillNodesLines(tree.right, maxX + SPACE_X, y + SPACE_Y, maxY);
        }

        maxY = maxLeftY > maxRightY ? maxLeftY : maxRightY;

        x = (rightX + leftX) / 2;
        addLine({x, y}, {x: leftX, y: y + SPACE_Y});
        addLine({x, y}, {x: rightX, y: y + SPACE_Y});
    }else{
        x += SPACE_X;
    }


    addNode(tree, x, y);
    maxY = maxY > y ? maxY : y;
    maxX = maxX > x + getWidthValue(tree) / 2 ? maxX : x + getWidthValue(tree) / 2;
    return [x, maxX, maxY];
}

function addNode(node, x, y) {
    nodes.push({node, x, y});
}

function addLine(start, end) {
    lines.push({start, end});
}

function renderLines(canvasContext, lines) {

    lines.forEach(line => {
        canvasContext.beginPath();
        canvasContext.moveTo(line.start.x, line.start.y);
        canvasContext.lineTo(line.end.x, line.end.y);
        canvasContext.stroke();
    })
}

function renderNodes(canvasContext, nodes) {
    nodes.forEach(item => {
        let value, width, height, color;

        if (item.node.type === "expression") {
            value = item.node.expression;
            width = value.length * WIDTH_SYMBOL;
            height = HEIGHT_NODE;
            color = "#777";
        } else {
            value = '' + item.node.value
            width = value.length * 12 + 15;
            height = 30;
            color = "#755";
        }
        canvasContext.beginPath();
        canvasContext.fillStyle = color;
        if (item.node.type === "expression") {
            canvasContext.rect(item.x - width / 2, item.y - height / 2, width, height);
        } else {
            canvasContext.arc(item.x, item.y, RADIUS, 0, 2 * Math.PI);
        }
        canvasContext.fill();
        canvasContext.beginPath();
        canvasContext.fillStyle = "#fff";
        canvasContext.textAlign = "center";
        canvasContext.textBaseline = "middle";
        canvasContext.font = "20px serif";
        if (item.node.type === "expression") {
            canvasContext.fillText(item.node.expression, item.x, item.y - HEIGHT_SYMBOL);
            canvasContext.fill();
            canvasContext.beginPath();
            canvasContext.fillStyle = "darkgreen";
            canvasContext.fillText(item.node.result, item.x, item.y + HEIGHT_SYMBOL);
        } else {
            canvasContext.fillText(item.node.value, item.x, item.y);
        }

        canvasContext.fill();
    });
}

async function calc(expression) {

    const tree = await (await fetch(API + "?expression=" + expression)).json();
    init();
    const canvasContext = document.querySelector("canvas").getContext("2d");

    let canvasWidth, canvasHeight;

    [, canvasWidth, canvasHeight] = fillNodesLines(tree.expression);
    canvasContext.canvas.width = canvasWidth + SPACE_X;
    canvasContext.canvas.height = canvasHeight + SPACE_Y;
    canvasContext.clearRect(0, 0, canvasContext.canvas.width, canvasContext.canvas.height);

    renderLines(canvasContext, lines);
    renderNodes(canvasContext, nodes);
};

function init(){
    nodes.splice(0);
    lines.splice(0);
}

document.querySelector("#calc").addEventListener("click", clickHandler);

async function clickHandler(){
    const expression = encodeURIComponent(document.querySelector("#expression").value);
    console.log(JSON.stringify(expression));
    await calc(expression);
}

clickHandler();
