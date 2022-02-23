

/**
*JSON-Bibliothek zum lesen beschtimter Json-Objekte
*/

function hasParrent(fileInput, lineParrent, line) {
    var lineParrentSplit = lineParrent.split(":");
    if (lineParrentSplit[1].includes("{")) {
        var lines = line + 1;
        var fileInputSpecificSplit = fileInput.split("\n");
        for (var g = lines; g < fileInputSpecificSplit.length; g++) {
            if (fileInputSpecificSplit[g].includes("}")) {

                break;
            } else {
                var splitedDoubleDott = fileInputSpecificSplit[g].split(":");
                var splitDoubleDont = splitedDoubleDott[1].split("\"");
                if (splitDoubleDont[1] != undefined) {
                    document.write("<h1>" + splitDoubleDont[1] + "</h1>");
                } else {
                    var splitDoubleDont2 = splitedDoubleDott[1].split(",");
                    document.write("<h1>" + splitDoubleDont2[0] + "</h1>");
                }

            }
        }
    } else {
        var splits = lineParrentSplit[1].split("\"");
        document.write("<h1>" + splits[1] + "</h1>");
    }

}
var verschachtelteJsonObjectNum = 0;

function checkChild(num, child) {
    if (num == child) {
        return true;
    }
    return false;
}

function checklast(num, child, fileInput) {
    var getChild = child.split("=>");
    if (getChild[1] == "last") {
        console.log("last");
        var num2 = 0;
        var line = fileInput.split('\n');
        for (var sd = 0; sd <= line.length - 1; sd++) {
            if (line[sd].includes(getChild[0])) {
                num2++;
                if (checkChild(num2, num)) {
                    var splitedDoubleDott = line[sd].split(":");
                    var splitDoubleDont = splitedDoubleDott[1].split("\"");
                    if (splitDoubleDont[1] != undefined) {
                        document.write("<h1>" + splitDoubleDont[1] + "</h1>");
                    } else {
                        var splitDoubleDont2 = splitedDoubleDott[1].split(",");
                        document.write("<h1>" + splitDoubleDont2[0] + "</h1>");
                    }


                }
            }

        }
    }
}

function splitReq(fileInput, parrent, child) {
    var num = 0;
    var switche = true;
    var getChild = child.split("=>");
    var getChildArrow = child.split("->")[1];
    if (getChild[1] != undefined) {
        var switche = false;
    } else if (getChildArrow != undefined) {
        var switche = false;
    }


    if (parrent != "" && switche) {
        var line = fileInput.split('\n');
        for (var i = 0; i <= line.length - 1; i++) {
            verschachtelteJsonObjectNum++;
            if (line[i].includes(parrent)) {
                hasParrent(fileInput, line[i], i);
            }
        }
    } else if (getChildArrow != undefined && parrent != "") {

        var line = fileInput.split('\n');
        for (var i = 0; i <= line.length - 1; i++) {
            if (line[i].includes(parrent)) {
                if (getChild[1] != undefined) {
                    num += 1;
                    console.log(num);
                    if (checkChild(num, getChild[1])) {
                        console.log("This " + i);
                        var splitAgain3 = line[i].split(":");
                        if (splitAgain3[1].includes("{")) {
                            console.log("Contains");
                            for (var ff = i; ff < line.length - 1; ff++) {
                                console.log("FF : " + ff);
                                if (line[ff].includes("}")) {
                                    break;
                                } else {
                                    var getChildArrowDouble = getChildArrow.split("=>");
                                    if (line[ff].includes(getChildArrowDouble[0])) {

                                        var splitedDoubleDott = line[ff].split(":");
                                        var splitDoubleDont = splitedDoubleDott[1].split("\"");
                                        if (splitDoubleDont[1] != undefined) {
                                            document.write("<h1>" + splitDoubleDont[1] + "</h1>");
                                        } else {
                                            var splitDoubleDont2 = splitedDoubleDott[1].split(",");
                                            document.write("<h1>" + splitDoubleDont2[0] + "</h1>");
                                        }
                                        break;
                                    }
                                }
                            }
                        }
                    }
                } else {
                    var splitAgain3 = line[i].split(":");
                    if (splitAgain3[1].includes("{")) {
                        for (var d = i; d < line.length; d++) {
                            if (line[d].includes("}")) {
                                break;
                            } else {
                                if (line[d].includes(getChildArrow)) {
                                    var splitedDoubleDott = line[d].split(":");
                                    var splitDoubleDont = splitedDoubleDott[1].split("\"");
                                    if (splitDoubleDont[1] != undefined) {
                                        document.write("<h1>" + splitDoubleDont[1] + "</h1>");
                                    } else {
                                        var splitDoubleDont2 = splitedDoubleDott[1].split(",");
                                        document.write("<h1>" + splitDoubleDont2[0] + "</h1>");
                                    }
                                }
                            }
                        }
                    }
                }


            }

        }
    } else {
        var num = 0;

        var line = fileInput.split('\n');
        for (var s = 0; s <= line.length - 1; s++) {
            if (line[s].includes(getChild[0])) {
                num++;
                if (getChild[1] == "last") {

                } else if (checkChild(num, getChild[1])) {
                    var splitedDoubleDott = line[s].split(":");
                    var splitDoubleDont = splitedDoubleDott[1].split("\"");
                    if (splitDoubleDont[1] != undefined) {
                        document.write("<h1>" + splitDoubleDont[1] + "</h1>");
                    } else {
                        var splitDoubleDont2 = splitedDoubleDott[1].split(",");
                        document.write("<h1>" + splitDoubleDont2[0] + "</h1>");
                    }


                }
            }

        }
        checklast(num, child, fileInput);
    }
}

