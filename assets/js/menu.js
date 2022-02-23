function addMenuItem(dataPath, url, text) {
    var node6 = document.createTextNode(text);
    var node5 = document.createElement("a");
    node5.setAttribute("href", "#");
    node5.setAttribute("target", "_self");
    node5.setAttribute("class", "ui-corner-all");
    node5.appendChild(node6);

    var node = document.createElement("li");
    node.setAttribute("class", "ui-igtree-node ui-igtree-parentnode ui-draggable");
    node.setAttribute("data-path", dataPath);

    node.setAttribute("data-value", "Folder");
    node.setAttribute("data-role", "node");
    //node.appendChild(node2);
    //node.appendChild(node3);
    var node6 = document.createElement("img");
    node6.setAttribute("src",url);
    node6.setAttribute("data-role","node-image");
    node.appendChild(node6);
    node.appendChild(node5);
 $(".ui-igtree-root > li > ul").append(node);
}
var head = [{
    Text: "Homeage",
    ImageUrl: "assets/images/server.png",
    Value: "Folder",
    Folder: []
}];
var nav = {
    ul: {
        class: "main-navigation",
        children:{}
    }
};


function underUnder(splitedItem, item2, num,url) {

    var realLength = parseInt(splitedItem.length) - parseInt(1);
    if (realLength == 2) {
        head[0].Folder[splitedItem[1]].Folder.push({
            Text: item2,
            ImageUrl:url,
            Value: "Folder",
            Folder: []
        });
        elem = "li" + splitedItem[1];
        Object.assign(nav.ul.children["li" + splitedItem[1]].children.ul.children, {
            ["li" + splitedItem[2]]: {
                children: {
                    a: {
                        href: url,
                        innerHTML: item2
                    },
                    ul: {
                        children: {}
                    }
                }
            }
        })

    } else if (realLength == 3) {
        head[0].Folder[splitedItem[1]].Folder[splitedItem[2]].Folder.push({
            Text: item2,
            ImageUrl:url,
            Value: "Folder",
            Folder: []
        });
        Object.assign(nav.ul.children["li" + splitedItem[1]].children.ul.children["li" + splitedItem[2]].children.ul.children, {
            ["li" + splitedItem[3]]: {
                children: {
                    a: {
                        href: url,
                        innerHTML: item2
                    },
                    ul: {
                        children: {}
                    }
                }
            }
        })
    } else if (realLength == 4) {
        head[0].Folder[splitedItem[1]].Folder[splitedItem[2]].Folder[splitedItem[3]].Folder.push({
            Text: item2,
            ImageUrl:url,
            Value: "Folder",
            Folder: []
        });
        Object.assign(nav.ul.children["li" + splitedItem[1]].children.ul.children["li" + splitedItem[2]].children.ul.children["li" + splitedItem[3]].children.ul.children, {
            ["li" + splitedItem[4]]: {
                children: {
                    a: {
                        href: url,
                        innerHTML: item2
                    },
                    ul: {
                        children: {}
                    }
                }
            }
        })
    } else if (realLength == 5) {
        head[0].Folder[splitedItem[1]].Folder[splitedItem[2]].Folder[splitedItem[3]].Folder[splitedItem[4]].Folder.push({
            Text: item2,
            ImageUrl:url,
            Value: "Folder",
            Folder: []
        });
        Object.assign(nav.ul.children["li" + splitedItem[1]].children.ul.children["li" + splitedItem[2]].children.ul.children["li" + splitedItem[3]].children.ul.children["li" + splitedItem[4]].children.ul.children, {
            ["li" + splitedItem[5]]: {
                children: {
                    a: {
                        href: url,
                        innerHTML: item2
                    },
                    ul: {
                        children: {}
                    }
                }
            }
        })
    } else if (realLength == 6) {
        head[0].Folder[splitedItem[1]].Folder[splitedItem[2]].Folder[splitedItem[3]].Folder[splitedItem[4]].Folder[splitedItem[5]].Folder.push({
            Text: item2,
            ImageUrl:url,
            Value: "Folder",
            Folder: []
        });
        Object.assign(nav.ul.children["li" + splitedItem[1]].children.ul.children["li" + splitedItem[2]].children.ul.children["li" + splitedItem[3]].children.ul.children["li" + splitedItem[4]].children.ul.children["li" + splitedItem[5]].children.ul.children, {
            ["li" + splitedItem[6]]: {
                children: {
                    a: {
                        href: url,
                        innerHTML: item2
                    },
                    ul: {
                        children: {}
                    }
                }
            }
        })


    } else if (realLength == 7) {
        head[0].Folder[splitedItem[1]].Folder[splitedItem[2]].Folder[splitedItem[3]].Folder[splitedItem[4]].Folder[splitedItem[5]].Folder[splitedItem[6]].Folder.push({
            Text: item2,
            ImageUrl:url,
            Value: "Folder",
            Folder: []
        });
        Object.assign(nav.ul.children["li" + splitedItem[1]].children.ul.children["li" + splitedItem[2]].children.ul.children["li" + splitedItem[3]].children.ul.children["li" + splitedItem[4]].children.ul.children["li" + splitedItem[5]].children.ul.children["li" + splitedItem[6]].children.ul.children, {
            ["li" + splitedItem[7]]: {
                children: {
                    a: {
                        href:url,
                        innerHTML: item2
                    },
                    ul: {
                        children: {}
                    }
                }
            }
        })

    } else if (realLength == 8) {
        head[0].Folder[splitedItem[1]].Folder[splitedItem[2]].Folder[splitedItem[3]].Folder[splitedItem[4]].Folder[splitedItem[5]].Folder[splitedItem[6]].Folder[splitedItem[7]].Folder.push({
            Text: item2,
            ImageUrl:url,
            Value: "Folder",
            Folder: []
        });
        Object.assign(nav.ul.children["li" + splitedItem[1]].children.ul.children["li" + splitedItem[2]].children.ul.children["li" + splitedItem[3]].children.ul.children["li" + splitedItem[4]].children.ul.children["li" + splitedItem[5]].children.ul.children["li" + splitedItem[6]].children.ul.children["li" + splitedItem[7]].children.ul.children, {
            ["li" + splitedItem[8]]: {
                children: {
                    a: {
                        href: url,
                        innerHTML: item2
                    },
                    ul: {
                        children: {}
                    }
                }
            }
        })


    } else if (realLength == 9) {
        head[0].Folder[splitedItem[1]].Folder[splitedItem[2]].Folder[splitedItem[3]].Folder[splitedItem[4]].Folder[splitedItem[5]].Folder[splitedItem[6]].Folder[splitedItem[7]].Folder[splitedItem[8]].Folder.push({
            Text: item2,
            ImageUrl:url,
            Value: "Folder",
            Folder: []
        });

        Object.assign(nav.ul.children["li" + splitedItem[1]].children.ul.children["li" + splitedItem[2]].children.ul.children["li" + splitedItem[3]].children.ul.children["li" + splitedItem[4]].children.ul.children["li" + splitedItem[5]].children.ul.children["li" + splitedItem[6]].children.ul.children["li" + splitedItem[7]].children.ul.children["li" + splitedItem[8]].children.ul.children, {
            ["li" + splitedItem[9]]: {
                children: {
                    a: {
                        href:url,
                        innerHTML: item2
                    },
                    ul: {
                        children: {}
                    }
                }
            }
        })
    } else if (realLength == 10) {
        head[0].Folder[splitedItem[1]].Folder[splitedItem[2]].Folder[splitedItem[3]].Folder[splitedItem[4]].Folder[splitedItem[5]].Folder[splitedItem[6]].Folder[splitedItem[7]].Folder[splitedItem[8]].Folder[splitedItem[9]].Folder.push({
            Text: item2,
            ImageUrl:url,
            Value: "Folder",
            Folder: []
        });

        Object.assign(nav.ul.children["li" + splitedItem[1]].children.ul.children["li" + splitedItem[2]].children.ul.children["li" + splitedItem[3]].children.ul.children["li" + splitedItem[4]].children.ul.children["li" + splitedItem[5]].children.ul.children["li" + splitedItem[6]].children.ul.children["li" + splitedItem[7]].children.ul.children["li" + splitedItem[8]].children.ul.children["li" + splitedItem[9]].children.ul.children, {
            ["li" + splitedItem[10]]: {
                children: {
                    a: {
                        href:url,
                        innerHTML: item2
                    },
                    ul: {
                        children: {}
                    }
                }
            }
        })

    } else if (realLength == 11) {
        head[0].Folder[splitedItem[1]].Folder[splitedItem[2]].Folder[splitedItem[3]].Folder[splitedItem[4]].Folder[splitedItem[5]].Folder[splitedItem[6]].Folder[splitedItem[7]].Folder[splitedItem[8]].Folder[splitedItem[9]].Folder[splitedItem[10]].Folder.push({
            Text: item2,
            ImageUrl:url,
            Value: "Folder",
            Folder: []
        });

        Object.assign(nav.ul.children["li" + splitedItem[1]].children.ul.children["li" + splitedItem[2]].children.ul.children["li" + splitedItem[3]].children.ul.children["li" + splitedItem[4]].children.ul.children["li" + splitedItem[5]].children.ul.children["li" + splitedItem[6]].children.ul.children["li" + splitedItem[7]].children.ul.children["li" + splitedItem[8]].children.ul.children["li" + splitedItem[9]].children.ul.children["li" + splitedItem[10]].children.ul.children, {
            ["li" + splitedItem[11]]: {
                children: {
                    a: {
                        href: url,
                        innerHTML: item2
                    },
                    ul: {
                        children: {}
                    }
                }
            }
        })

    } else if (realLength == 12) {
        head[0].Folder[splitedItem[1]].Folder[splitedItem[2]].Folder[splitedItem[3]].Folder[splitedItem[4]].Folder[splitedItem[5]].Folder[splitedItem[6]].Folder[splitedItem[7]].Folder[splitedItem[8]].Folder[splitedItem[9]].Folder[splitedItem[10]].Folder[splitedItem[11]].Folder.push({
            Text: item2,
            ImageUrl:url,
            Value: "Folder",
            Folder: []
        });

        Object.assign(nav.ul.children["li" + splitedItem[1]].children.ul.children["li" + splitedItem[2]].children.ul.children["li" + splitedItem[3]].children.ul.children["li" + splitedItem[4]].children.ul.children["li" + splitedItem[5]].children.ul.children["li" + splitedItem[6]].children.ul.children["li" + splitedItem[7]].children.ul.children["li" + splitedItem[8]].children.ul.children["li" + splitedItem[9]].children.ul.children["li" + splitedItem[10]].children.ul.children["li" + splitedItem[11]].children.ul.children, {
            ["li" + splitedItem[11]]: {
                children: {
                    a: {
                        href: url,
                        innerHTML: item2
                    },
                    ul: {
                        children: {}
                    }
                }
            }
        })
    }


}



