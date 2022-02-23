

Node.prototype.appendFromObject = function (object, firstLayer = true) {
    if (firstLayer) {
        var nodes = [];
    }
    for (let key in object) {
        let child;
        if (object.hasOwnProperty(key)) {
            const element = object[key]; // divs and scripts...
            if (typeof element == "object" && key != "children") {
                if (key.match(/\d+/)) {
                    key = key.replace(/\d+/, "");
                }
               
                child = document.createElement(key);
                for (const attributes in element) {
                    if (element.hasOwnProperty(attributes)) {
                        if (attributes != "children") {
                            if (attributes == "style" && typeof element[attributes] == "object") {
                                child.interpretStyleFromObject(element[attributes]);
                            } else {
                                (attributes == "innerHTML") ? child.innerHTML = element[attributes] : child.setAttribute(attributes, element[attributes]);
                            }
                        } else {
                            child.appendFromObject(element[attributes], false);
                        }
                    }
                } 
            
            }
        }
        if (firstLayer) {
            nodes.push(child);
        }
        this.appendChild(child);
    }
    return nodes;
}

Node.prototype.insertBeforeFromObject = function (object, location = null) {
    (location == null) ? location = this.childNodes[0] : "";
    let temp = document.createElement("div");
    var nodes = temp.appendFromObject(object);
    for (let i = 0; i < nodes.length; i++) {
        const element = nodes[i];
        this.insertBefore(element, location);
    }
    return nodes;
}

Node.prototype.interpretStyleFromObject = function (styleObj) {
    for (const styleAttribute in styleObj) {
        if (styleObj.hasOwnProperty(styleAttribute)) {
            const value = styleObj[styleAttribute];
            this.style[styleAttribute] = value;
        }
    }
}
function createMultipleItems(type, values) {
    var obj = {};
    for (let i = 0; i < values.length; i++) {
        obj[type + (i + 1)] = {};
        obj[type + (i + 1)]["innerHTML"] = values[i];
        console.log(obj[type + (i + 1)]["innerHTML"]);

    }
    return obj;
}