/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/js/printing.js":
/*!*****************************************!*\
  !*** ./resources/assets/js/printing.js ***!
  \*****************************************/
/***/ (() => {

function createMultiPageDocument(tableData, columns) {
  // Define header and footer height
  var headerHeight = document.getElementById('header-container').clientHeight;
  var footerHeight = document.getElementById('footer-container').clientHeight;
  var pageMaxHeight = 960;
  var headerHtml = document.getElementById('header-container').innerHTML;
  var footerHtml = document.getElementById('footer-container').innerHTML;
  var area = document.getElementById('page-drawing-area');
  area.innerHTML = "";
  var numRows = tableData.length;

  // Calculate body height excluding header and footer
  var bodyHeight = pageMaxHeight - (headerHeight + footerHeight);
  var rowsCount = 0;
  var pageDiv = document.createElement('div');
  pageDiv.classList.add('page');
  pageDiv.classList.add('content');
  pageDiv.classList.add('page-break');
  area.appendChild(pageDiv);

  // Add header to the page
  var headerDiv = document.createElement('div');
  headerDiv.innerHTML = headerHtml;
  pageDiv.appendChild(headerDiv);

  // Add footer to the page
  var footerDiv = document.createElement('div');
  footerDiv.innerHTML = footerHtml;

  // add table to the body
  var tableBody = document.createElement('table');
  pageDiv.appendChild(tableBody);
  var rowDiv = document.createElement('tr');
  rowDiv.classList.add('table-title');
  for (var j = 0; j < columns.length; j++) {
    var col = columns[j];
    var cellH = document.createElement('h2');
    cellH.textContent = col.title;
    var cellDiv = document.createElement('td');
    cellDiv.appendChild(cellH);
    rowDiv.appendChild(cellDiv);
  }
  tableBody.appendChild(rowDiv);

  // Loop through pages
  for (var i = rowsCount; i < numRows; i++) {
    // Add row to the page
    var rowElement = document.createElement('tr');
    rowElement.classList.add('table-row');
    var row = tableData[i];
    rowsCount = i;
    for (var _j = 0; _j < columns.length; _j++) {
      var _col = columns[_j];
      var _cellDiv = document.createElement('td');
      _cellDiv.classList.add('item-text');
      _cellDiv.textContent = row[_col.field];
      rowElement.appendChild(_cellDiv);
    }
    tableBody.appendChild(rowElement);
    var rowHeight = rowElement.clientHeight;
    if (pageDiv.clientHeight > bodyHeight + (headerHeight + rowHeight)) {
      // remove the last row added
      tableBody.removeChild(rowElement);
      // new page should be created
      // Add footer to the page
      var _footerDiv = document.createElement('div');
      _footerDiv.innerHTML = footerHtml;
      pageDiv.appendChild(_footerDiv);
      pageDiv = document.createElement('div');
      pageDiv.classList.add('page');
      pageDiv.classList.add('content');
      pageDiv.classList.add('page-break');
      area.appendChild(pageDiv);

      // Add header to the page
      headerDiv = document.createElement('div');
      headerDiv.innerHTML = headerHtml;
      pageDiv.appendChild(headerDiv);

      // add table to the body
      tableBody = document.createElement('table');
      pageDiv.appendChild(tableBody);

      // Add row to the page
      var _rowDiv = document.createElement('tr');
      _rowDiv.classList.add('table-row');
      var _row = tableData[i];
      rowsCount = i;
      for (var _j2 = 0; _j2 < columns.length; _j2++) {
        var _col2 = columns[_j2];
        var _cellDiv2 = document.createElement('td');
        _cellDiv2.classList.add('item-text');
        _cellDiv2.textContent = _row[_col2.field];
        _rowDiv.appendChild(_cellDiv2);
      }
      tableBody.appendChild(_rowDiv);
    }
  }
  pageDiv.appendChild(footerDiv);
}

/***/ }),

/***/ "./resources/assets/sass/app.scss":
/*!****************************************!*\
  !*** ./resources/assets/sass/app.scss ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/public/js/printing": 0,
/******/ 			"public/css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunklara_excel_craft"] = self["webpackChunklara_excel_craft"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["public/css/app"], () => (__webpack_require__("./resources/assets/js/printing.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["public/css/app"], () => (__webpack_require__("./resources/assets/sass/app.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;