var Json = function (file) {
    this.file = file;
};



Json.prototype.readJSONFile = function (part) {
    var fileInput;
    var getNum = part.split("->");
    var setNum;
    var rawFile = new XMLHttpRequest();
    rawFile.open("GET", this.file, false);
    rawFile.onreadystatechange = function () {
        if (rawFile.readyState === 4) {
            if (rawFile.status === 200 || rawFile.status == 0) {
                fileInput = rawFile.responseText;
                splitReq(fileInput, getNum[0], part);
            }
        }
    }
    rawFile.send(null);
}




//--------------------------------------------------------------------------------------write in JSON File-------------------//


/**
 * Bibliothek um Datein Dynamisch mit JavaScript zu includieren 
 */




var LoadFile = function () { }

LoadFile.prototype.createTag = function (tag, type, srcEnd, before, place) {
    var createTags = document.createElement(tag);
    var placeAdd = document.querySelectorAll(place)[this.numElem];

    createTags.setAttribute(type, this.src);

    if (srcEnd == "css") {
        createTags.setAttribute("rel", "stylesheet");
    }

    if (before) {
        placeAdd.insertBefore(createTags, placeAdd.childNodes[0]);

    } else {
        placeAdd.append(createTags);
    }
    this.src = "";

}
LoadFile.prototype.check = function (tag, type) {
    var allTag = document.querySelectorAll(tag);
    var count = 0;

    for (var s = 0; s <= allTag.length - 1; s++) {
        var tagAttr = allTag[s].getAttribute(type);

        if (tagAttr == this.src) {
            count++;
        }

    }

    if (count >= 1) {
        return false;
        count = 0;
    } else {
        return true;
    }

}

/**
 * src = Dateipfad welches includiert wird
 * place = HTML Element wo das link oder script Tag hinzugefügt wird
 * before = Ob das zu includierende Element 
 */
LoadFile.prototype.addTag = function (src, place, before = false, numElem = 0) {
    if (!Array.isArray(src)) {
        var src = src.split(" ");
    }
    for (var i = 0; i < src.length; i++) {

        this.numElem = numElem;
        this.src = src[i];
        var tag, type;
        var splitSrc = this.src.split(".");
        if (splitSrc[splitSrc.length - 1] == "css") {
            tag = "link"; type = "href"; srcEnd = "css";
        } else if (splitSrc[splitSrc.length - 1] == "js") {
            tag = "script"; type = "src"; srcEnd = "js";
        }
        splitSrc = "";
        if (this.check(tag, type)) {
            this.createTag(tag, type, srcEnd, before, place);

        }

    }// End of for

}// End of addTag

elem = new LoadFile();

//------------------------------------------------------------------------------------------------------------------------------------------