function showTreeSec(heads) {

    $(".secondTree").igTree({
        // checkboxMode: 'triState',
        singleBranchExpand: false,
        dataSource: $.extend(true, [], heads),
        dataSourceType: 'json',
        initialExpandDepth: 100,
        pathSeparator: '.',
        bindings: {
            textKey: 'Text',
            valueKey: 'Value',
            imageUrlKey: 'ImageUrl',
            hrefUrlKey: "Href",
            childDataProperty: 'Folder'
        },
        dragAndDrop: true,
        dragAndDropSettings: {
            allowDrop: true,
            customDropValidation: function (element) {
                // Validates the drop target
                var valid = true,
                    droppableNode = $(this);

                if (droppableNode.is('a') && droppableNode.closest('li[data-role=node]').attr('data-value') === 'File') {
                    valid = false;
                }

                return valid;
            }
        }
    });

}



function showTreeFir(array) {

    $(".firstTree").igTree({
        //  checkboxMode: 'triState',
        singleBranchExpand: false,
        dataSource: $.extend(true, [], array),
        dataSourceType: 'json',
        initialExpandDepth: 100,
        pathSeparator: '.',
        bindings: {
            textKey: 'Text',
            valueKey: 'Value',
            imageUrlKey: 'ImageUrl',
            linkKey: "href",
            childDataProperty: 'Folder'
        },
        dragAndDrop: true,
        dragAndDropSettings: {
            allowDrop: true,
            customDropValidation: function (element) {
                // Validates the drop target
                var valid = true,
                    droppableNode = $(this);

                if (droppableNode.is('a') && droppableNode.closest('li[data-role=node]').attr('data-value') === 'File') {
                    valid = false;
                }

                return valid;
            }
        }
    });
}


$(document).ready(function () {




}) //end onload