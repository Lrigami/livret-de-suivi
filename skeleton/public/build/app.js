(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _bootstrap_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./bootstrap.js */ "./assets/bootstrap.js");
/* harmony import */ var _bootstrap_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_bootstrap_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./styles/app.css */ "./assets/styles/app.css");
/* harmony import */ var _js_booklet_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./js/booklet.js */ "./assets/js/booklet.js");

/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */


console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

/***/ }),

/***/ "./assets/bootstrap.js":
/*!*****************************!*\
  !*** ./assets/bootstrap.js ***!
  \*****************************/
/***/ (() => {

// import { startStimulusApp } from '@symfony/stimulus-bundle';

// const app = startStimulusApp();
// register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);

/***/ }),

/***/ "./assets/js/booklet.js":
/*!******************************!*\
  !*** ./assets/js/booklet.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_esnext_iterator_constructor_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/esnext.iterator.constructor.js */ "./node_modules/core-js/modules/esnext.iterator.constructor.js");
/* harmony import */ var core_js_modules_esnext_iterator_constructor_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_esnext_iterator_constructor_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_esnext_iterator_for_each_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/esnext.iterator.for-each.js */ "./node_modules/core-js/modules/esnext.iterator.for-each.js");
/* harmony import */ var core_js_modules_esnext_iterator_for_each_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_esnext_iterator_for_each_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_web_timers_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/web.timers.js */ "./node_modules/core-js/modules/web.timers.js");
/* harmony import */ var core_js_modules_web_timers_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_timers_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _ckeditor_ckeditor5_build_classic__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @ckeditor/ckeditor5-build-classic */ "./node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js");
/* harmony import */ var _ckeditor_ckeditor5_build_classic__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(_ckeditor_ckeditor5_build_classic__WEBPACK_IMPORTED_MODULE_6__);







function initCKEditor() {
  document.querySelectorAll('textarea[id^="Booklet_bookletPeriods"]').forEach(function (el) {
    if (!el.classList.contains('ck-editor-initialized')) {
      _ckeditor_ckeditor5_build_classic__WEBPACK_IMPORTED_MODULE_6___default().create(el).then(function (editor) {
        el.editorInstance = editor;
      })["catch"](function (error) {
        return console.error(error);
      });
      el.classList.add('ck-editor-initialized');
    }
  });
}
document.addEventListener('DOMContentLoaded', function () {
  initCKEditor();

  // EasyAdmin: ré-initialiser CKEditor quand on ajoute un élément de collection
  document.body.addEventListener('click', function (e) {
    if (e.target.matches('.easyadmin-new-collection-item')) {
      setTimeout(initCKEditor, 50);
    }
  });
});

/***/ }),

