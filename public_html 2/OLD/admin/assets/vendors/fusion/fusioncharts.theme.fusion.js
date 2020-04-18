(function(factory) {
    if (typeof module === "object" && typeof module.exports !== "undefined") {
        module.exports = factory
    } else {
        factory(FusionCharts)
    }
})(function(FusionCharts) {
    (function(modules) {
        var installedModules = {};

        function __webpack_require__(moduleId) {
            if (installedModules[moduleId]) {
                return installedModules[moduleId].exports
            }
            var module = installedModules[moduleId] = {
                i: moduleId,
                l: false,
                exports: {}
            };
            modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
            module.l = true;
            return module.exports
        }
        __webpack_require__.m = modules;
        __webpack_require__.c = installedModules;
        __webpack_require__.d = function(exports, name, getter) {
            if (!__webpack_require__.o(exports, name)) {
                Object.defineProperty(exports, name, {
                    configurable: false,
                    enumerable: true,
                    get: getter
                })
            }
        };
        __webpack_require__.n = function(module) {
            var getter = module && module.__esModule ? function getDefault() {
                return module["default"]
            } : function getModuleExports() {
                return module
            };
            __webpack_require__.d(getter, "a", getter);
            return getter
        };
        __webpack_require__.o = function(object, property) {
            return Object.prototype.hasOwnProperty.call(object, property)
        };
        __webpack_require__.p = "";
        return __webpack_require__(__webpack_require__.s = 13)
    })([function(module, exports) {
        module.exports = function(useSourceMap) {
            var list = [];
            list.toString = function toString() {
                return this.map(function(item) {
                    var content = cssWithMappingToString(item, useSourceMap);
                    if (item[2]) {
                        return "@media " + item[2] + "{" + content + "}"
                    } else {
                        return content
                    }
                }).join("")
            };
            list.i = function(modules, mediaQuery) {
                if (typeof modules === "string") modules = [
                    [null, modules, ""]
                ];
                var alreadyImportedModules = {};
                for (var i = 0; i < this.length; i++) {
                    var id = this[i][0];
                    if (typeof id === "number") alreadyImportedModules[id] = true
                }
                for (i = 0; i < modules.length; i++) {
                    var item = modules[i];
                    if (typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
                        if (mediaQuery && !item[2]) {
                            item[2] = mediaQuery
                        } else if (mediaQuery) {
                            item[2] = "(" + item[2] + ") and (" + mediaQuery + ")"
                        }
                        list.push(item)
                    }
                }
            };
            return list
        };

        function cssWithMappingToString(item, useSourceMap) {
            var content = item[1] || "";
            var cssMapping = item[3];
            if (!cssMapping) {
                return content
            }
            if (useSourceMap && typeof btoa === "function") {
                var sourceMapping = toComment(cssMapping);
                var sourceURLs = cssMapping.sources.map(function(source) {
                    return "/*# sourceURL=" + cssMapping.sourceRoot + source + " */"
                });
                return [content].concat(sourceURLs).concat([sourceMapping]).join("\n")
            }
            return [content].join("\n")
        }

        function toComment(sourceMap) {
            var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
            var data = "sourceMappingURL=data:application/json;charset=utf-8;base64," + base64;
            return "/*# " + data + " */"
        }
    }, function(module, exports, __webpack_require__) {
        var stylesInDom = {};
        var memoize = function(fn) {
            var memo;
            return function() {
                if (typeof memo === "undefined") memo = fn.apply(this, arguments);
                return memo
            }
        };
        var isOldIE = memoize(function() {
            return window && document && document.all && !window.atob
        });
        var getTarget = function(target) {
            return document.querySelector(target)
        };
        var getElement = function(fn) {
            var memo = {};
            return function(target) {
                if (typeof target === "function") {
                    return target()
                }
                if (typeof memo[target] === "undefined") {
                    var styleTarget = getTarget.call(this, target);
                    if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {
                        try {
                            styleTarget = styleTarget.contentDocument.head
                        } catch (e) {
                            styleTarget = null
                        }
                    }
                    memo[target] = styleTarget
                }
                return memo[target]
            }
        }();
        var singleton = null;
        var singletonCounter = 0;
        var stylesInsertedAtTop = [];
        var fixUrls = __webpack_require__(2);
        module.exports = function(list, options) {
            if (typeof DEBUG !== "undefined" && DEBUG) {
                if (typeof document !== "object") throw new Error("The style-loader cannot be used in a non-browser environment")
            }
            options = options || {};
            options.attrs = typeof options.attrs === "object" ? options.attrs : {};
            if (!options.singleton && typeof options.singleton !== "boolean") options.singleton = isOldIE();
            if (!options.insertInto) options.insertInto = "head";
            if (!options.insertAt) options.insertAt = "bottom";
            var styles = listToStyles(list, options);
            addStylesToDom(styles, options);
            return function update(newList) {
                var mayRemove = [];
                for (var i = 0; i < styles.length; i++) {
                    var item = styles[i];
                    var domStyle = stylesInDom[item.id];
                    domStyle.refs--;
                    mayRemove.push(domStyle)
                }
                if (newList) {
                    var newStyles = listToStyles(newList, options);
                    addStylesToDom(newStyles, options)
                }
                for (var i = 0; i < mayRemove.length; i++) {
                    var domStyle = mayRemove[i];
                    if (domStyle.refs === 0) {
                        for (var j = 0; j < domStyle.parts.length; j++) domStyle.parts[j]();
                        delete stylesInDom[domStyle.id]
                    }
                }
            }
        };

        function addStylesToDom(styles, options) {
            for (var i = 0; i < styles.length; i++) {
                var item = styles[i];
                var domStyle = stylesInDom[item.id];
                if (domStyle) {
                    domStyle.refs++;
                    for (var j = 0; j < domStyle.parts.length; j++) {
                        domStyle.parts[j](item.parts[j])
                    }
                    for (; j < item.parts.length; j++) {
                        domStyle.parts.push(addStyle(item.parts[j], options))
                    }
                } else {
                    var parts = [];
                    for (var j = 0; j < item.parts.length; j++) {
                        parts.push(addStyle(item.parts[j], options))
                    }
                    stylesInDom[item.id] = {
                        id: item.id,
                        refs: 1,
                        parts: parts
                    }
                }
            }
        }

        function listToStyles(list, options) {
            var styles = [];
            var newStyles = {};
            for (var i = 0; i < list.length; i++) {
                var item = list[i];
                var id = options.base ? item[0] + options.base : item[0];
                var css = item[1];
                var media = item[2];
                var sourceMap = item[3];
                var part = {
                    css: css,
                    media: media,
                    sourceMap: sourceMap
                };
                if (!newStyles[id]) styles.push(newStyles[id] = {
                    id: id,
                    parts: [part]
                });
                else newStyles[id].parts.push(part)
            }
            return styles
        }

        function insertStyleElement(options, style) {
            var target = getElement(options.insertInto);
            if (!target) {
                throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.")
            }
            var lastStyleElementInsertedAtTop = stylesInsertedAtTop[stylesInsertedAtTop.length - 1];
            if (options.insertAt === "top") {
                if (!lastStyleElementInsertedAtTop) {
                    target.insertBefore(style, target.firstChild)
                } else if (lastStyleElementInsertedAtTop.nextSibling) {
                    target.insertBefore(style, lastStyleElementInsertedAtTop.nextSibling)
                } else {
                    target.appendChild(style)
                }
                stylesInsertedAtTop.push(style)
            } else if (options.insertAt === "bottom") {
                target.appendChild(style)
            } else if (typeof options.insertAt === "object" && options.insertAt.before) {
                var nextSibling = getElement(options.insertInto + " " + options.insertAt.before);
                target.insertBefore(style, nextSibling)
            } else {
                throw new Error("[Style Loader]\n\n Invalid value for parameter 'insertAt' ('options.insertAt') found.\n Must be 'top', 'bottom', or Object.\n (https://github.com/webpack-contrib/style-loader#insertat)\n")
            }
        }

        function removeStyleElement(style) {
            if (style.parentNode === null) return false;
            style.parentNode.removeChild(style);
            var idx = stylesInsertedAtTop.indexOf(style);
            if (idx >= 0) {
                stylesInsertedAtTop.splice(idx, 1)
            }
        }

        function createStyleElement(options) {
            var style = document.createElement("style");
            if (options.attrs.type === undefined) {
                options.attrs.type = "text/css"
            }
            addAttrs(style, options.attrs);
            insertStyleElement(options, style);
            return style
        }

        function createLinkElement(options) {
            var link = document.createElement("link");
            if (options.attrs.type === undefined) {
                options.attrs.type = "text/css"
            }
            options.attrs.rel = "stylesheet";
            addAttrs(link, options.attrs);
            insertStyleElement(options, link);
            return link
        }

        function addAttrs(el, attrs) {
            Object.keys(attrs).forEach(function(key) {
                el.setAttribute(key, attrs[key])
            })
        }

        function addStyle(obj, options) {
            var style, update, remove, result;
            if (options.transform && obj.css) {
                result = options.transform(obj.css);
                if (result) {
                    obj.css = result
                } else {
                    return function() {}
                }
            }
            if (options.singleton) {
                var styleIndex = singletonCounter++;
                style = singleton || (singleton = createStyleElement(options));
                update = applyToSingletonTag.bind(null, style, styleIndex, false);
                remove = applyToSingletonTag.bind(null, style, styleIndex, true)
            } else if (obj.sourceMap && typeof URL === "function" && typeof URL.createObjectURL === "function" && typeof URL.revokeObjectURL === "function" && typeof Blob === "function" && typeof btoa === "function") {
                style = createLinkElement(options);
                update = updateLink.bind(null, style, options);
                remove = function() {
                    removeStyleElement(style);
                    if (style.href) URL.revokeObjectURL(style.href)
                }
            } else {
                style = createStyleElement(options);
                update = applyToTag.bind(null, style);
                remove = function() {
                    removeStyleElement(style)
                }
            }
            update(obj);
            return function updateStyle(newObj) {
                if (newObj) {
                    if (newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap) {
                        return
                    }
                    update(obj = newObj)
                } else {
                    remove()
                }
            }
        }
        var replaceText = function() {
            var textStore = [];
            return function(index, replacement) {
                textStore[index] = replacement;
                return textStore.filter(Boolean).join("\n")
            }
        }();

        function applyToSingletonTag(style, index, remove, obj) {
            var css = remove ? "" : obj.css;
            if (style.styleSheet) {
                style.styleSheet.cssText = replaceText(index, css)
            } else {
                var cssNode = document.createTextNode(css);
                var childNodes = style.childNodes;
                if (childNodes[index]) style.removeChild(childNodes[index]);
                if (childNodes.length) {
                    style.insertBefore(cssNode, childNodes[index])
                } else {
                    style.appendChild(cssNode)
                }
            }
        }

        function applyToTag(style, obj) {
            var css = obj.css;
            var media = obj.media;
            if (media) {
                style.setAttribute("media", media)
            }
            if (style.styleSheet) {
                style.styleSheet.cssText = css
            } else {
                while (style.firstChild) {
                    style.removeChild(style.firstChild)
                }
                style.appendChild(document.createTextNode(css))
            }
        }

        function updateLink(link, options, obj) {
            var css = obj.css;
            var sourceMap = obj.sourceMap;
            var autoFixUrls = options.convertToAbsoluteUrls === undefined && sourceMap;
            if (options.convertToAbsoluteUrls || autoFixUrls) {
                css = fixUrls(css)
            }
            if (sourceMap) {
                css += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + " */"
            }
            var blob = new Blob([css], {
                type: "text/css"
            });
            var oldSrc = link.href;
            link.href = URL.createObjectURL(blob);
            if (oldSrc) URL.revokeObjectURL(oldSrc)
        }
    }, function(module, exports) {
        module.exports = function(css) {
            var location = typeof window !== "undefined" && window.location;
            if (!location) {
                throw new Error("fixUrls requires window.location")
            }
            if (!css || typeof css !== "string") {
                return css
            }
            var baseUrl = location.protocol + "//" + location.host;
            var currentDir = baseUrl + location.pathname.replace(/\/[^\/]*$/, "/");
            var fixedCss = css.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi, function(fullMatch, origUrl) {
                var unquotedOrigUrl = origUrl.trim().replace(/^"(.*)"$/, function(o, $1) {
                    return $1
                }).replace(/^'(.*)'$/, function(o, $1) {
                    return $1
                });
                if (/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/|\s*$)/i.test(unquotedOrigUrl)) {
                    return fullMatch
                }
                var newUrl;
                if (unquotedOrigUrl.indexOf("//") === 0) {
                    newUrl = unquotedOrigUrl
                } else if (unquotedOrigUrl.indexOf("/") === 0) {
                    newUrl = baseUrl + unquotedOrigUrl
                } else {
                    newUrl = currentDir + unquotedOrigUrl.replace(/^\.\//, "")
                }
                return "url(" + JSON.stringify(newUrl) + ")"
            });
            return fixedCss
        }
    }, , , , , , , , , , , function(module, __webpack_exports__, __webpack_require__) {
        "use strict";
        Object.defineProperty(__webpack_exports__, "__esModule", {
            value: true
        });
        var __WEBPACK_IMPORTED_MODULE_0__src_fusion___ = __webpack_require__(14);
        FusionCharts.addDep(__WEBPACK_IMPORTED_MODULE_0__src_fusion___["a"])
    }, function(module, __webpack_exports__, __webpack_require__) {
        "use strict";
        var __WEBPACK_IMPORTED_MODULE_0__fusioncharts_theme_fusion_css__ = __webpack_require__(15);
        var __WEBPACK_IMPORTED_MODULE_0__fusioncharts_theme_fusion_css___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__fusioncharts_theme_fusion_css__);
        var themeObject = {
            name: "fusion",
            theme: {
                base: {
                    chart: {
                        paletteColors: "#5D62B5, #29C3BE, #F2726F, #f95676, #62B58F, #BC95DF, #67CDF2",
                        showShadow: "0",
                        showPlotBorder: "0",
                        usePlotGradientColor: "0",
                        showValues: "0",
                        bgColor: "#FFFFFF",
                        canvasBgAlpha: "0",
                        bgAlpha: "100",
                        showBorder: "0",
                        showCanvasBorder: "0",
                        showAlternateHGridColor: "0",
                        divLineColor: "#DFDFDF",
                        showXAxisLine: "0",
                        yAxisNamePadding: "15",
                        sYAxisNamePadding: "15",
                        xAxisNamePadding: "15",
                        captionPadding: "15",
                        xAxisNameFontColor: "#999",
                        yAxisNameFontColor: "#999",
                        sYAxisNameFontColor: "#999",
                        yAxisValuesPadding: "15",
                        labelPadding: "10",
                        transposeAxis: "1",
                        toolTipBgColor: "#FFFFFF",
                        toolTipPadding: "6",
                        toolTipBorderColor: "#E1E1E1",
                        toolTipBorderThickness: "1",
                        toolTipBorderAlpha: "100",
                        toolTipBorderRadius: "2",
                        baseFont: "Source Sans Pro",
                        baseFontColor: "#5A5A5A",
                        baseFontSize: "14",
                        xAxisNameFontBold: "0",
                        yAxisNameFontBold: "0",
                        sYAxisNameFontBold: "0",
                        xAxisNameFontSize: "15",
                        yAxisNameFontSize: "15",
                        sYAxisNameFontSize: "15",
                        captionFontSize: "18",
                        captionFontFamily: "Source Sans Pro SemiBold",
                        subCaptionFontSize: "13",
                        captionFontBold: "1",
                        subCaptionFontBold: "0",
                        subCaptionFontColor: "#999",
                        valueFontColor: "#000000",
                        valueFont: "Source Sans Pro",
                        drawCustomLegendIcon: "1",
                        legendShadow: "0",
                        legendBorderAlpha: "0",
                        legendBorderThickness: "0",
                        legendItemFont: "Source Sans Pro",
                        legendItemFontColor: "#7C7C7C",
                        legendIconBorderThickness: "0",
                        legendBgAlpha: "0",
                        legendItemFontSize: "15",
                        legendCaptionFontColor: "#999",
                        legendCaptionFontSize: "13",
                        legendCaptionFontBold: "0",
                        legendScrollBgColor: "#FFF",
                        crossLineAnimation: "1",
                        crossLineAlpha: "100",
                        showHoverEffect: "1",
                        plotHoverEffect: "1",
                        plotFillHoverAlpha: "90",
                        barHoverAlpha: "90"
                    }
                },
                column2d: {
                    chart: {
                        paletteColors: "#5D62B5",
                        placeValuesInside: "0"
                    }
                },
                column3d: {
                    chart: {
                        showCanvasBase: "0",
                        canvasBaseDepth: "0",
                        showShadow: "0",
                        chartTopMargin: "35",
                        paletteColors: "#5D62B5"
                    }
                },
                line: {
                    chart: {
                        lineThickness: "2",
                        paletteColors: "#5D62B5",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        drawCrossLine: "1"
                    }
                },
                area2d: {
                    chart: {
                        paletteColors: "#5D62B5",
                        drawCrossLine: "1"
                    }
                },
                bar2d: {
                    chart: {
                        placeValuesInside: "0",
                        showAlternateVGridColor: "0",
                        yAxisValuesPadding: "10",
                        paletteColors: "#5D62B5"
                    }
                },
                bar3d: {
                    chart: {
                        showCanvasBase: "0",
                        canvasBaseDepth: "0",
                        placeValuesInside: "0",
                        showShadow: "0",
                        chartTopMargin: "35",
                        adjustDiv: "1",
                        showAlternateVGridColor: "0",
                        yAxisValuesPadding: "10",
                        paletteColors: "#5D62B5"
                    }
                },
                pie2d: {
                    chart: {
                        use3DLighting: "0",
                        showPercentValues: "1",
                        showValues: "1",
                        showPercentInTooltip: "0",
                        useDataPlotColorForLabels: "0",
                        showLegend: "1",
                        legendIconSides: "2",
                        labelFontColor: "#666"
                    }
                },
                pie3d: {
                    chart: {
                        use3DLighting: "0",
                        showPercentValues: "1",
                        showValues: "1",
                        useDataPlotColorForLabels: "0",
                        showLegend: "1",
                        legendIconSides: "2",
                        pieSliceDepth: "15",
                        pieYScale: "60",
                        labelFontColor: "#666",
                        labelDistance: "20",
                        showPercentInTooltip: "0"
                    }
                },
                doughnut2d: {
                    chart: {
                        use3DLighting: "0",
                        showPercentValues: "1",
                        showValues: "1",
                        useDataPlotColorForLabels: "0",
                        showLegend: "1",
                        legendIconSides: "2",
                        showPlotBorder: "0",
                        labelFontColor: "#666",
                        centerLabelColor: "#666",
                        centerLabelFontSize: "14",
                        showPercentInTooltip: "0"
                    }
                },
                doughnut3d: {
                    chart: {
                        use3DLighting: "0",
                        showPercentValues: "1",
                        showValues: "1",
                        useDataPlotColorForLabels: "0",
                        showLegend: "1",
                        legendIconSides: "2",
                        pieSliceDepth: "15",
                        pieYScale: "60",
                        labelFontColor: "#666",
                        centerLabelColor: "#666",
                        centerLabelFontSize: "14",
                        showPercentInTooltip: "0"
                    }
                },
                pareto2d: {
                    chart: {
                        paletteColors: "#5D62B5",
                        lineThickness: "2",
                        anchorRadius: "4",
                        lineColor: "#5D5D5D",
                        anchorBgColor: "#5D5D5D",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                pareto3d: {
                    chart: {
                        paletteColors: "#5D62B5",
                        lineThickness: "2",
                        anchorRadius: "4",
                        lineColor: "#5D5D5D",
                        anchorBgColor: "#5D5D5D",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1",
                        showCanvasBase: "0",
                        canvasBaseDepth: "0",
                        placeValuesInside: "0",
                        showShadow: "0",
                        chartTopMargin: "35",
                        adjustDiv: "1",
                        showAlternateVGridColor: "0"
                    }
                },
                mscolumn2d: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "4"
                    }
                },
                mscolumn3d: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "4",
                        showCanvasBase: "0",
                        canvasBaseDepth: "0",
                        placeValuesInside: "0",
                        showShadow: "0",
                        chartTopMargin: "35",
                        adjustDiv: "1",
                        showAlternateVGridColor: "0"
                    }
                },
                msline: {
                    chart: {
                        lineThickness: "2",
                        anchorRadius: "4",
                        drawCrossLine: "1",
                        showLegend: "1",
                        legendIconSides: "2",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                msbar2d: {
                    chart: {
                        placeValuesInside: "0",
                        showAlternateVGridColor: "0",
                        showLegend: "1",
                        legendIconSides: "4",
                        yAxisValuesPadding: "10"
                    }
                },
                msbar3d: {
                    chart: {
                        showCanvasBase: "0",
                        canvasBaseDepth: "0",
                        placeValuesInside: "0",
                        showShadow: "0",
                        chartTopMargin: "35",
                        adjustDiv: "1",
                        showAlternateVGridColor: "0",
                        showLegend: "1",
                        legendIconSides: "4",
                        yAxisValuesPadding: "10"
                    }
                },
                msarea: {
                    chart: {
                        drawCrossLine: "1",
                        showLegend: "1",
                        legendIconSides: "4"
                    }
                },
                marimekko: {
                    chart: {
                        legendIconSides: "4",
                        valueBgColor: "#FFFFFF",
                        valueBgAlpha: "65"
                    }
                },
                zoomline: {
                    chart: {
                        lineThickness: "2",
                        flatScrollBars: "1",
                        scrollShowButtons: "0",
                        scrollColor: "#FFF",
                        scrollheight: "10",
                        crossLineThickness: "1",
                        crossLineColor: "#F2F2F2",
                        showLegend: "1",
                        legendIconSides: "2",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                zoomlinedy: {
                    chart: {
                        lineThickness: "2",
                        flatScrollBars: "1",
                        scrollShowButtons: "0",
                        scrollColor: "#FFF",
                        scrollheight: "10",
                        crossLineThickness: "1",
                        crossLineColor: "#F2F2F2",
                        showLegend: "1",
                        legendIconSides: "2",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                stackedcolumn2d: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "4"
                    }
                },
                stackedcolumn3d: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "4",
                        showCanvasBase: "0",
                        canvasBaseDepth: "0",
                        placeValuesInside: "0",
                        showShadow: "0",
                        chartTopMargin: "35",
                        adjustDiv: "1",
                        showAlternateVGridColor: "0"
                    }
                },
                stackedbar2d: {
                    chart: {
                        placeValuesInside: "0",
                        showAlternateVGridColor: "0",
                        legendIconSides: "4",
                        yAxisValuesPadding: "10"
                    }
                },
                stackedbar3d: {
                    chart: {
                        showCanvasBase: "0",
                        canvasBaseDepth: "0",
                        placeValuesInside: "0",
                        showShadow: "0",
                        chartTopMargin: "35",
                        adjustDiv: "1",
                        showAlternateVGridColor: "0",
                        showLegend: "1",
                        legendIconSides: "4",
                        yAxisValuesPadding: "10"
                    }
                },
                stackedarea2d: {
                    chart: {
                        drawCrossLine: "1",
                        showLegend: "1",
                        legendIconSides: "4"
                    }
                },
                msstackedcolumn2d: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "4"
                    }
                },
                mscombi2d: {
                    chart: {
                        lineThickness: "2",
                        anchorRadius: "4",
                        drawCrossLine: "1",
                        showLegend: "1",
                        drawCustomLegendIcon: "0",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                mscombi3d: {
                    chart: {
                        showCanvasBase: "0",
                        canvasBaseDepth: "0",
                        placeValuesInside: "0",
                        showShadow: "0",
                        chartTopMargin: "35",
                        adjustDiv: "1",
                        lineThickness: "2",
                        anchorRadius: "4",
                        showLegend: "1",
                        drawCustomLegendIcon: "0",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                mscolumnline3d: {
                    chart: {
                        showCanvasBase: "0",
                        canvasBaseDepth: "0",
                        placeValuesInside: "0",
                        showShadow: "0",
                        chartTopMargin: "35",
                        adjustDiv: "1",
                        lineThickness: "2",
                        anchorRadius: "4",
                        showLegend: "1",
                        drawCustomLegendIcon: "0",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                stackedcolumn2dline: {
                    chart: {
                        showLegend: "1",
                        drawCustomLegendIcon: "0",
                        lineThickness: "2",
                        anchorRadius: "4",
                        drawCrossLine: "1",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                stackedcolumn3dline: {
                    chart: {
                        showCanvasBase: "0",
                        canvasBaseDepth: "0",
                        placeValuesInside: "0",
                        showShadow: "0",
                        chartTopMargin: "35",
                        adjustDiv: "1",
                        lineThickness: "2",
                        anchorRadius: "4",
                        showLegend: "1",
                        drawCustomLegendIcon: "0",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                mscombidy2d: {
                    chart: {
                        lineThickness: "2",
                        anchorRadius: "4",
                        drawCrossLine: "1",
                        showLegend: "1",
                        drawCustomLegendIcon: "0",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                mscolumn3dlinedy: {
                    chart: {
                        showCanvasBase: "0",
                        canvasBaseDepth: "0",
                        placeValuesInside: "0",
                        showShadow: "0",
                        adjustDiv: "1",
                        lineThickness: "2",
                        anchorRadius: "4",
                        showLegend: "1",
                        drawCustomLegendIcon: "0",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                stackedcolumn3dlinedy: {
                    chart: {
                        showCanvasBase: "0",
                        canvasBaseDepth: "0",
                        showShadow: "0",
                        adjustDiv: "1",
                        lineThickness: "2",
                        anchorRadius: "4",
                        showLegend: "1",
                        drawCustomLegendIcon: "0",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                msstackedcolumn2dlinedy: {
                    chart: {
                        placeValuesInside: "0",
                        showShadow: "0",
                        adjustDiv: "1",
                        lineThickness: "2",
                        anchorRadius: "4",
                        showLegend: "1",
                        drawCustomLegendIcon: "0",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    },
                    lineset: [{
                        color: "#5D5D5D",
                        anchorBgColor: "#5D5D5D"
                    }]
                },
                scatter: {
                    chart: {
                        showCanvasBase: "0",
                        canvasBaseDepth: "0",
                        showShadow: "0",
                        adjustDiv: "1",
                        lineThickness: "2",
                        anchorRadius: "4",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverColor: "#AFAFAF",
                        anchorBorderHoverThickness: "1.5",
                        showLegend: "1",
                        drawCustomLegendIcon: "0"
                    }
                },
                zoomscatter: {
                    chart: {
                        showShadow: "0",
                        adjustDiv: "1",
                        lineThickness: "2",
                        anchorRadius: "4",
                        anchorBorderHoverColor: "#AFAFAF",
                        showLegend: "1",
                        drawCustomLegendIcon: "0"
                    }
                },
                bubble: {
                    chart: {
                        use3DLighting: "0",
                        showLegend: "1",
                        legendIconSides: "2",
                        plotFillAlpha: "80"
                    }
                },
                scrollcolumn2d: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "4",
                        showCanvasBase: "0",
                        canvasBaseDepth: "0",
                        showShadow: "0",
                        adjustDiv: "1",
                        flatScrollBars: "1",
                        scrollShowButtons: "0",
                        scrollheight: "10",
                        scrollColor: "#EBEBEB"
                    }
                },
                scrollline2d: {
                    chart: {
                        showShadow: "0",
                        adjustDiv: "1",
                        lineThickness: "2",
                        anchorRadius: "4",
                        showLegend: "1",
                        legendIconSides: "2",
                        flatScrollBars: "1",
                        scrollShowButtons: "0",
                        scrollheight: "10",
                        scrollColor: "#EBEBEB",
                        drawCrossLine: "1",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                scrollarea2d: {
                    chart: {
                        showShadow: "0",
                        adjustDiv: "1",
                        lineThickness: "2",
                        drawAnchors: "0",
                        showLegend: "1",
                        legendIconSides: "2",
                        flatScrollBars: "1",
                        scrollShowButtons: "0",
                        scrollheight: "10",
                        scrollColor: "#EBEBEB"
                    }
                },
                scrollstackedcolumn2d: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "4",
                        flatScrollBars: "1",
                        scrollShowButtons: "0",
                        scrollheight: "10",
                        scrollColor: "#EBEBEB"
                    }
                },
                scrollcombi2d: {
                    chart: {
                        lineThickness: "2",
                        anchorRadius: "4",
                        showLegend: "1",
                        flatScrollBars: "1",
                        scrollShowButtons: "0",
                        scrollheight: "10",
                        scrollColor: "#EBEBEB",
                        drawCustomLegendIcon: "0",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                scrollcombidy2d: {
                    chart: {
                        lineThickness: "2",
                        anchorRadius: "4",
                        showLegend: "1",
                        flatScrollBars: "1",
                        scrollShowButtons: "0",
                        scrollheight: "10",
                        scrollColor: "#EBEBEB",
                        drawCustomLegendIcon: "0",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                angulargauge: {
                    chart: {
                        setAdaptiveMin: "1",
                        adjustTM: "1",
                        tickvaluedistance: "10",
                        placeTicksInside: "0",
                        autoAlignTickValues: "1",
                        showGaugeBorder: "0",
                        minortmnumber: "0",
                        majorTMHeight: "8",
                        gaugeFillMix: "{light-0}",
                        pivotbgcolor: "#000000",
                        pivotfillmix: "0",
                        showpivotborder: "1",
                        pivotBorderColor: "#FFFFFF",
                        showValue: "0",
                        valueBelowPivot: "1"
                    },
                    dials: {
                        dial: [{
                            bgColor: "#000000",
                            borderThickness: "0"
                        }]
                    }
                },
                bulb: {
                    chart: {
                        is3D: "0",
                        placeValuesInside: "1",
                        valueFont: "Source Sans Pro"
                    }
                },
                cylinder: {
                    chart: {
                        cylRadius: "50",
                        cylYScale: "13"
                    }
                },
                hled: {
                    chart: {
                        ledGap: "0",
                        showGaugeBorder: "0",
                        setAdaptiveMin: "1",
                        adjustTM: "1",
                        placeTicksInside: "0",
                        autoAlignTickValues: "1",
                        minortmnumber: "0",
                        majorTMHeight: "8",
                        majorTMAlpha: "50"
                    }
                },
                hlineargauge: {
                    chart: {
                        showGaugeBorder: "0",
                        setAdaptiveMin: "1",
                        adjustTM: "1",
                        placeTicksInside: "0",
                        autoAlignTickValues: "1",
                        minorTMnumber: "0",
                        majorTMHeight: "8",
                        majorTMAlpha: "50",
                        gaugeFillMix: "{light-0}",
                        valueAbovePointer: "1"
                    }
                },
                thermometer: {
                    chart: {
                        use3DLighting: "0",
                        manageResize: "1",
                        autoScale: "1",
                        showGaugeBorder: "1",
                        gaugeBorderAlpha: "40",
                        placeTicksInside: "0",
                        autoAlignTickValues: "1",
                        minortmnumber: "0",
                        majorTMHeight: "8",
                        majorTMAlpha: "50"
                    }
                },
                vled: {
                    chart: {
                        ledGap: "0",
                        showGaugeBorder: "0",
                        setAdaptiveMin: "1",
                        adjustTM: "1",
                        placeTicksInside: "0",
                        autoAlignTickValues: "1",
                        minortmnumber: "0",
                        majorTMHeight: "8",
                        majorTMAlpha: "50"
                    }
                },
                realtimearea: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "2"
                    }
                },
                realtimecolumn: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "2"
                    }
                },
                realtimeline: {
                    chart: {
                        lineThickness: "2",
                        anchorRadius: "4",
                        showLegend: "1",
                        legendIconSides: "2",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                realtimestackedarea: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "2"
                    }
                },
                realtimestackedcolumn: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "4"
                    }
                },
                realtimelinedy: {
                    chart: {
                        lineThickness: "2",
                        anchorRadius: "4",
                        showLegend: "1",
                        legendIconSides: "2",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                sparkline: {
                    chart: {
                        plotFillColor: "#5D62B5",
                        anchorRadius: "4",
                        highColor: "#29C3BE",
                        lowColor: "#F2726F",
                        captionPosition: "top",
                        showOpenAnchor: "0",
                        showCloseAnchor: "0",
                        showOpenValue: "0",
                        showCloseValue: "0",
                        showHighLowValue: "0",
                        periodColor: "#F3F3F3"
                    }
                },
                sparkcolumn: {
                    chart: {
                        plotFillColor: "5D62B5",
                        highColor: "#29C3BE",
                        lowColor: "#F2726F",
                        captionPosition: "middle",
                        periodColor: "#F3F3F3"
                    }
                },
                sparkwinloss: {
                    chart: {
                        winColor: "#29C3BE",
                        lossColor: "#F2726F",
                        captionPosition: "middle",
                        drawColor: "#ffa341",
                        scoreLessColor: "#5D62B5",
                        periodColor: "#F3F3F3"
                    }
                },
                hbullet: {
                    chart: {
                        plotFillColor: "#5D5D5D",
                        colorRangeFillMix: "{light+0}",
                        tickValueDistance: "3",
                        tickMarkDistance: "3"
                    }
                },
                vbullet: {
                    chart: {
                        plotFillColor: "#5D5D5D",
                        colorRangeFillMix: "{light+0}",
                        tickValueDistance: "3",
                        tickMarkDistance: "3"
                    }
                },
                funnel: {
                    chart: {
                        is2D: "1",
                        smartLineThickness: "1",
                        smartLineColor: "#B1AFAF",
                        smartLineAlpha: "70",
                        streamlinedData: "1",
                        useSameSlantAngle: "1",
                        alignCaptionWithCanvas: "1"
                    }
                },
                pyramid: {
                    chart: {
                        is2D: "1",
                        smartLineThickness: "1",
                        smartLineColor: "#B1AFAF",
                        smartLineAlpha: "70",
                        streamlinedData: "1",
                        useSameSlantAngle: "1",
                        alignCaptionWithCanvas: "1",
                        use3dlighting: "0"
                    }
                },
                gantt: {
                    chart: {
                        taskBarFillMix: "{light+0}",
                        flatScrollBars: "1",
                        gridBorderAlpha: "100",
                        gridBorderColor: "#EAEAEA",
                        ganttLineColor: "#EAEAEA",
                        ganttLineAlpha: "100",
                        taskBarRoundRadius: "2",
                        showHoverEffect: "1",
                        plotHoverEffect: "1",
                        plotFillHoverAlpha: "50",
                        showCategoryHoverBand: "1",
                        categoryHoverBandAlpha: "50",
                        showGanttPaneVerticalHoverBand: "1",
                        showProcessHoverBand: "1",
                        processHoverBandAlpha: "50",
                        showGanttPaneHorizontalHoverBand: "1",
                        showConnectorHoverEffect: "1",
                        connectorHoverAlpha: "50",
                        showTaskHoverEffect: "1",
                        taskHoverFillAlpha: "50",
                        slackHoverFillAlpha: "50",
                        scrollShowButtons: "0",
                        drawCustomLegendIcon: "0",
                        legendShadow: "0",
                        legendBorderAlpha: "0",
                        legendBorderThickness: "0",
                        legendIconBorderThickness: "0",
                        legendBgAlpha: "0"
                    },
                    categories: [{
                        fontcolor: "#5D5D5D",
                        fontsize: "14",
                        bgcolor: "#F3F3F3",
                        hoverBandAlpha: "50",
                        showGanttPaneHoverBand: "1",
                        showHoverBand: "1",
                        category: [{
                            fontcolor: "#5D5D5D",
                            fontsize: "14",
                            bgcolor: "#F3F3F3"
                        }]
                    }],
                    tasks: {
                        showBorder: "0",
                        showHoverEffect: "0"
                    },
                    processes: {
                        fontcolor: "#5D5D5D",
                        isanimated: "0",
                        bgcolor: "#FFFFFF",
                        bgAlpha: "100",
                        headerbgcolor: "#F3F3F3",
                        headerfontcolor: "#5D5D5D",
                        showGanttPaneHoverBand: "1",
                        showHoverBand: "1"
                    },
                    text: {
                        fontcolor: "#5D5D5D",
                        bgcolor: "#FFFFFF"
                    },
                    datatable: {
                        fontcolor: "#5D5D5D",
                        bgcolor: "#FFFFFF",
                        bgAlpha: "100",
                        datacolumn: [{
                            bgcolor: "#FFFFFF"
                        }]
                    },
                    connectors: [{
                        hoverThickness: "1.5"
                    }],
                    milestones: {
                        milestone: [{
                            color: "#ffa341"
                        }]
                    }
                },
                logmscolumn2d: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "4"
                    }
                },
                logmsline: {
                    chart: {
                        lineThickness: "2",
                        anchorRadius: "4",
                        drawCrossLine: "1",
                        showLegend: "1",
                        legendIconSides: "2",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                spline: {
                    chart: {
                        lineThickness: "2",
                        paletteColors: "#5D62B5",
                        anchorBgColor: "#5D62B5",
                        anchorRadius: "4",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                splinearea: {
                    chart: {
                        paletteColors: "#5D62B5",
                        drawAnchors: "0"
                    }
                },
                msspline: {
                    chart: {
                        lineThickness: "2",
                        anchorRadius: "4",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1",
                        showLegend: "1",
                        legendIconSides: "2"
                    }
                },
                mssplinearea: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "2",
                        drawAnchors: "0"
                    }
                },
                errorbar2d: {
                    chart: {
                        legendIconSides: "4",
                        errorBarColor: "#5D5D5D",
                        errorBarThickness: "0.7",
                        errorBarAlpha: "80"
                    }
                },
                errorline: {
                    chart: {
                        lineThickness: "2",
                        anchorRadius: "4",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1",
                        showLegend: "1",
                        legendIconSides: "2",
                        errorBarColor: "#5D5D5D",
                        errorBarThickness: "0.7",
                        errorBarAlpha: "80"
                    }
                },
                errorscatter: {
                    chart: {
                        showShadow: "0",
                        adjustDiv: "1",
                        lineThickness: "2",
                        anchorRadius: "4",
                        showLegend: "1",
                        legendIconSides: "2",
                        errorBarColor: "#5D5D5D",
                        errorBarThickness: "0.7",
                        errorBarAlpha: "80",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1"
                    }
                },
                inversemsarea: {
                    chart: {
                        drawCrossLine: "1",
                        showLegend: "1",
                        legendIconSides: "2"
                    }
                },
                inversemscolumn2d: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "4"
                    }
                },
                inversemsline: {
                    chart: {
                        lineThickness: "2",
                        anchorRadius: "4",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1",
                        drawCrossLine: "1",
                        showLegend: "1",
                        legendIconSides: "2"
                    }
                },
                dragcolumn2d: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "4"
                    },
                    categories: [{
                        category: [{
                            fontItalic: "1"
                        }]
                    }],
                    dataset: [{
                        data: [{
                            allowDrag: "1",
                            alpha: "80"
                        }]
                    }]
                },
                dragline: {
                    chart: {
                        lineThickness: "2",
                        anchorRadius: "4",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverThickness: "1.5",
                        anchorBgHoverColor: "#FFFFFF",
                        legendIconBorderThickness: "1",
                        drawCrossLine: "1",
                        showLegend: "1",
                        legendIconSides: "2"
                    },
                    categories: [{
                        category: [{
                            fontItalic: "1"
                        }]
                    }],
                    dataset: [{
                        data: [{
                            allowDrag: "1",
                            alpha: "80",
                            dashed: "1"
                        }]
                    }]
                },
                dragarea: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "2",
                        drawAnchors: "0"
                    },
                    categories: [{
                        category: [{
                            fontItalic: "1"
                        }]
                    }],
                    dataset: [{
                        data: [{
                            allowDrag: "1",
                            alpha: "80",
                            dashed: "1"
                        }]
                    }]
                },
                treemap: {
                    chart: {
                        parentLabelLineHeight: "16",
                        baseFontSize: "14",
                        labelFontSize: "14",
                        showParent: "1",
                        showNavigationBar: "0",
                        plotBorderThickness: "0.5",
                        plotBorderColor: "#EAEAEA",
                        labelGlow: "1",
                        labelGlowIntensity: "100",
                        btnBackChartTooltext: "Back",
                        btnResetChartTooltext: "Home",
                        legendScaleLineThickness: "0",
                        legendaxisborderalpha: "0",
                        legendShadow: "0",
                        toolbarButtonScale: "1.55",
                        plotToolText: "$label, $dataValue, $sValue"
                    },
                    data: [{
                        fillColor: "#FAFAFA",
                        data: [{
                            fillColor: "#FAFAFA"
                        }]
                    }]
                },
                radar: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "2",
                        plotFillAlpha: "20",
                        drawAnchors: "0"
                    }
                },
                heatmap: {
                    chart: {
                        baseFontSize: "12",
                        labelFontSize: "12",
                        showPlotBorder: "1",
                        plotBorderAlpha: "100",
                        plotBorderThickness: "0.8",
                        plotBorderColor: "#ffffff",
                        tlFontColor: "#FDFDFD",
                        tlFontSize: "12",
                        trFontColor: "#FDFDFD",
                        trFontSize: "12",
                        blFontColor: "#FDFDFD",
                        blFontSize: "12",
                        brFontColor: "#FDFDFD",
                        brFontSize: "12",
                        captionPadding: "15",
                        legendScaleLineThickness: "0",
                        legendaxisborderalpha: "0",
                        legendShadow: "0"
                    },
                    colorrange: {
                        gradient: "1",
                        code: "#8D90CB"
                    }
                },
                boxandwhisker2d: {
                    chart: {
                        drawCustomLegendIcon: "0",
                        showLegend: "1",
                        showDetailedLegend: "1",
                        legendIconSides: "2",
                        showPlotBorder: "0",
                        upperBoxBorderAlpha: "0",
                        lowerBoxBorderAlpha: "0",
                        lowerQuartileAlpha: "0",
                        upperQuartileAlpha: "0",
                        upperWhiskerColor: "#5D5D5D",
                        upperWhiskerThickness: "0.7",
                        upperWhiskerAlpha: "80",
                        lowerWhiskerColor: "#5D5D5D",
                        lowerWhiskerThickness: "0.7",
                        lowerWhiskerAlpha: "80",
                        medianColor: "#5D5D5",
                        medianThickness: "0.7",
                        medianAlpha: "100",
                        outliericonshape: "spoke",
                        outliericonsides: "9",
                        meaniconcolor: "#5D5D5D",
                        meanIconShape: "spoke",
                        meaniconsides: "9",
                        meaniconradius: "5"
                    }
                },
                candlestick: {
                    chart: {
                        showShadow: "0",
                        showVPlotBorder: "0",
                        bearFillColor: "#F2726F",
                        bullFillColor: "#62B58F",
                        plotLineThickness: "0.3",
                        plotLineAlpha: "100",
                        divLineDashed: "0",
                        showDetailedLegend: "1",
                        legendIconSides: "2",
                        showHoverEffect: "1",
                        plotHoverEffect: "1",
                        showVolumeChart: "0",
                        trendLineColor: "#5D5D5D",
                        trendLineThickness: "1",
                        trendValueAlpha: "100",
                        rollOverBandAlpha: "100",
                        rollOverBandColor: "#F2F2F2"
                    },
                    categories: [{
                        verticalLineColor: "#5D5D5D",
                        verticalLineThickness: "1",
                        verticalLineAlpha: "35"
                    }]
                },
                dragnode: {
                    chart: {
                        use3DLighting: "0",
                        plotBorderThickness: "0",
                        plotBorderAlpha: "0",
                        showDetailedLegend: "1",
                        legendIconSides: "2"
                    },
                    dataset: [{
                        color: "#5D62B5"
                    }],
                    connectors: [{
                        connector: [{
                            color: "#29C3BE"
                        }]
                    }]
                },
                msstepline: {
                    chart: {
                        drawAnchors: "0",
                        lineThickness: "2",
                        drawCustomLegendIcon: "0"
                    }
                },
                multiaxisline: {
                    chart: {
                        showLegend: "1",
                        lineThickness: "2",
                        allowSelection: "0",
                        connectNullData: "1",
                        drawAnchors: "0",
                        divLineDashed: "0",
                        divLineColor: "#DFDFDF",
                        vDivLineColor: "#DFDFDF",
                        vDivLineDashed: "0",
                        yAxisNameFontSize: "13",
                        drawCustomLegendIcon: "0"
                    },
                    axis: [{
                        divLineColor: "#DFDFDF",
                        setAdaptiveYMin: "1",
                        divLineDashed: "0"
                    }]
                },
                multilevelpie: {
                    chart: {
                        useHoverColor: "1",
                        hoverFillColor: "#EDEDED",
                        showHoverEffect: "1",
                        plotHoverEffect: "1"
                    },
                    category: [{
                        color: "#EDEDED",
                        category: [{
                            color: "#5D62B5",
                            category: [{
                                color: "#5D62B5"
                            }]
                        }]
                    }]
                },
                selectscatter: {
                    chart: {
                        showShadow: "0",
                        adjustDiv: "1",
                        lineThickness: "2",
                        anchorRadius: "4",
                        anchorHoverEffect: "1",
                        anchorHoverRadius: "4",
                        anchorBorderHoverColor: "#FFFFFF",
                        anchorBorderHoverThickness: "1.5",
                        showLegend: "1",
                        legendIconSides: "2"
                    }
                },
                waterfall2d: {
                    chart: {
                        paletteColors: "#5D62B5, #29C3BE, #F2726F, #ffa341, #62B58F, #BC95DF, #67CDF2",
                        positiveColor: "62B58F",
                        negativeColor: "#F2726F",
                        showConnectors: "1",
                        connectorDashed: "1",
                        connectorThickness: "0.7",
                        connectorColor: "#5D5D5D"
                    }
                },
                kagi: {
                    chart: {
                        rallyThickness: "2",
                        declineThickness: "2",
                        legendIconSides: "2",
                        drawAnchors: "0",
                        rallyColor: "#62B58F",
                        declineColor: "#F2726F"
                    }
                },
                geo: {
                    chart: {
                        showLabels: "0",
                        legendScaleLineThickness: "0",
                        legendaxisborderalpha: "0",
                        legendShadow: "0",
                        fillColor: "#FDFDFD",
                        showEntityHoverEffect: "1",
                        entityFillHoverAlpha: "90",
                        connectorHoverAlpha: "90",
                        markerBorderHoverAlpha: "90",
                        showBorder: "1",
                        borderColor: "#5D5D5D",
                        borderThickness: "0.1",
                        nullEntityColor: "5D5D5D",
                        nullEntityAlpha: "50",
                        entityFillHoverColor: "#5D5D5D"
                    },
                    colorrange: {
                        gradient: "1",
                        code: "#ffa341"
                    }
                },
                overlappedbar2d: {
                    chart: {
                        placeValuesInside: "0",
                        showAlternateVGridColor: "0",
                        showLegend: "1",
                        legendIconSides: "4",
                        yAxisValuesPadding: "10"
                    }
                },
                overlappedcolumn2d: {
                    chart: {
                        showLegend: "1",
                        legendIconSides: "4"
                    }
                },
                timeseries: {
                    caption: {
                        style: {
                            text: {
                                "font-size": 18,
                                "font-family": "Source Sans Pro SemiBold",
                                fill: "#5A5A5A"
                            }
                        }
                    },
                    subcaption: {
                        style: {
                            text: {
                                "font-family": "Source Sans Pro",
                                "font-size": 13,
                                fill: "#999999"
                            }
                        }
                    },
                    chart: {
                        paletteColors: "#5D62B5, #29C3BE, #F2726F, #ffa341, #62B58F, #BC95DF, #67CDF2",
                        baseFont: "Source Sans Pro",
                        multiCanvasTooltip: 1,
                        style: {
                            text: {
                                "font-family": "Source Sans Pro"
                            },
                            canvas: {
                                "stroke-width": 1,
                                stroke: "#DFDFDF"
                            },
                            tooltip: {
                                "font-size": 13,
                                color: "#5A5A5A",
                                "background-color": "#FFFFFF",
                                opacity: "0.9",
                                "border-color": "#E1E1E1",
                                "border-width": "1",
                                "border-radius": "2",
                                padding: 6
                            },
                            navigator: {
                                brush: {
                                    handle: {
                                        fill: "#EBEBEB"
                                    }
                                },
                                scroller: {
                                    button: {
                                        fill: "#EBEBEB"
                                    },
                                    track: {
                                        fill: "#FFFFFF"
                                    },
                                    scrollbar: {
                                        fill: "#EBEBEB"
                                    }
                                }
                            }
                        }
                    },
                    extensions: {
                        customRangeSelector: {
                            style: {
                                title: {
                                    text: {
                                        "font-family": "Source Sans Pro SemiBold"
                                    },
                                    icon: {
                                        "font-family": "Source Sans Pro SemiBold"
                                    },
                                    calendar: {
                                        normaldate: "fc-cal-date-normal",
                                        selecteddate: "fc-cal-date-selected",
                                        body: "fc-cal-body"
                                    }
                                }
                            }
                        },
                        standardRangeSelector: {
                            style: {
                                button: {
                                    text: {
                                        fill: "#999999"
                                    }
                                },
                                "button:hover": {
                                    text: {
                                        fill: "#5648D4",
                                        "font-family": "Source Sans Pro SemiBold"
                                    }
                                },
                                "button:active": {
                                    text: {
                                        fill: "#5648D4",
                                        "font-family": "Source Sans Pro SemiBold"
                                    }
                                },
                                separator: {
                                    stroke: "#DFDFDF"
                                }
                            }
                        }
                    },
                    legend: {
                        item: {
                            style: {
                                text: {
                                    fill: "#7C7C7C",
                                    "font-size": 15,
                                    "font-family": "Source Sans Pro"
                                }
                            }
                        }
                    },
                    xaxis: {
                        style: {
                            title: {
                                "font-size": 15,
                                "font-family": "Source Sans Pro",
                                fill: "#999999"
                            },
                            ticks: {
                                major: {
                                    stroke: "#DFDFDF",
                                    "stroke-width": 1
                                },
                                minor: {
                                    stroke: "#DFDFDF",
                                    "stroke-width": .75
                                }
                            },
                            text: {
                                major: {
                                    color: "#5A5A5A"
                                },
                                minor: {
                                    color: "#8D8D8D"
                                },
                                context: {
                                    color: "#5A5A5A"
                                }
                            }
                        }
                    },
                    plotconfig: {
                        column: {
                            style: {
                                "plot:hover": {
                                    opacity: .75
                                },
                                "plot:highlight": {
                                    opacity: .75
                                }
                            }
                        },
                        line: {
                            style: {
                                plot: {
                                    "stroke-width": 1.5
                                },
                                anchor: {
                                    "stroke-width": 0
                                }
                            }
                        },
                        area: {
                            style: {
                                anchor: {
                                    "stroke-width": 0
                                }
                            }
                        },
                        candlestick: {
                            style: {
                                bear: {
                                    stroke: "#F2726F",
                                    fill: "#F2726F"
                                },
                                "bear:hover": {
                                    opacity: .75
                                },
                                "bear:highlight": {
                                    opacity: .75
                                },
                                bull: {
                                    stroke: "#62B58F",
                                    fill: "#62B58F"
                                },
                                "bull:hover": {
                                    opacity: .75
                                },
                                "bull:highlight": {
                                    opacity: .75
                                }
                            }
                        },
                        ohlc: {
                            style: {
                                bear: {
                                    stroke: "#F2726F",
                                    fill: "#F2726F"
                                },
                                "bear:hover": {
                                    opacity: .75
                                },
                                "bear:highlight": {
                                    opacity: .75
                                },
                                bull: {
                                    stroke: "#62B58F",
                                    fill: "#62B58F"
                                },
                                "bull:hover": {
                                    opacity: .75
                                },
                                "bull:highlight": {
                                    opacity: .75
                                }
                            }
                        }
                    },
                    yaxis: [{
                        style: {
                            title: {
                                "font-size": "15",
                                "font-family": "Source Sans Pro",
                                fill: "#999999"
                            },
                            "tick-mark": {
                                stroke: "#DFDFDF",
                                "stroke-width": 1
                            },
                            "grid-line": {
                                stroke: "#DFDFDF",
                                "stroke-width": 1
                            },
                            label: {
                                color: "#5A5A5A"
                            }
                        }
                    }]
                }
            }
        };
        __webpack_exports__["a"] = {
            extension: themeObject,
            name: "fusionTheme",
            type: "theme"
        }
    }, function(module, exports, __webpack_require__) {
        var content = __webpack_require__(16);
        if (typeof content === "string") content = [
            [module.i, content, ""]
        ];
        var transform;
        var insertInto;
        var options = {
            hmr: true
        };
        options.transform = transform;
        options.insertInto = undefined;
        var update = __webpack_require__(1)(content, options);
        if (content.locals) module.exports = content.locals;
        if (false) {
            module.hot.accept("!!../../../node_modules/css-loader/index.js!./fusioncharts.theme.fusion.css", function() {
                var newContent = require("!!../../../node_modules/css-loader/index.js!./fusioncharts.theme.fusion.css");
                if (typeof newContent === "string") newContent = [
                    [module.id, newContent, ""]
                ];
                var locals = function(a, b) {
                    var key, idx = 0;
                    for (key in a) {
                        if (!b || a[key] !== b[key]) return false;
                        idx++
                    }
                    for (key in b) idx--;
                    return idx === 0
                }(content.locals, newContent.locals);
                if (!locals) throw new Error("Aborting CSS HMR due to changed css-modules locals.");
                update(newContent)
            });
            module.hot.dispose(function() {
                update()
            })
        }
    }, function(module, exports, __webpack_require__) {
        exports = module.exports = __webpack_require__(0)(false);
        exports.push([module.i, "@font-face {\n  font-family: 'Source Sans Pro';\n  font-style: normal;\n  font-weight: 400;\n  src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v11/6xK3dSBYKcSV-LCoeQqfX1RYOo3qOK7lujVj9w.woff2) format('woff2');\n  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;\n}\n\n@font-face {\n  font-family: 'Source Sans Pro Light';\n  font-style: normal;\n  font-weight: 300;\n  src: local('Source Sans Pro Light'), local('SourceSansPro-Light'), url(https://fonts.gstatic.com/s/sourcesanspro/v11/6xKydSBYKcSV-LCoeQqfX1RYOo3ik4zwlxdu3cOWxw.woff2) format('woff2');\n  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;\n}\n\n@font-face {\n  font-family: 'Source Sans Pro SemiBold';\n  font-style: normal;\n  font-weight: 600;\n  src: local('Source Sans Pro SemiBold'), local('SourceSansPro-SemiBold'), url(https://fonts.gstatic.com/s/sourcesanspro/v11/6xKydSBYKcSV-LCoeQqfX1RYOo3i54rwlxdu3cOWxw.woff2) format('woff2');\n  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;\n}\n\n/* ft calendar customization */\n.fc-cal-date-normal {\n  color: #5F5F5F;\n  font-family: 'Source Sans Pro';\n  font-size: 11px;\n}\n\n.fc-cal-date-selected {\n  color: #FEFEFE;\n  font-family: 'Source Sans Pro SemiBold'\n}", ""])
    }])
});
//# sourceMappingURL=fusioncharts.theme.fusion.js.map