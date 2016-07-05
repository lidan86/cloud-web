///*
// * Author: Abdullah A Almsaeed
// * Date: 4 Jan 2014
// * Description:
// *      This is a demo file used only for the main dashboard (index.html)
// **/
// 
// // Dummy Data for capacity network
//var networkData = {
//    "error_id": 0,
//    "error_message": "No Error",
//    "error_name": "OK",
//    "results": {
//        "nodes": [
//            {"color": "FFE81C", "id": 31, "name": "BTS"},
//            {"color": "FFFFFF", "id": 41, "name": "M/W HUB Node"},
//            {"color": "FFFFFF", "id": 43, "name": "MSTP MPLS BH"},
//            {"color": "FFFFFF", "id": 44, "name": "PE MPLS BH"},
//            {"color": "FFFFFF", "id": 45, "name": "Ran Router"},
//            {"color": "FFFFFF", "id": 46, "name": "BSC"},
//            {"color": "A6CCFF", "id": 42, "name": "HUT MSTP Node"},
//            {"color": "FCFF9C", "id": 47, "name": "PE MPLS BB"}
//        ], 
//        
//        "links": [
//            {"source": {"name": "BTS"}, "target": {"name": "M/W HUB Node"}},
//            {"source": {"name": "M/W HUB Node"}, "target": {"name": "HUT MSTP Node"}},
//            {"source": {"name": "HUT MSTP Node"}, "target": {"name": "MSTP MPLS BH"}},
//            {"source": {"name": "MSTP MPLS BH"}, "target": {"name": "PE MPLS BH"}},
//            {"source": {"name": "PE MPLS BH"}, "target": {"name": "Ran Router"}},
//            {"source": {"name": "MSTP MPLS BH"}, "target": {"name": "BSC"}},
//            {"source": {"name": "Ran Router"}, "target": {"name": "PE MPLS BB"}},
//            {"source": {"name": "Ran Router"}, "target": {"name": "BSC"}}
//        ]
//    }
//};
//
//(function ($) {
//    function makeLink(parentElementLabel, childElementLabel) {
//        return new joint.dia.Link({
//            source: { id: parentElementLabel },
//            target: { id: childElementLabel },
//            attrs: {'.marker-target': { d: 'M 4 0 L 0 2 L 4 4 z' },
//                '.marker-arrowheads': { display: 'none' },
//                '.link-tools': { display: 'none' }}
//        });
//    }
//
//    function makeElement(node) {
//        // console.log(node);
//        var label = node['name'];
//        var color = '#' + node['color'];
//        var maxLineLength = _.max(label.split('\n'),
//            function (l) {
//                return l.length;
//            }).length;
//
//        var letterSize = 12;
//        var width = 2 * (letterSize * (0.6 * maxLineLength + 1));
//        return new joint.shapes.basic.Rect({
//            id: label,
//            size: { width: width, height: 50 },
//            attrs: {
//                text: { text: label,
//                    'font-size': letterSize,
//                    'font-family': 'monospace'},
//                rect: {
//                    width: width,
//                    height: 50,
//                    rx: 5,
//                    ry: 5,
//                    stroke: '#555',
//                    fill: color
//                }
//            }
//        });
//    }
//
//    function buildGraphFromData(data) {
//        var elements = [];
//        var links = [];
//        for (var i = 0; i < data["nodes"].length; i++) {
//            elements.push(makeElement(data["nodes"][i]));
//        }
//
//        for (var i = 0; i < data["links"].length; i++) {
//            links.push(makeLink(data["links"][i]["source"]["name"],
//                data["links"][i]["target"]["name"]));
//        }
//        return elements.concat(links);
//    }
//
//    $.fn.capNetwork = function(data) {
//        var results = data["results"];
//
//        // Set this css
//        this.css({
//            position: "relative",
//            minHeight: "100px",
//            maxHeight: "410px"
//        })
//
//        // Create paper div
//        var paperEl = $("<div></div>");
//        paperEl.css({
//            height: "410px",
//            overflow: "scroll",
//            margin: "0 auto"
//        });
//        this.append(paperEl);
//
//        var graph = new joint.dia.Graph;
//
//        var paper = new joint.dia.Paper({
//            el: paperEl,
//            width: 1700,
//            height: 400,
//            gridSize: 1,
//            model: graph,
//            perpendicularLinks: true
//        });
//
//        var scaleFactor = 1.0;
//        paper.scale(scaleFactor, scaleFactor);
//        V(paper.viewport).translate(50, 150);
//    
//        // Create cells for the graph
//        var cells = buildGraphFromData(results);
//        graph.resetCells(cells);
//
//        // Layout graph using dagre
//        joint.layout.DirectedGraph.layout(graph,
//            {setLinkVertices: true,
//                rankDir: "LR"});
//
//
//        // Paper onclick
//        paper.on("cell:pointerdblclick", function (cell, e, x, y) {
//            // alert(cell.model.id + ' was clicked');
//
//            $("#graph-modal .modal-title").text(cell.model.id);
//            $("#graph-modal").modal();
//        });
//
//
//
//        // Create zoom-in button
//        var zoomInButton = $("<div></div>");
//        zoomInButton.css({
//            position: "absolute",
//            top: "10px",
//            left: "10px"
//        });
//        zoomInButton.append(
//            $("<button id='zoom-in' class='btn btn-default'>\
//                    <span class='glyphicon glyphicon-zoom-in'></span>\
//               </button>"));
//        this.append(zoomInButton);
//
//        // Zoom-in button clicked
//        $(zoomInButton).click(function () {
//            if (scaleFactor < 1.0)
//                scaleFactor += 0.1;
//            paper.scale(scaleFactor, scaleFactor);
//            V(paper.viewport).translate(50, 200);
//        });
//
//
//
//        // Create zoom-out button
//        var zoomOutButton = $("<div></div>");
//        zoomOutButton.css({
//            position: "absolute",
//            top: "10px",
//            left: "60px"
//        });
//        zoomOutButton.append(
//            $("<button id='zoom-out' class='btn btn-default'>\
//                    <span class='glyphicon glyphicon-zoom-out'></span>\
//               </button>"));
//        this.append(zoomOutButton);
//
//        // Zoom-out button clicked
//        $(zoomOutButton).click(function () {
//            if (scaleFactor > 0.2)
//                scaleFactor -= 0.1;
//            paper.scale(scaleFactor, scaleFactor);
//            V(paper.viewport).translate(50, 150);
//        });
//
//
//
//        // Create auto-layout button
//        var autoLayoutButton = $("<div></div>");
//        autoLayoutButton.css({
//            position: "absolute",
//            top: "10px",
//            left: "110px"
//        });
//        autoLayoutButton.append(
//            $("<button id='auto-layout' class='btn btn-default'>\
//                    <span class='glyphicon glyphicon-th-large'></span>\
//               </button>"));
//        this.append(autoLayoutButton);
//
//        // AutoLayout button clicked
//        $(autoLayoutButton).click(function () {
//            joint.layout.DirectedGraph.layout(graph,
//                {setLinkVertices: false,
//                    rankDir: "LR"});
//        });
//
//        return this;
//    }
//}(jQuery));
//
//$(function() {
//    "use strict";
//	
//	$("#cap-network").capNetwork(networkData);
//});