/***/ "./assets/styles/app.css":
/*!*******************************!*\
  !*** ./assets/styles/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_ckeditor_ckeditor5-build-classic_build_ckeditor_js-node_modules_core-js_-b652d1"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXBwLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7O0FBQXdCO0FBQ3hCO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUMwQjtBQUNEO0FBRXpCQSxPQUFPLENBQUNDLEdBQUcsQ0FBQyxnRUFBZ0UsQ0FBQyxDOzs7Ozs7Ozs7O0FDVjdFOztBQUVBO0FBQ0E7QUFDQSxnRTs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUNKOEQ7QUFFOUQsU0FBU0UsWUFBWUEsQ0FBQSxFQUFHO0VBQ3BCQyxRQUFRLENBQUNDLGdCQUFnQixDQUFDLHdDQUF3QyxDQUFDLENBQUNDLE9BQU8sQ0FBQyxVQUFDQyxFQUFFLEVBQUs7SUFDaEYsSUFBSSxDQUFDQSxFQUFFLENBQUNDLFNBQVMsQ0FBQ0MsUUFBUSxDQUFDLHVCQUF1QixDQUFDLEVBQUU7TUFDakRQLCtFQUFvQixDQUFDSyxFQUFFLENBQUMsQ0FDbkJJLElBQUksQ0FBQyxVQUFBQyxNQUFNLEVBQUk7UUFBRUwsRUFBRSxDQUFDTSxjQUFjLEdBQUdELE1BQU07TUFBRSxDQUFDLENBQUMsU0FDMUMsQ0FBQyxVQUFBRSxLQUFLO1FBQUEsT0FBSWQsT0FBTyxDQUFDYyxLQUFLLENBQUNBLEtBQUssQ0FBQztNQUFBLEVBQUM7TUFDekNQLEVBQUUsQ0FBQ0MsU0FBUyxDQUFDTyxHQUFHLENBQUMsdUJBQXVCLENBQUM7SUFDN0M7RUFDSixDQUFDLENBQUM7QUFDTjtBQUVBWCxRQUFRLENBQUNZLGdCQUFnQixDQUFDLGtCQUFrQixFQUFFLFlBQU07RUFDaERiLFlBQVksQ0FBQyxDQUFDOztFQUVkO0VBQ0FDLFFBQVEsQ0FBQ2EsSUFBSSxDQUFDRCxnQkFBZ0IsQ0FBQyxPQUFPLEVBQUUsVUFBQ0UsQ0FBQyxFQUFLO0lBQzNDLElBQUlBLENBQUMsQ0FBQ0MsTUFBTSxDQUFDQyxPQUFPLENBQUMsZ0NBQWdDLENBQUMsRUFBRTtNQUNwREMsVUFBVSxDQUFDbEIsWUFBWSxFQUFFLEVBQUUsQ0FBQztJQUNoQztFQUNKLENBQUMsQ0FBQztBQUNOLENBQUMsQ0FBQyxDOzs7Ozs7Ozs7Ozs7QUN0QkYiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9ib290c3RyYXAuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2Jvb2tsZXQuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL3N0eWxlcy9hcHAuY3NzPzNmYmEiXSwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0ICcuL2Jvb3RzdHJhcC5qcyc7XG4vKlxuICogV2VsY29tZSB0byB5b3VyIGFwcCdzIG1haW4gSmF2YVNjcmlwdCBmaWxlIVxuICpcbiAqIFRoaXMgZmlsZSB3aWxsIGJlIGluY2x1ZGVkIG9udG8gdGhlIHBhZ2UgdmlhIHRoZSBpbXBvcnRtYXAoKSBUd2lnIGZ1bmN0aW9uLFxuICogd2hpY2ggc2hvdWxkIGFscmVhZHkgYmUgaW4geW91ciBiYXNlLmh0bWwudHdpZy5cbiAqL1xuaW1wb3J0ICcuL3N0eWxlcy9hcHAuY3NzJztcbmltcG9ydCAnLi9qcy9ib29rbGV0LmpzJztcblxuY29uc29sZS5sb2coJ1RoaXMgbG9nIGNvbWVzIGZyb20gYXNzZXRzL2FwcC5qcyAtIHdlbGNvbWUgdG8gQXNzZXRNYXBwZXIhIPCfjoknKTtcbiIsIi8vIGltcG9ydCB7IHN0YXJ0U3RpbXVsdXNBcHAgfSBmcm9tICdAc3ltZm9ueS9zdGltdWx1cy1idW5kbGUnO1xuXG4vLyBjb25zdCBhcHAgPSBzdGFydFN0aW11bHVzQXBwKCk7XG4vLyByZWdpc3RlciBhbnkgY3VzdG9tLCAzcmQgcGFydHkgY29udHJvbGxlcnMgaGVyZVxuLy8gYXBwLnJlZ2lzdGVyKCdzb21lX2NvbnRyb2xsZXJfbmFtZScsIFNvbWVJbXBvcnRlZENvbnRyb2xsZXIpO1xuIiwiaW1wb3J0IENsYXNzaWNFZGl0b3IgZnJvbSAnQGNrZWRpdG9yL2NrZWRpdG9yNS1idWlsZC1jbGFzc2ljJztcclxuXHJcbmZ1bmN0aW9uIGluaXRDS0VkaXRvcigpIHtcclxuICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJ3RleHRhcmVhW2lkXj1cIkJvb2tsZXRfYm9va2xldFBlcmlvZHNcIl0nKS5mb3JFYWNoKChlbCkgPT4ge1xyXG4gICAgICAgIGlmICghZWwuY2xhc3NMaXN0LmNvbnRhaW5zKCdjay1lZGl0b3ItaW5pdGlhbGl6ZWQnKSkge1xyXG4gICAgICAgICAgICBDbGFzc2ljRWRpdG9yLmNyZWF0ZShlbClcclxuICAgICAgICAgICAgICAgIC50aGVuKGVkaXRvciA9PiB7IGVsLmVkaXRvckluc3RhbmNlID0gZWRpdG9yOyB9KVxyXG4gICAgICAgICAgICAgICAgLmNhdGNoKGVycm9yID0+IGNvbnNvbGUuZXJyb3IoZXJyb3IpKTtcclxuICAgICAgICAgICAgZWwuY2xhc3NMaXN0LmFkZCgnY2stZWRpdG9yLWluaXRpYWxpemVkJyk7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbn1cclxuXHJcbmRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ0RPTUNvbnRlbnRMb2FkZWQnLCAoKSA9PiB7XHJcbiAgICBpbml0Q0tFZGl0b3IoKTtcclxuXHJcbiAgICAvLyBFYXN5QWRtaW46IHLDqS1pbml0aWFsaXNlciBDS0VkaXRvciBxdWFuZCBvbiBham91dGUgdW4gw6lsw6ltZW50IGRlIGNvbGxlY3Rpb25cclxuICAgIGRvY3VtZW50LmJvZHkuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoZSkgPT4ge1xyXG4gICAgICAgIGlmIChlLnRhcmdldC5tYXRjaGVzKCcuZWFzeWFkbWluLW5ldy1jb2xsZWN0aW9uLWl0ZW0nKSkge1xyXG4gICAgICAgICAgICBzZXRUaW1lb3V0KGluaXRDS0VkaXRvciwgNTApO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG59KTtcclxuIiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307Il0sIm5hbWVzIjpbImNvbnNvbGUiLCJsb2ciLCJDbGFzc2ljRWRpdG9yIiwiaW5pdENLRWRpdG9yIiwiZG9jdW1lbnQiLCJxdWVyeVNlbGVjdG9yQWxsIiwiZm9yRWFjaCIsImVsIiwiY2xhc3NMaXN0IiwiY29udGFpbnMiLCJjcmVhdGUiLCJ0aGVuIiwiZWRpdG9yIiwiZWRpdG9ySW5zdGFuY2UiLCJlcnJvciIsImFkZCIsImFkZEV2ZW50TGlzdGVuZXIiLCJib2R5IiwiZSIsInRhcmdldCIsIm1hdGNoZXMiLCJzZXRUaW1lb3V0Il0sInNvdXJjZVJvb3QiOiIifQ==